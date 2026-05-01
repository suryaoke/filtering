<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Daftarkan helper theme
        $this->app->singleton('theme', function () {
            return new \App\Helpers\ThemeHelper();
        });

        // ── Binding Repository ──────────────────────────────────────────────
        // Tambah binding repository pattern di sini:
        // $this->app->bind(
        //     \App\Repositories\Interfaces\UserRepositoryInterface::class,
        //     \App\Repositories\Eloquent\EloquentUserRepository::class,
        // );
    }

    public function boot(): void
    {
        // ── Blade Directive: @theme ─────────────────────────────────────────
        // Pemakaian di Blade: @theme  → menghasilkan 'dark' atau 'light'
        Blade::directive('theme', function () {
            return "<?php echo session('theme', request()->cookie('theme', 'light')); ?>";
        });

        // ── Blade Directive: @isDark ────────────────────────────────────────
        // Pemakaian: @isDark ... @endIsDark
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
