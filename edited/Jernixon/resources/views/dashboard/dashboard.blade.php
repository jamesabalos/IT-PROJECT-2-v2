@extends('layouts.navbar')
{{--  @extends('layouts.app')  --}}
@section('dashboard_link')
class="active"
@endsection

@section('headScript')
<style >
    .panel-box{
        width: 100%;
        height: 100%;
        text-align: center;
        border: none;
        /* background-color: #eaeaea; */
        border:2px solid #eaeaea;
    }
    .panel-icon{
        padding: 30px;
        width: 40%;
        border-radius: 0;
    }.panel-icon{
        -webkit-border-radius: 3px 0 0 3px;
        -moz-border-radius: 3px 0 0 3px;
        border-radius: 3px 0 0 3px;
    }.panel-value{
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
    }.panel-value h2{
        margin-top: 30px;
    }
    .panel-icon i{
        line-height:65px;
        font-size: 40px;
        color: #fff;
    }
    .bg-green{
        background-color: #A3C86D;
    }
    .bg-blue{
        background-color: #7ACBEE;
    }
    .bg-yellow{
        background-color: #FDD761;
    }
    .bg-red{
        background-color: #FF7857;
    }
    
    
</style>
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<script>
    window.onload = function () {
        var queryDataPoints = [];
        //dataFormat= itemName,quantitySold per month..
        // $.getJSON("url:{{ route('dashboard.getDataPoints') }}", function(data) {  
            //     $.each(data, function(key, value){
                // queryDataPoints.push( {y: parseInt(value[0]),label:value[1]} );
                //     });
                
                // });
                var chart = new CanvasJS.Chart("topItemsChart", {
                    animationEnabled: true,
                    animationDuration:5000,
                    exportEnabled:true,
                    exportFileName:"Top-Items",
                    // creditText:"Jernixon",
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "Top items last February",
                        // backgroundColor:"black",
                        // fontColor:"white"
                    },
                    toolTip: {
                        shared: true  
                    },
                    axisY: {
                        title: "Quantity"
                    },
                    data: [{        
                        type: "column", //column,line,area,pie,bar,doughnut 
                        // showInLegend: true, 
                        // legendMarkerColor: "grey",
                        // legendText: "MMbbl = one million barrels",  
                        dataPoints: [      
                        { y: 80, label: "Item1" },
                        { y: 40,  label: "Item2" },
                        { y: 27,  label: "Item3" },
                        ]
                        // dataPoints: queryDataPoints,
                    }]
                    
                });
                chart.render();
                
                var chart2 = new CanvasJS.Chart("leastItemsChart", {
                    animationEnabled: true,
                    animationDuration:5000,
                    exportEnabled:true,
                    exportFileName:"Least-Items",
                    // creditText:"Jernixon",
                    theme: "dark2", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "Least items last February",
                        // backgroundColor:"black",
                        // fontColor:"white"
                    },
                    toolTip: {
                        shared: true  
                    },
                    axisY: {
                        title: "Quantity"
                    },
                    data: [{        
                        type: "column", //column,line,area,pie,bar,doughnut 
                        // showInLegend: true, 
                        // legendMarkerColor: "grey",
                        // legendText: "MMbbl = one million barrels",  
                        dataPoints: [      
                        { y: 17, label: "Item1",color:"orange" },
                        { y: 58,  label: "Item2" },
                        { y: 79,  label: "Item3" },
                        ]
                        // dataPoints: queryDataPoints,
                    }]
                    
                });
                chart2.render();
            }
            
            function searchItem(a){
                $.ajax({
                    method: 'get',
                    //url: 'items/' + document.getElementById("inputItem").value,
                    url: 'dashboard/' + a.value,
                    dataType: "json",
                    success: function(data){
                        if(a.id === "dashboardSearchItem"){
                            $("#dashboardDatatable tr").remove();                        
                            for(var i=0; i < data.length; i++){
                                var thatTable = document.getElementById("dashboardDatatable");
                                var newRow = thatTable.insertRow(-1);
                                var itemIdCell = newRow.insertCell(-1);
                                itemIdCell.innerHTML = "<td>" + data[i].product_id + "</td>";
                                var secondCell = newRow.insertCell(-1);
                                secondCell.innerHTML = "<td>" +data[i].description+ "</td>";
                                var thirdCell = newRow.insertCell(-1); 
                                thirdCell.innerHTML = "<td>query</td>";
                                var forthCell = newRow.insertCell(-1);
                                forthCell.innerHTML = "<td>" + data[i].price + "</td>";
                                var fifthCell = newRow.insertCell(-1); 
                                fifthCell.innerHTML = "<td>query</td>";
                                var sixthCell = newRow.insertCell(-1);
                                //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                                sixthCell.innerHTML = "<td><button class='btn btn-success' onclick='addItemToCart(this)'>Add</button></td>";
                            }
                        }
                        
                    }
                });
            }
            function addItemToCart(button){
                $(button).hide(500).delay(1000);
                //$(button).removeClass("btn-info").addClass("btn-danger");
                // $(button i).remove()
                //.show(500);
                //.html("<button class='btn btn-danger' onclick='addItemToCart(this)'>Remove</button>")
                
                var data  = $(button.parentNode.parentNode.innerHTML).slice(0,-1);
                var thatTbody = document.getElementById("cartTbody");
                var newRow = thatTbody.insertRow(-1);
                //newTr.innerHTML = a.parentNode.parentNode.innerHTML ;
                //thatTbody.append(newTr);
                for(var i=0; i<data.length;i++){
                    
                    newRow.insertCell(-1).innerHTML = data[i].innerHTML;
                }
                newRow.insertCell(-1).innerHTML = "<td><input type='number' value='1' min='1'></td>";
                newRow.insertCell(-1).innerHTML ="<td></td>"
                newRow.insertCell(-1).innerHTML = "<td><button class='btn btn-danger' onclick='removeRowInCart(this)'>Remove</button></td>";
            }
            function removeRowInCart(button){
                //var i = a.parentNode.parentNode.rowIndex;
                //document.getElementById("cartTable").deleteRow(i);
                var row = button.parentNode.parentNode; //row
                $(row).hide(500,function(){
                    $(row).remove();
                });
                
            }
