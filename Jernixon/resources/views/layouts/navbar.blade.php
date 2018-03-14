<!doctype html>
<html lang="{{ app()->getLocale() }}"  >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        {{--  <meta name="viewport" content="width=device-width, initial-scale=1">  --}}
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/logo.png')}}">
        {{--  csrf_token  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--  <link rel="stylesheet" href="{{asset('css/app.css')}}">  -->
        <!-- Animation library for notifications   -->
        {{--  <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>  --}}
        <!--  Paper Dashboard core CSS    -->
        <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet"/>
        <link href="{{asset('assets/css/hover.css')}}" rel="stylesheet"/>
        <!--  Fonts and icons     -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        {{--  <link href="{{asset('assets/css/fonts.css')}}" rel='stylesheet' type='text/css'>  --}}
        {{--  <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">  --}}
        <!-- tab style -->
        {{--  <link href="{{asset('assets/css/tab.css')}}" rel="stylesheet">  --}}


        {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrapv3.3.7.css')}}"> --}}
        {{--  <link href="{{asset('assets/bootstrap-4/css/bootstrap.min.css')}}" rel="stylesheet">  --}}

        <title>{{config('app.name')}}</title>
        <script src="{{asset('assets/js/jquery.js')}}"></script>

        {{--  <script src="{{ asset('js/app.js') }}"></script>  --}}

        @yield('headScript')
    </head>

    <body @yield('onload') @yield('ng-app')>
        {{--  <script>
        $(document).ready(function(){
            $("#addNewItemButton").click(function(){
                $("#belowAddNewItem").css("display:block");
                $("#belowAddNewItem").slideDown("slow");

            });
        });
        </script>  --}}

        <div class="wrapper">  
            <div class="sidebar" data-background-color="#2E4057" data-active-color="danger">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="dashboard.html" class="simple-text">
                            JERNIXON MOTORPARTS AND ACCESSORIES
                        </a>
                    </div>
                    <ul class="nav">
                        @if(Auth::guard('adminGuard')->check())
                        <li @yield('dashboard_link')>
                            <a href={{route('admin.dashboard')}}><i class="ti-panel"></i><p>Dashboard</p></a>
                        </li>
                        <li @yield('employees_link')>
                            <a href={{route('admin.employees')}}><i class="ti-user"></i><p>Employees</p></a>
                        </li>
                        <li  @yield('items_link') >
                            <a href={{route('admin.items')}}><i class="ti-clipboard"></i><p>Items</p></a>
                        </li>
                        <li @yield('physicalCount_link')>
                            <a href={{route('admin.physicalCount')}}><i class="ti-panel"></i><p>Physical count</p></a>
                        </li>
                        <li @yield('purchases_link')>
                            <a href={{route('admin.purchases')}}><i class="ti-panel"></i><p>Purchases</p></a>
                        </li>
                        <li  @yield('reports_link') >
                            <a href={{route('admin.reports')}}><i class="ti-clipboard"></i><p>Reports</p></a>
                        </li>
                        <li @yield('returns_link')>
                            <a href={{route('admin.returns')}}><i class="ti-panel"></i><p>Returns</p></a>
                        </li>                        

                        <li @yield('sales_link')>
                            <a href={{route('admin.sales')}}><i class="ti-panel"></i><p>Sales</p></a>
                        </li>                       
                        <li @yield('stockAdjustment_link')>
                            <a href={{route('admin.stockAdjustment')}}><i class="ti-user"></i><p>Stock Adjustment</p></a>
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

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">                           
                            {{--  <a class="navbar-brand" href="#"><i class="ti-panel"></i> Dashboard</a>  --}}
                            @yield('linkName')
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <i class="ti-user"></i>
                                        <p class="notification"></p>
                                        <p> {{ Auth::user()->name }}</p>
                                        <span class="caret"></span>
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

            </div> 
        </div>

        @yield('modals')
        @yield('jqueryScript')
    </body>

    @yield('js_link')
</html>
