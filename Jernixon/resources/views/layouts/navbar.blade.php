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
    var notifications = "";
    //     function getNotifications(){
    //         $.ajax({
    //             method: 'get',
    //             //url: 'items/' + document.getElementById("inputItem").value,
    //             url:"{{ route('admin.notification') }}",
                
    //             success: function(data){
    //                 console.log(data)
    //                 var result = "";
    //                 for (var i = 0; i < data.length; i++) {
    //                     result += "<div class='card'>";
    //                         if(data[i][0] === "reorder"){
    //                             result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
    //                                 <p style='font-size: 12px'><b>Item " +data[i][2]+ " is below reorder level.</b></p>\
    //                                 <p style='font-size: 12px'><b>"+data[i][3]+" item(s) left</b></p>\
    //                                 <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
    //                             </div>\
    //                         </div>";
    //                     }else{
    //                         result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
    //                             <p style='font-size: 12px'><b>Item " +data[i][2]+ " quantity adjusted.</b></p>\
    //                             <p style='font-size: 12px'><b>"+data[i][3]+" item(s) deducted by " + data[i][5] +".</b></p>\
    //                             <p style='font-size: 12px'><b>Reason: " +data[i][4]+ "</b></p>\
    //                             <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
    //                         </div>\
    //                     </div>";
                        
    //                 }
    //             }
    //             document.getElementById("listOfNotif").innerHTML = "";
    //             document.getElementById("listOfNotif").innerHTML = result;
    //             $("a[class='badge1']").attr("data-badge", data.length);

    //         }
    //     });
    // }
    // function removeNotification(divId){   
    //     console.log(divId)                       
    //     $('#'+divId).slideDown("slow")
    //         .delay(500)                        
    //         .hide(1500);
    // }
    function hideNumberOfNotif(link){
        link.removeAttribute("data-badge");
    }
    // function markAsRead(e){

    //     $.ajax({
    //         method: 'get',
    //         url:"{{ route('admin.notification.markAsRead') }}",
    //         data: {
    //             "notifications":window.notifications
    //         },

    //         success: function(data){
    //             console.log(data)
    //         }
    //     });
    // }
    function logoutRemoveCart(){
        localStorage.clear();
    }
    $(document).ready(function(){
        // $('button.myClass').click(function() {
        //     alert( "Handler" );
        // });
        // console.log( '<?php echo str_contains(request()->path(),'admin') ?>' )
        // $.ajax({
        //         method: 'get',
        //         //url: 'items/' + document.getElementById("inputItem").value,
        //         url: ( '<?php echo str_contains(request()->path(),'admin') ?>' === 1) ? "{{ route('admin.notification') }}" : "{{ route('salesAssistant.notification') }}",
                
        //         success: function(data){
        //             notifications = data;
        //             console.log(data)
        //             var result = "";
        //             for (var i = 0; i < data.length; i++) {
        //                 result += "<div class='card' id='notification" +i+ "'>";
        //                 if(data[i][0] === "reorder"){
        //                         result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
        //                                             <p style='font-size: 12px'><b>Item " +data[i][2]+ " is below reorder level.</b></p>\
        //                                             <p style='font-size: 12px'><b>"+data[i][3]+" item(s) left</b></p>\
        //                                             <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
        //                                         </div>\
        //                                     </div>";
        //                                     // <button data-notificationid='notification" +i+ "' onclick='removeNotification(this.dataset.notificationid)' type='button' class='btn btn-info'>Close</button>\
        //                 }else{
        //                     result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
        //                                     <p style='font-size: 12px'><b>Item " +data[i][2]+ " quantity adjusted.</b></p>\
        //                                     <p style='font-size: 12px'><b>"+data[i][3]+" item(s) deducted by " + data[i][5] +".</b></p>\
        //                                     <p style='font-size: 12px'><b>Reason: " +data[i][4]+ "</b></p>\
        //                                     <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b><u style='font-size: 12px; float: right' onclick='markAsRead(this)'><b>Mark As Read</b></u></p>\
        //                                 </div>\
        //                             </div>";
        //                                 // <button data-notificationid='notification" +i+ "' onclick='removeNotification(this.dataset.notificationid)' type='button' class='btn btn-info'>Close</button>\
        //                 }
        //         }
        //         document.getElementById("listOfNotif").innerHTML = "";
        //         document.getElementById("listOfNotif").innerHTML = result;
        //         $("a[class='badge1']").attr("data-badge", data.length);

        //     },
        //     error: function(data){
        //         console.log(data)
        //     }
        // });



        $('#formChangePassword').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            
            $.ajax({
                type:'POST',
                
                @if(str_contains(request()->path(),'admin') == 1)
                url: "{{route('admin.changePassword')}}",
                @elseif(str_contains(request()->path(),'salesAssistant') == 1)
                url: "{{route('salesAssistant.changePassword')}}",
                @endif
                data: data,
                
                success:function(data){
                    console.log(data)
                    $('#changePassword').modal('hide');
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                    // .addClass("alert-success")
                    .html("<h3>Change password successful</h3>");
                    $("#successDiv").css("display:block");                             
                    $("#successDiv").slideDown("slow")
                    .delay(1000)                        
                    .hide(1500);
                    
                },
                error: function(data){
                    var response = data.responseJSON;
                    $("#errorDivChangePassword").hide(500);
                    $("#errorDivChangePassword").removeClass("hidden");
                    $("#errorDivChangePassword").slideDown("slow", function() {
                    $("#errorDivChangePassword").html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });
                    });
                }
            })
        })
    })
