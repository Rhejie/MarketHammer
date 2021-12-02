<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Http\Controllers\Controller;
use App\Model\BusinessEsg;
use App\Repositories\BusinessEsg\BusinessEsgRepository;
use Illuminate\Http\Request;

class BusinessEsgController extends Controller
{
    private $businessEsgRepository;

    public function __construct(BusinessEsgRepository $businessEsgRepository)
    {
        $this->businessEsgRepository = $businessEsgRepository;
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

        $businessEsgs = $this->businessEsgRepository->getEsg($id, json_decode(json_encode($params)));

        return response()->json($businessEsgs, 200);
    }

    public function store(Request $request)
    {
        $businessEsg = $this->businessEsgRepository->create(json_decode(json_encode($request->all())));

        return response()->json($businessEsg, 200);
    }

    public function update($id, Request $request)
    {
        $businessEsg = $this->businessEsgRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($businessEsg, 200);
    }

    public function destroy($id)
    {
        $this->businessEsgRepository->delete($id);

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
