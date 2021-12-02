<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\UnitOfMeasure;
use App\Repositories\BusinessList\UnitOfMeasureRepository;

class UnitMeasureController extends Controller
{
    public function __construct(UnitOfMeasureRepository $repository)
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
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = (object) [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $unitOfMeasure = $this->repository->unitList($params);

        if ($request->ajax()) {
            return response()->json(['units' => $unitOfMeasure]);
        }

        return view('backoffice.unitOfMeasure.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUnit = $this->repository->create($request->all());

        // return response($newUnit, 204);
        return response()->json($newUnit, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industryType = $this->repository->show($id)->loadMissing('translations');

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
        $updatedUnit = $this->repository->update($request->all(), $id);

        // return response(null, 204);
        return response()->json($updatedUnit, 200);
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
