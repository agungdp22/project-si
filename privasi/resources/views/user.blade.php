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
        Wilayah kerja anda di {{Auth::user()->lokasi}}
        <!-- <a href="read"><span class="btn btn-success">Lihat Data</span></a><br><br> -->
        </div>
</div>

@stop