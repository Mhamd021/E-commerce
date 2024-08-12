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


</script>




@endsection















@extends('layout')
@section('content')
<style>
    .dropbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .dropbtn:hover, .dropbtn:focus {
      background-color: #3e8e41;
    }

    #myInput {
      box-sizing: border-box;
      background-image: url('searchicon.png');
      background-position: 14px 12px;
      background-repeat: no-repeat;
      font-size: 16px;
      padding: 14px 20px 12px 45px;
      border: none;
      border-bottom: 1px solid #ddd;
    }

    #myInput:focus {outline: 3px solid #ddd;}

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f6f6f6;
      min-width: 230px;
      overflow: auto;
      border: 1px solid #ddd;
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}
    </style>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Products Management</h1>
          <p>Add</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item"><a href="#">Add </a></li>
        </ul>
      </div>


<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Add products</h3>
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
                <br>
                 <select class="ui search dropdown" >
                    @foreach ($category as $item)
                    <option name="category">{{$item->name}}</option>
                    @endforeach


                  </select>
                {{-- <input class="form-control" name="category" onclick="myFunction()" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()" required>

                <div class="dropdown">
                 <div id="myDropdown" class="dropdown-content"  >

                    @foreach ($category as $item)
                    <a onclick="myFunction()">{{$item->name}}</a>
                    @endforeach

                 </div>
                </div> --}}
                {{-- <select class="ui search dropdown" >
                    @foreach ($category as $item)
                    <option name="category" value="fast" >{{$item->name}}</option>
                    @endforeach


                  </select> --}}

               </div>
               <div class="form-group">
                <label class="control-label">Quantity</label>
                <input class="form-control" name="qty" type="text"  placeholder="Enter Quantity" required>

              </div>
              <div class="form-group">
                <label class="control-label">Choose image</label>
                <input class="form-control" name="image" type="file" required>
              </div>
          </form>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('products')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
      </div>
    </div>
</div>
    @endsection
    <script>
        function myFunction()
{
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
function selected ()
{
   var e = document.getElementById("myDropdown");
    var text = e.options[e.selected].text;
    document.getElementById('myInput').value = text;
    document.getElementById("myDropdown").classList.toggle("show");
}
// function select()
// {
//     div = document.getElementById("myDropdown");
//     const mapLink = document.querySelector('myInput');
//     mapLink.val = div.textContent;

// }

</script>




















