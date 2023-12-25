<?php

namespace App\Interfaces;


use Illuminate\Http\Client\Request;

interface RoleInterface
{
    public function retriveAllRoles();
    public function rolesArchived();
    public function getRoleById($roleID);
    public function getAllPermissions();
    public function createRole(Request $request);
    public function updateRole($roleID , Request $request);
    public function deleteRole($roleID);
}
