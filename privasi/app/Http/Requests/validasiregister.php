<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class validasiregister extends Request
{
	public function authorize(){
		return true;
	}

	public function rules(){
		return [
			'username'=>'required',
			'password'=>'required',
			'namalengkap'=>'required',
			'email'=>'required'
		];
	}

	public function messages(){
		return [
			'username.required'=>'harus mengisi username',
			'username.email'=>'format bukan email',
			'password.required'=>'harus mengisi password',
			'namalengkap.required'=>'harus mengisi nama lengkap',
			'email.required'=>'harus mengisi email',
		];
	}
}