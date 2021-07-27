<?php

namespace App\Http\Controllers\User;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentSesi;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;


class AssesmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        return view("user.dashboard");
    }
    public function startSesi(Request $request){
        $create = AssesmentSesi::create($request->all());
        return $create;

    }
    public function form()
    {
        //
        // $data['dataSesi'] = AssesmentSesi::where(['iddata' => 1720185975,'sesi_status'=>"0"])->get();
        $data['dataSesi'] = AssesmentSesi::where(['user_id' => auth()->user()->id])->get();
        // return auth()->user()->id;
        return view("user.assesment.form", [
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
        
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $checkCurrent =(['assesment_id' => $request->assesment_id, 
                'assesment_sesi_id' => $request->assesment_sesi_id]);
            $jawaban = AssesmentAnswer::updateOrCreate(
                $checkCurrent,
                ['jawaban'=> $request->jawaban]
            );
            return array('status'=>1);
        }
        catch(\Exception $e){
            // return array('status'=>$e->getMessage());
            return array('status'=>0);
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function show($no_urut)
    {
        $data =  Assesment::where('no_urut', $no_urut)->get();        
        $data->map(function($data){
            $jawaban = AssesmentAnswer::where(['assesment_id' => $data->id, 'assesment_sesi_id'=>2])->get();
            (count($jawaban)>0) ? $data['jawaban'] = $jawaban[0]->jawaban : $data['jawaban']="";
        });
        return $data;
    }

    public function getScore($id){
        try{
            
            $sesi = AssesmentSesi::findOrFail(Crypt::decrypt($id));

            $sesi->update(
                ['sesi_status' => "1"]
            );
            $data = DB::select('SELECT assesment_jenis_aums.jenis_aum, assesment_jenis_aums.singkatan, COUNT(COALESCE(assesment_jenis_aums.singkatan,0)) as jumlah 
            FROM assesments 
            INNER JOIN assesment_jenis_aums ON assesment_jenis_aums.id = assesments.jenis_aum_id 
            INNER JOIN assesment_jawabans ON assesment_jawabans.assesment_id=assesments.id 
            WHERE assesment_jawabans.assesment_id IN (SELECT assesment_id FROM assesment_jawabans) AND assesment_jawabans.jawaban="1" 
            GROUP BY assesment_jenis_aums.singkatan');
            collect($data)->map(function($data){
                $bobot = round($data->jumlah / 30 * 100, 2);
                $classification = (object) $this->getClassification($bobot);
                $data->bobot = $bobot;
                $data->predikat = $classification->predikat;
                $data->keterangan = $classification->keterangan;            
            });
            
            return view("user.assesment.score", [
                "data" => $data,
                "id" => $id
            ]);
        }
        catch(\Exception $e){
            return array('status'=>$e->getMessage());
            // return array('status'=>"Ada Kesalahan Sistem, Mohon coba lagi");
         }
    }

    public function next(Request $request, $id){
        $next = AssesmentSesi::findOrFail(Crypt::decrypt($id));
        $next->update(
            ['sesi_catatan' => $request->sesi_catatan]
        );
        return view("user.assesment.finish"); 
    }
    
    public function getClassification($bobot){
        if($bobot==0)
            return array("predikat"=>"A","keterangan"=>"Baik");
        else if($bobot > 0 AND $bobot < 11)
            return array("predikat"=>"B","keterangan"=>"Cukup Baik");
        else if($bobot >= 11 AND $bobot < 26)
            return array("predikat"=>"C","keterangan"=>"Cukup");
        else if($bobot >= 26 AND $bobot < 51)
            return array("predikat"=>"D","keterangan"=>"Kurang");
        else if($bobot >= 51)
            return array("predikat"=>"E","keterangan"=>"Kurang Sekali");
    }

    public function getAnswered($sessionId)
    {
        $data =  AssesmentAnswer::where('assesment_sesi_id', $sessionId)->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assesment $assesment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assesment $assesment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assesment  $assesment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assesment $assesment)
    {
        //
    }
}