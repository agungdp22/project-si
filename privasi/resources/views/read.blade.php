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
	@if(Session::has('message'))
	<span class="label label-success">{{ Session::get('message') }}</span>
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
			<th>Ukuran Panjang (m)</th>
			<th>Ukuran Lebar (m)</th>
			<th>Luas</th>
			<th>Action</th>
		</tr>
		<?php $no=1;?>
		@foreach ($ruangdramaga as $data)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->nama_ruang }}&nbsp&nbsp&nbsp<a href="lihatruang/{{$data->id}}"><span class="label label-success" align="right">Lihat</span></a></td>
			<td>{{ $data->kode_ruang }}</td>
			<td>{{ $data->wing }}</td>
			<td>{{ $data->level }}</td>
			<td>{{ $data->ukuran_panjang }}</td>
			<td>{{ $data->ukuran_lebar }}</td>
			<td>{{ $data->luas }}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td>
				<a href="" data-placement="top" data-toggle="modal" data-target="#edit{{$data->id}}" type="button" data-original-title="Edit" class="btn  btn-sm"><i class="fa fa-pencil">&nbsp</i>Edit....</a><br>
        <a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->id}}" type="button" data-original-title="Delete" class="btn  btn-sm tooltips"><i class="fa fa-trash-o">&nbsp</i>Hapus</a>
			</td>

			@else
			<td><a href="kirimnotif/{{ $data->id }}"><span class="label label-success">Kirim Notifikasi</span></a></td>
			@endif
		</tr>
		@endforeach
	</table>
		@if(Auth::user()->hak_akses=="admin")
		<a href="{{ URL('inputdata') }}"><span class="btn btn-success">Tambah Data</span></a>
		@endif
@endif
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
	    Nama Ruang:
	    {!! Form::text('nama_ruang', $data->nama_ruang, ['class' => 'form-control']) !!}
	    Kode Ruang:
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
        <a href="{{ url('hapus/$data->id') }}" type="submit" class="btn btn-primary" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection

