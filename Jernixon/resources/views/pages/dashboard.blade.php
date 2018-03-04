@extends('layouts.navbar')
@section('dashboard_link')
  class="active"
@endsection
@section('right')
<div class="content">
        <i><p style="color:red;font-size:20px">Items under construction!</p></i>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a class="navbar-brand" href="#"><i class="ti-panel"></i> Dashboard</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-user"></i>
                            <p class="notification"></p>
                            <p>Admin</p>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="notifications.html">Notifications</a></li>
                            <li><a href="changepassword.html">Change Password</a></li>
                            <li><a href="#">Log out</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{--  style="border: 2px solid green"  --}}
    <div class="row">
        <div class="col-md-12" >
            <div class="card" >
                <div class="header">
                        <div class="row" >
                                <div class="panel-heading">
                                        <div class="row">
                                            <div class="col col-xs-5">
                                                 <input type="text" class="form-control border-input" placeholder="Search">
                                            </div>
                                            <div class="col col-xs-7 text-right">
                                                <div class="btn-group" role="group">
                                                    <a href = "#addtocart" data-toggle="modal" class="btn btn-lg btn-primary btn-create"><i class = "fa fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <ul class="list-group-item-danger">
                                    <li>Add datatables for items</li>
                                  </ul>

                                  <table id="dashboardDatatable" class="table table-hover table-condensed" style="width:100%">
                                    <thead> 
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantity in Stock</th>
                                            <th>Wholesale Price</th>
                                            <th>Retail Price</th>
                                            <th>Add to Cart</th>
                                        </tr>
                                    </thead>
                                  </table>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" >
                <div class="card" >
                     <div class="header">
                         <ul class="list-group-item-danger">
                            <li>Add graphs (top items, least items)</li>
                         </ul>
                    </div>
                </div>
        </div>
    </div>
    
</div>



@endsection     