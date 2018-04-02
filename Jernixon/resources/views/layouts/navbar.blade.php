<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Jernixon Motorparts and Accessories</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/logo3.png')}}">

        {{--  csrf_token  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap core CSS     -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
        {{-- <link href="{{asset('css/app.css')}}" rel="stylesheet" /> --}}

        <!-- Animation library for notifications   -->
        <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>

        <!--     Fonts and icons     -->
        <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

        <script src="{{asset('assets/js/jquery.js')}}"></script>
        <script src="{{asset('assets/js/jquery.3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/js/chartist.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>


        {{--  <link href="{{asset('assets/css/font.css')}}" rel='stylesheet' type='text/css'>  --}}
        {{--  <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel='stylesheet' type='text/css'>  --}}
        {{-- <script src="{{ asset('js/app.js') }}"></script>  --}}

        @yield('headScript')
        <script type="text/javascript">
            function getNotifications(){

                $.ajax({

                    method: 'get',
                    //url: 'items/' + document.getElementById("inputItem").value,
                    url:"{{ route('admin.notification') }}",

                    success: function(data){
                        console.log(data)

                        var result = "";
                        for (var i = 0; i < data.length; i++) {
                            result += "<div class='card'>";
                            if(data[i][0] === "reorder"){
                                result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
<p style='font-size: 12px'><b>Item " +data[i][2]+ " is below reorder level.</b></p>\
<p style='font-size: 12px'><b>"+data[i][3]+" item(s) left</b></p>\
<p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
            </div>\
            </div>";
                            }else{
                                result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
<p style='font-size: 12px'><b>Item " +data[i][2]+ " quantity adjusted.</b></p>\
<p style='font-size: 12px'><b>"+data[i][3]+" item(s) deducted by " + data[i][5] +".</b></p>\
<p style='font-size: 12px'><b>Reason: " +data[i][4]+ "</b></p>\
<p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
            </div>\
            </div>";

                            }
                        }
                        document.getElementById("listOfNotif").innerHTML = "";
                        document.getElementById("listOfNotif").innerHTML = result;

                    }
                });
            }
        </script>
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
            <div class="sidebar" data-color="navcolor">
                <div class="sidebar-wrapper">
                    <div class="logo">

                        <a href="{{route('admin.dashboard')}}" class="simple-text"> 
                            <img src="{{asset('assets/img/logo3.png')}}" style="height:150px;width:160px">
                            <!--Jernixon Motorparts and Accessories-->
                        </a>

                    </div>

                    <ul class="nav" id="navs">

                        @if(Auth::guard('adminGuard')->check())
                        <li @yield('dashboard_link')>

                            <a href={{route('admin.dashboard')}}><i class="fa fa-fw fa-dashboard"></i><p>Dashboard</p></a>
                        </li>       

                        <li @yield('sales_link')>
                            <a href={{route('admin.sales')}}><i class="fa fa-dollar"></i><p>Sales</p></a>
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
                        {{-- <li @yield('dashboard_link')>
                        <a href={{route('home')}}><i class="fa fa-dashboard"></i><p>Dashboard</p></a>
                        </li>  --}}
                        <li   @yield('sales_link')>
                            <a href={{route('salesAssistant.sales')}}><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>
                        {{-- <li  @yield('items_link') >
                        <a href={{route('salesAssistant.items')}}><i class="fa fa-bars"></i><p>Items</p></a>
                        </li> --}}
                        <li   @yield('return_link')>
                            <a href={{route('salesAssistant.return')}}><i class="fa fa-mail-reply"></i><p>Return</p></a>
                        </li>

                        <li   @yield('stockAdjustment_link')>
                            <a href={{route('salesAssistant.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                        <li @yield('physicalCount_link')>
                            <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>  
                        {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                        @endif

                    </ul>

                </div>      
            </div> 

            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed navbar1">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            @yield('linkName')
                        </div>

                        <div>
                            <ul class="nav navbar-nav navbar-right ">

                                <!-- <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-bell"></i>
<b class="caret"></b>
</a>

<ul class="dropdown-menu">
<li><a href="#">Notification 1</a></li>
<li><a href="#">Notification 2</a></li>
<li><a href="#">Notification 3</a></li>
<li><a href="#">Notification 4</a></li>
<li><a href="#">Another notification</a></li>
</ul>
</li> -->


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{ Auth::user()->name }}
                                        <b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>

                                            @if(Auth::guard('adminGuard')->check())
                                            <a href="#notification" data-toggle="modal" onclick="getNotifications()">
                                                Notifications
                                            </a>

                                            <a href="#changePassword" data-toggle="modal">
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
                </nav>

                <nav class="navbar navbar-color navbar-fixed hiddenm" role="navigation">         
                    <div class="navbar-header navbar-custom">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span><i class = 'fa fa-bars'></i>
                        </button>

                        <div class="small-title">
                            <img id = "logo" src = "{{asset('assets/img/logo3.png')}}" width = "40" height = "40">
                            <p class="brand title">Jernixon Motorparts and Accessories </p> 
                        </div>

                        <div class="small-logo-container">
                            <ul class="list-inline">                                
                                <li>
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
                                                    <a href="#notification" data-toggle="modal" onclick="getNotifications()">
                                                        Notifications
                                                    </a>
                                                    <a href="#changePassword" data-toggle="modal">
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
                                </li>
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
                                {{-- <li @yield('dashboard_link')>
                                <a href={{route('home')}}><i class="ti-panel"></i>Dashboard</a>
                                </li>  --}}

                                {{-- <li  @yield('items_link') >
                                <a href={{route('salesAssistant.items')}}><i class="ti-clipboard"></i>Items</a>
                                </li>
                                <li @yield('dashboard_link')>
                                    <a href={{route('home')}}><i class="fa fa-dashboard"></i><p>Dashboard</p></a>
                                </li>  --}}
                                <li   @yield('sales_link')>
                                    <a href={{route('salesAssistant.sales')}}><i class="fa fa-dollar"></i><p>Sales</p></a>
                                </li>
                                {{-- <li  @yield('items_link') >
                                <a href={{route('salesAssistant.items')}}><i class="fa fa-bars"></i><p>Items</p></a>
                                </li> --}}
                                <li   @yield('return_link')>
                                    <a href={{route('salesAssistant.return')}}><i class="fa fa-mail-reply"></i><p>Return</p></a>
                                </li>

                                <li   @yield('stockAdjustment_link')>
                                    <a href={{route('salesAssistant.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                                </li>
                                <li @yield('physicalCount_link')>
                                    <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                                </li>  


                                {{--  Hello {{Auth::guard('user')->user()->name}}  --}}
                                @endif
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
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
                                                    {{Form::text('Email','',['class'=>'form-control'])}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">                                
                                            <div class="row">
                                                <div class="col-md-3">
                                                    {{Form::label('Current Password:')}}
                                                </div>
                                                <div class="col-md-9">
                                                    {{ Form::text('Current Password','',['class'=>'form-control']) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">    
                                            <div class="row">
                                                <div class="col-md-3">
                                                    {{Form::label('New Password', 'New Password:')}}
                                                </div>
                                                <div class="col-md-9">
                                                    {{Form::text('New Password','',['class'=>'form-control'])}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">    
                                            <div class="row">
                                                <div class="col-md-3">
                                                    {{Form::label('Confirm Password', 'Confirm Password:')}}
                                                </div>
                                                <div class="col-md-9">
                                                    {{Form::text('Confirm Password','',['class'=>'form-control'])}}
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
                <div id="notification" class="modal1 fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
                    <div class = "modal1-dialog">
                        <div class = "modal1-content">

                            {!! Form::open(['method'=>'get','id'=>'formNotification']) !!}
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">

                            <!--div class="modal-header">
<button class="close" data-dismiss="modal">&times;</button>
<h3 class="modal-title">Notifications</h3>
</div-->

                            <div class = "modal1-body">  

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>
                                            <span class="glyphicon glyphicon-th"></span>
                                            List of Notifications
                                        </strong>
                                    </div>
                                    <div class="panel-body" style="overflow-y: scroll; max-height:60%;">
                                        <div class="autocomplete" style="width:100%;">
                                            <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" name="item" class="form-control border-input" placeholder="Search">
                                            <div id="searchResultDiv" class="searchResultDiv">
                                            </div>
                                        </div>
                                        <div id="listOfNotif">

                                        </div>
                                        <!--<div class="panel-body">
<div class="autocomplete" style="width:200px;">
<input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Search">
<div id="searchResultDiv" class="searchResultDiv">
</div>
</div>

<div class="content table-responsive">
<table class="table table-bordered table-striped" >
<thead>
<tr>
<th class="text-left">Item Name</th>
<th class="text-left">Date</th>
<th class="text-left">Status</th>
</tr>
</thead>
<tbody id="purchasetable">
</tbody>
</table> 
</div>
</div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right">                                           
                                        <div class="col-md-12">   
                                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('jqueryScript')
            </body>

        @yield('js_link')

        </html>