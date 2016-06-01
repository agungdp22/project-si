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
	<!-- @if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif -->
	<p></p>
	<div class="table-responsive">
	@foreach($namaruang as $ruang)
		<table border="0">
			<tr>
				<th>Nama Ruangan</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->nama_ruang}} @if($ruang->keterangan) ({{$ruang->keterangan}}) @endif</th>
			</tr><tr>
				<th>Kode Ruangan</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->kode_ruang}}</th>
			</tr>
      @if($ruang->lokasi == "Dramaga")
      <tr>
				<th>Wing/Level</th><th>&nbsp&nbsp:&nbsp&nbsp</th><th>{{$ruang->wing}}/{{$ruang->level}}</th>
			</tr>@endif
		</table>
		<!-- <p align="right"><a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit" class="btn  btn-sm"><span class="btn btn-success">+ | Tambah Data</span></a></p>	 -->
		<?php $nama_ruangan = ($ruang->nama_ruang); 
			$id_ruang = ($ruang->id); 
      $namaente = Auth::user()->namalengkap;
      $idente = Auth::user()->id;
      $lokasiente = Auth::user()->lokasi;
      $namatempat = $ruang->lokasi;?>
	@endforeach
  <br>
 <!--  <h4><p align="left"><a onclick="history.go(-1);"><span class="btn btn-danger">Kembali</span></a></p></h4> -->
 <h4><a href ="" onclick="history.go(-1);"><span class="label label-default">Kembali</span></a>
<a href="{{URL('exportexcel',$id_ruang)}}"><span class="label label-success">Export to Excel</span></a>
<a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit"><span class="label label-primary">Tambah Data</span></a>
 </h4><br>
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
      @if(Auth::user()->hak_akses=="admin")
			<th>Total (Rupiah)</th>
      @endif
			<th>Sumber Dana</th>
			<th>Kondisi</th>
			<th>Status</th>
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
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($data->harga) }}</td>
      @endif
			<td>{{ $data->jumlah }} &nbsp {{ $data->satuan }}</td>
      @if(Auth::user()->hak_akses=="admin")
			<td>{{ format_rupiah($ttl) }}</td>
      @endif
			<td>{{ $data->sumber_dana }}</td>
      <td>{{ $data->kondisi}}</td>
      <td>@if($data->status){{$data->status}} @else Aktif @endif</td>
			@if(Auth::user()->hak_akses=="admin")
      
			<td>
       <h4><a href="" data-placement="top" data-toggle="modal" data-target="#editbarang{{$data->id}}" type="button" data-original-title="Edit"><span class="btn btn-primary">Edit....</span></a><br>
			 <a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete"><span class="btn btn-danger">Hapus</a></h4>
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

@section('modalTambah')
    <div class="modal fade fadeIn edit" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel">Tambah Data Barang Inventaris di Ruangan {{$ruang->nama_ruang}}</h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosestambahbarang', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        	<input type="hidden" name="id_ruangan" class="form-control" value="{{$id_ruang}}">
          <input type="hidden" name="nama_ruangan" class="form-control" value="{{$nama_ruangan}}">
          <input type="hidden" name="lokasi" class="form-control" value="{{$namatempat}}">
          
          <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
          <input type="hidden" name="namaruangan" class="form-control" value="{{$nama_ruangan}}">
          <input type="hidden" name="pengirim" class="form-control" value="{{$namaente}}">
          <input type="hidden" name="id_pengirim" class="form-control" value="{{$idente}}">
          <input type="hidden" name="lokasi" class="form-control" value="{{$lokasiente}}">
          <input type="hidden" name="lokasi" class="form-control" value="{{$namatempat}}">
          
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kode Barang</label>
            <div class="col-md-6">
              <input type="text" name="kode_barang" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Barang</label>
            <div class="col-md-6">
              <input type="text" name="nama_barang" class="form-control" required="">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Merk</label>
            <div class="col-md-6">
              <input type="text" name="merk" class="form-control" required="">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Tahun Perolehan</label>
                <div class="col-md-6">
                    <input type="number" name="tahun_perolehan" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Harga</label>
                <div class="col-md-6">
                    <input type="number" name="harga" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Jumlah</label>
                <div class="col-md-6">
                    <input type="number" name="jumlah" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Satuan</label>
                <div class="col-md-6">
                    <input type="text" name="satuan" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Sumber Dana</label>
                <div class="col-md-6">
                    <input type="text" name="sumber_dana" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Kondisi</label>
                <div class="col-md-6">
                    <input type="radio" class="flat" name="kondisi" id="genderZ" value="Baik" checked=""/> Baik &nbsp &nbsp
                    <input type="radio" class="flat" name="kondisi" id="genderX" value="Tidak Baik"/> Tidak Baik
                </div>
            </div>
          <div class="clearfix"></div>

            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Tambah</button>
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
          <h3 class="modal-title" id="hasilLabel" align="center">Edit data Barang {{$data->nama_barang}}</h3>
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
@foreach($ruangan as $data)
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

@section('modalNotif')
@foreach($namaruang as $ruang)
<div class="modal fade fadeIn edit" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel">Kirim Notifikasi ke Admin di Ruangan {{$ruang->nama_ruang}}</h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosesnotifikasi', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kondisi</label>
            <div class="col-md-6">
              <input type="text" name="kondisi" class="form-control">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Komentar</label>
            <div class="col-md-6">
              <input type="text" name="komentar" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Merk</label>
            <div class="col-md-6">
              <input type="text" name="merk" class="form-control">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Tahun Perolehan</label>
                <div class="col-md-6">
                    <input type="text" name="tahun_perolehan" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>

            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Kirim</button>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
    </div>
@endforeach
@endsection