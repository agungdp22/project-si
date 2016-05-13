@extends('template/t_index')
@section('title')
	Lihat Ruangan
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
		@if(Auth::user()->hak_akses=="admin")
		<p align="left"><a onclick="history.go(-1);"><span class="btn btn-danger">Kembali</span></a>
		<p align="right"><a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit" class="btn  btn-sm"><span class="btn btn-success">Tambah Data</span></a></p></p>
			
		@endif
		<?php $nama_ruangan = ($ruang->nama_ruang); 
			$id_ruang = ($ruang->id); ?>
	@endforeach
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
			<td>			
				<a href="" data-placement="top" data-toggle="modal" data-target="#editbarang{{$data->id}}" type="button" data-original-title="Edit" class="btn  btn-sm"><i class="fa fa-pencil">&nbsp</i>Edit....</a><br>
        		<a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete" class="btn  btn-sm tooltips"><i class="fa fa-trash-o">&nbsp</i>Hapus</a>
        	</td>
			@else
			<td><a href="kirimnotif/{{ $data->id }}"><span class="label label-success">Kirim Notifikasi</span></a></td>
			@endif
		</tr>
		<?php $sum=$sum+$ttl;?>
		@endforeach
		@else
		<tr><td colspan="11" align="center"><h3><span class="label label-danger">TIDAK ADA DATA</span></h3></td></tr>
		@endif
	</table>
	Total Anggaran = Rp <?php echo format_rupiah($sum);?><br><br>
		
@endif
</div>
</div>
@endsection

@section('modalTambah')
@foreach($namaruang as $ruang)
    <div class="modal fade fadeIn edit" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel">Tambah Data Inventaris Barang di Ruangan {{$ruang->nama_ruang}}</h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosestambahbarang', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        	<input type="hidden" name="id_ruangan" class="form-control" value="{{$ruang->id}}">
          <input type="hidden" name="nama_ruangan" class="form-control" value="{{$ruang->nama_ruang}}">
          @endforeach
            <div class="form-group">
            <label class="col-md-2 control-label" align="right">Kode Barang</label>
            <div class="col-md-6">
              <input type="text" name="kode_barang" class="form-control">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-2 control-label" align="right">Nama Barang</label>
            <div class="col-md-6">
              <input type="text" name="nama_barang" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-2 control-label" align="right">Merk</label>
            <div class="col-md-6">
              <input type="text" name="merk" class="form-control">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-2 control-label" align="right">Tahun Perolehan</label>
                <div class="col-md-6">
                    <input type="text" name="tahun_perolehan" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-2 control-label" align="right">Harga</label>
                <div class="col-md-6">
                    <input type="text" name="harga" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-2 control-label" align="right">Jumlah</label>
                <div class="col-md-6">
                    <input type="text" name="jumlah" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-2 control-label" align="right">Satuan</label>
                <div class="col-md-6">
                    <input type="text" name="satuan" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-2 control-label" align="right">Sumber Dana</label>
                <div class="col-md-6">
                    <input type="text" name="sumber_dana" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-2 control-label" align="right">Kondisi</label>
                <div class="col-md-6">
                    <input type="text" name="kondisi" class="form-control">
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
    </div>
@endsection

@section('modalEdit')
  @foreach($ruangan as $data)
    <div class="modal fade fadeIn edit" id="editbarang{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="hasilLabel" align="center">Edit data di Ruangan <?php echo($nama_ruangan); ?></h3>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/proseseditbrg', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
          <table border="0" align="center">
          	<tr>
          		<th>Kode Barang</th><th>&nbsp&nbsp : &nbsp</th><td><input type="text" name="tempat" class="form-control" value="{{$data->kode_barang}}"></td>
          	</tr>
          	<tr>
          		<th>Nama Barang</th><th>&nbsp&nbsp : &nbsp</th><td><input type="text" name="tempat" class="form-control" value="{{$data->nama_barang}}"></td>
          	</tr>
          	<tr>
          		<th>Merk</th><th>&nbsp&nbsp : &nbsp</th><td><input type="text" name="tempat" class="form-control" value="{{$data->merk}}"></td>
          	</tr>
          	<tr>
          		<th>Tahun Perolehan</th><th>&nbsp&nbsp : &nbsp</th><td><input type="number" name="tempat" class="form-control" value="{{$data->tahun_perolehan}}"></td>
          	</tr>
          	<tr>
          		<th>Harga</th><th>&nbsp&nbsp : &nbsp</th><td><input type="number" name="tempat" class="form-control" value="{{$data->harga}}"></td>
          	</tr>
          	<tr>
          		<th>Jumlah</th><th>&nbsp&nbsp : &nbsp</th><td><input type="number" name="tempat" class="form-control" value="{{$data->jumlah}}"></td>
          	</tr>
          	<tr>
          		<th>Satuan</th><th>&nbsp&nbsp : &nbsp</th><td><input type="text" name="tempat" class="form-control" value="{{$data->satuan}}"></td>
          	</tr>
          	<tr>
          		<th>Sumber Dana</th><th>&nbsp&nbsp : &nbsp</th><td><input type="text" name="tempat" class="form-control" value="{{$data->sumber_dana}}"></td>
          	</tr>
          	<tr>
          		<th>Kondisi</th><th>&nbsp&nbsp : &nbsp</th><td><input type="radio" class="flat" name="kondisi" id="genderM" value="Baik"> Baik</td>
          	</tr>
          	<tr>
          		<th></th><th></th><td><input type="radio" class="flat" name="kondisi" id="genderF" value="Tidak Baik"> Tidak Baik</td>
          	</tr>
          </table>
        </div>
        <div class="modal-footer">
        <p align="center"><button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-primary" name="submit" class="form-control" value="Submit">Edit</button></p>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
    </div>
  @endforeach
@endsection

@section('hapus')
@foreach($ruangan as $data)
  <div class="modal fade fadeIn delete" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="deleteLabel">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin untuk menghapus data barang {{$data->nama_barang}} ?</h4>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="{{ url('hapusbarang/$data->id') }}" type="submit" class="btn btn-primary" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection