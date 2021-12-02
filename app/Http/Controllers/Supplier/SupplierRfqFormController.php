<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Rfq\FormSubmissionToSupplierRepository;
use App\Repositories\Buyer\{FormSubmissionFieldRepository, FormSubmissionGroupRepository};
use App\Model\User;

class SupplierRfqFormController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FormSubmissionToSupplierRepository $formSubmissionToSupplierRepository, FormSubmissionFieldRepository $formSubmissionFieldRepository, FormSubmissionGroupRepository $formSubmissionGroupRepository)
    {
        $this->formSubmissionToSupplierRepository = $formSubmissionToSupplierRepository;
        $this->formSubmissionFieldRepository = $formSubmissionFieldRepository;
        $this->formSubmissionGroupRepository = $formSubmissionGroupRepository;
    }

    public function getRfq(Request $request){
        $rfqList = $this->formSubmissionToSupplierRepository->getSupplierRfq($request->supplier_id, $request);
        return ['rfqList' => $rfqList];
    }

    public function getFormDetails(Request $request){
        $formSupplier = $this->formSubmissionToSupplierRepository->with(['formSubmission.formType', 'buyer'])->where(['id' => $request->id])->first();
        $formFields = [];
        if($formSupplier){
            $params = ['form_submission_id' => $formSupplier->form_submission_id, 'supplier_id' => $formSupplier->supplier_id, 'form_submission_to_suppliers_id' => $request->id];
            $params = (object)$params;
            $formFields = $this->formSubmissionFieldRepository->getFormFields($params);

            $fieldGroups = $this->formSubmissionGroupRepository->model()->where(['form_submission_id' => $formSupplier->form_submission_id])->get()->toArray();
        }

        return ['formSupplier' => $formSupplier, 'formFields' => $formFields, 'formFieldGroups' => $fieldGroups];
    }

    public function getFields(Request $request){
        $formFields = $this->formSubmissionFieldRepository->getFormFields($request);
        return ['formFields' => $formFields];
    }
}
