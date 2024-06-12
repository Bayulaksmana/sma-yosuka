@extends('backend.layout.template')

@section('title', 'Rubah Artikel - Admin')

@section('content')
    {{-- Body Content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Perubahan Artikel</h1>
        </div>

        <div class="mt-3">
            @if ($errors->any())
                <div>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <form action="{{ url('article/' . $article->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="oldImg" value="{{ $article->image }}">
                <div class="row">
                    <div class="col-6">
                        <div class="md-3">
                            <label for="title" class="mb-2 font-weight-bold">Judul Artikel</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $article->title) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="md-3">
                            <label for="category_id" class="mb-2">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($category as $item)
                                    @if ($item->id == $article->category_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="mt-2 mb-2">Deskripsi Artikel</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                        {{ old('description', $article->description) }}
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="mb-2">Gambar (Max-2MB)</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <div class="mt-2">
                        <small>Thumbnail</small><br>
                        <a href="{{ asset('storage/backend/' . $article->image) }}" data-toggle="lightbox"
                            data-gallery="example-gallery" class="col-sm-4 w-25">
                            <img src="{{ asset('storage/backend/' . $article->image) }}" alt="" width="50px">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $article->status == 1 ? 'selected' : null }}>Publish</option>
                                <option value="0" {{ $article->status == 0 ? 'selected' : null }}>Not-Publish</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="publish_date">Tanggal Post</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control"
                                value="{{ old('publish_date', $article->publish_date) }}">
                        </div>
                    </div>
                </div>

                <div class="float-end">
                    <button type="submit" class="btn btn-success bi bi-floppy-fill mt-2 mb-5"> SIMPAN</button>
                </div>
            </form>
        </div>
    </main>

@endsection
@push('js')
    {{-- Input fungsi javascript online  from bootstrap 5 --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}


    <script src="https://cdn.tiny.cloud/1/ih2jrrv0v85b0hyexn6e0sxrh3bvsf4djnbwrbh4ki2ad4ol/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });
    </script>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
    @endpush

@endpush
