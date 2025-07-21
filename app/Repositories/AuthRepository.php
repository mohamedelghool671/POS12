<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function changePassword(User $user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
        return $user;
    }

    public function resetPassword(User $user)
    {
        $user->password = Hash::make('Password123');
        $user->save();
        return $user;
    }
}
