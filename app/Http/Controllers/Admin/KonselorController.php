<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Konselor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   


class KonselorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataKonselor = konselor::all();
        return view("admin.konselor.index",[
            "data"=> $dataKonselor
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.konselor.create");
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'konselor_pegawai_id' => 'required',
            'konselor_bidang' => 'required'
        ]);

        Konselor::create($request->all());

        return redirect()->route('admin.konselor')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konselor  $konselor
     * @return \Illuminate\Http\Response
     */
    public function show(Konselor $konselor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konselor  $konselor
     * @return \Illuminate\Http\Response
     */
    public function edit(Konselor $konselor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konselor  $konselor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konselor $konselor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konselor  $konselor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konselor $konselor)
    {
        //
    }
}
