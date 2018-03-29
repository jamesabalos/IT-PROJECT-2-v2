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
<h3><i class=" fa fa-bars" style="margin-right: 15px"> </i>Items</h3>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class = "content">
                        <form class = "form-inline">
                            <div class="row">
                                {{--  <div class="col-md-12">
                                <label><i class = "ti-search"></i> Search</label>
                                <input type="text" onkeyup="searchItem2(this)" class="form-control border-input" placeholder="Enter name of item">
                                </div>  --}}
                            </div>
                        </form>
                        <div class="row">
                            {{--  <div class="col-md-6">
                            <ul class="nav nav-pills">
                                <li >
                                    <a href = "#addquan" data-toggle="modal"   >Add</a>
                                </li>
                                <li >
                                    <a href = "#subtract" data-toggle="modal" >Subtract </a>
                                </li>                                                      
                            </ul>
                            </div>  --}}

                            {{--  <div class="col-md-6">  --}}
                            <div class = "text-right">
                                <a href = "#addNewItemModal" data-toggle="modal" >
                                    <button type="submit" class="btn btn-info btn-fill btn-wd btn-success"><i class = "ti-plus"></i> Add new item</button> 
                                </a>       
                                {{--  <a href = "#remove" data-toggle="modal">
                                <button type="submit" class="btn btn-info btn-fill btn-wd btn-danger"><i class="ti-minus"></i> Remove item</button>
                                </a>                                              --}}
                            </div>
                            </div>
                        </div>
                        {{--  <div class="row">
                        <div id="belowAddNewItem" class="col-lg-10" style="display:none">

                        </div>      
                        </div>  --}}
                        <div class="content table-responsive table-full-width table-stripped">
                            <table id="tableItems" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        {{--  <th>Id</th>  --}}
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>created_at</th>
                                        <th>Reorder Level</th>
                                        <th>Action</th>
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
{{--  @if(count($products) > 1)
@foreach ($products as $product)
<div class="well">
    <h3>{{$product->description}}</h3>
</div>
@endforeach
@else
<h5>No items</h5>
@endif  --}}


@endsection

@section('jqueryScript')
<script type="text/javascript">

    function insertDataToModal(button){
        var data  = $(button.parentNode.parentNode.parentNode.innerHTML).slice(1,-1);
        var formId = "form"+button.id;

        if(button.id === "Edit"){
            $("#"+formId +" input")[1].value=data[0].innerHTML;
            // $("#"+formId +" input")[2].value=data[1].innerHTML;
            $("#"+formId +" input")[3].value=data[1].innerHTML;
            $("#"+formId +" input")[4].value=data[2].innerHTML;
            // $("#"+formId +" input")[5].value=data[0].innerHTML;
            // $("#"+formId +" input")[6].value=data[2].innerHTML;
            return;
        }

        $("#"+formId +" input")[1].value=data[0].innerHTML;
        // $("#"+formId +" input")[2].value=data[1].innerHTML;
        // $("#"+formId +" input")[3].value=data[0].innerHTML;
        $("#"+formId +" input")[4].value=data[1].innerHTML;
        $("#"+formId +" input")[5].value=data[2].innerHTML;
        // $("#"+formId +" input")[6].value=data[2].innerHTML;


    }
    $(document).ready(function() {
        //alert(document.querySelectorAll("#removeItemTbody tr>td:last-child button").length);

        //$("#removeItemTbody button").on("click",function(e){
        //  alert("hi");
        //alert($(this).attr("id"))
        //e.preventDefault(); //prevent the page to load when submitting form
        /*$.ajax({
                    method: 'get',
                    //url: 'items/' + document.getElementById("inputItem").value,
                    url: 'items/' + e.value,
                    dataType: "json",
                    success: function(data){

                    }
                })
                */
        //});
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
                                   {data: 'price'},
                                   {data: 'created_at'},
                                   {data: 'updated_at'},
                                   {data: 'action'},
                                   ]
                                   });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                    // document.getElementById("insertError").innerHTML = "<p>"+error.errors['description']+"</p>"
                    //alert(Object.keys(error.errors).length)
                    //console.log(error)

                }
            })

        })

        //            $('#formReturnItem').on('submit',function(e){
        //                e.preventDefault(); //prevent the page to load when submitting form
        //                //key value pair of form
        //                var data = $(this).serialize();
        //
        //                $.ajax({
        //                    type:'POST',
        //                    url:'/items/returnItem',
        //                    //dataType:'json',
        //                    data:data,
        //                    success:function(dataReceive){
        //                        $("#errorDivReturnItem p").remove();
        //                        //$("#errorDivReturnItem").removeClass("alert-danger hidden")
        //                        $("#errorDivReturnItem").removeClass("alert-danger")
        //                                                .addClass("alert-success")
        //                                                .html("<h1>Success</h1>");
        //
        //                        $("#errorDivReturnItem").css("display:block");
        //                        $("#errorDivReturnItem").slideDown("slow",function(){
        //                            document.getElementById("formReturnItem").reset();
        //                        })
        //                        .delay(1000)                        
        //                        .hide(1500);
        //                    },
        //                    error:function(dataReceived){
        //                        var response = dataReceived.responseJSON;
        //                        $("#errorDivReturnItem").removeClass("alert-success")
        //                                                .addClass("alert-danger"); 
        //                        $("#errorDivReturnItem").css("display:block");
        //                        $("#errorDivReturnItem").slideDown("slow")                                               
        //                                                .html(function(){
        //                                                    var addedHtml="";
        //                                                    for (var key in response.errors) {
        //                                                        addedHtml += "<p>"+response.errors[key]+"</p>";
        //                                                    }
        //                                                    return addedHtml;
        //                        });
        //                    
        //                    }
        //                })
        //                
        //            })
    });
