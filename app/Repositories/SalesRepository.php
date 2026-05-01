<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\Contracts\SalesRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SalesRepository implements SalesRepositoryInterface
{
    public function __construct(
        protected Sale $model
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getDataTableQuery(array $filters = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->model->newQuery()->with(['user', 'product']);

        // Search by company_name, contact_name, email
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by product
        if (!empty($filters['product_id'])) {
            $query->where('product_id', $filters['product_id']);
        }

        // Filter by industry
        if (!empty($filters['industry'])) {
            $query->where('industry', $filters['industry']);
        }

        // Filter by source
        if (!empty($filters['source'])) {
            $query->where('source', $filters['source']);
        }

        // Filter by user_id
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Filter by date range
        if (!empty($filters['date_from'])) {
            $query->whereDate('input_date', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('input_date', '<=', $filters['date_to']);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->getDataTableQuery($filters);

        // Sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDir = $filters['sort_dir'] ?? 'desc';
        $allowedSorts = ['company_name', 'contact_name', 'industry', 'input_date', 'created_at'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?Sale
    {
        return $this->model->with(['user', 'product'])->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail(int $id): Sale
    {
        return $this->model->with(['user', 'product'])->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Sale
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): Sale
    {
        $sale = $this->findOrFail($id);
        $sale->update($data);

        return $sale->fresh('user');
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): bool
    {
        $sale = $this->findOrFail($id);

        return $sale->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return $this->model->count();
    }
}
