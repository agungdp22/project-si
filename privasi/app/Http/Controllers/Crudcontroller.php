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

	public function lihatdata(){
		$data = DB::table('ruang_dramaga')->get();
		return View::make('read')->with('ruangdramaga',$data);
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
		$data = array(
			'nama_ruang'=>Input::get('nama_ruang'),
			'kode_ruang'=>Input::get('kode_ruang'),
			'wing'=>Input::get('wing'),
			'level'=>Input::get('level'),
			'ukuran_panjang'=>Input::get('ukuran_panjang'),
			'ukuran_lebar'=>Input::get('ukuran_lebar'),
			'luas'=>Input::get('luas')
			);
		DB::table('ruang_dramaga')->where('id','=',Input::get('id'))->update($data);
		return Redirect::to('read')->with('message','Berhasil Mengedit Data');
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
		return Redirect::to('/login')->with('message','Berhasil Mendaftar');
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

	public function logout(){
		Auth::logout();
		return Redirect::to('login')->with('message','Berhasil Logout');
	}
}