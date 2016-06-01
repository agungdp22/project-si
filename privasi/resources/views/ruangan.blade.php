@extends('template.t_index')
@section('title')
	Ruangan
@endsection

@section('content')
<?php $tole = 1;
$indeks = 0;
$indeks2 = 0;?>
@foreach ($dataruangan as $data)
<?php
$idruangan = $data->id;
$lka = $data->lokasi;
if($tole==1)
  break;
?>
@endforeach

@foreach ($dataruangan as $data)
<?php
$idruangan = $data->id;
$jumlahbarang[$indeks++] = DB::table('listbarang')->where('id_ruangan','=',$idruangan)->count();
$jumlahbarang2[$indeks2++] = DB::table('listbarang2')->where('id_ruangan','=',$idruangan)->count();
?>
@endforeach


@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
  <h3>List Ruangan di {{$lka}}</h3>
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif
  @if(Auth::user()->hak_akses=="admin")
  <br>
  <h4 align="right"><a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit"><span class="btn btn-primary">Tambah Data</span></a></h4><br>
   
  @endif
	<p></p>
	<div class="table-responsive">
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Nama Ruangan</th>
      <th>Jumlah Barang</th>
			<th>Kode Ruang</th>
      @if($lka!="Baranangsiang")
			<th>Wing</th>
			<th>Level</th>
      @endif
			<th>Ukuran<br>Panjang (m)</th>
			<th>Ukuran<br>Lebar (m)</th>
			<th>Luas</th>
			<th>Action</th>
		</tr>
		<?php $no=1;
    $ke = 0;
    $arrairuang[] = $lka;?>
		@foreach ($dataruangan as $data)
    <?php $edd = $data->id;
    $tempat[$lka] = $edd;
    ?>
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->nama_ruang }}&nbsp&nbsp&nbsp<h4><a href="lihatruang/{{$lka}}/{{$edd}}"><span class="label label-success">Lihat</span></a></h4></td>
      @if($lka=="Dramaga")
      <td>{{ $jumlahbarang[$ke++] }}</td>
      @else
      <td>{{ $jumlahbarang2[$ke++] }}</td>
      @endif
			<td>{{ $data->kode_ruang }}</td>
      @if($lka!="Baranangsiang")
			<td>{{ $data->wing }}</td>
			<td>{{ $data->level }}</td>
      @endif
			<td>{{ $data->ukuran_panjang }}</td>
			<td>{{ $data->ukuran_lebar }}</td>
			<td>{{ $data->luas }}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td>
				<h4><a href="" data-placement="top" data-toggle="modal" data-target="#edit{{$data->id}}" type="button" data-original-title="Edit"><span class="label label-success">Edit..</span></a></h4>
			</td>
			@else
			<td><a href="" data-placement="top" data-toggle="modal" data-target="#notif{{$data->id}}" type="button" data-original-title="Notifikasi" class="btn btn-sm"><div class="btn btn-success">Kirim Pesan</div></a></td>
			@endif
		</tr>
		@endforeach
	</table>
		  
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
          <h4 class="modal-title" id="hasilLabel">Tambah Ruangan Baru di {{$lka}}</h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosestambahruangan', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        <input type="hidden" name="lokasi" class="form-control" value="{{$lka}}" required="">
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Ruangan Baru</label>
            <div class="col-md-6">
              <input type="text" name="nama_ruang" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kode Ruangan</label>
            <div class="col-md-6">
              <input type="text" name="kode_ruang" class="form-control" required="">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Wing</label>
            <div class="col-md-6">
              <input type="numeric" name="wing" class="form-control" required="">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Level</label>
                <div class="col-md-6">
                    <input type="text" name="level" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Panjang</label>
                <div class="col-md-6">
                    <input type="text" name="panjang" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Lebar</label>
                <div class="col-md-6">
                    <input type="text" name="lebar" class="form-control" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Keterangan</label>
                <div class="col-md-6">
                    <input type="text" name="keterangan" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>

            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Tambah Data</button>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
    </div>
@endsection

@section('modalEdit')
  @foreach($dataruangan as $data)
    <div class="modal fade fadeIn edit" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel"><div class="panel-heading">Edit Ruangan {{$data->nama_ruang}} </div></h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        

      {!! Form::open(array('url'=>'/prosesedit', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
      <input type="hidden" name="id" class="form-control" value="{{$data->id}}" required="">
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Ruangan Baru</label>
            <div class="col-md-6">
              <input type="text" name="nama_ruang" class="form-control" value="{{$data->nama_ruang}}" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kode Ruangan</label>
            <div class="col-md-6">
              <input type="text" name="kode_ruang" class="form-control" value="{{$data->kode_ruang}}" required="">
            </div>
          </div>
          <div class="clearfix"></div>
          @if($lka!="Baranangsiang")
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Wing</label>
            <div class="col-md-6">
              <input type="numeric" name="wing" class="form-control" value="{{$data->wing}}" required="">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Level</label>
                <div class="col-md-6">
                    <input type="text" name="level" class="form-control" value="{{$data->level}}" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          @endif
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Panjang</label>
                <div class="col-md-6">
                    <input type="text" name="ukuran_panjang" class="form-control" value="{{$data->ukuran_panjang}}" required="">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Lebar</label>
                <div class="col-md-6">
                    <input type="text" name="ukuran_lebar" class="form-control" value="{{$data->ukuran_lebar}}" required="">
                </div>
            </div>
          <div class="clearfix"></div>

            
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Edit Data</button>
        </div>
        {!! Form::close() !!}
        </div>
        </div>
      </div>
    </div>
    </div>
  @endforeach
@endsection

@section('hapus')
@foreach($dataruangan as $data)
  <div class="modal fade fadeIn delete" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="deleteLabel">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin untuk menghapus data ruangan {{$data->nama_ruang}} ?</h4>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="{{URL('hapusruangan',$data->id)}}" type="submit" class="btn btn-primary" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection

@section('modalNotif')
@foreach($dataruangan as $data)
<div class="modal fade fadeIn edit" id="notif{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel">Kirim Pesan ke Admin untuk Ruangan {{$data->nama_ruang}} </h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'proseskirimpesan', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        <input type="hidden" name="namaruangan" value="{{$data->nama_ruang}}" class="form-control">
        <input type="hidden" name="namapengirim" value="{{Auth::user()->namalengkap}}" class="form-control">
        <input type="hidden" name="penerima" value="Admin" class="form-control">
        <input type="hidden" name="status" value="1" class="form-control">
        <input type="hidden" name="lokasiruangan" value="{{Auth::user()->lokasi}}" class="form-control">
        <input type="hidden" name="tipe" value="admin" class="form-control">
          <div class="form-group">
            <label class="col-md-2 control-label" align="right">Pesan</label>
            <div class="col-md-6">
              <textarea name="isipesan" class="form-control"></textarea>
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

