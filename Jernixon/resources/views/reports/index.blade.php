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

<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
{{--  pdf  --}}
<script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
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
            buttons: ['excel', 'pdf','print'], 
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
@section('right')
<i><p style="color:red;font-size:20px">Reports under construction!</p></i>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#"><i class="ti-clipboard"> </i>Reports</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ti-user"></i>
                        <p class="notification"></p>
                        <p>Admin</p>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="notifications.html">Notifications</a></li>
                        <li><a href="changepassword.html">Change Password</a></li>
                        <li><a href="#">Log out</a></li>
                    </ul>    
                </li>
            </ul>
        </div>
    </div>
</nav>    
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class = "content">
                            <div class="row">
                                <p class = "col-md-12">
                                    <input type="text" name="search" placeholder="Enter date (MM-DD-YYYY)" class = "form-control border-input" >
                                </p>  
                            </div>
                            <p>
                                <label class="category">Generate Report:</label>
                                <button type="submit" class="btn btn-success"><i class = "fa fa-file-excel-o"></i> Excel</button> <button type="submit" class="btn btn-danger"><i class="  fa fa-file-pdf-o"></i> PDF</button>
                            </p>
                        </div>
                        
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button type="button" id="transactionDTButton" class="btn btn-info">Transaction</button>
                            <button type="button" id="returnsDTButton" class="btn btn-info">Returns</button>
                            <button type="button" id="itemsAddedDTButton" class="btn btn-info">Items Added</button>
                            <button type="button" id="removedItemsDTButton" class="btn btn-info">Removed Items</button>
                        </div>
                    </div>
                    
                    {{--  <div id="paraentDivFour" style="border:2px solid green; display:none">  --}}
                        <div id="transactionDiv" style="display: block;">
                            <table id="transactionsTable"  class="table table-hover table-condensed" >
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
                        <div id="returnsDiv" style="display:none">
                            <div class="content table-responsive table-full-width">
                            </div>
                            <table id="returnsTable" class="table table-hover table-condensed">
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
                        <div id="itemsAddedDiv" style="display:none">
                            <div class="content table-responsive table-full-width">
                                <table id="itemsAddedTable" class="table table-hover table-condensed">
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
                                <table id="removedItemsTable" class="table table-hover table-condensed">
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
@endsection

@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>  --}}
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

@endsection
