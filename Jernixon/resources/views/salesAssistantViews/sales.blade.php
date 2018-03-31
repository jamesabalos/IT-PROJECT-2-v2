@extends('layouts.navbar')
@section('sales_link')
class="active"
@endsection

{{--  @section('onload')
onload="refresh()"
@endsection  --}}

@section('ng-app')
ng-app="ourAngularJsApp"
@endsection


@section('headScript')
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<!--AngularJs-->
{{--  <script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>  --}}

<script src="{{asset('assets/js/angularJs.js')}}"></script>
<script src="{{asset('assets/js/angular-datatables.min.js')}}"></script> 

<script>
    
    function addItemToCart(button){
        $(button).hide(500).delay(1000);
        
            var thatTbody = document.getElementById("cartTbody");
            var newRow = thatTbody.insertRow(-1);
            newRow.insertCell(-1).innerHTML = button.parentNode.parentNode.firstChild.innerHTML;
            button.parentNode.parentNode.setAttribute("class","hidden");            
        
    }       
            
        function removeRowInCart(button){
            document.getElementById(button.getAttribute("data-item-id")).parentNode.parentNode.removeAttribute("class","hidden");
            
            //remove item in local storage
            var data  = $(button.parentNode.parentNode.innerHTML).slice(0,2);
            localStorage.removeItem(data[0].innerHTML);
            
            //show the plus sign button again in dataTables
            document.getElementById(button.getAttribute("data-item-id")).removeAttribute("style");
        }
        
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $('#formSales').on('submit',function(e){
                    e.preventDefault();
                    var data = $(this).serialize();   
                    var arrayOfData = $(this).serializeArray();           

                    var thatTbody = $("#cartTbody tr td:first-child");
                   

                    $.ajax({
                        type:'POST',
                        url: "{{route('salesAssistant.createSales')}}",
                        data:data,                        
                        success:function(data){
                            if(data === "successful"){
                                document.getElementById("formSales").reset();
                                var items = [];
                                var len=localStorage.length;
                                for(var i=0; i<len; i++) {
                                    var key = localStorage.key(i);
                                    var value = localStorage[key];
                                    if(value.includes("item")){
                                        items.push(key);
                                    }
                                }

                                //delete items in localStorage
                                for(var i=0; i < items.length; i++){
                                    localStorage.removeItem(items[i]);
                                }
                                //clear total sales
                                document.getElementById("totalSalesDiv").firstChild.innerHTML="";
                                
                                //show the plus sign button again in dataTables
                                var itemId = $("#cartTbody tr td:nth-child(5) button");
                                for(var i = 0; i<itemId.length; i++){
                                    document.getElementById(itemId[i].getAttribute("data-item-id")).removeAttribute("style");
                                }
                                
                                //remove all rows in cart
                                $("#cartTbody tr").remove();                           
                                $("#successDiv p").remove();
                                $("#successDiv").removeClass("alert-danger hidden").addClass("alert-success")
                                    .html("<h3>Transaction successful</h3>");
                                $("#successDiv").slideDown("slow")
                                                .delay(1000)                        
                                                .hide(1500);

                                //refresh dataTable
                                $("#dashboardDatatable").DataTable().ajax.reload();
                            }else{
                                $("#successDiv").css("display","block");
                                $("#successDiv").removeClass("alert-success hidden").addClass("alert-danger");
                                $("#successDiv").html("Receipt Number duplicated");
                            }

                        },
                        
                       
                        error:function(data){
                            var response = data.responseJSON;
                            console.log(response)

                             //prompt the message
                            $("#successDiv").css("display","block");
                            $("#successDiv").removeClass("alert-success hidden").addClass("alert-danger");
                            $("#successDiv").html(function(){
                                var addedHtml="";
                                for (var key in response.errors) {
                                    addedHtml += "<p>"+response.errors[key]+"</p>";
                                }
                                return addedHtml;
                            });
                        }
                    });
                   


                })
                
                
            });
            
            
        </script>
        
        @endsection
        
        @section('linkName')
        <h3><i class="fa fa-dollar"></i> Sales</h3>
        @endsection
        
        @section('right')
        <div class="row" >
            <div class="col-md-12" >
                <div class="card" >
                    <div class="header">
                        <div class="row">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table class="table table-hover table-bordered" style="width:100%" id="dashboardDatatable">
                                    {{--  <thead> 
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Quantity in Stock</th>
                                            <th>Purchase Price</th>
                                            <th>Retail Price</th>
                                            <th>Add to Cart</th>
                                        </tr>
                                    </thead>  --}}
                                    {{--  <tbody id="dashboardDatatable">  --}}
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" >
                <div class="col-md-12" >
                    <div class="card" >
                        <div class="header" >
                            <div class="alert alert-success hidden" id="successDiv">
                            </div>
                            {!! Form::open(['method'=>'post','id'=>'formSales']) !!}                                
                            <h4 ng-bind="name">Customer Purchase</h4>
                            <div class="row">
                                <div class="col-md-5" margin >
                                    {{Form::label('customerName', 'Customer Name:')}}
                                    {{Form::text('customerName','',['class'=>'form-control'])}}
                                </div>
                                <div class="col-md-5" margin >
                                    {{Form::label('receiptNumber', 'Receipt Number:')}}
                                    {{Form::text('receiptNumber','',['class'=>'form-control'])}}
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-md-12 table-responsive">
                                    <table id="cartTable" class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                                        <thead>
                                            <tr>
                                                <td>Item</td>
                                                {{--  <td>Quantity Left</td>  --}}
                                                {{--  <td>Purchase Price</td>  --}}
                                                <td>Price</td>
                                                <td>Quantity Purchase</td>
                                                <td>Sales Price</td>
                                                <td>Action</td>
                                            </tr> 
                                            
                                        </thead>
                                        <tbody id="cartTbody">
                                            {{--  <td><input type='number' value='1' min='1' ng-model='newQuantity' ng-change='myFunction()'></td>  --}}
                                            {{--  <tr ng-repeat="user in users">
                                                <td ng-bind="$index + 1"></td>
                                                <td ng-bind="user.fullname"></td>
                                                <td ng-bind="user.email"></td>
                                            </tr>  --}}
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-9 text-right">
                                                <label>Total Sales:</label>
                                            </div>
                                            <div class="col-md-3" id="totalSalesDiv">
                                                <p class="form-control" id="totalSales" ng-bind="" style="float: right"></p>
                                            </div>
                                            <div class="text-right">                                           
                                                <div class="col-md-12">   
                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            {!! Form::close() !!}
                            
                        </div>
                    </div>
                </div>
            </div>
            @endsection
            
