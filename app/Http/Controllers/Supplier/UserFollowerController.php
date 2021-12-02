<?php

namespace App\Http\Controllers\Supplier;

use App\Repositories\User\UserFollowerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserFollowerController extends Controller
{
    public function __construct(UserFollowerRepository $userFollowerRepository)
    {
        $this->userFollowerRepository = $userFollowerRepository;
    }

    public function store(Request $request)
    {
        $follower = $this->userFollowerRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($follower);
    }

    public function show($id)
    {
        $follower = $this->userFollowerRepository->show($id);
        $className = $this->resourceItem();

        return new $className($follower);
    }

    public function update(Request $request, $id)
    {
        $follower = $this->userFollowerRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($follower);
    }

    public function destroy($id)
    {
        $follower = $this->userFollowerRepository->delete($id);
        return $follower;
    }

    public function follow(Request $request)
    {
        $follower = $this->userFollowerRepository->follow($request);
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
        $list = $this->userFollowerRepository->getList($request);

        return ['list' => $list];
    }
    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

}
