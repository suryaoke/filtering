<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\User;
use App\Services\PenjualanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenjualanController extends Controller
{
    public function __construct(
        protected PenjualanService $penjualanService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filters = $request->only([
            'search', 'status_filter', 'industri', 'sumber_data',
            'user_id', 'tanggal_dari', 'tanggal_sampai',
            'sort_by', 'sort_dir',
        ]);

        $perPage = $request->integer('per_page', 15);
        $penjualans = $this->penjualanService->list($perPage, $filters);
        $users = User::select('id', 'nama')->orderBy('nama')->get();

        return view('penjualan.index', compact('penjualans', 'filters', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::select('id', 'nama')->orderBy('nama')->get();

        return view('penjualan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenjualanRequest $request): RedirectResponse
    {
        $this->penjualanService->create($request->validated());

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $penjualan = $this->penjualanService->show($id);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $penjualan = $this->penjualanService->show($id);
        $users = User::select('id', 'nama')->orderBy('nama')->get();

        return view('penjualan.edit', compact('penjualan', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenjualanRequest $request, int $id): RedirectResponse
    {
        $this->penjualanService->update($id, $request->validated());

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->penjualanService->delete($id);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus.');
    }
}
