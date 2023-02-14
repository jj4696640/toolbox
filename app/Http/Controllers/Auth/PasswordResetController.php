<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendPasswordReset(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $response = Password::broker()->sendResetLink(['email' => $user->email]);

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error sending password reset link'
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $user = User::where('email', $request->input('email'))->first();

            $user->password = bcrypt($request->input('password'));

            $user->save();

            return response()->json([
                'message' => 'Password reset successfully'
            ], 200);

        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}