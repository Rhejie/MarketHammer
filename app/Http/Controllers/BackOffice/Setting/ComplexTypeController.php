<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Model\ComplexType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Complex\ComplexTypeRepository;

class ComplexTypeController extends Controller
{
    //
    private $complexTypeRepository;
    public function __construct(ComplexTypeRepository $complexTypeRepository)
    {
        $this->complexTypeRepository = $complexTypeRepository;
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

        $complex = $this->complexTypeRepository->getComplexTypes(json_decode(json_encode($params)));

        return response()->json($complex, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $complex = $this->complexTypeRepository->store(json_decode(json_encode($request->all())));

        return response()->json($complex, 200);
    }

    public function destroy($id)
    {
        $complex = ComplexType::find($id);
        $complex->delete();

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $complex = $this->complexTypeRepository->updateComplexType($id, json_decode(json_encode($request->all())));
        //$complex = $this->complexTypeRepository->updateComplexType($id, $request->all());

        return response()->json($complex, 200);
    }

    public function getComplex()
    {

        $complex = ComplexType::localeTranslation()->get()->toArray();

        return response()->json($complex, 200);
    }
}
