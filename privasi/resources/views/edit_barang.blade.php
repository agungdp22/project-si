@extends('template/t_index')
@section('content')

@if(Auth::user())

<div id="page-wrapper">
    <div class="main-page">
@if(Session::has('message'))
<span class="label label-success">{{Session::get('message')}}</span>
@endif
<p></p>
<div class="table-responsive">
<div class="panel panel-default">
	<div class="panel-heading">
	Ubah Data Barang</div>
	{!! Form::open(['url' => '/proseseditbrg']) !!}
	{!! Form::hidden('id',$barang->id,['class'=>'form-control'])!!}
    Kode Barang:
    {!! Form::text('kode_barang', $barang->kode_barang, ['class' => 'form-control']) !!}
    Nama Ruang:
    {!! Form::text('nama_barang', $barang->nama_barang, ['class' => 'form-control']) !!}
    Merk:
    {!! Form::text('merk', $barang->merk, ['class' => 'form-control']) !!}
    Tahun Perolehan:
    {!! Form::text('tahun_perolehan', $barang->tahun_perolehan, ['class' => 'form-control']) !!}
    Harga:
    {!! Form::text('harga', $barang->harga, ['class' => 'form-control']) !!}
    Jumlah:
    {!! Form::text('jumlah', $barang->jumlah, ['class' => 'form-control']) !!}
    Satuan:
    {!! Form::text('satuan', $barang->satuan, ['class' => 'form-control']) !!}
    Sumber Dana:
    {!! Form::text('sumber_dana', $barang->sumber_dana, ['class' => 'form-control']) !!}
    Kondisi:
    {!! Form::text('kondisi', $barang->kondisi, ['class' => 'form-control']) !!}
    <p></p>
    {!! Form::submit('Ubah Data',['class' => 'btn btn-success']) !!}
    <a onclick="history.go(-1);"><span class="btn btn-danger">Batal</span></a>
    {!! Form::close() !!}
    @stop
    </div>
</div>
</div>
@else
<span class="label label-danger">Akses Ditolak</span>
@endif
</div>
