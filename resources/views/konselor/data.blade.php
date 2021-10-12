@extends('admin.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Konseling</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Asesmen</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Jadwal</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $index => $item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{\Carbon\Carbon::parse($item->assesment_sesi_data['tanggal_sesi'])->format('d M Y')}}</td>
                    <td><span id="nim_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                    <td><span id="nama_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                    <td>{{$item->konseling_catatan}}</td>
                    <td>{{$item->konseling_status}}</td>
                    <td>
                        <a href="{{route('konseling.set', $item->id)}}">Atur</a>
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
    let pegawaiList = {!!json_encode($data->toArray())!!}
    pegawaiList.forEach(data => idPegawaiList.push(data.assesment_sesi_data.user_data.iddata))
    dataSend.append('iddata', JSON.stringify(idPegawaiList))
    let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_mahasiswa", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    responseMessage.forEach(data => {
        document.querySelector('#nim_' + String(data.iddata)).innerHTML = data.nim
        document.querySelector('#nama_' + String(data.iddata)).innerHTML = data.nama
    });
}
</script>
@endsection