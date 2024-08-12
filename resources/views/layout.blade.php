
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Don.21</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/app2.js') }}"></script>


    <!-- Main CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('admin_panel/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_panel/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_panel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="#Start">Start</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

        @if (Route::has('login'))
    @auth
        <a href="{{ url('/') }}" class="login">Shop now!</a>
    @else
        <a href="{{ route('login') }}" class="login">Login</a>
        <a href="{{ route('register') }}" class="login">Register</a>
    @endauth
    @endif
    <a href="{{route('category.all')}}" class="login">All Categories</a>

      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li><a class="app-nav__item href=" href="{{route('cart.show')}}"><i class="fa fa-shopping-cart fa-lg"></i>
            <span class="badge rounded-pill badge-notification bg-secondary">{{session()->has('cart') ? session()->get('cart')->totalQty : ''}}</span>
        </a>
        @php
            $user = Auth::user()
        @endphp
    </li>
    <form action="{{route('searchproducts')}}" method="POST" >
        @csrf
        <li class="app-search">
          <input class="app-search__input" name="searchproduct" id="search_product" type="search" placeholder="Search">
          <button type="submit" class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
    </form>
        <!--Notification Menu-->
        @if (auth()->check())

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i>

            <span class="badge rounded-pill badge-notification bg-secondary">{{$user->unreadNotifications->count()}}</span>
        </a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">

            <li class="app-notification__title">You have {{$user->unreadNotifications->count()}} new notifications.</li>
            @foreach ($user->unreadNotifications as $notification)
            <div class="app-notification__content">
                @if (auth()->user()->hasRole('shop_owner'))
                <li><a class="app-notification__item" href="{{route('order.shop',$notification->data['id'])}}"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                @endif
                @if (auth()->user()->hasRole('Costumer'))
                <li><a class="app-notification__item" href="{{route('order.User')}}"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                @endif
                @if (auth()->user()->hasRole('delivery_serviceprovider'))
                <li><a class="app-notification__item" href="{{route('delivery.home')}}"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                @endif
                  <div>
                    <p class="app-notification__message">{{$notification->data['data']}}</p>

                  </div></a></li>




            </div>
            @endforeach
            @if (auth()->user()->unreadNotifications)
            <li class="d-flex justify-content-end mx-1 my-2">
                <a href="{{route('mark-as-read')}}" class="btn btn-success btn-sm">Mark All as Read</a>
            </li>
            @endif
          </ul>

        </li>
        @endif
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            @if (auth()->check())
            <li><a class="dropdown-item" href="{{route('profile',$user->id)}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li>   <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-lg"></i>  {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
            </li>
            @endif
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

       <div class="app-sidebar__user">

        @if (auth()->check())
        @if (Auth::user()->image==null)
        <a href="{{route('profile',$user->id)}}">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-user fa-stack-1x fa-inverse"></i>
            </span>
        </a>

        @endif
        @endif
        @if (auth()->check())
        @if (Auth::user()->image!=null)
        <a href="{{route('profile',$user->id)}}">
                <img class="app-sidebar__user-avatar" src="http://127.0.0.1:8000/{{$user->image}}" width="50px" alt="User Image">
        </a>

        @endif
        @endif
        <div>
            @if (auth()->check())
          <p class="app-sidebar__user-name">
            {{ Auth::user()->name }}
        </p>
            @endif
        </div>

      </div>
      <ul class="app-menu">

        <li><a class="app-menu__item active" href="{{route('home')}}"><i class="fa fa-shopping-cart fa-lg"></i><span class="app-menu__label">Shop now</span></a></li>

        @if (auth()->check())
        @if (auth()->user()->hasRole('shop_owner'))
        <li><a class="app-menu__item active" href="{{route('shop.owner')}}"><i class="fa fa-home fa-lg"></i><span class="app-menu__label">Shop owner</span></a></li>
        @endif
        @endif
        @if (auth()->check())
        @if (auth()->user()->hasRole('super_admin'))
        <li><a class="app-menu__item active" href="{{route('admin.home')}}"><i class="fa fa-home fa-lg"></i><span class="app-menu__label">admin home</span></a></li>
        @endif
        @endif
        @if (auth()->check())
        @if (auth()->user()->hasRole('delivery_serviceprovider'))
        <li><a class="app-menu__item active" href="{{route('delivery.home')}}"><i class="fa fa-home fa-lg"></i><span class="app-menu__label">deliver home</span></a></li>
        @endif
        @endif
        @if (auth()->check())
        @if (auth()->user()->hasRole('costumer'))
        <li><a class="app-menu__item active" href="{{route('home')}}"><i class="fa fa-home fa-lg"></i><span class="app-menu__label">Home</span></a></li>
        @endif
        @endif
        @if (auth()->check())
        @if (auth()->user()->hasRole('super_admin'))
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user fa-lg"></i><span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('users.index')}}"><i class="icon fa fa-circle-o"></i>Manage Users</a></li>
          </ul>
        </li>
        @endif
        @endif
        @php
            $user = Auth()->user();

        @endphp

        @if (auth()->check())
        @if (auth()->user()->hasRole('delivery_serviceprovider'))
        @foreach ($user->delivery as $deliver)
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user fa-lg"></i><span class="app-menu__label">Deliver info</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('delivery.edit',$deliver->id)}}"><i class="icon fa fa-circle-o"></i>Edit info</a></li>
            </ul>
          </li>
        @endforeach

        @endif
        @endif
        @if (auth()->check())
        @if (auth()->user()->hasPermission('shops_create'))
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-shopping-cart fa-lg"></i><span class="app-menu__label">Shop</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('shop.create')}}"><i class="icon fa fa-circle-o"></i>Create</a></li>
            <li><a class="treeview-item" href="{{route('shops')}}"><i class="icon fa fa-circle-o"></i>Show</a></li>

          </ul>
        </li>

        @endif
        @endif
        @if (auth()->check())
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa fa-user fa-lg"></i><span class="app-menu__label">Orders</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="{{route('order.User')}}"><i class="icon fa fa-circle-o"></i>Active Orders</a></li>
              <li><a class="treeview-item" href="{{route('order.User')}}"><i class="icon fa fa-circle-o"></i>Finished Orders</a></li>

            </ul>
          </li>
          @endif
      </ul>
      @if (auth()->check())
      @if (auth()->user()->hasRole('shop_owner'))
      <ul class="app-menu">
        @foreach (Auth::user()->shops as $index=>$market)
        <li><a class="app-menu__item " href="{{route('shop.show',$market->id)}}"><img class="app-sidebar__user-avatar" src="http://127.0.0.1:8000/{{$market->image}}" width="50px" height="35px" alt="shop Image"><span class="app-menu__label">{{$market->name}}</span></a></li>
        @endforeach
    </ul>
    @endif
    @endif
    </aside>
    <main class="app-content">
        @yield('content')
    </main>
       <!-- Essential javascripts for application to work-->
       <script src="{{asset('admin_panel/js/jquery-3.7.0.min.js')}}"></script>
       <script src="{{asset('admin_panel/js/popper.min.js')}}"></script>
       <script src="{{asset('admin_panel/js/bootstrap.min.js')}}"></script>
       <script src="{{asset('js/app.js')}}"></script>
       <script src="{{asset('admin_panel/js/plugins/pace.min.js')}}"></script>
       <script type="text/javascript" src="{{asset('admin_panel/js/plugins/jquery.dataTables.min.js')}}"></script>
       <script type="text/javascript" src="{{asset('admin_panel/js/plugins/dataTables.bootstrap.min.js')}}"></script>
       <script type="text/javascript">$('#sampleTable').DataTable();</script>
       <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
      </script>
      <script type="text/javascript" src="{{asset('admin_panel/js/plugins/bootstrap-notify.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('admin_panel/js/plugins/sweetalert.min.js')}}"></script>



      <script src="{{asset('admin_panel/js/main.js')}}"></script>
      <!-- The javascript plugin to display page loading on top-->
      <script src="{{asset('admin_panel/js/plugins/pace.min.js')}}"></script>
      <!-- Page specific javascripts-->

      <!-- Google analytics script-->

      <script type="text/javascript" src="{{asset('admin_panel/js/plugins/chart.js')}}"></script>
      <script type="text/javascript">
        var data = {
            labels: ["January", "February", "March", "April", "May"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86]
                }
            ]
        };
        var pdata = [
            {
                value: 300,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Complete"
            },
            {
                value: 50,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "In-Progress"
            }
        ]

        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
      </script>
      <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }

      </script>
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>

      var availableTags = [];
    $.ajax({

           method: "GET",
           url: "/product_list" ,
           success: function (response)
           {
            // console.log(response);
            startAutoComplete(response);
           }

    });
    function startAutoComplete(availableTags)
    {
        $( "#search_product" ).autocomplete({
        source: availableTags
      });
    }


    </script>
{{-- <script>
   window.Echo.private('messages{{auth()->id()}}').listen('.RealTimeMessage',(e) =>
    {
        alert(`new message ${e.messageContent}`)
        hello
    });


</script> --}}


<script src="{{asset('admin_panel/js/owl.carousel.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
    <script>
    swal("Good job!","{{session('status')}}", "success");
</script>
    @endif
    @if (session('order'))
    <script>
    swal("{{session('order')}}");
</script>
    @endif




  </body>
</html>

















