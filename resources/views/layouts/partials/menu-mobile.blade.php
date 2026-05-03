{{--
    resources/views/layouts/partials/menu-mobile.blade.php
    Menu mobile — sama strukturnya dengan menu sidebar tapi pakai class "menu"
--}}

<li>
    <a href="{{ route('dashboard') }}"
       class="menu {{ request()->routeIs('dashboard') ? 'menu--active' : '' }}">
        <div class="menu__icon"><i data-lucide="home"></i></div>
        <div class="menu__title">
            Dashboard

        </div>
    </a>
</li>

<li>
    <a href="javascript:;" class="menu">
        <div class="menu__icon"><i data-lucide="edit"></i></div>
        <div class="menu__title">
            Master Data
            <i data-lucide="chevron-down" class="menu__sub-icon {{ request()->routeIs('users.*') ? 'transform rotate-180' : '' }}"></i>
        </div>
    </a>
    <ul class="{{ request()->routeIs('users.*') ? 'menu__sub-open' : '' }}">
        <li>
            <a href="#"
               class="menu {{ request()->routeIs('users.index') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-lucide="users"></i></div>
                <div class="menu__title">Users</div>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:;" class="menu">
        <div class="menu__icon"><i data-lucide="shopping-bag"></i></div>
        <div class="menu__title">
            Sales
            <i data-lucide="chevron-down" class="menu__sub-icon {{ request()->routeIs('sales.*') || request()->routeIs('customers.*') ? 'transform rotate-180' : '' }}"></i>
        </div>
    </a>
    <ul class="{{ request()->routeIs('sales.*') || request()->routeIs('customers.*') ? 'menu__sub-open' : '' }}">
        <li>
            <a href="{{ route('customers.index') }}"
               class="menu {{ request()->routeIs('customers.*') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-lucide="users"></i></div>
                <div class="menu__title">Master Customer</div>
            </a>
        </li>
        <li>
            <a href="{{ route('sales.index') }}"
               class="menu {{ request()->routeIs('sales.index') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-lucide="activity"></i></div>
                <div class="menu__title">Data List</div>
            </a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:;"
       class="menu"
       onclick="document.getElementById('logout-form-mobile').submit()">
        <div class="menu__icon"><i data-lucide="toggle-right"></i></div>
        <div class="menu__title">Logout</div>
    </a>
    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</li>
