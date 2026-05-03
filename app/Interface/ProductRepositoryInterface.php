<?php

namespace App\Interface;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{
    /**
     * Get query for DataTables.
     */
    public function getDataTableQuery(array $filters = []): Builder;

    /**
     * Get all products paginated.
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Find product by ID.
     */
    public function findById(int $id): ?Product;

    /**
     * Find product by ID or throw error.
     */
    public function findOrFail(int $id): Product;

    /**
     * Create new product.
     */
    public function create(array $data): Product;

    /**
     * Update product.
     */
    public function update(int $id, array $data): Product;

    /**
     * Delete product.
     */
    public function delete(int $id): bool;

    /**
     * Count total products.
     */
    public function count(): int;
}
