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
<div class="alert alert-success hidden" id="successDiv">

</div>
<h3><i class="fa fa-cube" style="margin-right: 10px"></i> Physical Count</h3>
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
    function continueSubmit(){
        var data = $("#formPhysicalCount").serialize();     
        $.ajax({
			type:'Post',
			url: "{{route('salesAssistant.submitPhysicalCount')}}",
            data:data,
			success:function(data){
               console.log(data)
               $('#continueSubmitModal').modal('hide');
               document.getElementById("formPhysicalCount").reset(); //reset the form
        
                //prompt the message
                $("#successDiv p").remove();
                $("#successDiv").removeClass("hidden")
                // .addClass("alert-success")
                        .html("<h3>Physical Count successful</h3>");
                $("#successDiv").css("display:block");                             
                $("#successDiv").slideDown("slow")
                    .delay(1000)                        
                    .hide(1500);
                    location.reload();
			}
		});
    }

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

        
              "ajax":  "{{ route('salesAssistant.getPhysicalCount') }}",
              "columns": [
                  {data: 'description'},
                  {data: 'action'},
                //   {data: 'counted_quantity'},
              ]
          });



        
      });


</script>

@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="content table-responsive table-full-width">
                    {!! Form::open(['method'=>'post','id'=>'formPhysicalCount']) !!}
                        <table class="table table-bordered table-striped" id="physicalCountDataTable">
                            <thead>
                                <tr>
                                    <th class="text-left">Item Name</th>
                                    <th class="text-left">Quantity</th>
                                    {{-- <th class="text-left">Counted Quantity</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                    
                    <a href = "#continueSubmitModal" data-toggle="modal">
                        <button id="triggerButton" type="button" class="btn btn-success">Submit</button>
                    </a>
                        

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')
<div id="continueSubmitModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <p></p>
            </div>
            <div class="text-center">
                <strong>
                    <h3> <i class="fa fa-exclamation-triangle" style="margin-right: 15px"> </i> Submit Physical Count? </h3>
                    <!--p>You won't be able to change your input.</p-->
                </strong>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="form-group clearfix">
                        <button onclick="continueSubmit()" type="button" class="btn btn-success">Continue</button>
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
