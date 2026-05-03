<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Services\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $salesService
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->salesService->getDataTable(
                $request->only([
                    'search', 'status', 'industry',
                    'source', 'user_id', 'date_from', 'date_to'
                ])
            );
        }

        $options = $this->salesService->getFormOptions();

        return view('sales.index', $options);
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = $this->salesService->create($request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data added successfully.',
                'data'    => $sale,
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data added successfully.');
    }

    public function show(int $id)
    {
        $sale = $this->salesService->show($id);

        if (request()->ajax()) {
            return response()->json($sale);
        }

        return view('sales.show', compact('sale'));
    }

    public function edit(int $id)
    {
        $sale    = $this->salesService->show($id);
        $options = $this->salesService->getFormOptions();

        if (request()->ajax()) {
            return response()->json($sale);
        }

        return view('sales.edit', compact('sale') + $options);
    }

    public function update(UpdateSaleRequest $request, int $id)
    {
        $sale = $this->salesService->update($id, $request->validated());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data updated successfully.',
                'data'    => $sale,
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->salesService->delete($id);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sale data deleted successfully.',
            ]);
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale data deleted successfully.');
    }
}