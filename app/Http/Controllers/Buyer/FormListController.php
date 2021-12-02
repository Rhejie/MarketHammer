<?php

namespace App\Http\Controllers\Buyer;

use App\Exports\FormSubmissionExport;
use App\Model\BusinessAddress;
use App\Model\Buyer\FormSubmissionToSupplier;
use App\Http\Controllers\Controller;
use App\Model\Business;
use App\Model\Business\BusinessFollower;
use App\Model\Buyer\FormSubmissions;
use App\Model\FormSubmissionField;
use App\Model\FormSubmissionGroup;
use App\Model\FormSubmissionStatus;
use App\Model\FormTemplate\TemplateFormGroup;
use App\Repositories\Buyer\BuyerFormListRepository;
use App\Service\Business\SupplierListService;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FormField\{FormFieldGroupRepository, FormFieldRepository};
use App\Repositories\Buyer\{FormSubmissionFieldRepository, FormSubmissionGroupRepository};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Excel;
use Excel;

class FormListController extends Controller
{
    private $buyerFormListRepository;
    public function __construct(
		BuyerFormListRepository $buyerFormListRepository,
        FormFieldGroupRepository $formFieldGroupRepository,
        FormFieldRepository $formFieldRepository,
        FormSubmissionGroupRepository $formSubmissionGroupRepository,
        FormSubmissionFieldRepository $formSubmissionFieldRepository
	) {
        $this->middleware('auth');
        $this->buyerFormListRepository = $buyerFormListRepository;
        $this->formFieldGroupRepository = $formFieldGroupRepository;
        $this->formFieldRepository = $formFieldRepository;
        $this->formSubmissionFieldRepository = $formSubmissionFieldRepository;
        $this->formSubmissionGroupRepository = $formSubmissionGroupRepository;
    }

    public function index()
    {
        $userId = Auth::user()->id;
        return view('buyer/List', [
            'form_types' => __get_form_types(),
            'form_status' => __get_form_status(),
//            'form_status' => __get_form_status(),
            'form_field_groups' => $this->formFieldGroupRepository->getFormFieldGroups(false),
            'formTemplateStatusList' => \App\Model\FormTemplate\FormTemplateStatus::all(),
            'fieldTypeList' => $this->formFieldRepository->getFieldTypeList(),
            'optionReferenceList' => $this->formFieldRepository->getOptionReferences(),
            'formFieldGroups' => $this->formFieldGroupRepository->getFormFieldGroups(),
            'user_id' => $userId
        ]);
    }

    public function createForm(Request $request)
    {
        $data = $this->buyerFormListRepository->addForm(json_decode(json_encode($request->all())));

        return response()->json($data, 200);
    }

    public function getFormList(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;
        $form_type_id = $request->form_type_id ? $request->form_type_id : 'All';
        $form_submission_status_id = $request->form_submission_status_id ? $request->form_submission_status_id : 'All';
        $buyer_id = $request->buyer_id ? $request->buyer_id : Auth::user()->id;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search,
            'form_type_id' => $form_type_id,
            'form_submission_status_id' => $form_submission_status_id,
            'buyer_id' => $buyer_id
        ];
        $datas = $this->buyerFormListRepository->getFormList(json_decode(json_encode($params)));

