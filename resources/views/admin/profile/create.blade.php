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
        <h3 class="card-title">Tambah Halaman Profil</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.profile.store')}}" method="POST" class="form-horizontal form-label-left">
            @csrf
            <div class="form-group">
                <label for="profil_nama">Judul Profil</label>
                <input type="text" class="form-control" id="profil_nama" name="profil_nama" placeholder=""
                    value="{{old('profil_nama')}}" alue="{{old('profil_nama')}}">
            </div>

            <div class="form-group">
                <label for="profil_nama">Isi / Konten Profil</label>
                <textarea name="profil_isi" id="profil_isi"></textarea>
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
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
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
    $('#profil_isi').summernote({
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
                $('#profil_isi').summernote("insertImage", url);
            }
        });
    }
})
</script>

@endsection