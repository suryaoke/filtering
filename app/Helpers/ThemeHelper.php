<?php

// app/Helpers/ThemeHelper.php

namespace App\Helpers;

class ThemeHelper
{
    /**
     * Ambil tema aktif: 'dark' atau 'light'
     */
    public static function current(): string
    {
        // Prioritas: session → cookie → default 'light'
        return session('theme', request()->cookie('theme', 'light'));
    }

    /**
     * Apakah dark mode aktif?
     */
    public static function isDark(): bool
    {
        return static::current() === 'dark';
    }
}
