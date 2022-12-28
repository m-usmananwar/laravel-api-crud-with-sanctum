<?php

namespace App\Inerfaces;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

interface UserInterface
{
    public function index();
    public function store(UserStoreRequest $request);
    public function show(User $user);
    public function update(Request $request, User $user);
    public function destroy(User $user);
}
