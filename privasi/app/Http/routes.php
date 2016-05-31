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
Route::get('/home', function () {
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
Route::get('ruanganbaranangsiang','Ruangcontroller@lihatdataruanganbaranangsiang');
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
Route::get('staff', function () {
    //return view('register');
    if(Auth::user()){
		if(Auth::user()->hak_akses=="admin"){
			return view('staff');
		}
		else{
			return Redirect::to('errorpage')->with('message','Halaman Tidak Ditemukan');
		}
	}
	else{
		return view('login');
	}
});
Route::get('staff','Crudcontroller@lihatstaff');
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
// Route::get('notifikasi',function(){
// 	return view('notifikasi');
// });
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

//modul crud barang inventaris
Route::get('ruangan/{lokasi}','Ruangcontroller@lihatdataruangan');
Route::get('lihatbarang','Ruangcontroller@barangthdtempat');
Route::get('ruangan/lihatruang/{id}','Ruangcontroller@ndelokruangan');
Route::get('lihatruang/editbarang/{id}','Ruangcontroller@ngeditbarang');
Route::post('proseseditbrg','Ruangcontroller@prosesngeditbarang');
Route::post('prosestambahruangan', 'Ruangcontroller@prosestambahruangan');
Route::post('prosestambahbarang','Ruangcontroller@tambahbarang');
Route::get('hapusbarang/{id}','Ruangcontroller@hapusbarang');
Route::get('hapusruangan/{id}','Ruangcontroller@hapusruangan');
Route::get('lihatruangajax/{id}','Ruangcontroller@lihatpakeajax');
Route::get('barang/{status}','Ruangcontroller@getallbarangaktif');
Route::get('exportexcel/{id}','Ruangcontroller@exportexcel');
//end modul barang

Route::get('hapusstaff/{id}','Crudcontroller@hapusstaff');

//Route::get('kirimnotif/ruangan/{id}','Notifikasicontroller@notifikasiruangan');
Route::get('kirimnotif/barang/{id}','Notifikasicontroller@notifikasibarang');
Route::post('proseskirimpesan','Notifikasicontroller@ruanganpesan');
Route::post('kirimpesandariadmin','Notifikasicontroller@ruanganpesan');
Route::get('pesanmasuk','Notifikasicontroller@lihatsemuapesan');
Route::get('pesankeluar','Notifikasicontroller@lihatsemuapesan');
Route::get('hapuspesan/{id}','Notifikasicontroller@hapuspesan');
Route::get('notifikasi','Notifikasicontroller@notif');

Route::get('logout','Crudcontroller@logout');