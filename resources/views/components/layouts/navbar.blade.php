{{-- Navbar Top --}}
<nav class="navbar navbar-top fixed-top bg-success text-white">
    <div class="container">
        {{-- Navbar Brand --}}
        <a class="navbar-brand d-flex align-items-center text-white" href="#">
            {{-- logo --}}
            <img src="{{ asset('images/logo-dashboard.png') }}" alt="Logo" width="32" class="me-3">
            {{-- title --}}
            <span class="fs-4 text-uppercase">Aplikasi Keuangan</span>
        </a>
    </div>
</nav>

{{-- Navbar Menu --}}
<nav class="navbar navbar-menu fixed-top navbar-expand-lg bg-light shadow-lg-sm">
    <div class="container">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <x-navbar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <i class="ti ti-home align-text-top me-1"></i>
                        <span class="align-middle">Dashboard</span>
                    </x-navbar-link>
                </li>
                <li class="nav-item">
                    <x-navbar-link href="{{ route('transaksi.index') }}" :active="request()->routeIs('transaksi.*')">
                        <i class="ti ti-copy align-text-top me-1"></i> 
                        <span class="align-middle">Transaksi</span>
                    </x-navbar-link>
                </li>
                <li class="nav-item">
                    <x-navbar-link href="{{ route('laporan.filter') }}" :active="request()->routeIs('laporan.*')">
                        <i class="ti ti-file-text align-text-top me-1"></i> Laporan
                    </x-navbar-link>
                </li>
            </ul>
        </div>
    </div>
</nav>