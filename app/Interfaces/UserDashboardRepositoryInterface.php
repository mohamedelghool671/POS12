<?php

namespace App\Interfaces;

use App\Models\User;

interface UserDashboardRepositoryInterface
{
    public function getDashboardData();
    public function updateProfile(User $user, array $data);
    public function changeUserPassword(User $user, $newPassword);
    public function sendMessage(User $user, array $data);
}
