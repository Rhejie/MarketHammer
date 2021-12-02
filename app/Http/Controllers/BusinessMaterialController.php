<?php

namespace App\Http\Controllers;

use App\Model\Business\BusinessMaterial;
use App\Model\Material;
use App\Repositories\Business\BusinessMaterialRepository;
use Illuminate\Http\Request;

class BusinessMaterialController extends Controller
{
    //
    private $businessMaterialRepository;
    public function __construct(BusinessMaterialRepository $businessMaterialRepository)
    {
        $this->businessMaterialRepository = $businessMaterialRepository;
    }
    public function getMaterials()
    {
        $materials = Material::get();

        return response()->json($materials, 200);
    }

    public function index($id, Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $materials = $this->businessMaterialRepository->getBusinessMaterial($id, json_decode(json_encode($params)));

        return response()->json($materials, 200);
    }

    public function store(Request $request)
    {

        $materials = $this->businessMaterialRepository->store(json_decode(json_encode($request->all())));

        return response()->json($materials, 200);
    }

    public function deleteBusinessMaterial($id)
    {

        $business_material = BusinessMaterial::find($id);
        $business_material->delete();

        return response()->json([
            'message' => 'Deleted successfully!',
            'status_code' => 200
        ], 200);
    }

    public function updateBusinessMaterial($id, Request $request)
    {
        $material = $this->businessMaterialRepository->update($id, json_decode(json_encode($request->all())));

        // BusinessMaterial::where('id', $id)->update([
        //     'material_id' => $request->material_id
        // ]);

        // $material = BusinessMaterial::with('material')->find($id);

        return response()->json($material, 200);
    }
}
