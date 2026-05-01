<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\User;
use App\Models\Product;
use App\Services\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $salesService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filters = $request->only([
                'search', 'status', 'industry', 'source',
                'user_id', 'date_from', 'date_to'
            ]);
            return $this->salesService->getDataTable($filters);
        }

        $users = User::select('id', 'name')->orderBy('name')->get();
        $products = Product::select('id', 'name')->where('is_active', true)->orderBy('name')->get();

        return view('sales.index', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $sale = $this->salesService->create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data added successfully.',
                'data'    => $sale
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $sale = $this->salesService->show($id);

        if (request()->ajax()) {
            return response()->json($sale);
        }

        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $sale = $this->salesService->show($id);

        if (request()->ajax()) {
            return response()->json($sale);
        }

        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, int $id)
    {
        $sale = $this->salesService->update($id, $request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data updated successfully.',
                'data'    => $sale
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->salesService->delete($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data deleted successfully.'
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data deleted successfully.');
    }
}
