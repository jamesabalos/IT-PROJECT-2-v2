@extends('layouts.navbar')
@section('sales_link')
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
</script>

@endsection

@section('linkName')
<h3>Sales</h3>
@endsection

@section('right')
<div class="row" >
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div class="row">
                    <table class="table table-hover table-condensed" style="width:100%" id="dashboardDatatable">
                        <thead> 
                            <tr>
                                {{--  <th>Id</th>  --}}
                                <th>Description</th>
                                <th>Category</th>
                                <th>Quantity in Stock</th>
                                <th>Wholesale Price</th>
                                <th>Retail Price</th>
                                <th>Add to Cart</th>
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

<div class="row" >
    <div class="col-md-12" >
        <div class="card" >
            <div class="header" >
                <h4 ng-bind="name">Customer Purchase</h4>
                <div class="row">
                    <div class="col-md-3 text-right">
                        <label>Customer Name: </label>
                    </div>
                    <div class="col-md-6">
                        <input ng-model="typeName" ng-change="myFunction()" type="text" class="form-control border-input" form="purchase" required>
                    </div>
                </div>
                {{--  <div class="row">
                <div class="col-md-3 text-right">
                    <label>Date of Purchased</label>    
                </div>
                <div class="col-md-9">

                    <span class="add-on">
                        <i class="fa fa-calendar" aria-hidden="true"></i>

                    </span>   
                </div>

                </div>  --}}

                <div class="row"> 
                    <div class="col-md-12 table-responsive">
                        <table id="cartTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    {{--  <th>Id</th>  --}}
                                    <td>Item</td>
                                    <td>Quantity Left</td>
                                    <td>Wholesale Price</td>
                                    <td>Retail Price</td>
                                    <td>Quantity Purchase</td>
                                    <td>Sales Price</td>
                                    <td>Action</td>
                                </tr> 
                            </thead>
                            <tbody id="cartTbody">
                                <td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='number' value='1' min='1' ng-model='newQuantity' ng-change='myFunction()'></td>                                 
                            </tbody>
                        </table>
                    </div>
                </div>  
                <div class="row">
                    <h2 ng-bind="newStock"></h2>
                    <div class="text-right">                                           
                        <div class="col-md-5">                                                    
                            <button class="btn btn-primary" onclick="window.alert('to be continue..')">Submit</button>
                        </div>                             
                    </div>
                    <div class="col-md-4 text-right">
                        <label>Total Sales: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" disabled class="form-control border-input" form="purchase" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('jqueryScript')
<script type="text/javascript">
    $(document).ready(function() {

        $('#dashboardDatatable').DataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",

            @if(Auth::guard('adminGuard')->check())
            "ajax":  "{{ route('dashboard.getItems') }}",
            @elseif(Auth::guard('web')->check())
            "ajax":  "{{ route('SADashboard.getItems') }}",
            @endif

            "columns": [
            // {data: 'product_id'},
            {data: 'description'},
                                           {data: 'status'},
                                           //{data: 'quantity'},
                                           {data: 'wholesale_price'},
                                           {data: 'retail_price'},
                                           {data: 'action'},
                                           //  {data: 'created_at'},
                                           //{data: 'updated_at'},
                                           ],
                                           //responsive: true,                
                                           //keys: true           
                                           //dom: 'Bfrtip',
                                           //buttons: ['excel', 'pdf','print'],
                                           });

    });

    // AngularJs javascript
    var ourAngularJsApp = angular.module("ourAngularJsApp", []); 

    ourAngularJsApp.controller("customerPurchase", function($scope) {
        $scope.myFunction = function(){
            alert("hi")
            $scope.name = $scope.typeName;
            // $scope.name = $scope.newQuantity;
            //$scope.newStock = $scope.newQuantity;
            //var retailPrice = parseInt(row.parentNode.previousSibling.innerHTML);
            //var ng_model_name = row.getAttribute("ng-model");

            //var salesPriceCell = row
            // $scope.newStock = 1 + $scope[ng_model_name];
            // $scope.newStock = 1 + 1;
        }

    }); 

</script>
@endsection

@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>


@endsection