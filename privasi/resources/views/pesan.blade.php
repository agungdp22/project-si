@extends('template/t_index')

@section('title')
  Pesan
@endsection

@section('content')
  <div id="page-wrapper">
      <div class="main-page">
        <h3 class="title1">Pesan Masuk</h3>
        <div class="inbox-page">
<?php $no=1;
$namaente = Auth::user()->namalengkap;?>
@foreach($pesan as $data)
          <div class="inbox-row widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="mail "> {{$no++}}. </div>
            <div class="mail mail-name"> <h6>@if($data->status)<b>{{$data->namapengirim}}</b>@else {{$data->namapengirim}} @endif</h6> </div>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}">
              <div class="mail"><p>@if($data->status)<b>Ruang {{$data->namaruangan}}</b>@else Ruang {{$data->namaruangan}} @endif</p></div>
            </a>
            <div class="mail mail-name"> <h6>@if($data->status)<b>({{$data->lokasiruangan}})</b>@else [{{$data->lokasiruangan}}] @endif</h6> </div>
            <div class="mail-right">
              <div class="dropdown">
                <a href="#"  data-toggle="dropdown" aria-expanded="false">
                  <p><i class="fa fa-ellipsis-v mail-icon"></i></p>
                </a>
                <ul class="dropdown-menu float-right">
                  <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}">
                      <i class="fa fa-reply mail-icon"></i>
                      Reply
                    </a>
                  </li>
                  <li>
                    <a href="{{URL('hapuspesan',$data->id)}}" class="font-red" title="">
                      <i class="fa fa-trash-o mail-icon"></i>
                      Delete
                    </a>
                  </li>
                </ul>
              </div> 
            </div>
            <div class="mail-right"><p>@if($data->status)<b>New</b>@endif</div>
            <div class="clearfix"> </div>
            <div id="collapse{{$data->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="mail-body">
              <?php
                $stattt = array('status'=> 0);
                DB::table('pesan')->update($stattt);
              ?>
                <p>{{$data->isipesan}}</p>
                {!! Form::open(array('url'=>'kirimpesandariadmin', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
                  <input type="hidden" name="namaruangan" value="{{$data->namaruangan}}" class="form-control">
                  @if(Auth::user()->hak_akses == "admin")
                  <input type="hidden" name="namapengirim" value="Admin" class="form-control">
                  <input type="hidden" name="tipe" value="user" class="form-control">
                  @else
                  <input type="hidden" name="namapengirim" value="{{$namaente}}" class="form-control">
                  <input type="hidden" name="tipe" value="admin" class="form-control">
                  @endif
                  <input type="hidden" name="penerima" value="{{$data->namapengirim}}" class="form-control">
                  <input type="hidden" name="status" value="1" class="form-control">
                  <input type="hidden" name="lokasiruangan" value="Dramaga" class="form-control">
                  <input type="text" name="isipesan" placeholder="Reply to sender" required="">
                  <input type="submit" value="Kirim">
                {!! Form::close() !!}
              </div>
            </div>
          </div>
@endforeach
{!! $pesan->render() !!}
        </div>
      </div>
    </div>


@endsection