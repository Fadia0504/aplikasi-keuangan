<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- Title --}}
    <title>Laporan Transaksi Tanggal {{ Carbon\Carbon::parse(request('tgl_awal'))->translatedFormat('j F Y') }} - {{ Carbon\Carbon::parse(request('tgl_akhir'))->translatedFormat('j F Y') }}</title>
    
    {{-- custom style --}}
    <style type="text/css">
        table, th, td {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px 5px;
        }

        hr {
            color: #dee2e6;
        }
    </style>
</head>

<body>
    {{-- judul laporan --}}
    <div style="text-align: center">
        <h3>Laporan Transaksi Tanggal {{ Carbon\Carbon::parse(request('tgl_awal'))->translatedFormat('j F Y') }} s.d. {{ Carbon\Carbon::parse(request('tgl_akhir'))->translatedFormat('j F Y') }}</h3>
    </div>

    <hr style="margin-bottom:20px">

    {{-- tabel tampil data --}}
    <table style="width:100%">
        <thead style="background-color: #00aa9d; color: #ffffff">
            <th>No.</th>
            <th>Jenis Transaksi</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @forelse ($transaksi as $data)
            {{-- jika data ada, tampilkan data --}}
            <tr>
                <td width="30" align="center">{{ $no++ }}</td>
                <td width="100" align="center">{{ $data->jenis_transaksi }}</td>
                <td width="100" align="center">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                <td width="200">{{ $data->deskripsi }}</td>
                <td width="120" align="right">{{ 'Rp ' . number_format($data->jumlah, 0, '', '.') }}</td>
            </tr>
        @empty
            {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
            <tr>
                <td align="center" colspan="7">Tidak ada data tersedia.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 25px; text-align: right">Tangerang, {{ Carbon\Carbon::now()->translatedFormat('j F Y') }}</div>
</body>

</html>
