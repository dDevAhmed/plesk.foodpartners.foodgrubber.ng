@php
    use Illuminate\Support\Facades\Request;
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        {{-- <a href="{{ route('app.index') }}" class="app-brand-link"> --}}
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/logo.svg') }}" alt="foodgrubber logo" width="30px">
            </span>
            {{-- <span class="app-brand-text demo text-body fw-bolder">Foodgrubber</span> --}}
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Foodgrubber</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('app.index') }}" class="menu-link">
                {{-- <a href="#" class="menu-link"> --}}
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- App -->
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">App</span>
        </li> --}}

        <li class="menu-item {{ Request::is('profile') ? 'active' : '' }}">
            <a href="{{ route('profile.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Profile</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('store') ? 'active' : '' }}">
            <a href="{{ route('store.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Basic">Store</div>
            </a>
        </li>

        @if ($userStoreUpdated)
            <li class="menu-item {{ Request::is('products') ? 'active' : '' }}">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="Basic">Products</div>
                </a>
            </li>

            <li class="menu-item {{ Request::is('orders') ? 'active' : '' }}">
                <a href="cards-basic.html" class="menu-link d-flex justify-content-between">
                    <div class="d-flex">
                        <i class="menu-icon tf-icons bx bx-basket"></i>
                        <div data-i18n="Basic">Orders</div>
                    </div>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                </a>
            </li>

            <li class="menu-item {{ Request::is('feedbacks') ? 'active' : '' }}">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-comment"></i>
                    <div data-i18n="Basic">Feedbacks</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('marketing') ? 'active' : '' }}">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-megaphone"></i>
                    <div data-i18n="Basic">Marketing</div>
                </a>
            </li>

            <li class="menu-item {{ Request::is('reports') ? 'active' : '' }}">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div data-i18n="Basic">Reports</div>
                </a>
            </li>
        @endif

    </ul>
</aside>
