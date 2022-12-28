<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Invalid Credentials'
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 200,
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function store(UserStoreRequest $request)
    {
        if ($request->validated()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'token' => $token,
                'user' => $user,
            ]);
        }
        return response()->json([
            'status' => 422,
            'message' => 'Invalid Input',
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out'
        ]);
    }
}
