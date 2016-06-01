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
	public function lihatdataruangan($lokasi){
		//$data = Ruangan::orderby('id')->get();
		$data = DB::table('ruang_dramaga')->where('lokasi','=',$lokasi)->get();
		return View::make('ruangan')->with('dataruangan',$data);
	}

	public function lihatdataruanganbaranangsiang(){
		//$data = Ruangan::orderby('id')->get();
		$data = DB::table('ruang_baranang')->get();
		return View::make('ruanganbaranangsiang')->with('ruangbaranangsiang',$data);
	}
	

	public function ndelokruangan($tempat,$id){
		if($tempat=="Dramaga"){
			$data = DB::table('listbarang')->where('id_ruangan','=',$id)->where('status','!=','Tidak Aktif')->get();
		}
		else if($tempat=="Baranangsiang"){
			$data = DB::table('listbarang2')->where('id_ruangan','=',$id)->get();
		}
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
			'lokasi' => Input::get('lokasi'),
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
		return back()->with('message','Berhasil Tambah Data');
	}

	public function prosesngeditbarang(){
		$lokasi = Input::get('lokasi');
		$cond = Input::get('kondisi');
		$stat = "Aktif";
		if($cond == "Tidak Baik"){
			$stat = "Tidak Aktif";
		}
		else{
			$stat =="Aktif";
		}
		$data = array(
			'nama_barang'=>Input::get('nama_barang'),
			'merk'=>Input::get('merk'),
			'tahun_perolehan'=>Input::get('tahun_perolehan'),
			'harga'=>Input::get('harga'),
			'jumlah'=>Input::get('jumlah'),
			'satuan'=>Input::get('satuan'),
			'sumber_dana'=>Input::get('sumber_dana'),
			'kondisi'=>$cond,
			'status' => $stat
			);

		if(Auth::user()->hak_akses == "user"){
			$notif = array(
				'ruangan' => Input::get('namaruangan'),
				'barang' => Input::get('nama_barang'),
				'id_pengirim' => Input::get('id_pengirim'),
				'pengirim' => Input::get('pengirim'),
				'lokasi' => Input::get('lokasi'),
				'kondisi' => Input::get('kondisi'),
				'isinotif' => 'mengedit barang',
				'status' => 1
				);
			DB::table('notif')->insert($notif);
		}
		if($lokasi=="Dramaga"){
			DB::table('listbarang')->where('id','=',Input::get('id'))->update($data);
		}
		else if($lokasi=="Baranangsiang"){
			DB::table('listbarang2')->where('id','=',Input::get('id'))->update($data);
		}
		return back()->with('message','Berhasil Mengedit Data');
	}

	public function tambahbarang(){
		$loka = Input::get('lokasi');
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
		if(Auth::user()->hak_akses == "user"){
			$notif = array(
				'ruangan' => Input::get('namaruangan'),
				'barang' => Input::get('nama_barang'),
				'id_pengirim' => Input::get('id_pengirim'),
				'pengirim' => Input::get('pengirim'),
				'lokasi' => Input::get('lokasi'),
				'isinotif' => 'menambah barang baru',
				'kondisi'=>Input::get('kondisi'),
				'status' => 1
				);
			DB::table('notif')->insert($notif);
		}
		if($loka == "Dramaga"){
			DB::table('listbarang')->insert($data);
		}
		else if($loka == "Baranangsiang"){
			DB::table('listbarang2')->insert($data);
		}
		return back()->with('message','Berhasil Menambah Data Barang');
	}

	public function hapusruangan($id){
		DB::table('ruang_dramaga')->where('id','=',$id)->delete();
		return Redirect::to('/read')->with('message','Berhasil Menghapus Data');
	}

	public function hapusbarang($id){
		$data = array('status'=>"Tidak Aktif");
		//if($lokasi == "Dramaga"){
			DB::table('listbarang')->where('id','=',$id)->update($data);
		// }
		// else if ($lokasi == "Baranangsiang") {
		// 	DB::table('listbarang2')->where('id','=',$id)->update($data);
		// }
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

	public function getallbarangaktif($status){
		if($status=="aktif"){
			$data = DB::table('listbarang')->where('kondisi','=','Baik')->paginate(15);
		}
		else if($status=="tidakaktif"){
			$data = DB::table('listbarang')->where('status','=','Tidak Aktif')->orWhere('kondisi','=','Tidak Baik')->paginate(15);
		}
		return View::make('barang/semuabarangaktif')->with('barang',$data);
	}

	public function exportexcel($id){
		$data = DB::table('listbarang')->where('id_ruangan','=',$id)->get();
		return View::make('barang/exportexcel')->with('barang',$data);
	}
}