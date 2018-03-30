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

    .morris-hover {
  position:absolute;
  z-index:1000;
}

.morris-hover.morris-default-style {     border-radius:10px;
  padding:6px;
  color:#666;
  background:rgba(255, 255, 255, 0.8);
  border:solid 2px rgba(230, 230, 230, 0.8);
  font-family:sans-serif;
  font-size:12px;
  text-align:center;
}

.morris-hover.morris-default-style .morris-hover-row-label {
  font-weight:bold;
  margin:0.25em 0;
}

.morris-hover.morris-default-style .morris-hover-point {
  white-space:nowrap;
  margin:0.1em 0;
}

svg { width: 100%; }
    
    
</style>
<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>

<!-- Chart -->
<link href="{{asset('assets/css/buttons.morris.css')}}" rel="stylesheet"/>

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


        <?php 
            //index.php
            $connect = mysqli_connect("localhost", "root", "", "inventory_jernixon");
			//top items query
            $queryTopItems = "SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) group by product_id limit 10";
            $result = mysqli_query($connect, $queryTopItems);
			
            $chart_data_top_items = '';
            while($row = mysqli_fetch_array($result))
            {
             $chart_data_top_items .= "{name:'".$row["name"]."', population:".$row["quantity"]."}, ";
            }
            $chart_data_top_items = substr($chart_data_top_items, 0, -2);
			//least items query
			$queryLeastItems = "SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) group by product_id order by quantity asc limit 10";
            $result = mysqli_query($connect, $queryLeastItems);
			
            $chart_data_least_items = '';
            while($row = mysqli_fetch_array($result))
            {
             $chart_data_least_items .= "{name:'".$row["name"]."', population:".$row["quantity"]."}, ";
            }
            $chart_data_least_items = substr($chart_data_least_items, 0, -2);
        ?>

        


<!-- <link rel="stylesheet" href="https://www.cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" /> -->
<script src="{{asset('assets/js/raphael2.1.0.js')}}"></script>
<script src="{{asset('assets/js/jqueryv1.8.2.js')}}"></script>
<script src="{{asset('assets/js/morrisv05.js')}}"></script>
@endsection
        
@section('linkName')
<h3><i class="fa fa-fw fa-dashboard"></i> Dashboard</h3>
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
                                        <h2 class="margin-top"> 

                                             <?php 
                                                //index.php
                                                //$connect = mysqli_connect("localhost", "root", "db.password", "inventory_jernixon");
                                                $query = "SELECT COUNT(id) as id from users where status='active'";
                                                $result = mysqli_query($connect, $query);
                                                $row = $result->fetch_assoc();
                                                print_r($row["id"]);
                                                
                                            ?> 

                                        </h2>
                                        <p class="text-muted" >Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-box clearfix">
                                    <div class="panel-icon pull-left bg-red">
                                        <i class="glyphicon glyphicon-list"></i>
                                    </div>
                                    <div class="panel-value">
                                        <h2 class="margin-top">
                                        
                                            <?php 
                                                //index.php
                                                //$connect = mysqli_connect("localhost", "root", "db.password", "inventory_jernixon");
                                                $query = "SELECT COUNT(product_id) as product_id from products where status='available'";
                                                $result = mysqli_query($connect, $query);
                                                $row = $result->fetch_assoc();
                                                print_r($row["product_id"]);
                                                
                                            ?>
                                            
                                        </h2>
                                        <p class="text-muted">Total Items</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-box clearfix">
                                    <div class="panel-icon pull-left bg-blue">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </div>
                                    <div class="panel-value ">
                                        <h2 class="margin-top">
                                            
                                        <?php 
                                                //index.php
                                                //$connect = mysqli_connect("localhost", "root", "db.password", "inventory_jernixon");
                                                $query = "SELECT product_id from products where status='available'";
                                                $result = mysqli_query($connect, $query);
												$row = $result->fetch_assoc();
												$count = 0;
												while($row = mysqli_fetch_array($result)){
													$dataQuery = "SELECT product_id from products join salable_items using(product_id) where status='available' and quantity < (Select reorder_level from products where product_id='" .$row['product_id']. "')";
													
													$dataResult = mysqli_query($connect, $dataQuery);
													$dataRow = $dataResult->fetch_assoc();
													
													if (mysqli_num_rows($dataResult)!=0){
														$count++;
													}
													// while($rowData = mysqli_fetch_array($data)){
														// $count++;
													// }
												}
                                                echo($count);
                                                
                                            ?> 
                                            
                                        </h2>
                                        <p class="text-muted">Re-order</p>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Top Items
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bar-chart-top-items"></div>
                            </div>
                        </div>
                    </div>
                  </div>
				  <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Least Items
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bar-chart"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- end of chart -->              
            </div>
        </div>
    </div>
</div>

<!--
<div class="row">
    <div class="col-md-12" >
        <div class="card" >
            <div class="header">
                <div id="topItemsChart" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
-->


@endsection     



@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
<script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
<script src="{{asset('assets/js/canvasjs.min.js')}}"></script>

<!-- Chart -->
<!-- <script src="{{asset('assets/js/morris-data.js')}}"></script> -->
<script src="{{asset('assets/js/morris.min.js')}}"></script>
<script src="{{asset('assets/js/morris.js')}}"></script>


<script type="text/javascript">
$(document).ready(function() {
  barChartTopItems();
  barChartLeastItems();
  $(window).resize(function() {
    window.barChartTopItems.redraw();
	window.barChartLeastItems.redraw();
  });
});

function barChartTopItems() {
  window.barChartTopItems = Morris.Bar({
    element: 'bar-chart-top-items',
    data: [<?php echo $chart_data_top_items; ?>],
    xkey: 'name',
    ykeys: ['population'],
    labels: ['population'],
    lineColors: ['#1e88e5'],
    lineWidth: '3px',
    resize: true,
    redraw: true
  });
}
  
function barChartLeastItems() {
  window.barChartLeastItems = Morris.Bar({
    element: 'bar-chart',
    data: [<?php echo $chart_data_least_items; ?>],
    xkey: 'name',
    ykeys: ['population'],
    labels: ['population'],
    lineColors: ['#1e88e5'],
    lineWidth: '3px',
    resize: true,
    redraw: true
  });
}

</script>


@endsection