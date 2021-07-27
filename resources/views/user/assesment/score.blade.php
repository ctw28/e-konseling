@extends('admin.template')
@section('css')
<!-- summernote -->
<link rel="stylesheet" href="../../template-admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Hasil Tes Anda <span id="tes"></span></h3>
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis AUM</th>
                    <th>Bobot</th>
                    <th>Predikat</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $key=>$item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->jenis_aum}}</td>
                    <td>{{$item->bobot}}</td>
                    <td>{{$item->predikat}}</td>
                    <td>{{$item->keterangan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <form action="{{route('assesment.next',$id)}}" method="POST" class="form-horizontal form-label-left">
            @csrf
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="setuju" name="setuju">
                <label for="sesi_catatan" class="form-check-label">saya menyetujui Lorem ipsum dolor sit amet
                    consectetur adipisicing elit.
                    Velit
                    faceresequi dolores a voluptate non commodi! Culpa, delectus?</label>
            </div>
            <div class="form-group">
                <label for="sesi_catatan">Berikan Catatan untuk konselor</label>
                <textarea name="sesi_catatan" id="sesi_catatan">{{old('sesi_catatan')}}</textarea>
            </div>
            <input type="submit" value="Lanjut Konsultasi" class="btn btn-primary">
        </form>
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
    $('#sesi_catatan').summernote({
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