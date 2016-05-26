@extends('template.t_index')
@section('title')
	Ruangan
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

@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
  <h3>List Ruangan di Dramaga</h3>
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif
  @if(Auth::user()->hak_akses=="admin")
   <p align="right"> <a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit" class="btn  btn-sm"><span class="btn btn-success">Tambah Data</span></a></p>
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
			<th>Ukuran<br>Panjang (m)</th>
			<th>Ukuran<br>Lebar (m)</th>
			<th>Luas</th>
			<th>Action</th>
		</tr>
		<?php $no=1;?>
		@foreach ($ruangdramaga as $data)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->nama_ruang }}&nbsp&nbsp&nbsp<a href="lihatruang/{{$data->id}}"><p align="left"><span class="label label-success">Lihat</span></p></a></td>
			<td>{{ $data->kode_ruang }}</td>
			<td>{{ $data->wing }}</td>
			<td>{{ $data->level }}</td>
			<td>{{ $data->ukuran_panjang }}</td>
			<td>{{ $data->ukuran_lebar }}</td>
			<td>{{ $data->luas }}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td>
				<a href="" data-placement="top" data-toggle="modal" data-target="#edit{{$data->id}}" type="button" data-original-title="Edit" class="btn btn-sm"><span class="btn btn-success">Edit..</span></a><br>
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
          <h4 class="modal-title" id="hasilLabel">Tambah Ruangan</h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosestambahruangan', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Ruangan Baru</label>
            <div class="col-md-6">
              <input type="text" name="nama_ruang" class="form-control">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Kode Ruangan</label>
            <div class="col-md-6">
              <input type="text" name="kode_ruang" class="form-control">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Wing</label>
            <div class="col-md-6">
              <input type="numeric" name="wing" class="form-control">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Level</label>
                <div class="col-md-6">
                    <input type="text" name="level" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Panjang</label>
                <div class="col-md-6">
                    <input type="text" name="panjang" class="form-control">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Lebar</label>
                <div class="col-md-6">
                    <input type="text" name="lebar" class="form-control">
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
  @foreach($ruangdramaga as $data)
    <div class="modal fade fadeIn edit" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel"><div class="panel-heading">Edit Ruangan {{$data->nama_ruang}} </div></h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(['url' => '/prosesedit']) !!}
		{!! Form::hidden('id',$data->id,['class'=>'form-control'])!!}
	    Nama Ruangan:
	    {!! Form::text('nama_ruang', $data->nama_ruang, ['class' => 'form-control']) !!}
	    Kode Ruangan:
	    {!! Form::text('kode_ruang', $data->kode_ruang, ['class' => 'form-control']) !!}
	    Wing:
	    {!! Form::text('wing', $data->wing, ['class' => 'form-control']) !!}
	    Level:
	    {!! Form::text('level', $data->level, ['class' => 'form-control']) !!}
	    Ukuran Panjang (meter):
	    {!! Form::text('ukuran_panjang', $data->ukuran_panjang, ['class' => 'form-control']) !!}
	    Ukuran Lebar (meter):
	    {!! Form::text('ukuran_lebar', $data->ukuran_lebar, ['class' => 'form-control']) !!}
	    Luas:
	    {!! Form::text('luas', $data->luas, ['class' => 'form-control']) !!}
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
    	{!! Form::submit('Ubah Data',['class' => 'btn btn-success']) !!}
    	{!! Form::close() !!}
        </div>
        </div>
      </div>
    </div>
    </div>
  @endforeach
@endsection

@section('hapus')
@foreach($ruangdramaga as $data)
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
@foreach($ruangdramaga as $data)
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
        <input type="hidden" name="lokasiruangan" value="Dramaga" class="form-control">
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

