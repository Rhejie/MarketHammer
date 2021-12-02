<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\MachineType;
use App\Repositories\Machine\MachineTypeRepository;

class MachineTypeController extends Controller
{
    private $machineTypeRepository;

    public function __construct(MachineTypeRepository $machineTypeRepository)
    {
        $this->machineTypeRepository = $machineTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $type = $this->machineTypeRepository->typeList(json_decode(json_encode($params)));

        if ($request->ajax()) {
            return response()->json(['type' => $type]);
        }

        return view('backoffice.machine.type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$newIndustryType = $this->machineTypeRepository->storeType(json_decode(json_encode($request->all())));
        $machineType = $this->machineTypeRepository->storeType($request->all());
        // return response(null, 204);
        return response()->json($machineType, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industryType = $this->machineTypeRepository->showType($id);

        return response()->json(['industryType' => $industryType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$updatedIndustryType = $this->machineTypeRepository->updateType($id, json_decode(json_encode($request->all())));
        $updatedMachineType = $this->machineTypeRepository->updateType($request->all(), $id);
        // return response(null, 204);
        return response()->json($updatedMachineType, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();

        try {
            $deleteIndustryType = $this->machineTypeRepository->destroyType($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }
}
