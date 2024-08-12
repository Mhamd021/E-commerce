@extends('layout')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Welcome</h1>
            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{$category->name}}</a></li>
        </ul>
    </div>


    {{-- @if (session()->has('success'))
      <div class="alert alert-success">
        {{session()->get('success')}}
      @endif

    </div> --}}
    <div class="row">

        @foreach ($products as $product)
            <div class="col-md-3">
                <a href="{{ route('product.show', $product->id) }}">
                <img src="http://127.0.0.1:8000/{{ $product->image }}" class="w-100 h-50">
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
    </div>


@endsection





















