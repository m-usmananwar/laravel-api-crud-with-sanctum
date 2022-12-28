<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UserRepository
{
    public function index()
    {
        return User::all();
    }
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        return $user;
    }
    public function show(User $user)
    {
        //
    }
    public function update(Request $request, User $user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }
}
