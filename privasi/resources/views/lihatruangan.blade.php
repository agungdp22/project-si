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
<?php
	function format_rupiah($angka){
	 $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
?>
@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif
	<p></p>
	<div class="table-responsive">
	@foreach($namaruang as $ruang)
	<table border="0">
		<tr>
			<th>Nama Ruangan</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->nama_ruang}} @if($ruang->keterangan) ({{$ruang->keterangan}}) @endif</th>
		</tr><tr>
			<th>Kode Ruangan</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->kode_ruang}}</th>
		</tr><tr>
			<th>Wing/Level</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->wing}}/{{$ruang->level}}</th>
		</tr>
	</table>
	@endforeach
	<br>
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Merk</th>
			<th>Tahun Perolehan</th>
			<th>Harga (Rupiah)</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Total (Rupiah)</th>
			<th>Sumber Dana</th>
			<th>Kondisi</th>
		</tr>
		<?php $no=1;
		$sum=0;?>
		@if($ruangan)
		@foreach ($ruangan as $data)
		<?php $ttl=($data->harga)*($data->jumlah);?>
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->kode_barang }}</td>
			<td>{{ $data->nama_barang }}</td>
			<td>{{ $data->merk }}</td>
			<td>{{ $data->tahun_perolehan }}</td>
			<td>{{ format_rupiah($data->harga) }}</td>
			<td>{{ $data->jumlah }}</td>
			<td>{{ $data->satuan }}</td>
			<td>{{ format_rupiah($ttl) }}</td>
			<td>{{ $data->sumber_dana }}</td>
			<td>{{ $data->kondisi}}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td><a href="editbarang/{{ $data->id}}"><span class="btn btn-success">Edit....</span></a><a onclick="return konfirmasi()" href="hapus/{{ $data->id}}"><span class="btn btn-danger">Hapus</span></a></td>

			@else
			<td><a href="kirimnotif/{{ $data->id }}"><span class="label label-success">Kirim Notifikasi</span></a></td>
			@endif
		</tr>
		<?php $sum=$sum+$ttl;?>
		@endforeach
		@else
		<tr><td colspan="11" align="center"><span class="label label-danger">TIDAK ADA DATA</span></td></tr>
		@endif
	</table>
	Total Anggaran = Rp <?php echo format_rupiah($sum);?><br><br>
		@if(Auth::user()->hak_akses=="admin")
		<a href="{{ URL('inputdata') }}"><span class="btn btn-success">Tambah Data</span></a>
		<a onclick="history.go(-1);"><span class="btn btn-danger">Kembali</span></a>
		@endif
@endif
</div>
</div>
@stop