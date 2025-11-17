<x-layouts.app>
    {{-- Page Title --}}
    <x-page-title>Detail Transaksi</x-page-title>

    <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
        {{-- tampilkan detail data --}}
        <div class="table-responsive border rounded mb-4">
            <table class="table table-striped align-middle text-nowrap mb-0">
                <tr>
                    <td width="150">Jenis Transaksi</td>
                    <td width="10">:</td>
                    <td>{{ $transaksi->jenis_transaksi }}</td>
                </tr>
                <tr>
                    <td width="150">Tanggal</td>
                    <td width="10">:</td>
                    <td>{{ Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('j F Y') }}</td>
                </tr>
                <tr>
                    <td width="150">Deskripsi</td>
                    <td width="10">:</td>
                    <td>{{ $transaksi->deskripsi }}</td>
                </tr>
                <tr>
                    <td width="150">Jumlah</td>
                    <td width="10">:</td>
                    <td>{{ 'Rp ' . number_format($transaksi->jumlah, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td width="150" valign="top">Bukti Transaksi</td>
                    <td width="10">:</td>
                    <td>
                        @if (is_null($transaksi->bukti_transaksi))
                            <img src="{{ asset('images/no-image.png') }}" class="border img-fluid rounded-4 shadow-sm" width="35%" alt="Image">
                        @else
                            <img src="{{ asset('/storage/bukti-transaksi/'.$transaksi->bukti_transaksi) }}" class="border img-fluid rounded-4 shadow-sm" width="35%" alt="Image">
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        {{-- action buttons --}}
        <x-form-action-buttons>transaksi</x-form-action-buttons>
    </div>
</x-layouts.app>