<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Models\Admin\KonselingSesi;
use App\Models\Admin\Konselor;
use App\Models\AssesmentSesi;
use Illuminate\Http\Request;
use App\Models\KonselingDaftarTunggu;


class KonselingSesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = KonselingDaftarTunggu::with(['assesmentSesiData'=> function($query){
            $query->with(['userData'=>function($user){
                $user->select(['id','iddata']);
            }]);
        }])->get();
        // return $data;
        $konselor = Konselor::with(['userData'])->get();
        // return $konselor;
        return view('admin.konseling.daftar-tunggu',[
            "data" => collect($data),
            "konselor" => $konselor
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

        try{
            $save = KonselingSesi::updateOrcreate(
                ['assesment_sesi_id'=>$request->assesment_sesi_id],
                ['konselor_id'=>$request->konselor_id]);
            return json_encode(array("status"=>"success"));
        }
        catch(\Exception $e){
            return array('status'=>$e->getMessage());
            // return array('status'=>"failed");
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KonselingSesi  $konselingSesi
     * @return \Illuminate\Http\Response
     */
    public function show(KonselingSesi $konselingSesi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KonselingSesi  $konselingSesi
     * @return \Illuminate\Http\Response
     */
    public function edit(KonselingSesi $konselingSesi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KonselingSesi  $konselingSesi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KonselingSesi $konselingSesi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KonselingSesi  $konselingSesi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KonselingSesi $konselingSesi)
    {
        //
    }
}