<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProfileChangePasswordRequest;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private UserInterface $userRepo;
    private RoleInterface $roleRepo;
    public function __construct(
        UserInterface $user,
        RoleInterface $role,
    )
    {
        $this->userRepo = $user;
        $this->roleRepo = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepo->retriveAllRoles();
        return view('pages.profile.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->userRepo->updateUser($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->userRepo->destroyUser($request);
    }

    public function changePassword(ProfileChangePasswordRequest $request)
    {
        return $this->userRepo->changePassword($request);
    }
}
