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
                                @foreach ($data_konseling[0]->konselingJadwalData as $row)
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
                                    <input type="date" name="konseling_tanggal" id="konseling_tanggal"
                                        class="form-control">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary"
                                            onclick="addSchedule('{{$data->id}}')">Tambah Jadwal</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger" id="finish-button">Tandai Selesai</button>
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
                        <h6>Catatan Mahasiswa</h6>
                        <blockquote>
                            {!!$data->sesi_catatan!!}
                        </blockquote>


                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#info-asesmen">
                            Lihat Hasil Asesmen
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<div class="modal fade" id="info-asesmen">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Asesmen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        @foreach ($data_asesmen as $key=>$item)
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Nanti Saja</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section('js')
<!-- Toastr -->
<script src="{{asset('template-admin/plugins/toastr/toastr.min.js')}}"></script>
<script>
getData();
async function getData() {
    let dataSend = new FormData()
    dataSend.append('iddata', "{{$data->userData->iddata}}")
    let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_mahasiswa", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()
    console.log(responseMessage);
    document.querySelector('#nim').innerText = responseMessage[0].nim
    document.querySelector('#nama').innerText = responseMessage[0].nama
    document.querySelector('#hp').innerText = responseMessage[0].hp
}

async function addSchedule(konselingSesiId) {
    let tgl = document.querySelector('#konseling_tanggal');
    if (tgl.value !== "") {
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
    } else {
        alert("Tanggalnya kosong")
        return
    }
}

async function deleteSchedule(scheduleId) {
    if (confirm("Hapus Jadwal??")) {
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

let buttonFinish = document.querySelector('#finish-button')
buttonFinish.onclick = async function() {
    let dataSend = new FormData()
    dataSend.append('id', 1)
        let response = await fetch("{{route('konseling.finish')}}", {
        method: "POST",
        body: dataSend
    });
    let responseMessage = await response.json()    
    console.log(responseMessage);
}

</script>
@endsection