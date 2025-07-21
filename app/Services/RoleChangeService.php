<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\RoleChangeRepositoryInterface;

class RoleChangeService
{
    protected $roleChangeRepository;

    public function __construct(RoleChangeRepositoryInterface $roleChangeRepository)
    {
        $this->roleChangeRepository = $roleChangeRepository;
    }

    public function adminList($searchKey = null)
    {
        return $this->roleChangeRepository->adminList($searchKey);
    }

    public function userList($searchKey = null)
    {
        return $this->roleChangeRepository->userList($searchKey);
    }

    public function deleteAdminAccount(User $user)
    {
        return $this->roleChangeRepository->deleteAdminAccount($user);
    }

    public function changeAdminRole(User $user)
    {
        return $this->roleChangeRepository->changeAdminRole($user);
    }

    public function changeUserRole(User $user)
    {
        return $this->roleChangeRepository->changeUserRole($user);
    }
}
