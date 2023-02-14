<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $user = User::where('email', $email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    // if (!$user->email_verified_at) {
    //     return response()->json([
    //         'message' => 'Email not verified'
    //     ], 401);
    // }

    if (!Hash::check($password, $user->password)) {
        return response()->json([
            'message' => 'Incorrect password'
        ], 401);
    }

    $token = $user->createToken('AuthToken')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ], 200);
}

}
