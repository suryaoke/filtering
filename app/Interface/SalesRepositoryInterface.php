<?php

namespace App\Interface;

use App\Models\Sale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface SalesRepositoryInterface
{
    public function getDataTableQuery(array $filters = []): Builder;

    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function findById(int $id): ?Sale;

    public function findOrFail(int $id): Sale;

    public function create(array $data): Sale;

    public function update(int $id, array $data): Sale;

    public function delete(int $id): bool;

    public function count(): int;
}