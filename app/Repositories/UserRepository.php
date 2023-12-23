<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserInterface
{

    public function retriveAllUsers(): Collection
    {
       return User::all();
    }

    public function retriveUserById($userId): User
    {
        return User::findOrFail($userId);
    }

    public function createUser(Request $request): User
    {
        return User::create($this->dataEntry($request));
    }

    public function destroyUser($userId)
    {
        User::destroy($userId);
    }

    private function dataEntry(Request $request) : array
    {
        return [
            'email' => $request->input('email'),
            'password' => Hash::make( Str::random(10) )
        ];
    }
}
