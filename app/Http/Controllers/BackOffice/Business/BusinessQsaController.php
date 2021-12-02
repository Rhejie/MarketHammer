<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Repositories\Business\BusinessQsaRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessQsaController extends Controller
{
    public function __construct(BusinessQsaRepository $businessQsaRepository)
    {
        $this->businessQsaRepository = $businessQsaRepository;
    }

    public function store(Request $request)
    {
        $qsa_list = $this->businessQsaRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function show($id)
    {
        $qsa_list = $this->businessQsaRepository->show($id);
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function update(Request $request, $id)
    {
        $qsa_list = $this->businessQsaRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function destroy($id)
    {
        $qsa_list = $this->businessQsaRepository->delete($id);
        return $qsa_list;
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getList(Request $request)
    {
        $qsa_list = $this->businessQsaRepository->getList($request);

        return ['qsa_list' => $qsa_list];
    }

}
