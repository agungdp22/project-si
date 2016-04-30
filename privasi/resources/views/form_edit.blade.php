@extends('template/t_index')
@section('content')

@if(Auth::user())

<div id="page-wrapper">
    <div class="main-page">
@if(Session::has('message'))
<span class="label label-success">{{Session::get('message')}}</span>
@endif
<p></p>
<div class="panel panel-default">
	<div class="panel-heading">
	Ubah Data</div>
	{!! Form::open(['url' => '/prosesedit']) !!}
	{!! Form::hidden('id',$ruang_dramaga->id,['class'=>'form-control'])!!}
    Nama Ruang:
    {!! Form::text('nama_ruang', $ruang_dramaga->nama_ruang, ['class' => 'form-control']) !!}
    Kode Ruang:
    {!! Form::text('kode_ruang', $ruang_dramaga->kode_ruang, ['class' => 'form-control']) !!}
    Wing:
    {!! Form::text('wing', $ruang_dramaga->wing, ['class' => 'form-control']) !!}
    Level:
    {!! Form::text('level', $ruang_dramaga->level, ['class' => 'form-control']) !!}
    Ukuran Panjang:
    {!! Form::text('ukuran_panjang', $ruang_dramaga->ukuran_panjang, ['class' => 'form-control']) !!}
    Ukuran Lebar:
    {!! Form::text('ukuran_lebar', $ruang_dramaga->ukuran_lebar, ['class' => 'form-control']) !!}
    Luas:
    {!! Form::text('luas', $ruang_dramaga->luas, ['class' => 'form-control']) !!}
    <p></p>
    {!! Form::submit('Ubah Data',['class' => 'btn btn-success']) !!}
    <a onclick="history.go(-1);"><span class="btn btn-danger">Batal</span></a>
    {!! Form::close() !!}
    @stop
    </div>
</div>
@else
<span class="label label-danger">Akses Ditolak</span>
@endif
</div>
