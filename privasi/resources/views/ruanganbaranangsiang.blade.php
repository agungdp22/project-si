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
  <h3>List Ruangan di Baranangsiang</h3>
  <br>
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
		@foreach ($ruangbaranangsiang as $data)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $data->Nama_Ruang }}</td>
			<td>{{ $data->Kode_Ruang }}</td>
			<td>{{ $data->Wing }}</td>
			<td>{{ $data->Level }}</td>
			<td>{{ $data->Panjang }}</td>
			<td>{{ $data->Lebar }}</td>
			<td>{{ $data->Luas }}</td>
			@if(Auth::user()->hak_akses=="admin")
			<td>
				<a href="" data-placement="top" data-toggle="modal" data-target="#edit{{$data->Kode_Ruang}}" type="button" data-original-title="Edit" class="btn btn-sm"><i class="fa fa-pencil">&nbsp</i>Edit....</a><br>
        <a href="" data-placement="top" data-toggle="modal" data-target="#delete{{$data->Kode_Ruang}}" type="button" data-original-title="Delete" class="btn btn-sm tooltips"><i class="fa fa-trash-o">&nbsp</i>Hapus</a>
			</td>

			@else
			<td><a href="" data-placement="top" data-toggle="modal" data-target="#notif{{$data->Kode_Ruang}}" type="button" data-original-title="Notifikasi" class="btn btn-sm"><div class="btn btn-success">Kirim Pesan</div></a></td>
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
        {!! Form::open(array('url'=>'/prosestambahruanganbaranang', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
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
  @foreach($ruangbaranangsiang as $data)
    <div class="modal fade fadeIn edit" id="edit{{$data->Kode_Ruang}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel"><div class="panel-heading">Edit Ruangan {{$data->Nama_Ruang}} </div></h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/proseseditruanganbaranangsiang', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
            <div class="form-group">
            <label class="col-md-4 control-label" align="right">Nama Ruangan</label>
            <div class="col-md-6">
              <input type="text" name="kode_barang" class="form-control" value="{{$data->Nama_Ruang}}">
            </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Wing</label>
            <div class="col-md-6">
              <input type="text" name="nama_barang" class="form-control" value="{{$data->Wing}}">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <label class="col-md-4 control-label" align="right">Level</label>
            <div class="col-md-6">
              <input type="text" name="merk" class="form-control" value="{{$data->Level}}">
            </div>
          </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" align="right">Ukuran Panjang</label>
                <div class="col-md-6">
                    <input type="number" name="tahun_perolehan" class="form-control" value="{{$data->Panjang}}">
                </div>
            </div>
          <div class="clearfix"></div>
          <div class="form-group">
                <label class="col-md-4 control-label" align="right">Ukuran Lebar</label>
                <div class="col-md-6">
                    <input type="number" name="harga" class="form-control" value="{{$data->Lebar}}">
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
    </div>
  @endforeach
@endsection

@section('hapus')
@foreach($ruangbaranangsiang as $data)
  <div class="modal fade fadeIn delete" id="delete{{$data->Kode_Ruang}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="deleteLabel">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah anda yakin untuk menghapus data ruangan {{$data->Nama_Ruang}} ?</h4>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="{{URL('hapusruanganbaranang',$data->Kode_Ruang)}}" type="submit" class="btn btn-primary" name="submit" class="form-control" value="Submit">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection

@section('modalNotif')
@foreach($ruangbaranangsiang as $data)
<div class="modal fade fadeIn edit" id="notif{{$data->Kode_Ruang}}" tabindex="-1" role="dialog" aria-labelledby="editLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="hasilLabel">Kirim Notifikasi ke Admin untuk Ruangan {{$data->Nama_Ruang}} </h4>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
        {!! Form::open(array('url'=>'/prosesnotifikasiruangan', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
        <input type="hidden" name="ruangan" value="{{$data->Nama_Ruang}}" class="form-control">
        <input type="hidden" name="pengirim" value="{{Auth::user()->namalengkap}}" class="form-control">
        <input type="hidden" name="id_pengirim" value="{{Auth::user()->id}}" class="form-control">
            <!-- <div class="form-group">
            <label class="col-md-2 control-label" align="right">Kondisi</label>
            <div class="col-md-6">
              <input type="text" name="kondisi" class="form-control">
            </div>
            </div>
          <div class="clearfix"></div> -->
          <div class="form-group">
            <label class="col-md-2 control-label" align="right">Komentar</label>
            <div class="col-md-6">
              <textarea name="komentar" class="form-control"></textarea>
            </div>
          </div>
          <div class="clearfix"></div>
         <!--  <div class="form-group">
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
          <div class="clearfix"></div> -->

            
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

