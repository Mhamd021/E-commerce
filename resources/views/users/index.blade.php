
@extends('layout')
@section('content')
                        @php

                            $i = 0
                        @endphp
                        <div class="app-title">
                          <div>
                            <h1><i class="fa fa-th-list"></i> Data Table</h1>
                            <p>Table to display analytical data effectively</p>
                          </div>
                          <ul class="app-breadcrumb breadcrumb side">
                            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
                          </ul>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile">
                              <div class="tile-body">
                                <div class="table-responsive">
                                  <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                      <tr>
                                          <th>index</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Roles</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                              @foreach ($users as $user)
                          <tr>
                              <td>{{ ++$i}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>
                                  @foreach ($user->roles as $index=>$role )
                                  {{$role->display_name}} {{$index+1 < $user->roles->count() ? ',' : ''}}
                                  @endforeach
                              </td>
                              <td>
                                  <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
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
                        @endsection



