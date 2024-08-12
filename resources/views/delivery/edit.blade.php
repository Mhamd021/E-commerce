@extends('layout')
@section('content')
<style>
    #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            #myImg:hover {
                opacity: 0.7;
            }

            /* The Modal (background) */
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

            /* Caption of Modal Image (Image Text) - Same Width as the Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }

            /* Add Animation - Zoom in the Modal */
            .modal-content,
            #caption {
                animation-name: zoom;
                animation-duration: 0.6s;
            }

            @keyframes zoom {
                from {
                    transform: scale(0)
                }

                to {
                    transform: scale(1)
                }
            }

            /* The Close Button */
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

        </style>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Delivery Info</h1>
          <p>Edit</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="#">Delivery Form</a></li>
        </ul>
      </div>


      <form action="{{route('delivery.update',$delivery->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <center>

                <img id="myImg" class="app-sidebar__user-avatar" src="http://127.0.0.1:8000/{{ $delivery->image }}" width="300px" alt="{{$delivery->name}}">
                <div id="myModal" class="modalx">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <h4>deliver Photo</h4>
            </center>

            <div class="tile-body">
              <form>
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" name="name" type="text" placeholder="Enter full name" value="{{ $delivery->name }}">
                </div>
                 <div class="form-group">
                  <label class="control-label">City</label>
                  <input class="form-control" name="city" type="text" placeholder="Enter your city" value="{{ $delivery->city }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Choose image</label>
                    <input class="form-control" name="image" type="file" value="{{ $delivery->image }}">
                  </div>
                <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" rows="4" name="description" placeholder="Enter Description" value="{{ $delivery->description }}"></textarea>
                  </div>
                <div class="form-group">
                  <label class="control-label">Delivery Charg</label>
                  <input type="text" name="delivery_charg" class="form-control" placeholder="Charg" value="{{ $delivery->delivery_charg }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control" placeholder="Charg" value="{{ $delivery->start_time }}">
                  </div>
                  <div class="form-group">
                    <label class="control-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" placeholder="Charg" value="{{ $delivery->end_time }}">
                  </div>

              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('delivery.home')}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </div>
        </div>
    <script>
        // Get the modal
        var modalx = document.getElementById("myModal");
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modalx.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modalx.style.display = "none";
        }
    </script>
    @endsection

