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



    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Store orders</h3>

            <div class="tile-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="tile">
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="sampleTable">
                                            <thead>
                                              <tr>
                                                <th>User</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Time</th>
                                                <th>Ready</th>
                                              </tr>
                                            </thead>
                                            <tbody>



                                      @foreach ($storeorders as $product)
                                  <tr>
                                    <td>{{$product->user_name}}</td>
                                      <td><a href="{{route('product.show',$product->product_id)}}"><img src="http://127.0.0.1:8000/{{ $product->image }}" width="100px"></a></td>
                                      <td>{{ $product->name }}</td>
                                      <td>{{ $product->price }}</td>
                                      <td>{{ $product->quantity }}</td>
                                      <td>{{ $product->time_to_deliver }}</td>

                                        <td><a href="{{route('order.done',$product->id)}}"><i class=" btn btn-primary">ready</i></a></td>


                                              </tr>
                                    @endforeach
                                            </tbody>
                                          </table>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    @endsection
    {{-- @foreach ($carts as $cart)

    <table class="table table-hover table-bordered">

        @foreach ($cart->items as $pr)
        @if ($pr['store_id']== $shop->id)
        <thead>
            <tr>

                <th>User</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>

                    <tr>

                        <td><b>{{$pr['user_name']}}</b></td>
                            <td><a href="{{ route('product.show', $pr['id']) }}"><img
                                        src="http://127.0.0.1:8000/{{ $pr['image'] }}"
                                        width="100px"></a></td>
                            <td>{{ $pr['name'] }}</td>
                            <td>{{ $pr['price'] }}$ </td>
                            <td>
                                {{ $pr['qty'] }}
                            </td>




                    </tr>
                    @endif

                    @endforeach

        </tbody>
    </table>
    <a href=""><i class="btn btn-primary mt-3 mb-3">ready</i></a>


    <hr>
    @endforeach --}}
