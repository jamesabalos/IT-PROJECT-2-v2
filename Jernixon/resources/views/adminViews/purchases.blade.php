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
<div class="alert alert-success hidden" id="successDiv">

</div>
<h3><i class="fa fa-cube" style="margin-right: 10px"></i> Purchases</h3>
@endsection

@section('headScript')
<!--jquery-->
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
{{--  plugin DataTable  --}}
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
{{--  <link href="{{asset('assets/css/jquery.dataTables.css')}}" rel="stylesheet"/ comment>  --}}

<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/js/bbccc/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>

{{--  <script src="{{asset('assets/js/DataTables/dataTables.js')}}"></script comment>  --}}
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}

{{--  <script src="{{asset('assets/js/DataTables/Buttons-1.5.1/js/buttons.html5.js')}}"></script>  --}}
<script src="{{asset('assets/js/jszip.min.js')}}"></script>
{{--  pdf    --}}
<script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script comment>  --}}

      <script type="text/javascript">
        function addRow(div){
          var items =[];
          var thatTbody = $("#purchasetable tr td:first-child");

          for (var i = 0; i < thatTbody.length; i++) {
              items[i] = thatTbody[i].innerHTML;
          }

          if( items.indexOf(div.firstChild.innerHTML) == -1 ){ //if there is not yet in the table

              var thatTable = document.getElementById("purchasetable");
              var newRow = thatTable.insertRow(-1);

              newRow.insertCell(-1).innerHTML = "<td>" +div.firstChild.innerHTML+ "</td>";
              newRow.insertCell(-1).innerHTML = "<td><input name='quantity[]' type='number' min='1' value='1' class='form-control'></td>";
              newRow.insertCell(-1).innerHTML = "<td><input name='price[]' type='number' min='1.00' value='1.00' class='form-control'></td>";
              newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='product_id[]' value='" +div.getAttribute("id")+ "'><button type='button' onclick='removeRow(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
          }
          document.getElementById("searchItemInput").value = "";
          document.getElementById("searchResultDiv").innerHTML = "";
      }

      function searchItem(a){
          if(a.value === ""){
              document.getElementById("searchResultDiv").innerHTML ="";   
          }
          $.ajax({
              method: 'get',
              //url: 'items/' + document.getElementById("inputItem").value,
              url: 'searchItem/' + a.value,
              dataType: "json",
              success: function(data){
                     console.log(data)
                  // <div>
                  //     <strong>Phi</strong>lippines
                  //     <input type="hidden" value="Philippines">
                  // </div>

                  var resultDiv = document.getElementById("searchResultDiv");
                  resultDiv.innerHTML = "";
                  for (var i = 0;  i< data.length; i++) {
                      var node = document.createElement("DIV");
                      node.setAttribute("id",data[i].product_id)
                      node.setAttribute("onclick","addRow(this)")
                      var pElement = document.createElement("P");
                      var textNode = document.createTextNode(data[i].description);
                      pElement.appendChild(textNode);
                      node.appendChild(pElement);          
                      resultDiv.appendChild(node);  

                  }
              }
          });

      }

      function getItems(button){

          var itemId = button.parentNode.parentNode.parentNode.firstChild.innerHTML;
          // console.log(itemId);
          var fullRoute = "/admin/purchases/getPurchaseOrder/"+itemId;
          $.ajax({
              type:'GET',
              url: fullRoute,
              // dataType: JSON,

              success:function(data){
                  //add data to modal
                  //   console.log(data)
                  console.log(data)
                  $("#purchaseOrdertableTbody tr").remove();

                  var modalPurchaseTable = document.getElementById("purchaseOrdertableTbody");
                  for(var i = 0; i < data.length; i++){
                      var newRow = modalPurchaseTable.insertRow(-1);
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                  }
                  document.getElementById("supplierName").innerHTML = data[0].supplier_name;
                  document.getElementById("poDate").innerHTML = data[0].created_at;
                  document.getElementById("officialReceiptNumber").innerHTML = button.parentNode.parentNode.parentNode.firstChild.innerHTML;

              }
          });


      }

      document.addEventListener("click", function (e) {
          document.getElementById("searchResultDiv").innerHTML = "";
      });
      function removeRow(a){
          $(a.parentNode.parentNode).hide(500,function(){
              this.remove();  
          });
          // a.parentNode.parentNode.remove();

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
                $('#purchasesDataTable').DataTable({
                    "destroy": true,
                    "processing": true,
                    "serverSide": true,
                    "colReorder": true,  
                    //"autoWidth": true,
                    "pagingType": "full_numbers",

                "ajax":  {
                        "url": "{{ route('purchases.createPurchasesFilter') }}",
                        "data":{
                            "dateFrom":formattedDateFrom,
                            "dateTo":formattedDateTo
                        }
                    },
                    "columns": [
                        {data: 'po_id'},
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
                
                // $("#errorDivReport").removeClass("hidden").addClass("alert-danger text-center");
                // $("#errorDivReport").html(function(){
                //           var addedHtml="";
                //           for (var key in response.errors) {
                //               addedHtml += "<p>"+response.errors[key]+"</p>";
                //           }
                //           return addedHtml;
                //       });
            }
        });
    }

      $(document).ready(function(){

      let today = new Date().toISOString().substr(0, 10);
      document.querySelector("#today").value = today;
      

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#purchasesDataTable').DataTable({
              "destroy": true,
              "processing": true,
              "serverSide": true,
              "colReorder": true,  
              //"autoWidth": true,
              "pagingType": "full_numbers",
            //   dom: 'Bfrtip',
              // buttons: ['excel', 'pdf','print'], 

              // buttons:[{
              //             extend: 'excel',
              //             text: 'excel',
              //             action: function (e, dt, node, config) {
              //                     exportExtension = 'Excel';

              //                     // $.fn.DataTable.ext.buttons.excelHtml5.action(e, dt, node, config);
              //                     $.fn.DataTable.ext.buttons.excelHtml5.action.call( e, dt, node, config);
              //                 }

              //             },'print'],

            //   "buttons": [
            //       {
            //           extend: 'collection',
            //           text: 'EXPORT',
            //           buttons: [
            //               {extend: 'copy', title: 'Jernixon Motorparts - Purchases'},
            //               {extend: 'excel', title: 'Jernixon Motorparts - Purchases'},
            //               {extend: 'csv', title: 'Jernixon Motorparts - Purchases'},
            //               {extend: 'pdf', title: 'Jernixon Motorparts - Purchases'},
            //               {extend: 'print', title: 'Jernixon Motorparts - Purchases'}
            //           ]
            //       }
            //   ],

              "ajax":  "{{ route('purchases.getPurchases') }}",
              "columns": [
                  {data: 'po_id'},
                  {data: 'created_at'},
                  {data: 'action'},
              ]
          });

          $('#formPurchaseOrder').on('submit',function(e){
              e.preventDefault();
              var data = $(this).serialize();

              $.ajax({
                  type:'POST',
                  url: "{{route('admin.createPurchases')}}",
                  data: data,

                  success:function(data){
                    if(data === "successful"){
                      //close modal
                      $('#purchase').modal('hide')                    
                      //remove rows in purchase table
                      $("#purchasetable tr").remove();
                      //prompt the message
                      $("#successDiv p").remove();
                      $("#successDiv").removeClass("hidden")
                      // .addClass("alert-success")
                             .html("<h3>Transaction successful</h3>");
                      $("#successDiv").css("display:block");                             
                      $("#successDiv").slideDown("slow")
                          .delay(1000)                        
                          .hide(1500);
                      $("#errorDivCreatePurchase").html("");
                      document.getElementById("formPurchaseOrder").reset(); //reset the form

                       $("#purchasesDataTable").DataTable().ajax.reload();//reload the dataTables

                    }else{
                        $("#errorDivCreatePurchase").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreatePurchase").html("Official Receipt Number duplicated");
                    }


                  },
                  error:function(data){
                    var response = data.responseJSON;
                    $("#errorDivCreatePurchase").hide(500);
                    $("#errorDivCreatePurchase").removeClass("hidden");
                    $("#errorDivCreatePurchase").slideDown("slow", function() {
                    $("#errorDivCreatePurchase").html(function(){
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
                                <a href = "#purchase" data-toggle="modal">
                                    <button type="button" class="btn btn-success"><i class=" fa fa-plus"></i> Add Purchase Order</button>
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

                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="purchasesDataTable">
                            <thead>
                                <tr>
                                    <th class="text-left">PO ID</th>
                                    <th class="text-left">Date Created </th>
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
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="modal-title"><i class="fa fa-cube" style="margin-right: 8px"></i> Purchases</h3>
                        </div>
                    </div>
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
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{-- {{Form::date('Date','',['class'=>'form-control','value'=>''])}} --}}
                                    <input type="date" name="Date" id="today"  class="form-control"/>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt Number:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('Official Receipt Number','',['class'=>'form-control']) }}
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
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Qty</th>
                                        <th class="text-left">Purchase Price</th>
                                        <th class="text-left">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="purchasetable">
                                </tbody>
                            </table>


                        </div> 
                        <div class="autocomplete" style="width:100%;">
                            <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Enter the name of the item">
                            <div id="searchResultDiv" class="searchResultDiv">
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="errorDivCreatePurchase" class="hidden alert-danger text-center">

                    </div>
                {{--  <button type="button" class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button>  --}}
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

<div id="purchasesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">PO ID</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Purchases
                        </strong>
                    </div>
                    <div class="panel-body">
                        {{--  <input type="hidden" id="_token" value="{{ csrf_token() }}">  --}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{--  {{Form::label('Date', 'Date:')}}  --}}
                                    <label>Date:</label>
                                </div>
                                <div class="col-md-9">
                                    {{--  {{Form::text('Date','',['class'=>'form-control','value'=>''])}}  --}}
                                    <p class="form-control" id="poDate"></p>                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{--  {{Form::label('Official Receipt No:')}}  --}}
                                    <label>Official Receipt No:</label>
                                </div>
                                <div class="col-md-9">
                                    {{--  {{ Form::text('Official Receipt No','',['class'=>'form-control']) }}  --}}
                                    <p class="form-control" id="officialReceiptNumber"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3 ">
                                    {{--  {{Form::label('Supplier', 'Supplier:')}}  --}}
                                    <label>Supplier</label>
                                </div>
                                <div class="col-md-9">
                                    {{--  {{Form::text('Supplier','',['class'=>'form-control','value'=>''])}}  --}}
                                    <p class="form-control" id="supplierName"></p>
                                </div>
                            </div>
                        </div>

                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Purchase Price</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseOrdertableTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitPurchases" type="button" data-dismiss="modal" class="btn btn-success">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection


        @section('js_link')
        <!--   Core JS Files   -->
        {{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>  --}}
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        @endsection
