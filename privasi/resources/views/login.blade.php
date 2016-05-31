@extends('template/t_index')
@section('title')
	Login
@endsection

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
							<input type="text" class="user" name="username" placeholder="Enter your username" required="">
							<input type="password" name="password" class="lock" placeholder="password">
							<input type="submit" name="Sign In" value="Sign In">
							
						{!!Form::close()!!}
					</div>
				</div>
				
			</div>
@stop