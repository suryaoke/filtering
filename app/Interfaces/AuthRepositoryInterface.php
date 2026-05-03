<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $data): bool;

    public function logout(): void;
}
