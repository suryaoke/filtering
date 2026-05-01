<?php

namespace App\Services;

use App\Models\Penjualan;
use App\Repositories\Contracts\PenjualanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PenjualanService
{
    public function __construct(
        protected PenjualanRepositoryInterface $penjualanRepository
    ) {}

    /**
     * Ambil list penjualan dengan filter dan pagination.
     */
    public function list(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->penjualanRepository->getAllPaginated($perPage, $filters);
    }

    /**
     * Ambil detail penjualan.
     */
    public function show(int $id): Penjualan
    {
        return $this->penjualanRepository->findOrFail($id);
    }

    /**
     * Buat penjualan baru.
     */
    public function create(array $data): Penjualan
    {
        $data['tanggal_input'] = $data['tanggal_input'] ?? now();

        return $this->penjualanRepository->create($data);
    }

    /**
     * Update penjualan.
     */
    public function update(int $id, array $data): Penjualan
    {
        return $this->penjualanRepository->update($id, $data);
    }

    /**
     * Hapus penjualan.
     */
    public function delete(int $id): bool
    {
        return $this->penjualanRepository->delete($id);
    }

    /**
     * Hitung total penjualan.
     */
    public function count(): int
    {
        return $this->penjualanRepository->count();
    }
}
