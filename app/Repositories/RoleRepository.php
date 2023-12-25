<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Services\Permission;
use App\Services\Role;
use Illuminate\Http\Client\Request;

class RoleRepository implements RoleInterface
{

    public function retriveAllRoles()
    {
        return Role::all();
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function rolesArchived()
    {
        return Role::onlyTrashed();
    }

    public function getRoleById($roleID)
    {
        return Role::findOrFail($roleID);
    }


    public function createRole(Request $request)
    {
        return Role::create(
            ['guard_name' => 'web','name' => $request->input('name')])
            ->syncPermissions($request->input('permissions'));
    }

    public function updateRole($roleID, Request $request)
    {
        $role = $this->getRoleById($roleID);
        $role->update(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));
        return $role;
    }

    public function deleteRole($roleID)
    {
        $role = $this->getRoleById($roleID);
        $role->delete();
    }

}
