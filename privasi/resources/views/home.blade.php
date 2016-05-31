@extends('template/t_index')
@section('title')
	Home
@endsection

<?php 
	$listruangan = DB::table('ruang_dramaga')->get();
	$cukruangan = $listruangan;

	$liststaff = DB::table('login')->where('hak_akses','=','user')->get();
	$cukstaff = $liststaff;

	$jumlahruangan = DB::table('ruang_dramaga')->count();
	$jumlahruanganbaranang = DB::table('ruang_baranang')->count();
	$jumlahstaff = DB::table('login')->where('hak_akses','=','user')->count();
	$jumlahinventaris = DB::table('listbarang')->count();
	//$jumlahruangan = $jumlahruangandramaga + $jumlahruanganbaranang;
	$nomor = 1;
?>
@section('content')
<div id="page-wrapper">
	<div class="main-page">
       <!--  <div class="title">Hei Selamat Datang Kembali Admin</div> -->
        <div class="row-one">
					<div class="col-md-4 widget"><a href="{{URL('staff')}}">
						<div class="stats-left">
							<h5>Jumlah Data</h5>
							<h4>Staff</h4>
						</div>
						<div class="stats-right">
							<label> {{$jumlahstaff}}</label>
						</div></a>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
							<h5>Jumlah Data</h5>
							<h4>Ruangan</h4>
						</div>
						<div class="stats-right">
							<label> {{$jumlahruangan}}</label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<div class="stats-left">
							<h5>Jumlah Data</h5>
							<h4>Inventaris</h4>
						</div>
						<div class="stats-right">
							<label>{{$jumlahinventaris}}</label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
        <br/>
			<div class="row">
					
			<div class="col-md-8 stats-info widget-shadow">
					<table class="table stats-table ">
							<thead>
								<tr>
									<th>NO</th>
									<th>RUANGAN</th>
									<th>LOKASI</th>
									<th>JUMLAH BARANG</th>
									<th>ACTION</th>
								</tr>
							</thead>
							@foreach($cukruangan as $listruangan)
							<tbody>
								<tr>
								<?php $jumlahbarangdramaga = DB::table('listbarang')->where('id_ruangan','=',$listruangan->id)->count();?>
									<th scope="row">{{$nomor++}}</th>
									<td>{{$listruangan->nama_ruang}}</td>
									<td>{{$listruangan->lokasi}}</td>
									<td align="center">{{$jumlahbarangdramaga}}<!-- <i class="fa fa-level-up"></i> --></td>
									<td><a href="{{URL('lihatruang',$listruangan->id)}}"><span class="label label-success">Lihat</span></a></td>
									
								
								</tr>
							</tbody>
							@endforeach
						</table>
						
					</div>
					<div class="col-md-4 stats-info widget">
						<div class="stats-title">
							<h4 class="title">Staff Status</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
							@foreach($cukstaff as $liststaff)
								<li>{{$liststaff->namalengkap}} <span class="pull-right">85%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style="width:85%;"></div> 
									</div>
								</li>
							@endforeach
								<!-- <li>Firefox <span class="pull-right">35%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar yellow" style="width:35%;"></div>
									</div>
								</li>
								<li>Internet Explorer <span class="pull-right">78%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar red" style="width:78%;"></div>
									</div>
								</li>
								<li>Safari <span class="pull-right">50%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar blue" style="width:50%;"></div>
									</div>
								</li>
								<li>Opera <span class="pull-right">80%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar light-blue" style="width:80%;"></div>
									</div>
								</li>
								<li class="last">Others <span class="pull-right">60%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar orange" style="width:60%;"></div>
									</div>
								</li>  -->
							</ul>
						</div>
					</div>
					<div class="clearfix"> </div>
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


