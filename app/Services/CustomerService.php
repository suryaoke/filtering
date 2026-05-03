<?php

namespace App\Services;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Yajra\DataTables\DataTables;

class CustomerService
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository
    ) {}

    public function list(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->customerRepository->getAllPaginated($perPage, $filters);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->customerRepository->getDataTableQuery($filters);

        return DataTables::of($query)
            ->addColumn('action', function($row) {
                return view('customers.actions', compact('row'))->render();
            })
            ->editColumn('gender', function($row) {
                return ucfirst($row->gender);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(int $id): Customer
    {
        return $this->customerRepository->findOrFail($id);
    }

    public function create(array $data): Customer
    {
        return $this->customerRepository->create($data);
    }

    public function update(int $id, array $data): Customer
    {
        return $this->customerRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->customerRepository->delete($id);
    }
}
