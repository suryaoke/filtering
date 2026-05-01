<?php

namespace App\Providers;

use App\Repositories\Contracts\PenjualanRepositoryInterface;
use App\Repositories\PenjualanRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All repository bindings.
     *
     * @var array<string, string>
     */
    protected array $repositories = [
        PenjualanRepositoryInterface::class => PenjualanRepository::class,
        \App\Repositories\Contracts\AuthRepositoryInterface::class => \App\Repositories\AuthRepository::class,
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
