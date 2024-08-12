@extends('layout')
@section('content')
    <style>
        .rating-css div {
            color: #ffe400;
            font-size: 30px;
            font-family: sans-serif;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            padding: 20px 0;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 60px;
            text-shadow: 1px 1px 0 #8f8420;
            cursor: pointer;
        }

        .rating-css input:checked+label~label {
            color: #b4afaf;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }

        .checked {
            color: #ffee00
        }

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
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

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
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
    </style>
    @php
    $thisUser = Auth::user();
@endphp
    <div class="app-title">
        <div>
            <h1><i class="fa fa-eye"></i> Show Product</h1>
            <p>{{ $product->name }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Products</li>
            <li class="breadcrumb-item"><a href="#">Show</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $product->name }}</a></li>

        </ul>
    </div>
    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('rating.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Rate {{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-4">
    <img src="http://127.0.0.1:8000/{{$product->image}}" class="img-fluid">
<div class="tile">
  <div class="tile-title-w-btn">
    <h3 class="title">{{$product->name}}</h3>
    <p><a class="btn btn-primary icon-btn" href="{{route('cart.add',$product->id)}}"><i class="fa fa-plus"> Add</i></a></p>
  </div>
  <div class="tile-body">
    <b>{{$product->price}}</b><br>
    {{$product->detail}}
  </div>
</div>
</div>
<p><a class="btn btn-primary icon-btn" href="{{route('product.edit',$product->id)}}"><i class="fa fa-edit"> edit</i></a></p>

<button type="button" class="btn btn-primary icon-btn" data-bs-toggle="modal"
data-bs-target="#exampleModal">
Rate this Product
</button> --}}
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 border-right">
                        <img id="myImg" src="http://127.0.0.1:8000/{{ $product->image }}" class="w-100"
                            alt="{{ $product->name }}">
                        <div id="myModal" class="modalx">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h2 class="mb-0">
                            <b>
                                {{ $product->name }}
                            </b>

                        </h2>
                        <br>
                        <label class="fw-bold"><b>Selling Price : {{ $product->price }}</b> </label>
                        <div class="rating">
                            @php
                                $ratenum = number_format($rating_value)
                            @endphp

                            @for ($i = 1; $i <= $ratenum; $i++)
                            <i class="fa fa-star checked"> </i>
                            @endfor
                            @for ($j = $ratenum+1; $j <=5;  $j++)
                            <i class="fa fa-star "> </i>
                            @endfor
                            <span>{{ $ratings->count() }} Ratings</span>
                        </div>
                        <p class="mt-3">
                            <b>
                                {{ $product->detail }}
                            </b>

                        </p>
                          <p class="mt-3">
                            <b>
                             <a href="{{route('shop.show',$product->shops->id)}}">{{ $product->shops->name }} Shop </a>
                            </b>

                        </p>

                        <div class="row">

                            {{-- <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <p><a class="btn btn-primary icon-btn" href="{{route('cart.add',$product->id)}}"><i class="fa fa-minus"></i></a></p>
                                &nbsp;
                                <input type="text" name="quantity" value="1">
                                &nbsp;
                                <p><a class="btn btn-primary icon-btn" href="{{route('cart.add',$product->id)}}"><i class="fa fa-plus"></i></a></p>
                            </div> --}}


                            @if (auth()->check())
                                @if (auth()->user()->hasPermission('products_update'))
                                @if ($shop->user_id==$thisUser->id)
                                    <p><a class="btn btn-danger icon-btn"
                                            href="{{ route('product.edit', $product->id) }}"><i class="fa fa-edit">
                                                edit</i></a></p>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    @endif
                                @endif
                            @endif

                            <p><a class="btn btn-primary icon-btn ml-2" href="{{ route('cart.add', $product->id) }}"><i
                                        class="fa fa-plus "> Add</i></a></p>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        @if (auth()->check())
                                        @if (auth()->user()->hasPermission('products_delete'))
                                        @if ($shop->user_id==$thisUser->id)
                                                    <p><a class="btn btn-danger icon-btn"
                                                            href="{{ route('product.destroy', $product->id) }}"><i class="fa fa-remove">
                                                                Delete</i></a></p>
                                                    &nbsp;
                                                    &nbsp;
                                                    &nbsp;
                                                    @endif
                                            @endif
                                            @endif
                        </div>

                    </div>

                </div>
                <div class="col-md-12">
                    <hr>
                    <center>

                        <button type="button" class="btn btn-primary icon-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Rate this Product
                        </button>
                    </center>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modalx = document.getElementById("myModal");
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modalx.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modalx.style.display = "none";
        }
    </script>
@endsection
