@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Notify Deliver</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Notify</li>
          <li class="breadcrumb-item"><a href="#">Deliver</a></li>
        </ul>
      </div>


<form action="{{ route('product.ready',$p->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">notify deliver</h3>
        <div class="tile-body">
          <form>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>
    @endsection

