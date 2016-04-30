@extends('template/t_index')
@section('content')

<div id="page-wrapper">
    <div class="main-page">
<p></p>
<div class="panel panel-default">
    <div class="panel-heading">
    Tambah Data</div>
    <div class="panel-body">
    {!! Form::open(['url' => '/prosestambah']) !!}
    <br>Nama: @if($errors->has())
    <br/>
    <span class="label label-danger">{!! $errors->first('nama') !!}</span>
    <p></p>
        @endif
    {!! Form::text('nama', '', ['placeholder' => 'Nama', 'class' => 'form-control']) !!}
    <br>Alamat: @if($errors->has())
    <br/>
    <span class="label label-danger">{!! $errors->first('alamat') !!}</span>
    <p></p>
        @endif
    {!! Form::text('alamat', '', ['placeholder' => 'Alamat', 'class' => 'form-control']) !!}
    <br>Kelas: @if($errors->has())
    <br/>
    <span class="label label-danger">{!! $errors->first('kelas') !!}</span>
    <p></p>
        @endif
    {!! Form::text('kelas', '', ['placeholder' => 'Kelas', 'class' => 'form-control']) !!}
    <p></p>
    {!! Form::submit('Tambah Data',['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    @stop
    </div>
</div>
</div>
