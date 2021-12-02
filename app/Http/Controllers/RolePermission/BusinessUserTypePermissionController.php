<?php
    
namespace App\Http\Controllers\RolePermission;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Permission\BusinessUserTypePermissionRepository;
    
class BusinessUserTypePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(BusinessUserTypePermissionRepository $businessUserTypePermissionRepository)
    {
        $this->businessUserTypePermissionRepository = $businessUserTypePermissionRepository;
    }

    public function store(Request $request)
    {
        $material = $this->businessUserTypePermissionRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function destroy($id)
    {
        $material = $this->businessUserTypePermissionRepository->delete($id);
        return $material;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    public function getPermission(Request $request)
    {
        $permission = $this->businessUserTypePermissionRepository->getBusinessPermission($request);

        return ['permission' => $permission];
    }
}