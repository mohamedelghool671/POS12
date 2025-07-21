<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\UserDashboardRepositoryInterface;

class UserDashboardService
{
    protected $userDashboardRepository;

    public function __construct(UserDashboardRepositoryInterface $userDashboardRepository)
    {
        $this->userDashboardRepository = $userDashboardRepository;
    }

    public function getDashboardData()
    {
        return $this->userDashboardRepository->getDashboardData();
    }

    public function updateProfile(User $user, array $data)
    {
        return $this->userDashboardRepository->updateProfile($user, $data);
    }

    public function changeUserPassword(User $user, $newPassword)
    {
        return $this->userDashboardRepository->changeUserPassword($user, $newPassword);
    }

    public function sendMessage(User $user, array $data)
    {
        return $this->userDashboardRepository->sendMessage($user, $data);
    }
}
