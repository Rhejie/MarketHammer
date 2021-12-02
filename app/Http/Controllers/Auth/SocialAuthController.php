<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Service\SocialMediaAccountService;

class SocialAuthController extends Controller
{
  	/**
   	* Create a redirect method to facebook api.
   	*
   	* @return void
   	*/
    public function handleSocialRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function handleSocialCallback($provider)
    {
    	try {
		    $service = new SocialMediaAccountService;
	        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
	        auth()->login($user);
	        return redirect()->to('/');
		}
		catch (\Exception $e) {
		    return redirect()->to('/login');
		}

    	
    }
}
