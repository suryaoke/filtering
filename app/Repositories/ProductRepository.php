<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        protected Product $model
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getDataTableQuery(array $filters = []): Builder
    {
        $query = $this->model->newQuery();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->getDataTableQuery($filters);

        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDir = $filters['sort_dir'] ?? 'desc';
        $allowedSorts = ['name', 'sku', 'price', 'stock', 'created_at'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail(int $id): Product
    {
        return $this->model->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Product
    {
        DB::beginTransaction();
        try {
            $product = $this->model->create($data);
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): Product
    {
        $product = $this->findOrFail($id);
        $product->update($data);
        return $product;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): bool
    {
        $product = $this->findOrFail($id);
        return $product->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return $this->model->count();
    }
}
