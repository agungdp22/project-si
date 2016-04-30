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

class Ruangcontroller extends Controller
{
	public function ndelokruangan($id){
		$data = DB::table('listbarang')->where('id_ruangan','=',$id)->get();
		return View::make('lihatruangan')->with('ruangan',$data);
	}

	public function ngeditbarang($id){
		$data = DB::table('listbarang')->where('id','=',$id)->first();
		return View::make('edit_barang')->with('barang',$data);
	}

	public function prosesngeditbarang(){
		$data = array(
			'nama_ruang'=>Input::get('nama_ruang'),
			'kode_ruang'=>Input::get('kode_ruang'),
			'wing'=>Input::get('wing'),
			'level'=>Input::get('level'),
			'ukuran_panjang'=>Input::get('ukuran_panjang'),
			'ukuran_lebar'=>Input::get('ukuran_lebar'),
			'luas'=>Input::get('luas')
			);
		DB::table('listbarang')->where('id','=',Input::get('id'))->update($data);
		return Redirect::to('lihatruangan')->with('message','Berhasil Mengedit Data');
	}
}