<?php

namespace App\Http\Controllers\Konselor;

use App\Models\Konselor\KonselingJadwal;
use App\Models\konselingJadwalData;
use App\Models\Admin\KonselingSesi;
use App\Models\AssesmentJenisAum;
use App\Models\AssesmentSesi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   
use Illuminate\Support\Facades\DB;


class KonselingJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = KonselingSesi::with(['assesmentSesiData' => function($query){
            $query->with(['userData' => function($user){
                $user->select(['id','iddata']);
            }])->select('id','user_id','sesi_tanggal');
        }])
        ->where(['konselor_id' => 2])
        ->select('id','assesment_sesi_id','konseling_catatan',
                DB::raw("CASE konseling_status
                        WHEN '0' THEN 'Belum Terjadwal'
                        WHEN '1' THEN 'Selesai'
                        END AS konseling_status")
                )
        ->get();
        
        // $data->map(function($data){
        //     $data['assesment_sesi_data'] = $data->assesmentSesiData;
        // });
        // return $data;
        return view('konselor.data',[
            'data' => $data
        ]);
    }

    public function setSchedule($konselingSesiId){
        // $data = KonselingSesi::with(['assesmentSesiData' => function($query){
        //     $query->with(['userData'=>function($user){
        //         $user->select(['id','iddata']);
        //     }]);
        // }, 'konselingJadwalData' => function($jadwal){
        //     $jadwal->select('id','konseling_sesi_id','konseling_tanggal','konseling_catatan');
        // }])
        // ->where(['id' => $konselingSesiId])
        // ->select('id','assesment_sesi_id','konseling_catatan',
        //         DB::raw("CASE konseling_status
        //                 WHEN '0' THEN 'Belum Terjadwal'
        //                 WHEN '1' THEN 'Selesai'
        //                 END AS konseling_status")
        //         )
        // ->get();
        $dataKonseling = KonselingSesi::with(['konselingJadwalData' => function($jadwal){
            $jadwal->select('id','konseling_sesi_id','konseling_tanggal','konseling_catatan');
        }])
        ->where(['id' => $konselingSesiId])
        ->select('id','assesment_sesi_id','konseling_catatan',
                DB::raw("CASE konseling_status
                        WHEN '0' THEN 'Belum Terjadwal'
                        WHEN '1' THEN 'Selesai'
                        END AS konseling_status")
                )
        ->get();

        $data = AssesmentSesi::with(['userData' => function($user){
                $user->select(['id','iddata']);
            }])->where('id', $konselingSesiId)->first();
        
        $assesmentSesiId = $data->id;
        // return $assesmentSesiId;
        $dataAsesmen = AssesmentJenisAum::withCount(['answers'=> function($assesment) use($assesmentSesiId){
                            $assesment->where(['assesment_sesi_id' => $assesmentSesiId,'jawaban'=>"1"]);
                        }])->orderBy('answers_count', 'desc')->get();
        $dataAsesmen->map(function($data){
                $bobot = round($data->answers_count / 30 * 100, 2);
                $classification = (object) $this->getClassification($bobot);
                $data->bobot = $bobot;
                $data->predikat = $classification->predikat;
                $data->keterangan = $classification->keterangan;  
                unset($data->answers);
            });            
        // return $data;
        return view('konselor.set-jadwal',[
            'data' => $data,
            'data_konseling' => $dataKonseling,
            'data_asesmen' => $dataAsesmen,
        ]);
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

    public function finish(Request $request){
        $sesi = KonselingSesi::find($request->id);
        return $sesi;
        // $flight->name = 'Paris to London';
        // $flight->save();
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
            $save = KonselingJadwal::create($request->all());
            return array(
                "id"=> $save->id,
                "konseling_tanggal"=> \Carbon\Carbon::parse($request->konseling_tanggal)->translatedFormat('l, d F Y'),
            );
            // return $save;
        }
        catch(\Exception $e){
            return array('status'=>$e->getMessage());
            // return array('status'=>"failed");
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KonselingJadwal  $konselingJadwal
     * @return \Illuminate\Http\Response
     */
    public function show(KonselingJadwal $konselingJadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KonselingJadwal  $konselingJadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(KonselingJadwal $konselingJadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KonselingJadwal  $konselingJadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KonselingJadwal $konselingJadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KonselingJadwal  $konselingJadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = KonselingJadwal::find($id);
            $data->delete();
            return array('status' => 'succes');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo );
            return array('status' => 'failed');
        }
    }
}