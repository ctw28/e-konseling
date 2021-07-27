<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;   

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Post::all();
        return view("admin.post.index",[
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
        return view("admin.post.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->post_judul, "-");
        $request->request->add(['post_slug' => $slug]);
        $request->request->add(['post_oleh' => "admin"]);

        $validated = $request->validate([
            'post_judul' => 'required|max:250',
            'post_slug' => 'required|max:300',
            'post_tanggal' => 'required',
            'post_konten' => 'required',
            'post_oleh' => 'required|max:50',
            'post_status' => 'required',
            'post_kategori' => 'required'
        ]);

        Post::create($request->all());

        return redirect()->route('admin.post')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }
    public function showByName($slug)
    {
        //
        $data = Post::where('post_slug', $slug)->get();
        // echo $data[0]->profil_isi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}