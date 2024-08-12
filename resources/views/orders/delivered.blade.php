@extends('layout')
@section('content')


    <style>
        .close {
            position: absolute;
            top: 50px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        .modalx {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
    </style>

<form action="{{ route('order.deliverd',$order->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Active order</h3>
            <div class="tile-body">


                <div hidden id="lat">{{ $order->lat }}</div>
                <div hidden id="lng">{{ $order->lng }}</div>

                {{-- <button id="route">route</button> --}}
                <div class="container">

                    <div class="row">
                        <div class="col-md-8">
                          <div class="tile">
                            <div class="tile-body">
                              <div class="table-responsive">
                                <table class="table table-hover table-bordered" >
                                  <thead>
                                    <tr>

                                      <th>Image</th>
                                      <th>Name</th>
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Store</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                            @foreach ($cart->items as $product)
                        <tr>

                            <td><a href="{{route('product.show',$product['id'])}}"><img src="http://127.0.0.1:8000/{{$product['image']}}" width="100px"></a></td>
                            <td>{{$product['name']}}</td>
                            <td>{{$product['price']}} S.P </td>
                            <td>
                            {{$product['qty']}}
                            </td>
                            <td>{{$product['store_name']}}</td>
                                    </tr>
                          @endforeach
                                  </tbody>
                                </table>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <b>Total Price : {{$cart->totalPrice}}</b>

                        </div>
                      </div>

            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i
                        class="fa fa-fw fa-lg fa-check-circle"></i>Delivered</button>
            </div>
        </div>
    </div>




@endsection
