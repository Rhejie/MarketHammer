<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\SystemData\EmployeeCountRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeCountController extends Controller
{
    public function __construct(EmployeeCountRepository $repository)
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

        $employeeCounts = (new EmployeeCountRepository(new \App\Model\EmployeeCount))->getEmployeeCounts(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['employeeCounts' => $employeeCounts]);
        }

        return view('backoffice.systemData.employeeCount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$newEmployeeCount = (new EmployeeCountRepository())->store(json_decode(json_encode($request->all())));
        $newEmployeeCount = $this->repository->store($request->all());

        return response()->json($newEmployeeCount, 200);

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
        //$employeeCount = (new EmployeeCountRepository())->show($id);
        $employeeCount = $this->repository->show($id)->loadMissing(['translations']);

        return response()->json(['employeeCount' => $employeeCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //$updatedEmployeeCount = (new EmployeeCountRepository())->update($id, json_decode(json_encode($request->all())));
        $updatedEmployeeCount = $this->repository->update($request->all(), $id);

        return response()->json($updatedEmployeeCount, 200);

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
            $deleteEmployeeCount = $this->repository->destroy($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }

}
