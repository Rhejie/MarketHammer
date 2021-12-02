<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Material\MaterialTypeRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    public function __construct(MaterialTypeRepository $materialTypeRepository)
    {
        $this->materialTypeRepository = $materialTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;

        $params = [
            'count' => $count,
            'search' => $search
        ];

        $material = $this->materialTypeRepository->where($params);
        $material = $this->materialRepository->paginate($request->current_size);

        $materialTypes = (new MaterialTypeRepository())->getMaterialTypes(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['materialTypes' => $materialTypes]);
        }

        return view('backoffice.materialType.index', compact('materialTypes'));*/

        $pageData = ['data' => []];
        return view('backoffice.materialType.index', [
            'pageData' => $pageData,
        ]);
    }

    public function store(Request $request)
    {
        $materialType = $this->materialTypeRepository->create($request->all());
        return response()->json($materialType, 200);
        // $className = $this->resourceItem();

        // return new $className($materialType);
    }

    public function show($id)
    {
        $materialType = $this->materialTypeRepository->show($id)->loadMissing(['translations']);
        $className = $this->resourceItem();

        return new $className($materialType);
    }

    public function update(Request $request, $id)
    {
        $materialType = $this->materialTypeRepository->update($request->all(), $id);
        return response()->json($materialType, 200);
        // $className = $this->resourceItem();

        // return new $className($materialType);
    }

    public function destroy($id)
    {
        $materialType = $this->materialTypeRepository->delete($id);
        return $materialType;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Material\MaterialTypeResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getMaterialTypes(Request $request)
    {
        $materialTypes = $this->materialTypeRepository->getMaterialTypeList($request);

        return ['materialTypes' => $materialTypes];
    }
}
