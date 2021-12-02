<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Certification\CertificationHolderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(CertificationHolderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;

        $params = [
            'count' => $count,
            'search' => $search
        ];

        $certificationHolder = (new CertificationHolderRepository(new \App\Model\CertificationHolder))->getAll(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['certificationHolder' => $certificationHolder]);
        }

        return view('backoffice.certificationHolder.index', compact('certificationHolder'));
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
        //$newCertificationHolder = (new CertificationHolderRepository())->store(json_decode(json_encode($request->all())));

        $newCertificationHolder = $this->repository->store($request->all());
        return response()->json($newCertificationHolder, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificationHolder = $this->repository->show($id)->loadMissing(['translations']);

        return response()->json(['certificationHolder' => $certificationHolder]);
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
        //$updatedCertificationHolder = (new CertificationHolderRepository())->update($id, json_decode(json_encode($request->all())));
        $updatedCertificationHolder = $this->repository->update($request->all(), $id);

        return response()->json($updatedCertificationHolder, 200);
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
            $deleteCertificationHolder = $this->repository->destroy($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }

}
