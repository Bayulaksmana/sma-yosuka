@extends('backend.layout.template')

@section('title', 'Informasi Artikel || Admin')


@section('content')
    {{-- Body Content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Informasi Artikel</h1>
        </div>
        <div class="mt-3">
            <table class="table table-striped table-bordered" width="100%">
                <tr>
                    <th width="150px">Judul Artikel</th>
                    <td>: {{ $article->title }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: {{ $article->category->name }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: {{ $article->description }}</td>
                </tr>
                <tr>
                    <th>Gambar</th>
                    <td>
                        <a href="{{ asset('storage/backend/' . $article->image . '') }}" data-toggle="lightbox"
                            data-gallery="example-gallery" class="col-sm-4 w-25">
                            <img src="{{ asset('storage/backend/' . $article->image . '') }}" alt="{{ __('') }}"
                                class="img-fluid w-25">
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Pengunjung</th>
                    <td>: {{ $article->views }} <span class="bi bi-eye-fill"> </span></td>
                </tr>
                <tr>
                    <th>Status Publikasi</th>
                    @if ($article->status == 1)
                        <td>: <span class="badge bg-success">Published</span></td>
                    @else
                        <td>: <span class="badge bg-danger">Not-Published</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Tanggal Publikasi</th>
                    <td>: {{ $article->publish_date }}</td>
                </tr>
            </table>

            <div class="float-end">
                <a href="{{ url('article') }}" class="btn btn-success bi bi-arrow-right-square-fill"> Kembali</a>
            </div>

        </div>
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
