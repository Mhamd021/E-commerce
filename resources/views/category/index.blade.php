

@extends('layout')
@section('content')

                        @php

                            $i = 0
                        @endphp
                        <div class="app-title">
                          <div>
                            <h1><i class="fa fa-th-list"></i> category Table</h1>
                            <p>Table to display category</p>
                          </div>
                          <ul class="app-breadcrumb breadcrumb side">
                            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active"><a href="#">category Table</a></li>
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
                                          <th>No</th>
                                          <th>Name</th>
                                        <th>edit</th>
                                        </tr>
                                      </thead>
                                      <tbody>



                                @foreach ($category as $cat)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $cat->name }}</td>
                                <td><a href="{{route('category.edit',$cat->id)}}"><b>edit</b> </a> </td>
                                {{-- <img  src="{{$product->shops->image}}" width="100px"> --}}
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

