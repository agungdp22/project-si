<!DOCTYPE>
<html>
<head>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.close').click(function(eve){
			
			eve.preventDefault();
			$(this).parents('div.popup').fadeOut('slow');
		});
	});
</script>
<style type="text/css">
	body{
		width:100%;
		height:100%;
		margin:0;
		padding:0;
	}
	div.popup{
		position:fixed;
		top:0;
		bottom:0;
		left:0;
		right:0;
		width:100%;
		height:100%;
		background: rgba(0,0,0,.8);
	}
	
	div#box{
		margin:5% auto;
		background:#fff;
		width:50%;
		height:50%;
		-webkit-box-shadow:0 0 15px #000;
		-moz-box-shadow:0 0 15px #000;
		box-shadow:0 0 15px #000;
	}
	
	a.close{
		text-decoration:none;
		color:#000;
		margin:10px 15px 0 0;
		float:right;
		font-family:tahoma;
		font-size:20px;
	}
</style>
</head>
<body>
	<!-- bagian popup -->
	<div class="popup">
		<div id="box">
			<a class="close" href="#">X</a>
		</div>		
	</div>
	<!-- akhir dari popup -->
	
	<h1>Judul Artikel</h1>
	<p>ini artikelnya</p>
</body>
</html>