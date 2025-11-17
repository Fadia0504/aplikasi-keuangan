<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Filter.
     */
    public function filter(Request $request): View
    {
        // menampilkan data berdasarkan filter
        if ($request->has(['tgl_awal', 'tgl_akhir'])) {
            // validasi form
            $request->validate([
                'tgl_awal'  => 'required|date',
                'tgl_akhir' => 'required|date|after_or_equal:tgl_awal'
            ], [
                'tgl_awal.required'        => 'Tanggal awal tidak boleh kosong.',
                'tgl_awal.date'            => 'Tanggal awal harus berupa tanggal yang valid.',
                'tgl_akhir.required'       => 'Tanggal akhir tidak boleh kosong.',
                'tgl_akhir.date'           => 'Tanggal akhir harus berupa tanggal yang valid.',
                'tgl_akhir.after_or_equal' => 'Tanggal akhir harus berupa tanggal setelah atau sama dengan tanggal awal.'
            ]);

            // data filter
            $tglAwal  = $request->tgl_awal;
            $tglAkhir = $request->tgl_akhir;

            // menampilkan data berdasarkan filter
            $transaksi = Transaksi::select('id', 'jenis_transaksi', 'tanggal', 'deskripsi', 'jumlah')
                ->whereBetween('tanggal', [$tglAwal, $tglAkhir])
                ->orderBy('tanggal', 'asc')
                ->get();

            // tampilkan data ke view
            return view('laporan.filter', compact('transaksi'));
        } 
        // menampilkan form filter data
        else {
            // tampilkan view
            return view('laporan.filter');
        }
    }

    /**
     * Print (PDF)
     */
    public function print(Request $request)
    {
        // data filter
        $tglAwal  = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;
        
        // menampilkan data berdasarkan filter
        $transaksi = Transaksi::select('id', 'jenis_transaksi', 'tanggal', 'deskripsi', 'jumlah')
                ->whereBetween('tanggal', [$tglAwal, $tglAkhir])
                ->orderBy('tanggal', 'asc')
                ->get();

        // load view PDF
        $pdf = Pdf::loadview('laporan.print', compact('transaksi'))->setPaper('a4', 'landscape');
        // tampilkan ke browser
        return $pdf->stream('Laporan-Transaksi.pdf');
    }
}
