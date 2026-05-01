<?php

namespace App\Repositories;

use App\Models\Penjualan;
use App\Repositories\Contracts\PenjualanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PenjualanRepository implements PenjualanRepositoryInterface
{
    public function __construct(
        protected Penjualan $model
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery()->with('user');

        // Search by nama_perusahaan, nama_kontak, email
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('nama_kontak', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if (!empty($filters['status_filter'])) {
            $query->where('status_filter', $filters['status_filter']);
        }

        // Filter by industri
        if (!empty($filters['industri'])) {
            $query->where('industri', $filters['industri']);
        }

        // Filter by sumber_data
        if (!empty($filters['sumber_data'])) {
            $query->where('sumber_data', $filters['sumber_data']);
        }

        // Filter by user_id
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Filter by date range
        if (!empty($filters['tanggal_dari'])) {
            $query->whereDate('tanggal_input', '>=', $filters['tanggal_dari']);
        }
        if (!empty($filters['tanggal_sampai'])) {
            $query->whereDate('tanggal_input', '<=', $filters['tanggal_sampai']);
        }

        // Sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDir = $filters['sort_dir'] ?? 'desc';
        $allowedSorts = ['nama_perusahaan', 'nama_kontak', 'industri', 'status_filter', 'tanggal_input', 'created_at'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'asc' ? 'asc' : 'desc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?Penjualan
    {
        return $this->model->with('user')->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail(int $id): Penjualan
    {
        return $this->model->with('user')->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Penjualan
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update(int $id, array $data): Penjualan
    {
        $penjualan = $this->findOrFail($id);
        $penjualan->update($data);

        return $penjualan->fresh('user');
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): bool
    {
        $penjualan = $this->findOrFail($id);

        return $penjualan->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return $this->model->count();
    }
}
