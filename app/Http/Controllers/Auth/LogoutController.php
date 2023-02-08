<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Not logged in'
            ], 401);
        }

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

}