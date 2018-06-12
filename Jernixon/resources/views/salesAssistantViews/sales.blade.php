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

@section('angularJsControllerName')
ng-controller="customerPurchase"
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
<style>
        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
        }
        .searchResultDiv {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }
        .searchResultDiv div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff; 
            border-bottom: 1px solid #d4d4d4; 
        }
        .searchResultDiv div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9; 
        }
        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important; 
            color: #ffffff; 
        }
    
    
         /* Popover */
    /* .popover {
        border: 2px dotted red;
    } */
    
    /* Popover Header */
    .popover-title {
        /* background-color: #73AD21;  */
        color: red; 
        /* font-size: 28px; */
        text-align:center;
    }
    
    /* Popover Body */
    .popover-content {
        /* background-color: coral; */
        /* color: #FFFFFF; */
        padding: 20px;
    }
    
    
    /* Popover Arrow */
    .arrow {
        border-right-color: red !important;
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
                            <td class='quantity nl'>"+rows[i].cells[2].lastChild.value+"</td>\
                            <td class='unit nl'></td>\
                            <td class='desc nl'>"+rows[i].cells[0].innerHTML+"</td>\
                            <td class='unitp nl'>"+rows[i].cells[1].innerText+"</td>\
                            <td class='amount nl'>"+rows[i].cells[3].innerText+"</td>\
                        <tr>\
                        ";
                m++;
                
            }else{
                items += "<tr>\
                            <td class='quantity nl'>"+rows[i].cells[2].lastChild.value+"</td>\
                            <td class='unit nl'></td>\
                            <td class='desc nl'>"+rows[i].cells[0].innerHTML+"</td>\
                            <td class='unitp nl'>"+rows[i].cells[1].innerText+"</td>\
                            <td class='amount nl'>"+rows[i].cells[3].innerText+"</td>\
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
                        <div id='rdate' class = 'text-right col-md-4'>"+arrayOfData[3]['value']+"</div>\
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
                        <p style='text-align:right' class='pagebreak'>TOTAL AMOUNT DUE: "+totalSalesPrice+"</p>\
                        <p class='pag'>Page "+(m+1)+" of "+page+" </p>\
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
        if( button.dataset.status === "damaged" ){

            newRow.setAttribute("style","background-color:#ff8080");

        }

        button.parentNode.parentNode.setAttribute("class","hidden");

        enablePrintButton();
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

    function damaged(){
        $('#dsButton').addClass('active');
        $('#siButton').removeClass('active');
        $('#dsDiv').removeClass('hidden');
        $('#siDiv').addClass('hidden');
    }

    function salable(){
        $('#dsButton').removeClass('active');
        $('#siButton').addClass('active');
        $('#dsDiv').addClass('hidden');
        $('#siDiv').removeClass('hidden');
    }

    function searchItem(a){
        a.nextElementSibling.removeAttribute("class");
          if(a.value === ""){
              document.getElementById("searchResultDiv").setAttribute("class","hidden");   
          }
          document.getElementById("searchResultDivTable_filter").setAttribute("class","hidden")
          $('#searchResultDivTable').DataTable().search(a.value).draw();
        
    }

      function checkQuantity(input){
        var errorsDiv = $("#salesErrorDiv p")
        var tempError = "";
        if( parseInt(input.value) > parseInt(input.dataset.max) ){
            input.setAttribute("data-content","Quantity exceeds the available stock on hand, quantity should not exceed "+input.dataset.max+"!");
            $(input).popover('show');
        }else if( parseInt(input.value) <= 0 ){
            input.setAttribute("data-content","Quantity is not sufficient!");
            $(input).popover('show');
        }else{
            $(input).popover('destroy');    
        }

        if( parseInt(document.getElementById("totalSalesDiv").firstChild.children[1].innerHTML) < 0 && parseInt(document.getElementById("discountInput").value) >= 1 ){
            $(document.getElementById("discountInput")).popover('show');
        }else{
            $(document.getElementById("discountInput")).popover('destroy');

        }
      }

      function checkDiscount(input){
          if(input.value < 0){
            input.setAttribute("data-content","Discount should be greater than or equal to 0");
            $(input).popover('show');
          }else if(input.value >10){
            input.setAttribute("data-content","Discount exceeded!");
            $(input).popover('show');  

          }else{
                $(input).popover('destroy');            
          }
      }
    function inputORValue(div){
        document.getElementById("searchORNumberInput").value = div.firstChild.innerHTML;
        document.getElementById("resultORNumberDiv").innerHTML = "";

    }
    function toggleCheckboxWarranty(checkbox){
        if(checkbox.checked){        
            checkbox.setAttribute("name","warranty[]");
            var date = new Date();
            date.setDate(date.getDate() + 1);

            // var newDate = date.getDate()+'-'+ (date.getMonth()+1) +'-'+date.getFullYear();
            var newDate = date.getFullYear() +'-'+ (date.getMonth()+1) +'-'+ date.getDate();
            console.log(newDate);
            checkbox.setAttribute("value",newDate);

        }else{
            checkbox.removeAttribute("name");
        }
    }
    function searchOfficialReceipt(a){
        // document.getElementById("errorDivCreateReturns").innerHTML= "";
		var officialReceipt = a.value;
		var fullRoute = "/salesAssistant/sales/getORNumberInSales/"+officialReceipt;
        if(a.value === ""){
            document.getElementById("resultORNumberDiv").innerHTML ="";
            // $("#returnItemTbody tr").remove();
        }else{
            $.ajax({
                method: 'get',
                //url: 'items/' + document.getElementById("inputItem").value,
                url: fullRoute,
                
                success: function(data){
                    var resultORNumberDiv = document.getElementById("resultORNumberDiv");
                    resultORNumberDiv.innerHTML = "";
                    // var refundORNumberDiv = document.getElementById("refundORNumberDiv");
                    // refundORNumberDiv.innerHTML = "";

                    for (var i = 0;  i< data.length; i++) {
                        var node = document.createElement("DIV");
                        node.setAttribute("onclick","inputORValue(this)")
                        // node.setAttribute("data-modal",a.id)
                        var pElement = document.createElement("P");
                        //add the price
                        //pElement.setAttribute("data-price" , data[i].) 
                        var textNode = document.createTextNode(data[i].or_number);
                        pElement.appendChild(textNode);
                        node.appendChild(pElement);    
                        // if(a.id === "searchORNumberInput"){
                            resultORNumberDiv.appendChild(node);  
                        // }else{
                        //     refundORNumberDiv.appendChild(node);  
                        // }
                    }
                    console.log(data)  
                }
            });

        }
        
    }
    $(document).ready(function(){

        let today = new Date().toISOString().substr(0, 10);
        var d = new Date();
        var hours = "";
        var minutes = "";
        if( parseInt(d.getHours()) < 10  ){
            hours = "0"+d.getHours();
        }else{
            hours = d.getHours();
        }
        if( parseInt(d.getMinutes()) < 10){
            minutes = "0"+d.getMinutes();
        }else{
            minutes = d.getMinutes();
        }
        document.querySelector("#today").value = today+"T"+hours +":"+minutes;
        var t = setInterval(function(){
            var d = new Date();
            var hours = "";
            var minutes = "";
            if( parseInt(d.getHours()) < 10  ){
                hours = "0"+d.getHours();
            }else{
                hours = d.getHours();
            }
            if( parseInt(d.getMinutes()) < 10){
                minutes = "0"+d.getMinutes();
            }else{
                minutes = d.getMinutes();
            }
            document.querySelector("#today").value = today+"T"+hours +":"+minutes;
        },60000)
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
            if(thatTbody.length == 0){
                $("#salesErrorDiv").removeClass("alert-success").addClass("alert-danger");
                    $("#salesErrorDiv").hide(500);
                    $("#salesErrorDiv").removeClass("hidden");
                    $("#salesErrorDiv").slideDown("slow", function() {
                        $("#salesErrorDiv").html(function(){
                            return "<h4>Please add item/s first.</h4>";
                        });
                    });
                    return true;
            }else{
                var check = false;
                for(var i=0; i < $("#cartTbody tr").length ;i++ ){
                    if( ($("#cartTbody tr td:nth-child(1)")[i].firstChild).value <= 0 ){
                        check = true;
                        checkQuantity( $("#cartTbody tr td:nth-child(1)")[i].firstChild );
                        // ($("#cartTbody tr td:nth-child(1)")[i].firstChild).setAttribute("data-content","Quantiity should be greate");
                        // $($("#cartTbody tr td:nth-child(1)")[i].firstChild).popover("show");
                        // $("#salesErrorDiv").hide(500);
                        // $("#salesErrorDiv").removeClass("hidden");
                        // $("#salesErrorDiv").slideDown("slow", function() {
                        //     $("#salesErrorDiv").html(function(){
                        //         return "<h4>Please fill up a valid quantity.</h4>";
                        //     });
                        // });
                    }
                }
                if(check){
                    return true;
                }
            }

            $.ajax({
                type:'POST',
                // url:'admin/storeNewItem',
                url: "{{route('salesAssistant.createSales')}}",

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
                        // var itemId = $("#cartTbody tr td:nth-child(5) button");
                        // for(var i = 0; i<itemId.length; i++){
                        //     document.getElementById(itemId[i].getAttribute("data-item-id")).removeAttribute("style");
                        // }

                        //remove all rows in cart
                        $("#cartTbody tr").remove();
                        $("#salesErrorDiv p").remove();
                        $("#salesErrorDiv").removeClass("alert-danger hidden").addClass("alert-success")
                        // .addClass("alert-success")
                            .html("<h3>Transaction successful</h3>");
                        $("#salesErrorDiv").slideDown("slow")
                            .delay(1000)                        
                            .hide(1500);

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
                        $("#salesErrorDiv").removeClass("alert-success").addClass("alert-danger");
                    $("#salesErrorDiv").hide(500);
                    $("#salesErrorDiv").removeClass("hidden");
                    $("#salesErrorDiv").slideDown("slow", function() {
                        $("#salesErrorDiv").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });
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
{{-- <div class="row" >
<div class="col-md-12" >
    <div class="card" >
        <div class="header">
            <div class="row">
                <div id = "siDiv" style = "">
                    <div class="content table-responsive table-full-width table-stripped">
                        <table class="table table-hover table-bordered" style="width:100%" id="dashboardDatatable">
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                </div>
                <div id = "dsDiv" class="hidden">
                    <div class="content table-responsive table-full-width table-stripped">
                        <table class="table table-hover table-bordered" style="width:100%" id="damageDatatable">
                            
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                    <div class="col-md-3" >                        
                        {{Form::label('oldReceiptNumber', 'Old Receipt Number:')}}
                        {{-- {{Form::number('oldReceiptNumber','',['class'=>'form-control'])}} --}}
                        <input autocomplete="off" id="searchORNumberInput" type="number" onkeyup="searchOfficialReceipt(this)" name="oldORNumber" class="form-control border-input">
                        <div id="resultORNumberDiv" class="searchResultDiv">
               </div>
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
                                <input type="datetime-local" name="Date" id="today"  oninput="enablePrintButton(this)"  class="form-control"/>    
                        </div>
                      
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-0" margin>
                            {{Form::label('address', 'Address:')}}
                            {{Form::text('address','',['class'=>'form-control','oninput'=>'enablePrintButton(this)','onchange'=>'saveCustomerAddress(this)'])}}
                            
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-0" margin> --}}
                            {{-- {{Form::label('address', 'Address:')}} --}}
                            {{-- {{Form::text('searchItem','',['class'=>'form-control','onkeyup'=>'searchItem(this)'])}} --}}
                            <div class="autocomplete" style="width:100%;">        
                                    <input autocomplete="off" type="search" id="searchItemInput" onkeyup="searchItem(this)" class="form-control border-input search" placeholder="&#xF002 Enter an item name">
                                    <div id="searchResultDiv" class="searchResultDiv hidden">
                                        <table class="table table-hover table-bordered" style="width:100%" id="searchResultDivTable">
                                            <tbody>            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        {{-- </div>
                    </div>
                </div> --}}
                
                <div class="row" > 
                    <div class="col-md-12 table-responsive">
                        <table id="cartTable" class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                            <thead>
                                <tr>
                                    <th>Qty.</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                    <th>Warranty </th>
                                    
                                </tr> 

                            </thead>
                            <tbody id="cartTbody" >
                                {{--  <td><input type='number' value='1' min='1' ng-model='newQuantity' ng-change='myFunction()'></td>  --}}
                                {{--  <tr ng-repeat="user in users">
                                <td ng-bind="$index + 1"></td>
                                <td ng-bind="user.fullname"></td>
                                <td ng-bind="user.email"></td>
                                </tr>  --}}
                            </tbody>
                        </table>
                        <div class="form-group">
                                <div class="row" style = "margin-bottom: 10px;">
                                        <div class="col-md-7">
                                            
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <label>Original amount:</label>
                                        </div>
                                        <div class="col-md-3" id="originalAmountDiv">
                                        </div>
                                            
                                    </div>
                            <div class="row">
                                    <div class="col-md-7">
                                        
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <label>Discount:</label>
                                    </div>
                                    <div class="col-md-3" id="discountDiv">
                                    </div>
                                    
                                </div>
                            <div class="row">
                                <div class="col-md-7">
                                    
                                </div>
                                <div class="col-md-2 text-right">
                                    <label>Total Amount Due:</label>
                                </div>
                                <div class="col-md-3" id="totalSalesDiv">
                                    <p class="form-control" id="totalSales" ng-bind="" style="float: right;"></p>
                                </div>
                                <div class="text-right">                                           
                                    <div class="col-md-12">   
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <button id="printButton" class="btn btn-success" type="button" onclick="printReceipt()" disabled> Print</button>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger text-center hidden" id="salesErrorDiv">
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

            // $('#dashboardDatatable').DataTable({
            //     // "processing": true,
            //     // "serverSide": true,
            //     "ajax":  "{{ route('salesAssistant.getItemsSales') }}",
            //     // data: [{
            //     //     "LastName": "Doe",
            //     //     "Link": "<button type=\"button\" ng-click=\"Ctrl.addButton()\">Test Alert</a>"
            //     // }],
            //     // columns: [{
            //         //     "title": "Last Name",
            //         //     "data": "LastName"
            //         // }, {
            //             //     "title": "Actions",
            //             //     "data": "Link"
            //             // }],
                        
                
                
            //     columns:[{
            //         "title": "Description",
            //         "data": "description"
            //     },
            //     // {
            //     //     "title": "Category",
            //     //     "data": "status"
            //     // },
            //     {
            //         "title": "Qty in Stock",
            //         "data": "quantity"
            //     },
            //     // {
            //     //     "title": "Purchase Price",
            //     //     "data": "wholesale_price"
            //     // },
            //     {
            //         "title": "Selling Price",
            //         "data": "retail_price"
            //     },
            //     {
            //         "title": "Add Item",
            //         "data": "action"
            //     }],
        
            //     createdRow: function(row, data, dataIndex) {
            //         $compile(angular.element(row).contents())($scope);
            //     },

            //     //fetch the items in localStorage after the dataTables initialization
            //     "initComplete": function(settings, json) {
            //         var len=localStorage.length;
            //         var thatTbody = document.getElementById("cartTbody");
            //         document.getElementById("receiptNumber").value = localStorage.getItem("receiptNumber");
            //         document.getElementById("customerName").value = localStorage.getItem("customerName");
            //         document.getElementById("address").value = localStorage.getItem("customerAddress");
            //         var totalSalesNgBinds ="";
            //         for(var i=0; i<len; i++) {

            //             var key = localStorage.key(i);
            //             var value = localStorage[key];
            //             if(value.includes("item")){
            //                 if( !key.includes("damaged") ){
            //                     var myItemJSON = JSON.parse(localStorage.getItem(key));            
                                
                            
            //                     ////////////////////
            //                     $('#dashboardDatatable').DataTable().search(key).draw();
            //                     //////////////////////
            //                         var updateTemp = $.parseHTML( myItemJSON.retailPrice );
            //                         console.log(document.getElementById(myItemJSON.itemId))
            //                         updateTemp[0].innerHTML=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price if ever the selling price of ITEM changes!
            //                         updateTemp[1].value=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price if ever the selling price of ITEM changes!
            //                         console.log(updateTemp[0].outerHTML+updateTemp[1].outerHTML)
            //                     var sellingPrice = document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML;
                                    
            //                         //  document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML
        
            //                         //hide row
            //                         // document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
            //                         var row = $('#'+myItemJSON.itemId).closest("tr");
            //                         $('#dashboardDatatable').dataTable().fnDeleteRow( row );

            //                         var newRow = thatTbody.insertRow(-1);
            //                         newRow.insertCell(-1).innerHTML = myItemJSON.item ;
            //                         // newRow.insertCell(-1).innerHTML = myItemJSON.quantityLeft;
            //                         // newRow.insertCell(-1).innerHTML = myItemJSON.wholeSalePrice;

            //                         // var salesPrice = "<p class='form-control style='color:green' ng-bind='" +itemName+ "SP'></p>";
            //                         // var temp2 = $compile(salesPrice)($scope);
            //                         // angular.element( lastRow.insertCell(-1) ).append(temp2);

            //                         //newRow.insertCell(-1).innerHTML = myItemJSON.retailPrice;
            //                         angular.element( newRow.insertCell(-1) ).append( $compile(updateTemp[0].outerHTML+updateTemp[1].outerHTML)($scope) );

            //                         //newRow.insertCell(-1).innerHTML = myItemJSON.quantityPurchase;
            //                         angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.quantityPurchase)($scope) );

            //                          var ngModelName = ($.parseHTML(myItemJSON['quantityPurchase'])[0]).getAttribute("ng-model");
            //                         var retailPrice = parseInt(sellingPrice);                                
            //                         var newSalesPrice = $($.parseHTML(myItemJSON['salesPrice'])[0]).attr("ng-init", ($.parseHTML(myItemJSON['quantityPurchase'])[0]).getAttribute("ng-model")+"SP="+ retailPrice * $scope[ngModelName]);
            //                         // angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.salesPrice)($scope) );
            //                         angular.element( newRow.insertCell(-1) ).append( $compile(newSalesPrice)($scope) );

            //                         angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.removeButton)($scope) );
            //                         // newRow.insertCell(-1).innerHTML = myItemJSON.removeButton;
            //                         // newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +myItemJSON.itemId+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

            //                         var temp = document.createElement('div');
            //                         temp.innerHTML = myItemJSON.salesPrice;  
            //                         if(totalSalesNgBinds==""){
            //                             var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");                                
            //                             // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
            //                             totalSalesNgBinds += splitBind[0];
            //                         }else{
            //                             var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");
            //                             // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
            //                             totalSalesNgBinds += "+" + splitBind[0];
            //                         }
            //                 }


            //             }
            //         }
            //         enablePrintButton();                    
            //             ////////////////////
            //             $('#dashboardDatatable').DataTable().search("").draw();
            //             //////////////////////

            //         //initialize totalSales
            //         document.getElementById("totalSalesDiv").innerHTML="";
            //         if(totalSalesNgBinds === ""){
            //             var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p>";
            //         }else{
            //             var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ " |number:2'></p>";
            //         }
            //         angular.element( totalSalesDiv ).append( $compile(price)($scope) );

                  
            //     }


            // });

        //      $('#damageDatatable').DataTable({
               
        //        "ajax":  "{{ route('salesAssistant.dashboard.getDamaged') }}",
        //        columns:[{
        //            "title": "Damaged Salable Item",
        //            "data": "description"
        //            },     
        //            {
        //                "title": "Qty of Damaged Item",
        //                "data": "quantity"
        //            },
        //            {
        //                "title": "Purchase Price",
        //                "data": "wholesale_price"
        //            },
        //            {
        //                "title": "Damaged Item Selling Price",
        //                "data": "damaged_selling_price"
        //            },
        //            {
        //                "title": "Add Item",
        //                "data": "action"
        //            }
        //            ],

        //        createdRow: function(row, data, dataIndex) {
        //            $compile(angular.element(row).contents())($scope);
        //        },
        //        "initComplete": function(settings, json) {
        //            var len=localStorage.length;    
        //            var thatTbody = document.getElementById("cartTbody");                    
        //            var totalSalesNgBinds ="";
        //            for(var i=0; i<len; i++) {

        //                var key = localStorage.key(i);
        //                var value = localStorage[key];
        //                if(value.includes("item")){
        //                    if( key.includes("damaged") ){
        //                        var myItemJSON = JSON.parse(localStorage.getItem(key));            
                               
        //                        ////////////////////
        //                        $('#damageDatatable').DataTable().search(key.slice(9)).draw();
        //                    //////////////////////
        //                        var updateTemp = $.parseHTML( myItemJSON.retailPrice );
        //                        updateTemp[0].innerHTML=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
        //                        updateTemp[1].value=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
        //                        console.log(updateTemp[0].outerHTML+updateTemp[1].outerHTML)
        //                        //  document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML
   
        //                        //hide row
        //                        // document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
        //                        var row = $('#'+myItemJSON.itemId).closest("tr");
        //                        $('#damageDatatable').dataTable().fnDeleteRow( row );

        //                        var newRow = thatTbody.insertRow(-1);
        //                        newRow.setAttribute("style","background-color:#ff8080");                                
        //                        newRow.insertCell(-1).innerHTML = myItemJSON.item ;
        //                        // newRow.insertCell(-1).innerHTML = myItemJSON.quantityLeft;
        //                        // newRow.insertCell(-1).innerHTML = myItemJSON.wholeSalePrice;

        //                        // var salesPrice = "<p class='form-control style='color:green' ng-bind='" +itemName+ "SP'></p>";
        //                        // var temp2 = $compile(salesPrice)($scope);
        //                        // angular.element( lastRow.insertCell(-1) ).append(temp2);

        //                        //newRow.insertCell(-1).innerHTML = myItemJSON.retailPrice;
        //                        angular.element( newRow.insertCell(-1) ).append( $compile(updateTemp[0].outerHTML+updateTemp[1].outerHTML)($scope) );

        //                        //newRow.insertCell(-1).innerHTML = myItemJSON.quantityPurchase;
        //                        angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.quantityPurchase)($scope) );

        //                        //newRow.insertCell(-1).innerHTML = myItemJSON.salesPrice;
        //                        angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.salesPrice)($scope) );

        //                        angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.removeButton)($scope) );
        //                        // newRow.insertCell(-1).innerHTML = myItemJSON.removeButton;
        //                        // newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' data-item-id='" +myItemJSON.itemId+ "' onclick='removeRowInCart(this)'>Remove</button></td>";

        //                        var temp = document.createElement('div');
        //                        temp.innerHTML = myItemJSON.salesPrice;  
        //                        if(totalSalesNgBinds==""){
        //                            var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");                                
        //                            // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
        //                            totalSalesNgBinds += splitBind[0];
        //                        }else{
        //                            var splitBind = temp.firstChild.getAttribute("ng-bind").split(" ");
        //                            // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
        //                            totalSalesNgBinds += "+" + splitBind[0];
        //                        }
        //                    }else{
        //                        var myItemJSON = JSON.parse(localStorage.getItem(key));  
        //                        var temp2 = document.createElement('div');
        //                        temp2.innerHTML = myItemJSON.salesPrice;  
        //                        if(totalSalesNgBinds==""){
        //                            var splitBind = temp2.firstChild.getAttribute("ng-bind").split(" ");                                
        //                            // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
        //                            totalSalesNgBinds += splitBind[0];
        //                        }else{
        //                            var splitBind = temp2.firstChild.getAttribute("ng-bind").split(" ");
        //                            // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
        //                            totalSalesNgBinds += "+" + splitBind[0];
        //                        }
        //                    }

        //                }
        //            }
        //                ////////////////////
        //                $('#damageDatatable').DataTable().search("").draw();
        //                //////////////////////

        //            //initialize totalSales
        //            // if( document.getElementById("totalSalesDiv").firstElementChild.getAttribute("ng-bind") === "" ){
        //            //     console.log(document.getElementById("totalSalesDiv").firstElementChild.getAttribute("ng-bind"))
        //            //     // document.getElementById("totalSalesDiv").innerHTML="";
        //            //     if(totalSalesNgBinds === ""){
        //            //         var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p>";
        //            //     }else{
        //            //         var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ " |number:2'></p>";
        //            //     }
        //            // }else{
        //            //     var temp3 = document.getElementById("totalSalesDiv").firstElementChild.getAttribute("ng-bind").split(" ")[0] +"+"+totalSalesNgBinds;
        //            //     console.log(document.getElementById("totalSalesDiv").firstElementChild.getAttribute("ng-bind").split(" ")[0] +"+"+totalSalesNgBinds)
        //            //     var price = "<p class='form-control' style='color:green' ng-bind='" +temp3+ " |number:2'></p>";
        //            // }

                   
        //             document.getElementById("totalSalesDiv").innerHTML="";
        //            if(totalSalesNgBinds === ""){
        //                var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p>";
        //            }else{
        //                var price = "<p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ " |number:2'></p>";
        //            }

        //            angular.element( totalSalesDiv ).append( $compile(price)($scope) );


        //        }

        //    });
        $('#searchResultDivTable').DataTable({
                // "processing": true,
                // "serverSide": true,
                // "bFilter": false,
                // "order": [[1, 'asc']],
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
                            {
                                "title": "Model",
                                "data": "modelname"
                            },
                            {
                                "title": "Category",
                                "data": "categoryname"
                            },
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
                                "data": "retail_price", className: 'text-right'
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
                    document.getElementById("receiptNumber").value = localStorage.getItem("receiptNumber");
                    document.getElementById("customerName").value = localStorage.getItem("customerName");
                    document.getElementById("address").value = localStorage.getItem("customerAddress");
                    var totalSalesNgBinds ="";
                    for(var i=0; i<len; i++) {
                        var key = localStorage.key(i);
                        var value = localStorage[key];
                        if(value.includes("item")){
                            if( !key.includes("damaged") ){
                                var myItemJSON = JSON.parse(localStorage.getItem(key));            
                                
                                ////////////////////
                                $('#searchResultDivTable').DataTable().search(key).draw();
                            //////////////////////
                                var updateTemp = $.parseHTML( myItemJSON.retailPrice );
                                updateTemp[0].children[1].innerHTML=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
                                updateTemp[1].value=document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML; //update selling price
                                // console.log(updateTemp[0].outerHTML+updateTemp[1].outerHTML)
                                var sellingPrice = document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML;
                                //  document.getElementById(myItemJSON.itemId).parentNode.previousSibling.innerHTML
    
                                //hide row
                                // document.getElementById(myItemJSON.itemId).parentNode.parentNode.setAttribute("class","hidden");
                                var row = $('#'+myItemJSON.itemId).closest("tr");
                                $('#searchResultDivTable').dataTable().fnDeleteRow( row );

                                var newRow = thatTbody.insertRow(-1);
                                angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.quantityPurchase)($scope) );

                                newRow.insertCell(-1).innerHTML = myItemJSON.unit ;

                                newRow.insertCell(-1).innerHTML = myItemJSON.item ;
                             
                                angular.element( newRow.insertCell(-1) ).append( $compile(updateTemp[0].outerHTML+updateTemp[1].outerHTML)($scope) );

                                var ngModelName = ($.parseHTML(myItemJSON['quantityPurchase'])[0]).getAttribute("ng-model");
                                var tempSalesPrice = $.parseHTML(myItemJSON.salesPrice);
                                var retailPrice = parseInt(sellingPrice);    
                                var newSalesPrice = $($.parseHTML(myItemJSON['salesPrice'])[0].children[1]).attr("ng-init", ($.parseHTML(myItemJSON['quantityPurchase'])[0]).getAttribute("ng-model")+"SP="+ retailPrice * $scope[ngModelName]);
                                // var salesPriceSpanElement = ($.parseHTML( myItemJSON.salesPrice)[0].children[0]);
                                var changeSalesPricePElement = (tempSalesPrice[0].children[1]).outerHTML=newSalesPrice[0].outerHTML;
                                // console.log( $.parseHTML(myItemJSON.salesPrice)[0].childNodes[1].outerHTML="newSalesPrice" )
                                angular.element( newRow.insertCell(-1) ).append( $compile(tempSalesPrice[0].outerHTML + ($.parseHTML(myItemJSON.salesPrice))[1].outerHTML)($scope) ); 

                                angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.removeButton)($scope) );

                                angular.element( newRow.insertCell(-1) ).append( $compile(myItemJSON.warranty)($scope) );
                                

                                var temp = document.createElement('div');
                                temp.innerHTML = myItemJSON.salesPrice;  
                                // console.log(temp)
                                if(totalSalesNgBinds==""){
                                    var splitBind = temp.firstChild.childNodes[1].getAttribute("ng-bind").split(" ");                                
                                    // totalSalesNgBinds += temp.firstChild.getAttribute("ng-bind");
                                    totalSalesNgBinds += splitBind[0];
                                }else{
                                    var splitBind = temp.firstChild.childNodes[1].getAttribute("ng-bind").split(" ");
                                    // totalSalesNgBinds += "+ " + temp.firstChild.getAttribute("ng-bind");
                                    totalSalesNgBinds += "+" + splitBind[0];
                                }
                            }

                        }
                    }
                    enablePrintButton();
                        ////////////////////
                        $('#searchResultDivTable').DataTable().search("").draw();
                        //////////////////////

                    
                    //initialize totalSales
                    document.getElementById("totalSalesDiv").innerHTML="";
                    document.getElementById("discountDiv").innerHTML="";
                    document.getElementById("originalAmountDiv").innerHTML="";                    

                    if(totalSalesNgBinds === ""){
                        var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p></div>";
                        var originalPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control' style='color:green' ng-bind='" +totalSalesNgBinds+ "'></p></div>";
                    }else{
                        // var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control' style='color:green' ng-bind='(" +totalSalesNgBinds+ ")-discountValue |number:2'></p></div>";
                        var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +totalSalesNgBinds+ ")- (("+totalSalesNgBinds+")*(discountValue/100)) |number:2'></p></div>";
                        var originalPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +totalSalesNgBinds+ ") |number:2'></p></div>";                   
                    }
                    angular.element( originalAmountDiv ).append( $compile(originalPrice)($scope) );
                    
                    angular.element( totalSalesDiv ).append( $compile(price)($scope) );

                    // var discountInput = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><input type='number' onchange='checkDiscount(this)' trigger='manual' id='discountInput' data-toggle='popover'  placement='top' title='Error' data-content='wala na pong kita.' style='color:red' ng-model='discountValue' class='form-control'></div>";
                    var discountInput = "<div class = 'input-group'><span class = 'input-group-addon'>%</span><input type='number' ng-init='discountValue =0' onchange='checkDiscount(this)' trigger='manual' id='discountInput' data-toggle='popover'  placement='top' title='Error' data-content='wala na pong kita.' style='color:red' ng-model='discountValue' class='form-control'></div>";                    
                    angular.element( discountDiv ).append( $compile(discountInput)($scope) );


                }



        });

            $scope.addButton = function(event) {
                document.getElementById("searchResultDiv").setAttribute("class","hidden");   
                // document.getElementById("searchResultDivDamaged").setAttribute("class","hidden");   
                document.getElementById("searchItemInput").value = "";
                var thatTbody = document.getElementById("cartTbody");
                var newRow = thatTbody.insertRow(-1);

                var thatTable = document.getElementById("cartTable");
                var numberOfRows = thatTable.rows.length;
                var lastRow = thatTable.rows[numberOfRows-1];
                 var itemDescription = event.currentTarget.parentNode.parentNode.firstChild.innerHTML;
                var itemName = itemDescription.replace(/\s/g,'').replace(/-/g,'').replace(/\//g,'').replace(/\./g,'').replace(/\+/g,'');

                var inputNumber = "<input style='width: 100px;' trigger='manual' placement='top' data-toggle='popover' title='Error' data-content='Exceeded' type='number' ng-init='" +itemName+ " =1' name='quantity[]' onchange='checkQuantity(this)' class='form-control' ng-focus='$event = $event' ng-change='changing($event)' ng-model='" +itemName + "' data-max='" +event.currentTarget.parentNode.previousElementSibling.previousElementSibling.innerHTML+ "' required></input>";
                var temp1 = $compile(inputNumber)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp1);

                var unit = "<select class='form-control' name='unit[]' > <option class='form-control'  value='pcs'>Pcs</option><option class='form-control'  value='sets'>Sets</option></select>";
                angular.element( lastRow.insertCell(-1) ).append(unit);

                angular.element( lastRow.insertCell(-1) ).append(itemDescription);

                var retailPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green; width: 100px;'>" +event.currentTarget.parentNode.previousSibling.innerHTML+ "</p></div><input type='hidden' name='retailPrices[]' value='" +event.currentTarget.parentNode.previousSibling.innerHTML+ "'><input type='hidden' name='description[]' value='" +event.currentTarget.parentNode.parentNode.firstChild.innerHTML+ "'>";
                var temp0 = $compile(retailPrice)($scope);                
                angular.element( lastRow.insertCell(-1) ).append(temp0);
            
                 var salesPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green;' ng-init='" +itemName+ "SP=" +event.currentTarget.parentNode.previousSibling.innerHTML+ "' ng-bind='" +itemName+ "SP |number:2'></p></div><input  type='hidden' name='salesPrices[]' ng-value='" +itemName+ "SP'>";               
                var temp2 = $compile(salesPrice)($scope); 
                angular.element( lastRow.insertCell(-1) ).append(temp2);

                var removeButton = "<button class='btn btn-danger' data-item-id='" +event.currentTarget.id+ "' ng-click='remove($event)'>Remove</button><input type='hidden' name='productIds[]' value='"+event.currentTarget.id+"'>";
                var temp3 = $compile(removeButton)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp3);

                var warrantyInput = "<input type='checkbox' class='form-control' onchange='toggleCheckboxWarranty(this)'>"
                angular.element( lastRow.insertCell(-1) ).append(warrantyInput);


                //store in localStorage
                var tds  = $(lastRow.innerHTML).slice(0);   
                // console.log(tds[4].childNodes[0].outerHTML + tds[4].childNodes[1].outerHTML)  
                var itemObject = {
                    item: tds[2].innerHTML,
                    // quantityLeft: tds[1].innerHTML,
                    // wholeSalePrice: tds[2].innerHTML,    
                    retailPrice: tds[3].childNodes[0].outerHTML + tds[3].childNodes[1].outerHTML+tds[3].childNodes[2].outerHTML,
                    quantityPurchase: tds[0].firstChild.outerHTML,
                    salesPrice: tds[4].childNodes[0].outerHTML + tds[4].childNodes[1].outerHTML,
                    removeButton: tds[5].childNodes[0].outerHTML + tds[5].childNodes[1].outerHTML,
                    itemId: event.currentTarget.getAttribute("id"),
                    purchasePrice: $(event.currentTarget).closest("tr")[0]['cells'][4].innerHTML,
                    action: $(event.currentTarget).closest("tr")[0]['cells'][5].innerHTML,
                    unit: tds[1].firstChild.outerHTML,
                    model: event.currentTarget.parentNode.parentNode.childNodes[1].innerHTML,
                    category: event.currentTarget.parentNode.parentNode.childNodes[2].innerHTML,
                    warranty:  tds[6].firstChild.outerHTML               
                };

                var jsonObject = JSON.stringify(itemObject);
                    localStorage.setItem(tds[2].innerHTML,jsonObject);

              
                var totalSalesDiv = document.getElementById("totalSalesDiv");
                var originalAmountDiv = document.getElementById("originalAmountDiv");                
                // var ngBindAttributes = (totalSalesDiv.firstChild.children[1].getAttribute("ng-bind")).replace("(",""); //get ng-bind attribute/s
                var ngBindAttributes = totalSalesDiv.firstChild.children[1].getAttribute("ng-bind"); //get ng-bind attribute/s
                console.log(ngBindAttributes)
                totalSalesDiv.innerHTML =""; 
                originalAmountDiv.innerHTML ="";                 
                if(ngBindAttributes==""){
                    if( event.currentTarget.dataset.status === "damaged" ){//if damaged
                        var newNgBindsTemp = "damaged"+itemName+"SP";
                        var newNgBinds = "("+newNgBindsTemp+")";                        
                    }else{
                        var newNgBindsTemp = itemName+"SP";
                        var newNgBinds = "("+newNgBindsTemp+")";
                        
                    }
                }else{
                    if( event.currentTarget.dataset.status === "damaged" ){//if damaged
                        var newNgBindsTemp = (ngBindAttributes.split("-")[0]).replace("(","").replace(")","") + "+damaged" + itemName+"SP";
                        var newNgBinds = "("+newNgBindsTemp+")";
                        // var newNgBinds = ngBindAttributes.split(" ")[0] + "+damaged" + itemName+"SP";
                    }else{
                        // var newNgBindsTemp = (ngBindAttributes.split(" ")[0]).replace(")-discountValue","") + "+" + itemName+"SP";
                        var newNgBindsTemp = (ngBindAttributes.split("-")[0]).replace("(","").replace(")","") + "+" + itemName+"SP";
                        var newNgBinds = "("+newNgBindsTemp+")";
                    }
                }

                console.log("TScorrect: " + newNgBinds)
                var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +newNgBinds+ "- ("+newNgBinds+"*(discountValue/100)) |number:2'></p></div>";
                // var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +newNgBinds+ "-discountValue |number:2'></p></div>";
                angular.element( totalSalesDiv ).append( $compile(price)($scope) );

                var originalPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +newNgBinds+ " |number:2'></p></div>";
                angular.element( originalAmountDiv ).append( $compile(originalPrice)($scope) );

                //remove the row dataTable
                var row = $(event.currentTarget).closest("tr");
                    $('#searchResultDivTable').dataTable().fnDeleteRow(row);

            };

            $scope.changing = function(event) {
                var item = JSON.parse(localStorage.getItem(event.currentTarget.parentNode.nextElementSibling.nextElementSibling.innerHTML));
                // console.log( ($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model") )
                if( parseInt(event.currentTarget.value) <= parseInt(event.currentTarget.dataset.max) && parseInt(event.currentTarget.value) > 0 ){
                    var newQuantityPurchase = $($.parseHTML(item['quantityPurchase'])[0]).attr("ng-init",($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model")+"="+event.currentTarget.value);
                }else{
                    var newQuantityPurchase =  $($.parseHTML(item['quantityPurchase'])[0]);
                }

                var ngModelName = event.currentTarget.attributes["ng-model"].value;
                var retailPrice = parseInt(event.currentTarget.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstChild.children[1].innerText);
                var sellingPrice = ngModelName+"SP";
                $scope[sellingPrice] =  retailPrice * $scope[ngModelName];
                // document.getElementById("salesPriceValue").setAttribute("value",retailPrice * $scope[ngModelName]);
            
               var newSalesPrice = $($.parseHTML(item['salesPrice'])[0]).attr("ng-init", ($.parseHTML(item['quantityPurchase'])[0]).getAttribute("ng-model")+"SP="+ retailPrice * $scope[ngModelName]);
                var salesPriceInput = ($.parseHTML(item.salesPrice))[1].outerHTML;

               //remove
                localStorage.removeItem(event.currentTarget.parentNode.nextElementSibling.nextElementSibling.innerHTML);

               //add again
               var itemObject = {
                    item: item['item'],
                    retailPrice: item['retailPrice'],
                    quantityPurchase: newQuantityPurchase[0].outerHTML,
                    salesPrice: newSalesPrice[0].outerHTML + salesPriceInput,
                    removeButton: item['removeButton'],
                    itemId: item['itemId'],
                    purchasePrice: item['purchasePrice'],
                    action: item['action'],
                    unit: item['unit'],
                    model: item['model'],
                    category: item['category']
                };

                var jsonObject = JSON.stringify(itemObject);
                    localStorage.setItem(item['item'],jsonObject);
        
            }

            $scope.remove = function(event){
                var data  = $(event.currentTarget.parentNode.parentNode.innerHTML).slice(0);
                    var temp = JSON.parse(localStorage.getItem(data[2].innerHTML));
                    var table = $('#searchResultDivTable').DataTable();
                    table.row.add( {
                            "description":  temp['item'],
                            "modelname":  temp['model'],
                            "categoryname":  temp['category'],
                            "quantity":  ($.parseHTML(temp['quantityPurchase'])[0]).dataset.max,
                            "wholesale_price": temp['purchasePrice'],
                            "retail_price": $.parseHTML(temp['retailPrice'])[0].children[1].innerHTML,
                            "action": temp['action']
                        } ).draw();
                
  
                    localStorage.removeItem(data[2].innerHTML);
                
                
                event.currentTarget.parentNode.parentNode.remove();
                enablePrintButton();
                
                var thatTable = document.querySelectorAll('#cartTable > tbody > tr')
                var numberOfRows = thatTable.length;
                var ngBinds = "";
                var ngBindsWithoutFormat="";

                if(numberOfRows > 0){
                    for(var i=0; i < numberOfRows; i++){
                        if(ngBinds==""){
                            ngBinds += thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind");
                            ngBindsWithoutFormat += thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind").split(" ")[0];
                        }else{
                            ngBinds += " + " + thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind");
                            ngBindsWithoutFormat += "+" + thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind").split(" ")[0];
                        }
                    }
                    var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +ngBindsWithoutFormat+ ")- (("+ngBindsWithoutFormat+")*(discountValue/100)) |number:2'></p></div>";        
                    var originalPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +ngBindsWithoutFormat+ ") |number:2'></p></div>";               
               
               }else{
                    var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind></p><div>";
                    var originalPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind></p><div>";                
                }

                document.getElementById("totalSalesDiv").innerHTML="";
                angular.element( totalSalesDiv ).append( $compile(price)($scope) );

                document.getElementById("originalAmountDiv").innerHTML="";
                angular.element( originalAmountDiv ).append( $compile(originalPrice)($scope) );
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