

@extends('layout')
@section('content')

                        @php

                            $i = 0
                        @endphp
                        <div class="app-title">
                          <div>
                            <h1><i class="fa fa-th-list"></i> Products Table</h1>
                            <p>Table to display Products</p>
                          </div>
                          <ul class="app-breadcrumb breadcrumb side">
                            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active"><a href="#">Products Table</a></li>
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
                                          <th>Price</th>
                                          <th>Category</th>
                                          <th>Details</th>
                                          <th>Shop</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                            $shop = Auth::user()->shops;
                                        @endphp


                                @foreach ($products as $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><a href="{{route('product.show',$product->id)}}"><img src="{{ $product->image }}" width="100px"></a></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->detail }}</td>
                                <td><a href="{{route('shop.show',$product->shops->id)}}"><b>{{$product->shops->name}}</b> </a> </td>
                                {{-- <img  src="{{$product->shops->image}}" width="100px"> --}}
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
                      {{-- <!-- Essential javascripts for application to work-->
                      <script src="{{asset('admin_panel/js/jquery-3.3.1.min.js')}}"></script>
                      <script src="{{asset('admin_panel/js/popper.min.js')}}"></script>
                      <script src="{{asset('admin_panel/js/bootstrap.min.js')}}"></script>
                      <script src="{{asset('js/app.js')}}"></script>
                      <!-- The javascript plugin to display page loading on top-->
                      <script src="{{asset('admin_panel/js/plugins/pace.min.js')}}"></script>
                      <!-- Page specific javascripts-->
                      <!-- Data table plugin-->
                      <script type="text/javascript" src="{{asset('admin_panel/js/plugins/jquery.dataTables.min.js')}}"></script>
                      <script type="text/javascript" src="{{asset('admin_panel/js/plugins/dataTables.bootstrap.min.js')}}"></script>
                      <script type="text/javascript">$('#sampleTable').DataTable();</script>
                      <!-- Google analytics script-->
                      <script type="text/javascript">
                        if(document.location.hostname == 'pratikborsadiya.in') {
                            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                            ga('create', 'UA-72504830-1', 'auto');
                            ga('send', 'pageview');
                        }
                      </script>
                    </body>
                  </html> --}}



{{--
@extends('layout')
@section('content')
        @php
        $i = 0 ;
    @endphp
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Data Table</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
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
                      <th>Price</th>
                      <th>Category</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
            @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="{{ $product->image }}" width="100px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->detail }}</td>
                    </tr>
          @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">$('#sampleTable').DataTable();</script>
    @endsection --}}
