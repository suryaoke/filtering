{{--
    resources/views/layouts/partials/menu-sidebar.blade.php
    Menu sidebar untuk layar desktop (md ke atas).
    Gunakan helper route() agar URL tidak hardcoded.
--}}

{{-- Dashboard --}}
<li>
    <a href="{{ route('dashboard') }}"
       class="side-menu {{ request()->routeIs('dashboard') ? 'side-menu--active' : '' }}">
        <div class="side-menu__icon"><i data-lucide="home"></i></div>
        <div class="side-menu__title">
            Dashboard
            <div class="side-menu__sub-icon {{ request()->routeIs('dashboard') ? 'transform rotate-180' : '' }}">
                <i data-lucide="chevron-down"></i>
            </div>
        </div>
    </a>
</li>

<li class="menu__devider my-6"></li>

{{-- CRUD --}}


<li>
    <a href="{{ route('products.index') }}" class="side-menu {{ request()->routeIs('products.*') ? 'side-menu--active' : '' }}">
        <div class="side-menu__icon"><i data-lucide="package"></i></div>
        <div class="side-menu__title">Products</div>
    </a>
</li>

<li>
    <a href="javascript:;" class="side-menu {{ request()->routeIs('sales.*') ? 'side-menu--active' : '' }}">
        <div class="side-menu__icon"><i data-lucide="shopping-bag"></i></div>
        <div class="side-menu__title">
            Sales
            <div class="side-menu__sub-icon {{ request()->routeIs('sales.*') ? 'transform rotate-180' : '' }}">
                <i data-lucide="chevron-down"></i>
            </div>
        </div>
    </a>
    <ul class="{{ request()->routeIs('sales.*') ? 'side-menu__sub-open' : '' }}">
        <li>
            <a href="{{ route('sales.index') }}"
               class="side-menu {{ request()->routeIs('sales.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                <div class="side-menu__title">Data List</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu__devider my-6"></li>

{{-- Profile --}}
<li>
    <a href="{{ route('profile.edit') }}" class="side-menu {{ request()->routeIs('profile.*') ? 'side-menu--active' : '' }}">
        <div class="side-menu__icon"><i data-lucide="user"></i></div>
        <div class="side-menu__title">Profile</div>
    </a>
</li>

{{-- Logout --}}
<li>
    <a href="javascript:;"
       class="side-menu"
       onclick="document.getElementById('logout-form-sidebar').submit()">
        <div class="side-menu__icon"><i data-lucide="toggle-right"></i></div>
        <div class="side-menu__title">Logout</div>
    </a>
    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</li>
