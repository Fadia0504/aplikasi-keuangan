<div class="modal fade" id="modalHapus{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">
                    <i class="ti ti-trash me-1"></i> Hapus {{ $slot }}
                </h1>
            </div>
            <div class="modal-body">
                {{-- informasi data yang akan dihapus --}}
                <p class="mb-2">
                    {{ $message }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary py-2 px-3" data-bs-dismiss="modal">Batal</button>
                {{-- button hapus data --}}
                <form action="{{ route($slot . '.destroy', $id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger py-2 px-3"> Ya, Hapus! </button>
                </form>
            </div>
        </div>
    </div>
</div>