@section('jqueryScript')
<script type="text/javascript">

//////////////////////////////////////////////
// AngularJs javascript
var ourAngularJsApp = angular.module("ourAngularJsApp", []); 

///////////////////////////////////////////////
ourAngularJsApp.controller('customerPurchase', ['$scope','$compile',
function($scope, $compile) {
var _this = this;

$('#dashboardDatatable').DataTable({
"ajax":  "{{ route('salesAssistant.getItemsSales') }}",        
        
        columns: [
        {
            "title": "Description",
            "data": "description"
        },
        {
            "title": "Quantity in Stock",
            "data": "quantity"
        },
        {
            "title": "Retail Price",
            "data": "retail_price"
        },
        {
            "title": "Add to Cart",
            "data": "action"
        }],
        
        createdRow: function(row, data, dataIndex) {
            $compile(angular.element(row).contents())($scope);
        },
        
        //fetch the items in localStorage after the dataTables initialization
        "initComplete": function(settings, json) {
            var len=localStorage.length;
            var thatTbody = document.getElementById("cartTbody");
            
            var totalSalesNgBinds ="";
            for(var i=0; i<len; i++) {
                
                var key = localStorage.key(i);
                var value = localStorage[key];
                if(value.includes("item")){
                    var myItemJSON = JSON.parse(localStorage.getItemSales(key));            
                    //hide row
                    document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
                    var newRow = thatTbody.insertRow(-1);
                    newRow.insertCell(-1).innerHTML = myItemJSON.item ;
                   
                    angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.retailPrice)($scope) );
                    
                    
                    angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.quantityPurchase)($scope) );
                    
                    
                    angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.salesPrice)($scope) );
                    
                    angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.removeButton)($scope) );
                    
                    
                    //remove the add button after the datatables load
                    var button = document.getElementById(myItemJSON.itemId);
                    $(button).hide();
                    
                    var temp = document.createElement('div');
                    temp.innerHTML = myItemJSON.salesPrice;  
                    if(totalSalesNgBinds==""){
                        totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
                    }else{
                        totalSalesNgBinds += " + " + temp.firstChild.getAttribute("ng-bind");
                    }
                    
                    
                }
            }
            
            //initialize totalSales
            document.getElementById("totalSalesDiv").innerHTML="";
            var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p>";
            angular.element( totalSalesDiv ).append( $compile(price)($scope) );
            
            
        }
        
        
    });
    
    $scope.addButton = function(event) {
        var thatTable = document.getElementById("cartTable");
        var numberOfRows = thatTable.rows.length;
        var lastRow = thatTable.rows[numberOfRows-1];
        var itemName = lastRow.cells[0].innerHTML.replace(/\s/g,'').replace(/-/g,'');
        
        var retailPrice = "<p class='form-control' style='color:green'>" +event.currentTarget.parentNode.previousSibling.innerHTML+ "</p><input type='hidden' name='retailPrices[]' value='" +event.currentTarget.parentNode.previousSibling.innerHTML+ "'> ";
        var temp0 = $compile(retailPrice)($scope);                
        angular.element( lastRow.insertCell(-1) ).append(temp0);    
        
        var inputNumber = "<input type='number' name='quantity[]' class='form-control' ng-focus='$event = $event' ng-change='changing($event)'' ng-model='" +itemName + "' min='1' max='" +event.currentTarget.parentNode.parentNode.childNodes[1].innerHTML+ "' value='1'></input>";
        var temp1 = $compile(inputNumber)($scope);
        
        angular.element( lastRow.insertCell(-1) ).append(temp1);
        
        var salesPrice = "<p class='form-control style='color:green' ng-bind='" +itemName+ "SP'></p><input type='hidden' name='salesPrices[]'>";
        var temp2 = $compile(salesPrice)($scope);
        angular.element( lastRow.insertCell(-1) ).append(temp2);
        
        var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)' onclick='removeRowInCart(this)'>Remove</button><input type='hidden' name='productIds[]' value='"+event.currentTarget.id+"'>";
        var temp3 = $compile(removeButton)($scope);
        angular.element( lastRow.insertCell(-1) ).append(temp3);
        
        //store in localStorage
        var tds  = $(lastRow.innerHTML).slice(0);     
        var itemObject = {
            item: tds[0].innerHTML,
            retailPrice: tds[1].childNodes[0].outerHTML + tds[1].childNodes[1].outerHTML,
            quantityPurchase: tds[2].firstChild.outerHTML,
            salesPrice: tds[3].childNodes[0].outerHTML + tds[3].childNodes[1].outerHTML,
            removeButton: tds[4].childNodes[0].outerHTML + tds[4].childNodes[1].outerHTML,
            itemId: event.currentTarget.getAttribute("id")
        };
        
        var jsonObject = JSON.stringify(itemObject);
        localStorage.setItem(tds[0].innerHTML,jsonObject);
        
        
                
                var totalSalesDiv = document.getElementById("totalSalesDiv");
        
                var ngBindAttributes = totalSalesDiv.firstChild.getAttribute("ng-bind"); //get ng-bind attribute/s
                totalSalesDiv.innerHTML =""; //remove h4 element;
                if(ngBindAttributes==""){
                    var newNgBinds = itemName+"SP";
                }else{
                    var newNgBinds = ngBindAttributes + " + " + itemName+"SP";
                }
                var price = "<p class='form-control' style='color:green' ng-bind='" +newNgBinds+ "'></p>";
                angular.element( totalSalesDiv ).append( $compile(price)($scope) );
                
                
            };
            
            $scope.changing = function(event) {
        
                console.log( event.currentTarget.attributes["ng-model"].value );
                var ngModelName = event.currentTarget.attributes["ng-model"].value;        
                var retailPrice = parseInt(event.currentTarget.parentNode.previousSibling.innerText);
                var sellingPrice = ngModelName+"SP";
                $scope[sellingPrice] =  retailPrice * $scope[ngModelName];
                console.log($scope[sellingPrice])
            }
            
            $scope.remove = function(event){
                
                    event.currentTarget.parentNode.parentNode.remove();
                    
                
                    var thatTable = document.querySelectorAll('#cartTable > tbody > tr')
                    var numberOfRows = thatTable.length;
                    var ngBinds = "";
                    
                    if(numberOfRows > 0){
                        for(var i=0; i < numberOfRows; i++){
                            if(ngBinds==""){
                                ngBinds += thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind");
                            }else{
                                ngBinds += " + " + thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind");
                            }
                        }
                    }
                    console.log(ngBinds)    
                    
                    document.getElementById("totalSalesDiv").innerHTML="";
                    var price = "<p class='form-control' style='color:green' ng-bind='" +ngBinds+ "'></p>";
                    angular.element( totalSalesDiv ).append( $compile(price)($scope) );
                }
                
            }
            ]);
            
            
        </script>
        {{--  <script src="{{asset('assets/js/angularJsControllers.js')}}"></script>  --}}
        
        @endsection
                                                                
    @section('js_link')
    <!--   Core JS Files   -->
    {{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
    
    
    @endsection