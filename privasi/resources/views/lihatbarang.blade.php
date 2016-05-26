@extends('template/t_index')
@section('title')
	Lihat Barang
@endsection

<script type="text/javascript">
	function viewdata(id){
		var xx = id;
	        $.ajax({
	            type: "GET",
	            url: "{{URL('lihatruangajax',3)}}"
	            }).done(function( data ) {
	            $('#content').html(data);
	        });
	            console.log(xx);
	    }
</script>



@section('content')
@if(Auth::user())
<div id="page-wrapper">
	<div class="main-page">
	<p></p>
	<p align="center"><label align="right">Untuk melihat barang, silahkan pilih ruangan untuk menampilkan barang sesuai ruangan</label></p>
	<br>
	<select class="form-control" id="" name="" onchange="document.location.href=this.options[this.selectedIndex].value;">
        <option>--Pilih Ruangan--</option>
        @foreach($ruang as $pilihan)   
        <option value="{{URL('lihatruang',$pilihan->id)}}" >Ruang {{$pilihan->nama_ruang}}</option>
        @endforeach
     </select>



<div id='content'>
</div>
	@section('tampilkandata')
		<div class="modal">
		jahsgsdhagsj
		</div>
	@endsection
@endif
@endsection
