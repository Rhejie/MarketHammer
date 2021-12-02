<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => "required|email",
            'password' => "required",
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            // Authentication not passed...
            throw ValidationException::withMessages([
                'error_message' => "These credentials do not match our records."
            ]);
        }

        $token = auth()->user()->createToken('Auth Token')->accessToken;

        $data = [
            'token' => encrypt([
                'user_id' => auth()->id(),
            ]),
            'email' => $request['email'],
            'expired_at' => now()->addMinutes(3)->getTimestamp(),
        ];

        if ($request->has('force_redirect_to')) {
            $data['force_redirect_to'] = $request['force_redirect_to'];
        }

        $redirectAuthSession = route('redirect.auth.session', $data);

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'redirect_auth_session' => $redirectAuthSession
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        $redirect = route('revoke.auth.session');
        if ($request->has('force_redirect_to')) {
            $redirect = route('revoke.auth.session', [
                'force_redirect_to' => $request['force_redirect_to']
            ]);
        }
        return response([
            'message' => 'Logged Out',
            'revoke_auth_session' => $redirect,
        ]);
    }

    public function testUser(Request $request)
    {
        return auth()->user();
    }

    public function testUser1(Request $request)
    {
        $app = resolve('test.one')->testTwo();

        dd($app);
    }
}
