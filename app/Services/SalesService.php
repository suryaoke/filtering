<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\Contracts\SalesRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SalesService
{
    public function __construct(
        protected SalesRepositoryInterface $salesRepository
    ) {}

    /**
     * Get list of sales with filter and pagination.
     */
    public function list(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->salesRepository->getAllPaginated($perPage, $filters);
    }

    /**
     * Get data for DataTables.
     */
    public function getDataTable(array $filters = [])
    {
        $query = $this->salesRepository->getDataTableQuery($filters);

        return \Yajra\DataTables\DataTables::of($query)
            ->addColumn('action', function($row) {
                return view('sales.actions', compact('row'))->render();
            })
            ->editColumn('input_date', function($row) {
                return $row->input_date ? $row->input_date->format('d M Y') : '-';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Get sale details.
     */
    public function show(int $id): Sale
    {
        return $this->salesRepository->findOrFail($id);
    }

    /**
     * Create new sale.
     */
    public function create(array $data): Sale
    {
        $data['input_date'] = $data['input_date'] ?? now();

        return $this->salesRepository->create($data);
    }

    /**
     * Update sale.
     */
    public function update(int $id, array $data): Sale
    {
        return $this->salesRepository->update($id, $data);
    }

    /**
     * Delete sale.
     */
    public function delete(int $id): bool
    {
        return $this->salesRepository->delete($id);
    }

    /**
     * Count total sales.
     */
    public function count(): int
    {
        return $this->salesRepository->count();
    }
}
