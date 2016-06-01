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

class Caricontroller extends Controller
{
	public function getName()
	{
		$input = Input::get('cari');
		$name = DB::table('listbarang')->where('nama_ruangan', 'LIKE', '%'.$input.'%')->orWhere('nama_barang', 'LIKE', '%'.$input.'%')->orWhere('merk', 'LIKE', '%'.$input.'%')->orWhere('sumber_dana', 'LIKE', '%'.$input.'%')->orWhere('kondisi', 'LIKE', '%'.$input.'%')->orWhere('status', 'LIKE', '%'.$input.'%')->get();

		return view('search', compact('name'));
	}

	public function lihatnotif($nama,$ruangan)
	{
		$input = $nama;
		$name = DB::table('listbarang')->where('nama_ruangan', 'LIKE', '%'.$ruangan.'%')->where('nama_barang', 'LIKE', '%'.$input.'%')->get();

		return view('search', compact('name'));
	}
}