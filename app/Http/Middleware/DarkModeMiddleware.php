<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DarkModeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
       
        if ($request->has('theme')) {
            $theme = $request->input('theme') === 'dark' ? 'dark' : 'light';
            session(['theme' => $theme]);
            cookie()->queue('theme', $theme, 60 * 24 * 365); // 1 tahun
        }

        return $next($request);
    }
}