</script>
@endsection
        
@section('linkName')
<h3>Dashboard</h3>
@endsection

@section('right')
<div class="row">
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div class="row">
                    <div class="panel-heading" >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-box clearfix">
                                    <div class="panel-icon pull-left bg-green">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                    <div class="panel-value">
                                        <h2 class="margin-top"> ? </h2>
                                        <p class="text-muted">Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-box clearfix">
                                    <div class="panel-icon pull-left bg-red">
                                        <i class="glyphicon glyphicon-list"></i>
                                    </div>
                                    <div class="panel-value">
                                        <h2 class="margin-top"> ? </h2>
                                        <p class="text-muted">Accessories</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-box clearfix">
                                    <div class="panel-icon pull-left bg-blue">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </div>
                                    <div class="panel-value ">
                                        <h2 class="margin-top"> ? </h2>
                                        <p class="text-muted">Motorparts</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                {{--  <div class="row">
                    
                    <table class="table table-hover table-condensed" style="width:100%" id="dashboardDatatable">
                        <thead> 
                            <tr>
                                
                                <th>Description</th>
                                <th>Category</th>
                                <th>Quantity in Stock</th>
                                <th>Wholesale Price</th>
                                <th>Retail Price</th>
                                <th>Add to Cart</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                    </table>
                    
                </div>  --}}
                {{--  <div class="row">
                    <h4>Customer Purchase</h4>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label>Customer Name: </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control border-input" form="purchase" required>
                        </div>
                    </div>
                    
                    
                    <div class="row"> 
                        <div class="col-md-12 table-responsive">
                            <table id="cartTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <td>Item</td>
                                        <td>Quantity Left</td>
                                        <td>Wholesale Price</td>
                                        <td>Retail Price</td>
                                        <td>Quantity Purchase</td>
                                        <td>Total Price</td>
                                        <td>Action</td>
                                    </tr> 
                                </thead>
                                <tbody id="cartTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right">                                           
                            <div class="col-md-5">                                                    
                                <button class="btn btn-primary" onclick="window.alert('to be continue..')">Submit</button>
                                
                            </div>                             
                        </div>
                        <div class="col-md-4 text-right">
                            <label>Total Price: </label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" disabled class="form-control border-input" form="purchase" value="0">
                        </div>
                    </div>
                </div>                            
                --}}
                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div id="topItemsChart" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div id="leastItemsChart" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

@endsection     

@section('modals')
{{--  <div id="openCart" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-body">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4>Customer Purchase</h4>
                <div class="row">
                    <div class="col-md-3 text-right">
                        <label>Customer Name: </label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control border-input" form="purchase" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-right">
                        <label>Date of Purchased</label>    
                    </div>
                    <div class="col-md-9">
                        
                        <span class="add-on">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            
                        </span>   
                    </div>
                    
                </div>
                
                <div class="row"> 
                    <div class="col-md-12 table-responsive">
                        <table id="cartTable" class="table table-striped table-bordered table-list">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Item</th>
                                    <th>Quantity Left</th>
                                    <th>Wholesale Price</th>
                                    <th>Retail Price</th>
                                    <th>Quantity Purchase</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr> 
                            </thead>
                            <tbody id="cartTbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            <label>Total Price: </label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" disabled class="form-control border-input" form="purchase" value="0">
                        </div>
                        <div class="text-right">                                           
                            <div class="col-md-4">                                                    
                                <button class="btn btn-primary" onclick="window.alert('to be continue..')">Submit</button>
                                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  --}}
@endsection

@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
<script src="{{asset('assets/js/canvasjs.min.js')}}"></script>

@endsection