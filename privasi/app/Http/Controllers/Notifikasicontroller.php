<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controllers;
use Input;
use DB;
use Redirect;
use View;
use Auth;
use App\Http\Requests\validasilogin;
use App\Http\Requests\validasiregister;
use App\Http\Requests\validasitambahdata;

class Notifikasicontroller extends Controller{

	public function notifikasiruangan(){
		$data = array(
			'komentar' => Input::get('komentar'),
			'ruangan' => Input::get('ruangan'),
			'id_pengirim' => Input::get('id_pengirim'),
			'pengirim' => Input::get('pengirim') 
			);
		DB::table('notif')->insert($data);
		return Redirect::to('/read')->with('message','Berhasil Menambah Notifiksi');
	}

	public function ajaxnotifikasi(){
		$array = DB::table('notif')->where('barang','=','baru')->get();
		$num_rows = mysqli_num_rows($array);
		return echo($array);
	}
}