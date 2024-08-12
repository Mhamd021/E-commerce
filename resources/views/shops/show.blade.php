@extends('layout')
@section('content')
<style>
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
      <div class="app-title">
        <div>
          <h1><i class="fa fa-eye"></i> Shops Show</h1>
          <p>{{$shops->name}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Shops</li>
          <li class="breadcrumb-item"><a href="#">Show</a></li>
          <li class="breadcrumb-item"><a href="#">{{$shops->name}}</a></li>
        </ul>
      </div>
      @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 border-right">

                    <img id="myImg" src="http://127.0.0.1:8000/{{$shops->image}}" class="w-100"
                        alt="{{ $shops->name }}">
                    <div id="myModal" class="modalx">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h2 class="mb-0">
                        <b>
                            {{ $shops->name }}
                        </b>

                    </h2>
                    <br>
                    @if ($shops->location!=null)


                        <h4>
                            <label class="fw-bold">Location : {{ $shops->location }}</label>
                        </h4>
                        <br>
                        @endif
                        @if ($shops->description!=null)
                        <h5>
                            <label> {{ $shops->description }}</label>
                        </h5>

                    <br>
                    @endif
                    <label class="fw-bold"><b>Products : {{ $shops->products->count() }}</b> </label>

                    <div class="row">
                        @php
                            $thisUser = Auth::user();
                        @endphp
                    @if (auth()->check())
                    @if (auth()->user()->hasPermission('shops_update'))
                            @if ($shops->user_id==$thisUser->id)
                                <p><a class="btn btn-danger icon-btn"
                                        href="{{ route('shop.edit', $shops->id) }}"><i class="fa fa-edit">
                                            edit</i></a></p>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            @endif
                        @endif
                        @endif
                        @if (auth()->check())
                            @if (auth()->user()->hasPermission('shops_create'))
                            @if ($shops->user_id==$thisUser->id)
                        <p><a class="btn btn-primary icon-btn" href="{{route('product.create',$shops->id)}}"><i
                                    class="fa fa-plus"> Add Products</i></a></p>
                                    @endif
                                    @endif
                                    @endif
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    @if (auth()->check())
                                    @if (auth()->user()->hasPermission('shops_update'))
                                            @if ($shops->user_id==$thisUser->id)
                                                <p><a class="btn btn-danger icon-btn"
                                                        href="{{ route('shop.destroy', $shops->id) }}"><i class="fa fa-remove">
                                                            Delete</i></a></p>
                                                &nbsp;
                                                &nbsp;
                                                &nbsp;
                                            @endif
                                        @endif
                                        @endif
                                        &nbsp;
                                    &nbsp;
                                    @if (auth()->check())
                                    @if (auth()->user()->hasPermission('shops_update'))
                                            @if ($shops->user_id==$thisUser->id)
                                    <p><a class="btn btn-danger icon-btn"
                                        href="{{ route('order.shop', $shops->id) }}"><i class="fa fa-shopping-cart">
                                            Orders</i></a></p>
                                            @endif
                                        @endif
                                        @endif
                    </div>

                </div>

            </div>

                <hr>

        </div>
    </div>
</div>

<div>
<hr>
</div>
<div class="row">
@foreach ($shops->products as $product)
<div class="col-md-3">
    <a href="{{route('product.show',$product->id)}}"><img  src="http://127.0.0.1:8000/{{$product->image}}" class= "w-100 h-50"></a>
<div class="tile">
  <div class="tile-title-w-btn">
   <h3 class="title">{{$product->name}}</h3>

    <p><a class="btn btn-primary icon-btn" href="{{route('cart.add',$product->id)}}" id="demoNotify"><i class="fa fa-plus"> Add</i></a></p>

  </div>
  <div class="tile-title-w-btn">
    <b>{{$product->price}}S.P</b>


    @if (auth()->check())
    @if (auth()->user()->hasPermission('products_update'))
    @if ($shops->user_id==$thisUser->id)
    <p><a class="btn btn-primary icon-btn" href="{{route('product.edit',$product->id)}}" id="demoNotify"><i class="fa fa-edit"> Edit</i></a></p>
    @endif
    @endif
    @endif

    @if (auth()->check())
    @if (auth()->user()->hasPermission('products_update'))
    @if ($shops->user_id==$thisUser->id)
    <p><a class="btn btn-primary icon-btn" href="{{route('product.destroy',$product->id)}}" id="demoNotify"><i class="fa fa-edit">Delete</i></a></p>
    @endif
    @endif
    @endif
    {{-- @foreach ($product->ProductRating as $rating)
        @if ($rating->product_id == $product->id)
            {{$rating->sum('stars_rated')}}
        @endif
    @endforeach --}}
 </div>


</div>
</div>

@endforeach
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
