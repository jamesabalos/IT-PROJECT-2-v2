@extends('layouts.navbar')
@section('returns_link')
class="active"
@endsection

@section('onload')
onload="refresh()"
@endsection

@section('linkName')
<div class="alert alert-success hidden" id="successDiv">

</div>

<h3><i class="fa fa-mail-reply" style="margin-right: 20px"></i>Returns</h3>
@endsection
{{--  @section('ng-app')
ng-app="ourAngularJsApp"
@endsection  --}}


@section('headScript')
{{--  <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>  --}}
{{--  <link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>  --}}

<!--jquery-->
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
{{--  plugin DataTable  --}}
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
{{--  <link href="{{asset('assets/css/jquery.dataTables.css')}}" rel="stylesheet"/ comment>  --}}

<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>

{{--  <script src="{{asset('assets/js/DataTables/dataTables.js')}}"></script comment>  --}}
    <link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
        {{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
         <script src="{{asset('assets/js/bbccc/dataTables.buttons.min.js')}}"></script>
         <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
         {{--  <script src="{{asset('assets/js/DataTables/Buttons-1.5.1/js/buttons.html5.js')}}"></script>  --}}
         <script src="{{asset('assets/js/jszip.min.js')}}"></script>
         {{--  pdf    --}}
             <script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
    {{--  <script src="{{asset('assets/js/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script comment>  --}}
      <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
      <script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
      <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>


      <script>

          function removeRow(a){
          $(a.parentNode.parentNode).hide(500,function(){
              this.remove();  
          });
          // a.parentNode.parentNode.remove();

      }

      function addRow(divElement){
          var items =[];
          var thatTbody = $("#inExchangeTbody tr td:first-child");

          for (var i = 0; i < thatTbody.length; i++) {
              // items[i] = thatTbody[i].innerHTML;
              items[i] = thatTbody[i].childNodes[0].innerHTML;            
              // console.log(thatTbody[i].childNodes[0].value)
              // items[i] = thatTbody[i].childNodes[0].value;
          }     
          if( items.indexOf(divElement.firstChild.innerHTML) == -1 ){ //if there is not yet in the table
              var thatTable = document.getElementById("inExchangeTbody");
              var newRow = thatTable.insertRow(-1);
              newRow.insertCell(-1).innerHTML = "<td><p>"+divElement.firstChild.innerHTML+"</p><input type='hidden' class='form-control' name='exchangeItemName[]' value='" +divElement.firstChild.innerHTML+ "'></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' name='exchangeQuantity[]' min='1' max='" +divElement.dataset.quantity+ "'class='form-control'></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' name='price[]' min='1' value='" +divElement.dataset.price+ "'class='form-control' disabled></td>";
              newRow.insertCell(-1).innerHTML = "<td><button type='button' onclick='removeRow(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";

          }

          document.getElementById("searchItemInput").value = "";
          document.getElementById("searchResultDiv").innerHTML = "";

      }

      function addReturnItem(ORNumber){
          var items =[];
          var thatTbody = $("#returnItemTbody tr td:first-child");

          $.ajax({
              method: 'get',
              url: "{{route('salesAssistant.getORNumberItems')}}",
              data:{
                  'ORNumber': ORNumber,
              },        
              success: function(data){
                  $("#returnItemTbody tr").remove();

                  var modalReturnItemTbody = document.getElementById("returnItemTbody");
                  for(var i = 0; i < data.length; i++){
                      var newRow = modalReturnItemTbody.insertRow(-1);
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td><input type='number' class='form-control' value='" +data[i].quantity+ "' max='" +data[i].quantity+ "' min='1' disabled></td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td><input data-productId='" +data[i].product_id+ "' type='checkbox' class='form-control'></td>";
                  } 
                //   document.getElementById("Date").value = data[0].created_at;
                  document.getElementById("Customer").value = data[0].customer_name;
                  document.getElementById("returnCustomerName").value = data[0].customer_name;



              }
          });


          document.getElementById("searchORNumberInput").value = ORNumber ;
          document.getElementById("resultORNumberDiv").innerHTML = "";

      }
      function toggleCheckbox(button){
          var data  = $(button.parentNode.parentNode.innerHTML).slice(0,-1);
          var itemName = data[0].innerHTML;
          var itemsInExchangeTable = $("#inExchangeTbody tr td:first-child");
          var exchangeTable = document.getElementById("inExchangeTbody");

          if(button.checked){
              var newRow = exchangeTable.insertRow(-1);
              newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='productId[]' value='" +button.getAttribute("data-productId")+ "'>" +data[0].innerHTML+ "</td>";
              newRow.insertCell(-1).innerHTML = "<td><input type='number' name='quantity[]' class='form-control' value='" +data[1].childNodes[0].value+ "' max='" +data[1].childNodes[0].value+ "' min='1'></td>";
              newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='price[]' value='" +data[2].innerHTML+ "'>" +data[2].innerHTML+ "</td>";
              button.parentNode.previousSibling.previousSibling.childNodes[0].removeAttribute("disabled");

          }else{
              for(var i = 0; i < itemsInExchangeTable.length; i++){
                  if(itemsInExchangeTable[i].outerText === itemName){

                      document.getElementById("inEchangeTable").deleteRow(i+1);
                  }
              }

          }
      }

      function searchItem(a){
          if(a.value === ""){
              document.getElementById("searchResultDiv").innerHTML ="";   
          }else{
              $.ajax({
                  method: 'get',
                  //url: 'items/' + document.getElementById("inputItem").value,
                  url: 'searchItem/' + a.value,
                  dataType: "json",
                  success: function(data){
                      //    console.log(data)
                      // <div>
                      //     <strong>Phi</strong>lippines
                      //     <input type="hidden" value="Philippines">
                      // </div>

                      var resultDiv = document.getElementById("searchResultDiv");
                      resultDiv.innerHTML = "";
                      for (var i = 0;  i< data.length; i++) {
                          var node = document.createElement("DIV");
                          node.setAttribute("onclick","addRow(this)")
                            node.setAttribute("data-quantity",data[i].quantity)
                            node.setAttribute("data-price",data[i].retail_price)
                          var pElement = document.createElement("P");
                          //add the price
                          //pElement.setAttribute("data-price" , data[i].) 
                          var textNode = document.createTextNode(data[i].description);
                          pElement.appendChild(textNode);
                          node.appendChild(pElement);          
                          resultDiv.appendChild(node);  
                      }
                  }
              });

          }

      }

      function searchOfficialReceipt(a){

          var officialReceipt = a.value;
          var fullRoute = "/salesAssistant/returns/getORNumber/"+officialReceipt;
          if(a.value === ""){
              document.getElementById("resultORNumberDiv").innerHTML ="";   
          }else{
              $.ajax({
                  method: 'get',
                  //url: 'items/' + document.getElementById("inputItem").value,
                  url: fullRoute,

                  success: function(data){
                      var resultORNumberDiv = document.getElementById("resultORNumberDiv");
                      resultORNumberDiv.innerHTML = "";
                      for (var i = 0;  i< data.length; i++) {
                          var node = document.createElement("DIV");
                          node.setAttribute("onclick","addReturnItem(this.firstChild.innerHTML)")
                          var pElement = document.createElement("P");
                          //add the price
                          //pElement.setAttribute("data-price" , data[i].) 
                          var textNode = document.createTextNode(data[i].or_number);
                          pElement.appendChild(textNode);
                          node.appendChild(pElement);          
                          resultORNumberDiv.appendChild(node);  
                      }
                      console.log(data)

                  }
              });
          }

      }

      function getItems(button){

          var ORnumber = button.parentNode.parentNode.parentNode.firstChild.innerHTML;
          // console.log(itemId);
          var fullRoute = "/salesAssistant/returns/getReturnedItems/"+ORnumber;
          $.ajax({
              type:'GET',
              url: fullRoute,

              success:function(data){
                  $("#veiwReturnedItemTbody tr").remove();
                  var returnedItemTable = document.getElementById("veiwReturnedItemTbody");
                  for(var i = 0; i < data.length; i++){
                      var newRow = returnedItemTable.insertRow(-1);
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";

                  }

                  document.getElementById("returnedDate").innerHTML = button.parentNode.parentNode.previousSibling.innerHTML;
                  document.getElementById("returnedORNumber").innerHTML = ORnumber;
                  document.getElementById("customerName").innerHTML = data[0].customer_name;
              }
          });


      }
      function createReport(button){
        // var dateFrom = document.getElementById("from").value;
        // var dateTo = document.getElementById("to").value;
        var dateFrom = button.parentNode.children[1].value;
        var dateTo = button.parentNode.children[3].value;
        var newDateFrom = new Date(dateFrom);
        newDateFrom.setDate(newDateFrom.getDate() - 1);
        
        var ddf = newDateFrom.getDate();
        var mmf = newDateFrom.getMonth() + 1;
        var yf = newDateFrom.getFullYear();

        var newDateTo = new Date(dateTo);
        newDateTo.setDate(newDateTo.getDate() + 1);

        var ddt = newDateTo.getDate();
        var mmt = newDateTo.getMonth() + 1;
        var yt = newDateTo.getFullYear();

        var formattedDateFrom = yf + '-' + mmf + '-' + ddf;
        var formattedDateTo = yt + '-' + mmt + '-' + ddt;
        console.log(formattedDateFrom);
        console.log(formattedDateTo);
        $.ajax({
            type:'GET',
            url: "{{route('reports.validateDateRange')}}",
            data: {
                'dateFrom':dateFrom,
                'dateTo':dateTo
            },
            success:function(data){
                $(button.parentNode.parentNode.previousElementSibling).html("");    
                $('#returnsDataTable').DataTable({
                    "destroy": true,
                    "processing": true,
                    "serverSide": true,
                    "colReorder": true,  
                    //"autoWidth": true,
                    "pagingType": "full_numbers",
                    "ajax":  {
                                "url": "{{ route('salesAssistant.createReturnsFilter') }}",
                                "data":{
                                    "dateFrom":formattedDateFrom,
                                    "dateTo":formattedDateTo
                                }
                            },
                    "columns": [
                        {data: 'or_number'},
                        //   {data: 'price'},
                        {data: 'created_at'},
                        {data: 'action'},
                    ]
                });
                            

            },
            error:function(data){
                var response = data.responseJSON;
                console.log(button.parentNode.parentNode.previousElementSibling);
                $(button.parentNode.parentNode.previousElementSibling).hide(500);
                $(button.parentNode.parentNode.previousElementSibling).removeClass("hidden");
                $(button.parentNode.parentNode.previousElementSibling).slideDown("slow", function() {
                    $(button.parentNode.parentNode.previousElementSibling).html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });                
                });
                
            }
        });
    }

      document.addEventListener("click", function (e) {
          document.getElementById("searchResultDiv").innerHTML = "";
      });

      $(document).ready(function(){
        let today = new Date().toISOString().substr(0, 10);
        document.querySelector("#today").value = today;

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $('#formReturnItem').on('submit',function(e){
              e.preventDefault();
              var data = $(this).serialize();           

              $.ajax({
                  type:'POST',
                  // url:'admin/storeNewItem',
                  url: "{{route('salesAssistant.createReturnItem')}}",
                  // data:{
                  //     'name': arrayOfData[1].value,
                  // },

                  // data:{data},
                  data:data,
                  //_token:$("#_token"),
                  success:function(data){
                      //close modal
                      $('#return').modal('hide')                    
                      //prompt the message
                      $("#successDiv p").remove();
                      $("#successDiv").removeClass("hidden")
                          .html("<h3>Return Item(s) successful</h3>");
                      $("#successDiv").css("display:block");                             
                      $("#successDiv").slideDown("slow")
                          .delay(1000)                        
                          .hide(1500);
                      $("#errorDivCreateReturns").html("");

                      $("#returnsDataTable").DataTable().ajax.reload();//reload the dataTables
                  },
                  error:function(data){
                      var response = data.responseJSON;
                      $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");
                      $("#errorDivCreateReturns").html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });
                  }
              });

          })

          $('#returnsDataTable').DataTable({
              "destroy": true,
              "processing": true,
              "serverSide": true,
              "colReorder": true,  
              //"autoWidth": true,
              "pagingType": "full_numbers",
            //   dom: 'Bfrtip',
            //   "buttons": [
            //       {
            //           extend: 'collection',
            //           text: 'EXPORT',
            //           buttons: [
            //               {extend: 'copy', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'excel', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'csv', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'pdf', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'print', title: 'Jernixon Motorparts - Returns'}
            //           ]
            //       }
            //   ],

              "ajax":  "{{ route('salesAssistant.returns.getReturns') }}",
              "columns": [
                  {data: 'or_number'},
                  //   {data: 'price'},
                  {data: 'created_at'},
                  {data: 'action'},
              ]
          });

      });

