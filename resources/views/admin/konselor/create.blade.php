@extends('admin.template')

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="../../template-admin/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="../../template-admin/plugins/select2/css/select2.min.css">
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
        <h3 class="card-title">Tambah Konselor</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.konselor.store')}}" method="POST" class="form-horizontal form-label-left">
            @csrf
            <div class="form-group">
                <label for="konselor_pegawai_id">Konselor</label>
                <select id="konselor_pegawai_id" name="konselor_pegawai_id" class="form-control select2" style="width: 100%;" required>
                    <option value="">Pilih Konselor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="konselor_bidang">Bidang</label>
                <input type="text" class="form-control" id="konselor_bidang" name="konselor_bidang" placeholder=""
                    value="{{old('konselor_bidang')}}">
            </div>

            <div class="form-group">
                <label for="konselor_keterangan">Deskripsi</label>
                <textarea name="konselor_keterangan" id="konselor_keterangan"></textarea>
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

<!-- Select2 -->
<script src="../../template-admin/plugins/select2/js/select2.full.min.js"></script>

<!-- Page specific script -->
<script>
$(function() {
    // Summernote
    $('#konselor_keterangan').summernote({
        height: 250,
        callbacks: {
            onImageUpload: function(image) {
                sendFile(image[0]);
            }
        }
    })
    $('.select2').select2()
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
    getDataPegawai();
    async function getDataPegawai() {
        let url = "https://sia.iainkendari.ac.id/konseling_api/data_pegawai"
        let response = await fetch(url)
        let responseMessage = await response.json()
        let select = document.querySelector('#konselor_pegawai_id')
        responseMessage.map(data => {
            let opt = document.createElement('option')
            opt.value = data.idpegawai
            opt.innerHTML = data.nip+" - "+data.glrdepan+" "+data.nama+" "+data.glrbelakang
            select.appendChild(opt)
        });

    }

})
</script>

@endsection