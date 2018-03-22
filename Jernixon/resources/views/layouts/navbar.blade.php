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
        {{--  <link href="{{asset('assets/css/font.css')}}" rel='stylesheet' type='text/css'>  --}}
        {{--  <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel='stylesheet' type='text/css'>  --}}

        <script src="{{asset('assets/js/jquery.js')}}"></script>

        <!-- <script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script> -->

        <script src="{{asset('assets/js/jquery.3.2.1.min.js')}}"></script>

        <script src="{{asset('assets/js/chartist.min.js')}}"></script>

        <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>


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

<<<<<<< HEAD
        <div class="wrapper">
            <div class="sidebar" data-color="navcolor">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="{{route('admin.dashboard')}}" class="simple-text"> 
                            <img src="{{asset('assets/img/logo2.png')}}">
                            <!--                    Jernixon Motorparts and Accessories-->
                        </a>
                    </div>

                    <ul class="nav" id="navs">

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
                <a href={{route('admin.items')}}><i class=" fa fa-bars"></i><p>Items</p></a>
            </li>
            <li @yield('employees_link')>
                <a href={{route('admin.employees')}}><i class="fa fa-users"></i><p>Employees</p></a>
            </li>
            <li @yield('stockAdjustment_link')>
                <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
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
=======
<div class="wrapper">

    <div class="sidebar" data-color="navcolor">

        <div class="sidebar-wrapper">

            <div class="logo">

                <a href="{{route('admin.dashboard')}}" class="simple-text"> 
                    <img src="{{asset('assets/img/logo2.png')}}">
