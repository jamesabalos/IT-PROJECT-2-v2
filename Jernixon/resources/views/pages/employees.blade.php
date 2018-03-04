@extends('layouts.navbar')
@section('employees_link')
        class="active"
@endsection
@section('right')
<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a class="navbar-brand" href="#"><i class="ti-panel"></i> Employees</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-user"></i>
                            <p class="notification"></p>
                            <p> {{ Auth::user()->name }}</p>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

            <div class="content">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="header">

                                    <div class = "content">

                                        <form class = "form-inline">

                                            <div class="row">

                                                <div class = "col-md-12">

                                                    <input type="text" name="search" placeholder="Search" class = "form-control border-input">

                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                    <div class = "col-md-12">

                                        <a href = "#view" data-toggle="modal">
                                            <button type="button" class="btn btn-success "><i class = "ti-plus"></i> Add Employee</button>
                                        </a>

                                    </div>

                                    <div class="content table-responsive table-full-width">
                                                <ul class="list-group-item-danger">
                                                                <li>Add table for employee, no need for datatables</li>
                                                </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
@endsection
@section('modals')
<div id="view" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">

        <div class = "modal-dialog modal-md">

            <div class = "modal-content">

                <div class = "modal-body">

                    <button class="close" data-dismiss="modal">&times;</button>

                    <h4 class = "text-center">Add employee</h4>

                    <form action = "" method="post" class="ajax">

                        <div class="form-group">
                            
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Name:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="" class="form-control border-input" form="addnewform">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Username:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="" form="addnewform" class="form-control border-input">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Mobile Number:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" form="addnewform" class="form-control border-input">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Email:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" form="addnewform" class="form-control border-input">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Password:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" form="addnewform" class="form-control border-input">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Confirm Password:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" form="addnewform" class="form-control border-input">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="text-center">                                           
                                <div class="col-md-12">                                                    
                                    <input type="submit" form="addnewform" name="Save" value="Save" class="btn btn-success">
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>                             
                            </div>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

         </div>

     </div>
@endsection

@section('js_link')
      <!--   Core JS Files   -->
      <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection
