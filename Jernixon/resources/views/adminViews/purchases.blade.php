@extends('layouts.navbar')
@section('purchases_link')
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
                newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +myItemJSON.itemId+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

            }
        } 
    }

    function addItemToCart(button){
        $(button).hide(500).delay(1000);
        //$(button).removeClass("btn-info").addClass("btn-danger");
        // $(button i).remove()
        //.show(500);
        //.html("<button class='btn btn-danger' onclick='addItemToCart(this)'>Remove</button>")

        var data  = $(button.parentNode.parentNode.innerHTML).slice(0,-1);
        if( localStorage.getItem(data[0].innerHTML) == null){
            var thatTbody = document.getElementById("cartTbody");
            var newRow = thatTbody.insertRow(-1);
            //newTr.innerHTML = a.parentNode.parentNode.innerHTML ;
            //thatTbody.append(newTr);
            for(var i=0; i<data.length;i++){

                newRow.insertCell(-1).innerHTML = data[i].innerHTML;
            }
            newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='number' value='1' min='1' ng-model='newQuantity' ng-change='myFunction()'></td>";
            newRow.insertCell(-1).innerHTML ="<td ng-bind='" +data[0].innerHTML+"'></td>";
            // newRow.insertCell(-1).innerHTML ="<td><h2 ng-bind='" +data[0].innerHTML+ "'></h2></td>";
            newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +button.getAttribute("id")+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

            //add to localStorage
            var itemObject = {
                item: data[0].innerHTML,
                quantityLeft: data[2].innerHTML,
                wholeSalePrice: data[3].innerHTML,
                retailPrice: data[3].innerHTML,
                quantityPurchase: "1",
                //totalPrice:data[5].innerHTML,
                itemId:button.getAttribute("id")

            };

            var jsonObject = JSON.stringify(itemObject);
            localStorage.setItem(data[0].innerHTML,jsonObject);

        }

    }

    function removeRowInCart(button){
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
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='text' min='1'></td>";
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='number min='1'></td>";
        newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='number' min='1'></td>";


    }
</script>

@endsection

@section('linkName')
<h2>Purchases</h2>
@endsection

@section('right')
<div class="row" >
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div class="row">
                    <div class="text-left">                                           
                        <div class="col-md-12">
                            <a href = "#create" data-toggle="modal" >
                                <button type="submit" class="btn btn-info btn-fill btn-wd btn-success"><i class = "ti-plus"></i> Create Purchase Order</button> 
                            </a> 
                        </div>
                    </div>
                    <table class="table table-hover table-condensed" style="width:100%" id="dashboardDatatable">
                        <thead> 
                            <tr>
                                {{--  <th>Id</th>  --}}
                                <th>PO ID</th>
                                <th>Date Created</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        {{--  <tbody id="dashboardDatatable">  --}}
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')
<div id="create" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-body">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4>Purchase Order</h4>
                <div class="alert alert-danger hidden" id="errorDivAddNewItem">

                </div>

                {!! Form::open(['method'=>'post','id'=>'formPurchaseOrder']) !!}

                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('Date', 'Date:')}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('Date','',['class'=>'form-control','placeholder'=>'Date'])}}
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
                            {{Form::text('Supplier','',['class'=>'form-control','placeholder'=>'Supplier'])}}
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12" >
                        <div class="card" >
                            <div class="header">
                                <div class="row">
                                    <div class="text-left">                                           
                                    </div>
                                    <table class="table table-hover table-condensed" style="width:100%" id="">
                                        <thead> 
                                            <tr>

                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id= "purchasetable">
                                            <tr>
                                                <td>{{Form::text('Description','',['class'=>'form-control'])}}</td>
                                                <td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>
                                                <td>{{Form::text('Price','',['class'=>'form-control'])}}</td>
                                                <td><button class="btn btn-danger form-control"><i class="glyphicon glyphicon-remove"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class ="text-right">Total Items:</div>
                            <div class ="text-right">Total Price:</div>
                        </div>
                    </div>
                </div>                {!! Form::close() !!}


                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   

                            <button id="submitNewItems" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button> 


            </div>
        </div>
    </div>


</div>


@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>


@endsection