@extends('layouts.navbar')
@section('stockAdjustment_link')
class="active"
@endsection

@section('onload')
onload="refresh()"
@endsection

@section('ng-app')
ng-app="ourAngularJsApp"
@endsection


@section('headScript')
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
    function remove(button){
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

    function addRow(itemName){
        var items =[];
        var thatTbody = $("#stockTable tr td:first-child");

        for (var i = 0; i < thatTbody.length; i++) {
            items[i] = thatTbody[i].innerHTML;
        }        

        if( items.indexOf(itemName) == -1 ){ //if there is not yet in the table
            var thatTable = document.getElementById("stockTable");
            var newRow = thatTable.insertRow(-1);
            newRow.insertCell(-1).innerHTML = "<td><input type='text' class='form-control' value=" +itemName+ " disabled></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' min='1' class='form-control'></td>";
            // newRow.insertCell(-1).innerHTML = "<td><input type='number' min='1' class='form-control' disabled></td>";
            newRow.insertCell(-1).innerHTML = "<td><select class='form-control' style='width:100px'> <option class='form-control' value='damaged'>DAMAGED</option><option class='form-control' value='lost'>LOST</option></select></td>";
            newRow.insertCell(-1).innerHTML = "<td><button type='button' class='btn btn-danger form-control' data-item-id=' +button.getAttribute('id')+ ' onclick='remove(this)'><i class='glyphicon glyphicon-remove'></i></button></td>";

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
                //    console.log(data)
                // <div>
                //     <strong>Phi</strong>lippines
                //     <input type="hidden" value="Philippines">
                // </div>

                var resultDiv = document.getElementById("searchResultDiv");
                resultDiv.innerHTML = "";
                for (var i = 0;  i< data.length; i++) {
                    var node = document.createElement("DIV");
                    node.setAttribute("onclick","addRow(this.firstChild.innerHTML)")
                    var pElement = document.createElement("P");
                    var textNode = document.createTextNode(data[i].description);
                    pElement.appendChild(textNode);
                    node.appendChild(pElement);          
                    resultDiv.appendChild(node);  

                }
            }
        });

    }
    
    $(document).ready(function(){
         $('#stockAdjustmentDataTable').DataTable({
              "destroy": true,
              "processing": true,
              "serverSide": true,
              "colReorder": true,  
              //"autoWidth": true,
              "pagingType": "full_numbers",
              dom: 'Bfrtip',
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

              "buttons": [
                  {
                      extend: 'collection',
                      text: 'EXPORT',
                      buttons: [
                          'copy',
                          'excel',
                          'csv',
                          'pdf',
                          'print'
                      ]
                  }
              ],

              "ajax":  "{{ route('stockAdjustment.getStockAdjustment') }}",
              "columns": [
                  {data: 'employee_name'},
                  {data: 'description'},
                  {data: 'quantity'},
                  {data: 'status'},
				  {data: 'created_at'},
              ]
          });
    })

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

@section('linkName')
<h3><i class="fa fa-adjust" style="margin-right: 10px"></i> Stock Adjustment</h3>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <a href = "#adjustment" data-toggle="modal">
                        <button type="button" class="btn btn-success">Stock Adjustment</button>
                    </a>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="stockAdjustmentDataTable">
                            <thead>
                                <tr>
                                    <th class="text-left">Employee Name</th>
                                    <th class="text-left">Item Name</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Status</th>
									<th class="text-left">Date</th>
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
<div id="adjustment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formAdjustment']) !!}

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Stock Adjustment</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Stock Adjustment
                        </strong>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::date('Date','',['class'=>'form-control','value'=>''])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Stock Adjustment
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" id="">

                                <thead>
                                    <tr>
                                        <!--<th class="text-left">Employee Name</th>-->
                                        <th class="text-left">Item Name</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="stockTable">
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
                            <button id="submitNewItems" type="submit" onclick="window.alert('to be continue..')" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_link')

<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


@endsection