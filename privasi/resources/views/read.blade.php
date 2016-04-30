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
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Nama Ruangan</th>
			<th>Kode Ruang</th>
			<th>Wing</th>
			<th>Level</th>
			<th>Ukuran Panjang (m)</th>
			<th>Ukuran Lebar (m)</th>
			<th>Luas</th>
			<th>Action</th>
		</tr>
		<?php $no=1;?>
		@foreach ($ruangdramaga as $data)
		<tr>
			<td>{{ $no++ }}</td>
			<td><a href="lihatruang/{{$data->id}}">{{ $data->nama_ruang }}</a></td>
			<td>{{ $data->kode_ruang }}</td>
			<td>{{ $data->wing }}</td>
			<td>{{ $data->level }}</td>
			<td>{{ $data->ukuran_panjang }}</td>
			<td>{{ $data->ukuran_lebar }}</td>
			<td>{{ $data->luas }}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td><a href="formedit/{{ $data->id}}"><span class="btn btn-success">Edit</span></a> || <a onclick="return konfirmasi()" href="hapus/{{ $data->id}}"><span class="btn btn-danger">Hapus</span></a></td>

			@else
			<td><a href="#"><span class="label label-success">Kirim Notifikasi</span></a></td>
			@endif
		</tr>
		@endforeach
	</table>
		@if(Auth::user()->hak_akses=="admin")
		<a href="{{ URL('inputdata') }}"><span class="btn btn-danger">Tambah Data</span></a>
		@endif
@endif
</div>
</div>
@stop