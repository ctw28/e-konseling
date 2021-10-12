@extends('admin.template')

@section('css')
@endsection
@section('content')
<div class="col-sm-6">
    <h1 class="m-0">Selamat Datang</h1>
</div>

<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-info-circle"></i>
                Tentang E-Konseling
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="callout callout-info">
                <h5>Mengapa harus konseling</h5>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sed repellendus neque rerum similique
                    nobis corrupti, quisquam a amet optio laboriosam debitis numquam dicta temporibus, sapiente nulla
                    minus, molestias ratione.</p>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="col-md-6">
    <div class="card card-default">
        <div class="card-body">
            <h5>Informasi dan Aktivitas</h5>
            <p>Anda belum melakukan asesmen.</p>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#info-asesmen">
                Mulai Asesmen
            </button>

        </div>
    </div>
</div>


<div class="modal fade" id="info-asesmen">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Jangan Takut Asesmen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Pengantar</h5>
                <p>
                    Alat Ukur Mandiri (AUM) ini wajib dilakukan oleh mahasiswa IAIN Kendari sebelum menjalani
                    proses konseling pada konselor. Anda diminta untuk membaca informasi berikut dengan cermat.
                    Jika terdapat hal yang belum jelas, Anda dapat bertanya secara langsung melalui layanan
                    informasi untuk menjelaskan hal-hal yang belum dipahami.
                </p>
                <h5>Mengapa AUM ini dilakukan?</h5>
                <p>
                    AUM ini dilakukan untuk mengetahui bagaimana dinamika psikologis Mahasiswa IAIN Kendari
                    sebagai individu yang memiliki perbedaan karakteristik dengan individu yang lainnya.
                </p>
                <h5>Apa yang Anda lakukan dalam AUM ini?</h5>
                <p>
                    Konselor akan meminta Anda untuk mengisi sejumlah pernyataan tentang kondisi Anda yang dalam
                    berbagai aspek kehidupan termasuk sikap Anda dalam menjalani aktivitas. Beberapa pernyataan
                    juga akan menanyakan keadaan keluarga Anda secara umum dan meminta Anda untuk menjawab
                    seluruh rangkaian pernyataan yang telah diisi dalam batas waktu yang telah ditentukan.
                </p>
                <h5>Bagaimana kerahasiaan Mahasiswa dilindungi?</h5>
                <p>
                    Privasi Anda adalah sangat penting untuk konselor. Seluruh data informasi yang Anda berikan
                    tidak akan diperlihatkan kepada pihak lain yang tidak berkepentingan dalam proses konseling
                    ini. Semua catatan akan disimpan dengan cermat oleh konselor. Nama asli Anda dan identitas
                    lainnya tidak akan ditulis dalam laporan ataupun artikel-artikel yang bersangkutan dengan
                    web konseling.
                </p>
                <h5>Bagaimana jika saya tidak menyelesaikan AUM?</h5>
                <p>
                    Anda sepenuhnya bebas menentukan untuk berpartisipasi atau tidak. Keputusan Anda akan
                    berpengaruh terhadap keberlanjutan proses konseling. Jika di tengah pengisian Anda terhenti
                    mengisi karena alasan teknis maupun non teknis, Anda boleh melanjutkan dilain waktu tanpa
                    harus mengulang pengisian dari awal. Anda dapat berhenti dan mengundurkan diri kapanpun Anda
                    mau, bahkan jika pengisian AUM sudah dilakukan.
                </p>
                <h5>Dimana saya bisa mendapatkan informasi lebih lanjut?</h5>
                <p>
                    Bila Anda memiliki pertanyaan tentang AUM ini atau keikutsertaan, Anda dapat menghubungi
                    layanan Web Konseling (Admin) pada kolom Q n A.
                </p>
                <p>
                <h5>Bagaimana cara saya menyatakan persetujuan untuk berpartisipasi?</h5>
                Anda dapat menyatakan persetujuan pada lembar persetujuan Konseling Online dengan mencentang
                persetujuan konseling.

                </p>
                <div style="text-align: justify;"><br></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Nanti Saja</button>
                <form action="{{route('assesment.start')}}" method="POST">
                    @csrf
                    <input name="user_id" type="hidden" value="{{auth()->user()->id}}">
                    <input type="submit" class="btn btn-primary" value="Mulai Asesmen Sekarang">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('js')


<!-- <script>
    islogin();
    async function isLogin() {
        let dataSend = new FormData()
        dataSend.append('username', username)
        dataSend.append('password', password)
        // dataSend.append('username', '18050102003')
        // dataSend.append('password', 'marlinawati')

        let response = await fetch("https://sia.iainkendari.ac.id/konseling_api/login_mhs", {
            method: "POST",
            body: dataSend
        });
        let responseMessage = await response.json()
        if (responseMessage.login === true) {
            localStorage.setItem('token_mhs', responseMessage.token)
            window.location.href = "{{route('user.dashboard')}}"
        } else {
            alert("username dan password tidak sesuai")
        }
    }
    </script> -->
@endsection