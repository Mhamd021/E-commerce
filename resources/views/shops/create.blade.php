@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Shops Management</h1>
          <p>Create Shop</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Shops</li>
          <li class="breadcrumb-item"><a href="#">Create</a></li>
        </ul>
      </div>


<form action="{{route('shop.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Create Shop</h3>
        <div class="tile-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input class="form-control" name="name" type="text" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
              <label class="control-label">Choose image</label>
              <input class="form-control" name="image" type="file" required>
            </div>
            <div class="form-group">
                <label class="control-label">Location</label>
                <input class="form-control" name="location" type="text" placeholder="Enter your location">

              </div>
              <div class="form-group">
                <label class="control-label">Description</label>
                <input class="form-control" name="description" type="text" placeholder="Enter shop description">
              </div>
          </form>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('products')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>
    @endsection
