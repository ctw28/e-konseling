<?php

namespace App\Http\Controllers\User;

use App\Models\Assesment;
use App\Models\AssesmentAnswer;
use App\Models\AssesmentJenisAum;
use App\Models\AssesmentSesi;
use App\Models\Admin\KonselingSesi;
use App\Models\KonselingDaftarTunggu;

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

    public function info(){
        
        return view("user.assesment.info");
    }
    public function startSesi(Request $request){
        $checkSesi = AssesmentSesi::where(['user_id'=>$request->user_id,'sesi_status'=>"0"])->first();
        // $allowAssesment = AssesmentSesi::where('user_id', $request->user_id)->orderBy('sesi_tanggal','desc  ')->first();
        // return $allowAssesment;
        // if($allowAssesment->sesi_status=="1"){
        //     return redirect()->route('assesment.score',Crypt::encrypt($allowAssesment->id));
        // }
        // if($allowAssesment->sesi_status=="0"){
        //     return redirect()->route('assesment.form',Crypt::encrypt($allowAssesment->id));
        // }

        if($checkSesi==null){
            $create = AssesmentSesi::create($request->all());
            return redirect()->route('assesment.form',Crypt::encrypt($create->id));
        }
        return redirect()->route('assesment.form',Crypt::encrypt($checkSesi->id));
            
    }
    public function form($id)
    {
        //
        // $data['dataSesi'] = AssesmentSesi::where(['iddata' => 1720185975,'sesi_status'=>"0"])->get();
        $data['dataSesi'] = AssesmentSesi::find(Crypt::decrypt($id));
        // return auth()->user()->id;
        // return $data;
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
    public function show($id, $no_urut)
    {
        $data['jawaban'] = AssesmentAnswer::where(['assesment_sesi_id'=> $id,'assesment_id'=>$no_urut])->first();
        $data['soal'] = Assesment::where('no_urut', $no_urut)->first();
        return $data;
    }

    public function getScore($id){
        try{
            
            $sesi = AssesmentSesi::findOrFail(Crypt::decrypt($id));

            $sesi->update(
                ['sesi_status' => "1"]
            );
            $assesmentSesiId = $sesi->id;
            $data = AssesmentJenisAum::withCount(['answers'=> function($assesment) use($assesmentSesiId){
                        $assesment->where(['assesment_sesi_id' => $assesmentSesiId,'jawaban'=>"1"]);
                    }])->orderBy('answers_count', 'desc')->limit(3)->get();
            $data->map(function($data){
                $bobot = round($data->answers_count / 30 * 100, 2);
                $classification = (object) $this->getClassification($bobot);
                $data->bobot = $bobot;
                $data->predikat = $classification->predikat;
                $data->keterangan = $classification->keterangan;  
                unset($data->answers);
            });
            // return $data;
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
            [
                'sesi_catatan' => $request->sesi_catatan,
                'lanjut_konseling' => "1"
            ]
        );
        $save = KonselingDaftarTunggu::insert(
                [
                    'assesment_sesi_id'=>$next->id
                ]);

        // return $save;
        
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