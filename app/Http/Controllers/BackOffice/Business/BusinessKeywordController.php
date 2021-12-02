<?php

namespace App\Http\Controllers\BackOffice\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business;
use App\Model\Keyword\BusinessKeyword;
use App\Model\Keyword\GlobalKeyword;
use App\Repositories\Business\BusinessKeywordRepository;

class BusinessKeywordController extends Controller
{
    public function __construct(BusinessKeywordRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $postData = $request->all();
            $postData['created_at'] = __utc_time_now();

            $keyword = $this->repository->create($postData);

            if ($keyword) {
                \DB::commit();

                $className = $this->resourceItem();

                return new $className($keyword);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
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
        //
    }

    public function show($id, Request $request) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keyword = $this->repository->delete($id);

        return $keyword;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    public function getBusinessKeyword($id)
    {
        /*$businessKeyword = BusinessKeyword::whereNull('deleted_at')
            ->with(['globalKeywords'])->where('business_id', $id)->get();*/

        $businessKeyword = BusinessKeyword::join('global_keywords', 'business_keywords.global_keyword_id', '=', 'global_keywords.id')
        ->whereNull('business_keywords.deleted_at')
        ->where('business_keywords.business_id', $id)
        ->get();


        return response()->json($businessKeyword, 200);
    }

    public function addKeyword(Request $request)
    {

        // $request->validate([
        //     'value' => 'required|string'
        // ]);

        // $globalKey = GlobalKeyword::where('name', $request->value)
        //     ->orWhere('lang_ko', $request->value)
        //     ->orWhere('lang_zh', $request->value)
        //     ->orWhere('lang_jp', $request->value)
        //     ->orWhere('lang_de_de', $request->value)->first();

        // if (!empty($globalKey)) {
        //     return response()->json([
        //         'message' => 'Existing already'
        //     ], 200);
        // } else {

        //     GlobalKeyword::create(['name' => $request->value, 'created_by' => auth()->user()->id]);

        //     $g = GlobalKeyword::orderBy('id', 'DESC')->first();

        //     BusinessKeyword::create([
        //         'business_id' => $request->business_id,
        //         'global_keyword_id' => $g->id
        //     ]);

        //     $business_keyword = BusinessKeyword::with('globalKeywords')->orderBy('id', 'DESC')->first();
        // }

        $businessStatus = 'Nope';

        foreach ($request->businessKeywords as $item) {
            if(!is_string($item)) {
                $bk = BusinessKeyword::where('global_keyword_id', $item)->where('business_id', $request->business_id)->first();
                if(empty($bk)) {
                    BusinessKeyword::create([
                        'business_id' => $request->business_id,
                        'global_keyword_id' => $item
                    ]);
                    $businessStatus = 'Added';
                }
            }
            else {
                $gk = GlobalKeyword::where('name', $item)->first();
                if(empty($gk)) {
                    GlobalKeyword::create(['name' => $item, 'created_by' => auth()->user()->id]);
                    $g = GlobalKeyword::orderBy('id', 'DESC')->first();
                    BusinessKeyword::create([
                        'business_id' => $request->business_id,
                        'global_keyword_id' => $g->id
                    ]);
                    $businessStatus = 'Added';
                }
                else {
                    $bk = BusinessKeyword::where('global_keyword_id', $gk->id)->where('business_id', $request->business_id)->first();
                    if(empty($bk)) {
                        BusinessKeyword::create([
                            'business_id' => $request->business_id,
                            'global_keyword_id' => $gk->id
                        ]);
                        $businessStatus = 'Added';
                    }
                }
            }
            //$business_keyword[] = BusinessKeyword::with('globalKeywords')->orderBy('id', 'DESC')->first();
            // $business_keyword[] = BusinessKeyword::join('global_keywords', 'business_keywords.global_keyword_id', '=', 'global_keywords.id')
            // ->orderBy('business_keywords.id', 'DESC')->first();
        }

        return response()->json($businessStatus, 200);
    }

    public function addSelectedKeyword(Request $request)
    {
        // dd($request->all());
        BusinessKeyword::create([
            'business_id' => $request->business_id,
            'global_keyword_id' => $request->global_keyword_id
        ]);

        $bkeyword = BusinessKeyword::with('globalKeywords')->orderBy('id', 'DESC')->first();

        return response()->json(['data' => $bkeyword], 200);
    }
    public function deleteKeyword($id)
    {

        $bk = BusinessKeyword::find($id);

        $bk->delete();

        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }

    public function deleteBusKeyword(Request $request) {
        if(is_string($request->name)) {
            $formGlobal = GlobalKeyword::where('name', $request->name)->first();
            if(!empty($formGlobal)) {
                $businessKeyword = BusinessKeyword::where('business_id', $request->business_id)->where('global_keyword_id', $formGlobal->id)->first();
                if(!empty($businessKeyword)) {
                    $businessKeyword->delete();
                    return response()->json(['message' => 'Deleted successfully'], 200);
                }
                else {
                    return response()->json(['message' => 'No data to be deleted'], 200);
                }
            }
        }
        else {
            $businessKeyword = BusinessKeyword::where('global_keyword_id',$request->name)->where('business_id', $request->business_id)->first();
            if(!empty($businessKeyword)) {
                $businessKeyword->delete();
                return response()->json(['message' => 'Deleted Successfully'], 200);
            }
            else {
                return response()->json(['message' => 'No data to be deleted'], 200);
            }
        }
        return response()->json(['message' => 'No data to be deleted'], 200);
    }
}
