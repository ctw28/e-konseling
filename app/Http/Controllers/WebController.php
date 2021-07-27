<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profile;
use App\Models\Post;


class WebController extends Controller
{

    public function index()
    {
        $data['menuProfil'] = profile::all();
        return view('web.home', [
            "data" => $data,
            "title" => 'Beranda'
        ]);
        // return Http::dd()->get('https://sia.iainkendari.ac.id/konseling_api/data_pegawai');
        // $data = json_decode(file_get_contents('https://sia.iainkendari.ac.id/konseling_api/data_pegawai'),true);
        // return $data[0]['nama'];
        

        // $client = new Client();
        // // $client->setDefaultOption('verify', false);

        // $res = $client->request('GET', 'https://sia.iainkendari.ac.id/konseling_api/data_pegawai',[
        //     'verify' => false
        // ]);

        // $result= $res->getBody();
        // return $result;
        // dd($result);

        // $response = Http::withOptions(['verify' => false,])->get('https://sia.iainkendari.ac.id/konseling_api/data_pegawai');
        // return $response->getBody();

    }
    public function profil($slug)
    {
        $data['dataPages'] = profile::where('profil_slug', $slug)->get();
        $data['menuProfil'] = profile::all();
        return view('web.pages', [
            "data" => $data,
            "title" => 'Profil'
        ]);
    }

    public function post($slug)
    {
        //
        $data['dataPages'] = Post::where('post_slug', $slug)->get();
        $data['menuProfil'] = profile::all();
        return view('web.post', [
            "data" => $data,
             "title" => 'Post'
       ]);
    }
}