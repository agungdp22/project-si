@extends('template/t_index')
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
      <th>Action</th>
    </tr>
    <?php $no=1;
    $sum=0;?>
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
      
     
    </tr>
    @endforeach
  </table>