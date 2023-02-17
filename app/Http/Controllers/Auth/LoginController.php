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
            'status' => false,
            'message' => 'User not found'
        ]);
    }

    // if (!$user->email_verified_at) {
    //     return response()->json([
    //         'message' => 'Email not verified'
    //     ], 401);
    // }

    if (!Hash::check($password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Incorrect password/username'
        ]);
    }

    $token = $user->createToken('AuthToken')->plainTextToken;

    return response()->json([
        'status' => true,
        'token' => $token,
        'user' => $user
    ]);
}

}
