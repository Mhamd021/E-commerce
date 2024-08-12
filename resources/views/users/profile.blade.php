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
          <h1><i class="fa fa-user"></i>Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item"><a href="#">Profile</a></li>
          <li class="breadcrumb-item"><a href="#">{{$user->name}}</a></li>
        </ul>
      </div>


<form action="{{ route('UpdateProfile',$user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-md-12">
        @if ($user->image==null)
        <center>
            <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-user fa-stack-1x fa-inverse"></i>
            </span>
            <h4>Profile Photo</h4>
        </center>

        @endif
        @if ($user->image!=null)
        <center>
            <img id="myImg" class="app-sidebar__user-avatar" src="http://127.0.0.1:8000/{{$user->image}}" width="300px" alt="{{$user->name}}">
            <div id="myModal" class="modalx">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
            <h4>Profile Photo</h4>
            <a class="btn btn-secondary" href="{{route('Delete.Profile.Image',$user->id)}}" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Remove Photo</a>
        </center>
        @endif

        <div class="tile-body">
            <form>
              <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" name="name" type="text" placeholder="Enter full name" value="{{ $user->name }}">
              </div>
              <div class="form-group">
                <label class="control-label"> Profile image</label>
                <input class="form-control" name="image" type="file" >

              </div>
            </form>
          </div>
          <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{route('profile',$user->id)}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
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





{{-- @extends('layout')
@section('content')
<div class="row user">
    <div class="col-md-12">
      <div class="profile">
        <div class="info"><img class="user-img" src="{{asset('Welcome/assets/img/team/3.jpg')}}">
          <h4>John Doe</h4>
          <p>FrontEnd Developer</p>
        </div>
        <div class="cover-image"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Timeline</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Settings</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="user-timeline">
          <div class="timeline-post">
            <div class="post-media"><a href="#"><img src="{{asset('Welcome/assets/img/team/3.jpg')}}"></a>
              <div class="content">
                <h5><a href="#">John Doe</a></h5>
                <p class="text-muted"><small>2 January at 9:30</small></p>
              </div>
            </div>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <ul class="post-utility">
              <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
              <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
              <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
            </ul>
          </div>
          <div class="timeline-post">
            <div class="post-media"><a href="#"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></a>
              <div class="content">
                <h5><a href="#">John Doe</a></h5>
                <p class="text-muted"><small>2 January at 9:30</small></p>
              </div>
            </div>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <ul class="post-utility">
              <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
              <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
              <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
            </ul>
          </div>
        </div>
        <div class="tab-pane fade" id="user-settings">
          <div class="tile user-settings">
            <h4 class="line-head">Settings</h4>
            <form>
              <div class="row mb-4">
                <div class="col-md-4">
                  <label>First Name</label>
                  <input class="form-control" type="text">
                </div>
                <div class="col-md-4">
                  <label>Last Name</label>
                  <input class="form-control" type="text">
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 mb-4">
                  <label>Email</label>
                  <input class="form-control" type="text">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-8 mb-4">
                  <label>Mobile No</label>
                  <input class="form-control" type="text">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-8 mb-4">
                  <label>Office Phone</label>
                  <input class="form-control" type="text">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-8 mb-4">
                  <label>Home Phone</label>
                  <input class="form-control" type="text">
                </div>
              </div>
              <div class="row mb-10">
                <div class="col-md-12">
                  <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection --}}
