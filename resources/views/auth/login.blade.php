{{--
    resources/views/auth/login.blade.php
    Halaman Login — extend layout auth.blade.php
--}}
@extends('layouts.auth')

@section('title', 'Login')

@section('auth-info-title')
    A few more clicks to <br> sign in to your account.
@endsection

@section('auth-info-subtitle')
    Manage all your e-commerce accounts in one place
@endsection

@section('form')

    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
        Sign In
    </h2>

    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
        A few more clicks to sign in to your account.<br>
        Manage all your e-commerce accounts in one place
    </div>

    {{-- Flash / error messages --}}
    @if ($errors->any())
        <div class="alert alert-danger-soft show flex items-center mb-2 mt-4" role="alert">
            <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success-soft show flex items-center mb-2 mt-4" role="alert">
            <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="intro-x mt-8">
            {{-- Email --}}
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                placeholder="Email"
                class="intro-x login__input form-control py-3 px-4 block
                       {{ $errors->has('email') ? 'border-danger' : '' }}"
            >

            {{-- Password --}}
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Password"
                class="intro-x login__input form-control py-3 px-4 block mt-4
                       {{ $errors->has('password') ? 'border-danger' : '' }}"
            >
        </div>

        {{-- Remember Me + Forgot Password --}}
        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
            <div class="flex items-center mr-auto">
                <input
                    id="remember-me"
                    name="remember"
                    type="checkbox"
                    class="form-check-input border mr-2"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
        </div>

        {{-- Tombol Submit --}}
        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                Login
            </button>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top inline-block text-center">
                    Register
                </a>
            @endif
        </div>

    </form>

    <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
        By signing in, you agree to our
        <a class="text-primary dark:text-slate-200" href="#">Terms and Conditions</a> &
        <a class="text-primary dark:text-slate-200" href="#">Privacy Policy</a>
    </div>

@endsection
