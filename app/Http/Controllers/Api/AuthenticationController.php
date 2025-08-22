<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request) {
        $credential = $request->validate([
            'user' => 'required|max:255',
            'pass' => 'required',
        ]);
        $credentials['username'] = $credential['user'];
        $credentials['password'] = 'L@nd4cC3sS' . $credential['pass'];
        if (Auth::attempt($credentials)) {
            // success
            $user = User::find(Auth::user()->id);
            $user_token['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200);
        } else {
            // failed
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate',
            ], 401);
        }
    }

    public function chksess(Request $request) {
        if (Auth::user()) {
            return response()->json([
                'success' => true,
                'message' => 'Session is valid'
            ], 200);
        }
    }

    public function destroy(Request $request) {
        if (Auth::user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }
    }
}
