@extends('template/t_index')

@section('title')
	Notifikasi
@endsection

@section('content')
	  <div id="page-wrapper">
      <div class="main-page">
        <h3 class="title1">Pemberitahuan</h3>
        <!-- <div class="inbox-page">
          <h4>Today</h4>

        </div> -->
        <div class="bs-example widget-shadow" data-example-id="contextual-table"> 
            <h4>Colored Rows Table:</h4>
            <table class="table"> <thead> <tr> 
            <th>#</th> 
            <th>Column heading</th> 
            <th>Column heading</th> 
            <th>Column heading</th> </tr> </thead> 
            <tbody> <tr class="active"> 
            <th scope="row">1</th> 
            <td>Column content</td> 
            <td>Column content</td> 
            <td>Column content</td> </tr> 
            <tr> <th scope="row">2</th> 
            <td>Column content</td> 
            <td>Column content</td> 
            <td>Column content</td> </tr> 
            <tr class="success"> 
            <th scope="row">3</th> 
            <td>Column content</td> 
            <td>Column content</td> 
            <td>Column content</td> </tr> 
            <tr> <th scope="row">4</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> <tr class="info"> <th scope="row">5</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> <tr> <th scope="row">6</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> <tr class="warning"> <th scope="row">7</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> <tr> <th scope="row">8</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> <tr class="danger"> <th scope="row">9</th> <td>Column content</td> <td>Column content</td> <td>Column content</td> </tr> </tbody> </table> 
          </div>
      </div>
    </div>
@endsection