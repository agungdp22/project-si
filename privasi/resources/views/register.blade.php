@extends('template/t_index')
@section('content')

<div id="page-wrapper">
    <div class="main-page">
<p></p>
<div class="panel panel-default">
    <div class="panel-heading">
    Tambah Staff</div>
    <div class="panel-body">
    {!! Form::open(['url'=>'/tambahlogin'])!!}
				Username: @if($errors->has())
				<br/>
					<span class='label label-danger'>{!!$errors->first('username')!!}</span>
					<p></p>
					@endif
				{!!Form::text('username','',['placeholder'=>'Username','class'=>'form-control'])!!}
				Password: @if($errors->has())
				<br/>
					<span class='label label-danger'>{!!$errors->first('password')!!}</span>
				<p></p>
					@endif
				{!!Form::password('password',array('class'=>'form-control','placeholder'=>'Password'))!!}
				Nama Lengkap: @if($errors->has())
				<br/>
					<span class='label label-danger'>{!!$errors->first('namalengkap')!!}</span>
					<p></p>
					@endif
				{!!Form::text('namalengkap','',['placeholder'=>'Nama Lengkap','class'=>'form-control'])!!}
				Email: @if($errors->has())
				<br/>
					<span class='label label-danger'>{!!$errors->first('email')!!}</span>
					<p></p>
					@endif
				{!!Form::text('email','',['placeholder'=>'Email','class'=>'form-control'])!!}
				<p></p>
				{!!Form::submit('Tambah',['class'=>'btn btn-success'])!!}
				{!!Form::close()!!}
    @stop
    </div>
</div>
</div>