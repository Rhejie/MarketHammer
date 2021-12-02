<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FormField\FormFieldGroupRepository;

class FormFieldGroupController extends Controller
{
    public function __construct(FormFieldGroupRepository $repository)
    {
        $this->repository = $repository; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formGroup = $this->repository->create($request->all())->loadMissing(['translations']);

        $className = $this->resourceItem();

        return new $className($formGroup);
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
        $formGroup = $this->repository->update($request->all(), $id)->loadMissing(['translations']);

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
            $formGroup = $this->repository->delete($id);

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return $formGroup;
    }

    /**
     * Get list of form field groups
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getFormFieldGroups(Request $request)
    {
        $searchString = $request->input('searchString');

        $formFieldGroups = $this->repository->model()::select()
        ->with('translations');

        if ($searchString) {
            $formFieldGroups->where(function($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
            });
        }

        if ($request->input('size')) {
            $formFieldGroups = $formFieldGroups->paginate($request->input('size'));    
        } else {
            $formFieldGroups = $formFieldGroups->get();
        }

        return $formFieldGroups;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
