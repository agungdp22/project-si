@extends('template/t_index')
<style type="text/css">
	body { background: url(assets/janux/img/bg-login.jpg) !important; }
</style>
@section('content')
<div id="page-wrapper">
@if(Session::has('message'))
<div class="main-page">
<span class="label label-danger">{{Session::get('message')}}</span>
</div>
@endif