@extends('admin.template')

@section('css')
  <!-- Toastr -->

<link rel="stylesheet" href="{{asset('template-admin/plugins/toastr/toastr.min.css')}}">

<style>
    .selected {
  background: #868686;
  color: white;
}
#konselor-table tr:hover{
    cursor : pointer;
}
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Tunggu Konseling</h3>
        
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Assesment</th>
                    <th>Tanggal</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>No. Handphone</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $key=>$item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->assesmentSesiData->sesi_kode}}</td>
                    <td>{{$item->assesmentSesiData->sesi_tanggal}}</td>
                    <td><span id="nim_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                    <td><span id="nama_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                    <td><span id="hp_{{$item->assesmentSesiData->userData->iddata}}"></span></td>
                    <td>{!!$item->assesmentSesiData->sesi_catatan!!}</td>
                    <td>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg" onclick="chooseKonselor({{$item->assesmentSesiData->id}})">
                            Pilih Konselor
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tentukan Konselor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="konselor-table">
                    <thead style="background-color:#17a2b8 !important; color:white">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Spesialis</th>
                            <th>Konseling Berlangsung</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 1 @endphp
                    @foreach ($konselor as $key=>$item)
                    <tr data-konselor-id="{{$item->id}}">
                        <th>{{$i++}}</th>
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
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                <button type="button" class="btn btn-info" id="save">Pilih</button>
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
    getDataMahasiswa();
    async function getDataMahasiswa() {
        let dataSend = new FormData()
        let idDataList = []
        let mahasiswaList = {!!json_encode($data->toArray()) !!}
        mahasiswaList.forEach(data => {
            // console.log(data.user_data.iddata)
            idDataList.push(data.assesment_sesi_data.user_data.iddata)
        })
        console.log(idDataList);
        dataSend.append('iddata', JSON.stringify(idDataList))

        let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_mahasiswa", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        console.log(responseMessage)
        responseMessage.forEach(data => {
            // console.log(data);
            document.querySelector('#nim_' + data.iddata).innerText = data.nim
            document.querySelector('#nama_' + data.iddata).innerText = data.nama
            document.querySelector('#hp_' + data.iddata).innerText = data.hp
        });

    }
    
    async function chooseKonselor(assesment_id) {
        document.querySelectorAll(".selected").forEach(obj=>obj.classList.remove("selected"));
        let dataSend = new FormData()
        let idPegawaiList = []
        let buttonSave = document.querySelector('#save')
        buttonSave.setAttribute('onclick', 'save('+assesment_id+')');
        let pegawaiList = {!!json_encode($konselor->toArray()) !!}
        console.log(pegawaiList);
        pegawaiList.forEach(data => idPegawaiList.push(data.user_data.iddata))
        dataSend.append('konselor_pegawai_id', JSON.stringify(idPegawaiList))
        let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/data_konselor", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        responseMessage.forEach(data => {
            document.querySelector('#nip_'+String(data.idpegawai)).innerHTML = data.nip
            document.querySelector('#nama_'+String(data.idpegawai)).innerHTML = data.glrdepan+" "+data.nama+" "+data.glrbelakang        
        });
    }

    document.querySelector('#konselor-table').addEventListener('click', function(e) {
        let closestCell = e.target.closest('tr') // identify the closest tr when the click occured
        let activeCell = e.currentTarget.querySelector('tr.selected'); // identify the already selected tr
        closestCell.classList.add('selected'); // add the "selected" class to the clicked tr
        if (activeCell) activeCell.classList.remove('selected'); // remove the "selected" class from the previously selected tr
    })

    async function save(assesment_id){
        let dataSend = new FormData()
        dataSend.append('konselor_id', document.querySelector('tr.selected').getAttribute('data-konselor-id'))
        dataSend.append('assesment_sesi_id', assesment_id)

        let response = await fetch("{{route('konseling.save')}}", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        console.log(responseMessage)
        $('#modal-lg').modal('hide');
        toastr.success('Konselor Telah dipilih')


    }

</script>

@endsection