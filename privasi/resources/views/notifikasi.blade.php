@extends('template/t_index')

@section('title')
	Notifikasi
@endsection

@section('content')
	  <div id="page-wrapper">
      <div class="main-page">
        <h3 class="title1">Pemberitahuan</h3>
<?php $namaente = Auth::user()->namalengkap; ?>
        <div class="grid_3 grid_5 widget-shadow">
        @if($notif)
          @foreach($notif as $data)
          <div class="well">
            @if($namaente == $data->pengirim) Anda @else {{$data->pengirim}} @endif telah {{$data->isinotif}} "<b><a href="notif/{{$data->barang}}/{{$data->ruangan}}">{{$data->barang}}</a></b>" di ruangan "<b>{{$data->ruangan}}</b>" [{{$data->lokasi}}]&nbsp
            <h4 align="left>"><a href="{{URL('deletenotif',$data->id)}}" class="font-red" title="">
                      <i class="fa fa-trash-o mail-icon"></i>
                      Delete
                    </a></h4>
          </div>
          @endforeach
          {!! $notif->render() !!}
        @else
        Tidak ada pemberitahuan
        @endif
        </div>
            <?php $cekkk = array('status'=>0);
            DB::table('notif')->update($cekkk);
            ?>
      </div>
    </div>
@endsection