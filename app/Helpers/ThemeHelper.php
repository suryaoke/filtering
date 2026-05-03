<?php

namespace App\Helpers;

class ThemeHelper
{
  
    public static function current(): string
    {
        return session('theme', request()->cookie('theme', 'light'));
    }

    public static function isDark(): bool
    {
        return static::current() === 'dark';
    }
}