</script>
@endsection

@section('modals')
<div id="addNewItemModal" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-body">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4>Add New Item</h4>
                <div class="alert alert-danger hidden" id="errorDivAddNewItem">

                </div>
                {!! Form::open(['method'=>'post','id'=>'formAddNewItem']) !!}
                {{--  <form action="" role="form">  --}}
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('description', 'Description:')}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('description','',['class'=>'form-control'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">                                
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('Quantity in stock:')}}
                        </div>
                        <div class="col-md-9">
                            {{ Form::number('quantityInStock','',['class'=>'form-control','min'=>'1']) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">   
                    <div class="row">
                        <div class="col-md-3">                                                             
                            {{Form::label('Retail Price', 'Retail Price:')}}
                        </div>
                        <div class="col-md-9">                                    
                            {{Form::number('retailPrice','',['class'=>'form-control','min'=>'1'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">    
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('Whole Sale Price', 'Whole Sale Price:')}}
                        </div>
                        <div class="col-md-9">
                            {{Form::number('wholeSalePrice','',['class'=>'form-control','min'=>'1'])}}
                        </div>
                    </div>
                </div>

                @include('inc.messages')
                {{--  </form>  --}}
                {{--  <div class="modal-footer">  --}}
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            {{--  {{Form::submit('Submit',['class'=>'btn btn-primary'])}}  --}}
                            <button id="submitNewItems" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {{--  </div>                      --}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
<div id="editModal" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            {!! Form::open(['method'=>'post','id'=>'formEdit']) !!}
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit Items</h3>
            </div>

            <div class = "modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Items
                        </strong>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('description', 'Description:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('description','',['class'=>'form-control'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Quantity in stock:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::number('quantityInStock','',['class'=>'form-control','disabled']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">   
                            <div class="row">
                                <div class="col-md-3">                                                             
                                    {{Form::label('Retail Price', 'Retail Price:')}}
                                </div>
                                <div class="col-md-9">                                    
                                    {{Form::number('retailPrice','',['class'=>'form-control','disabled'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Whole Sale Price', 'Whole Sale Price:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::number('wholeSalePrice','',['class'=>'form-control','min'=>'1','disabled'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">   
                            <div class="row">
                                <div class="col-md-3">                                                             
                                    {{Form::label('Reorder Level', 'Reorder Level:')}}
                                </div>
                                <div class="col-md-9">                                    
                                    {{Form::number('reorderLevel','',['class'=>'form-control'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitPurchases" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                @include('inc.messages')
                {!! Form::close() !!}


            </div>
        </div>
    </div>

</div>

<div id="viewHistory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'get','id'=>'formviewHistory']) !!}
            <input type="hidden" id="_token" value="{{ csrf_token() }}">

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Item History</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class=" fa fa-bars"></span>
                            List of Item History
                        </strong>
                    </div>
                    <div class="panel-body">
                       <div class="autocomplete" style="width:200px;">
                            <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Search">
                            <div id="searchResultDiv" class="searchResultDiv">
                        </div>
                        </div>
                        <div class="card">
                            <div class="container">
                                <p></p>
                                <p><b>Items Added: </b></p>
                                <p><b>Supplied by: </b></p>
                                <p><b>Date: </b></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="container">
                                <p></p>
                                <p><b>Items Added: </b></p>
                                <p><b>Supplied by: </b></p>
                                <p><b>Date: </b></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="container">
                                <p></p>
                                <p><b>Items Added: </b></p>
                                <p><b>Supplied by: </b></p>
                                <p><b>Date: </b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">                                           
                        <div class="col-md-12">   
                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>

@endsection

@section('js_link')
<!--   Core JS Files   -->


{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>




@endsection