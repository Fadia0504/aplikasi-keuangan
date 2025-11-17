<x-layouts.app>
    {{-- Page Title --}}
    <x-page-title>Transaksi</x-page-title>

    <div class="bg-white rounded-2 shadow-sm p-4 mb-4">
        <div class="row">
            <div class="d-grid d-lg-block col-lg-5 col-xl-6 mb-4 mb-lg-0">
                {{-- button form tambah data --}}
                <a href="{{ route('transaksi.create') }}" class="btn btn-success py-2 px-3">
                    <i class="ti ti-plus me-2"></i> Tambah Transaksi
                </a>
            </div>
            <div class="col-lg-7 col-xl-6">
                {{-- form pencarian --}}
                <form action="{{ route('transaksi.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search py-2" value="{{ request('search') }}" placeholder="Cari Transaksi ..." autocomplete="off">
                        <button class="btn btn-success py-2" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- menampilkan pesan --}}
    <x-alert></x-alert>

    <div class="bg-white rounded-2 shadow-sm pt-4 px-4 pb-3 mb-5">
        {{-- tabel tampil data --}}
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                    <th class="text-center">No.</th>
                    <th class="text-center">Jenis Transaksi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                @forelse ($transaksi as $data)
                    {{-- jika data ada, tampilkan data --}}
                    <tr>
                        <td width="30" class="text-center">{{ ++$i }}</td>
                        <td width="100" class="text-center">{{ $data->jenis_transaksi }}</td>
                        <td width="100" class="text-center">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                        <td width="200">{{ $data->deskripsi }}</td>
                        <td width="120" class="text-end">{{ 'Rp ' . number_format($data->jumlah, 0, '', '.') }}</td>
                        <td width="100" class="text-center">
                            {{-- button form detail data --}}
                            <a href="{{ route('transaksi.show', $data->id) }}" class="btn btn-warning btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Detail">
                                <i class="ti ti-list"></i>
                            </a>
                            {{-- button form ubah data --}}
                            <a href="{{ route('transaksi.edit', $data->id) }}" class="btn btn-success btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Ubah">
                                <i class="ti ti-edit"></i>
                            </a>
                            {{-- button modal hapus data --}}
                            <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $data->id }}" data-bs-tooltip="tooltip" data-bs-title="Hapus"> 
                                <i class="ti ti-trash"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal hapus data --}}
                    <x-modal-delete>
                        transaksi
                        <x-slot:id>{{ $data->id }}</x-slot:id>
                        <x-slot:message>
                            <div class="alert alert-danger" role="alert">
                                Anda yakin ingin menghapus data transaksi?
                            </div>
                            <div class="border rounded p-4">
                                <div>
                                    <div class="form-text">Jenis Transaksi</div>
                                    <div>{{ $data->jenis_transaksi }}</div>
                                </div>
                                <div>
                                    <div class="form-text mt-0">Tanggal</div>
                                    <div>{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</div>
                                </div>
                                <div>
                                    <div class="form-text">Deskripsi</div>
                                    <div>{{ $data->deskripsi }}</div>
                                </div>
                                <div>
                                    <div class="form-text">Jumlah</div>
                                    <div>{{ 'Rp ' . number_format($data->jumlah, 0, '', '.') }}</div>
                                </div>
                            </div>
                        </x-slot:message>
                    </x-modal-delete>
                @empty
                    {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                    <tr>
                        <td colspan="6">
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
        {{-- pagination --}}
        <div class="pagination-links">{{ $transaksi->links() }}</div>
    </div>
</x-layouts.app>