<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\QSA\QsaListRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QsaListController extends Controller
{
    public function __construct(QsaListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $qsa_list = $this->repository->create($request->all());
        // $className = $this->resourceItem();
        return response()->json($qsa_list, 200);
    }

    public function show($id)
    {
        $qsa_list = $this->repository->show($id);
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function update(Request $request, $id)
    {
        $qsa_list = $this->repository->update($request->all(), $id);
        // $className = $this->resourceItem();

        // return new $className($qsa_list);
        return response()->json($qsa_list, 200);
    }

    public function destroy($id)
    {
        $qsa_list = $this->repository->delete($id);
        return $qsa_list;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Qsa\QsaListResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getList(Request $request)
    {
        $qsa_list = $this->repository->getList($request);

        return ['qsa_list' => $qsa_list];
    }

    public function getQsaList(Request $request)
    {
        $qsa_list = $this->repository->getList($request);

        return ['qsa_list' => $qsa_list];
    }

}
