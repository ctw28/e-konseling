@extends('admin.template')

@section('css')
@endsection
@section('content')
<div class="col-sm-6">
    <h1 class="m-0">Selamat Datang Konselor, </h1>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Konseling Selesai</span>
                    <span class="info-box-number">{{$data['konselingFinish']}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Konseling Berjalan</span>
                    <span class="info-box-number">{{$data['konselingProgres']}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-calendar-times"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Belum Terjadwal</span>
                    <span class="info-box-number">{{$data['konselingNotSchedule']}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Daftar Konseling Terjadwal</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>No. Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['KonselingData'] as $index => $item)
                        <tr>
                            <td>{{$index+1}}</td>
                            @foreach ($item->konselingJadwalData as $jadwal)
                                <td class="text-success"><b>{{\Carbon\Carbon::today()->diffForHumans($jadwal['konseling_tanggal'])}}</b></td>
                            @endforeach
                            <td><span id="nama_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                            <td><span id="prodi_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                            <td><span id="hp_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                            <td>
                                <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-text-width"></i>
                    Informasi Aplikasi
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nama Aplikasi</dt>
                    <dd class="col-sm-8">E-Konseling</dd>
                    <dt class="col-sm-4">Versi</dt>
                    <dd class="col-sm-8">1.0
                    </dd>
                    <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                    <dt class="col-sm-4">Malesuada porta</dt>
                    <dd class="col-sm-8">Etiam porta sem malesuada magna mollis euismod.</dd>
                    <dt class="col-sm-4">Felis euismod semper eget lacinia</dt>
                    <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                        fermentum massa justo
                        sit amet risus.
                    </dd>
                </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- ./col -->
</div>
@endsection
@section('js')
<script>
    getData();
    async function getData() {
        let dataSend = new FormData()
        let idPegawaiList = []
        let pegawaiList = {!! json_encode($data['KonselingData']->toArray()) !!}
        pegawaiList.forEach(data => idPegawaiList.push(data.assesment_sesi_data.user_data.iddata))
        dataSend.append('iddata', JSON.stringify(idPegawaiList))
        let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_mahasiswa", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        console.log(responseMessage);
        responseMessage.forEach(data => {
            document.querySelector('#nama_'+String(data.iddata)).innerText = data.nama
            document.querySelector('#hp_'+String(data.iddata)).innerText = data.hp
            document.querySelector('#prodi_'+String(data.iddata)).innerText = data.idprodi
        });
    }
</script>
@endsection