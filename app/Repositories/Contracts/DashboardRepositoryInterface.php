<?php

namespace App\Repositories\Contracts;

interface DashboardRepositoryInterface
{
    /**
     * Get statistics of total data.
     */
    public function getStats(): array;

    /**
     * Get recent sales data.
     */
    public function getRecentSales(int $limit = 5): \Illuminate\Support\Collection;

    /**
     * Get distribution of sales status.
     */
    public function getStatusDistribution(): array;
}
