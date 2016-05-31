@extends('template/t_index')
@section('title')
	Barang Aktif
@endsection

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
			<th>Merk</th>
			<th>Tahun Perolehan</th>
      @if(Auth::user()->hak_akses=="admin")
			<th>Harga (Rupiah)</th>
      @endif
			<th>Jumlah</th>
			<th>Satuan</th>
      @if(Auth::user()->hak_akses=="admin")
			<th>Total (Rupiah)</th>
      @endif
			<th>Sumber Dana</th>
			<th>Kondisi</th>
			<th>Action</th>
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
			<td>{{ $data->merk }}</td>
			<td>{{ $data->tahun_perolehan }}</td>
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($data->harga) }}</td>
      @endif
			<td>{{ $data->jumlah }}</td>
			<td>{{ $data->satuan }}</td>
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($ttl) }}</td>
      @endif
			<td>{{ $data->sumber_dana }}</td>
      <td>{{ $data->kondisi}}</td>
			@if(Auth::user()->hak_akses=="admin")
      
			<td>			
				<a href="" data-placement="top" data-toggle="modal" data-target="#editbarang{{$data->id}}" type="button" data-original-title="Edit" class="btn  btn-sm"><i class="fa fa-pencil">&nbsp</i>Edit....</a><br>
        <a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete" class="btn  btn-sm tooltips"><i class="fa fa-trash-o">&nbsp</i>Hapus</a>
        	</td>
			@else
			<td><!-- <a href="" data-placement="top" data-toggle="modal" data-target="#modalNotif" type="button" data-original-title="Notifikasi" class="btn  btn-sm"><span class="btn btn-success">Kirim Notifikasi</span></a> -->
      <a href="" data-placement="top" data-toggle="modal" data-target="#editbarang{{$data->id}}" type="button" data-original-title="Edit" class="btn  btn-sm"><span class="btn btn-success">Edit..</span></a><br></td>
			@endif
		</tr>
		<?php $sum=$sum+$ttl;?>
		@endforeach
		@else
		  <tr><td colspan="11" align="center"><h3><span class="label label-danger">TIDAK ADA DATA</span></h3></td></tr>
		@endif
	</table>
	<div><?php echo paginate_one($reload, $page, $tpages); ?></div>
  @if(Auth::user()->hak_akses=="admin")
  @if($sum>10000000)
	<span class="btn btn-danger">Total Anggaran = Rp <?php echo format_rupiah($sum);?></span><br><br>
  @else
  <span class="btn btn-success">Total Anggaran = Rp <?php echo format_rupiah($sum);?></span><br><br>
  @endif
  @endif
		
@endif
</div>
</div>
@endsection