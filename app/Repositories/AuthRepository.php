<?php

namespace App\Repositories;

use App\Interface\AuthRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $data): bool
    {
        DB::beginTransaction();

        try {
            if (!Auth::guard('web')->attempt($data)) {
                throw new Exception('Email atau password salah.');
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}