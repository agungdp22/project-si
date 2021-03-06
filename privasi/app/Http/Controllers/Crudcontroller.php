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

class Crudcontroller extends Controller
{
    public function tambahdata(validasitambahdata $data){
		$data = array(
			'nama' => Input::get('nama'),
			'alamat' => Input::get('alamat'),
			'kelas' => Input::get('kelas')
			);
		DB::table('siswa')->insert($data);
		return Redirect::to('/read')->with('message','Berhasil Menambah Data');
	}

	public function hapusdata($id){
		DB::table('siswa')->where('id','=',$id)->delete();
		return Redirect::to('/read')->with('message','Berhasil Menghapus Data');
	}

	public function editdata($id){
		$data = DB::table('ruang_dramaga')->where('id','=',$id)->first();
		return View::make('form_edit')->with('ruang_dramaga',$data);
	}

	public function proseseditdata(){
		$luas = (Input::get('ukuran_panjang'))*(Input::get('ukuran_lebar'));
		$data = array(
			'nama_ruang'=>Input::get('nama_ruang'),
			'kode_ruang'=>Input::get('kode_ruang'),
			'wing'=>Input::get('wing'),
			'level'=>Input::get('level'),
			'ukuran_panjang'=>Input::get('ukuran_panjang'),
			'ukuran_lebar'=>Input::get('ukuran_lebar'),
			'luas'=>$luas
			);
		DB::table('ruang_dramaga')->where('id','=',Input::get('id'))->update($data);
		return back()->with('message','Berhasil Mengedit Data');
	}

	public function tambahlogin(validasiregister $data){
		$data = array(
			'username'=>Input::get('username'),
			'password'=>bcrypt(Input::get('password')),
			'namalengkap'=>Input::get('namalengkap'),
			'email'=>Input::get('email'),
			'hak_akses'=>'user'
			);
		DB::table('login')->insert($data);
		return Redirect::to('/staff')->with('message','Berhasil Mendaftar');
	}

	public function login(validasilogin $validasi)
	{
		if(Auth::attempt(['username'=>Input::get('username'), 'password'=>Input::get('password')]))
		{
			if(Auth::user()->hak_akses=="admin"){
				//echo "admin";
				return Redirect::to('');
			}
			else{
				//echo "user";
				return Redirect::to('user');
			}
		}
		else{
			return Redirect::to('login')->with('message','Maaf, Anda Tidak Terdaftar');
		}
	}

	public function lihatstaff(){
		$data = DB::table('login')->where('hak_akses','=','user')->get();
		return View::make('staff')->with('lihatstaff',$data);
	}

	public function logout(){
		Auth::logout();
		return Redirect::to('login')->with('message','Berhasil Logout');
	}

	public function hapusstaff($id){
		DB::table('login')->where('id','=',$id)->delete();
		return back()->with('message','Berhasil Menghapus Data');
	}
}