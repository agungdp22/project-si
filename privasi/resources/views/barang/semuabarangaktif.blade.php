@extends('template/t_index')
@section('title')
	Barang Aktif
@endsection

@section('content')
<?php
	function format_rupiah($angka){
	 $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
?>
@foreach($barang as $data)
<?php $sst = $data->status;
?>
@endforeach
<?php
	if($sst == "Tidak Aktif") {$sst = "Tidak Aktif";}
	else {$sst = "Aktif";}?>

@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
  <h3>Barang {{$sst}}</h3><br>
	<!-- @if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif -->
	<p></p>
	<div class="table-responsive">
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Asal Ruangan</th>
			<th>Merk</th>
			<th>Tahun Perolehan</th>
      @if(Auth::user()->hak_akses=="admin")
			<th>Harga (Rupiah)</th>
      @endif
			<th>Jumlah</th>
      @if(Auth::user()->hak_akses=="admin")
			<th>Total (Rupiah)</th>
      @endif
			<th>Sumber Dana</th>
			<th>Kondisi</th>
			<th>Status</th>
		</tr>
		<?php $no=1;
		$sum=0;?>
		@if($barang)
		@foreach ($barang as $data)
		<?php $ttl=($data->harga)*($data->jumlah);?>
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->kode_barang }}</td>
			<td>{{ $data->nama_barang }}</td>
			<td>{{ $data->nama_ruangan }}</td>
			<td>{{ $data->merk }}</td>
			<td>{{ $data->tahun_perolehan }}</td>
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($data->harga) }}</td>
      @endif
			<td>{{ $data->jumlah }} &nbsp{{ $data->satuan }}</td>
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($ttl) }}</td>
      @endif
			<td>{{ $data->sumber_dana }}</td>
      <td>{{ $data->kondisi}}</td>
      <td>@if($data->status){{$data->status}} @else Aktif @endif</td>
		</tr>
		<?php $sum=$sum+$ttl;?>
		@endforeach
		@else
		  <tr><td colspan="11" align="center"><h3><span class="label label-danger">TIDAK ADA DATA</span></h3></td></tr>
		@endif
	</table>

  @if(Auth::user()->hak_akses=="admin")
  <h3 align="right">
  @if($sum>10000000)
	<span class="btn btn-danger">Total Anggaran = Rp <?php echo format_rupiah($sum);?></span><br><br>
  @else
  <span class="btn btn-success">Total Anggaran = Rp <?php echo format_rupiah($sum);?></span><br><br>
  @endif
  </h3>
  @endif
{!! $barang->render() !!}
		
@endif
</div>
</div>
@endsection