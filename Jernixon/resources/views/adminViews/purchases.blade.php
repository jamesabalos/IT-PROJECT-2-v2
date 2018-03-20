@extends('layouts.navbar')
@section('purchases_link')
class="active"
@endsection

{{--  @section('onload')
onload="refresh()"
@endsection  --}}

{{--  @section('ng-app')
ng-app="ourAngularJsApp"
@endsection  --}}
@section('linkName')
<h3>Purchases</h3>
@endsection

@section('headScript')
<script type="text/javascript">
    function addRow(itemName){
        var items =[];
        var thatTbody = $("#purchasetable tr td:first-child");

        for (var i = 0; i < thatTbody.length; i++) {
            items[i] = thatTbody[i].innerHTML;
        }

        if( items.indexOf(itemName) == -1 ){ //if there is not yet in the table
        
            var thatTable = document.getElementById("purchasetable");
            var newRow = thatTable.insertRow(-1);

            newRow.insertCell(-1).innerHTML = "<td>" +itemName+ "</td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' min='1' class='form-control'></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' min='1' class='form-control'></td>";
            newRow.insertCell(-1).innerHTML = "<td><button type='button' onclick='removeRow(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
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

        document.addEventListener("click", function (e) {
            document.getElementById("searchResultDiv").innerHTML = "";
        });
        function removeRow(a){
            $(a.parentNode.parentNode).hide(500,function(){
              this.remove();  
            });
            // a.parentNode.parentNode.remove();

        }

    $(document).ready(function(){
        $('#formPurchaseOrder').on('submit',function(e){
                e.preventDefault();
            alert("clicked")

        })
        
    });
        
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

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class = "col-md-12">
                        <a href = "#purchase" data-toggle="modal">
                            <div class="content table-responsive table-full-width">
                            <button type="button" class="btn btn-success">Create Purchase Order</button>
                            </div>
                        </a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="dashboardDatatable">
                            <thead>
                                <tr>
                                    <th class="text-left">PO ID</th>
                                    <th class="text-left">Date Created </th>
                                    <th class="text-left">Supplier</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Action</th>
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
<div id="purchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

             {!! Form::open(['method'=>'get','id'=>'formPurchaseOrder']) !!}
            <input type="hidden" id="_token" value="{{ csrf_token() }}">

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Purchase Order</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Purchase Order
                        </strong>
                    </div>
                    <div class="panel-body">
                        {{--  <input type="hidden" id="_token" value="{{ csrf_token() }}">  --}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Date','',['class'=>'form-control','value'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Official Receipt No:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::number('Official Receipt No','',['class'=>'form-control','placeholder'=>'Official Receipt No','min'=>'1']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Supplier', 'Supplier:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Supplier','',['class'=>'form-control','value'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Quantity</th>
                                        <th class="text-left">Price</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="purchasetable">
                                </tbody>
                            </table>

                            <div class="autocomplete" style="width:100%;">
                                <input autocomplete="off" type="text" id="searchItemInput" name="item" onkeyup="searchItem(this)" class="form-control border-input" placeholder="Enter the name of the item">
                                <div id="searchResultDiv" class="searchResultDiv">
                                        {{--  <div>
                                            <strong>Phi</strong>lippines
                                            <input type="hidden" value="Philippines">
                                        </div>  --}}
                                </div>
                            </div>
                                
                        </div> 
                    </div>
                </div>
                {{--  <button type="button" class="btn btn-info btn-fill btn-wd btn-success" onclick="addRow()">Add Row</button>  --}}
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitPurchases" type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
<script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection