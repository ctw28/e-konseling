@extends('admin.template')


@section('content')
@if(session('message')) {!!session('message')!!} @endif

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Halaman Profil</h3>

        <div class="card-tools">
            <a href="{{route('admin.profile.create')}}" class="btn btn-primary" title="Tambah Data">
                <i class="fas fa-plus"></i> &nbsp tambah data
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Menu</th>
                    <th>Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $key=>$item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->profil_nama}}</td>
                    <td>{{$item->profil_oleh}}</td>
                    <td>
                        <a class="btn btn-sm btn-info" title="Lihat Halaman"
                            href="{{route('web.profile.show',$item->profil_slug)}}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm btn-warning" title="Ubah Data"
                            href="{{route('admin.profile.edit',$item->profil_slug)}}"><i
                                class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-sm btn-danger" title="Lihat Halaman"
                            onclick="return confirm('Anda yakin hapus data {{$item->profil_nama}}?')"
                            href="{{route('admin.profile.destroy', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->




@endsection