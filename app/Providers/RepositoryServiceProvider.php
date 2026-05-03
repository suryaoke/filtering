<?php

namespace App\Providers;

use App\Repositories\Contracts\SalesRepositoryInterface;
use App\Repositories\SalesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All repository bindings.
     *
     * @var array<string, string>
     */
    protected array $repositories = [
        SalesRepositoryInterface::class => SalesRepository::class,
        \App\Interface\ProductRepositoryInterface::class => \App\Repositories\ProductRepository::class,
        \App\Interface\AuthRepositoryInterface::class => \App\Repositories\AuthRepository::class,
        \App\Repositories\Contracts\DashboardRepositoryInterface::class => \App\Repositories\DashboardRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
