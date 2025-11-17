<x-layouts.app>
    {{-- Page Title --}}
    <x-page-title>Ubah Transaksi</x-page-title>

    <div class="bg-white rounded-2 shadow-sm p-4 mb-5">
        {{-- form ubah data --}}
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                        <select name="jenis_transaksi" class="form-select select2-single @error('jenis_transaksi') is-invalid @enderror" autocomplete="off">
                            <option disabled value="">- Pilih -</option>
                            <option {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'Pemasukan' ? 'selected' : '' }} value="Pemasukan">Pemasukan</option>
                            <option {{ old('jenis_transaksi', $transaksi->jenis_transaksi) == 'Pengeluaran' ? 'selected' : '' }} value="Pengeluaran">Pengeluaran</option>
                        </select>
                        
                        {{-- pesan error untuk jenis transaksi --}}
                        @error('jenis_transaksi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal" class="form-control datepicker @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $transaksi->tanggal) }}" autocomplete="off">
                        
                        {{-- pesan error untuk tanggal --}}
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror" autocomplete="off">{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
                        
                        {{-- pesan error untuk deskripsi --}}
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="jumlah" class="form-control mask-number @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $transaksi->jumlah) }}" autocomplete="off">

                            {{-- pesan error untuk jumlah --}}
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bukti Transaksi</label>
                        <input type="file" accept=".jpg, .jpeg, .png" name="bukti_transaksi" id="image" class="form-control @error('bukti_transaksi') is-invalid @enderror" autocomplete="off">
            
                        {{-- pesan error untuk bukti transaksi --}}
                        @error('bukti_transaksi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        {{-- view bukti transaksi --}}
                        <div class="mt-4">
                            @if (is_null($transaksi->bukti_transaksi))
                                <img id="imagePreview" src="{{ asset('images/no-image.png') }}" class="border img-fluid rounded-4 shadow-sm" width="50%" alt="Image">
                            @else
                                <img id="imagePreview" src="{{ asset('/storage/bukti-transaksi/'.$transaksi->bukti_transaksi) }}" class="border img-fluid rounded-4 shadow-sm" width="50%" alt="Image">
                            @endif
                        </div>

                        <div class="alert alert-warning py-2 mt-3" role="alert">
                            <small>
                                Keterangan : <br>
                                - Jenis file yang bisa diunggah adalah: <strong>jpg, jpeg, png</strong>. <br>
                                - Ukuran file yang bisa diunggah maksimal <strong>1 MB</strong>.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- action buttons --}}
            <x-form-action-buttons>transaksi</x-form-action-buttons>
        </form>
    </div>
</x-layouts.app>