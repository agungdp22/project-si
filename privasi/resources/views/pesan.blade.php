@extends('template/t_index')

@section('title')
  Pesan
@endsection

@section('content')
@if(Auth::user()->hak_akses=="admin")
  <div id="page-wrapper">
      <div class="main-page">
        <h3 class="title1">Semua Pesan</h3>
        <div class="inbox-page">
          <!-- <h4>Today</h4> -->
<?php $no=1;?>
@foreach($pesanadmin as $data)
          <div class="inbox-row widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="mail "> {{$no++}}. </div>
            <div class="mail mail-name"> <h6>@if($data->status)<b>{{$data->namapengirim}}</b>@else {{$data->namapengirim}} @endif</h6> </div>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}">
              <div class="mail"><p>@if($data->status)<b>Ruang {{$data->namaruangan}}</b>@else Ruang {{$data->namaruangan}} @endif</p></div>
            </a>
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
                    <a href="#" title="">
                      <i class="fa fa-download mail-icon"></i>
                      Archive
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
                DB::table('pesan')->where('tipe','=','admin')->update($stattt);
              ?>
                <p>{{$data->isipesan}}</p>
                {!! Form::open(array('url'=>'kirimpesandariadmin', 'role'=>'form', 'class="form-horizontal form-label-left"')) !!}
                  <input type="hidden" name="namaruangan" value="{{$data->namaruangan}}" class="form-control">
                  <input type="hidden" name="namapengirim" value="Admin" class="form-control">
                  <input type="hidden" name="penerima" value="{{$data->namapengirim}}" class="form-control">
                  <input type="hidden" name="status" value="1" class="form-control">
                  <input type="hidden" name="lokasiruangan" value="Dramaga" class="form-control">
                  <input type="hidden" name="tipe" value="user" class="form-control">
                  <input type="text" name="isipesan" placeholder="Reply to sender" required="">
                  <input type="submit" value="Kirim">
                {!! Form::close() !!}
              </div>
            </div>
          </div>
@endforeach
        </div>
      </div>
    </div>


@else
<div id="page-wrapper">
      <div class="main-page">
        <h3 class="title1">Semua Pesan</h3>
        <div class="inbox-page">
          <!-- <h4>Today</h4> -->
<?php $no=1;?>
@foreach($pesanuser as $datauser)
          <div class="inbox-row widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="mail "> {{$no++}}. </div>
            <div class="mail mail-name"> <h6>@if($datauser->status)<b>{{$datauser->namapengirim}}</b>@else {{$datauser->namapengirim}} @endif</h6> </div>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$datauser->id}}" aria-expanded="true" aria-controls="collapse{{$datauser->id}}">
              <div class="mail"><p>@if($datauser->status)<b>Ruang {{$datauser->namaruangan}}</b>@else Ruang {{$datauser->namaruangan}} @endif</p></div>
            </a>
            <div class="mail-right">
              <div class="dropdown">
                <a href="#"  data-toggle="dropdown" aria-expanded="false">
                  <p><i class="fa fa-ellipsis-v mail-icon"></i></p>
                </a>
                <ul class="dropdown-menu float-right">
                  <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$datauser->id}}" aria-expanded="true" aria-controls="collapse{{$datauser->id}}">
                      <i class="fa fa-reply mail-icon"></i>
                      Reply
                    </a>
                  </li>
                  <li>
                    <a href="#" title="">
                      <i class="fa fa-download mail-icon"></i>
                      Archive
                    </a>
                  </li>
                  <li>
                    <a href="{{URL('hapuspesan',$datauser->id)}}" class="font-red" title="">
                      <i class="fa fa-trash-o mail-icon"></i>
                      Delete
                    </a>
                  </li>
                </ul>
              </div> 
            </div>
            <div class="mail-right"><p>@if($datauser->status)<b>New</b>@endif</div>
            <div class="clearfix"> </div>
            <div id="collapse{{$datauser->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="mail-body">
              <?php
                $stattt = array('status'=> 0);
                DB::table('pesan')->where('tipe','=','user')->update($stattt);
              ?>
                <p>{{$datauser->isipesan}}</p>
                <form>
                  <input type="text" placeholder="Reply to sender" required="">
                  <input type="submit" value="Kirim">
                </form>
              </div>
            </div>
          </div>
@endforeach
        </div>
      </div>
    </div>

@endif
@endsection