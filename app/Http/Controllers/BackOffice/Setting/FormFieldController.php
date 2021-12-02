<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FormField\FormFieldRepository;
use App\Http\Requests\BackOffice\FormField\{StoreFormField, UpdateFormField};

class FormFieldController extends Controller
{
    public function __construct(FormFieldRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\FormField\StoreFormField  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormField $request)
    {
        $formGroup = $this->repository->create($request->all())->loadMissing(['translations', 'formGroup']);

        $className = $this->resourceItem();

        return new $className($formGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\FormField\UpdateFormField  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormField $request, $id)
    {
        $formGroup = $this->repository->update($request->all(), $id)->loadMissing(['translations', 'formGroup']);

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

    public function show()
    { }

    /**
     * Get list of form fields
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFormFieldGroups(Request $request)
    {
        $searchString = $request->input('searchString');

        $formFieldGroups = $this->repository->model()::select()
            ->with(['translations', 'formGroup' => function ($query){
                $query->with(['translations']);
            }]);

        if ($searchString) {
            $formFieldGroups->join('form_field_groups', 'form_fields.form_field_group_id', '=', 'form_field_groups.id')
                ->where(function ($q) use ($searchString) {
                    $q->where('form_field_groups.name', 'like', "$searchString");
                    $q->orWhere('field_label', 'like', "%$searchString%");
                    $q->orWhere('field_type', 'like', "%$searchString%");
                    $q->orWhere('field_description', 'like', "%$searchString%");
                    $q->orWhere('field_options', 'like', "%$searchString%");
                });
        }

        if ($request->input('size')) {
            $formFieldGroups = $formFieldGroups->paginate($request->input('size'));
        } else {
            $formFieldGroups = $formFieldGroups->get();
        }

        return $formFieldGroups;
    }

    /**
     * Retrieve statically defined field type list
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchComponentServiceData()
    {
        return $this->repository->fetchComponentServiceData();
    }

    public function getOptionReferences()
    {
        return $this->repository->getOptionReferences();
    }

    public function getFields($name)
    {
        return $this->repository->getFields($name);
    }
}
