@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Delivery Info</h1>
          <p>Add</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="#">Delivery Form</a></li>
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

<form action="{{route('delivery.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Add Delivery Info</h3>
        <div class="tile-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input class="form-control" name="name" type="text" placeholder="Enter full name">
            </div>
             <div class="form-group">
              <label class="control-label">City</label>
              <input class="form-control" name="city" type="text" placeholder="Enter your city">
            </div>
            <div class="form-group">
                <label class="control-label">Choose image</label>
                <input class="form-control" name="image" type="file">
              </div>
            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" rows="4" name="description" placeholder="Enter Description"></textarea>
              </div>
            <div class="form-group">
              <label class="control-label">Delivery Charg</label>
              <input type="text" name="delivery_charg" class="form-control" placeholder="Charg">
            </div>
            <div class="form-group">
                <label class="control-label">Start Time</label>
                <input type="time" name="start_time" class="form-control" placeholder="Charg">
              </div>
              <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="time" name="end_time" class="form-control" placeholder="Charg">
              </div>

          </form>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('delivery.home')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>
    @endsection


















