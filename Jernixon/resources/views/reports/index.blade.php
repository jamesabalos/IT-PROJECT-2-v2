@extends('layouts.navbar')
@section('reports_link')
class="active"
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

              "ajax":  "{{ route('reports.getReports') }}",
              "columns": [
			  	  {data: 'or_number'},
                  {data: 'description'},
				  {data: 'customer_name'},
				  {data: 'quantity'},
                  {data: 'price'},
                  {data: 'created_at'},
              ]
          });
       

      
      });

      

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
                            {{--  <button type="button" id="transactionDTButton" class="btn btn-primary active">Transaction</button>
                            <button type="button" id="returnsDTButton" class="btn btn-primary active">Returns</button>
                            <button type="button" id="itemsAddedDTButton" class="btn btn-primary active">Items Added</button>
                            <button type="button" id="removedItemsDTButton" class="btn btn-primary active">Removed Items</button>  --}}
                        </div>

                        {{--  <div id="paraentDivFour" style="border:2px solid green; display:none">  --}}
                        <div id="transactionDiv" style="display: block;">
                            <div class="content table-responsive table-full-width table-stripped">
                                <table id="transactionsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead >
                                        <tr>
											<td>OR Number</td>
                                            <td>Item Purchased</td>
											<td>Customer Name</td>
                                            <td>Quantity</td>
                                            <td>Price</td>
											<td>Created At</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>   
                            </div>
                        </div> 
                        {{--  <div id="returnsDiv" style="display:none">
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
                        </div>   --}}
                        {{--  <div id="itemsAddedDiv" style="display:none">
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
                        </div>   --}}
                        {{--  <div id="removedItemsDiv" style="display:none">
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
                        </div>   --}}
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