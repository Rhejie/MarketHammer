<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Setting\Businesslevel;
use App\Http\Controllers\Controller;
use App\Repositories\Business\BusinessLevelRepository;
use App\Http\Requests\BackOffice\BusinessLevel\{StoreBusinessLevel, UpdateBusinessLevel};

class BusinessLevelController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessLevelRepository
     */
    private $businessLevelRepository;

    public function __construct(BusinessLevelRepository $businessLevelRepository)
    {
        $this->businessLevelRepository = $businessLevelRepository;
    }

    /**
     * This method will return the list of queried business levels
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function index(Request $request)
    {
        $searchString = $request->input('searchString');

        $businessLevels = BusinessLevel::select();

        if ($searchString) {
            $businessLevels->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
            });
        }

        $businessLevels = $businessLevels->with('translations')->orderBy('id', 'DESC')->paginate($request->input('size'));

        //return $businessLevels;
        return response()->json($businessLevels, 200);
    }

    public function store(Request $request)
    {
        /*$newbl = $this->businessLevelRepository->create($request->all());
        //$className = $this->resourceItem();

        //return new $className($newbl);
        return $newbl;
        //return response(null, 204);*/

        $bl = $this->businessLevelRepository->create(json_decode(json_encode($request->all())));

        return response()->json($bl, 200);
    }

    public function show($id)
    {
        $bl = $this->businessLevelRepository->get($id);

        //return response()->json(['bl' => $bl]);
        return $bl;
    }

    public function update($id, Request $request)
    {
        /*$request->validate([
            'name' => 'required|string',
        ]);*/

        $bl = $this->businessLevelRepository->update($id, json_decode(json_encode($request->all())));
        //$complex = $this->complexTypeRepository->updateComplexType($id, $request->all());

        return response()->json($bl, 200);
    }

    public function destroy($id)
    {
        $this->businessLevelRepository->delete($id);

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
