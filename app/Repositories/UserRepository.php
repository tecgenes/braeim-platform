<?php

namespace App\Repositories;

use App\Http\Requests\Web\ProfileChangePasswordRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function createUser(Request $request)
    {
        try {
            DB::beginTransaction();
            DB::commit();
            return User::create($this->dataEntry($request));
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception;
        }

    }

    public function updateUser($userId, $request)
    {
        try{
            DB::beginTransaction();
            $user = $this->retriveUserById($userId);
            if ($request->has('roles')){
                $user->assignRole($request->input('roles'));
            }
            $user->update([
                'name' => $request->input("name"),
                "mobile" => $request->input("mobile"),
            ]);
            $user->save();
            DB::commit();
            return redirect()->back()->with(['alert' => __("alert.profile_update")]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['alert' => $exception->getMessage()]);
        }
    }

    public function destroyUser(Request $request)
    {
        try{
            DB::beginTransaction();
            $user = auth()->user();
            if(Hash::check($request->input('current_password'), $user->getAuthPassword()))
            {
                User::destroy($user->getAuthIdentifier());
                DB::commit();
                return redirect()->route('home');
            }
            return redirect()->back()->with(['alert' => __("alert.invaled_old_password")]);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['alert' => $exception]);
        }

    }

    private function dataEntry(Request $request) : array
    {
        return [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make( Str::random(10) )
        ];
    }

    public function changePassword(ProfileChangePasswordRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = auth()->user();
            if (Hash::check( $request->input('old_password'), $user->getAuthPassword() ))
            {
                $user->password = Hash::make($request->input('new_password'));
                $user->save();
                DB::commit();
                return redirect()->back()->with(['alert' => __("alert.password_changed")]);
            }
            return redirect()->back()->with(['alert' => __("alert.invaled_old_password")]);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['alert' => $exception]);
        }
    }
}
