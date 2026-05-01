<?php

namespace App\Repositories\Contracts;

use App\Models\Sale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SalesRepositoryInterface
{
    /**
     * Get all sales with pagination, search, and filter.
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Get query builder for DataTables.
     */
    public function getDataTableQuery(array $filters = []): \Illuminate\Database\Eloquent\Builder;

    /**
     * Find sale by ID.
     */
    public function findById(int $id): ?Sale;

    /**
     * Find sale by ID or fail.
     */
    public function findOrFail(int $id): Sale;

    /**
     * Create new sale.
     */
    public function create(array $data): Sale;

    /**
     * Update sale.
     */
    public function update(int $id, array $data): Sale;

    /**
     * Delete sale.
     */
    public function delete(int $id): bool;

    /**
     * Count total sales.
     */
    public function count(): int;
}
