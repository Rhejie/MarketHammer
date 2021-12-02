<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\MachineManufacturer;
use App\Repositories\Machine\MachineManufacturerRepository;

class MachineManufacturerController extends Controller
{
    private $machineManufacturerRepository;
    public function __construct(MachineManufacturerRepository $machineManufacturerRepository)
    {
        $this->machineManufacturerRepository = $machineManufacturerRepository;
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

        $manufacturer = $this->machineManufacturerRepository->manufacturerList(json_decode(json_encode($params)));


        if ($request->ajax()) {
            return response()->json(['manufacturer' => $manufacturer]);
        }

        return view('backoffice.machine.manufacturer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$newIndustryType = $this->machineManufacturerRepository->storeManufacturer(json_decode(json_encode($request->all())));
        $newIndustryType = $this->machineManufacturerRepository->storeManufacturer($request->all());
        return response()->json($newIndustryType, 200);
        // return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industryType = $this->machineManufacturerRepository->showManufacturer($id);

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
        //$updatedIndustryType = $this->machineManufacturerRepository->updateManufacturer($id, json_decode(json_encode($request->all())));
        $updatedIndustryType = $this->machineManufacturerRepository->updateManufacturer($request->all(), $id);
        return response()->json($updatedIndustryType, 200);
        // return response(null, 204);
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
            $deleteIndustryType = $this->machineManufacturerRepository->destroyManufacturer($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }
}
