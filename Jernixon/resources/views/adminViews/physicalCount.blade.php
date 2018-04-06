@extends('layouts.navbar')
@section('physicalCount_link')
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
<h3><i class="fa fa-check-square-o" style="margin-right: 10px"></i>Physical Count</h3>
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

      $(document).ready(function(){

    //   let today = new Date().toISOString().substr(0, 10);
    //   document.querySelector("#today").value = today;
      
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#physicalCountDataTable').DataTable({
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
                          {extend: 'copy', title: 'Jernixon Motorparts - Purchases'},
                          {extend: 'excel', title: 'Jernixon Motorparts - Purchases'},
                          {extend: 'csv', title: 'Jernixon Motorparts - Purchases'},
                          {extend: 'pdf', title: 'Jernixon Motorparts - Purchases'},
                          {extend: 'print', title: 'Jernixon Motorparts - Purchases'}
                      ]
                  }
              ],

              "ajax":  "{{ route('admin.getPhysicalCount') }}",
              "columns": [
                  
                   
                //   {data: 'product_id', name: 'physical_count_items.product_id'},
                  {data: 'description', name: 'products.description'},
                  {data: 'quantity', name: 'salable_items.quantity'},
                  {data: 'counted_quantity', name: 'physical_count_items.quantity'},
              ]
          });

          $("#startPhysicalCountbutton").on('click', function(button) {
                button.preventDefault(); //prevent the page to load when submitting form
                $.ajax({
                    type: 'Post',
                    // url:'admin/storeNewItem',
                    // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
                    url: '{{ route("admin.startPhysicalCount")}}',

 
                    success:function(data){
                        $('#startPhysicalCount').modal('hide');
                       $("#physicalCountDataTable").DataTable().ajax.reload();//reload the dataTables
                       document.getElementById("triggerButton").innerHTML = "Stop Physical Count";
                       document.getElementById("triggerButton").parentNode.setAttribute("href","#stopPhysicalCount");                       
                       $("#triggerButton").removeClass("btn-success").addClass("btn-danger");

                        
                        
                    }
                })

          })
          $("#stopPhysicalCountbutton").on('click', function(button) {
                button.preventDefault(); //prevent the page to load when submitting form
                $.ajax({
                    type: 'Post',
                    // url:'admin/storeNewItem',
                    // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
                    url: '{{ route("admin.stopPhysicalCount")}}',

 
                    success:function(data){
                        $('#stopPhysicalCount').modal('hide');
                        $("#physicalCountDataTable").DataTable().ajax.reload();//reload the dataTables
                       document.getElementById("triggerButton").innerHTML = "Start Physical Count";
                       document.getElementById("triggerButton").parentNode.setAttribute("href","#startPhysicalCount");
                       $("#triggerButton").removeClass("btn-danger").addClass("btn-success");
                    }
                })

          })

        
      });


</script>

@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                        @if($physicalCount[0]["status"] === "inactive" )
                            <a href = "#startPhysicalCount" data-toggle="modal">
                                <button id="triggerButton" type="button" class="btn btn-success"><i class="fa fa-play-circle"></i> Start Physical Count</button>
                            </a>
                         @else
                            <a href = "#stopPhysicalCount" data-toggle="modal">
                                <button id="triggerButton"  type="button" class="btn btn-danger"><i class="fa fa-stop-circle"></i> Stop Physical Count</button>
                            </a>
                         @endif
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="physicalCountDataTable">
                            <thead>
                                <tr>
                                    {{-- <th class="text-left">Item Id</th> --}}
                                    <th class="text-left">Item Name</th>
                                    <th class="text-left">System Count</th>
                                    <th class="text-left">Physical Count</th>
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
<div id="startPhysicalCount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button class="close" data-dismiss="modal">&times;</button>
                <p></p>
                <h3> <i class="fa fa-exclamation-triangle" style="margin-right: 15px"> </i> Start physical count? </h3>
            </div>
            <div class="text-center">
                <strong>
                    <p>Some functions of the Sales Assistant will be disabled. Functions will be enabled after the physical count.</p>
                </strong>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="form-group clearfix">
                        <button id="startPhysicalCountbutton" type="button" class="btn btn-success">Continue</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="stopPhysicalCount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <p></p>
            </div>
            <div class="text-center">
                <strong>
                    <h3> <i class="fa fa-exclamation-triangle" style="margin-right: 15px"> </i> Stop physical count? </h3>
                    <p>Physical count ongoing. Physical count will be terminated.</p>
                </strong>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="form-group clearfix">
                        <button id="stopPhysicalCountbutton" type="button" class="btn btn-success">Continue</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
