<?php
    
namespace App\Http\Controllers\RolePermission;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

use App\Repositories\RolePermission\RolePermissionRepository;
    
class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(RolePermissionRepository $rolePermissionRepository)
    {
        $this->rolePermissionRepository = $rolePermissionRepository;

        $this->middleware('permission:role_permission_list', ['only' => ['index']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*Auth::user()->assignRole('system_admin');
        $checkRole = Auth::user()->hasRole('system_admin');
        var_dump($checkRole);*/
        //$role = Role::findByName('supplier');
        //$role->revokePermissionTo('product-list');
        /*$role = Role::findByName('writer');
        $this->roleRepository->get()
        $roles = $user->getRoleNames();*/

        $permissionList = Permission::all();

        $pageData = ['permissions' => $permissionList];

        return view('role-permission.index', [
            'pageData' => $pageData,
        ]);
    }


    public function savePermission(Request $request)
    {
        $savePermission = $this->rolePermissionRepository->savePermission($request->all());

        return $savePermission;
    }

    public function removePermission(Request $request)
    {
        $removePermission = $this->rolePermissionRepository->removePermission($request->all());

        return $removePermission;
    }

    public function getRolePermission(Request $request)
    {
        $role_permission = $this->rolePermissionRepository->getRolePermission($request);

        return ['role_permission' => $role_permission];
    }
}