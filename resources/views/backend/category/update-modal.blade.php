@foreach ($category as $item)
    <!-- Modal untuk mengubah daftar kategori -->
    <div class="modal fade" id="modalUpdate{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white text-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Perubahan Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Form untuk mengubah kategori terbaru --}}
                <div class="modal-body text-center font-weight-bold">
                    <form action="{{ url('category/' . $item->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label class="mb-2" for="name">Judul Kategori</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $item->name) }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                {{-- Akhir dari form penambahan kategori --}}
            </div>
        </div>
    </div>
@endforeach
