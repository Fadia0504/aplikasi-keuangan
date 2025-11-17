<x-layouts.app>
    {{-- Page Title --}}
    <x-page-title>Laporan</x-page-title>

    <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
        {{-- info form --}}
        <div class="alert alert-warning mb-5" role="alert">
            <i class="ti ti-calendar-search fs-5 me-2"></i> Filter Tanggal Transaksi.
        </div>
        {{-- form filter data --}}
        <form action="{{ route('laporan.filter') }}" method="GET">
            <div class="row">
                <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                    <label class="form-label">Tanggal Awal <span class="text-danger">*</span></label>
                    <input type="text" name="tgl_awal" class="form-control datepicker @error('tgl_awal') is-invalid @enderror" value="{{ old('tgl_awal', request('tgl_awal')) }}" autocomplete="off">
                        
                    {{-- pesan error untuk tanggal awal --}}
                    @error('tgl_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-lg-4 col-xl-3">
                    <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" name="tgl_akhir" class="form-control datepicker @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir', request('tgl_akhir')) }}" autocomplete="off">
                        
                    {{-- pesan error untuk tanggal akhir --}}
                    @error('tgl_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
    
            {{-- button tampil data laporan --}}
            <x-form-action-buttons>laporan</x-form-action-buttons>
        </form>
    </div>

    @if (request(['tgl_awal', 'tgl_akhir']))
        <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
            <div class="d-flex flex-column flex-lg-row mb-4">
                <div class="flex-grow-1 d-flex align-items-center">
                    {{-- judul laporan --}}
                    <h6 class="mb-0">
                        <i class="ti ti-file-text fs-5 align-text-top me-1"></i> 
                        Laporan Transaksi Tanggal {{ Carbon\Carbon::parse(request('tgl_awal'))->translatedFormat('j F Y') }} s.d. {{ Carbon\Carbon::parse(request('tgl_akhir'))->translatedFormat('j F Y') }}.
                    </h6>
                </div>
                <div class="d-grid gap-3 d-sm-flex mt-3 mt-lg-0">
                    {{-- button cetak laporan (export PDF) --}}
                    <a href="{{ route('laporan.print', [request('tgl_awal'), request('tgl_akhir')]) }}" target="_blank" class="btn btn-warning py-2 px-3">
                        <i class="ti ti-printer me-2"></i> Cetak
                    </a>
                </div>
            </div>

            <hr class="mb-4">

            {{-- tabel tampil data --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                        <th class="text-center">No.</th>
                        <th class="text-center">Jenis Transaksi</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Jumlah</th>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($transaksi as $data)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30" class="text-center">{{ $no++ }}</td>
                            <td width="100" class="text-center">{{ $data->jenis_transaksi }}</td>
                            <td width="100" class="text-center">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                            <td width="200">{{ $data->deskripsi }}</td>
                            <td width="120" class="text-end">{{ 'Rp ' . number_format($data->jumlah, 0, '', '.') }}</td>
                        </tr>
                    @empty
                        {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                        <tr>
                            <td colspan="5">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="ti ti-info-circle fs-5 me-2"></i>
                                    <div>Tidak ada data tersedia.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-layouts.app>