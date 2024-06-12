@extends('backend.layout.template')

@section('title', 'Daftar Kategori - Admin')

@section('content')
    {{-- Body Content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Kategori</h1>
        </div>

        <div class="mt-2">
            <button class="btn btn-primary mb-md-3 bi bi-send-plus-fill" data-bs-toggle="modal" data-bs-target="#modalCreate">
                Tambah
            </button>

            @if ($errors->any())
                <div class="my-2">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="my-2">
                    <div class="alert alert-success">
                        <ul>
                            {{ session('success') }}
                        </ul>
                    </div>
                </div>
            @endif

            <table class="table table-striped table-bordered">
                <thead">
                    <tr> {{-- Pembuatan Tabel Yang akan ditampilkan pada User --}}
                        <th class="text-center">No</th>
                        <th>Judul Kategori</th>
                        <th>Slug - Keterangan</th>
                        <th>Created Date</th>
                        <th class="text-center">Function</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                            <tr> {{--  Daftar Tabel Yang Ditambpilkan Pada Backend  --}}
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalUpdate{{ $item->id }}"><i
                                                class="bi bi-floppy-fill"></i></button>
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id }}"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

            </table>
        </div>

        {{-- Bagian Modal Untuk Menambahkan Kategori --}}
        @include('backend.category.create-modal')
        {{-- Bagian Modal Untuk Mengubah Kategori --}}
        @include('backend.category.update-modal')
        {{-- Bagian Modal Untuk Menghapus Kategori --}}
        @include('backend.category.delete-modal')

    </main>
@endsection
