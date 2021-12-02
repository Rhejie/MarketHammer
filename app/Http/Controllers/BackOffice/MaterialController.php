<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Repositories\Material\MaterialTypeRepository;
use App\Repositories\Material\MaterialRepository;

class MaterialController extends Controller
{

    public function __construct(MaterialRepository $materialRepository, MaterialTypeRepository $materialTypeRepository)
    {
        $this->materialRepository = $materialRepository;
        $this->materialTypeRepository = $materialTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backoffice.material.index');
    }


    public function store(Request $request)
    {
        $material = $this->materialRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function show($id)
    {
        $material = $this->materialRepository->get($id)->loadMissing(['translations']);
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function update(Request $request, $id)
    {
        $material = $this->materialRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function destroy($id)
    {
        $material = $this->materialRepository->delete($id);
        return $material;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Material\MaterialResource::class;
    }


    /**
     * Get list of material.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getMaterials(Request $request)
    {
        $material = $this->materialRepository->getMaterialList($request);

        return ['material' => $material];
    }
}
