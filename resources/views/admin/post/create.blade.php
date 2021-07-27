@extends('admin.template')

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="../../template-admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Post</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.post.store')}}" method="POST" class="form-horizontal form-label-left">
            @csrf
            <div class="form-group">
                <label for="post_judul">Judul Post</label>
                <input type="text" class="form-control" id="post_judul" name="post_judul" placeholder=""
                    value="{{old('post_judul')}}">
            </div>
            <div class="form-group">
                <label for="post_tanggal">Tanggal Post</label>
                <input type="date" class="form-control" id="post_tanggal" name="post_tanggal" placeholder=""
                    value="{{old('post_tanggal')}}">
            </div>
            <div class="form-group">
                <label for="post_status">Status Publish</label>
                <select class="form-control" id="post_status" name="post_status">
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="form-group">
                <label for="post_kategori">Post Kategori</label>
                <select class="form-control" id="post_kategori" name="post_kategori">
                    <option value="berita">Berita</option>
                    <option value="psikoedukasi">Psikoedukasi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="post_konten">Konten Post</label>
                <textarea name="post_konten" id="post_konten">{{old('post_tanggal')}}</textarea>
            </div>

            <div class="form-group">
                <label for="post_foto">Foto Post</label>
                <input type="file" class="form-control" id="post_foto" name="post_foto" placeholder=""
                    value="{{old('post_foto')}}">
            </div>
            <div class="ln_solid"></div>
            <div class="form-group pull-right">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<!-- /.card -->
@endsection

@section('js')
<!-- Summernote -->
<script src="../../template-admin/plugins/summernote/summernote-bs4.min.js"></script>

<!-- Page specific script -->
<script>
$(function() {
    // Summernote
    $('#post_konten').summernote({
        height: 250,
        callbacks: {
            onImageUpload: function(image) {
                sendFile(image[0]);
            }
        }
    })

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("image_upload", file);
        data.append("_token", "{{ csrf_token() }}");
        $.ajax({
            data: data,
            type: "POST",
            url: "{{route('upload')}}",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $('#post_konten').summernote("insertImage", url);
            }
        });
    }
})
</script>

@endsection