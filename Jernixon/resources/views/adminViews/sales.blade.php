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
    function printReceipt(){
        // var data = $("#formSales").serialize();   
        var arrayOfData = $("#formSales").serializeArray();  
        console.log( arrayOfData )
        console.log( arrayOfData[0]['name'] )

        var restorePage = document.body.innerHTML;
        var printContent = document.getElementById("printArea").innerHTML;
        
        var items = "";
        var rows = $("#cartTbody tr");
        for(var i = 0; i < rows.length; i++){
            items += "<tr>\
                        <td>"+rows[i].cells[2].lastChild.value+"</td>\
                        <td></td>\
                        <td>"+rows[i].cells[0].innerHTML+"</td>\
                        <td>"+rows[i].cells[1].innerText+"</td>\
                        <td>"+rows[i].cells[3].innerText+"</td>\
                    <tr>\
                ";
        }
        var totalSalesPrice = document.getElementById("totalSalesDiv").firstChild.innerText;
        var officialReceipt = "\
            <div style='height: 600px;width: 500px;border:2px solid red;margin-left: 120px;'>\
            <h3>hellooo</h3>"
            +arrayOfData[1]['value']+"<br>"
            +arrayOfData[2]['value']+"<br>"
            +arrayOfData[3]['value']+"<br>"
            +arrayOfData[4]['value']+
                "<div class='content table-responsive table-full-width table-stripped'>\
                    <table class='table table-hover table-bordered' style='width:100%'>\
                        <thead>\
                            <tr>\
                                <td>Qty</td>\
                                <td>Unit</td>\
                                <td>Article</td>\
                                <td>U-Price</td>\
                                <td>Amount</td>\
                            </tr>\
                        </thead>"+  
                        items
                    +"</table>\
                </div>\
                <h3>"+totalSalesPrice+"</h3>\
            </div>\
        ";
   
        document.body.innerHTML = officialReceipt;
        window.print();
        document.body.innerHTML = restorePage;
    }
    function addItemToCart(button){
        $(button).hide(500).delay(1000);
        //$(button).removeClass("btn-info").addClass("btn-danger");
        // $(button i).remove()
        //.show(500);
        //.html("<button class='btn btn-danger' onclick='addItemToCart(this)'>Remove</button>")


        // var data  = $(button.parentNode.parentNode.innerHTML).slice(0);
        // if( localStorage.getItem(data[0].innerHTML) == null){
        var thatTbody = document.getElementById("cartTbody");
        var newRow = thatTbody.insertRow(-1);
        newRow.insertCell(-1).innerHTML = button.parentNode.parentNode.firstChild.innerHTML;
        button.parentNode.parentNode.setAttribute("class","hidden");

        // button.parentNode.parentNode.setAttribute("name","description[]");

        // newRow.innerHTML = a.parentNode.parentNode.innerHTML ;
        // thatTbody.append(newTr);
        // for(var i=0; i<data.length;i++){

        //     newRow.insertCell(-1).innerHTML = data[i].innerHTML;
        // }


        // newRow.insertCell(-1).innerHTML = "<td><input class='ng-valid ng-valid-min ng-not-empty ng-dirty ng-valid-number ng-touched' type='number' value='1' min='1' ng-model='newQuantity' ng-change='myFunction()'></td>";
        ///// newRow.insertCell(-1).innerHTML ="<td ng-bind='" +data[0].innerHTML+"'></td>";
        // newRow.insertCell(-1).innerHTML ="<td><h2 ng-bind='" +data[0].innerHTML+ "'></h2></td>";
        // newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +button.getAttribute("id")+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

        //add to localStorage
        // var itemObject = {
        //     item: data[0].innerHTML,
        //     quantityLeft: data[2].innerHTML,
        //     wholeSalePrice: data[3].innerHTML,
        //     retailPrice: data[3].innerHTML,
        //     quantityPurchase: "1",
        //     //totalPrice:data[5].innerHTML,
        //     itemId:button.getAttribute("id")

        // };

        // var jsonObject = JSON.stringify(itemObject);
        // localStorage.setItem(data[0].innerHTML,jsonObject);

        // }

    }

    function removeRowInCart(button){
        document.getElementById(button.getAttribute("data-item-id")).parentNode.parentNode.removeAttribute("class","hidden");

        //var i = a.parentNode.parentNode.rowIndex;
        //document.getElementById("cartTable").deleteRow(i);
        // var row = button.parentNode.parentNode; //row
        // $(row).hide(500)
        // $(row).remove();
        // });

        //remove item in local storage
        var data  = $(button.parentNode.parentNode.innerHTML).slice(0,2);
        localStorage.removeItem(data[0].innerHTML);

        //show the plus sign button again in dataTables
        document.getElementById(button.getAttribute("data-item-id")).removeAttribute("style");
    }

    $(document).ready(function(){

        let today = new Date().toISOString().substr(0, 10);
        document.querySelector("#today").value = today;

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
                // url:'admin/storeNewItem',
                url: "{{route('admin.createSales')}}",
                //                        dataType:'json',

                // data:{
                //     'name': arrayOfData[1].value,
                // },

                // data:{data},
                data:data,
                //_token:$("#_token"),
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

                        //prompt the message

                        //                            $("#successDiv").css("display:block");
                        //                            document.getElementById("successDiv").innerHTML = "<h3>" +data+ "</h3>"
                        //                            $("#successDiv").slideDown("slow");

                        $("#successDiv p").remove();
                        $("#successDiv").removeClass("alert-danger hidden").addClass("alert-success")
                        // .addClass("alert-success")
                            .html("<h3>Transaction successful</h3>");

                        //                            $("#successDiv").css("display:block");
                        $("#successDiv").slideDown("slow")
                            .delay(1000)                        
                            .hide(1500);
                        //                            $("#successDiv").removeAttribute("style")

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
                        $("#successDiv").removeClass("alert-success").addClass("alert-danger");
                    $("#successDiv").hide(500);
                    $("#successDiv").removeClass("hidden");
                    $("#successDiv").slideDown("slow", function() {
                        $("#successDiv").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });
                    });
                    
                }
            });
            // .done(function(data) {
            //          alert("success!!!!"); 
            // });


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
                                <th>Qty in Stock</th>
                                <th>Purchase Price</th>
                                <th>Selling Price</th>
                                <th>Add Item</th>
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
<button type="button" onclick="printReceipt()">Print</button>

