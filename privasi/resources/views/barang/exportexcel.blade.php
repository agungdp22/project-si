@foreach($barang as $data)
	<?php $namaruangan = $data->nama_ruangan;?>
@endforeach
<?php
header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 2010 05:00:00 GMT");
header("content-disposition: attachment;filename=Data_Ruangan_{$namaruangan}.xls");
?>
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
		<?php $no=1;?>
		@foreach ($barang as $data)
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
			<td>{{ $data->total }}</td>
			<td>{{ $data->sumber_dana }}</td>
      		<td>{{ $data->kondisi}}</td>
		</tr>
		@endforeach
	</table>