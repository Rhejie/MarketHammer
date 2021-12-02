<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Http\Controllers\Controller;
use App\Model\OperationCondition;
use App\Repositories\OperationCondition\OperationConditionRepository;
use Illuminate\Http\Request;

class OperationConditionController extends Controller
{
    private $operationConditionRepository;

    public function __construct(OperationConditionRepository $operationConditionRepository)
    {
        $this->operationConditionRepository = $operationConditionRepository;
    }

    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $operationConditions = $this->operationConditionRepository->get(json_decode(json_encode($params)));

        return response()->json($operationConditions, 200);
    }

    public function store(Request $request)
    {
        $operationCondition = $this->operationConditionRepository->create(json_decode(json_encode($request->all())));

        return response()->json($operationCondition, 200);
    }

    public function update($id, Request $request)
    {
        $operationCondition = $this->operationConditionRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($operationCondition, 200);
    }

    public function destroy($id)
    {
        $this->operationConditionRepository->delete($id);

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }

}
