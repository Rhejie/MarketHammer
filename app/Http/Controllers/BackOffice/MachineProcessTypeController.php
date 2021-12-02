<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\MachineProcessType;
use App\Repositories\Machine\MachineProcessTypeRepository;

class MachineProcessTypeController extends Controller
{
    private $machineProcessTypeRepository;
    public function __construct(MachineProcessTypeRepository $machineProcessTypeRepository)
    {
        $this->machineProcessTypeRepository = $machineProcessTypeRepository;
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

        $params = (object) [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $processType = $this->machineProcessTypeRepository->processTypeList(json_decode(json_encode($params)));


        if ($request->ajax()) {
            return response()->json(['processType' => $processType]);
        }

        return view('backoffice.machine.processType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$newIndustryType = $this->machineProcessTypeRepository->storeProcessType(json_decode(json_encode($request->all())));
        $newIndustryType = $this->machineProcessTypeRepository->storeProcessType($request->all());
        // return response(null, 204);
        return response()->json($newIndustryType, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industryType = $this->machineProcessTypeRepository->showProcessType($id);

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
        //$updatedIndustryType = $this->machineProcessTypeRepository->updateProcessType($id, json_decode(json_encode($request->all())));
        $updatedIndustryType = $this->machineProcessTypeRepository->updateProcessType($request->all(), $id);
        // return response(null, 204);
        return response()->json($updatedIndustryType, 200);
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
            $deleteIndustryType = $this->machineProcessTypeRepository->destroyProcessType($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }
}
