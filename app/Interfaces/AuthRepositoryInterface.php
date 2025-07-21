<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function changePassword(User $user, $newPassword);
    public function resetPassword(User $user);
}
