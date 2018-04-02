@section('notifications_link')
class="active"
@endsection

@section('onload')
onload="refresh()"
@endsection

{{--  @section('ng-app')
ng-app="ourAngularJsApp"
@endsection  --}}


@section('headScript')
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<!--AngularJs-->
<script src="{{asset('assets/js/angular.min.js')}}"></script>
<script>

    function removeRow(a){
        $(a.parentNode.parentNode).hide(500,function(){
            this.remove();  
        });
        // a.parentNode.parentNode.remove();

    }

    function addRow(itemName){
        var items =[];
        var thatTbody = $("#inExchangeTbody tr td:first-child");

        for (var i = 0; i < thatTbody.length; i++) {
            items[i] = thatTbody[i].innerHTML;
        }        

        if( items.indexOf(itemName) == -1 ){ //if there is not yet in the table
            var thatTable = document.getElementById("inExchangeTbody");
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

@section('linkName')
<h3>Notifications</h3>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class = "col-md-12">
                        <a href = "#return" data-toggle="modal">
                            <div class="content table-responsive table-full-width">
                                <button type="button" class="btn btn-success">Return Item</button>
                            </div>
                        </a>
                    </div>
                    
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="dashboardDatatable">
                            <thead>
                                <tr>
                                    <th class="text-left">OR Number</th>
                                    <th class="text-left">Date Created</th>
                                    <th class="text-left">Customer</th>
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
<div id="return" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">

            {!! Form::open(['method'=>'post','id'=>'formReturn']) !!}
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
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Return Item
                        </strong>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">

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
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Date','',['class'=>'form-control','value'=>'','disabled'])}}
                                </div>
                            </div>
                        </div>


                        <div class="form-group">    
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Customer', 'Customer:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Customer','',['class'=>'form-control','value'=>'','disabled'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Return Item
                        </strong>
                    </div>
                    <div class="content table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Description</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{Form::text('Description','',['class'=>'form-control','value'=>'','disabled'])}}</td>
                                    <td>{{Form::number('Quantity','',['class'=>'form-control','min'=>'1'])}}</td>
                                    <td>{{Form::text('Price','',['class'=>'form-control','value'=>'','disabled'])}}</td>
                                    {{--  <td><input  type='text'></td>
                                    <td><input  type='text' ></td>
                                    <td><input  type='text' ></td>  --}}
                                    <td><input class='form-control' type="checkbox"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            In Exchange for
                        </strong>
                    </div>
                    <div class="content table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Description</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody id="inExchangeTbody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="autocomplete" style="width:100%;">
                    <input autocomplete="off" type="text" id="searchItemInput" onkeyup="searchItem(this)" name="item" class="form-control border-input" placeholder="Enter the name of the item">
                    <div id="searchResultDiv" class="searchResultDiv">
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button id="submitNewItems" type="submit" onclick="window.alert('to be continue..')" class="btn btn-success">Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div> 
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection


@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>


@endsection