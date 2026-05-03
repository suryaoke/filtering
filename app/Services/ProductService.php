<?php

namespace App\Services;

use App\Interface\ProductRepositoryInterface;
use App\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {}

    public function list(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->productRepository->getAllPaginated($perPage, $filters);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->productRepository->getDataTableQuery($filters);

        return \Yajra\DataTables\DataTables::of($query)
            ->addColumn('action', function($row) {
                return view('products.actions', compact('row'))->render();
            })
            ->editColumn('price', function($row) {
                return '$' . number_format($row->price, 2);
            })
            ->editColumn('is_active', function($row) {
                $class = $row->is_active ? 'text-success' : 'text-danger';
                $text = $row->is_active ? 'Active' : 'Inactive';
                return "<span class='{$class} font-medium'>{$text}</span>";
            })
            ->rawColumns(['action', 'is_active'])
            ->make(true);
    }

    public function show(int $id): Product
    {
        return $this->productRepository->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function update(int $id, array $data): Product
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
