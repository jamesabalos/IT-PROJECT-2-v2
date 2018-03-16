@extends('layouts.navbar')
@section('purchases_link')
class="active"
@endsection

@section('linkName')
<h2>Purchases</h2>
@endsection

@section('headScript')
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<!--AngularJs-->
<script src="{{asset('assets/js/angular.min.js')}}"></script>
<script>
    function refresh(){
        var len=localStorage.length;
        var thatTbody = document.getElementById("cartTbody");
        for(var i=0; i<len; i++) {
            var key = localStorage.key(i);
            var value = localStorage[key];
            if(value.includes("item")){
                // console.log(key + " => " + value);          
                var myItemJSON = JSON.parse(localStorage.getItem(key));            
                var newRow = thatTbody.insertRow(-1);
                newRow.insertCell(-1).innerHTML = "<td>"+ myItemJSON.item +"</td>";
                newRow.insertCell(-1).innerHTML = "<td>"+ myItemJSON.quantityLeft +"</td>";
                newRow.insertCell(-1).innerHTML = "<td>"+ myItemJSON.wholeSalePrice +"</td>";
                newRow.insertCell(-1).innerHTML = "<td>"+ myItemJSON.retailPrice +"</td>";
                newRow.insertCell(-1).innerHTML = "<td><input type='number' value='" +myItemJSON.quantityPurchase+ "'min='1'></td>";
                newRow.insertCell(-1).innerHTML = "<td></td>";
                newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +myItemJSON.itemId+ "' onclick='remove(this)'>Remove</button></td>";

            }
        } 
    }

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
        var thatTbody = document.getElementById("purchasetable");
        var newRow = thatTbody.insertRow(-1);
        newRow.insertCell(-1).innerHTML = "<td>{{Form::text('Description','',['class'=>'form-control','value'=>'','disabled'])}}</td>";
        newRow.insertCell(-1).innerHTML = "<td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>";
        newRow.insertCell(-1).innerHTML = "<td>{{Form::text('Price','',['class'=>'form-control','value'=>'','disabled'])}}</td>";
        newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger form-control' data-item-id=' +button.getAttribute('id')+ ' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>";
    }
</script>
<<<<<<< HEAD
=======

@endsection

@section('linkName')
<h3>Purchases</h3>
>>>>>>> 5b5ce0798b5afe104adf9a6563f4382a5d2ee1ed
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class = "col-md-12">
                        <a href = "#purchase" data-toggle="modal">
                            <button type="button" class="btn btn-success">Create Purchase Order</button>
                        </a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="dashboardDatatable">
                            <thead>
                                <tr>
                                    <th class="text-left">PO ID</th>
                                    <th class="text-left">Date Created </th>
                                    <th class="text-left">Supplier</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Action</th>
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
<div id="purchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formPurchaseOrder']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Purchase Order</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Purchase Order
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

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt No:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::number('Official Receipt No','',['class'=>'form-control','placeholder'=>'Official Receipt No','min'=>'1']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Supplier', 'Supplier:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Supplier','',['class'=>'form-control','value'=>'','disabled'])}}
                                </div>
                            </div>
                        </div>

                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" id="">
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Price</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>

                                <tbody id= "purchasetable">
                                    <tr>
                                        <td>{{Form::text('Description','',['class'=>'form-control','value'=>'','disabled'])}}</td>
                                        <td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>
                                        <td>{{Form::text('Price','',['class'=>'form-control','value'=>'','disabled'])}}</td>
                                        <td><button class='btn btn-danger form-control' data-item-id='" +button.getAttribute("id")+ "' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        <button class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button>
                    </div>
                </div>
                {!! Form::close() !!}

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
<script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection
