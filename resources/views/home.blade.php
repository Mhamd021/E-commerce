@extends('layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('slider/style.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;900&display=swap" rel="stylesheet">



    {{-- @if (session()->has('success'))
      <div class="alert alert-success">
        {{session()->get('success')}}
      @endif

    </div> --}}
    <section class="product">
        <h2 class="product-category">Trending Products</h2>
        <button class="pre-btn"><img src="slider/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="slider/arrow.png" alt=""></button>
        <div class="product-container">
            @foreach ($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ $product->image }}" class="product-thumb" >

                    </a>

                    <button class="card-btn"><a href="{{ route('cart.add', $product->id) }}">add to cart</a></button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">{{ $product->name }}</h2>
                    <p class="product-short-description">{{ $product->detail }}</p>
                    <span class="price">{{ $product->price }}$</span>
                </div>
            </div>
      @endforeach
        </div>
    </section>
<br>
<br>
<div>
    <hr>
</div>
    <section class="product">
        <h2 class="product-category">Trending Categories</h2>
        <button class="pre-btn"><img src="slider/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="slider/arrow.png" alt=""></button>
        <div class="product-container">
            @foreach ($category as $category)
            <div class="product-card">
                <div class="product-image">
                    <a href="{{ route('category.show', $category->id) }}">
                        <img src="{{ $category->image }}" class="product-thumb" >

                    </a>


                </div>
                <div class="product-info">
                    <h2 class="product-brand">{{ $category->name }}</h2>

                </div>
            </div>
      @endforeach
        </div>
    </section>
    {{-- <div class="col-md-3 mb-3"> <h5>Trending Products</h5></div>
    <div class="row">

        @foreach ($products as $product)
            <div class="col-md-3">
                <a href="{{ route('product.show', $product->id) }}">
                <img src="{{ $product->image }}" class="w-100 h-50">
            </a>
                <div class="tile">
                    <div class="tile-title-w-btn">

                            <h3 class="title">{{ $product->name }}</h3>

                        <p><a class="btn btn-primary icon-btn" href="{{ route('cart.add', $product->id) }}"
                                id="demoNotify"><i class="fa fa-plus"> Add</i></a></p>
                    </div>
                    <div class="tile-title-w-btn">
                        <b>{{ $product->price }}S.P</b>
                    </div>

                </div>
            </div>
        @endforeach
    </div> --}}
    <script type="text/javascript">
        $('#demoNotify').click(function() {
            $.notify({
                title: "Update Complete : ",
                message: "Something cool is just updated!",
                icon: 'fa fa-check'
            }, {
                type: "info"
            });
        });
    </script>
   <script>
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
   </script>
   <script src="{{asset('slider/script.js')}}"></script>
@endsection



















{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        </div>
    </div>
    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
@endsection --}}
