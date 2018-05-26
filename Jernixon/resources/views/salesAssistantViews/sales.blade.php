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
<style type="text/css">
    @media print{
        /* @page{            
            size: 8.5in 11in; 
        }
        @page:first{
            size: 150mm 175mm;
            page-break-inside:always;
        } */

         @page{
            size: 150mm 175mm;
        } 
        .des{
            width: 100%;
            clear: all;
            /*border: 2px solid;*/

            
        }
        .blank{
            
            float: left;

        }
        #custname{
            padding-left: 60px;
            width:70%;
            float: left;
        }
        #rdate{
            width: 30%;
            float: left;
            /*border:2px solid;*/
        }
        #address{
            padding-left: 60px;
            width: 85%;
            float: left;
        }
        .clear{
            clear: left;
            padding-top:20px;
        }
        .top{
            border:2px solid black; 
            padding-top:100px;
        }
        .quantity, .unit{
            width: 30px;
            text-align: center;
        }
        .desc{
            
        }
        .unitp,.amount{
            width: 70px;
            text-align: center;
        }
        table {
            clear: left;
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        td {
            height: 20px;
            border: 1px solid black;
            
        }
        body{
            counter-increment: pages;
        }
        .pagebreak{
            page-break-after: always;
        }
        .pag{
            text-align: center;
        }
    }


