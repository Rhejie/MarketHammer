<?php

namespace App\Http\Controllers;

use App\Model\UsageArea;
use Illuminate\Http\Request;
use App\Repositories\Area\UsageAreaRepository;

class UsageAreaController extends Controller
{
    //
    private $usageAreaRepository;

    public function __construct(UsageAreaRepository $usageAreaRepository)
    {
        $this->usageAreaRepository = $usageAreaRepository;
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

        $areas = $this->usageAreaRepository->getAreas(json_decode(json_encode($params)));

        return response()->json($areas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $area = $this->usageAreaRepository->store(json_decode(json_encode($request->all())));
        return response()->json($area, 200);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $area = $this->usageAreaRepository->updateArea($id, json_decode(json_encode($request->all())));

        return response()->json($area, 200);
    }

    public function destroy($id)
    {
        $area = UsageArea::find($id);
        $area->delete();

        return response()->json([
            'message' => 'Successfully deleted!',
            'status_code' => 200
        ], 200);
    }
}
