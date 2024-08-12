@extends('layout')
@section('content')

<div class="app-title">
    <div>
      <h1><i class="fa fa-shopping-cart"></i>Shopping Cart</h1>
      <p>here is your cart</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-shopping-cart fa-lg"></i></li>
      <li class="breadcrumb-item">Cart</li>
      <li class="breadcrumb-item"><a href="#">Shopping Cart</a></li>
    </ul>
  </div>

<div class="container">
    @php
        $i = 0;
    @endphp
    <div class="row">
        @if ($cart)
        <div class="col-md-8">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Quantity</th>


                    </tr>
                  </thead>
                  <tbody>
            @foreach ($cart->items as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a href="{{route('product.show',$product['id'])}}"><img src="{{$product['image']}}" width="100px"></a></td>
            <td>{{$product['name']}}</td>
            <td>{{$product['price']}} S.P </td>
            <td>
                <form action="{{route('cart.remove',$product['id'])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm ml-4 ">Remove</button>
                    <input type="text" name="qty" id="qty" value="{{$product['qty']}}">
                    <a href="" class="btn btn-primary btn-sm">change</a>
                </form>


            </td>

                    </tr>
          @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>

      </div>
      <a href="{{route('cart.checkout')}}" class="btn btn-primary btn-sm">checkout</a>

    {{-- <div class="row">
        @if ($cart)
            @foreach ($cart->items as $product)
            <div class="col-md-9">
                <div class="container">
                <div class="col-md-3">
                    <br>
                    <img  class= "square img-fluid" src="{{$product['image']}}" >
                </div>

                    <h3 class="tile-title"><b>  {{$product['name']}} </b>&nbsp;&nbsp;</h3>
                    <h4><b>{{$product['price']}} S.P </b></h4>
                    <div class="row">
                        <a href="#" class="btn btn-danger btn-sm ml-4"><i class="fa fa-minus"></i></a>&nbsp;
                        <input type="text" name="qty" id="qty" value="{{$product['qty']}}">&nbsp;
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>

                    </div>
                </div>


            </div><br><br>
            @endforeach
    </div>
    <br><br>
     <p><Strong>Total : {{$cart->totalPrice}}</Strong></p>
</div> --}}


@else
<center>
    <div>

        <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
           The Cart is a temporary place to store a list
           of your items and reflects each item's most recent price.


</div>
</center>




@endif


@endsection
