<?php

namespace App\Repositories\Contracts;

use App\Models\Penjualan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PenjualanRepositoryInterface
{
    /**
     * Ambil semua penjualan dengan pagination, search, dan filter.
     */
    public function getAllPaginated(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Cari penjualan berdasarkan ID.
     */
    public function findById(int $id): ?Penjualan;

    /**
     * Cari penjualan berdasarkan ID atau gagal (404).
     */
    public function findOrFail(int $id): Penjualan;

    /**
     * Simpan penjualan baru.
     */
    public function create(array $data): Penjualan;

    /**
     * Update penjualan.
     */
    public function update(int $id, array $data): Penjualan;

    /**
     * Hapus penjualan.
     */
    public function delete(int $id): bool;

    /**
     * Hitung total penjualan.
     */
    public function count(): int;
}
