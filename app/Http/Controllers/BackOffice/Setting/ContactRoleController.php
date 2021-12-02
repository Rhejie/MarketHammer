<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Repositories\SystemData\ContactRoleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactRoleController extends Controller
{
    public function __construct(ContactRoleRepository $contactRoleRepository)
    {
        $this->contactRoleRepository = $contactRoleRepository;
    }

    public function store(Request $request)
    {
        $qsa_criteria = $this->contactRoleRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($qsa_criteria);
    }

    public function show($id)
    {
        $qsa_criteria = $this->contactRoleRepository->get($id)->loadMissing(['translations']);
        $className = $this->resourceItem();

        return new $className($qsa_criteria);
    }

    public function update(Request $request, $id)
    {
        $qsa_criteria = $this->contactRoleRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($qsa_criteria);
    }

    public function destroy($id)
    {
        $qsa_criteria = $this->contactRoleRepository->delete($id);
        return $qsa_criteria;
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\SystemData\ContactRoleResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getList(Request $request)
    {
        $role = $this->contactRoleRepository->getList($request);

        return ['role' => $role];
    }

}
