@extends('backend.layout.template')
@stack('css')
@push('css')
    {{-- Input style css from bootstrap 5 --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css" />
@endpush

@section('title', 'Daftar Artikel || Admin')


@section('content')
    {{-- Body Content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Artikel</h1>
        </div>

        <div class="mt-3">
            <a href="{{ url('article/create') }}" class="btn btn-primary mb-md-3 bi bi-send-plus-fill">
                Tambah
            </a>

            {{-- @if ($errors->any())
                <div class="my-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif --}}

            {{-- popup notifikasi berhasil --}}
            <div class="swal" data-swal="{{ session('success') }}"></div>



            <table class="table table-striped table-bordered" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Posting</th>
                        <th>Views</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </main>
@endsection

@push('js')
    {{-- Input fungsi javascript online  from bootstrap 5 --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Pop-Up Notifikasi Sukses  --}}
    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                'title': 'Berhasil',
                'text': swal,
                'icon': 'success',
                'showConfirmButton': false,
                'timer': 5000
            });
        }

        function deleteArticle(e) {
            let id = e.getAttribute('data-id');

            Swal.fire({
                title: "Hapus Artikel",
                text: "Apakah artikel, akan dihapus?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: "Hapusin!",
                cancelButtonText: "Batalin!",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: '/article/' + id,
                        dataType: "json",
                        success: function(respone) {
                            Swal.fire({
                                title: 'Penghapusan Data',
                                text: respone.message,
                                icon: 'success',
                            }).then((result) => {
                                window.location.href = '/article'
                            })
                        },
                        error: function(xhr, ajaxOption, thrownError) {
                            alert(xhr.status + "\n" + xhr.responeText + "\n" + thrownError);
                        }
                    });
                }
            });
        }
    </script>

    {{-- Datatable Administrator --}}
    <script>
        $(document).ready(function(row) {
            $('#dataTable').DataTable({
                processing: true,
                serverside: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        nama: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        nama: 'title'
                    },
                    {
                        data: 'category_id',
                        nama: 'category_id'
                    },
                    {
                        data: 'description',
                        nama: 'description'
                    },
                    {
                        data: 'status',
                        nama: 'status'
                    },
                    {
                        data: 'publish_date',
                        nama: 'publish_date'
                    },
                    {
                        data: 'views',
                        nama: 'views'
                    },
                    {
                        data: 'button',
                        nama: 'button'
                    },
                ]
            });
        });
    </script>
@endpush
