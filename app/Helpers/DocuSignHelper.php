<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use DocuSign\Rest\Client;
use App\Model\Business\BusinessNda;

class DocuSignHelper {
    public function sendSignatureRequest($signerData, $base64Document, $file_extension, $title="NDA Form - [DocuSign]") {
        $client = new Client([
            'username'       => env('DOCUSIGN_USERNAME'),
            'password'       => env('DOCUSIGN_PASSWORD'),
            'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),
            'host'           => env('DOCUSIGN_HOST')
        ]);
        
        /* $content_bytes = file_get_contents("demo1.docx");
        $doc2_b64 = base64_encode($content_bytes); */
        
        //dd($doc2_b64);

        $document1 = $client->document([  # create the DocuSign document object
            'document_base64' => $base64Document,
            'name' => 'Document1',  # can be different from actual file name
            'file_extension' => $file_extension,  # many different document types are accepted
            'document_id' => '1'  # a label used to reference the doc
        ]);

        $signer = $client->signer([
            'email' => $signerData->email, 
            'name' => $signerData->name,
            'full_name' => $signerData->name,
            'routing_order' => "1",
            'role_name' => 'signer',
            'recipient_id' => "1", 
            'routing_order' => "1"
        ]);

        $sign_here1 = $client->signHere([
            'anchor_string' => '**signature**', 'anchor_units' => 'pixels',
            'anchor_y_offset' => '10', 'anchor_x_offset' => '20']);

        $signer->setTabs($client->tabs([
            'sign_here_tabs' => [$sign_here1]
        ]));

        $cc = null;
        $userName = (Auth::user()->first_name ?? '').' '.(Auth::user()->last_name ?? '');
        if(Auth::user()->email) {
             $cc = $client->carbonCopy([
                'email' => Auth::user()->email, 
                'name' => $userName,
                'role_name' => 'cc',
                'recipient_id' => "2", 
                'routing_order' => "1"
            ]);
        } 

        $recipients = $client->Recipients([
            'signers' => [$signer],
            'carbon_copies' => $cc ? [$cc] : null
        ]);

        $envelopDefinition = $client->envelopeDefinition([
            'status'         => 'sent',
            'email_subject'  => $userName. ' is requesting for your Signature',
            //'template_id'    => '6800eebc-46b4-4001-8d12-58a2aedba8af',
            'recipients'     => $recipients,
            'documents'      => [$document1]
        ]);

        $envelopeSummary = $client->envelopes->createEnvelope($envelopDefinition);

        return ['uri' => $envelopeSummary->getUri(), 'status' => $envelopeSummary->getStatus()];
    }

    public function updateDocument($envelope_id, $document_id = '1', $document_path, $busines_nda_id = null) {
        $client = new Client([
            'username'       => env('DOCUSIGN_USERNAME'),
            'password'       => env('DOCUSIGN_PASSWORD'),
            'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),
            'host'           => env('DOCUSIGN_HOST')
        ]);

        if($busines_nda_id) {
            $envelope = $client->envelopes->getEnvelope($envelope_id);

            $business = BusinessNda::find($busines_nda_id);
            $envelopeStatus = $envelope->getStatus() ?? null;

            if($business) {
                $business->docusign_status = $envelopeStatus;
                $business->save();
            }
        }
        
        $documentOptions = $client->envelopes->getDocumentOptions(null);
        
        $documents = $client->envelopes->getDocument($document_id, $envelope_id, $documentOptions);

        $originalFileName = $document_path;//'storage/uploads/businessfiles/jVNuf9oULwCrbFurml1DvGRHQ.pdf';
        $file = file_put_contents($originalFileName, file_get_contents($documents->getPathname()));

        return ['file_path' => $documents->getPathname()] || null;
    }

    public function updateEnvelopeStatus($envelope_id, $busines_nda_id = null) {
        $client = new Client([
            'username'       => env('DOCUSIGN_USERNAME'),
            'password'       => env('DOCUSIGN_PASSWORD'),
            'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),
            'host'           => env('DOCUSIGN_HOST')
        ]);

        if($busines_nda_id) {
            $envelope = $client->envelopes->getEnvelope($envelope_id);

            $business = BusinessNda::find($busines_nda_id);
            $envelopeStatus = $envelope->getStatus() ?? null;

            if($business) {
                $business->docusign_status = $envelopeStatus;
                $business->save();

                return ['status' => $envelopeStatus];
            }
        }

        return false;
    }
}