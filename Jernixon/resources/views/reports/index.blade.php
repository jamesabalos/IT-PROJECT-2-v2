@extends('layouts.navbar')
@section('reports_link')
class="active"
@endsection
@section('headScript')

    <!--jquery-->
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
    <!--plugin DataTable-->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
{{--  <link href="{{asset('assets/css/jquery.dataTables.css')}}" rel="stylesheet"/>  --}}

<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>

{{--  <script src="{{asset('assets/js/DataTables/dataTables.js')}}"></script>  --}}
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/DataTables/Buttons-1.5.1/js/buttons.html5.js')}}"></script>  --}}
<script src="{{asset('assets/js/jszip.min.js')}}"></script>
{{--  pdf  --}}
<script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script>  --}}
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/vfs_fonts.js')}}"></script>  --}}
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#transactionsTable').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "colReorder": true,  
            //"autoWidth": true,
            "pagingType": "full_numbers",
            dom: 'Bfrtip',
            // buttons: ['excel', 'pdf','print'], 
            buttons:[{
                        extend: 'excel',
                        text: 'excel',
                        action: function (e, dt, node, config) {
                                exportExtension = 'Excel';

                                $.fn.DataTable.ext.buttons.excelHtml5.action(e, dt, node, config);
                            }

                        }],
            "ajax":  "{{ route('reports.getTransactions') }}",
            "columns": [
                {data: 'description'},
                {data: 'price'},
                {data: 'created_at'},
                {data: 'updated_at'},
                ]
        });
        $("#transactionDTButton").click(function(){
            //slideUp any div that has a display:block value
            $("div[style='display: block;']").slideUp("slow");
            $("#transactionDiv").slideDown("slow",function(){
            $('#transactionsTable').DataTable({
                    "destroy": true,
                    "processing": true,
                    "serverSide": true,
                    "colReorder": true,  
                    //"autoWidth": true,
                    "pagingType": "full_numbers",
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf','print'], 
                    "ajax":  "{{ route('reports.getTransactions') }}",
                    "columns": [
                        {data: 'description'},
                        {data: 'price'},
                        {data: 'created_at'},
                        {data: 'updated_at'},
                        ]
                });
            });
           $("#transactionDiv").attr("style","display:block");            
             $("#transactionDTButton").attr("onclick","hideTransactionDTButton()");
        });
        
        $("#returnsDTButton").click(function(){ 
            $("div[style='display: block;']").slideUp("slow");
            $("#returnsDiv").slideDown("slow",function(){
                $('#returnsTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "destroy": true,
                    "colReorder": true, 
                    "pagingType": "full_numbers",  
                    "ajax":  "{{ route('reports.getReturns') }}",
                    "columns": [
                    {data: 'description'},
                    {data: 'price'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    ],
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf','print'], 
                });
                
            });
            $("#returnsDiv").attr("style","display:block");
            //$("#returnsDTButton").attr("onclick","hideReturnsDTButton()");
        });
        $("#itemsAddedDTButton").click(function(){
            $("div[style='display: block;']").slideUp("slow");            
            $("#itemsAddedDiv").slideDown("slow",function(){
                $('#itemsAddedTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "destroy": true,
                    "colReorder": true, 
                    "pagingType": "full_numbers",  
                    "ajax":  "{{ route('reports.getItemsAdded') }}",
                    "columns": [
                    {data: 'description'},
                    {data: 'price'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    ],
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf','print'], 
                });
                
            });            
          //  $("#itemsAddedDiv").slideDown("slow");
            $("#itemsAddedDiv").attr("style","display:block");            
            // $("#itemsAddedDTButton").attr("onclick","hideitemsAddedDTButton()");
        });
        $("#removedItemsDTButton").click(function(){
            $("div[style='display: block;']").slideUp("slow");                        
            $("#removedItemsDiv").slideDown("slow",function(){
                $('#removedItemsTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "destroy": true,
                    "colReorder": true, 
                    "pagingType": "full_numbers",  
                    "ajax":  "{{ route('reports.getRemovedItems') }}",
                    "columns": [
                    {data: 'description'},
                    {data: 'price'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    ],
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf','print'], 
                });
                
            });            
         //   $("#removedItemsDiv").slideDown("slow");
            $("#removedItemsDiv").attr("style","display:block");            
            // $("#removedItemsDTButton").attr("onclick","hideRemovedItemsDTButton()");
        });
        
    });
    
    /*function hideTransactionDTButton(){
        $("#transactionDiv").slideUp("slow");
        $("#transactionDTButton").removeAttr("onclick");
    }
    function hideReturnsDTButton(){
        $("#returnsDiv").slideUp("slow");
        $("#returnsDTButton").removeAttr("onclick");
    }
    function hideitemsAddedDTButton(){
        $("#itemsAddedDiv").slideUp("slow");
        $("#itemsAddedDTButton").removeAttr("onclick");
    }
    function hideRemovedItemsDTButton(){
        $("#removedItemsDiv").slideUp("slow");
        $("#removedItemsDTButton").removeAttr("onclick");
    }
    */
    
</script>
@endsection

@section('linkName')
    <h3>Reports</h3>
@endsection

@section('right')  
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class = "content">
                            <div class="row">
                                <p class = "col-md-12">
                                    <label>From:</label>
                                    <input type="date" name="myDate">

                                    <label>To:</label>
                                    <input type="date" name="myDate">
                                </p>  
                            </div>
<!--                             <p>
                                <label class="category">Generate Report:</label>
                                <button type="submit" class="btn btn-success"><i class = "fa fa-file-excel-o"></i> Excel</button> <button type="submit" class="btn btn-danger"><i class="  fa fa-file-pdf-o"></i> PDF</button>
                            </p> -->

                        <div class="btn-group btn-group-lg">
                            <button type="button" id="transactionDTButton" class="btn btn-primary">Transaction</button>
                            <button type="button" id="returnsDTButton" class="btn btn-primary">Returns</button>
                            <button type="button" id="itemsAddedDTButton" class="btn btn-primary">Items Added</button>
                            <button type="button" id="removedItemsDTButton" class="btn btn-primary">Removed Items</button>
                        </div>

                        {{--  <div id="paraentDivFour" style="border:2px solid green; display:none">  --}}
                        <div id="transactionDiv" style="display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                            <table id="transactionsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                                <thead >
                                    <tr>
                                        <td>Item Purchased</td>
                                        <td>Quantity</td>
                                        <td>Wholesale Price</td>
                                        <td>Retail Price</td>
                                        <td>Total Price</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>   
                            </div>
                        </div> 
                        <div id="returnsDiv" style="display:none">
                            <div class="content table-responsive table-full-width">
                            <table id="returnsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>description</td>
                                        <td>Quantity</td>
                                        <td>Wholesale Price</td>
                                        <td>Retail Price</td>
                                        <td>Total Price</td>
                                        <td>Reason</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                            </table>  
                            </div>
                        </div> 
                        <div id="itemsAddedDiv" style="display:none">
                            <div class="content table-responsive table-full-width">
                                <table id="itemsAddedTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Description</td>
                                            <td>Wholesale Price</td>
                                            <td>Retail Price</td>
                                            <td>Quantity Added</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div> 
                        <div id="removedItemsDiv" style="display:none">
                            <div class="content table-responsive table-full-width">
                                <table id="removedItemsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Description</td>
                                            <td>Wholesale Price</td>
                                            <td>Retail Price</td>
                                            <td>Quantity Added</td>
                                            <td>Reason</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div> 
                    {{--  </div>  --}}

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