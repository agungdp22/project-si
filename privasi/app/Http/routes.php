<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('home');
    if(Auth::user()){
    	if(Auth::user()->hak_akses=="admin"){
    		return view('home');
    	}
    	else{
    		return view('user');
    	}
    }
    else{
    	return view('login');
    }
});
Route::get('inputdata', function () {
    //return view('inputdata');
    if(Auth::user()){
		if(Auth::user()->hak_akses=="admin"){
			return view('inputdata');
		}
		else{
			return Redirect::to('errorpage')->with('message','Halaman Tidak Ditemukan');
		}
	}
	else{
		return view('login');
	}
});
Route::post('prosestambah','Crudcontroller@tambahdata');
Route::get('read','Crudcontroller@lihatdata');
Route::get('hapus/{id}','Crudcontroller@hapusdata');
Route::get('formedit/{id}','Crudcontroller@editdata');
Route::get('login',function(){
	//return view('login');
	if(Auth::user()){
		if(Auth::user()->hak_akses=="admin"){
			return view('home');
		}
		else{
			return view('user');
		}
	}
	else{
		return view('login');
	}
});
Route::post('prosesedit','Crudcontroller@proseseditdata');
Route::get('tambahstaff', function () {
    //return view('register');
    if(Auth::user()){
		if(Auth::user()->hak_akses=="admin"){
			return view('register');
		}
		else{
			return Redirect::to('errorpage')->with('message','Halaman Tidak Ditemukan');
		}
	}
	else{
		return view('login');
	}
});
Route::get('errorpage',function(){
	return view('errorpage');
});
Route::post('tambahlogin','Crudcontroller@tambahlogin');
Route::post('login','Crudcontroller@login');
Route::get('user',function(){
	//return view('user');
	if(Auth::user()){
		if(Auth::user()->hak_akses=="admin"){
			return view('home');
		}
		else{
			return view('user');
		}
	}
	else{
		return view('login');
	}
});
Route::get('search','Caricontroller@search');

Route::get('lihatruang/{id}','Ruangcontroller@ndelokruangan');
Route::get('editbarang/{id}','Ruangcontroller@ngeditbarang');
Route::post('proseseditbrg','Ruangcontroller@prosesngeditbarang');

Route::get('logout','Crudcontroller@logout');