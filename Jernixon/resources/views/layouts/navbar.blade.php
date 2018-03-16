<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Jernixon Motorparts and Accessories</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/logo.png')}}">

    {{--  csrf_token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/font.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel='stylesheet' type='text/css'>


    <script src="{{asset('assets/js/jquery.js')}}"></script>

    {{--  <script src="{{ asset('js/app.js') }}"></script>  --}}

    @yield('headScript')

</head>

<body @yield('ng-app')>
    {{--  <script>
        $(document).ready(function(){
            $("#addNewItemButton").click(function(){
                $("#belowAddNewItem").css("display:block");
                $("#belowAddNewItem").slideDown("slow");

            });
        });
        </script>  --}}

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{route('admin.dashboard')}}" class="simple-text">
                    Jernixon Motorparts and Accessories
                </a>
            </div>

             <ul class="nav">
                    @if(Auth::guard('adminGuard')->check())
                    <li @yield('dashboard_link')>
                        
                        <a href={{route('admin.dashboard')}}> <i class="fa fa-fw fa-dashboard"></i><p>Dashboard</p></a>
                    </li>                        
                    <li @yield('sales_link')>
                        <a href={{route('admin.sales')}}><i class="fa fa-dollar"></i></i></i><p>Sales</p></a>
                    </li>                       
                    <li @yield('purchases_link')>
                        <a href={{route('admin.purchases')}}><i class="fa fa-cube"></i><p>Purchases</p></a>
                    </li>                        
                    <li @yield('returns_link')>
                        <a href={{route('admin.returns')}}><i class="fa fa-mail-reply"></i><p>Returns</p></a>
                    </li>                        
                    <li @yield('physicalCount_link')>
                        <a href={{route('admin.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                    </li>                        
                    <li  @yield('reports_link') >
                        <a href={{route('admin.reports')}}><i class="fa fa-line-chart"></i><p>Reports</p></a>
                    </li>
                    <li  @yield('items_link') >
                        <a href={{route('admin.items')}}><i class="	fa fa-bars"></i><p>Items</p></a>
                    </li>
                    <li @yield('employees_link')>
                        <a href={{route('admin.employees')}}><i class="fa fa-users"></i><p>Employees</p></a>
                    </li>

                    {{--  Hello {{Auth::guard('admin')->user()->name}}  --}}
                    @elseif(Auth::guard('web')->check())
                    <li @yield('dashboard_link')>
                        <a href={{route('home')}}><i class="ti-panel"></i><p>Dashboard</p></a>
                    </li> 
                    <li  @yield('items_link') >
                        <a href={{route('salesAssistant.items')}}><i class="ti-clipboard"></i><p>Items</p></a>
                    </li>
                    {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                    @endif
                </ul>

                </div>

            </div> 

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    @yield('linkName')
					

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <b class="caret hidden-lg hidden-md"></b>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                        <li>
                                            @if(Auth::guard('adminGuard')->check())
                                            <a href="{{ route('admin.logout') }}">
                                                {{--  onclick="event.preventDefault();  --}}
                                                {{--  document.getElementById('logout-form').submit();">  --}}
                                                Logout
                                            </a>

                                            {{--  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>  --}}
                                            @elseif(Auth::guard('web')->check())
                                            <a href="{{ route('salesAssistant.logout') }}">
                                                {{--  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">  --}}
                                                Logout
                                            </a>

                                            {{--  <form id="logout-form" action="{{ route('salesAssistant.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>   --}}
                                            @endif
                                        </li>

                                    </ul>
                        </li>
                        <li>
                           <a href="">
                                <p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                        <li>
                                            @if(Auth::guard('adminGuard')->check())
                                            <a href="{{ route('admin.logout') }}">
                                                {{--  onclick="event.preventDefault();  --}}
                                                {{--  document.getElementById('logout-form').submit();">  --}}
                                                Logout
                                            </a>

                                            {{--  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>  --}}
                                            @elseif(Auth::guard('web')->check())
                                            <a href="{{ route('salesAssistant.logout') }}">
                                                {{--  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">  --}}
                                                Logout
                                            </a>

                                            {{--  <form id="logout-form" action="{{ route('salesAssistant.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>   --}}
                                            @endif
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>

        <div class="content" ng-controller="customerPurchase">
             @yield('right')
        </div>


        <!-- <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Email Statistics</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Bounce
                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users Behavior</h4>
                                <p class="category">24 Hours performance</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">2014 Sales</h4>
                                <p class="category">All products including Taxes</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Tasks</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox1" type="checkbox">
                                                        <label for="checkbox1"></label>
                                                    </div>
                                                </td>
                                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox2" type="checkbox" checked>
                                                        <label for="checkbox2"></label>
                                                    </div>
                                                </td>
                                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox3" type="checkbox">
                                                        <label for="checkbox3"></label>
                                                    </div>
                                                </td>
                                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                                </td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox4" type="checkbox" checked>
                                                        <label for="checkbox4"></label>
                                                    </div>
                                                </td>
                                                <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox5" type="checkbox">
                                                        <label for="checkbox5"></label>
                                                    </div>
                                                </td>
                                                <td>Read "Following makes Medium better"</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <input id="checkbox6" type="checkbox" checked>
                                                        <label for="checkbox6"></label>
                                                    </div>
                                                </td>
                                                <td>Unfollow 5 enemies from twitter</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer> -->

    </div>
</div>


@yield('modals')
        @yield('jqueryScript')
    </body>

    @yield('js_link')

</html>
