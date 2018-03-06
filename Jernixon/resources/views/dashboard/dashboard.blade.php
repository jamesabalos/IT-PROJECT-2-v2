@extends('layouts.navbar')
{{--  @extends('layouts.app')  --}}
@section('dashboard_link')
  class="active"
@endsection

@section('headScript')
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
    <a class="navbar-brand" href="#"><i class="ti-panel"></i> Dashboard</a>
@endsection

@section('right')
    <div class="row">
        <div class="col-md-12" >
            <div class="card" >
                <div class="header">
                        <div class="row">
                                <div class="panel-heading" >
                                        <div class="row">
                                            {{--  <div class="col col-xs-5">
                                                <label><i class = "ti-search"></i> Search</label>
                                                <input type="text" onkeyup="searchItem(this)" id="dashboardSearchItem" class="form-control border-input" placeholder="Enter the name of the item">
                                                <input type="text" class="form-control border-input" placeholder="Enter the name of the item">
                                            </div>  --}}
                                            {{--  <div class="col col-xs-12 text-right">
                                                    <a href = "#openCart" data-toggle="modal" class="btn btn-lg btn-primary btn-create"><i class = "fa fa-shopping-cart"></i>
                                                        <button id="#openCart" data-toggle="modal" class='btn btn-lg btn-primary fa fa-shopping-cart '></button>
                                                    </a>
                                            </div>  --}}
                                        </div>
                                </div>
                        </div>
                        
                        <div class="row">
                           
                            <table class="table table-hover table-condensed" style="width:100%" id="dashboardDatatable">
                                <thead> 
                                    <tr>
                                        {{--  <th>Id</th>  --}}
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Quantity in Stock</th>
                                        <th>Wholesale Price</th>
                                        <th>Retail Price</th>
                                        <th>Add to Cart</th>
                                    </tr>
                                </thead>
                            {{--  <tbody id="dashboardDatatable">  --}}
                                <tbody>

                                </tbody>
                            </table>
                           
                        </div>
                        <div class="row">
                                <h4>Customer Purchase</h4>
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Customer Name: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control border-input" form="purchase" required>
                                    </div>
                                </div>
                                {{--  <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Date of Purchased</label>    
                                    </div>
                                    <div class="col-md-9">
                
                                        <span class="add-on">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                          
                                        </span>   
                                    </div>
                
                                </div>  --}}
                                
                                <div class="row"> 
                                    <div class="col-md-12 table-responsive">
                                        <table id="cartTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    {{--  <th>Id</th>  --}}
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
@section('jqueryScript')
    <script type="text/javascript">
        $(document).ready(function() {
         
             $('#dashboardDatatable').DataTable({
                "processing": true,
                "serverSide": true,
                "pagingType": "full_numbers",

                @if(Auth::guard('adminGuard')->check())
                    "ajax":  "{{ route('dashboard.getItems') }}",
                @elseif(Auth::guard('web')->check())
                    "ajax":  "{{ route('SADashboard.getItems') }}",
                @endif
                
                "columns": [
                    // {data: 'product_id'},
                    {data: 'description'},
                    {data: 'status'},
                    //{data: 'quantity'},
                    {data: 'wholesale_price'},
                    {data: 'retail_price'},
                    {data: 'action'},
                  //  {data: 'created_at'},
                    //{data: 'updated_at'},
                ],
				//responsive: true,                
			    //keys: true           
                //dom: 'Bfrtip',
                //buttons: ['excel', 'pdf','print'],
            });

        });
    </script>
@endsection
@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/canvasjs.min.js')}}"></script>

@endsection