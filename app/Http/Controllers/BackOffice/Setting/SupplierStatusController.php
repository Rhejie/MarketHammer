<?php

namespace App\Http\Controllers\Backoffice\Setting;

use App\Http\Controllers\Controller;
use App\Model\SupplierStatus;
use App\Repositories\SupplierStatus\SupplierStatusRepository;
use Illuminate\Http\Request;

class SupplierStatusController extends Controller
{
    private $supplierStatusRepository;

    public function __construct(SupplierStatusRepository $supplierStatusRepository)
    {
        $this->supplierStatusRepository = $supplierStatusRepository;
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

        $supplierStatuses = $this->supplierStatusRepository->get(json_decode(json_encode($params)));

        return response()->json($supplierStatuses, 200);
    }

    public function store(Request $request)
    {
        $supplierStatus = $this->supplierStatusRepository->create(json_decode(json_encode($request->all())));

        return response()->json($supplierStatus, 200);
    }

    public function update($id, Request $request)
    {
        $supplierStatus = $this->supplierStatusRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($supplierStatus, 200);
    }

    public function destroy($id)
    {
        $this->supplierStatusRepository->delete($id);

        return response()->json([
            'message' => 'Successfully Deleted',
            'status_code' => 200
        ], 200);
    }
}
