<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changeStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->status == 'active') {
            $user->status = 'active';
        } else if ($request->status == 'inactive') {
            $user->status = 'inactive';
        } else {
            return response()->json([
                'message' => 'Invalid status'
            ], 400);
        }

        $user->save();

        return response()->json([
            'message' => 'User status updated successfully'
        ], 200);
    }

    public function index()
    {
        $users = User::all();

        return response()->json([
            'data' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }


}