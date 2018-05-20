@extends('layouts.navbar')
@section('reports_link')
class="active"
@endsection
@section('headScript')

<!--jquery-->
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

{{--  plugin DataTable  --}}

<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/js/bbccc/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/jszip.min.js')}}"></script>

{{--  pdf    --}}
<script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>

{{--  <link href="{{asset('assets/css/jquery.dataTables.css')}}" rel="stylesheet"/ comment>  --}}
{{--  <script src="{{asset('assets/js/DataTables/dataTables.js')}}"></script comment> --}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script comment>  --}}
{{--  <script src="{{asset('assets/js/DataTables/Buttons-1.5.1/js/buttons.html5.js')}}"></script>  --}}

<script type="text/javascript">
    function createReport(button){
        // var dateFrom = document.getElementById("from").value;
        // var dateTo = document.getElementById("to").value;
        var siOrDiOrLi = button.id;
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
                $(button.parentNode.parentNode.previousElementSibling.previousElementSibling).html("");     
                if(siOrDiOrLi === "si"){
                    $('#transactionsTable').DataTable({
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "colReorder": true,  
                        "pagingType": "full_numbers",
                        dom: 'Blfrtip',
                        "buttons": [
                            {
                                extend: 'collection',
                                text: 'EXPORT',
                                buttons: [
                                    {extend: 'copy', title: 'Jernixon Motorparts - Sales Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'excel', title: 'Jernixon Motorparts - Sales Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'csv', title: 'Jernixon Motorparts - Sales Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'pdf', title: 'Jernixon Motorparts - Sales Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'print', title: 'Jernixon Motorparts - Sales Reports (From '+dateFrom+' to '+dateTo+')'}
                                    
                                ]
                            }
                        ],
                        "ajax":  {
                            "url": "{{ route('reports.createReportSoldItems') }}",
                            "data":{
                                "dateFrom":formattedDateFrom,
                                "dateTo":formattedDateTo
                            }
                        },
                        "columns": [
                        {data: 'or_number'},
                        {data: 'description', name: 'products.description'},
                        {data: 'customer_name'},
                        {data: 'quantity'},
                        {data: 'price'},
                        {data: 'created_at'},
                        ]

                    
                    });
                }else if(siOrDiOrLi === "di"){
                    $('#damagedItemsTable').DataTable({
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "colReorder": true,  
                        "pagingType": "full_numbers",
                        dom: 'Blfrtip',
                        "buttons": [
                            {
                                extend: 'collection',
                                text: 'EXPORT',
                                buttons: [
                                    {extend: 'copy', title: 'Jernixon Motorparts - Damaged items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'excel', title: 'Jernixon Motorparts - Damaged items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'csv', title: 'Jernixon Motorparts - Damaged items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'pdf', title: 'Jernixon Motorparts - Damaged items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'print', title: 'Jernixon Motorparts - Damaged items Reports (From '+dateFrom+' to '+dateTo+')'}
                                    
                                    
                                ]
                            }
                        ],
                        "ajax":  {
                            "url": "{{ route('reports.createReportDamagedItems') }}",
                            "data":{
                                "dateFrom":formattedDateFrom,
                                "dateTo":formattedDateTo
                            }
                        },
                        "columns": [
                        {data: 'description'},
                        {data: 'quantity'},
                        {data: 'created_at'},
                        ]
                        
                    });
                }else{
                    $('#lostItemsTable').DataTable({
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "colReorder": true,  
                        "pagingType": "full_numbers",
                        dom: 'Blfrtip',
                        "buttons": [
                            {
                                extend: 'collection',
                                text: 'EXPORT',
                                buttons: [
                                    {extend: 'copy', title: 'Jernixon Motorparts - Lost items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'excel', title: 'Jernixon Motorparts - Lost items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'csv', title: 'Jernixon Motorparts - Lost items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'pdf', title: 'Jernixon Motorparts - Lost items Reports (From '+dateFrom+' to '+dateTo+')'},
                                    {extend: 'print', title: 'Jernixon Motorparts - Lost items Reports (From '+dateFrom+' to '+dateTo+')'}
                                    
                                ]
                            }
                        ],
                    "ajax":  {
                            "url": "{{ route('reports.createReportLostItems') }}",
                            "data":{
                                "dateFrom":formattedDateFrom,
                                "dateTo":formattedDateTo
                            }
                        },
                        "columns": [
                        {data: 'description'},
                        {data: 'quantity'},
                        {data: 'created_at'},
                        ]
                        
                    });
                }         

            },
            error:function(data){
                var response = data.responseJSON;
                $(button.parentNode.parentNode.previousElementSibling.previousElementSibling).hide(500);
                $(button.parentNode.parentNode.previousElementSibling.previousElementSibling).removeClass("hidden");
                $(button.parentNode.parentNode.previousElementSibling.previousElementSibling).slideDown("slow", function() {
                    $(button.parentNode.parentNode.previousElementSibling.previousElementSibling).html(function(){
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

  $(document).ready(function() {
    $('#transactionsTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "colReorder": true,  
        "pagingType": "full_numbers",
        // dom: 'Blfrtip',
        // "buttons": [
        //     {
        //         extend: 'collection',
        //         text: 'EXPORT',
        //         buttons: [
        //             {extend: 'copy', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'excel', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'csv', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'pdf', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'print', title: 'Jernixon Motorparts - Reports'}
                    
        //         ]
        //     }
        // ],
        "ajax":  "{{ route('reports.getReports') }}",
        "columns": [
          {data: 'or_number'},
          {data: 'description', name: 'products.description'},
          {data: 'customer_name'},
          {data: 'quantity'},
          {data: 'price'},
          {data: 'created_at'},
        ] 
    });

    $('#damagedItemsTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "colReorder": true,  
        "pagingType": "full_numbers",
        // dom: 'Blfrtip',
        // "buttons": [
        //     {
        //         extend: 'collection',
        //         text: 'EXPORT',
        //         buttons: [
        //             {extend: 'copy', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'excel', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'csv', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'pdf', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'print', title: 'Jernixon Motorparts - Reports'}
                    
        //         ]
        //     }
        // ],
        "ajax":  "{{ route('reports.getDamagedItems') }}",
        "columns": [
          {data: 'description'},
          {data: 'quantity'},
          {data: 'created_at'},
        //   {data: 'quantity'},
        //   {data: 'price'},
        //   {data: 'created_at'},
        ]
        
    });

    $('#lostItemsTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "colReorder": true,  
        "pagingType": "full_numbers",
        // dom: 'Blfrtip',
        // "buttons": [
        //     {
        //         extend: 'collection',
        //         text: 'EXPORT',
        //         buttons: [
        //             {extend: 'copy', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'excel', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'csv', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'pdf', title: 'Jernixon Motorparts - Reports'},
        //             {extend: 'print', title: 'Jernixon Motorparts - Reports'}
                    
        //         ]
        //     }
        // ],
        "ajax":  "{{ route('reports.getLostItems') }}",
        "columns": [
          {data: 'description'},
          {data: 'quantity'},
          {data: 'created_at'},
        //   {data: 'quantity'},
        //   {data: 'price'},
        //   {data: 'created_at'},
        ]
        
    });


  });

</script>
@endsection

@section('linkName')
  <h3><i class="fa fa-line-chart" style="margin-right: 15px"></i> Reports</h3>
@endsection

@section('right')  
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class = "content" >
                        <div class="hidden alert-danger text-center">
                        </div>
                        <h3>Sold Items</h3>
                            <div class="row">
                                <p class = "col-md-8">
                                    <label for="from">From</label>
                                    <input type="date">
                                    <label for="to">to</label>
                                    <input type="date">
                                    <button id="si" onclick="createReport(this)">Filter</button>
                                </p>  
                            </div>
                        <div id="transactionDiv" style="display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table id="transactionsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead >
                                        <tr>
                                          <th>OR Number</th>
                                          <th>Item Purchased</th>
                                          <th>Customer</th>
                                          <th>Qty</th>
                                          <th>Purchase Price</th>
                                          <th>Date of Transaction</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>   
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class = "content" >
                        {{-- <div class="row">
                            <p class = "col-md-8">
                                <label for="from">From</label>
                                <input type="date" id="from" name="from">
                                <label for="to">to</label>
                                <input type="date" id="to" name="to" >
                                <button onclick="createReport(this)">Create</button>
                            </p>  
                        </div> --}}
                        <div class="hidden alert-danger text-center">
                        </div>
                        <h3>Damaged Items</h3>
                        <div class="row">
                            <p class = "col-md-8">
                                <label for="from">From</label>
                                <input type="date">
                                <label for="to">to</label>
                                <input type="date">
                                <button id="di" onclick="createReport(this)">Filter</button>
                            </p>  
                        </div>
                        <div id="damagedItemsDiv" style="display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table id="damagedItemsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead >
                                        <tr>
                                          <th>Item Name</th>
                                          <th>Quantity</th>
                                          <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>   
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class = "content" >
                        {{-- <div class="row">
                            <p class = "col-md-8">
                                <label for="from">From</label>
                                <input type="date" id="from" name="from">
                                <label for="to">to</label>
                                <input type="date" id="to" name="to" >
                                <button onclick="createReport(this)">Create</button>
                            </p>  
                        </div> --}}
                        <div class="hidden alert-danger text-center">
                        </div>
                        <h3>Lost Items</h3>
                        <div class="row">
                            <p class = "col-md-8">
                                <label for="from">From</label>
                                <input type="date">
                                <label for="to">to</label>
                                <input type="date">
                                <button id="li" onclick="createReport(this)">Filter</button>
                            </p>  
                        </div>
                        <div id="lostItemsDiv" style="display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table id="lostItemsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead >
                                        <tr>
                                          <th>Item Name</th>
                                          <th>Quantity</th>
                                          <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>   
                            </div>
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
