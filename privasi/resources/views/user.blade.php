@extends('template/t_index')
@section('title')
	Home | Staff
@endsection
@section('content')

<div id="page-wrapper">
    <div class="main-page">
    <div class="content">
        <div class="title">Selamat Datang {{Auth::user()->namalengkap}}</div>
        <br/>
        <a href="read"><span class="btn btn-success">Lihat Data</span></a><br><br>
		<a href="logout"><span class="btn btn-danger">cdfsd</span></a><br>
        </div>
</div>

@stop