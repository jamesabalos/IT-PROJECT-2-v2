@extends('layouts.navbar')
@section('stockAdjustment_link')
class="active"
@endsection

@section('onload')
onload="refresh()"
@endsection

@section('ng-app')
ng-app="ourAngularJsApp"
@endsection


@section('headScript')
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<!--AngularJs-->
<script src="{{asset('assets/js/angular.min.js')}}"></script>

<script>
    function remove(button){
        //var i = a.parentNode.parentNode.rowIndex;
        //document.getElementById("cartTable").deleteRow(i);
        var row = button.parentNode.parentNode; //row
        $(row).hide(500,function(){
            $(row).remove();
        });

        //remove item in local storage
        var data  = $(button.parentNode.parentNode.innerHTML).slice(0,2);
        localStorage.removeItem(data[0].innerHTML);

        //show the plus sign button again
        document.getElementById(button.getAttribute("data-item-id")).removeAttribute("style");
    }

    function addRow(){
        var thatTbody = document.getElementById("adjustmenttable");
        var newRow = thatTbody.insertRow(-1);
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched form-control' type='text' min='1'></td>";
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched form-control' type='number min='1'></td>";
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched form-control' type='number' min='1'></td>";
        newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger form-control' data-item-id=' +button.getAttribute('id')+ ' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>";
    }
</script>

@endsection

@section('linkName')
<h2>Stock Adjustment</h2>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class = "col-md-12">
                        <a href = "#adjustment" data-toggle="modal">
                            <button type="button" class="btn btn-success">Stock Adjustment</button>
                        </a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="dashboardDatatable">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Item Name</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')
<div id="adjustment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formAdjustment']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Stock Adjustment</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Stock Adjustment
                        </strong>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Date','',['class'=>'form-control','value'=>'','disabled'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Stock Adjustment
                        </strong>
                    </div>
                    <div class="content table-responsive">
                        <table class="table table-bordered table-striped" id="">

                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody id= "purchasetable">
                                <tr>
                                    <td>{{Form::text('Name','',['class'=>'form-control','placeholder'=>''])}}</td>
                                    <td>{{Form::text('Email','',['class'=>'form-control','placeholder'=>''])}}</td>
                                    <td>{{Form::text('Status','',['class'=>'form-control','placeholder'=>''])}}</td>
                                    <td><button class='btn btn-danger form-control' data-item-id=' +button.getAttribute('id')+ ' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitNewItems" type="submit" onclick="window.alert('to be continue..')" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>


@endsection