</script>
<style>
    .badge1[data-badge]:after {
    content:attr(data-badge);
    position: absolute;
    background: green;
    height:2rem;
    top:-.1rem;
    right:-.1rem;
    width:2rem;
    text-align: center;
    line-height: 2rem;;
    font-size: 1rem;
    border-radius: 50%;
    color:white;
    border:1px solid white;
    }
	u:hover{
		cursor:pointer;
	}
</style>
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
                    
                    {{-- @if(Auth::guard('adminGuard')->check() == 1 && Auth::guard('web')->check() == 0) --}}
                    @if(str_contains(request()->path(),'admin') == 1)
                        <li  @yield('dashboard_link')>
                            
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
                            <a href={{route('admin.employees')}}><i class="fa fa-users"></i><p>Users</p></a>
                        </li>
                        
                        <li @yield('stockAdjustment_link')>
                            <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                    
                        @endif
                        
                        <!-- Sales Assistant -->
                    {{-- @if(Auth::guard('web')->check() == 1 && Auth::guard('adminGuard')->check() == 0) --}}
                    @if(str_contains(request()->path(),'salesAssistant') == 1)
                        @if($physicalCount[0]["status"] === "inactive" )
                        <li @yield('sales_link')>
                            <a href={{route('salesAssistant.sales')}}><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>
                        
                        <li @yield('return_link')>
                            <a href={{route('salesAssistant.return')}}><i class="fa fa-mail-reply"></i><p>Returns</p></a>
                        </li>
                        
                        <li @yield('stockAdjustment_link')>
                            <a href={{route('salesAssistant.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                        {{-- <li @yield('physicalCount_link')>
                            <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li> --}}
                        @else
                        <li @yield('physicalCount_link')>
                            <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>
                        @endif
                    
                    @endif
                    
                </ul>
                
            </div>      
        </div> 
        
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed navbar1">
                <div class="container-fluid">
                    <div class="navbar-header">
                        @yield('linkName')
                        <div class="alert alert-success hidden" id="successDiv">
                            
                        </div>
                    </div>
                    
                    <div>
                        <ul class="nav navbar-nav navbar-right ">
                            <li class="dropdown">
                                <a class="badge1" href="#notification" data-toggle="modal" data-toggle="dropdown" > <i class="fa fa-bell"></i>
                                @if(auth()->user()->unreadnotifications->count())
                                    <span class="badge badge-danger">{{auth()->user()->unreadnotifications->count()}}</span>
                                @endif
                                </a>
                            </li>
                            <li class="dropdown">
                                <a data-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @if(str_contains(request()->path(),'admin') == 1)
                                        
                                        <a href="#changePassword" data-toggle="modal">
                                            Change Password
                                        </a>
                                        
                                        <a href="{{ route('admin.logout') }}" onclick="logoutRemoveCart()">
                                            {{--  onclick="event.preventDefault();  --}}
                                            {{--  document.getElementById('logout-form').submit();">  --}}
                                            Logout
                                        </a>
                                        
                                        {{--  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>  --}}
                                        
                                        @elseif(str_contains(request()->path(),'salesAssistant') == 1)
                                        <a href="#changePassword" data-toggle="modal">
                                            Change Password
                                        </a>
                                        <a href="{{ route('salesAssistant.logout') }}" onclick="logoutRemoveCart()">
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
                        <ul class="list-group">                                
                            <li>
                                <ul class="user-margin list-inline" style="padding-left:15px; ">

                                    <li class="list-inline-item dropdown">
                                         <a class="badge1" href="#notification" data-toggle="modal" data-toggle="dropdown" > <i class="fa fa-bell"></i>
                                        @if(auth()->user()->unreadnotifications->count())
                                            <span class="badge badge-danger">{{auth()->user()->unreadnotifications->count()}}</span>
                                        @endif
                                        </a>
    
                                    </li>

                                    <li class="list-inline-item dropdown" style="text-shadow: none;text-decoration: none;">
                                        
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <p>
                                                {{ Auth::user()->name }}
                                                <b class="caret"></b>
                                            </p>
                                            
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                @if(str_contains(request()->path(),'admin') == 1)
                                                <a href="#changePassword" data-toggle="modal">
                                                    Change Password
                                                </a>
                                                <a href="{{ route('admin.logout') }}" onclick="logoutRemoveCart()">
                                                    {{--  onclick="event.preventDefault();  --}}
                                                    {{--  document.getElementById('logout-form').submit();">  --}}
                                                    Logout
                                                </a>
                                                
                                                {{--  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>  --}}
                                                @elseif(str_contains(request()->path(),'salesAssistant') == 1)
                                                <a href="{{ route('salesAssistant.logout') }}" onclick="logoutRemoveCart()">
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
                        </ul>
                    </div>
                </div>
                <div class="navbar-collapse collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        @if(str_contains(request()->path(),'admin') == 1)
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
                            <a href={{route('admin.employees')}}><i class="fa fa-users"></i>Account Management</a>
                        </li>
                        
                        <li @yield('stockAdjustment_link')>
                            <a href={{route('admin.stockAdjustment')}}><i class="fa fa-adjust"></i>Stock Adjustment</a>
                        </li>
                        
                        {{--  Hello {{Auth::guard('admin')->user()->name}}  --}}
                        
                        @elseif(str_contains(request()->path(),'salesAssistant') == 1)
                        @if($physicalCount[0]["status"] === "inactive" )
                        <li   @yield('sales_link')>
                            <a href={{route('salesAssistant.sales')}}><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>
                        <li   @yield('return_link')>
                            <a href={{route('salesAssistant.return')}}><i class="fa fa-mail-reply"></i><p>Return</p></a>
                        </li>
                        
                        <li   @yield('stockAdjustment_link')>
                            <a href={{route('salesAssistant.stockAdjustment')}}><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                        {{-- <li @yield('physicalCount_link')>
                            <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>  --}}
                        @else
                        <li @yield('physicalCount_link')>
                            <a href={{route('salesAssistant.physicalCount')}}><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>
                        @endif 
                        
                        
                        
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
                    
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><i class="fa fa-wrench" style="margin-right: 15px;"></i>Change Password</h3>
                    </div>
                    
                    <div class = "modal-body">  
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-th"></span>
                                    Update Password
                                </strong>
                            </div>
                            
                            <div id="errorDivChangePassword" class="hidden alert-danger text-center">
                            </div>
                {!! Form::open(['method'=>'post','id'=>'formChangePassword']) !!}
                            <div class="panel-body">
                                <input type="hidden" value="{{ csrf_token() }}">
                                <input type="hidden" name="authName" value=" {{ Auth::user()->name }}">
                                <input type="hidden" name="adminId" value=" {{ Auth::user()->id }}">
                                
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
                                            {{ Form::password('Current_Password',array('class'=>'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('New Password', 'New Password:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{Form::password('New_Password',array('class'=>'form-control'))}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Confirm Password', 'Confirm Password:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{Form::password('Confirm_Password',array('class'=>'form-control'))}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="text-right">                                           
                                <div class="col-md-12">   
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div id="notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
            <div class = "modal-dialog modal-md">
                <div class = "modal-content">
                    
                    
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><i class="fa fa-bell" style="margin-right: 10px;"></i> Notifications</h3>
                    </div>
                    
                    <div class = "modal-body">  
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-list"></span>
                                    List of Notifications
                                </strong>
                            </div>
                            
                            <div class="panel-body">
                                <div class="autocomplete" style="width:200px;">
                                    {{-- <input autocomplete="off" type="text" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Search"> --}}
                                    <div id="searchResultDiv" class="searchResultDiv">
                                    </div>
                                    
                                </div>
                                <div id="listOfNotif">
                                    <ul class="list-group">
                                        @foreach (Auth::user()->unreadNotifications->take(10) as $notification)
                                            @include('notifications.'.snake_case(class_basename($notification->type)))
                                            
                                        @endforeach
                                    </ul>
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