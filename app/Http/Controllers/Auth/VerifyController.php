<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();
    
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();
    
        return response()->json([
            'message' => 'Email verified successfully'
        ], 200);
    }    

}
