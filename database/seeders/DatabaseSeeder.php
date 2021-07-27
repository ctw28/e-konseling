<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users_roles')->insert(
            ['nama_role' => 'admin'],
            ['nama_role' => 'konselor'],
            ['nama_role' => 'user']
        );

        DB::table('assesment_jenis_aums')->insert([
            ['jenis_aum' => 'Perkembangan Kesehatan Jasmani', 'singkatan' => 'PJK'],
            ['jenis_aum' => 'Keuangan Lingkungan Pekerjaan', 'singkatan' => 'KLP'],
            ['jenis_aum' => 'Kegiatan Sosial dan Rekreasi', 'singkatan' => 'KSR'],
            ['jenis_aum' => 'Hubungan Pacaran dan Perkawinan', 'singkatan' => 'HPP'],
            ['jenis_aum' => 'Hubungan Sosial Kejiwaan', 'singkatan' => 'HSK'],
            ['jenis_aum' => 'Keadaan Pribadi dan Kejiwaan', 'singkatan' => 'KPK'],
            ['jenis_aum' => 'Moral Sopan Santun dan Agama', 'singkatan' => 'MSA'],
            ['jenis_aum' => 'Keadaan Rumah Tangga dan Keluarga', 'singkatan' => 'KRK'],
            ['jenis_aum' => 'Masa Depan Pendidikan dan Pekerjaan', 'singkatan' => 'MPP'],
            ['jenis_aum' => 'Penyesuaian Terhadap Tugas-Tugas Kuliah', 'singkatan' => 'PTS'],
            ['jenis_aum' => 'Kurikulum dan Prosedur Pengajaran', 'singkatan' => 'KPP']
        ]);
        
        // DB::table('assesment_sesis')->insert([
        //     'user_id' => '1', 
        //     'sesi_kode' => 'xxxxxxx', 
        //     "sesi_catatan" => "",
        //     "sesi_status" => "0",
        //     "sesi_tanggal"=>"2021-07-14 03:13:24"        
        // ]);

        // $user = [
        //     [
        //         'name' => '123456',
        //         'email' => 'gg@gmail.com',
        //         'password' => bcrypt('1234qwer')
        //     ]

        // ];
        // DB::table('users')->insert($user);
    }
    
}