@extends('admin.template')

@section('css')
@endsection

@section('content')
@if(session('message')) {!!session('message')!!} @endif

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Post</h3>

        <div class="card-tools">
            <a href="{{route('admin.post.create')}}" class="btn btn-primary" title="Tambah Data">
                <i class="fas fa-plus"></i> &nbsp tambah data
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Judul Post</th>
                    <th>Oleh</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($data as $key=>$item)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->post_kategori}}</td>
                    <td>{{$item->post_tanggal}}</td>
                    <td>{{$item->post_judul}}</td>
                    <td>{{$item->post_oleh}}</td>
                    <td>{{$item->post_status}}</td>
                    <td>
                        <a class="btn btn-sm btn-info" title="Lihat Halaman" @if($item->post_kategori=='berita')
                            href="{{route('web.post.show',$item->post_slug)}}"
                            @else
                            href="{{route('web.psikoedukasi.show',$item->post_slug)}}"
                            @endif>
                            <i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm btn-warning" title="Ubah Data"
                            href="{{route('admin.post.edit',$item->post_slug)}}"><i
                                class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-sm btn-danger" title="Lihat Halaman"
                            onclick="return confirm('Anda yakin hapus data {{$item->profil_nama}}?')"
                            href="{{route('admin.post.destroy', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
<!-- /.card -->
@endsection