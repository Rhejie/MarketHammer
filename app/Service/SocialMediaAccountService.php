<?php
namespace App\Service;

use App\Model\SocialMediaAccount;
use App\Model\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Support\Facades\Hash;
class SocialMediaAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $type)
    {

        $account = SocialMediaAccount::whereProvider($type)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialMediaAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                date_default_timezone_set('UTC');
                $currentDate = date('Y-m-d H:i:s');
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'firstName' => $providerUser->getName(),
                    'lastName' => "",
                    'password' => Hash::make(rand(10000,1000000)),
                    'createdFromSocial' => 'facebook',
                    'is_confirmed' => 1,
                    'phone' => NULL,
                    'email_verified_at' => $currentDate
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}