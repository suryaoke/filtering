<?php

namespace App\Providers;

use App\Interfaces\SalesRepositoryInterface;
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
        \App\Interfaces\ProductRepositoryInterface::class => \App\Repositories\ProductRepository::class,
        \App\Interfaces\AuthRepositoryInterface::class => \App\Repositories\AuthRepository::class,
        \App\Interfaces\DashboardRepositoryInterface::class => \App\Repositories\DashboardRepository::class,
        \App\Interfaces\CustomerRepositoryInterface::class => \App\Repositories\CustomerRepository::class,
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
