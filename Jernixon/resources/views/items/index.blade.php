@extends('layouts.navbar')
{{--  @extends('layouts.app')  --}}

@section('items_link')
class="active"
@endsection

@section('headScript')
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
@endsection

@extends('inc.headScripts')

@section('linkName')
<div class="alert alert-success hidden" id="successDiv">
</div>
<h3><i class=" fa fa-bars" style="margin-right: 10px"></i> Items</h3>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class = "content">
                        <a href = "#addNewItemModal" data-toggle="modal" >
                            <button type="button" class="btn btn-success"><i class = "fa fa-plus"></i> Add new Item</button>
                        </a>        
                        <!--
<form class = "form-inline">
<div class="row">
{{--  <div class="col-md-12">
<label><i class = "ti-search"></i> Search</label>
<input type="text" onkeyup="searchItem2(this)" class="form-control border-input" placeholder="Enter name of item">
</div>  --}}
</div>
</form>
-->
                        <!--
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
<a href = "#addNewItemModal" data-toggle="modal" >
<button type="button" class="btn btn-success"><i class = "ti-plus"></i>Add new Item</button>
</a>        

</div>
</div>
-->
                        {{--  <div class="row">
                        <div id="belowAddNewItem" class="col-lg-10" style="display:none">

                        </div>      
                        </div>  --}}
                        <div class="content table-responsive table-full-width">
                            <table id="tableItems" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Qty</th>
                                        <th class="text-left" style="width: 5%">Purchase Price</th>
                                        <th class="text-left" style="width: 5%">Selling Price</th>
                                        <th class="text-left" style="width: 5%">Reorder Level</th>
                                        <!--th>Created At</th>
                                        <th>Updated At</th-->
                                        <th class="text-left">Action</th>
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
        var data  = $(button.parentNode.parentNode.parentNode.innerHTML).slice(0,-1);
        document.getElementById("itemDescription").value = data[0].innerHTML;
        document.getElementById("itemQuantity").value = data[1].innerHTML;
        document.getElementById("itemWholeSalePrice").value = data[2].innerHTML;
        document.getElementById("itemRetailPrice").value = data[3].innerHTML;
        document.getElementById("itemReorderLevel").value = data[4].innerHTML;
        document.getElementById("productId").value = button.parentNode.parentNode.lastChild.id;

        $("#errorDivEditItem").html("");

    }
    function checkItemQuantity(button){
        var quantityLeft = button.parentNode.parentNode.childNodes[1].innerHTML;
        if(button.childNodes[1].nodeValue === "Enable"){
            formUpdateChangeStatus(button.childNodes[1].nodeValue,button.id);
        }else{
            if(quantityLeft !== "0"){
                $('#disableConfirmation').modal('show');                   
                document.getElementById("itemQuantityLeft").innerHTML = quantityLeft;
                document.getElementById("statusAndId").setAttribute("data-status",button.childNodes[1].nodeValue);
                document.getElementById("statusAndId").setAttribute("data-item",button.id);
            }else{
                formUpdateChangeStatus(button.childNodes[1].nodeValue,button.id);
            }
        }
    }
    function formUpdateChangeStatus(buttonValue,itemId){
        // button.preventDefault(); //prevent the page to load when submitting form
        // var fullRoute = "/admin/items/updateStatus/"+button.currentTarget.attributes[0].value; //id
         var fullRoute = "/admin/items/updateStatus"; //id
            var status = "";
            if( buttonValue === "Enable"){
                status="unavailable";
            }else{
                status="available";
            }
            $.ajax({
                type:'Post',
                url: fullRoute,
                dataType:'json',
                data:{
                    'itemId':itemId,
                    'status': status //'status': unavailable | available 
                },
                success:function(data){
                    $('#disableConfirmation').modal('hide');                                       
                    $("#tableItems").DataTable().ajax.reload();//reload the dataTables                        

                }
            });

    }
    function viewItemHistory(button){
        var fullRoute = "/admin/items/viewHistory/" + button.parentNode.nextSibling.id; //id

        $.ajax({
            type:'Get',
            url: fullRoute,
            // dataType:"json",
            success:function(data){
                $("#historyTbody tr").remove();
                
                var result = "";
//                 for (var i = 0; i < data.length; i++) {
//                     result += "<div class='card'>";
//                     if(data[i][0] === "added"){
//                         result += "<div class='card-container bg-success' style='padding: 1em; margin-bottom: -1.7em'>\
// <p style='font-size: 12px'><b>"+data[i][3]+" Item(s) Added</b></p>\
// <p style='font-size: 12px'><b>Supplied by " +data[i][4]+ "</b></p>\
// <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
//     </div>\
//     </div>";
//                     }else{
//                         if(data[i][1] === "bought"){
//                             result += "<div class='card-container bg-danger' style='padding: 1em; margin-bottom: -1.7em'>\
// <p style='font-size: 12px'><b>"+data[i][3]+" Item(s) Subtracted</b></p>\
// <p style='font-size: 12px'><b>Bought by " +data[i][4]+ "</b></p>\
// <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
//     </div>\
//     </div>";

//                         }else if(data[i][1] === "damaged"){
//                             result += "<div class='card-container bg-danger' style='padding: 1em; margin-bottom: -1.7em'>\
// <p style='font-size: 12px'><b>"+data[i][3]+" Item(s) Subtracted</b></p>\
// <p style='font-size: 12px'><b>Damaged item.</b></p>\
// <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
//     </div>\
//     </div>";
//                         }else{
//                             result += "<div class='card-container bg-danger' style='padding: 1em; margin-bottom: -1.7em'>\
// <p style='font-size: 12px'><b>"+data[i][3]+" Item(s) Subtracted</b></p>\
// <p style='font-size: 12px'><b>Lost item.</b></p>\
// <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
//     </div>\
//     </div>";
//                         }

//                     }
//                 }
                var thatTbody = document.getElementById("historyTbody");
                if(data.length == 0){
                    thatTbody.insertRow(-1).innerHTML = "<td colspan='5' class='text-center'>No history</td>"
                }else{
                    console.log(data)
                    for (var i = 0; i < data.length; i++) {
                        var newRow = thatTbody.insertRow(-1);
                        var rows = $("#historyTbody tr");
                        if(data[i][0] === "Added"){
                            rows[rows.length-1].setAttribute("style","background-color:#66cc66")
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][3]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][0]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][4]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][5]+ "</td>";

                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][1]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i]['date']+ "</td>";
                        }else{
                            rows[rows.length-1].setAttribute("style","background-color:#ff6666")                                        
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][3]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][0]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][4]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][5]+ "</td>";
                            
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i][1]+ "</td>";
                            newRow.insertCell(-1).innerHTML = "<td>" +data[i]['date']+ "</td>";
                        }
                    }
                }

                // document.getElementById("historyResult").innerHTML = "";
                // document.getElementById("historyResult").innerHTML = result;



            }
        });
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
            {data: 'description', 
            name: 'products.description'},
            {data: 'quantity', 
            name: 'salable_items.quantity'},
            {data: 'wholesale_price', 
            name: 'salable_items.wholesale_price'},
            {data: 'retail_price', 
            name: 'salable_items.retail_price'},
            {data: 'reorder_level'},
            // {data: 'created_at'},
            // {data: 'updated_at'},
            {data: 'action'},
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
                    $("#errorDivAddNewItem").hide(500);
                    $("#errorDivAddNewItem").removeClass("hidden");
                    $("#errorDivAddNewItem").slideDown("slow", function() {                    
                        var response = data.responseJSON;
                        $("#errorDivAddNewItem").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });
                    });
                    // document.getElementById("insertError").innerHTML = "<p>"+error.errors['description']+"</p>"
                    //alert(Object.keys(error.errors).length)
                    //console.log(error)

                }
            })

        })



        $('#formEdit').on('submit',function(e){
            e.preventDefault(); //prevent the page to load when submitting form
            //key value pair of form
            var data = $(this).serialize();
            console.log(data)
            $.ajax({
                type:'POST',
                url: "{{route('admin.editItem')}}",
                data:data,
                success:function(data){
                    $('#editModal').modal('hide') ;                   
                    //prompt the message
                    // $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                    // .addClass("alert-success")
                        .html("<h3>Edit successful</h3>");
                    $("#successDiv").css("display:block");                             
                    $("#successDiv").slideDown("slow")
                        .delay(1000)                        
                        .hide(1500);
                    $("#tableItems").DataTable().ajax.reload();//reload the dataTables

                },
                error: function(data){
                    var response = data.responseJSON;
                    $("#errorDivEditItem").removeClass("hidden").addClass("alert-danger text-center");
                    $("#errorDivEditItem").html(function(){
                        var addedHtml="";
                        for (var key in response.errors) {
                            addedHtml += "<p>"+response.errors[key]+"</p>";
                        }
                        return addedHtml;
                    });
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
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class = "modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class=" fa fa-plus" style="margin-right: 5px"></i> Add New Item</h3>
            </div>
            <div class = "modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-plus"></span>
                            New Item
                        </strong>
                    </div>
                    {!! Form::open(['method'=>'post','id'=>'formAddNewItem']) !!}
                    <div class="panel-heading">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('description', 'Description:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('description','',['class'=>'form-control','placeholder'=>'Description'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Reorder Level:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::number('reorderLevel','',['class'=>'form-control','placeholder'=>'Reorder Level','min'=>'1']) }}
                                </div>
                            </div>
                        </div>
                        @include('inc.messages')
                    </div>
                </div>
                <div class="alert alert-danger hidden text-center" id="errorDivAddNewItem">
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            {{--  {{Form::submit('Submit',['class'=>'btn btn-primary'])}}  --}}
                            <button id="submitNewItems" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div id="editModal" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class="modal-header">
                <div id="errorDivEditItem" class="hidden">

                </div>
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class=" fa fa-edit" style="margin-right: 10px"></i> Edit</h3>
            </div>
            {!! Form::open(['method'=>'post','id'=>'formEdit']) !!}
            {{--  <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    {{Form::label('id', 'Id:')}}
                </div>
                <div class="col-md-9">
                    {{Form::text('id','',['class'=>'form-control','disabled'])}}
                </div>
            </div>
            </div>  --}}
            <input type="hidden" id="productId" name="productId" >
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Information
                        </strong>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('description', 'Description:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('description','',['class'=>'form-control','id'=>'itemDescription'])}}
                                    {{--  <input type="text" id="itemDescription" class="form-control">  --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Qty in stock:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::number('quantityInStock','',['class'=>'form-control','disabled','id'=>'itemQuantity']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Purchase Price', 'Purchase Price:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::number('wholeSalePrice','',['class'=>'form-control','min'=>'1','disabled','id'=>'itemWholeSalePrice'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">   
                            <div class="row">
                                <div class="col-md-3">                                                             
                                    {{Form::label('Selling Price', 'Selling Price:')}}
                                </div>
                                <div class="col-md-9">                                    
                                    {{Form::number('retailPrice','',['class'=>'form-control','id'=>'itemRetailPrice'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">   
                            <div class="row">
                                <div class="col-md-3">                                                             
                                    {{Form::label('Reorder Level', 'Reorder Level:')}}
                                </div>
                                <div class="col-md-9">                                    
                                    {{Form::number('reOrder Level','',['class'=>'form-control','id'=>'itemReorderLevel'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="text-right">                                           
                            <div class="col-md-12">   
                                {{--  {{Form::submit('Submit',['class'=>'btn btn-primary'])}}  --}}
                                <button id="submitAddQuantity" type="submit" class="btn btn-success">Save</button>
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @include('inc.messages')
            {{--  </form>  --}}
        {{--  <div class="modal-footer">  --}}
        </div>
    </div>

</div>
<div id="disableConfirmation" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class = "modal-body">
                <button class="close" data-dismiss="modal">&times;</button>
                <p class="text-center"> There are still <span id="itemQuantityLeft"></span> left. Do you want to continue? </p>
                <div class="panel-body">
                    <div class="text-center">
                     
                            <button id="statusAndId" data-status="" data-item="" type="button" onclick="formUpdateChangeStatus(this.dataset.status,this.dataset.item)" class="btn btn-success">Continue</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<div id="viewHistory" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
                <div class="modal-header">
                        <div id="errorDivEditItem" class="hidden">
        
                        </div>
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><i class=" fa fa-history" style="margin-right: 8px"></i> History</h3>
                    </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class=" fa fa-bars"></span>
                            List of Item History
                        </strong>
                    </div>
                    <div class="panel-body" style="overflow-y: scroll; max-height:60%;">
                        {{-- <div class="autocomplete" style="width:200px;">
                            <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Search">
                            <div id="searchResultDiv" class="searchResultDiv">
                            </div>
                        </div>
                        <div id="historyResult">
                        </div> --}}
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left">No. of items</th>
                                        <th class="text-left">Action</th>
                                        <th class="text-left">Bought/Supplied/Stock adjusted by</th>
                                        <th class="text-right">Amount</th>
										<th class="text-left">Reason</th>
                                        <th class="text-left">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTbody">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
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
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
@endsection