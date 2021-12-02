<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\QSA\QsaTypeRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QsaTypeController extends Controller
{
    public function __construct(QsaTypeRepository $qsaTypeRepository)
    {
        $this->qsaTypeRepository = $qsaTypeRepository;
    }

    public function store(Request $request)
    {
        $qsa_type = $this->qsaTypeRepository->create(json_decode(json_encode($request->all())));
        return response()->json($qsa_type, 200);
        // $className = $this->resourceItem();

        // return new $className($qsa_type);
    }

    public function show($id)
    {
        $qsa_type = $this->qsaTypeRepository->show($id);
        $className = $this->resourceItem();

        return new $className($qsa_type);
    }

    public function update(Request $request, $id)
    {
        $qsa_type = $this->qsaTypeRepository->update($request->all(), $id);

        return response()->json($qsa_type, 200);

        // $className = $this->resourceItem();

        // return new $className($qsa_type);
    }

    public function destroy($id)
    {
        $qsa_type = $this->qsaTypeRepository->delete($id);
        return $qsa_type;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Qsa\QsaTypeResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getType(Request $request)
    {
        $qsa_type = $this->qsaTypeRepository->getType($request);

        return ['qsa_type' => $qsa_type];
    }

}
