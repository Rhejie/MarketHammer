<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController;
use \DB;
use Dotenv\Regex\Success;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserFollowerRepository;

class UserController extends APIController
{

    public function __construct(UserRepository $repo, UserFollowerRepository $userFollowerRepository)
    {
        $this->repo = $repo;
        $this->userFollowerRepository = $userFollowerRepository;
    }

    public function follow(Request $request)
    {
        $follower = $this->userFollowerRepository->follow($request);
        $className = $this->resourceItem();

        return new $className($follower);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\DefaultCollection::class;
    }
}
