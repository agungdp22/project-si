@extends('template/t_index')
@section('content')
<script type="text/javascript" language="JavaScript">
	 function konfirmasi()
	 {
	 tanya = confirm("Anda Yakin Akan Menghapus Data?");
	 if (tanya == true) return true;
	 else return false;
	 }
 </script>

@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif
	<p></p>
	<div class="table-responsive">
	Nama Ruangan : <br>
	Kode Ruangan : <br>
	Gedung/Wing/Lantai : IPB Dramaga/20/5
	<br><br>
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Merk</th>
			<th>Tahun Perolehan</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Total</th>
			<th>Sumber Dana</th>
			<th>Kondisi</th>
		</tr>
		<?php $no=1;?>
		@foreach ($ruangan as $data)
		<?php $ttl=($data->harga)*($data->jumlah);?>
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->kode_barang }}</td>
			<td>{{ $data->nama_barang }}</td>
			<td>{{ $data->merk }}</td>
			<td>{{ $data->tahun_perolehan }}</td>
			<td>{{ $data->harga }}</td>
			<td>{{ $data->jumlah }}</td>
			<td>{{ $data->satuan }}</td>
			<td>{{ $ttl }}</td>
			<td>{{ $data->sumber_dana }}</td>
			<td>{{ $data->kondisi}}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td><a href="editbarang/{{ $data->id}}"><span class="btn btn-success">Edit....</span></a><a onclick="return konfirmasi()" href="hapus/{{ $data->id}}"><span class="btn btn-danger">Hapus</span></a></td>

			@else
			<td><a href="#"><span class="label label-success">Kirim Notifikasi</span></a></td>
			@endif
		</tr>
		@endforeach
	</table>
		@if(Auth::user()->hak_akses=="admin")
		<a href="{{ URL('inputdata') }}"><span class="btn btn-success">Tambah Data</span></a>
		<a onclick="history.go(-1);"><span class="btn btn-danger">Kembali</span></a>
		@endif
@endif
</div>
</div>
@stop