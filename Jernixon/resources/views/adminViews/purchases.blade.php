@extends('layouts.navbar')
@section('purchases_link')
class="active"
@endsection

{{--  @section('onload')
onload="refresh()"
@endsection  --}}

 @section('ng-app')
ng-app="ourAngularJsApp"
@endsection 
@section('angularJsControllerName')
ng-controller="ownerPurchase"
@endsection
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

{{-- AngularJS --}}
<script src="{{asset('assets/js/angularJs.js')}}"></script>
<script src="{{asset('assets/js/angular-datatables.min.js')}}"></script> 
<style type="text/css">
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
              newRow.insertCell(-1).innerHTML = "<td><input name='price[]' type='number' onchange='changeValuePrice(this)' min='1.00' value='"+div.dataset.price+"' class='form-control'></td>";
              newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='product_id[]' value='" +div.getAttribute("id")+ "'><button type='button' onclick='removeRow(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
          }
          document.getElementById("searchItemInput").value = "";
          document.getElementById("searchResultDiv").innerHTML = "";
      }
      function changeValuePrice(input){
          input.setAttribute("value",input.value)
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
                      node.setAttribute("data-price",data[i].wholesale_price)
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
                  var totalAmount = "";
                  for(var i = 0; i < data.length; i++){
                      var newRow = modalPurchaseTable.insertRow(-1);
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].unit+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                      newRow.insertCell(-1).innerHTML = "<td>" +data[i].amount+ "</td>";
                    totalAmount += parseInt(data[i].amount);
                  }
                  document.getElementById("supplierName").innerHTML = data[0].supplier_name;
                  document.getElementById("poDate").innerHTML = data[0].created_at;
                  document.getElementById("officialReceiptNumber").innerHTML = button.parentNode.parentNode.parentNode.firstChild.innerHTML;
                  document.getElementById("discountDivView").innerHTML = data[0].discount;


                  document.getElementById("totalAmountDivView").innerHTML = totalAmount;

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
    
    function checkQuantity(input){
          if(input.value <= 0){
            input.setAttribute("data-content","Value should be greater than 0");
            $(input).popover('show');
          }else{
                $(input).popover('destroy');            
          }
      }

      function checkDiscount(input){
          if(input.value < 0){
            input.setAttribute("data-content","Discount should be greater than or equal to 0");
            $(input).popover('show');
          }else{
            if( parseInt(document.getElementById("totalAmountDiv").children[1].innerHTML) < 0 ){
                input.setAttribute("data-content","wala na kayong kita!");
                $(input).popover('show');            
            }else{
                $(input).popover('destroy');            
            }
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
        
      document.querySelector("#today").value = today+"T"+hours+":"+minutes;
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
                  {data: 'supplier_name'},
                  {data: 'action'},
              ]
          });

          $('#formPurchaseOrder').on('submit',function(e){
              e.preventDefault();
              var data = $(this).serialize();
                if( $("#purchaseTable tr").length == 0 ){
                    $("#errorDivCreatePurchase").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreatePurchase").html("<h4>Please input item/s</h4>");
                    return true;
                }
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
                             .html("<h3>Purchase successful</h3>");
                      $("#successDiv").css("display:block");                             
                      $("#successDiv").slideDown("slow")
                          .delay(1000)                        
                          .hide(1500);
                      $("#errorDivCreatePurchase").html("");
                      document.getElementById("formPurchaseOrder").reset(); //reset the form

                       $("#purchasesDataTable").DataTable().ajax.reload();//reload the dataTables
                        $("#purchasetable tr").remove();
                    }else{
                        $("#errorDivCreatePurchase").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreatePurchase").html("<h4>Official Receipt Number duplicated</h4>");
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
                              addedHtml += "<h4>"+response.errors[key]+"</h4>";
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
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="purchasesDataTable">
                            <thead>
                                <tr>
                                    <!-- <th class="text-left">PO ID</th>
                                    <th class="text-left">Date Created </th>
                                    <th class="text-left">Action</th> -->
                                    <th>Delivery Receipt No.</th>
                                    <th>Date of Transaction</th>
                                    {{-- <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Unit Price</th> --}}
                                    <th>Supplier</th>
                                    <th>Action</th>

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

@section('jqueryScript')
<script type="text/javascript">
    var ourAngularJsApp = angular.module("ourAngularJsApp", []); 
    ourAngularJsApp.controller('ownerPurchase', ['$scope','$compile','$http',
        function($scope, $compile,$http) {
            var _this = this;

            //initialize totalAmount
            var totalAmountDiv = document.getElementById("totalAmountDiv");
            totalAmountDiv.innerHTML = "";
            var newTotalAmountDiv = "<span class = 'input-group-addon'>&#8369</span><p class='form-control' id='totalAmount' ng-bind='' style='float: right;color:green'>0.00</p>";
            angular.element( totalAmountDiv ).append(newTotalAmountDiv);

            //initialize discount
            document.getElementById("discountDiv").innerHTML="";            
            var discountInput = "<div class = 'input-group'><span class = 'input-group-addon'>%</span><input type='number' name='discount' ng-init='discountValue =0' onchange='checkDiscount(this)' trigger='manual' id='discountInput' data-toggle='popover'  placement='top' title='Error' data-content='wala na pong kita.' style='color:red' ng-model='discountValue' class='form-control'></div>";
            angular.element( discountDiv ).append( $compile(discountInput)($scope) );

            $scope.search = function(event) {
                
                var responsePromise = $http.get("searchItem/" + event.currentTarget.value);
                responsePromise.success(function(data, status, headers, config) {
                    var resultDiv = document.getElementById("searchResultDiv");
                        resultDiv.innerHTML = "";
                        for (var i = 0;  i< data.length; i++) {
                            var node = document.createElement("DIV");
                            node.setAttribute("id",data[i].product_id)
                            node.setAttribute("ng-click","addRow($event)")
                            node.setAttribute("data-price",data[i].wholesale_price)
                            var pElement = document.createElement("P");
                            var textNode = document.createTextNode(data[i].description);
                            pElement.appendChild(textNode);
                            node.appendChild(pElement);  
                            resultDiv.appendChild(node);  
                            $compile(node)($scope);
                            // console.log(node)
                        }

                });
                responsePromise.error(function(data, status, headers, config) {
                    console.log("AJAX failed!");
                });
                
            };

            $scope.addRow = function (event){
                
                var items =[];
                var thatTbody = $("#purchaseTbody tr td:nth-child(3)");
                for (var i = 0; i < thatTbody.length; i++) {
                    items[i] = thatTbody[i].innerHTML;
                }
                
                if( items.indexOf(event.currentTarget.firstChild.innerHTML) != -1 ){ //if there is already in the table
                    return true;
                }

                var thatTbody = document.getElementById("purchaseTbody");
                var lastRow = thatTbody.insertRow(-1);

                var itemDescription = event.currentTarget.firstChild.innerHTML;
                var itemName = itemDescription.replace(/\s/g,'').replace(/-/g,'').replace(/\//g,'').replace(/\./g,'').replace(/\+/g,'');

                var quantity = "<input style='width: 100px;' trigger='manual' placement='top' data-toggle='popover' title='Error' type='number' ng-init='" +itemName+ "Q =1' name='quantity[]' class='form-control' ng-focus='$event = $event' onchange='checkQuantity(this)' ng-change='changingQuantity($event)' ng-model='" +itemName + "Q'  required></input>";
                var temp1 = $compile(quantity)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp1);

                 var unit = "<select class='form-control' name='unit[]' > <option class='form-control'  value='pcs'>Pcs</option><option class='form-control'  value='sets'>Sets</option></select>";
                angular.element( lastRow.insertCell(-1) ).append(unit);

                 angular.element( lastRow.insertCell(-1) ).append(itemDescription);

                var unitPrice = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><input style='width: 100px;color:green' trigger='manual' placement='top' data-toggle='popover' title='Error' type='number' onchange='checkQuantity(this)' ng-init='" +itemName+ "UP =" +event.currentTarget.dataset.price+ "' name='unitPrice[]' class='form-control text-right' ng-focus='$event = $event' ng-change='changingUnitPrice($event)' ng-model='" +itemName + "UP'  required></input></div>";
                var temp2 = $compile(unitPrice)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp2);

                var amount = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green;' ng-bind='" +itemName+"Q"+"*"+itemName+ "UP |number:2'></p></div><input type='hidden' name='amount[]' ng-value='" +itemName+"Q"+"*"+itemName+ "UP'>";
                // var amount = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><input disabled name='amount[]' class='form-control text-right' style='color:green;' ng-model='"+itemName+"amount' ng-bind='" +itemName+"Q"+"*"+itemName+ "UP |number:2'></p></div><input type='hidden' name='amount[]' value=''>";
                var temp3 = $compile(amount)($scope); 
                angular.element( lastRow.insertCell(-1) ).append(temp3);

                var removeButton = "<button type='button' class='btn btn-danger' ng-click='remove($event)'>Remove</button><input type='hidden' name='productIds[]' value='"+event.currentTarget.id+"'>";
                var temp3 = $compile(removeButton)($scope);
                angular.element( lastRow.insertCell(-1) ).append(temp3);

                //initialize totalAmount
                // var totalAmountDiv = document.getElementById("totalAmountDiv");
                // console.log(totalAmountDiv.children[1])
                // var ngBindAttributes = (totalAmountDiv.children[1]).getAttribute("ng-bind") ; //get ng-bind attribute/s of totalAmount
                // totalAmountDiv.innerHTML =""; 
                // if(ngBindAttributes==""){
                //     var newNgBindsTemp = "("+itemName+"Q"+"*"+itemName+"UP"+")";
                //     var newNgBinds = newNgBindsTemp;
                // }else{
                //     var newNgBindsTemp = ngBindAttributes.split(" ")[0] + "+" + "("+itemName+"Q"+"*"+itemName+"UP"+")";
                //     var newNgBinds = newNgBindsTemp;
                // }
                //   var amount = "<span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +newNgBinds+ " |number:2'>0.00</p>";
                // angular.element( totalAmountDiv ).append( $compile(amount)($scope) );

                //clear search input
                document.getElementById("searchItemInput").value = "";
                
                //initialize totalAmount
                var totalAmountDiv = document.getElementById("totalAmountDiv");
                var ngBindAttributes = totalAmountDiv.children[1].getAttribute("ng-bind").split(" ")[0]; //get ng-bind attribute/s
                totalAmountDiv.innerHTML =""; 
                console.log( ngBindAttributes)
                if(ngBindAttributes==""){
                    var newNgBindsTemp = itemName+"Q"+"*"+itemName+"UP";
                    var newNgBinds = "("+newNgBindsTemp+")";
                }else{
                    var newNgBindsTemp = (ngBindAttributes.split("-")[0]) + "+(" + itemName+"Q*"+itemName+"UP)";
                    var newNgBinds = newNgBindsTemp;
                }
                var price = "<span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +newNgBinds+ "- (("+newNgBinds+")*(discountValue/100)) |number:2'></p>";
                angular.element( totalAmountDiv ).append( $compile(price)($scope) );



            }

            $scope.remove = function (event){
                // var ngBind = event.currentTarget.parentNode.previousElementSibling.firstChild.children[1].getAttribute("ng-bind").split(" ")[0];
                // var toBeReplace = "(("+ngBind+"))";
                // console.log(toBeReplace)
                // var pattern = /toBeReplace/ig;  
                // // var totalAmountNgBind = document.getElementById("totalAmountDiv").children[1].getAttribute("ng-bind").replace(/toBeReplace/,"0");
                // var totalAmountNgBind = document.getElementById("totalAmountDiv").children[1].getAttribute("ng-bind").replace("("+ngBind+")","").replace(toBeReplace,"");
                // var newAmountNgBind = "<span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='" +totalAmountNgBind+ "'></p>";
                // var totalAmountDiv = document.getElementById("totalAmountDiv");
                // totalAmountDiv.innerHTML="";
                // angular.element( totalAmountDiv ).append( $compile(newAmountNgBind)($scope) );
    
                //remove row in table
                event.currentTarget.parentNode.parentNode.remove();
                // $(event.currentTarget.parentNode.parentNode).hide(500,function(){
                //     this.remove();  
                // });
                    
                var thatTable = document.querySelectorAll('#purchaseTable > tbody > tr');
                var numberOfRows = thatTable.length;
                var ngBinds = "";
                var ngBindsWithoutFormat="";                

                if(numberOfRows > 0){
                    for(var i=0; i < numberOfRows; i++){
                        if(ngBinds==""){
                            ngBinds += thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind");
                            ngBindsWithoutFormat += "("+ ngBinds.split(" ")[0] +")";
                        }else{
                            ngBinds += " + " + thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind");
                            ngBindsWithoutFormat += "+(" + thatTable[i].childNodes[4].firstChild.childNodes[1].getAttribute("ng-bind").split(" ")[0] +")";
                        }
                    }
                    // var price = "<div class = 'input-group'><span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +ngBindsWithoutFormat+ ")-discountValue |number:2'></p></div>";
                var newwTotalAmountDiv = "<span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind='(" +ngBindsWithoutFormat+ ")- (("+ngBindsWithoutFormat+")*(discountValue/100)) |number:2'></p>";
                document.getElementById("totalAmountDiv").innerHTML="";
                angular.element( totalAmountDiv ).append( $compile(newwTotalAmountDiv)($scope) );
                    
                }else{                   
                    var newwTotalAmountDiv = "<span class = 'input-group-addon'>&#8369</span><p class='form-control text-right' style='color:green' ng-bind>0.00</p>";
                    document.getElementById("totalAmountDiv").innerHTML="";
                    angular.element( totalAmountDiv ).append( newwTotalAmountDiv );
                    
                }


            }

        }

    ]);
</script>
@endsection

@section('modals')
<div id="purchase"  ng-controller="ownerPurchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-lg">
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
                                    <input type="datetime-local" name="Date" id="today"  class="form-control"/>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Delivery Receipt Number:')}}
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
                            <table class="table table-bordered table-striped" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-left">Qty.</th>
                                        <th class="text-left">Unit</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Amount</th>
                                        {{-- <th class="text-left">Total Amount</th> --}}
                                        <th class="text-left">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseTbody">
                                </tbody>
                            </table>
          
                        </div> 
                        <div class="autocomplete" style="width:100%;">
                            {{-- <input autocomplete="off" type="text" id="searchItemInput" ng-model="testModel" ng-keyup="search()" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Enter the name of the item"> --}}
                            <input autocomplete="off" type="text" id="searchItemInput" ng-model="searchInput" ng-focus='$event = $event' ng-keyup="search($event)" class="form-control border-input" placeholder="Enter the name of the item">
                            <div id="searchResultDiv" class="searchResultDiv">
                            </div>
                        </div>

                            <div class="row">
                                    <div class="col-md-8 text-right">
                                        <label>Discount:</label>
                                    </div>
                                    <div class="col-md-4" id="discountDiv">
                                    </div>
                                    
                                </div>
						   <div class="row">
                            </div>
							<br>
                        <div class="col-md-8 text-right">
                            <label>Total Amount:</label>
                        </div>
                        <div class = "col-md-4 input-group" id="totalAmountDiv">

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
    <div class = "modal-dialog modal-lg">
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Date:</label>
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="poDate"></p>                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Official Receipt No:</label>
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="officialReceiptNumber"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3 ">
    
                                    <label>Supplier</label>
                                </div>
                                <div class="col-md-9">

                                    <p class="form-control" id="supplierName"></p>
                                </div>
                            </div>
                        </div>

                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th class="text-left">Qty.</th>
                                        <th class="text-left">Unit</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="purchaseOrdertableTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

				<div class="col-md-8 text-right">
                    <label >Discount:</label>
                </div>
                <div class = 'input-group'>
                    <span class = 'input-group-addon'>%</span>
                    <p class="form-control text-right" style="color:red;" id="discountDivView">
                    </p>
                    </div>
					<br>
                <div class="col-md-8 text-right">
                    <label >Total Amount:</label>
                </div>
				    <div class = 'input-group'>
                    <span class = 'input-group-addon'>&#8369</span>
                    <p class="form-control text-right" style="color:green;" id="totalAmountDivView">
                    </p>
                    </div>
				<br>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitPurchases" type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
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
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>  --}}
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection