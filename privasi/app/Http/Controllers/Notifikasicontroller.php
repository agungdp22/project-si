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

	public function ruanganpesan(){
		$data = array(
			'namaruangan' => Input::get('namaruangan'),
			'namapengirim' => Input::get('namapengirim'),
			'penerima' => Input::get('penerima'),
			'lokasiruangan' => Input::get('lokasiruangan'),
			'isipesan' => Input::get('isipesan'),
			'tipe' => Input::get('tipe'),
			'status' => Input::get('status')
			);
		DB::table('pesan')->insert($data);
		return back()->with('message','Berhasil Mengirim Pesan');
	}

	public function lihatsemuapesan(){
		// $updatenotif = array('status' => 0);
		$data = DB::table('pesan')->where('tipe','=','admin')->orderby('status','desc')->orderby('id','desc')->get();
		$datauser = DB::table('pesan')->where('tipe','=','user')->where('penerima','=',Auth::user()->namalengkap)->orderby('status','desc')->orderby('id','desc')->get();
		return View::make('pesan')->with('pesanadmin',$data)->with('pesanuser',$datauser);
	}

	public function deletepesan($id){
		DB::table('pesan')->where('id','=',$id)->delete();
		return back();
	}

	public function hapuspesan($id){
		DB::table('pesan')->where('id','=',$id)->delete();
		return back();
	}

	public function notif(){
		$data = DB::table('pesan')->get();
		return View::make('notifikasi')->with('notif',$data);
	}
}