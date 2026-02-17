<x-layouts.app>
    {{-- Page Title --}}
    <x-page-title>Dashboard</x-page-title>

    {{-- Heroes --}}
    <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-3">
                <img src="{{ asset('images/undraw_wallet_diag.svg') }}" class="img-fluid opacity-85" alt="images" loading="lazy">
            </div>
            <div class="col-lg-9">
                <h5 class="text-success mb-2">
                    Selamat datang di <span class="fw-semibold">MoneyFlow</span>!
                </h5>
                <p class="mb-4">
                    Kelola pemasukan, pengeluaran, dan catatan keuangan Kamu dengan lebih mudah dan rapi dalam satu platform.
                    </a>
                </p>
                <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-success py-2 px-3">
                        <i class="ti ti-plus me-2"></i> Tambah Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        {{-- menampilkan informasi jumlah total pemasukan --}}
        <div class="col-md-4">
            <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="ti ti-transfer-in fs-1 bg-success text-white rounded-2 p-2"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Pemasukan</p>
                        {{-- tampilkan data --}}
                        <h5 class="fw-bold mb-0">{{ 'Rp ' . number_format($totalPemasukan, 0, '', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{-- menampilkan informasi jumlah total pengeluaran --}}
        <div class="col-md-4">
            <div class="bg-white rounded-2 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="ti ti-transfer-out fs-1 bg-warning text-white rounded-2 p-2"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Pengeluaran</p>
                        {{-- tampilkan data --}}
                        <h5 class="fw-bold mb-0">{{ 'Rp ' . number_format($totalPengeluaran, 0, '', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{-- menampilkan informasi jumlah saldo --}}
        <div class="col-md-4">
            <div class="bg-white rounded-2 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="ti ti-user-dollar fs-1 bg-purple text-white rounded-2 p-2"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Saldo</p>
                        {{-- tampilkan data --}}
                        <h5 class="fw-bold mb-0">{{ 'Rp ' . number_format($saldo, 0, '', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>