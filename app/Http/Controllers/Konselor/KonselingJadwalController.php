<?php

namespace App\Http\Controllers\Konselor;

use App\Models\Konselor\KonselingJadwal;
use App\Models\Admin\KonselingSesi;
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
            $query->select('id','iddata','sesi_tanggal');
        }])
        ->where(['konselor_id' => 4])
        ->select('id','assesment_sesi_id','konseling_catatan',
                DB::raw("CASE konseling_status
                        WHEN '0' THEN 'Belum Terjadwal'
                        WHEN '1' THEN 'Selesai'
                        END AS konseling_status")
                )
        ->get();
        
        $data->map(function($data){
            $data['assesment_sesi_data'] = $data->assesmentSesiData;
        });
        // return $dataKonselingSesi;
        return view('konselor.data',[
            'data' => $data
        ]);
    }

    public function setSchedule($konselingSesiId){

        $data = KonselingSesi::with(['assesmentSesiData' => function($sesi){
            $sesi->with(['assesmentJawabanData' => function($jawaban){
                $jawaban->with(['getAssesmentById' => function($assesment){
                    $assesment->select('id','jenis_aum_id')->groupBy('jenis_aum_id');
                }])->select('id','assesment_id','assesment_sesi_id','jawaban')->where('jawaban',1);
                // }])->selectRaw('COUNT(id) as total')->where('jawaban',1);
            }])->select('id','iddata','sesi_tanggal','sesi_catatan');
        }, 'konselingJadwalData' => function($jadwal){
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
        
        $data->map(function($data){
            $data['assesment_sesi_data'] = $data->assesmentSesiData;
            $data['konseling_jadwal_data'] = $data->konselingJadwalData;
        });
        
        // return $data;
        return view('konselor.set-jadwal',[
            'data' => $data
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