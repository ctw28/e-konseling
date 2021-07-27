@extends('admin.template')

@section('content')
<h1>Selamat Datang</h1>


<form action="{{route('assesment.start')}}" method="POST">
    @csrf
    <input name="user_id" type="hidden" value="{{auth()->user()->id}}">
    <input type="submit" value="Mulai Asesmen">
</form>


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