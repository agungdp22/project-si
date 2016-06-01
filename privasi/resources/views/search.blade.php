@extends('template/t_index')
@section('title')
	Pencarian
@endsection
<?php
	function format_rupiah($angka){
	 $rupiah=number_format($angka,0,',','.');
	 return $rupiah;
	}
?>
@if (count($name) > 0)
@foreach($name as $data)
	<?php $id_ruang = ($data->id_ruangan); 
      $nama_ruangan = ($data->nama_ruangan); 
      ?>
@endforeach
<?php 
      $namaente = Auth::user()->namalengkap;
      $idente = Auth::user()->id;
      $lokasiente = Auth::user()->lokasi;
      $dataruangan = DB::table('ruang_dramaga')->where('id','=',$id_ruang)->get();
      $dtr = $dataruangan;
?>
@foreach($dtr as $dataruangan)
<?php $namatempat = $dataruangan->lokasi;?>
@endforeach
@endif
@section('content')
<div id="page-wrapper">
	<div class="main-page">
        <h3 class="title1">Hasil Pencarian</h3>
        @if (count($name) > 0)
		<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Ruangan</th>
			<th>Lokasi</th>
			<th>Merk</th>
			<th>Tahun Perolehan</th>
			<th>Sumber Dana</th>
			<th>Kondisi</th>
			<th>Status</th>
      <th>Action</th>
		</tr>
		<?php $no=1;
		$sum=0;?>
		@if($name)
		@foreach ($name as $data)
		<?php $ttl=($data->harga)*($data->jumlah);?>
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->kode_barang }}</td>
			<td>{{ $data->nama_barang }}</td>
			<td>{{ $data->nama_ruangan }}</td>
			<td>{{ $namatempat }}</td>
			<td>{{ $data->merk }}</td>
			<td>{{ $data->tahun_perolehan }}</td>
			<td>{{ $data->sumber_dana }}</td>
      <td>{{ $data->kondisi}}</td>
      <td>@if($data->status){{$data->status}} @else Aktif @endif</td>
			@if(Auth::user()->hak_akses=="admin")
      
			<td>
       <h4><a href="" data-placement="top" data-toggle="modal" data-target="#editbarang{{$data->id}}" type="button" data-original-title="Edit"><span class="btn btn-primary">More..</span></a><br>
       <!-- @if($data->status == "Aktif")
			 <a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete"><span class="btn btn-danger">Hapus</a></h4>
			 @endif -->
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
		@else 
		Data tidak ditemukan.
		@endif
    </div>
    </div>
@endsection

@section('modalEdit')
  @foreach($name as $data)
    <div class="modal fade fadeIn edit" id="editbarang{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="hasilLabel" align="center">Barang {{$data->nama_barang}}</h3>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/proseseditbrg', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
          <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
          <input type="hidden" name="namaruangan" class="form-control" value="{{$nama_ruangan}}">
          <input type="hidden" name="pengirim" class="form-control" value="{{$namaente}}">
          <input type="hidden" name="id_pengirim" class="form-control" value="{{$idente}}">
          <input type="hidden" name="lokasi" class="form-control" value="{{$lokasiente}}">
          <input type="hidden" name="lokasi" class="form-control" value="{{$namatempat}}">
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kode Barang</label>
            <div class="col-md-6">
              <label class="col-md-4 control-label" align="right">{{$data->kode_barang}}</label>
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Barang</label>
            <div class="col-md-6">
              <input type="text" name="nama_barang" class="form-control" value="{{$data->nama_barang}}">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Merk</label>
            <div class="col-md-6">
              <input type="text" name="merk" class="form-control" value="{{$data->merk}}">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Tahun Perolehan</label>
                <div class="col-md-6">
                    <input type="number" name="tahun_perolehan" class="form-control" value="{{$data->tahun_perolehan}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Harga</label>
                <div class="col-md-6">
                    <input type="number" name="harga" class="form-control" value="{{$data->harga}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Jumlah</label>
                <div class="col-md-6">
                    <input type="number" name="jumlah" class="form-control" value="{{$data->jumlah}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Satuan</label>
                <div class="col-md-6">
                    <input type="text" name="satuan" class="form-control" value="{{$data->satuan}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Sumber Dana</label>
                <div class="col-md-6">
                    <input type="text" name="sumber_dana" class="form-control" value="{{$data->sumber_dana}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Kondisi</label>
                <div class="col-md-6">
                    <input type="radio" class="flat" name="kondisi" id="genderZ" value="Baik" @if($data->kondisi=="Baik") checked=""@endif required /> Baik &nbsp &nbsp
                    <input type="radio" class="flat" name="kondisi" id="genderX" value="Tidak Baik" @if($data->kondisi=="Tidak Baik") checked=""@endif /> Tidak Baik
                </div>
            </div>
          <div class="clearfix"></div>            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Edit</button>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endforeach
@endsection

@section('hapus')
@foreach($name as $data)
  <div class="modal fade fadeIn delete" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="deleteLabel">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin untuk menonaktifkan barang {{$data->nama_barang}}? Barang akan dipindahkan ke gudang</h4>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="{{ url('hapusbarang',$data->id) }}" type="submit" class="btn btn-danger" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection