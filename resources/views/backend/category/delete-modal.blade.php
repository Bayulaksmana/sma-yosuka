@foreach ($category as $item)
    <!-- Modal untuk menghapus daftar kategori -->
    <div class="modal fade" id="modalDelete{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white text-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Form untuk menghapus kategori terbaru --}}
                <div class="modal-body text-center font-weight-bold">
                    <form action="{{ url('category/' . $item->id) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <div class="mb-3">
                            <p>Kategori <u>{{ $item->name }}</u>, apakah akan dihapus?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">kembali</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
                {{-- Akhir dari form penambahan kategori --}}
            </div>
        </div>
    </div>
@endforeach
