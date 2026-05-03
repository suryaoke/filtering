<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Interface\SalesRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SalesService
{
    public function __construct(
        protected SalesRepositoryInterface $salesRepository
    ) {}

    public function list(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->salesRepository->getAllPaginated($perPage, $filters);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->salesRepository->getDataTableQuery($filters);

        return \Yajra\DataTables\DataTables::of($query)
            ->addColumn('action', function ($row) {
                return view('sales.actions', compact('row'))->render();
            })
            ->editColumn('input_date', function ($row) {
                return $row->input_date ? $row->input_date->format('d M Y') : '-';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(int $id): Sale
    {
        return $this->salesRepository->findOrFail($id);
    }

    public function create(array $data): Sale
    {
       
        return $this->salesRepository->create($data);
    }

    public function update(int $id, array $data): Sale
    {
        return $this->salesRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->salesRepository->delete($id);
    }

    public function count(): int
    {
        return $this->salesRepository->count();
    }

   
    public function getFormOptions(): array
    {
        return [
            'users' => User::select('id', 'name')
                ->orderBy('name')
                ->get(),

            'products' => Product::select('id', 'name')
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
        ];
    }
}