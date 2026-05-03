{{--
    resources/views/layouts/app.blade.php
    Layout utama untuk halaman dashboard (setelah login)
    Mendukung dark/light mode via class di <html>
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', cookie('theme', 'light')) }}">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? config('app.name') . ' - Admin Dashboard' }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>

    {{-- CSS Assets (Enigma/Midone dist) --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">

    {{-- Stack CSS tambahan per halaman --}}
    @stack('styles')
    @livewireStyles
</head>
<body class="py-5 md:py-0">

    {{-- ═══════════════════════════════════════════
         BEGIN: Mobile Menu
    ═══════════════════════════════════════════ --}}
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="{{ route('dashboard') }}" class="flex mr-auto">
                <img alt="{{ config('app.name') }}" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
            </a>
            <a href="javascript:;" class="mobile-menu-toggler">
                <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
            </a>
        </div>
        <div class="scrollable">
            <a href="javascript:;" class="mobile-menu-toggler">
                <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
            </a>
            <ul class="scrollable__content py-2">
                @include('layouts.partials.menu-mobile')
            </ul>
        </div>
    </div>
    {{-- END: Mobile Menu --}}

    {{-- ═══════════════════════════════════════════
         BEGIN: Top Bar
    ═══════════════════════════════════════════ --}}
    <div class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
        <div class="h-full flex items-center">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="logo -intro-x hidden md:flex xl:w-[180px] block">
                <img alt="{{ config('app.name') }}" class="logo__image w-6" src="{{ asset('dist/images/logo.svg') }}">
                <span class="logo__text text-white text-lg ml-3">{{ config('app.name') }}</span>
            </a>

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
                <ol class="breadcrumb breadcrumb-light">
                    @yield('breadcrumb', view('layouts.partials.breadcrumb-default'))
                </ol>
            </nav>

            {{-- Search --}}
            <div class="intro-x relative mr-3 sm:mr-6">
                <div class="search hidden sm:block">
                    <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
                    <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
                </div>
                <a class="notification notification--light sm:hidden" href="javascript:;">
                    <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
                </a>
            </div>

            {{-- Notification Bell --}}
            <div class="intro-x dropdown mr-4 sm:mr-6">
                <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                    <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
                </div>
                <div class="notification-content pt-2 dropdown-menu">
                    <div class="notification-content__box dropdown-content">
                        <div class="notification-content__title">Notifications</div>
                        {{-- tambahkan notifikasi di sini --}}
                    </div>
                </div>
            </div>

            {{-- Account Dropdown --}}
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                     role="button" aria-expanded="false" data-tw-toggle="dropdown">
                    <img alt="{{ auth()->user()->name ?? 'User' }}"
                         src="{{ asset('dist/images/profile-5.jpg') }}">
                </div>
                <div class="dropdown-menu w-56">
                    <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                        <li class="p-2">
                            <div class="font-medium">{{ auth()->user()->name ?? 'User' }}</div>
                            <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                                {{ auth()->user()->email ?? '' }}
                            </div>
                        </li>
                        <li><hr class="dropdown-divider border-white/[0.08]"></li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item hover:bg-white/5">
                                <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item hover:bg-white/5">
                                <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider border-white/[0.08]"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item hover:bg-white/5 w-full text-left">
                                    <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    {{-- END: Top Bar --}}

    {{-- ═══════════════════════════════════════════
         BEGIN: Main Wrapper (Sidebar + Content)
    ═══════════════════════════════════════════ --}}
    <div class="flex overflow-hidden">

        {{-- Sidebar --}}
        <nav class="side-nav">
            <ul>
                @include('layouts.partials.menu-sidebar')
            </ul>
        </nav>

        {{-- Content --}}
        <div class="content">
            @yield('content')
        </div>

    </div>
    {{-- END: Main Wrapper --}}

    {{-- ═══════════════════════════════════════════
         BEGIN: Dark Mode Switcher
    ═══════════════════════════════════════════ --}}
    <x-dark-mode-switcher />
    {{-- END: Dark Mode Switcher --}}
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

    {{-- JS Assets --}}
    <script src="{{ asset('dist/js/app.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
