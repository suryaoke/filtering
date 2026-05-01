{{--
    resources/views/layouts/auth.blade.php
    Layout khusus halaman login/register
    Dark mode dikendalikan via class di <html>
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', request()->cookie('theme', 'light')) }}">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    @stack('styles')
</head>
<body class="login">

    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">

            {{-- ═══ Panel Kiri (info — hanya muncul di xl) ═══ --}}
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ url('/') }}" class="-intro-x flex items-center pt-5">
                    <img alt="{{ config('app.name') }}" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">{{ config('app.name') }}</span>
                </a>
                <div class="my-auto">
                    <img alt="{{ config('app.name') }}" class="-intro-x w-1/2 -mt-16"
                         src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        @yield('auth-info-title', 'A few more clicks to sign in to your account.')
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                        @yield('auth-info-subtitle', 'Manage all your e-commerce accounts in one place')
                    </div>
                </div>
            </div>

            {{-- ═══ Panel Kanan (form) ═══ --}}
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    @yield('form')
                </div>
            </div>

        </div>
    </div>

    {{-- Dark Mode Switcher --}}
    <x-dark-mode-switcher />
{{-- Dark Mode Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var switcher = document.getElementById('dark-mode-switcher');
            if (!switcher) return;

            switcher.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                fetch('/theme/toggle', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({})
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    var html   = document.documentElement;
                    var toggle = document.getElementById('dm-toggle');
                    var isDark = data.theme === 'dark';

                    html.classList.toggle('dark', isDark);
                    html.classList.toggle('light', !isDark);

                    if (toggle) {
                        toggle.classList.toggle('dark-mode-switcher__toggle--active', isDark);
                    }

                    document.cookie = 'theme=' + data.theme + ';path=/;max-age=' + (60*60*24*365);
                })
                .catch(function(err) {
                    console.error('Dark mode toggle error:', err);
                });
            });
        });
    </script>

    <script src="{{ asset('dist/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
