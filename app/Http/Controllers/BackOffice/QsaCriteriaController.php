<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\QSA\QsaCriteriaRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QsaCriteriaController extends Controller
{
    public function __construct(QsaCriteriaRepository $qsaCriteriaRepository)
    {
        $this->qsaCriteriaRepository = $qsaCriteriaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageData = ['data' => []];
        return view('backoffice.materialType.index', [
            'pageData' => $pageData,
        ]);
    }

    public function store(Request $request)
    {
        $qsa_criteria = $this->qsaCriteriaRepository->create($request->all());
        return response()->json($qsa_criteria, 200);
        // $className = $this->resourceItem();

        // return new $className($qsa_criteria);
    }

    public function show($id)
    {
        $qsa_criteria = $this->qsaCriteriaRepository->show($id);
        $className = $this->resourceItem();

        return new $className($qsa_criteria);
    }

    public function update(Request $request, $id)
    {
        $qsa_criteria = $this->qsaCriteriaRepository->update($request->all(), $id);
        // $className = $this->resourceItem();

        // return new $className($qsa_criteria);
        return response()->json($qsa_criteria, 200);
    }

    public function destroy($id)
    {
        $qsa_criteria = $this->qsaCriteriaRepository->delete($id);
        return $qsa_criteria;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Qsa\QsaCriteriaResource::class;
    }

    /**
     * Get list of material type.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getCriteria(Request $request)
    {
        $qsa_criteria = $this->qsaCriteriaRepository->getCriteria($request);

        return ['qsa_criteria' => $qsa_criteria];
    }

}
