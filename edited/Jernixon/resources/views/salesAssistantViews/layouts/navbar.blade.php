<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        {{--  <meta name="viewport" content="width=device-width, initial-scale=1">  --}}
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/logo.png')}}">
        {{--  csrf_token  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
            
        {{--  <link rel="stylesheet" href="{{asset('css/app.css')}}">  --}}
        <!-- Animation library for notifications   -->
        {{--  <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>  --}}
        <!--  Paper Dashboard core CSS    -->
        <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet"/>
        <!--  Fonts and icons     -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
         <link href="{{asset('assets/css/fonts.css')}}" rel='stylesheet' type='text/css'>
        {{--  <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">  --}}
        <!-- tab style -->
        {{--  <link href="{{asset('assets/css/tab.css')}}" rel="stylesheet">  --}}
       
        <link rel="stylesheet" href="{{asset('assets/css/bootstrapv3.3.7.css')}}">
        {{--  <link href="{{asset('assets/bootstrap-4/css/bootstrap.min.css')}}" rel="stylesheet">  --}}

        <title>{{config('app.name')}}</title>
        <script src="{{asset('assets/js/jquery.js')}}"></script>
        
        {{--  <script src="{{ asset('js/app.js') }}"></script>  --}}
        
        @yield('headScript')
    </head>
    
    <body>
        {{--  <script>
            $(document).ready(function(){
                $("#addNewItemButton").click(function(){
                    $("#belowAddNewItem").css("display:block");
                    $("#belowAddNewItem").slideDown("slow");

                });
            });
        </script>  --}}

        <div class="wrapper">  
                <div class="sidebar" data-background-color="white" data-active-color="danger">
                    <div class="sidebar-wrapper">
                        <div class="logo">
                            <a href="dashboard.html" class="simple-text">
                                JERNIXON MOTORPARTS AND ACCESSORIES
                            </a>
                        </div>
                        <ul class="nav">
                            
                            <li @yield('dashboard_link')>
                                <a href={{route('admin.dashboard')}}><i class="ti-panel"></i><p>Dashboard</p></a>
                            </li>                        
                            {{--  <li  @yield('items_link') >
                            <a href={{route('admin.items')}}><i class="ti-clipboard"></i><p>Items</p></a>
                            </li>  --}}
                            {{--  <li @yield('employees_link')>
                            <a href={{route('admin.employees')}}><i class="ti-user"></i><p>Employees</p></a>
                            </li>  --}}
                        </ul>
    
                    </div>
    
                </div> 

                <div class="main-panel">
                      
                    @yield('right')
                
                </div> 
         </div>

    @yield('modals')
    @yield('jqueryScript')
    </body>
    
    @yield('js_link')
</html>
