<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->customerService->getDataTable($request->all());
        }

        return view('customers.index');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully.',
                'data'    => $customer
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(int $id)
    {
        $customer = $this->customerService->show($id);
        return response()->json($customer);
    }

    public function edit(int $id)
    {
        $customer = $this->customerService->show($id);
        return response()->json($customer);
    }

    public function update(UpdateCustomerRequest $request, int $id)
    {
        $customer = $this->customerService->update($id, $request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully.',
                'data'    => $customer
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->customerService->delete($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully.'
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
