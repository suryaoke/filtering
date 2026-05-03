<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Followup;
use App\Interfaces\DashboardRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getStats(): array
    {
        return [
            'total_sales'    => Sale::count(),
            'total_products' => Product::count(),
            'total_users'    => User::count(),
            'total_followups'=> Followup::count(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getRecentSales(int $limit = 5): Collection
    {
        return Sale::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusDistribution(): array
    {
        return Followup::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }
}
