<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class validasilogin extends Request
{
	public function authorize(){
		return true;
	}

	public function rules(){
		return [
			'username'=>'required',
			'password'=>'required'
		];
	}

	public function messages(){
		return [
			'username.required'=>'harus mengisi username',
			'username.email'=>'format bukan email',
			'password.required'=>'harus mengisi password',
		];
	}
}