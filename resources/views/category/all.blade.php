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
            <h1><i class="fa fa-dashboard"></i> Categories</h1>
            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="app-search">
                <input class="app-search__input" type="search" placeholder="Search">
                <button class="app-search__button"><i class="fa fa-search"></i></button>
              </li>
        </ul>
    </div>

    <div class="row">
        @foreach ($category as $category)


        <div class="col-md-3">
            <a href="{{ route('category.show', $category->id) }}">
                <img src="http://127.0.0.1:8000/{{ $category->image }}" class="w-100 h-50">
            </a>
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">{{ $category->name }}</h3>
                </div>

            </div>
        </div>

        @endforeach
    </div>


    <script type="text/javascript">
        $('#demoNotify').click(function() {
            $.notify({
                title: "Update Complete : ",
                message: "Something cool is just updated!",
                icon: 'fa fa-check'
            }, {
                type: "info"
            });
        });
    </script>
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
