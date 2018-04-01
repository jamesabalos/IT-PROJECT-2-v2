@extends('layouts.navbar')
{{--  @extends('layouts.app')  --}}

@section('items_link')
    class="active"
@endsection

@section('headScript')
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>

@endsection

@extends('inc.headScripts')

@section('linkName')
<div class="alert alert-success hidden" id="successDiv">
</div>
    <h3><i class = "fa fa-bars"> </i> Items</h3>
@endsection

@section('right')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class = "content">
                            <div class="content table-responsive table-full-width table-stripped">
                            <table id="tableItems" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>                                  
                                        <th>Selling Price</th>
                                        <th>Reorder Level</th>
                                    </tr>
                                </thead>
                            </table>
                            </div>

                        </div>    
                    </div>
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    
    @section('jqueryScript')
    <script type="text/javascript">      
        $(document).ready(function() {          
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#tableItems').DataTable({
                "processing": true,
                "serverSide": true,
                "pagingType": "full_numbers",

                @if(Auth::guard('adminGuard')->check())
                    "ajax":  "{{ route('items.getItems') }}",
                @elseif(Auth::guard('web')->check())
                    "ajax":  "{{ route('salesAssistant.getItems') }}",                    
                @endif

                "columns": [
                // {data: 'product_id'},
                {data: 'description'},
                {data: 'quantity'},
                {data: 'retail_price'},
                {data: 'reorder_level'},
                ]
            });
            
    
            $('#formAddNewItem').on('submit',function(e){
                e.preventDefault(); //prevent the page to load when submitting form
                //key value pair of form
                var data = $(this).serialize();
                $.ajax({
                    type:'POST',
                    // url:'admin/storeNewItem',
                    url: "{{route('admin.Newitems')}}",
                    dataType:'json',
                    /*  data:{
                        'description':'',
                        'quantityInStock':4,
                        'wholeSalePrice':10,
                        'retailPrice':15,
                    },
                */
                    //data:{data},
                    data:data,
                        //_token:$("#_token"),
                    success:function(data){
                        $("#errorDivAddNewItem p").remove();
                        $("#errorDivAddNewItem").removeClass("alert-danger hidden")
                                        .addClass("alert-success")
                                        .html("<h1>Success</h1>");
                        $("#errorDivAddNewItem").css("display:block");
                        $("#errorDivAddNewItem").slideDown("slow",function(){
                                        document.getElementById("formAddNewItem").reset();
                        })
                                        .delay(1000)                        
                                        .hide(1500);
                        $("#tableItems").DataTable().ajax.reload();
                    },
                    error:function(data){   
                        var response = data.responseJSON;
                        $("#errorDivAddNewItem").removeClass("hidden").addClass("alert-danger");
                        $("#errorDivAddNewItem").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });                      
                        
                    }
                })
                
            })



            

        });
    </script>
    @endsection
    
    
    @section('js_link')
    <!--   Core JS Files   -->
    

    {{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>  --}}
    <script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>



    
    @endsection