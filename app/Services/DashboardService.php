<?php

namespace App\Services;

use App\Interface\DashboardRepositoryInterface;

class DashboardService
{
    public function __construct(
        protected DashboardRepositoryInterface $dashboardRepository
    ) {}

    /**
     * Ambil semua data untuk halaman dashboard.
     */
    public function getDashboardData(): array
    {
        return [
            'stats'        => $this->dashboardRepository->getStats(),
            'recentSales'  => $this->dashboardRepository->getRecentSales(),
            'distribution' => $this->dashboardRepository->getStatusDistribution(),
        ];
    }
}