<div class="row" >
    <div class="col-md-12" >
        <div class="card" >
            <div class="header" id="printArea">
                {!! Form::open(['method'=>'post','id'=>'formSales']) !!}                                
                <h4 ng-bind="name">Customer Purchase</h4>
                <div class="row">
                    <div class="col-md-3" >                        
                            {{Form::label('receiptNumber', 'Receipt Number:')}}
                            {{Form::number('receiptNumber','',['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7" margin >
                            {{Form::label('customerName', 'Customer Name:')}}
                            {{Form::text('customerName','',['class'=>'form-control'])}}
                        </div>
                        <div class="col-md-4" margin >
                                {{Form::label('Date', 'Date:')}}
                                <input type="date" name="Date" id="today"  class="form-control"/>    
                        </div>
                      
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-0" margin>
                            {{Form::label('address', 'Address:')}}
                            {{Form::text('address','',['class'=>'form-control'])}}
                            
                        </div>
                        {{-- <div class="col-md-2" margin>
                            <input type="date" name="Date" id="today"  class="form-control"/>

                        </div> --}}
                    </div>
                </div>
                
                <div class="row" > 
                    <div class="col-md-12 table-responsive">
                        <table id="cartTable" class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Selling Price</th>
                                    <th>Qty Purchase</th>
                                    <th>Sales</th>
                                    <th>Action</th>
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
                            <div class="alert alert-danger text-center hidden" id="successDiv">
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
    // $(document).ready(function() {

    //     $('#dashboardDatatable').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "pagingType": "full_numbers",

    //         @if(Auth::guard('adminGuard')->check())
    //         "ajax":  "{{ route('dashboard.getItems') }}",
    //         @elseif(Auth::guard('web')->check())
    //         "ajax":  "{{ route('SADashboard.getItems') }}",
    //         @endif

    //         "columns": [
    //         // {data: 'product_id'},
    //         {data: 'description'},
    //         {data: 'status'},
    //         //{data: 'quantity'},
    //         {data: 'wholesale_price'},
    //         {data: 'retail_price'},
    //         {data: 'action'},
    //         //  {data: 'created_at'},
    //         //{data: 'updated_at'},
    //         ],
    //         // "initComplete": function(settings, json) {

    //         // }

    //         //responsive: true,                
    //         //keys: true           
    //         //dom: 'Bfrtip',
    //         //buttons: ['excel', 'pdf','print'],
    //     });
    // });
    //////////////////////////////////////////////
    // AngularJs javascript
    var ourAngularJsApp = angular.module("ourAngularJsApp", []); 
    //     ourAngularJsApp.controller("customerPurchase", function($scope,$compile) {
    //         $scope.myFunction = function(){
    //             alert("hi")
    //             $scope.name = $scope.typeName;
    //             // $scope.name = $scope.newQuantity;
    //             //$scope.newStock = $scope.newQuantity;
    //             //var retailPrice = parseInt(row.parentNode.previousSibling.innerHTML);
    //             //var ng_model_name = row.getAttribute("ng-model");

    //             //var salesPriceCell = row
    //             // $scope.newStock = 1 + $scope[ng_model_name];
    //             // $scope.newStock = 1 + 1;
    //         }
    //         $scope.addButton = function(){
    //             alert("yes!!")
    //         }
    //     }); 
    ///////////////////////////////////////////////
    ourAngularJsApp.controller('customerPurchase', ['$scope','$compile',
        function($scope, $compile) {
            var _this = this;

            $('#dashboardDatatable').DataTable({
                // "processing": true,
                // "serverSide": true,
                "ajax":  "{{ route('dashboard.getItems') }}",
                // data: [{
                //     "LastName": "Doe",
                //     "Link": "<button type=\"button\" ng-click=\"Ctrl.addButton()\">Test Alert</a>"
                // }],
                // columns: [{
                //     "title": "Last Name",
                //     "data": "LastName"
                // }, {
                //     "title": "Actions",
                //     "data": "Link"
                // }],



                columns:[{
                    "title": "Description",
                    "data": "description"
                },
                            // {
                            //     "title": "Category",
                            //     "data": "status"
                            // },
                            {
                                "title": "Qty in Stock",
                                "data": "quantity"
                            },
                            {
                                "title": "Purchase Price",
                                "data": "wholesale_price"
                            },
                            {
                                "title": "Selling Price",
                                "data": "retail_price"
                            },
                            {
                                "title": "Add Item",
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
                            var myItemJSON = JSON.parse(localStorage.getItem(key));            
                            
                        
                             var updateTemp = $.parseHTML( myItemJSON.retailPrice );
                            updateTemp[0].innerHTML=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
                            updateTemp[1].value=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
                             console.log(updateTemp[0].outerHTML+updateTemp[1].outerHTML)
                            //  document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML
                        




                            //hide row
                            document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
                            var newRow = thatTbody.insertRow(-1);
                            newRow.insertCell(-1).innerHTML = myItemJSON.item ;
                            // newRow.insertCell(-1).innerHTML = myItemJSON.quantityLeft;
                            // newRow.insertCell(-1).innerHTML = myItemJSON.wholeSalePrice;

                            // var salesPrice = "<p class='form-control style='color:green' ng-bind='" +itemName+ "SP'></p>";
                            // var temp2 = $compile(salesPrice)($scope);
                            // angular.element( lastRow.insertCell(-1) ).append(temp2);

                            //newRow.insertCell(-1).innerHTML = myItemJSON.retailPrice;
                            angular.element( newRow.insertCell(-1) ).append( $compile(updateTemp[0].outerHTML+updateTemp[1].outerHTML)($scope) );

                            //newRow.insertCell(-1).innerHTML = myItemJSON.quantityPurchase;
                            angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.quantityPurchase)($scope) );

                            //newRow.insertCell(-1).innerHTML = myItemJSON.salesPrice;
                            angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.salesPrice)($scope) );

                            angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.removeButton)($scope) );
                            // newRow.insertCell(-1).innerHTML = myItemJSON.removeButton;
                            // newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +myItemJSON.itemId+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

                            //remove the add button after the datatables load
                            var button = document.getElementById(myItemJSON.itemId);
                            $(button).hide();

                            var temp = document.createElement('div');
                            temp.innerHTML = myItemJSON.salesPrice;  
                            if(totalSalesNgBinds==""){
                                var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");                                
                                // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
                                totalSalesNgBinds += splitBind[0];
                            }else{
                                var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");
                                // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
                                totalSalesNgBinds += "+ " + splitBind[0];
                            }


                        }
                    }

                    //initialize totalSales
                    document.getElementById("totalSalesDiv").innerHTML="";
                    if(totalSalesNgBinds === ""){
                        var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p>";
                    }else{
                        var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ " |number:2'></p>";
                    }
                    angular.element( totalSalesDiv ).append( $compile(price)($scope) );


                }


            });

            $scope.addButton = function(event) {
                // alert("yesssss!!!")
                // var thatTbody = document.getElementById("cartTbody");
                // console.log( event.currentTarget.parentNode.parentNode.innerHTML )
                // alert( event.target.parentNode.parentNode.innerHTML )
                // var data = $(event.target.parentNode.parentNode.innerHTML).slice(0,-1);
                // console.log(event)
                var thatTable = document.getElementById("cartTable");
                var numberOfRows = thatTable.rows.length;
                var lastRow = thatTable.rows[numberOfRows-1];
                var itemName = lastRow.cells[0].innerHTML.replace(/\s/g,'').replace(/-/g,'').replace(/\//g,'').replace(/\./g,'').replace(/\+/g,'');

                var retailPrice = "<p class='form-control' style='color:green; width: 100px;'>" +event.currentTarget.parentNode.previousSibling.innerHTML+ "</p><input type='hidden' name='retailPrices[]' value='" +event.currentTarget.parentNode.previousSibling.innerHTML+ "'> <input type='hidden' name='description[]' value='" +event.currentTarget.parentNode.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML+ "'>";
                var temp0 = $compile(retailPrice)($scope);                
                angular.element( lastRow.insertCell(-1) ).append(temp0);    

                var inputNumber = "<input style='width: 100px;' type='number' name='quantity[]' class='form-control' ng-focus='$event = $event' ng-change='changing($event)'' ng-model='" +itemName + "' min='1' max='" +event.currentTarget.parentNode.parentNode.childNodes[1].innerHTML+ "' value='1'></input>";
                var temp1 = $compile(inputNumber)($scope);
                // var newRow = thatTbody.insertRow(-1);
                // angular.element( newRow.insertCell(-1) ).append(temp);
                angular.element( lastRow.insertCell(-1) ).append(temp1);

                var salesPrice = "<p class='form-control' style='color:green;' ng-bind='" +itemName+ "SP |number:2'></p><input  type='hidden' name='salesPrices[]' value=''>";
                var temp2 = $compile(salesPrice)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp2);

                // var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)' onclick='removeRowInCart(this)'>Remove</button>";
                var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)' onclick='removeRowInCart(this)'>Remove</button><input type='hidden' name='productIds[]' value='"+event.currentTarget.id+"'>";
                var temp3 = $compile(removeButton)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp3);

                
                //store in localStorage
                var tds  = $(lastRow.innerHTML).slice(0);     
                var itemObject = {
                    item: tds[0].innerHTML,
                    // quantityLeft: tds[1].innerHTML,
                    // wholeSalePrice: tds[2].innerHTML,
                    retailPrice: tds[1].childNodes[0].outerHTML + tds[1].childNodes[1].outerHTML,
                    quantityPurchase: tds[2].firstChild.outerHTML,
                    salesPrice: tds[3].childNodes[0].outerHTML + tds[3].childNodes[1].outerHTML,
                    removeButton: tds[4].childNodes[0].outerHTML + tds[4].childNodes[1].outerHTML,
                    itemId: event.currentTarget.getAttribute("id")
                };

                var jsonObject = JSON.stringify(itemObject);
                localStorage.setItem(tds[0].innerHTML,jsonObject);

                //display Total Sales with ng-bind/s
                // var len=localStorage.length;
                // var ngBinds = "";
                // for(var i=0; i<len; i++) {
                //         var key = localStorage.key(i);
                //         var value = localStorage[key];
                //         if(value.includes("item")){
                //             // console.log(key + " => " + value);          
                //             var myItemJSON = JSON.parse(localStorage.getItem(key));  
                //             var salesPriceString = myItemJSON.salesPrice
                //             var temp = document.createElement('div');
                //             temp.innerHTML = salesPriceString;
                //             console.log(temp.firstChild.getAttribute("ng-bind"))        
                //         }
                // }

                var totalSalesDiv = document.getElementById("totalSalesDiv");
                // console.log(totalSalesDiv.childNodes)
                var ngBindAttributes = totalSalesDiv.firstChild.getAttribute("ng-bind"); //get ng-bind attribute/s
                totalSalesDiv.innerHTML =""; //remove h4 element;
                if(ngBindAttributes==""){
                    var newNgBinds = itemName+"SP";
                }else{
                    var newNgBinds = ngBindAttributes + "+ " + itemName+"SP";
                }

                var binds = newNgBinds.split(" ");
                var ngBindsResult = "";
                    for(var i = 0; i < binds.length; i++){
                        if(i % 2 === 0){
                            if(ngBindsResult === ""){
                                ngBindsResult = binds[i];
                            }else{
                                ngBindsResult += "+" +binds[i];
                            }
                        }
                    }
                    console.log("correct: " + ngBindsResult)
                var price = "<p class='form-control' style='color:green' ng-bind='" +ngBindsResult+ " |number:2'></p>";
                angular.element( totalSalesDiv ).append( $compile(price)($scope) );


            };

            $scope.changing = function(event) {
                // alert("changing!!!");
                // console.log( angular.element(event).attr('class') );
                // console.log( event.currentTarget.getAttribute("class") );
                console.log( event.currentTarget.attributes["ng-model"].value );
                var ngModelName = event.currentTarget.attributes["ng-model"].value;
                // var oldTs = parseInt(document.getElementById("totalSales").innerText);
                var retailPrice = parseInt(event.currentTarget.parentNode.previousSibling.innerText);
                var sellingPrice = ngModelName+"SP";
                $scope[sellingPrice] =  retailPrice * $scope[ngModelName];
                // document.getElementById("salesPriceValue").setAttribute("value",retailPrice * $scope[ngModelName]);
          
        
                // $scope.totalSales =  $scope[ngModelName];
                // console.log($scope[sellingPrice])

                // var totalSales = document.getElementById("totalSalesDiv").firstChild.innerText;
                // console.log("totalSales: " +totalSales)
            }

            $scope.remove = function(event){
                // $(event.currentTarget.parentNode.parentNode).hide(500,function(){
                event.currentTarget.parentNode.parentNode.remove();

                // })
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