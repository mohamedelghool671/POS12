<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\RoleChangeRepositoryInterface;

class RoleChangeRepository implements RoleChangeRepositoryInterface
{
    public function adminList($searchKey = null)
    {
        $query = User::select('id', 'name', 'nickname', 'email','phone','address')
            ->whereIn('role', ['superadmin', 'admin']);
        if ($searchKey) {
            $query->where(function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                      ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        $data = $query->paginate(3);
        $userCount = User::where('role','user')->count();
        return compact('data', 'userCount');
    }

    public function userList($searchKey = null)
    {
        $query = User::select('id', 'name', 'nickname', 'email','phone','address')
            ->whereIn('role', ['user']);
        if ($searchKey) {
            $query->where(function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        $data = $query->paginate(3);
        $adminCount = User::whereIn('role', ['superadmin', 'admin'])->count();
        return compact('data', 'adminCount');
    }

    public function deleteAdminAccount(User $user)
    {
        return $user->delete();
    }

    public function changeAdminRole(User $user)
    {
        return $user->update(['role' => 'admin']);
    }

    public function changeUserRole(User $user)
    {
        return $user->update(['role' => 'user']);
    }
}
