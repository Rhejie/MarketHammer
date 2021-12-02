<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\IndustryType\StoreIndustryTypeRequest;
use App\Http\Requests\BackOffice\IndustryType\UpdateIndustryTypeRequest;
use App\Repositories\IndustryType\IndustryTypeRepository;
use Illuminate\Http\Request;

class IndustryTypeController extends Controller
{
    public function __construct(IndustryTypeRepository $repository)
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

        if ($request->ajax()) {
            $industryTypes = (new IndustryTypeRepository(new \App\Model\IndustryType))->getIndustryTypes(json_decode(json_encode($params)));

            return response()->json(['industryTypes' => $industryTypes]);
        }

        return view('backoffice.industryType.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndustryTypeRequest $request)
    {
        $newIndustryType = $this->repository->create($request->all());

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
        $industryType = $this->repository->get($id)->loadMissing(['translations']);

        return response()->json(['industryType' => $industryType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndustryTypeRequest $request, $id)
    {
        $updatedIndustryType = $this->repository->update($request->all(), $id);

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
            $deleteIndustryType = $this->repository->delete($id);

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }

    /*
        Excel order is {0 = name, 1=description}
    */
    public function importIndustry(Request $request)
    {

        $post = $request->all();
        $items = $post['body'];
        $header = $post['header'];


        $success = false;

        \DB::beginTransaction();

        try {


            foreach ($items as $item) {
                $params = (object) [
                    'name' => $item[$header[0]],
                    'description' => $item[$header[1]]
                ];
                $addIndustryType = (new IndustryTypeRepository())->storeIndustryType($params);
            }
            $success = true;

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response()->json(['success' => $success]);
    }

    public function importTemplate()
    {
        // return response()->download(storage_path("app/public/uploads/Durio-Category.xlsx"));
        return response()->download(storage_path("app/public/uploads/IndustryType.xlsx"));
    }
}
