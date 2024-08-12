@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Shops Table</h1>
          <p>Table to display Shops</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"> Tables</li>
          <li class="breadcrumb-item active"><a href="#"> Shops</a></li>
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
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Products</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 0;
                    @endphp
            @foreach ($shops as $shop)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a href="{{route('shop.show',$shop->id)}}"><img src="{{ $shop->image }}" width="100px"></a></td>
            <td>{{ $shop->name }}</td>
            <td>{{$shop->products->count()}}</td>
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
