<?php

namespace App\Http\Controllers\Backoffice\Setting;

use App\Http\Controllers\Controller;
use App\Model\FormType;
use App\Repositories\FormType\FormTypeRepository;
use Illuminate\Http\Request;

class FormTypeController extends Controller
{
    private $formTypeRepository;

    public function __construct(FormTypeRepository $formTypeRepository)
    {
        $this->formTypeRepository = $formTypeRepository;
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

        $formTypes = $this->formTypeRepository->get(json_decode(json_encode($params)));

        return response()->json($formTypes, 200);
    }

    public function store(Request $request)
    {
        $formType = $this->formTypeRepository->create(json_decode(json_encode($request->all())));

        return response()->json($formType, 200);
    }

    public function update($id, Request $request)
    {
        $formType = $this->formTypeRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($formType, 200);
    }

    public function destroy($id)
    {
        $this->formTypeRepository->delete($id);

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }

}
