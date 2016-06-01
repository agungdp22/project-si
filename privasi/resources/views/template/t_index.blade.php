<!DOCTYPE HTML>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<link href="{{URL('assets/template/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />

	<link href="{{URL('assets/template/css/style.css')}}" rel='stylesheet' type='text/css' />

	<link href="{{URL('assets/template/css/font-awesome.css')}}" rel="stylesheet"> 

	<script src="{{URL('assets/template/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{URL('assets/template/js/modernizr.custom.js')}}"></script>

	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

	<link href="{{URL('assets/template/css/animate.css')}}" rel="stylesheet" type="text/css" media="all">
	<script src="{{URL('assets/template/js/wow.min.js')}}"></script>
		<script>
			 new WOW().init();
		</script>
	<script src="{{URL('assets/template/js/Chart.js')}}"></script>
	<link rel="stylesheet" href="{{URL('assets/template/css/clndr.css')}}" type="text/css" />
	<script src="{{URL('assets/template/js/underscore-min.js')}}" type="text/javascript"></script>
	<script src= "{{URL('assets/template/js/moment-2.2.1.js')}}" type="text/javascript"></script>
	
	<script src="{{URL('assets/template/js/metisMenu.min.js')}}"></script>
	<script src="{{URL('assets/template/js/custom.js')}}"></script>
	<link href="{{URL('assets/template/css/custom.css')}}" rel="stylesheet">
	
	<?php
		$jumlahsemuapesan = DB::table('pesan')->count();
		$jumlahsemuanotif = 20;

		$isipesanadmin = DB::table('pesan')->where('status','=',1)->where('tipe','=','admin')->orderby('id','desc')->get();
		$jpa = count(DB::table('pesan')->where('tipe','=','admin')->get());
		$jumlahpesanadmin = count($isipesanadmin);
		$isipesanuser = DB::table('pesan')->where('status','=',1)->where('tipe','=','user')->orderby('id','desc')->get();
		if(Auth::user()){
			$jpu = count(DB::table('pesan')->where('tipe','=','user')->where('penerima','=',Auth::user()->namalengkap)->get());
			$isipesanuser = DB::table('pesan')->where('status','=',1)->where('tipe','=','user')->orderby('id','desc')->where('penerima','=',Auth::user()->namalengkap)->get();
		}
		$jumlahpesanuser = count($isipesanuser);
		$cuk = $isipesanadmin;
		$cukk = $isipesanuser;

		$adanotif = DB::table('notif')->where('status','=',1)->count();
		$isinotif = DB::table('notif')->where('status','=',1)->get();
		$in = $isinotif;
	?>
	<script type="text/javascript">
	  //  function ambilKomentar(){
	  //  $.ajax({
	  //     type: "POST",
	  //     url: "ajaxnotifikasi",
	  //     dataType:'json',
	  //     success: function(response){
	  //      $("#jumlah").text(""+response+"");
	  //      //document.getElementById("jumlah_notif").innerHTML=response;
	  //      timer = setTimeout("ambilKomentar()",5000);
	  //     }
	  //    }); 
	  // }
	  // $(document).ready(function(){
	  //  ambilKomentar();
	  // });

	  window.onload = function()
		{
		   var hasil;
		   hasil = <?php echo($jumlahpesanadmin);?>;
		   document.getElementById("jumlah_notif").innerHTML=hasil;
		}
	</script>


</head> 

<body class="cbp-spmenu-push">

