<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Interface\AuthRepositoryInterface;
use App\Interface\ProductRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Daftarkan helper theme
        $this->app->singleton('theme', function () {
            return new \App\Helpers\ThemeHelper();
        });

        // ── Binding Repository ──────────────────────────────────────────────
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );
    }

    public function boot(): void
    {
        // ── Blade Directive: @theme ─────────────────────────────────────────
        Blade::directive('theme', function () {
            return "<?php echo session('theme', request()->cookie('theme', 'light')); ?>";
        });

        // ── Blade Directive: @isDark ────────────────────────────────────────
        Blade::directive('isDark', function () {
            return "<?php if (session('theme', request()->cookie('theme', 'light')) === 'dark'): ?>";
        });
        Blade::directive('endIsDark', function () {
            return "<?php endif; ?>";
        });

        // ── Blade Directive: @isLight ───────────────────────────────────────
        Blade::directive('isLight', function () {
            return "<?php if (session('theme', request()->cookie('theme', 'light')) === 'light'): ?>";
        });
        Blade::directive('endIsLight', function () {
            return "<?php endif; ?>";
        });
    }
}
