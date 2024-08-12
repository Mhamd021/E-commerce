@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Product Management</h1>
          <p>Create Product</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item"><a href="#">Create</a></li>
        </ul>
      </div>


<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Create Product</h3>
        <div class="tile-body">
          <form>
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control  " name="name" type="text"  placeholder="Enter full name" required>

              </div>
              <div class="form-group">
                <label class="control-label">Price</label>
                <input type="text" name="price" class="form-control" placeholder="Price" required>
              </div>

              <div class="form-group">
                <label class="control-label">Detail</label>
                <textarea class="form-control" rows="4" name="detail" placeholder="Enter Description" required></textarea>
              </div>

              <input type="hidden" name="store_id" value={{request()->route('id')}}>

              <div class="form-group">
                <label class="control-label">Category</label>
                <Select name="category" class="form-control">
                    @foreach ($category as $cat)
                    <option>{{$cat->name}}</option>
                    @endforeach

                </Select>
              </div>
              <div class="form-group">
                <label class="control-label">Popular</label>
                <input  name="trending"   type="checkbox">

              </div>
              <div class="form-group">
                <label class="control-label">Choose image</label>
                <input class="form-control" name="image" type="file" required>
              </div>
              <div class="form-group">
                <label class="control-label">Quantity</label>
                <input class="form-control" name="qty" type="number"  placeholder="Enter Quantity" required>

              </div>

          </form>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('shop.show',request()->route('id'))}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>
    @endsection
