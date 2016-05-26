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
	public function lihatdataruangandramaga(){
		//$data = Ruangan::orderby('id')->get();
		$data = DB::table('ruang_dramaga')->get();
		return View::make('ruangandramaga')->with('ruangdramaga',$data);
	}

	public function lihatdataruanganbaranangsiang(){
		//$data = Ruangan::orderby('id')->get();
		$data = DB::table('ruang_baranang')->get();
		return View::make('ruanganbaranangsiang')->with('ruangbaranangsiang',$data);
	}

	public function ndelokruangan($id){
		$data = DB::table('listbarang')->where('id_ruangan','=',$id)->get();
		$ruang = DB::table('ruang_dramaga')->where('id','=',$id)->get();
		return View::make('lihatruangan')->with('ruangan',$data)->with('namaruang',$ruang);
	}

	public function ngeditbarang($id){
		$data = DB::table('listbarang')->where('id','=',$id)->first();
		return View::make('edit_barang')->with('barang',$data);
	}

	public function prosestambahruangan(){
		$luas = (Input::get('panjang'))*(Input::get('lebar'));
		$data = array(
			'nama_ruang' => Input::get('nama_ruang'),
			'kode_ruang' => Input::get('kode_ruang'),
			'wing' => Input::get('wing'),
			'level' => Input::get('level'),
			'ukuran_panjang' => Input::get('panjang'),
			'ukuran_lebar' => Input::get('lebar'),
			'luas' => $luas,
			'keterangan' => Input::get('keterangan')
			);
		DB::table('ruang_dramaga')->insert($data);
		return Redirect::to('read')->with('message','Berhasil Tambah Data');
	}

	public function prosesngeditbarang(){
		$data = array(
			'kode_barang'=>Input::get('kode_barang'),
			'nama_barang'=>Input::get('nama_barang'),
			'merk'=>Input::get('merk'),
			'tahun_perolehan'=>Input::get('tahun_perolehan'),
			'harga'=>Input::get('harga'),
			'jumlah'=>Input::get('jumlah'),
			'satuan'=>Input::get('satuan'),
			'sumber_dana'=>Input::get('sumber_dana'),
			'kondisi'=>Input::get('kondisi')
			);
		DB::table('listbarang')->where('id','=',Input::get('id'))->update($data);
		return back()->with('message','Berhasil Mengedit Data');
	}

	public function tambahbarang(){
		$data = array(
			'id_ruangan'=>Input::get('id_ruangan'),
			'nama_ruangan'=>Input::get('nama_ruangan'),
			'kode_barang'=>Input::get('kode_barang'),
			'nama_barang'=>Input::get('nama_barang'),
			'merk'=>Input::get('merk'),
			'tahun_perolehan'=>Input::get('tahun_perolehan'),
			'harga'=>Input::get('harga'),
			'jumlah'=>Input::get('jumlah'),
			'satuan'=>Input::get('satuan'),
			'sumber_dana'=>Input::get('sumber_dana'),
			'kondisi'=>Input::get('kondisi')
			);
		DB::table('listbarang')->insert($data);
		return back()->with('message','Berhasil Menambah Data Barang');
	}

	public function hapusruangan($id){
		DB::table('ruang_dramaga')->where('id','=',$id)->delete();
		return Redirect::to('/read')->with('message','Berhasil Menghapus Data');
	}

	public function hapusbarang($id){
		DB::table('listbarang')->where('id','=',$id)->delete();
		return back()->with('message','Berhasil Menghapus Data');
	}

	public function barangthdtempat(){
		$data = DB::table('ruang_dramaga')->get();
		return View::make('lihatbarang')->with('ruang',$data);
	}

	public function lihatpakeajax($id){
		$data = DB::table('listbarang')->where('id_ruangan','=',$id)->get();
		return View::make('ruanganajax')->with('ruangan',$data);
	}

}