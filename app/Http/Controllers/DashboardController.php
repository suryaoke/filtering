<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    /**
     * Tampilkan halaman dashboard.
     */
    public function index(): View
    {
        $data = $this->dashboardService->getDashboardData();

        return view('dashboard.index', $data);
    }
}