</style>
<script>
        function printReceipt(){
        // var data = $("#formSales").serialize();   
        var arrayOfData = $("#formSales").serializeArray();  
        console.log( arrayOfData )
        console.log( arrayOfData[0]['name'] )

        var restorePage = document.body.innerHTML;
        var printContent = document.getElementById("printArea").innerHTML;
        
        var items = "";
        var pageTwo = "";
        var rows = $("#cartTbody tr");
        
        
        var page=1;
        var m=0;
        var itemw=new Array();
        for(var i = 0; i < rows.length; i++){  
            if(m<7){
                items += "<tr>\
                            <td class='quantity'>"+rows[i].cells[2].lastChild.value+"</td>\
                            <td class='unit'></td>\
                            <td class='desc'>"+rows[i].cells[0].innerHTML+"</td>\
                            <td class='unitp'>"+rows[i].cells[1].innerText+"</td>\
                            <td class='amount'>"+rows[i].cells[3].innerText+"</td>\
                            <tr>\
                        ";
                m++;
                
            }else{
                items += "<tr>\
                            <td class='quantity'>"+rows[i].cells[2].lastChild.value+"</td>\
                            <td class='unit'></td>\
                            <td class='desc'>"+rows[i].cells[0].innerHTML+"</td>\
                            <td class='unitp'>"+rows[i].cells[1].innerText+"</td>\
                            <td class='amount'>"+rows[i].cells[3].innerText+"</td>\
                            <tr>\
                        ";
                m=0;
                page=page+1;
                itemw.push(items);
                items = "";
            }
            if(i==rows.length-1){
                itemw.push(items);
            }

          
        }
        // console.log(itemw);  
        // console.log(rows.length);  

        var totalSalesPrice = document.getElementById("totalSalesDiv").firstChild.innerText;
        var officialReceipt = "";
        
            for(var m=0; m<page;m++){
                officialReceipt += "\
                    <div class='top'>\           \
                    <div class='des'>\
                        <div class='blank'></div>\
                        <div id='custname'>"+arrayOfData[2]['value']+"</div>\
                        <div class='blank'></div>\
                        <div id='rdate'>"+arrayOfData[3]['value']+"</div>\
                    </div>\
                    <div class='des'>\
                        <div class='blank'></div>\
                        <div id='address'>"+arrayOfData[4]['value']+"</div>\
                    </div>\
                        <div class='content table-responsive table-striped table-full-width clear'>\
                            <table>\
                                <tbody>"+  
                                itemw[m]
                            +"</tbody></table>\
                        </div>\
                        <p class='pag'>Page "+(m+1)+" of "+page+" </p>\
                        <p style='text-align:right' class='pagebreak'>TOTAL AMOUNT DUE: "+totalSalesPrice+"</p>\
                        </div>";
                    // console.log("\n Receipt "+ itemw[m]+ " page "+page);
            }
                        
            officialReceipt+="";

        document.body.innerHTML = officialReceipt;
        window.print();
        document.body.innerHTML = restorePage;
        location.reload();
        // document.body.appendChild(restorePage);
        
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
        enablePrintButton();
            
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
    function enablePrintButton(e){
        if( document.getElementById("cartTbody").rows.length > 0 &&  document.getElementById("receiptNumber").value !== "" && document.getElementById("customerName").value !== "" && document.getElementById("today").value !== "" && document.getElementById("address").value !== ""){        
            document.getElementById("printButton").removeAttribute("disabled")
        }else{
            document.getElementById("printButton").setAttribute("disabled","disabled")
        }
    }

    function saveReceiptNumber(e){
        localStorage.setItem("receiptNumber",e.value);       
    }

    function saveCustomerName(e){
        localStorage.setItem("customerName",e.value);       
    }
    function saveCustomerAddress(e){
        localStorage.setItem("customerAddress",e.value);       
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
                        url: "{{route('salesAssistant.createSales')}}",
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
                                
                                //$("#successDiv").css("display:block");
                                //document.getElementById("successDiv").innerHTML = "<h3>" +data+ "</h3>"
                                //$("#successDiv").slideDown("slow");
                                
                                $("#salesErrorDiv p").remove();
                                $("#salesErrorDiv").removeClass("alert-danger hidden").addClass("alert-success")
                                // .addClass("alert-success")
                                    .html("<h3>Transaction successful</h3>");

                                // $("#successDiv").css("display:block");
                                $("#salesErrorDiv").slideDown("slow")
                                                .delay(1000)                        
                                                .hide(1500);
                                 //$("#successDiv").removeAttribute("style")

                                //refresh dataTable
                                $("#dashboardDatatable").DataTable().ajax.reload();
                            }else{
                                $("#salesErrorDiv").css("display","block");
                                $("#salesErrorDiv").removeClass("alert-success hidden").addClass("alert-danger");
                                $("#salesErrorDiv").html("Receipt Number duplicated");
                            }

                        },
                        
                        error:function(data){
                            var response = data.responseJSON;
                            console.log(response)

                             //prompt the message
                            $("#salesErrorDiv").css("display","block");
                           // document.getElementById("successDiv").innerHTML = "<h3>" +data+ "</h3>"
                           // $("#successDiv").slideDown("slow");
                           // $("#successDiv").css("display:block");
                            $("#salesErrorDiv").removeClass("alert-success hidden").addClass("alert-danger");
                            $("#salesErrorDiv").html(function(){
                                var addedHtml="";
                                for (var key in response.errors) {
                                    addedHtml += "<p>"+response.errors[key]+"</p>";
                                }
                                return addedHtml;
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
                            <div id = "buttons" class = "text-center">
                            <button type="button" id="siButton" class="btn btn-basic active" style="width:48%;font-size: 20px">Salable Items</button>
                            <button type="button" id="dsButton" class="btn btn-basic" style="width:48%; font-size: 20px">Damaged Salable Items</button>
                        </div>
                            <div id = "siDiv" style = "display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table class="table table-hover table-bordered" style="width:100%" id="dashboardDatatable">
                                    {{--  <thead> 
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Quantity in Stock</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
                                            <th>Add to Cart</th>
                                        </tr>
                                    </thead>  --}}
                                    {{--  <tbody id="dashboardDatatable">  --}}
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id = "siDiv" style = "display: none;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table class="table table-hover table-bordered" style="width:100%" id="">
                                    {{--  <thead> 
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Quantity in Stock</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
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
            </div>
            
            <div class="row" >
                <div class="col-md-12" >
                    <div class="card" >
                        <div class="header"  id="printArea">
                            {!! Form::open(['method'=>'post','id'=>'formSales']) !!}                                
                            <h4 ng-bind="name">Customer Purchase</h4>
                            <div class="row">
                                <div class="col-md-3" >                        
                                        {{Form::label('receiptNumber', 'Receipt Number:')}}
                                        {{Form::number('receiptNumber','',['class'=>'form-control','oninput'=>'enablePrintButton(this)','onchange'=>'saveReceiptNumber(this)'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7" margin >
                                        {{Form::label('customerName', 'Customer Name:')}}
                                        {{Form::text('customerName','',['class'=>'form-control','oninput'=>'enablePrintButton(this)','onchange'=>'saveCustomerName(this)'])}}
                                    </div>
                                    <div class="col-md-4" margin >
                                            {{Form::label('Date', 'Date:')}}
                                            <input type="date" name="Date" id="today"  oninput="enablePrintButton(this)" class="form-control"/>    
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-0" margin>
                                        {{Form::label('address', 'Address:')}}
                                        {{Form::text('address','',['class'=>'form-control','oninput'=>'enablePrintButton(this)','onchange'=>'saveCustomerAddress(this)'])}}
                                        
                                    </div>
                                    {{-- <div class="col-md-2" margin>
                                        <input type="date" name="Date" id="today"  class="form-control"/>
            
                                    </div> --}}
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-md-12 table-responsive">
                                    <table id="cartTable" class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                {{--  <td>Quantity Left</td>  --}}
                                                {{--  <td>Purchase Price</td>  --}}
                                                <th>Price</th>
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
                                                    <button id="printButton" class="btn btn-success" type="button" onclick="printReceipt()" disabled> Print</button>
                                                </div>
                                            </div> 
                                        </div>
                                                <div class="alert alert-success text-center hidden" id="salesErrorDiv">
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
"ajax":  "{{ route('salesAssistant.getItemsSales') }}",
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
        // {
        //     "title": "Purchase Price",
        //     "data": "wholesale_price"
        // },
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
                            
                        
                        ////////////////////
                        $('#dashboardDatatable').DataTable().search(key).draw();
                        //////////////////////
                            var updateTemp = $.parseHTML( myItemJSON.retailPrice );
                            console.log(document.getElementById(myItemJSON.itemId))
                            updateTemp[0].innerHTML=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price if ever the selling price of ITEM changes!
                            updateTemp[1].value=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price if ever the selling price of ITEM changes!
                             console.log(updateTemp[0].outerHTML+updateTemp[1].outerHTML)
                            //  document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML
 
                            //hide row
                            // document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
                            var row = $('#'+myItemJSON.itemId).closest("tr");
                            $('#dashboardDatatable').dataTable().fnDeleteRow( row );

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

                            var temp = document.createElement('div');
                            temp.innerHTML = myItemJSON.salesPrice;  
                            if(totalSalesNgBinds==""){
                                var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");                                
                                // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
                                totalSalesNgBinds += splitBind[0];
                            }else{
                                var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");
                                // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
                                totalSalesNgBinds += "+" + splitBind[0];
                            }


                        }
                    }
                    enablePrintButton();                    
                        ////////////////////
                        $('#dashboardDatatable').DataTable().search("").draw();
                        //////////////////////

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

                var retailPrice = "<p class='form-control' style='color:green; width: 100px;'>" +event.currentTarget.parentNode.previousSibling.innerHTML+ "</p><input type='hidden' name='retailPrices[]' value='" +event.currentTarget.parentNode.previousSibling.innerHTML+ "'> ";
                var temp0 = $compile(retailPrice)($scope);                
                angular.element( lastRow.insertCell(-1) ).append(temp0);    

                var inputNumber = "<input style='width: 100px;' type='number' ng-init='" +itemName+ "=1' name='quantity[]' class='form-control' ng-focus='$event = $event' ng-change='changing($event)'' ng-model='" +itemName + "' min='1' max='" +event.currentTarget.parentNode.parentNode.childNodes[1].innerHTML+ "' required></input>";
                var temp1 = $compile(inputNumber)($scope);
                // var newRow = thatTbody.insertRow(-1);
                // angular.element( newRow.insertCell(-1) ).append(temp);
                angular.element( lastRow.insertCell(-1) ).append(temp1);

                var salesPrice = "<p class='form-control' style='color:green;'ng-init='" +itemName+ "SP=" +event.currentTarget.parentNode.previousSibling.innerHTML+ "' ng-bind='" +itemName+ "SP |number:2'></p><input type='hidden' name='salesPrices[]'>";
                var temp2 = $compile(salesPrice)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp2);

                // var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)' onclick='removeRowInCart(this)'>Remove</button>";
                var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)' >Remove</button><input type='hidden' name='productIds[]' value='"+event.currentTarget.id+"'>";
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
                    itemId: event.currentTarget.getAttribute("id"),
                    action: $(event.currentTarget).closest("tr")[0]['cells'][3].innerHTML,
                };

                var jsonObject = JSON.stringify(itemObject);
                localStorage.setItem(tds[0].innerHTML,jsonObject);


               var totalSalesDiv = document.getElementById("totalSalesDiv");
                var ngBindAttributes = totalSalesDiv.firstChild.getAttribute("ng-bind"); //get ng-bind attribute/s
                totalSalesDiv.innerHTML =""; 
                if(ngBindAttributes==""){
                    var newNgBinds = itemName+"SP";
                }else{
                    var newNgBinds = ngBindAttributes.split(" ")[0] + "+" + itemName+"SP";
                }

                console.log("TScorrect: " + newNgBinds)
                var price = "<p class='form-control' style='color:green' ng-bind='" +newNgBinds+ " |number:2'></p>";
                angular.element( totalSalesDiv ).append( $compile(price)($scope) );


                //remove the row dataTable
                var row = $(event.currentTarget).closest("tr");
                $('#dashboardDatatable').dataTable().fnDeleteRow(row);
                // console.log(row)

            };

            $scope.changing = function(event) {
                // alert("changing!!!");
                // console.log( angular.element(event).attr('class') );
                // console.log( event.currentTarget.getAttribute("class") );

                var item = JSON.parse(localStorage.getItem(event.currentTarget.parentNode.previousElementSibling.previousElementSibling.innerHTML));
                console.log( ($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model") )
                var newQuantityPurchase = $($.parseHTML(item['quantityPurchase'])[0]).attr("ng-init",($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model")+"="+event.currentTarget.value);


                var ngModelName = event.currentTarget.attributes["ng-model"].value;
                // var oldTs = parseInt(document.getElementById("totalSales").innerText);
                var retailPrice = parseInt(event.currentTarget.parentNode.previousSibling.innerText);
                var sellingPrice = ngModelName+"SP";
                $scope[sellingPrice] =  retailPrice * $scope[ngModelName];
                // document.getElementById("salesPriceValue").setAttribute("value",retailPrice * $scope[ngModelName]);
            
               var newSalesPrice = $($.parseHTML(item['salesPrice'])[0]).attr("ng-init", ($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model")+"SP="+ retailPrice * $scope[ngModelName]);


               //remove
               localStorage.removeItem(event.currentTarget.parentNode.previousElementSibling.previousElementSibling.innerHTML);
               //add again
               var itemObject = {
                    item: item['item'],
                    retailPrice: item['retailPrice'],
                    quantityPurchase: newQuantityPurchase[0].outerHTML,
                    salesPrice: newSalesPrice[0].outerHTML,
                    removeButton: item['removeButton'],
                    itemId: item['itemId'],
                    purchasePrice: item['purchasePrice'],
                    action: item['action'],
                };

                var jsonObject = JSON.stringify(itemObject);
                localStorage.setItem(item['item'],jsonObject);
    



          
        
                // $scope.totalSales =  $scope[ngModelName];
                // console.log($scope[sellingPrice])

                // var totalSales = document.getElementById("totalSalesDiv").firstChild.innerText;
                // console.log("totalSales: " +totalSales)
            
            }

            $scope.remove = function(event){
                var data  = $(event.currentTarget.parentNode.parentNode.innerHTML).slice(0,2);
                var temp = JSON.parse(localStorage.getItem(data[0].innerHTML));
                var table = $('#dashboardDatatable').DataTable();
                table.row.add( {
                        "description":  temp['item'],
                        "quantity":  $.parseHTML(temp['quantityPurchase'])[0]['max'],
                        "retail_price": $.parseHTML(temp['retailPrice'])[0].innerHTML,
                        "action":   temp['action']
                    } ).draw();
                localStorage.removeItem(data[0].innerHTML);
                
                event.currentTarget.parentNode.parentNode.remove();
                enablePrintButton();
                
                var thatTable = document.querySelectorAll('#cartTable > tbody > tr')
                var numberOfRows = thatTable.length;
                var ngBinds = "";
                var ngBindsWithoutFormat="";

                if(numberOfRows > 0){
                    for(var i=0; i < numberOfRows; i++){
                        if(ngBinds==""){
                            ngBinds += thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind");
                            ngBindsWithoutFormat += thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind").split(" ")[0];
                        }else{
                            ngBinds += " + " + thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind");
                            ngBindsWithoutFormat += "+" + thatTable[i].childNodes[3].childNodes[0].getAttribute("ng-bind").split(" ")[0];
                        }
                    }
                    var price = "<p class='form-control' style='color:green' ng-bind='" +ngBindsWithoutFormat+ " |number:2'></p>";
                }else{
                    var price = "<p class='form-control' style='color:green' ng-bind></p>";
                }
                // console.log("ngBinds: " + ngBinds)
                // console.log("ngBindsWithoutFormat: "+ngBindsWithoutFormat)
                //update total sales price
                document.getElementById("totalSalesDiv").innerHTML="";
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