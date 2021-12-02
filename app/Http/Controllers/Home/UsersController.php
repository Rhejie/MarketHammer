<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Model\User;
use App\Model\UserAddresses;

class UsersController extends Controller
{
    public function importProfilePicture(Request $request) {
        // $businessId = $request->businessID ? $request->businessID : null;
        // dd($request->all());
        // 1. upload image to storage
        $imageFile = (new UserRepository())->importImage($request->file('file'));

        return response()->json(['imageFile' => $imageFile]);
    }

    public function getLoggedUser(Request $request)
    {
    	$id = isset($request->id) && $request->id != null ? $request->id : auth()->id(); 

    	$loggedinuser = User::with('userAddress.country')->with(['userType', 'events.event', 'coupons.coupon'])->where('id', $id)->first();
        // dd($loggedinuser);
    	return response()->json(['user' => $loggedinuser]);
    }

    public function saveProfile(Request $request)
    {
    	// dd($request);
    	$user = User::find($request->id);
    	$user->firstName = $request->firstName;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->birthDay = $request->birthDay;
    	$saveProfile = $user->save();

    	if ($saveProfile) {
    		if ($user->userAddressID == null) {
	    		$address = new UserAddresses;
	    	} else {
	    		$address = UserAddresses::find($request->userAddressID);
	    	}
	    	// dd($request->user_address->city);
	    	$address->city = $request->user_address['city'];
	    	$address->countryID = $request->user_address['countryID'];
	    	$address->state = $request->user_address['state'];
	    	$address->street = $request->user_address['street'];
	    	$address->brgy = $request->user_address['brgy'];
	    	$address->region = $request->user_address['region'];
	    	$address->zip = 123123;
	    	$saveAddress = $address->save();
    	}

    	if ($saveAddress) {
    		$success = true;
    		if ($user->userAddressID == null) {
    			$user->userAddressID = $address->id;
    			$save = $user->save();

    			$success = $save ? true : false;
    		}
    		
    	} else {
    		$success = false;
    	}

    	return response()->json(['success' => $saveAddress]);
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        if (Auth::check()) {
            $request_data = $request->all();
            $current_password = Auth::user()->password;

            if(Hash::check($request_data['oldPassword'], $current_password)){             
                $user = User::find(Auth::id());
                $user->password = Hash::make($request_data['password']);
                $changePass = $user->save();
            } else {
                return response()->json(['success' => false, 'msg' => 'Password doesn\'t match our records.']);
            }

            return response()->json(['success' => $changePass, 'msg' => null]);
        }
        
    }
}