        return response()->json($datas, 200);
    }

    public function updateFormData($id, Request $request)
    {
        $form = $this->buyerFormListRepository->updateFormData($id, json_decode(json_encode($request->all())));

        return response()->json($form, 200);
    }

    public function deleteForm($id)
    {

        $form = FormSubmissions::find($id);
        $form->delete();

        return response()->json([
            'message' => 'Deleted successfully!'
        ], 200);
    }

    public function getSelect()
    {

        $select = FormSubmissionStatus::where('name', 'Open')->with('translations')->first();

        return response()->json($select, 200);
    }
    public function addFormBuilderTemplate($id, Request $request)
    {
        $template = $this->buyerFormListRepository->cloneTemplate($id, json_decode(json_encode($request->all())));

        return response()->json($template, 200);
    }
    public function ckeckTemplate($id)
    {
        $template = $this->formSubmissionGroupRepository->model()
        ->where('form_submission_id', $id)
        ->where('created_by', auth()->user()->id)
        ->get();

        foreach ($template as $key => $group) {
            $params = ['form_submission_group_id' => $group->id];
            $params = (object)$params;
            $fields = $this->formSubmissionFieldRepository->getFormFields($params);
            $template[$key]['form_fields'] = $fields;
        }

        return response()->json($template, 200);
    }

    public function getFormFields()
    {

        $formFields = FormSubmissionField::where('created_by', auth()->user()->id)->get();

        return response()->json($formFields, 200);
    }

    public function getFormGroups()
    {
        $formGroups = FormBuilderFieldGroup::where('created_by', auth()->user()->id)->get();

        return response()->json($formGroups, 200);
    }
    public function addFormBulderGroup(Request $request)
    {

        FormBuilderFieldGroup::create([
            'name' => $request->name,
            'form_submission_id' => $request->form_submission_id,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);

        $formFroup = FormBuilderFieldGroup::orderBy('id', 'DESC')->first();

        return response()->json($formFroup, 200);
    }

    public function addFormField(Request $request)
    {
        FormSubmissionField::create([
            'form_submission_group_id' => $request->form_submission_group_id,
            'form_submission_id' => $request->form_submission_id,
            'field_label' => $request->field_label,
            'field_type' => $request->field_type,
            'field_description' => $request->field_description,
            'field_options' => $request->field_options,
        ]);

        $form = FormSubmissionField::orderBy('id', 'DESC')->first();

        return response()->json($form, 200);
    }

    public function sendToFavoriteSuppliers(Request $request)
    {
        // dd($request->all())
        // $checkifHastemplate = FormBuilderTemplateFormGroup::where('form_submission_id', $request->id)->where('created_by', auth()->user()->id)->first();

        $check = FormSubmissionGroup::where('form_submission_id', $request->id)->where('created_by', auth()->user()->id)->first();

        if (!empty($check)) {
            $businessFollower = BusinessFollower::where('user_id', auth()->user()->id)->where('is_favorite', true)->get();
            if (!empty($businessFollower)) {
                foreach ($businessFollower as $followers) {
                    $formtosupplier = FormSubmissionToSupplier::where('form_submission_id', $request->id)
                        ->where('buyer_id', auth()->user()->id)
                        ->where('supplier_id', $followers->business_id)->first();
                    if(empty($formtosupplier)) {
                        FormSubmissionToSupplier::create([
                            'form_submission_id' => $request->id,
                            'buyer_id' => auth()->user()->id,
                            'supplier_id' => $followers->business_id
                        ]);
                    }
                }
            } else {
                $message = 'no favorites';

                return response()->json($message, 200);
            }

            $message = 'success';

            return response()->json($message, 200);
        } else {
            $message = 'no template';
            return response()->json($message, 200);
        }
    }

    /**
     * Updates the form submission form structure
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFormTemplate(Request $request)
    {
		$this->buyerFormListRepository->buildTemplate($request->except('loaded-from-template', 'submission_id'), $request->input('submission_id'), $request->input('loaded-from-template'));
    }

    public function getSelectedTemplate($id) {
        $getselectUi = TemplateFormGroup::with(['formFieldGroup', 'formFields' => function($query) {
            $query->with('formField');
        }])->where('buyer_form_template_id', $id)->get();

        return response()->json([$getselectUi], 200);
    }

    public function getFormIDGenerated() {

        $formID = $this->buyerFormListRepository->formIDGenerated();

        return response()->json($formID, 200);

    }

    public function getSuppliers(Request $request, SupplierListService $supplierListService) {

//        $search = $request->search;
//        $form_submission_id = $request->form_submission_id;
//
//        $params = [
//            'search' => $search,
//            'form_submission_id' => $form_submission_id
//        ];
//        // 1 query
//        $supplier = $this->buyerFormListRepository->getSupppliersData(json_decode(json_encode($params)));
//        return response()->json($supplier, 200);
        return response()->json($supplierListService->getSuppliers());
    }

    public function sendToSupplierManually(Request $request) {

        // dd($request->all());
        $send = $this->buyerFormListRepository->sentoSupplierManually(json_decode(json_encode($request->all())));

        return response()->json($send, 200);
    }

    public function answerSubmussionForm($id, Request $request) {

        // dd($request->all());
        $search = $request->search;
        $filter = $request->filterData;

        $params = [
            'search' => $search,
            'selected_at' => $filter
        ];

        $answers = $this->buyerFormListRepository->answerSubmissionForm($id, json_decode(json_encode($params)));

        return response()->json($answers, 200);
    }

    public function selectAsAnswer($id) {
        FormSubmissionToSupplier::where('id', $id)->update([
            'selected_at' => Carbon::now()
        ]);

        return 'selected';
    }
    public function rejectAsAnswer($id) {
        FormSubmissionToSupplier::where('id', $id)->update([
            'selected_at' => null
        ]);

        return 'rejected';
    }

    public function updateFormSubmissionStatus($id, Request $request) {
        // dd($request->all());
        $form = FormSubmissions::where('id', $request->form_id)->update([
            'form_submission_status_id' => $id
        ]);

        return response()->json(['update successfully'], 200);
    }

    public function checkSendToSupplier($id) {

        $sendCheck = FormSubmissionToSupplier::where('form_submission_id', $id)->first();

        if(!empty($sendCheck)) {
            return 'yes';
        }

        return 'no';
    }

    public function getResponseAnswerSupplier(Request $request) {
        // dd($request->all());

        $formSubmissiontoSupplier = FormSubmissionToSupplier::with(['supplierData', 'fromGroup', 'answerSubmission' => function ($q) {
            $q->with(['formSubmissionFields' => function ($query) {
                $query->with('formBuilderFieldGroup');
            }]);
        }])
            ->where('form_submission_id', $request->form_submission_id)->where('supplier_id', $request->supplier_id)->where('status', 'submitted')->where('buyer_id', auth()->user()->id)
            ->has('answerSubmission')->get();

            $answerArray = $formSubmissiontoSupplier->map(function ($answer) {
                $ans = $answer->answerSubmission->map(function ($an) {
                    if($an->formSubmissionFields->field_type == 'Multiple Checkboxes' && $an->value != null) {

                        $data = (Object)json_decode($an->value, true);
                         $an['value'] = $data->values;
                         return $an;

                    }
                    if($an->formSubmissionFields->field_type == 'Single Checkbox' && $an->value != null) {

                        if($an->value == "1") {
                            $an['value'] = true;
                        }
                        else {
                            $an['value'] = false;
                        }
                         return $an;

                    }
                });

                return $answer;
            });
            return $answerArray;

        return response()->json($formSubmissiontoSupplier, 200);
    }

    public function getValueFromTable(Request $request) {

        $id = $request->id;
        $source_table = $request->source_table;

        $params = [
            'id' => $id,
            'source_table' => $source_table
        ];

        $data = $this->buyerFormListRepository->fetchValueFromSelectedTable(json_decode(json_encode($params)));

        return response()->json($data, 200);
    }

    public function getOptionFormSourceTable(Request $request) {

        $source = $request->source_table;

        $params = [
            'source_table' => $source
        ];
        $data = $this->buyerFormListRepository->getOptionsData(json_decode(json_encode($params)));

        return response()->json($data, 200);
    }

    public function export($id) {
        return Excel::download(new FormSubmissionExport($id), 'formSubmissionExcel.xlsx');
    }
}
