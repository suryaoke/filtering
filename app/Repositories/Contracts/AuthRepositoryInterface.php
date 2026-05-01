<?php

namespace App\Repositories\Contracts;

interface AuthRepositoryInterface
{
    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param array $credentials
     * @param bool $remember
     * @return bool
     */
    public function attemptLogin(array $credentials, bool $remember = false): bool;

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout(): void;
}
