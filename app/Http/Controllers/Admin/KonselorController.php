<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Konselor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   
use Illuminate\Support\Facades\DB;

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
        $dataKonselor = Konselor::with(['userData'=>function($query){
            $query->select(['id','iddata']);
        }])->get();
        // return $dataKonselor;
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

        DB::beginTransaction();
        try{
            $user = User::create(['iddata'=> $request->konselor_pegawai_id, "password"=>bcrypt('1234qwer'), 'user_role_id'=> 2 ]);
            Konselor::create([
                "user_id"=>$user->id,
                'konselor_bidang' => $request->konselor_bidang,
                'konselor_keterangan' => $request->konselor_keterangan
            ]);
            DB::commit();
            return redirect()->route('admin.konselor')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('admin.konselor')->with('message', \GeneralHelper::formatMessage('Ada kesalahan !', 'Failed'));
        }
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
