@extends('template/t_index')

@section('title')
	Anggota Staff
@endsection

@section('content')
	<div id="page-wrapper">
	<div class="main-page">
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
	@endif
	<p></p>
	<a href="" data-placement="top" data-toggle="modal" data-target="#modalTambah" type="button" data-original-title="Edit" class="btn  btn-sm"><span class="btn btn-success">Tambah Staff Baru</span></a>
	<div class="table-responsive">
	
	<br>
	<table class="table table-bordered">
		<tr align="center">
			<th>No</th>
			<th>Nama Staff</th>
			<th>Email</th>
			<th>Username</th>
      <th>Wilayah Operasional</th>
      <th>Action</th>
		</tr>
		<?php $no=1;?>
		@foreach($lihatstaff as $data)
		<tr>
			<td>{{$no++}}</td>
			<td>{{$data->namalengkap}}</td>
			<td>{{$data->email}}</td>
			<td>{{$data->username}}</td>
      <td>{{$data->lokasi}}</td>
      <td><a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete" class="btn  btn-sm tooltips"><span class="btn btn-danger">Hapus</span></a></td>
		</tr>
		@endforeach
		
	</table>
	
</div></div></div>
@endsection

@section('modalTambah')
    <div class="modal fade fadeIn edit" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="hasilLabel" align="center">Tambah Anggota Staff Baru</h3>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/tambahlogin', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Staff</label>
            <div class="col-md-6">
              <input type="text" name="namalengkap" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Email</label>
            <div class="col-md-6">
              <input type="email" name="email" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Username</label>
            <div class="col-md-6">
              <input type="text" name="username" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Password</label>
            <div class="col-md-6">
              <input type="text" name="password" class="form-control" required="">
            </div>
            </div>
          <div class="clearfix"></div>

            
        </div>
        <div class="modal-footer">
        <p align="center"><button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success" name="submit" class="form-control" value="Submit">Tambah</button></p>
        </div>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
    </div>
@endsection

@section('hapus')
@foreach($lihatstaff as $data)
  <div class="modal fade fadeIn delete" id="delete{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="deleteLabel">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin untuk menghapus data staff {{$data->namalengkap}} ?</h4>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="{{ url('hapusstaff',$data->id) }}" type="submit" class="btn btn-danger" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection