@extends('admin.template')

@section('css')
@endsection
@section('content')
<div class="col-sm-6">
    <h1 class="m-0">Selamat Datang Admin</h1>
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


@endsection
@section('js')