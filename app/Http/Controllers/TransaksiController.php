<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // jumlah data yang ditampilkan per paginasi halaman
        $pagination = 10;

        if ($request->search) {
            // menampilkan pencarian data
            $transaksi = Transaksi::select('id', 'jenis_transaksi', 'tanggal', 'deskripsi', 'jumlah')
                ->whereAny(['jenis_transaksi', 'tanggal', 'deskripsi', 'jumlah'], 'LIKE', '%' . $request->search . '%')
                ->paginate($pagination)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $transaksi = Transaksi::select('id', 'jenis_transaksi', 'tanggal', 'deskripsi', 'jumlah')
                ->orderBy('tanggal', 'desc')
                ->paginate($pagination);
        }

        // tampilkan data ke view
        return view('transaksi.index', compact('transaksi'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // tampilkan form tambah data transaksi
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'tanggal'         => 'required|date',
            'deskripsi'       => 'required',
            'jumlah'          => 'required',
            'bukti_transaksi' => 'image|mimes:jpeg,jpg,png|max:1024'
        ], [
            'jenis_transaksi.required' => 'Jenis transaksi tidak boleh kosong.',
            'jenis_transaksi.in'       => 'Jenis transaksi yang dipilih tidak valid.',
            'tanggal.required'         => 'Tanggal tidak boleh kosong.',
            'tanggal.date'             => 'Tanggal harus berupa tanggal yang valid.',
            'deskripsi.required'       => 'Deskripsi tidak boleh kosong.',
            'jumlah.required'          => 'Jumlah tidak boleh kosong.',
            'bukti_transaksi.image'    => 'Bukti transaksi harus berupa gambar.',
            'bukti_transaksi.mimes'    => 'Bukti transaksi harus berupa file dengan jenis: jpeg, jpg, png.',
            'bukti_transaksi.max'      => 'Bukti transaksi tidak boleh lebih besar dari 1 MB.'
        ]);

        // jika "bukti_transaksi" diisi
        if ($request->hasFile('bukti_transaksi')) {
            // upload "bukti_transaksi"
            $buktiTransaksi = $request->file('bukti_transaksi');
            $buktiTransaksi->storeAs('bukti-transaksi', $buktiTransaksi->hashName());

            // simpan data
            Transaksi::create([
                'jenis_transaksi' => $request->jenis_transaksi,
                'tanggal'         => $request->tanggal,
                'deskripsi'       => $request->deskripsi,
                'jumlah'          => Str::replace('.', '', $request->jumlah),
                'bukti_transaksi' => $buktiTransaksi->hashName()
            ]);
        }
        // jika "bukti_transaksi" tidak diisi
        else {
            // simpan data
            Transaksi::create([
                'jenis_transaksi' => $request->jenis_transaksi,
                'tanggal'         => $request->tanggal,
                'deskripsi'       => $request->deskripsi,
                'jumlah'          => Str::replace('.', '', $request->jumlah)
            ]);
        }

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // dapatkan data berdasarakan "id"
        $transaksi = Transaksi::findOrFail($id);

        // tampilkan form detail data
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // dapatkan data berdasarakan "id"
        $transaksi = Transaksi::findOrFail($id);

        // tampilkan form ubah data
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // validasi form
        $request->validate([
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'tanggal'         => 'required|date',
            'deskripsi'       => 'required',
            'jumlah'          => 'required',
            'bukti_transaksi' => 'image|mimes:jpeg,jpg,png|max:1024'
        ], [
            'jenis_transaksi.required' => 'Jenis transaksi tidak boleh kosong.',
            'jenis_transaksi.in'       => 'Jenis transaksi yang dipilih tidak valid.',
            'tanggal.required'         => 'Tanggal tidak boleh kosong.',
            'tanggal.date'             => 'Tanggal harus berupa tanggal yang valid.',
            'deskripsi.required'       => 'Deskripsi tidak boleh kosong.',
            'jumlah.required'          => 'Jumlah tidak boleh kosong.',
            'bukti_transaksi.image'    => 'Bukti transaksi harus berupa gambar.',
            'bukti_transaksi.mimes'    => 'Bukti transaksi harus berupa file dengan jenis: jpeg, jpg, png.',
            'bukti_transaksi.max'      => 'Bukti transaksi tidak boleh lebih besar dari 1 MB.'
        ]);

        // dapatkan data berdasarakan "id"
        $transaksi = Transaksi::findOrFail($id);

        // jika "bukti_transaksi" diubah
        if ($request->hasFile('bukti_transaksi')) {
            // upload "bukti_transaksi" baru
            $buktiTransaksi = $request->file('bukti_transaksi');
            $buktiTransaksi->storeAs('bukti-transaksi', $buktiTransaksi->hashName());

            // hapus "bukti_transaksi" lama
            Storage::delete('bukti-transaksi/' . $transaksi->bukti_transaksi);

            // ubah data
            $transaksi->update([
                'jenis_transaksi' => $request->jenis_transaksi,
                'tanggal'         => $request->tanggal,
                'deskripsi'       => $request->deskripsi,
                'jumlah'          => Str::replace('.', '', $request->jumlah),
                'bukti_transaksi' => $buktiTransaksi->hashName()
            ]);
        }
        // jika "bukti_transaksi" tidak diubah
        else {
            // ubah data
            $transaksi->update([
                'jenis_transaksi' => $request->jenis_transaksi,
                'tanggal'         => $request->tanggal,
                'deskripsi'       => $request->deskripsi,
                'jumlah'          => Str::replace('.', '', $request->jumlah)
            ]);
        }

        // redirect ke halaman index dan tampilkan pesan berhasil ubah data
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // dapatkan data berdasarakan "id"
        $transaksi = Transaksi::findOrFail($id);

        // hapus "bukti_transaksi"
        Storage::delete('bukti-transaksi/' . $transaksi->bukti_transaksi);

        // hapus data
        $transaksi->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}