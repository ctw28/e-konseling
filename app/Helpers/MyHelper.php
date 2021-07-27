<?php

namespace App\Helpers;

class MyHelper
{

    public static function formatMessage($message, $type)
    {

    return '<div class="alert alert-' . $type . ' alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  '.$message.'
                </div>';
    }

    public static function toRupiah($number)
    {
        if ($number >= 0) {
            return 'Rp. ' . number_format($number, 0, ',', '.');
        } else {
            $input = abs($number) * -1;
            $result = number_format($input);
            return 'Rp. ' . $result;
        }
    }

    // public static function uploadImage(){
    //     $file = $request->file('file_rancangan');

	// 	$nama_file = time()."_".$file->getClientOriginalName();

    //     // isi dengan nama folder tempat kemana file diupload
	// 	$tujuan_upload = 'file-upload';
    //     $request->file_rancangan = $nama_file;
	// 	$file->move($tujuan_upload,$nama_file);
    // }
}