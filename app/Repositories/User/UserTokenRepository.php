<?php

namespace App\Repositories\User;

use App\Model\User\UserToken;
use App\Repositories\Repository;
use App\Model\Passport\OAuthAccessToken;

class UserTokenRepository extends Repository
{

	/**
     * Instancetiate the class.
     *
     * @param $model <UserToken> - the model class that this repository will be handling
     */
    public function __construct(UserToken $model)
    {
        parent::__construct($model);
    }

    public function getPersonalTokens()
    {	
    	\DB::enableQueryLog();
    	$tokens = \Laravel\Passport\Token::whereRaw(\DB::raw('(client_id IN (SELECT id FROM oauth_clients WHERE revoked = 0 AND personal_access_client = 1))'))
    	->where('revoked', 0)
    	->with(['user' => function ($q) {
    		$q->select()->displayName();
    	}, 'client'])
    	->get()
    	->toArray();

    	return $tokens;
    }
    
    public function getPasswordTokens()
    {	
    	$tokens = \Laravel\Passport\Token::whereRaw(\DB::raw('(client_id IN (SELECT id FROM oauth_clients WHERE revoked = 0 AND password_client = 1))'))
    	->where('revoked', 0)
    	->with(['user' => function ($q) {
    		$q->select()->displayName();
    	}, 'client'])
    	->get()
    	->toArray();

    	return $tokens;
    }

    public function revokeToken($id)
    {
        $token = \Laravel\Passport\Token::find($id);

        if ($token) {
            $updated = $token->update([
                'revoked' => true,
                'updated_at' => __utc_time_now()->format('Y-m-d H:i:s')
            ]);

            $refresh = \Laravel\Passport\RefreshToken::where('access_token_id', $id);

            if ($refresh) {
                $refresh->update([
                    'revoked' => true
                ]);
            }


            return $updated;
        }

        return false;
    }
}