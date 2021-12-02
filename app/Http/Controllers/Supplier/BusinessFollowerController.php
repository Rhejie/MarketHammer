<?php

namespace App\Http\Controllers\Supplier;

use App\Repositories\Business\BusinessFollowerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessFollowerController extends Controller
{
    public function __construct(BusinessFollowerRepository $businessFollowerRepository)
    {
        $this->businessFollowerRepository = $businessFollowerRepository;
    }

    public function store(Request $request)
    {
        $qsa_list = $this->businessFollowerRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function show($id)
    {
        $qsa_list = $this->businessFollowerRepository->show($id);
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function update(Request $request, $id)
    {
        $qsa_list = $this->businessFollowerRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($qsa_list);
    }

    public function destroy($id)
    {
        $qsa_list = $this->businessFollowerRepository->delete($id);
        return $qsa_list;
    }

    public function follow(Request $request)
    {
        $follower = $this->businessFollowerRepository->follow($request);
        $className = $this->resourceItem();

        return new $className($follower);
    }

     /**
     * Get list of follower.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getList(Request $request)
    {
        
        $list = $this->businessFollowerRepository->getList($request);

        //return ['list' => $list];
        return response()->json($list, 200);
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

}
