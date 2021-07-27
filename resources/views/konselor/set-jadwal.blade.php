@extends('admin.template')

@section('css')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('template-admin/plugins/toastr/toastr.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-5">
            <div class="col-md-12">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>NIM : <span id="nim"></span></li>
                                <li>Nama <span id="nama"></span></li>
                                <li>Fakulastas / Prodi <span id="prodi"></span></li>
                                <li>No. HP <span id="hp"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal Konseling</h3>
                        </div>
                        <div class="card-body">
                            <ul class="todo-list" data-widget="todo-list" id="schedule-list">
                                @foreach ($data[0]->konseling_jadwal_data as $row)
                                <li id="scheduleDate_{{$row->id}}">
                                    <span
                                        class="text">{{\Carbon\Carbon::parse($row->konseling_tanggal)->translatedFormat('l, d F Y')}}</span>
                                    <div class="tools">
                                        <i class="fas fa-trash" onclick="deleteSchedule({{$row->id}})"></i>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="date" name="konseling_tanggal" id="konseling_tanggal" class="form-control">
                                    <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" onclick="addSchedule('{{$data[0]->id}}')">Tambah Jadwal</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger">Tandai Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hasil Asesmen</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>PJK</li>
                            <li>PKK</li>
                            <li>PBA</li>
                        </ul>

                        <h6>Deskripsi Keadaan</h6>
                        {!!$data[0]->assesment_sesi_data->sesi_catatan!!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('js')
<!-- Toastr -->
<script src="{{asset('template-admin/plugins/toastr/toastr.min.js')}}"></script>
<script>
getData();
async function getData() {
    let dataSend = new FormData()
    dataSend.append('iddata', "{{$data[0]->assesment_sesi_data->iddata}}")
    let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_mahasiswa", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    document.querySelector('#nim').innerText = responseMessage[0].nim
    document.querySelector('#nama').innerText = responseMessage[0].nama
    document.querySelector('#hp').innerText = responseMessage[0].hp
}

async function addSchedule(konselingSesiId) {
    let tgl = document.querySelector('#konseling_tanggal');
    if(tgl.value!==""){
        let dataSend = new FormData()
        dataSend.append('konseling_sesi_id', konselingSesiId)
        dataSend.append('konseling_tanggal', tgl.value)
    
        let response = await fetch("{{route('konseling.store')}}", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        let ul = document.querySelector('#schedule-list');
        let li = document.createElement("li");
        li.id = `scheduleDate_${responseMessage.id}`
        li.innerHTML = `<span class="text">${responseMessage.konseling_tanggal}</span>
                        <div class="tools">
                            <i class="fas fa-trash" onclick="deleteSchedule(${responseMessage.id})"></i>
                        </div>`;
        ul.appendChild(li);
        toastr.success('Jadwal telah ditambahkan')
    }
    else{
        alert("Tanggalnya kosong")
        return
    }
}

async function deleteSchedule(scheduleId) {
    if(confirm("Hapus Jadwal??")){
        let dataSend = new FormData()
        let url = ("{{route('konseling.delete',':id')}}");
        url = url.replace(':id', scheduleId)
        let response = await fetch(url)
        let responseMessage = await response.json()
        console.log(responseMessage);
        toastr.warning('Jadwal telah dihapus')
        const scheduleRemoved = document.querySelector(`#scheduleDate_${scheduleId}`) 
        scheduleRemoved.style.backgroundColor = "red"
        window.setTimeout(() => {
            scheduleRemoved.remove()
        }, 100);

    }
}


tes();
async function tes(){
    let dataSend = new FormData()
    dataSend.append('username', '18050102003')
    dataSend.append('password', 'marlinawati')

    let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/login_mhs", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    console.log(responseMessage);
}


</script>
@endsection