<!--                    Jernixon Motorparts and Accessories-->
                </a>

            </div>

             <ul class="nav" id="navs">

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
                        <a href={{route('admin.items')}}><i class=" fa fa-bars"></i><p>Items</p></a>
                    </li>

                    <li @yield('employees_link')>
                        <a href={{route('admin.employees')}}><i class="fa fa-users"></i><p>Employees</p></a>
                    </li>

                    <li @yield('stockAdjustment_link')>
                        <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                    </li>

                    <!-- Sales Assistant -->

                    {{--  Hello {{Auth::guard('admin')->user()->name}}  --}}
                    @elseif(Auth::guard('web')->check())
                    <li @yield('dashboard_link')>
                        <a href={{route('home')}}><i class="fa fa-dashboard"></i><p>Dashboard</p></a>
                    </li> 

                    <li  @yield('items_link') >
                        <a href={{route('salesAssistant.items')}}><i class="fa fa-bars"></i><p>Items</p></a>
                    </li>
                    {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                    @endif

                </ul>

                </div>
>>>>>>> 1852cab3af378d2cb67ef3dbbabea2a96149a3d2

    </div> 

<<<<<<< HEAD
<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed navbar1">
        <div class="container-fluid">
            <div class="navbar-header">
                @yield('linkName')
            </div>
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
                            <a href="{{ route('admin.changePassword') }}">
                                Change Password
                            </a>
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
=======
     <div class="main-panel">

         <nav class="navbar navbar-default navbar-fixed navbar1">

            <div class="container-fluid">

                <div class="navbar-header">

                    @yield('linkName')

                </div>

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

            </nav>

        <nav class="navbar navbar-color navbar-fixed hiddenm" role="navigation">         
            <div class="navbar-header navbar-custom">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

              </button>

              <div class="small-logo-container">

                <img id = "logo" src = "{{asset('assets/img/logo.png')}}" width = "50" height = "50">

                <a class="navbar-brand">Jernixon Motorparts and Accessories </a>

                    <ul class="nav navbar-right user-margin">

                        <li class="dropdown">

                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <!-- <p> -->
                                {{ Auth::user()->name }}
                                <b class="caret"></b>
                            <!-- </p> -->

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

            <div class="navbar-collapse collapse">
              
              <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('adminGuard')->check())
                <li @yield('dashboard_link')>
                    
                    <a href={{route('admin.dashboard')}}> <i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
                </li>      

                <li @yield('sales_link')>
                    <a href={{route('admin.sales')}}><i class="fa fa-dollar"></i>Sales</a>
                </li>  

                <li @yield('purchases_link')>
                    <a href={{route('admin.purchases')}}><i class="fa fa-cube"></i>Purchases</a>
                </li>

                <li @yield('returns_link')>
                    <a href={{route('admin.returns')}}><i class="fa fa-mail-reply"></i>Returns</a>
                </li>   

                <li @yield('physicalCount_link')>
                    <a href={{route('admin.physicalCount')}}><i class="fa fa-check-square-o"></i>Physical count</a>
                </li> 

                <li  @yield('reports_link') >
                    <a href={{route('admin.reports')}}><i class="fa fa-line-chart"></i>Reports</a>
                </li>

                <li  @yield('items_link') >
                    <a href={{route('admin.items')}}><i class=" fa fa-bars"></i>Items</a>
                </li>

                <li @yield('employees_link')>
                    <a href={{route('admin.employees')}}><i class="fa fa-users"></i>Employees</a>
                </li>

                <li @yield('stockAdjustment_link')>
                    <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i>Stock Adjustment</a>
                </li>

                {{--  Hello {{Auth::guard('admin')->user()->name}}  --}}
                @elseif(Auth::guard('web')->check())
                <li @yield('dashboard_link')>
                    <a href={{route('home')}}><i class="ti-panel"></i>Dashboard</a>
                </li> 

                <li  @yield('items_link') >
                    <a href={{route('salesAssistant.items')}}><i class="ti-clipboard"></i>Items</a>
                </li>
                {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                @endif
              </ul>

            </div><!--/.nav-collapse -->

         </nav>
>>>>>>> 1852cab3af378d2cb67ef3dbbabea2a96149a3d2

        </div>
    </nav>

    <nav class="navbar navbar-color navbar-fixed hiddenm" role="navigation">         


        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="small-logo-container">
                <h3>Jernixon Motorcycle Shop</h3>
                <ul class="nav navbar-right user-margin">
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
                                <a href="{{ route('admin.changePassword') }}">
                                    Change Password
                                </a>
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
        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('adminGuard')->check())
                <li @yield('dashboard_link')>

                    <a href={{route('admin.dashboard')}}> <i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
                </li>                        
                <li @yield('sales_link')>
                    <a href={{route('admin.sales')}}><i class="fa fa-dollar"></i>Sales</a>
                </li>                       
                <li @yield('purchases_link')>
                    <a href={{route('admin.purchases')}}><i class="fa fa-cube"></i>Purchases</a>
                </li>                        
                <li @yield('returns_link')>
                    <a href={{route('admin.returns')}}><i class="fa fa-mail-reply"></i>Returns</a>
                </li>                        
                <li @yield('physicalCount_link')>
                    <a href={{route('admin.physicalCount')}}><i class="fa fa-check-square-o"></i>Physical count</a>
                </li>                        
                <li  @yield('reports_link') >
                    <a href={{route('admin.reports')}}><i class="fa fa-line-chart"></i>Reports</a>
                </li>
                <li  @yield('items_link') >
                    <a href={{route('admin.items')}}><i class=" fa fa-bars"></i>Items</a>
                </li>
                <li @yield('employees_link')>
                    <a href={{route('admin.employees')}}><i class="fa fa-users"></i>Employees</a>
                </li>
                <li @yield('stockAdjustment_link')>
                    <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i>Stock Adjustment</a>
                </li>

                {{--  Hello {{Auth::guard('admin')->user()->name}}  --}}
                @elseif(Auth::guard('web')->check())
                <li @yield('dashboard_link')>
                    <a href={{route('home')}}><i class="ti-panel"></i>Dashboard</a>
                </li> 
                <li  @yield('items_link') >
                    <a href={{route('salesAssistant.items')}}><i class="ti-clipboard"></i>Items</a>
                </li>
                {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                @endif
            </ul>
        </div><!--/.nav-collapse -->

    </nav>

    <div class="content" ng-controller="customerPurchase">
        <div class="linkName">@yield('linkName')</div>
        @yield('right')
    </div>

</div>

@yield('modals')
<div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formchangePassword']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Change Password</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Password
                        </strong>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Email', 'Email:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Email','',['class'=>'form-control','placeholder'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Current Password:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('Current Password','',['class'=>'form-control','placeholder'=>'']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Confirm Password', 'Confirm Password:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Confirm Password','',['class'=>'form-control','placeholder'=>''])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitNewItems" type="submit" onclick="window.alert('to be continue..')" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    @yield('jqueryScript')
    </body>

@yield('js_link')

</html>
