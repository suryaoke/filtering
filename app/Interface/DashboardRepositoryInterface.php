<?php

namespace App\Interface;

interface DashboardRepositoryInterface
{
   
    public function getStats(): array;

    public function getRecentSales(int $limit = 5): \Illuminate\Support\Collection;

    public function getStatusDistribution(): array;
}
