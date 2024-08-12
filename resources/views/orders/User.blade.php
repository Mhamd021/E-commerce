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

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                        <th>number</th>
                      <th>Name</th>
                      <th>phone</th>
                      <th>time</th>
                      <th>Status</th>


                    </tr>
                  </thead>
                  <tbody>



                    @foreach ($orders as $order)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->time_to_deliver  }}</td>

            <td><a href="{{route('order.UserDelivered',$order->id)}}"><b><i class="btn btn-primary">Deliverd?</i></b> </a> </td>



                    </tr>
          @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>












   @endsection



















