<?php

namespace App\Interfaces;

use App\Models\User;

interface RoleChangeRepositoryInterface
{
    public function adminList($searchKey = null);
    public function userList($searchKey = null);
    public function deleteAdminAccount(User $user);
    public function changeAdminRole(User $user);
    public function changeUserRole(User $user);
}
