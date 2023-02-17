<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Try to create a new user or return an error
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string',
                'second_name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'telephone' => 'nullable|string',
                'force_number' => 'required|string|unique:users',
                'region' => 'required|string',
                'station' => 'required|string',
                'rank' => 'required|string',
                'directorate' => 'required|string',
                'office_role' => 'required|string',
                'password' => 'required|string|confirmed',
            ]);
    
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'second_name' => $validatedData['second_name'],
                'other_name' => $validatedData['other_name'] ?? null,
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'] ?? null,
                'force_number' => $validatedData['force_number'],
                'region' => $validatedData['region'],
                'station' => $validatedData['station'],
                'rank' => $validatedData['rank'],
                'directorate' => $validatedData['directorate'],
                'office_role' => $validatedData['office_role'],
                'password' => bcrypt($validatedData['password']),
            ]);
    
            // $this->sendEmailVerification($user);
    
            return response()->json([
                'status' => true,
                'message' => 'Successfully created user!',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function sendEmailVerification($user)
    {
        Mail::to($user->email)->send(new VerifyEmail($user));
    }

}
