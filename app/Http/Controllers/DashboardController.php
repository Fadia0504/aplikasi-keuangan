<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // menampilkan jumlah total pemasukan
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');

        // menampilkan jumlah total pengeluaran
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');

        // hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        // tampilkan data ke view
        return view('dashboard.index', compact('totalPemasukan', 'totalPengeluaran', 'saldo'));
    }
}
