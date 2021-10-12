<!-- jQuery -->
<script src="{{asset('template-admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template-admin/dist/js/adminlte.min.js')}}"></script>

@yield('js')
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template-admin/dist/js/demo.js')}}"></script>

<script>
userAuth();
async function userAuth() {
    const type = "{{auth()->user()->user_role_id}}"
    const id = "{{auth()->user()->iddata}}"
    let userName = "Administrator"
    let url = ""
    if (type == 1)
        return document.querySelector('#user_name').innerText = userName
    else if (type == 2)
        url = `https://sia.iainkendari.ac.id/konseling_api/get_pegawai/${id}`
    else if (type == 3)
        url = `https://sia.iainkendari.ac.id/konseling_api/data_siswa/${id}`

    let response = await fetch(url);
    let responseMessage = await response.json()
    if (type == 2)
        userName = `${responseMessage[0].glrdepan} ${responseMessage[0].nama} ${responseMessage[0].glrbelakang}`
    else if (type == 3)
        userName = responseMessage[0].nama
    document.querySelector('#user_name').innerText = userName
}
</script>