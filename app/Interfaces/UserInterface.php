<?php

namespace App\Interfaces;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserInterface
{
    public function retriveAllUsers() : Collection;
    public function retriveUserById($userId) : User;
    public function createUser(Request $request) : User;
    public function destroyUser($userId);

}
