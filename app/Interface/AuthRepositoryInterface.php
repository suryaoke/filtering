<?php

namespace App\Interface;

interface AuthRepositoryInterface
{
    public function login(array $data): bool;

    public function logout(): void;
}