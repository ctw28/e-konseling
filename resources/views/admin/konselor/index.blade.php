@extends('admin.template')


@section('content')
@if(session('message')) {!!session('message')!!} @endif

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Konselor</h3>

        <div class="card-tools">
            <a href="{{route('admin.konselor.create')}}" class="btn btn-primary" title="Tambah Data">
                <i class="fas fa-plus"></i> &nbsp tambah data
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIP</th>
                    <th>Nama Konselor</th>
                    <th>Bidang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $key=>$item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td><span id="nip_{{$item->userData->iddata}}"></span></td>
                    <td><span id="nama_{{$item->userData->iddata}}"></span></td>
                    <td>{{$item->konselor_bidang}}</td>
                    <td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
    getData();
    async function getData() {
        let dataSend = new FormData()
        let idPegawaiList = []
        let pegawaiList = {!! json_encode($data->toArray()) !!}
        pegawaiList.forEach(data => idPegawaiList.push(data.user_data.iddata))
        dataSend.append('konselor_pegawai_id', JSON.stringify(idPegawaiList))
        let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_konselor", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        responseMessage.forEach(data => {
            console.log(data.nip);
            document.querySelector('#nip_'+String(data.idpegawai)).innerText = data.nip
            document.querySelector('#nama_'+String(data.idpegawai)).innerText = `${data.glrdepan} ${data.nama} ${data.glrbelakang}`
        });
    }

    
</script>
@endsection