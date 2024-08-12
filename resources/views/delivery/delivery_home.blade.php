@extends('layout')
@section('content')
@php

$i = 0

@endphp

      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Welcome</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Deliver</a></li>
        </ul>
      </div>
      <i class="btn btn-primary mb-3">Ready orders</i>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
@if ($orders->count() > 0)
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
      <tr>
          <th>number</th>
        <th>Name</th>
        <th>product</th>
        <th>price</th>
        <th>time</th>
        <th>Full Order</th>


      </tr>
    </thead>
    <tbody>



      @foreach ($ready as $o)

      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $o->user_name }}</td>
        <td>{{ $o->name}}</td>
        <td>{{ $o->price }}</td>
        <td>{{ $o->time_to_deliver  }}</td>

        <td><a href="{{route('order.show',$o->order_id)}}"><b>show Details</b> </a> </td>


              </tr>


@endforeach
    </tbody>
  </table>

@endif



              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <i class="btn btn-primary mb-3">finished s</i>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
@if ($order->count() > 0)
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
      <tr>
          <th>number</th>
        <th>Name</th>
        <th>phone</th>
        <th>time</th>
        <th>Details</th>


      </tr>
    </thead>
    <tbody>



      @foreach ($order as $o)
<tr>
<td>{{ ++$i }}</td>
<td>{{ $o->user->name }}</td>
<td>{{ $o->phone }}</td>
<td>{{ $o->time_to_deliver  }}</td>

<td><a href="{{route('order.show',$o->id)}}"><b>show Details</b> </a> </td>


      </tr>
@endforeach
    </tbody>
  </table>

@endif



              </div>
            </div>
          </div>
        </div>
      </div> --}}
      {{-- <div class="row">
        @foreach ($s as $order)

        <div class="col-md-3">
        <a href="{{route('order.show',$order->id)}}">{{$order->user->name}}

        </a>
        <div class="row">{{$order->time_to_deliver}}</div>
        <br>
        <hr>
    </div>


</div>
        @endforeach --}}









    <script type="text/javascript">
        $('#demoNotify').click(function(){
            $.notify({
                title: "Update Complete : ",
                message: "Something cool is just updated!",
                icon: 'fa fa-check'
            },{
                type: "info"
            });
        });
        </script>

   @endsection



















