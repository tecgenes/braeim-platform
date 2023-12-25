<?php

namespace App\Interfaces;


use App\Http\Requests\Web\ProfileChangePasswordRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserInterface
{
    public function retriveAllUsers() : Collection;
    public function retriveUserById($userId) : User;
    public function updateUser($userId, $request);
    public function createUser(Request $request);
    public function destroyUser(Request $request);
    public function changePassword(ProfileChangePasswordRequest $request);

}
