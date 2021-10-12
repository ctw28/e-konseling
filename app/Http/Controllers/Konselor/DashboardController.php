<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\KonselingSesi;
use App\Models\Admin\Konselor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
    
        $konselor = Konselor::where('user_id',auth()->user()->id)->first();
        $data=[];
        if($konselor){
            $data['KonselingData'] = KonselingSesi::with(['assesmentSesiData' => function($query){
                $query->with(['userData' => function($user){
                    $user->select(['id','iddata']);
                }])->select('id','user_id','sesi_tanggal');
            },'konselingJadwalData'=>function($konselingJadwal){
                $konselingJadwal->where('konseling_tanggal', '>=', Carbon::today()->toDateString())->orderBy('konseling_tanggal', 'ASC');
            }])
            ->where(['konselor_id' => $konselor->id , 'konseling_status' => '0'])
            ->whereHas('konselingJadwalData')
            ->get();
        }
        // $data['KonselingData']->map(function($data){
        //     $data->konseling_jadwal_data = $data->konselingJadwalData[0];
        //     unset($data->konselingJadwalData);
        // });
        $data['konselingFinish'] = KonselingSesi::where(['konselor_id'=>$konselor->id,'konseling_status'=>'1'])->count();
        $data['konselingProgres'] = KonselingSesi::where(['konselor_id'=>$konselor->id,'konseling_status'=>'0'])->whereHas('konselingJadwalData')->count();
        $data['konselingNotSchedule'] = KonselingSesi::where(['konselor_id'=>$konselor->id,'konseling_status'=>'0'])->doesntHave('konselingJadwalData')->count();
        // $data['test'] = Carbon::today()->toDateString();
        // return $data;
        return view('konselor.dashboard', [
            'data' => collect($data)
        ]);
    }
}