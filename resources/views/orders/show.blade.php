@extends('layout')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <style>
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
    </style>

    <div id='map' style='width: 1200px; height: 400px;'></div>
    <hr>
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Show order</h3>
            <div class="tile-body">


                <div hidden id="lat">{{ $order->lat }}</div>
                <div hidden id="lng">{{ $order->lng }}</div>

                {{-- <button id="route">route</button> --}}
                <div class="container">

                    <div class="row">
                        <div class="col-md-8">
                          <div class="tile">
                            <div class="tile-body">
                              <div class="table-responsive">
                                <table class="table table-hover table-bordered" >
                                  <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Phone</th>
                                      <th>Image</th>
                                      <th>Product</th>
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Store</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                            @foreach ($cart->items as $product)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$order->phone}}</td>
                            <td><a href="{{route('product.show',$product['id'])}}"><img src="http://127.0.0.1:8000/{{$product['image']}}" width="100px"></a></td>
                            <td>{{$product['name']}}</td>
                            <td>{{$product['price']}} S.P </td>
                            <td>
                            {{$product['qty']}}
                            </td>
                            <td>{{$product['store_name']}}</td>
                                    </tr>
                          @endforeach
                                  </tbody>
                                </table>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <b>Total Price : {{$cart->totalPrice}}</b>

                        </div>
                      </div>

            </div>

        </div>
    </div>


    {{-- map script --}}





    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script type="text/javascript">
    const lat = document.querySelector('div[id=lat]').textContent;
        const lng = document.querySelector('div[id=lng]').textContent;
        var map = L.map('map').setView([lat, lng], 15);
        googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);


       
        var marker = L.marker([lat, lng], {
            color: 'blue'

        }).addTo(map);
        marker.bindPopup("<b>Hello !</b><br>I am here.").openPopup();
        var circle = null;
        map.on('click',
            function(e) {
                var coord = e.latlng.toString().split(',');
                const latdeliver = coord[1].split('(');
                const lngdeliver = coord[1].split(')');

                if (circle !== null) {
                    map.removeLayer(circle);
                }
                circle = L.circle(e.latlng).addTo(map);

        //         L.Routing.control({
        //  waypoints: [
        //     L.latLng(lat, lng),
        //  L.latLng(latdeliver, lngdeliver)

        //              ]
        //     }).addTo(map);

            });
        //     function route()
        //     {

        //         L.Routing.control({
        //  waypoints: [
        //     L.latLng(lat, lng),
        //  L.latLng(latdeliver, lngdeliver)

        //              ]
        //     }).addTo(map);


        //     }
        //     document.querySelector('#route').addEventListener('click', route);
    </script>
@endsection
