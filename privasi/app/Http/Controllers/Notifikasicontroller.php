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

	public function lihatsemuapesan($tipe){
		$sesi = Auth::user()->hak_akses;
		if($sesi == "admin"){
			$data = DB::table('pesan')->where('tipe','=',$sesi)->orderby('status','desc')->orderby('id','desc')->paginate(5);
		 }
		else if($sesi == "user"){
			$data = DB::table('pesan')->where('tipe','=',$sesi)->where('penerima','=',Auth::user()->namalengkap)->orderby('status','desc')->orderby('id','desc')->paginate(5);
		}
		return View::make('pesan')->with('pesan',$data);
	}

	public function search(){
		$var = Input::get('cari');
		$searchTerms = explode(' ', $var);
	    $query = DB::table('listbarang');
	    foreach($searchTerms as $term)
	    {
	        $query->where('name', 'LIKE', '%'. $term .'%');
	    }
	    $results = $query->get();
	    return View::make('hasilcari')->with('',$results);
	}

	public function deletenotif($id){
		DB::table('notif')->where('id','=',$id)->delete();
		return back();
	}

	public function hapuspesan($id){
		DB::table('pesan')->where('id','=',$id)->delete();
		return back();
	}

	public function notif(){
		$data = DB::table('notif')->orderby('id','desc')->paginate(5);
		return View::make('notifikasi')->with('notif',$data);
	}
}