</script>

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
</style>

@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="hidden alert-danger text-center">
                    </div>
                    <div class="row">
                        <div class="col-md-4 ">
                            <p>
                                <a href = "#return" data-toggle="modal">
                                    <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Return Item</button>
                                </a>
                                <a href = "#refund" data-toggle="modal">
                                    <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Refund</button>
                                </a>
                            </p>
                        </div>
                        <div class="text-right col-md-8" style="margin-top: 10px">
                            <label for="from">From</label>
                            <input type="date">
                            <label for="to">to</label>
                            <input type="date">
                            <button onclick="createReport(this)">Filter</button>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width table-stripped">
                        <table class="table table-hover table-bordered" style="width:100%" id="returnsDataTable">
                            <thead>
                                <tr>
                                    <th class="text-left">OR Numbers</th>
                                    <th class="text-left">Date Created</th>
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
<div id="return" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formReturnItem']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class="fa fa-reply" style="margin-right: 10px;"></i> Returns</h3>
            </div>

            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div id="errorDivCreateReturns" class="hidden">
                    </div>
                    <div id = "buttons">
                        <button type="button" id="customerButton" class="btn btn-basic active" style="width:49.6%;font-size: 16px">Customer Return Item(s)</button>
                        <button type="button" id="supplierButton" class="btn btn-basic" style="width:49.6%; font-size: 16px">Supplier Return Item(s)</button>
                    </div>
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Information
                        </strong>
                    </div>

                                        <div id = "customerDiv">
                    <div class="panel-body">

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt No:')}}
                                </div>
                                <div class="col-md-9">
                                  {{--  {{ Form::number('Official Receipt No','',['class'=>'form-control','min'=>'1']) }}  --}}
                        <input autocomplete="off" id="searchORNumberInput" type="number" onkeyup="searchOfficialReceipt(this)" name="officialReceiptNumber" class="form-control border-input">
                                     <div id="resultORNumberDiv" class="searchResultDiv">
                            </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::date('Date','',['class'=>'form-control','id' =>'today','value'=>''])}}
                                </div>
                            </div>
                        </div>


                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Customer', 'Customer:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Customer','',['class'=>'form-control','value'=>'','disabled'])}}
                        <input id="returnCustomerName" type="hidden" name="customerName" class="form-control border-input" >
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div id = "supplierDiv" class = "hidden">
                    <div class="panel-body">

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Delivery Receipt No.:')}}
                                </div>
                                <div class="col-md-9">
                                  {{--  {{ Form::number('Delivery Receipt No.','',['class'=>'form-control','min'=>'1']) }}  --}}
                                     <input autocomplete="off" id="searchDRNumberInput" type="number" onkeyup="searchOfficialReceipt(this)" name="deliveryReceiptNumber" class="form-control border-input">
                                    <div id="resultDRNumberDiv" class="searchResultDiv">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::date('Date','',['class'=>'form-control','id' =>'today','value'=>''])}}
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
                                    <input id="returnSupplierName" type="hidden" name="supplierName" class="form-control border-input" >
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="fa fa-reply"></span>
                            Return Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Purchase Price</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="returnItemTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-refresh"></span>
                            In Exchange for
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table id="inEchangeTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Price</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="inExchangeTbody">
                                </tbody>
                            </table>
                        </div>
                        <div class="autocomplete" style="width:100%;">
                            <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" name="item" class="form-control border-input" placeholder="Enter the name of the item">
                            <div id="searchResultDiv" class="searchResultDiv">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="refund" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formRefund']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class=" fa fa-reply" style="margin-right: 10px"></i> Refund</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-info-sign"></span>
                             Information
                        </strong>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt No:')}}
                                </div>
                                <div class="col-md-9">
                                  {{--  {{ Form::number('Official Receipt No','',['class'=>'form-control','min'=>'1']) }}  --}}
                        <input autocomplete="off" id="refundSearchORNumberInput" type="number" onkeyup="searchOfficialReceipt(this)" name="officialReceiptNumber" class="form-control border-input" required>
                                     <div id="refundORNumberDiv" class="searchResultDiv">
                            </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::date('Date','',['class'=>'form-control','id' =>'rtoday','value'=>'','required'])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('refundCustomer', 'Customer:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('refundCustomer','',['class'=>'form-control','value'=>'','disabled'])}}
                        <input id="refundCustomerName" type="hidden" name="customerName" class="form-control border-input" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="fa fa-reply"></span>
                            Return Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Qty</th>
                                        <th class="text-left">Purchase Price</th>
                                        <th class="text-left">Check</th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                </thead>

                                <tbody id="refundTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="errorDivCreateRefund" class="hidden">

                    </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="viewReturn" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Official Receipt Information</h3>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Information
                        </strong>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{--  {{Form::text('Date','',['class'=>'form-control','value'=>'','disabled'])}}  --}}
                                    <p class="form-control" id="returnedDate"></p>   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt No:')}}
                                </div>
                                <div class="col-md-9">
                                    {{--  {{ Form::number('Official Receipt No','',['class'=>'form-control','min'=>'1']) }}  --}}
                                    <p class="form-control" id="returnedORNumber"></p>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Customer', 'Customer:')}}
                                </div>
                                <div class="col-md-9">
                                    {{--  {{Form::text('Customer','',['class'=>'form-control','value'=>'','disabled'])}}  --}}
                                    <p class="form-control" id="customerName"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Returned Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Purchase Price</th>
                                        {{-- <th class="text-left">Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody id="veiwReturnedItemTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
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
{{--  <script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>  --}}
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}


@endsection