<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\ComplexLocation;
use App\Http\Controllers\Controller;
use App\Repositories\Complex\ComplexLocationRepository;

class ComplexLocationController extends Controller
{
    //
    private $complexLocationRepository;

    public function __construct(ComplexLocationRepository $complexLocationRepository)
    {
        $this->complexLocationRepository = $complexLocationRepository;
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

        $complexLocation = $this->complexLocationRepository->getComplexLocations(json_decode(json_encode($params)));

        return response()->json($complexLocation, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $complexLocation = $this->complexLocationRepository->storeCompleLocation(json_decode(json_encode($request->all())));

        return response()->json($complexLocation, 200);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $complexLocation = $this->complexLocationRepository->updateComplexLocation($id, $request->all());

        return response()->json($complexLocation, 200);
    }

    public function destroy($id)
    {
        $complexLocation = ComplexLocation::find($id);
        $complexLocation->delete();

        return response()->json([
            'message' => 'successfully deleted!',
            'status_code' => 200
        ], 200);
    }

    public function getComplex()
    {

        $complex = ComplexLocation::localeTranslation()->get()->toArray();

        return response()->json($complex, 200);
    }
}
