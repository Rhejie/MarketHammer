<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\DocuSignHelper;

use App\Model\User;
use App\Model\Business\BusinessNda;

use DocuSign\Rest\Client;
use Illuminate\Support\Facades\Auth;

class DocusignController extends Controller
{
    // test code 
    // make sure document exist in public folder
    public function test() { // test send
        $client = new Client([
            'username'       => env('DOCUSIGN_USERNAME'),
            'password'       => env('DOCUSIGN_PASSWORD'),
            'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),
            'host'           => env('DOCUSIGN_HOST')
        ]);
        
        $content_bytes = file_get_contents("demo1.pdf");
        $doc2_b64 = base64_encode($content_bytes);
        $path_info = pathinfo('demo1.pdf');
        $file_extension = $path_info['extension'];

        $document1 = $client->document([  # create the DocuSign document object
            'document_base64' => $doc2_b64,
            'name' => 'demo1.pdf',  # can be different from actual file name
            'file_extension' => $file_extension,  # many different document types are accepted
            'document_id' => "1"  # a label used to reference the doc
        ]);

        //dd($document1);
        
        //$envelope_definition->setDocuments([$document1, $document2, $document3]);

        $signer = $client->signer([
            'email' => 'jasonchristopher.uy@gmail.com', 
            'name' => 'Jason Uy',
            'full_name' => 'Jason Uy',
            'role_name' => 'signer',
            'recipient_id' => "1", 
            'routing_order' => "1"
        ]);

        $sign_here1 = $client->signHere([
            'anchor_string' => '**signature_1**', 'anchor_units' => 'pixels',
            'anchor_y_offset' => '10', 'anchor_x_offset' => '20']);

        $signer->setTabs($client->tabs([
            'sign_here_tabs' => [$sign_here1]
        ]));
        
        $cc = null;
        $userName = (Auth::user()->first_name ?? '').' '.(Auth::user()->last_name ?? '');
        if(Auth::user()->email) {
             $cc = $client->carbonCopy([
                'email' => 'deathalms01@gmail.com',//Auth::user()->email, 
                'name' => 'Jason Christopher Uy',//(Auth::user()->first_name ?? '').' '.(Auth::user()->last_name ?? ''),
                'role_name' => 'cc',
                'recipient_id' => "2", 
                'routing_order' => "1"
            ]);
        }       

        $recipients = $client->Recipients([
            'signers' => [$signer],
            'carbon_copies' => $cc ? [$cc] : null
        ]);

        //dd($signer);
        $envelopDefinition = $client->envelopeDefinition([
            'status'         => 'sent',
            'email_subject'  => $userName. ' is requesting for your Signature',
            //'template_id'    => '6800eebc-46b4-4001-8d12-58a2aedba8af',
            'recipients'     => $recipients,
            'documents'      => [$document1]
        ]);

        //dd($envelopDefinition);

        $envelopeSummary = $client->envelopes->createEnvelope($envelopDefinition);

        //dd($envelopeSummary);
        return response()->json($envelopeSummary->getStatus());
    }

    public function getenvelope($id) {
        $client = new Client([
            'username'       => env('DOCUSIGN_USERNAME'),
            'password'       => env('DOCUSIGN_PASSWORD'),
            'integrator_key' => env('DOCUSIGN_INTEGRATOR_KEY'),
            'host'           => env('DOCUSIGN_HOST')
        ]);
        
        $business = BusinessNda::find($id);

        if($business && $business->docusign_uri && $business->docusign_uri != '') {
            $docusignHelper = new DocuSignHelper;
            $documentOptions = $client->envelopes->getDocumentOptions(null);

            $envelope_id = $business->docusign_uri;
            $envelope_id = str_replace('/envelopes/', '', $envelope_id);
            $envelope = $client->envelopes->getEnvelope($envelope_id);

            dd($envelope);

            $documents = $client->envelopes->getDocument('1', $envelope_id, $documentOptions);

            dd($documents);

            //return redirect('file:\\\\'.$documents->getPathname());

            return $business ? redirect('/storage'.$business->name) : null;
        }
        
        return 'test';
    }

    public function getNdaDocument($id) {
        $business = BusinessNda::find($id);

        if($business && $business->docusign_uri && $business->docusign_uri != '') {
            $docusignHelper = new DocuSignHelper;

            $envelope_id = $business->docusign_uri;
            $envelope_id = str_replace('/envelopes/', '', $envelope_id);

            $envlopeData = $docusignHelper->updateDocument($envelope_id, '1', 'storage'.$business->name, $business->id);
        }

        return $business ? redirect('/storage'.$business->name) : null;
    }

    public function getNdaEnvelopeStatus($id) {
        $business = BusinessNda::find($id);

        if($business && $business->docusign_uri && $business->docusign_uri != '') {
            $docusignHelper = new DocuSignHelper;

            $envelope_id = $business->docusign_uri;
            $envelope_id = str_replace('/envelopes/', '', $envelope_id);

            $envlopeData = $docusignHelper->updateEnvelopeStatus($envelope_id, $business->id);

            return ['success' => $envlopeData['status'] ? true : false, 'status' => $envlopeData['status']];
        }

        return ['success' => false];
    }

    public function requestDocumentSignature(Request $request) {

        if(isset($request->file_url)) {

            $docusignHelper = new DocuSignHelper;

            $content_bytes = file_get_contents($request->file_url);
            $doc2_b64 = base64_encode($content_bytes);
            $path_info = pathinfo($request->file_url);
            $file_extension = $path_info['extension'];
            
            $envelopData = $docusignHelper->sendSignatureRequest($request, $doc2_b64, $file_extension, $request->title ?? null);

            if($envelopData && isset($request->business_nda_id)) {
                $businessNda = BusinessNda::find($request->business_nda_id);
                $businessNda->docusign_uri = $envelopData['uri'];
                $businessNda->docusign_status = $envelopData['status'];
                $businessNda->save();
            }
            
            return response()->json(['success' => $envelopData['uri'] ? true : false, 'uri' => $envelopData['uri']]);
        }

        return response()->json(['success' => false]);
    }

    public function getTestData() {
        $users = User::with('business.nda')->get();
        $businessNda = BusinessNda::get();
        return response()->json(['users' => $users, 'business_nda' => $businessNda]);
    }
}
