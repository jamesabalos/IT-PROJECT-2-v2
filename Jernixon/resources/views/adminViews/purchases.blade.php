@extends('layouts.navbar')
@section('purchases_link')
class="active"
@endsection

{{--  @section('onload')
onload="refresh()"
@endsection  --}}

{{--  @section('ng-app')
ng-app="ourAngularJsApp"
@endsection  --}}
@section('linkName')
<h3>Purchases</h3>
@endsection

@section('headScript')
<script type="text/javascript">
    function addRow(){
        var thatTable = document.getElementById("purchasetable");
        var newRow = thatTable.insertRow(-1);
        // newRow.insertCell(-1).innerHTML = "<td>{{Form::text('Description','',['class'=>'form-control','value'=>''])}}</td>";
        // newRow.insertCell(-1).innerHTML = "<td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>";
        // newRow.insertCell(-1).innerHTML = "<td>{{Form::text('Price','',['class'=>'form-control','value'=>''])}}</td>";
        // newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
        newRow.insertCell(-1).innerHTML = "<td></td>";
        newRow.insertCell(-1).innerHTML = "<td></td>";
        newRow.insertCell(-1).innerHTML = "<td></td>";
        newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
    }
    function searchItem(a){
            $.ajax({
                    method: 'get',
                    //url: 'items/' + document.getElementById("inputItem").value,
                    url: 'dashboard/' + a.value,
                    dataType: "json",
                        success: function(data){
                            if(a.id === "dashboardSearchItem"){
                                $("#dashboardDatatable tr").remove();                        
                                for(var i=0; i < data.length; i++){
                                    var thatTable = document.getElementById("dashboardDatatable");
                                    var newRow = thatTable.insertRow(-1);
                                    var itemIdCell = newRow.insertCell(-1);
                                    itemIdCell.innerHTML = "<td>" + data[i].product_id + "</td>";
                                    var secondCell = newRow.insertCell(-1);
                                    secondCell.innerHTML = "<td>" +data[i].description+ "</td>";
                                    var thirdCell = newRow.insertCell(-1); 
                                    thirdCell.innerHTML = "<td>query</td>";
                                    var forthCell = newRow.insertCell(-1);
                                    forthCell.innerHTML = "<td>" + data[i].price + "</td>";
                                    var fifthCell = newRow.insertCell(-1); 
                                    fifthCell.innerHTML = "<td>query</td>";
                                    var sixthCell = newRow.insertCell(-1);
                                    //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                                    sixthCell.innerHTML = "<td><button class='btn btn-success' onclick='addItemToCart(this)'>Add</button></td>";
                                }
                            }
                            
                        }
                });
        }

    $(document).ready(function(){
        $('#formPurchaseOrder').on('submit',function(e){
                e.preventDefault();
            alert("clicked")

        })
    });
</script>

@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class = "col-md-12">
                        <a href = "#purchase" data-toggle="modal">
                            <div class="content table-responsive table-full-width">
                            <button type="button" class="btn btn-success">Create Purchase Order</button>
                            </div>
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

             {!! Form::open(['method'=>'get','id'=>'formPurchaseOrder']) !!}
            <input type="hidden" id="_token" value="{{ csrf_token() }}">

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
                        {{--  <input type="hidden" id="_token" value="{{ csrf_token() }}">  --}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Date','',['class'=>'form-control','value'=>''])}}
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
                                    {{Form::text('Supplier','',['class'=>'form-control','value'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" id="purchasetable">
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Price</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        {{--  <td>{{Form::text('Description','',['class'=>'form-control','value'=>''])}}</td>
                                        <td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>
                                        <td>{{Form::text('Price','',['class'=>'form-control','value'=>''])}}</td>
                                        <td><button class='btn btn-danger form-control' data-item-id='" +button.getAttribute("id")+ "' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>  --}}
                                        <td colspan="4">
                                            <input type="text" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Enter the name of the item">                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                <button type="button" class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitPurchases" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                
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
