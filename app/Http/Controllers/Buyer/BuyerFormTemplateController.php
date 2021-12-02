<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Buyer\BuyerFormTemplateRepository;
use App\Repositories\FormField\{FormFieldGroupRepository, FormFieldRepository};
use Illuminate\Support\Facades\Auth;

class BuyerFormTemplateController extends Controller
{
    public function __construct(
        BuyerFormTemplateRepository $repository,
        FormFieldGroupRepository $formFieldGroupRepository,
        FormFieldRepository $formFieldRepository
    ) {
        $this->repository = $repository;
        $this->formFieldGroupRepository = $formFieldGroupRepository;
        $this->formFieldRepository = $formFieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        return view('buyer/buyer-form-template-index', [
            'formTemplateStatusList' => \App\Model\FormTemplate\FormTemplateStatus::all(),
            'formFieldGroups' => $this->formFieldGroupRepository->getFormFieldGroups(false),
            'fieldTypeList' => $this->formFieldRepository->getFieldTypeList(),
            'optionReferenceList' => $this->formFieldRepository->getOptionReferences(),
            'user_id' => $userId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formGroup = $this->repository->create($request->all())->loadMissing(['translations', 'status']);

        $className = $this->resourceItem();

        return new $className($formGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formGroup = $this->repository->update($request->all(), $id)->loadMissing(['translations', 'status', 'updatedByUser']);

        $className = $this->resourceItem();

        return new $className($formGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();

        try {
            $formField = $this->repository->delete($id);

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return $formField;
    }

    /**
     * Get list of form fields
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $searchString = $request->input('searchString');
        $offset = $request->input('offset') ?? 0;
        $buyer_id = $request->input('buyer_id') ?? Auth::user()->id;

        $formFieldGroups = $this->repository->model()::select()
        ->with(['translations', 'status', 'updatedByUser'])
        ->where(['buyer_id' => $buyer_id]);

        if ($searchString) {
            $formFieldGroups->join('form_template_statuses', 'buyer_form_templates.form_template_status_id', '=', 'form_template_statuses.id')
            ->where(function($q) use ($searchString) {
                $q->where('buyer_form_templates.name', 'like', "$searchString");
                $q->orWhere('form_template_statuses.name', 'like', "$searchString");
            });
        }

        if ($request->input('size')) {
            $formFieldGroups = $formFieldGroups->offset($offset)->limit($request->input('size'))->get();
        } else {
            $formFieldGroups = $formFieldGroups->get();
        }

        return [
            'data' => $formFieldGroups,
            'total' => $this->repository->model()->count()
        ];
    }

    /**
     *
     *
     */
    public function buildTemplate(Request $request)
    {
        return $this->repository->buildTemplate($request->all());
    }
}
