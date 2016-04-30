<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class validasitambahdata extends Request
{
	public function authorize(){
		return true;
	}

	public function rules(){
		return [
			'nama'=>'required',
			'alamat'=>'required',
			'kelas'=>'required'
		];
	}

	public function messages(){
		return [
			'nama.required'=>'harus mengisi Nama',
			'alamat.required'=>'harus mengisi Alamat',
			'kelas.required'=>'harus mengisi kelas',
		];
	}
}