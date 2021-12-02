<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Substance\HazardousSubstanceRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HazardousSubstanceController extends Controller
{
    public function __construct(HazardousSubstanceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;

        $params = [
            'count' => $count,
            'search' => $search
        ];

        $hazardousSubstances = (new HazardousSubstanceRepository(new \App\Model\HazardousSubstance))->getHazardousSubstances(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['hazardousSubstances' => $hazardousSubstances]);
        }

        return view('backoffice.hazardousSubstance.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $newHazardousSubstance = $this->repository->create($request->all());

        return response()->json($newHazardousSubstance, 200);
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
        $hazardousSubstance = $this->repository->get($id)->loadMissing(['translations']);

        return response()->json(['hazardousSubstance' => $hazardousSubstance]);
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
        $updatedHazardousSubstance = $this->repository->update($request->all(), $id);

        return response()->json($updatedHazardousSubstance, 200);
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
            $deleteIndustryType = $this->repository->delete($id);

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }

}
