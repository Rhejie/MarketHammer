<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{

    public function redirectAuth(Request $request)
    {
        $this->validate($request, [
            'token' => "required",
            'expired_at' => "required",
            'email' => "required",
        ]);

        $decryptedToken = decrypt($request['token'], true);
        $this->validateParams($decryptedToken);

        $userExists = User::query()
            ->where('id', $decryptedToken['user_id'])
            ->where('email', $request['email'])
            ->exists();

        if (!$userExists) {
            abort(403, "Invalid Token");
        }

        Auth::loginUsingId($decryptedToken['user_id']);

        //check the key force_redirect_to
        if ($request->has('force_redirect_to') && $request['force_redirect_to'] !== "") {
            // force to redirect based on force_redirect_to key;
            return redirect()->away($request['force_redirect_to']);
        }
        // default redirect
        return redirect("/");
    }

    public function revokeAuth(Request $request)
    {
        auth()->logout();

        if ($request->has('force_redirect_to')) {
            return redirect()->away($request['force_redirect_to']);
        }

        return redirect("/");

    }

    private function validateParams($decryptedToken)
    {
        if (!isset($decryptedToken['user_id'])) {
            abort(403, "Invalid Token");
        }
        $dateTime = Carbon::parse((int) request()['created_at']);
        if (Carbon::parse($dateTime)->gte(now())) {
            abort(403, "Token expired.");
        }
    }
}
