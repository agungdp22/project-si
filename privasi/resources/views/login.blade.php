@extends('template/t_index')
<style type="text/css">
	body { background: url(assets/janux/img/bg-login.jpg) !important; }
</style>
@section('content')

			<div class="main-page login-page ">
				<h3 class="title1">SignIn Page</h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Welcome back</h4>
					</div>
					@if(Session::has('message'))
					<span class="label label-danger">{{Session::get('message')}}</span>
					@endif
					<div class="login-body">
						{!!Form::open(['url'=>'/login'])!!}
						Username: @if($errors->has())
						<br/>
						<span class="label label-danger">{!!$errors->first('username')!!}</span>
						<p></p>
						@endif
						{!!Form::text('username','',['placeholder'=>'Username','class'=>'form-control'])!!}
						Password: @if($errors->has())
						<br/>
						<span class="label label-danger">{!!$errors->first('password')!!}</span>
						<p></p>
						@endif
						{!!Form::password('password',array('class'=>'form-control','placeholder'=>'Password'))!!}
						<p></p>
						{!!Form::submit('Login',['class'=>'btn btn-danger'])!!}
						{!!Form::close()!!}
					</div>
				</div>
				
			</div>
@stop