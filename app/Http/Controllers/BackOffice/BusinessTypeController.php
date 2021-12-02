<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\BusinessType;
use App\Repositories\BusinessType\BusinessTypeRepository;

class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $businessTypes = (new BusinessTypeRepository())->getBusinessTypes(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['businessTypes' => $businessTypes]);
        }

        return view('backoffice.businessType.index', compact('businessTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(!isset($request->id));
        if (!isset($request->id)) {
            $exists = BusinessType::where('name', $request->name)->where('code', $request->code)->first();
        } else {
            $exists = BusinessType::where('name', $request->name)->where('code', $request->code)->where('id', '<>', $request->id)->first();
        }

        if ($exists != null) {
            return response()->json(['success' => false,'msg' => 'Business type already exists.']);
        }

        $newBusinessType = (new BusinessTypeRepository())->saveBusinessType(json_decode(json_encode($request->all())));

        return response()->json(['success' => $newBusinessType,'msg' => '']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $success = false;
        \DB::beginTransaction();

        try {
            $success = (new BusinessTypeRepository())->destroyBusinessType($id);
            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response()->json(['success' => $success]);
    }


}