@if(Auth::user())
	<div class="main-content">
			<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="{{URL('/home')}}"><i class="fa fa-home nav_icon"></i>Home</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-large nav_icon"></i>Lihat Ruangan <!-- <span class="nav-badge">12</span> --> <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
							@if(Auth::user()->lokasi == "Dramaga" || Auth::user()->hak_akses == "admin")
								<li>
									<a href="{{URL('ruangan',"Dramaga")}}">Dramaga</a>
								</li>
								@endif
							@if(Auth::user()->lokasi == "Baranangsiang" || Auth::user()->hak_akses == "admin")
								<li>
									<a href="{{URL('ruangan',"Baranangsiang")}}">Baranangsiang</a>
								</li>
								@endif
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-table nav_icon"></i>Status Barang <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="{{URL('barang',"aktif")}}">Aktif</a>
								</li>
								<li>
									<a href="{{URL('barang',"tidakaktif")}}">Tidak Aktif</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="{{URL('notifikasi')}}"><i class="fa fa-file-text-o nav_icon"></i>&nbspPemberitahuan&nbsp</a>
							
						</li>
						<li>
							<a href="{{URL('pesan',"masuk")}}"><i class="fa fa-envelope nav_icon"></i>Pesan&nbsp[@if(Auth::user()->hak_akses=="admin"){{$jpa}}@else{{$jpu}}@endif]</a>
							
						</li>
						@if(Auth::user()->hak_akses=="admin")
						<li>
							<a href="{{URL('staff')}}"><i class="fa fa-cogs nav_icon"></i>Lihat Staff<!--<span class="nav-badge-btm">02</span><span class="fa arrow"></span>--></a>
						</li>
						@endif
					</ul>
					</nav>
				</div>
			</div>


	<div class="sticky-header header-section ">
			<div class="header-left">
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>

				<div class="logo">
					<a href="{{URL('/')}}">
						<h1>INVENTARIS</h1>
						<span>Ilmu Komputer IPB</span>
					</a>
				</div>

				<div class="search-box">

					 <form action="{{url('/hasil')}}" action="GET">
						<input name="cari" class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>

				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				<div class="profile_details_left">
					<ul class="nofitications-dropdown">
					<!-- notifikasi -->
						@if((Auth::user()->hak_akses=="admin") && $adanotif)
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"><span class="badge blue">{{$adanotif}}</span></i></a>
							<ul class="dropdown-menu">
							<?php $no = 1;?>
							@foreach($in as $isinotif)
								<li>
									<div class="notification_header">
										<h3>{{$isinotif->pengirim}} telah mengedit barang di ruangan {{$isinotif->ruangan}}</h3>
									</div>
								</li>
								<?php $no++;?>
								@if($no == 5) 
									<li>
											<p align="center">.....</p>
									</li>
									<?php break;?>
								@endif
							@endforeach
								 <li>
									<div class="notification_bottom">
										<a href="notifikasi">See all notifications</a>
									</div> 
								</li>
							</ul>
						</li>
						@else
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"><!-- <span class="badge blue"></span> --></i></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>No Notification</h3>
									</div>
								</li>
								
								 <li>
									<div class="notification_bottom">
										<a href="{{URL('notifikasi')}}">See all notifications</a>
									</div> 
								</li>
							</ul>
						</li>
						@endif
						
						<!-- pesan -->
						@if(Auth::user()->hak_akses=="admin")
						<!--(for admin)-->
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i>@if($jumlahpesanadmin)<span class="badge"><div id="jumlah_notif"></div></span>@endif</a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>@if($jumlahpesanadmin)Anda mempunyai {{$jumlahpesanadmin}} pesan baru @else Tidak ada pesan baru @endif</h3>
									</div>
								</li>
								@foreach($cuk as $isipesanadmin)
								<li><a href="#">
								   <div class="user_img"></div>
								   <div class="notification_desc">
									<p>{{$isipesanadmin->namaruangan}}</p>
									<p><span>{{$isipesanadmin->namapengirim}}</span></p>
									</div>
								   <div class="clearfix"></div>	
								</a></li>
								@endforeach
								<li>
									<div class="notification_bottom">
										<a href="{{URL('pesan',"masuk")}}">See all messages</a>
									</div> 
								</li>
							</ul>
						</li>
						@else
						<!--(for user)-->
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i>@if($jumlahpesanuser)<span class="badge">{{$jumlahpesanuser}}</span>@endif</a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>@if($jumlahpesanuser)Anda mempunyai {{$jumlahpesanuser}} pesan baru @else Tidak ada pesan baru @endif</h3>
									</div>
								</li>
								@foreach($cukk as $isipesanuser)
								<li><a href="#">
								   <div class="user_img"></div>
								   <div class="notification_desc">
									<p>{{$isipesanuser->namaruangan}}</p>
									<p><span>{{$isipesanuser->namapengirim}}</span></p>
									</div>
								   <div class="clearfix"></div>	
								</a></li>
								@endforeach
								<li>
									<div class="notification_bottom">
										<a href="{{URL('pesan')}}">See all messages</a>
									</div> 
								</li>
							</ul>
						</li>
						@endif

						<!-- @if(Auth::user()->hak_akses=="admin")
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 8 pending task</h3>
									</div>
								</li>
								<li><a href="#">
									<div class="task-info">
										<span class="task-desc">Database update</span><span class="percentage">40%</span>
										<div class="clearfix"></div>	
									</div>
									<div class="progress progress-striped active">
										<div class="bar yellow" style="width:90%;"></div>
									</div>
								</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all pending tasks</a>
									</div> 
								</li>
							</ul>
						</li>
						@endif	 -->
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="{{URL('assets/template/images/2.png')}}" alt=""> </span> 
									<div class="user-name">
										<p>@if(Auth::user()->hak_akses=="admin")
											{{Auth::user()->username}}
											</p>
											<span>Administrator</span>
											@else
											{{Auth::user()->namalengkap}}
											</p>
											<span>Staff</span>
											@endif
										
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<!-- <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li>  -->
								<li> <a href="{{URL('logout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>

@endif

@yield('content')

	<script src="{{URL('assets/template/js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<script src="{{URL('assets/template/js/jquery.nicescroll.js')}}"></script>
	<script src="{{URL('assets/template/js/scripts.js')}}"></script>
   	<script src="{{URL('assets/template/js/bootstrap.js')}}"> </script>


	
</body>
@yield('modalTambah')
@yield('modal')
@yield('modalEdit')
@yield('hapus')
@yield('modalNotif')


</html>