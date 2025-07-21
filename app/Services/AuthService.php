<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function changePassword(User $user, $newPassword)
    {
        return $this->authRepository->changePassword($user, $newPassword);
    }

    public function resetPassword(User $user)
    {
        return $this->authRepository->resetPassword($user);
    }
}
