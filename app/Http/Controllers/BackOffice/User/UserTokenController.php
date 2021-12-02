<?php

namespace App\Http\Controllers\BackOffice\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserTokenRepository;
use App\Http\Requests\BackOffice\User\{StoreUserToken, UpdateUserToken};

class UserTokenController extends Controller
{
    public function __construct(UserTokenRepository $repository)
    {
        $this->repository = $repository; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $passwordClient = \Laravel\Passport\Client::where(['user_id' => $user->id, 'password_client' => 1, 'revoked' => 0])
        ->orderBy('created_at', 'desc')
        ->first();

        if (!$passwordClient) {
            $passwordClient = \Laravel\Passport\Client::where(['password_client' => 1, 'revoked' => 0])
            ->orderBy('created_at', 'desc')
            ->first();
        }

        $passwordClient ? $passwordClient->makeVisible(['secret']) : null;

        return view('passport/index', [
            'passwordClient' => $passwordClient
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BackOffice\User\StoreUserToken  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserToken $request)
    {
    	$token = \DB::table('oauth_access_tokens')
    	->where(['user_id' => auth()->user()->id, 'revoked' => 0])
    	->where('expires_at', '>', __utc_time_now()->format('Y-m-d H:i:s'))
    	->order('created_at', 'desc')->first();

    	$className = $this->resourceItem();

    	if ($token) {
    		\DB::beginTransaction();
	        try {
	            $userToken = $this->repository->create($request->all());

	            if ($userToken) {
	                \DB::commit();

	                return new $className($userToken);
	            }
	        } catch (\Exception $e) {
	            \DB::rollBack();
	            throw $e;
	        }
    	}
    	
    	return response([
    		'success' => false,
    		'code' => 'no_token_found'
    	], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revokeToken($id)
    {
        $token = $this->repository->revokeToken($id);

        return $token;
    }

    public function getPasswordTokens(Request $request)
    {
        return $this->repository->getPasswordTokens();
    }

    public function getPersonalTokens(Request $request)
    {
        return $this->repository->getPersonalTokens();
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\User\UserResource::class;
    }
}
