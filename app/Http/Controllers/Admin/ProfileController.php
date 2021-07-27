<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;   

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Profile::all();
        return view("admin.profile.index",[
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.profile.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slug = Str::slug($request->profil_nama, "-");
        $request->request->add(['profil_slug' => $slug]);
        $request->request->add(['profil_oleh' => "admin"]);

        $validated = $request->validate([
            'profil_nama' => 'required|max:100',
            'profil_slug' => 'required|max:100',
            'profil_isi' => 'required',
            'profil_oleh' => 'required|max:50',
        ]);

        Profile::create($request->all());

        return redirect()->route('admin.profile')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));
    }

    public function upload(Request $request){
        $file = $request->file('image_upload');

		$nama_file = time()."_".$file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'file-upload';
		$file->move($tujuan_upload,$nama_file);
        return asset($tujuan_upload.'/'.$nama_file);
        // return json_encode(array('test' => "aaaaaaaa"));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(profile $profile)
    {
        //
    }
    
    /**
     * show with name
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    
    public function showByName($slug)
    {
        //
        $data = Profile::where('profil_slug', $slug)->get();
        echo $data[0]->profil_isi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profile $profile)
    {
        //
    }


    public function destroy($id)
    {
        try {
            
            $data = Profile::find($id);
            $data->delete();
            return redirect()->route('admin.profile')->with('message', \GeneralHelper::formatMessage('Berhasil menghapus!', 'info'));

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return redirect()->route('admin.profile')->with('message', \GeneralHelper::formatMessage('Data ini masih digunakan oleh data lain!', 'danger'));
        }

    }
}