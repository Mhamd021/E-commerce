@extends('layout')
@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

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
<form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
 <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Submit Order</h3>
      <div class="tile-body">

          <div class="form-group">
            {{-- <pre name="location"  id="info"></pre> --}}
            <input hidden class="form-control" name="lat" type="text" id="lat">
            <input hidden  class="form-control" name="lng" type="text" id="lng" >
            <label class=  "control-label">Phone Number</label>
            <input  class="form-control" name="phone" type="text" >

          </div>

          <div class="form-group">
            <label class="control-label">Choose time to Deliver </label><br>
            <input type="time" id="time" name="time_to_deliver">&nbsp;&nbsp;&nbsp;
            <input type="radio" name="time_to_deliver" id="time" value="asap"> Asap
          </div>
          <div class="form-group">
            @foreach ($deliver as $d)
            <label class="control-label">{{$d->name}} </label><br>
            <input type="hidden" name="deliver_id" value="{{$d->id}}">
            @endforeach


          </div>
        </form>
      </div>
      <div class="tile-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('products')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
      </div>
    </div>
  </div>


{{-- map script --}}




<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>

<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript">

</script>
 <script type="text/javascript">
    var map = L.map('map').setView([35.059125, 36.340569], 13);
    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);
L.Control.geocoder().addTo(map);

//     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 30,
// })
var circle = null;
map.on('click',
					function(e){
						var coord = e.latlng.toString().split(',');
						let lat = coord[0].split('(');
						let lng = coord[1].split(')');
						console.log("You clicked the map at latitude: " + lat[1] + " and longitude:" + lng[0]);



                        if (circle !== null)
                        {
                        map.removeLayer(circle);
                        }
                        circle = L.circle(e.latlng).addTo(map);
                        // document.getElementById('info').innerHTML = e.latlng;
                        $('#lat').val(lat[1])
                        $('#lng').val(lng[0])

					});
                    console.log(geoplugin_countryName());
                    console.log(geoplugin_longitude());
                    console.log(geoplugin_latitude());

</script>

<script>
    function geoFindMe() {

const status = document.querySelector('#status');


mapLink.href = '';
mapLink.textContent = '';

function success(position) {
  const latitude  = position.coords.latitude;
  const longitude = position.coords.longitude;

  status.textContent = '';
  mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
  mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
  var circle = L.circle([latitude, longitude],
                        {
                            color: 'blue',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 100
                        }).addTo(map);

}

function error() {
  status.textContent = 'Unable to retrieve your location';
}

if (!navigator.geolocation) {
  status.textContent = 'Geolocation is not supported by your browser';
} else {
  status.textContent = 'Locating…';
  navigator.geolocation.getCurrentPosition(success, error);
}

}

document.querySelector('#find-me').addEventListener('click', geoFindMe);

</script>
 {{-- var marker = L.marker([51.5, -0.09]).addTo(map);
 var circle = L.circle([51.508, -0.11], {
     color: 'red',
     fillColor: '#f03',
     fillOpacity: 0.5,
     radius: 500
 }).addTo(map);
 var polygon = L.polygon([
     [51.509, -0.08],
     [51.503, -0.06],
     [51.51, -0.047]
 ]).addTo(map);
 marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
 circle.bindPopup("I am a circle.");
polygon.bindPopup("I am a polygon.");
 var popup = L.popup()
    .setLatLng([51.513, -0.09])
    .setContent("I am a standalone popup.")
     .openOn(map);

{{-- map script --}}

@endsection
