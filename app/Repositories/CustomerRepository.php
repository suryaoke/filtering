<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(
        protected Customer $model
    ) {}

    public function getDataTableQuery(array $filters = []): Builder
    {
        $query = $this->model->query();

        if (isset($filters['search']['value'])) {
            $search = $filters['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->getDataTableQuery($filters)->paginate($perPage);
    }

    public function findById(int $id): ?Customer
    {
        return $this->model->find($id);
    }

    public function findOrFail(int $id): Customer
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Customer
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Customer
    {
        $customer = $this->findOrFail($id);
        $customer->update($data);
        return $customer->fresh();
    }

    public function delete(int $id): bool
    {
        $customer = $this->findOrFail($id);
        return $customer->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
