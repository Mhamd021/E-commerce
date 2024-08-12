@extends('layout')
@section('content')
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>User Edit</h1>
          <p>{{$user->name}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item"><a href="#">Edit</a></li>
          <li class="breadcrumb-item"><a href="#">{{$user->name}}</a></li>

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

<form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Edit User</h3>
        <div class="tile-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label class="control-label">Email</label>
              <input type="email" name="email" disabled class="form-control" value="{{$user->email}}">
            </div>


            <div class="row" style="margin-bottom: 2rem;">
                <div class="col-lg-6">

                        <label>Roles</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roles[]" value="super_admin" {{$user->hasRole('super_admin') ? 'checked' : ''}}> Super Admin
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roles[]" value="delivery_serviceprovider" {{$user->hasRole('delivery_serviceprovider') ? 'checked' : ''}}> Service Provider
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roles[]" value="shop_owner" {{$user->hasRole('shop_owner') ? 'checked' : ''}}> Shop owner
                            </label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="roles[]" value="costumer" {{$user->hasRole('costumer') ? 'checked' : ''}}>Costumer
                                </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                  <h3>Permissions</h3>
                  <div class="bs-component">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link"  data-toggle="tab" href="#users">Users</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shops">Shops</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#products">Products</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                      <div class="tab-pane fade" id="users">
                      <label><input type="checkbox"  name="permissions[]" value="users_create" {{$user->hasPermission('users_create') ? 'checked' : ''}}  >create</label>
                        <label><input type="checkbox" name="permissions[]" value="users_read"  {{$user->hasPermission('users_read') ? 'checked' : ''}}>read </label>
                            <label><input type="checkbox" name="permissions[]" value="users_update" {{$user->hasPermission('users_update') ? 'checked' : ''}}>update </label>
                      <label><input type="checkbox" name="permissions[]" value="users_delete" {{$user->hasPermission('users_delete') ? 'checked' : ''}}>delete</label>

                      </div>
                      <div class="tab-pane fade" id="shops">
                        <label><input type="checkbox" name="permissions[]" value="shops_create" {{$user->hasPermission('shops_create') ? 'checked' : ''}}  >create</label>
                          <label><input type="checkbox" name="permissions[]" value="shops_read"  {{$user->hasPermission('shops_read') ? 'checked' : ''}}>read </label>
                              <label><input type="checkbox" name="permissions[]" value="shops_update" {{$user->hasPermission('shops_update') ? 'checked' : ''}}>update </label>
                        <label><input type="checkbox" name="permissions[]" value="shops_delete" {{$user->hasPermission('shops_delete') ? 'checked' : ''}}>delete</label>
                        </div>
                        <div class="tab-pane fade" id="products">
                            <label><input type="checkbox" name="permissions[]" value="products_create" {{$user->hasPermission('products_create') ? 'checked' : ''}}  >create</label>
                              <label><input type="checkbox" name="permissions[]" value="products_read"  {{$user->hasPermission('products_read') ? 'checked' : ''}}>read </label>
                                  <label><input type="checkbox" name="permissions[]" value="products_update" {{$user->hasPermission('products_update') ? 'checked' : ''}}>update </label>
                            <label><input type="checkbox" name="permissions[]" value="products_delete" {{$user->hasPermission('products_delete') ? 'checked' : ''}}>delete</label>
                            </div>
                    </div>
                  </div>
                </div>
          </form>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('users.index')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>

@endsection












{{-- @extends('layouts.app')
@section('content')


<div class="container">
<div class="row">
    <div class="col-md-12">

        <h1>Edit User {{$user->name}}</h1>
        <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{method_field('PUT')}}

        <div class="form-group">

            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
        </div>

        <div class="form-group">

            <label>Email</label>
            <input type="email" name="email" disabled class="form-control" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label>Roles</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="roles[]" value="super-admin" {{$user->hasRole('super_admin') ? 'checked' : ''}}> Super Admin
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="roles[]" value="service-provider" {{$user->hasRole('delivery_serviceprovider') ? 'checked' : ''}}> Service Provider
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="roles[]" value="shop-owner" {{$user->hasRole('shop_owner') ? 'checked' : ''}}> Shop owner
                </label>
            </div>
        </div>

        <div class="form-froup">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </form>
    </div>
</div>
</div>




@endsection --}}
