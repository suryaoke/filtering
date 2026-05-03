<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{

    public function getDataTableQuery(array $filters = []): Builder;

    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function findById(int $id): ?Product;

    public function findOrFail(int $id): Product;

    public function create(array $data): Product;

    public function update(int $id, array $data): Product;

    public function delete(int $id): bool;

    public function count(): int;
}
