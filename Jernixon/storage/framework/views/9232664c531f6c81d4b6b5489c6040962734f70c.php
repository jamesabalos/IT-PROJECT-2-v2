<?php $__env->startSection('dashboard_link'); ?>
class="active"
<?php $__env->stopSection(); ?>

<?php $__env->startSection('headScript'); ?>

    <!-- DataTables -->

    <link href="<?php echo e(asset('assets/css/datatables.min.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(asset('assets/css/buttons.dataTables.min.css')); ?>" rel="stylesheet"/>

    <!-- Chart -->
    <link href="<?php echo e(asset('assets/css/morris.css')); ?>" rel="stylesheet"/>

    <!-- Chart JS -->
    <script src="<?php echo e(asset('assets/js/raphael2.1.0.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jqueryv1.8.2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/morrisv05.js')); ?>"></script>

<script>
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
    $queryTopItems = "SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) group by product_id order by quantity desc limit 10";
    $result = mysqli_query($connect, $queryTopItems);
    
    $chart_data_top_items = '';

    while($row = mysqli_fetch_array($result))
    {

     $chart_data_top_items .= "{name:'".$row["name"]."', quantity:".$row["quantity"]."}, ";

    }

    $chart_data_top_items = substr($chart_data_top_items, 0, -2);
    //least items query
    $queryLeastItems = "SELECT description as name, sum(quantity) as quantity FROM products inner join sales using(product_id) group by product_id order by quantity asc limit 10";
    $result = mysqli_query($connect, $queryLeastItems);
    
    $chart_data_least_items = '';
    while($row = mysqli_fetch_array($result))
    {

     $chart_data_least_items .= "{name:'".$row["name"]."', quantity:".$row["quantity"]."}, ";

    }

    $chart_data_least_items = substr($chart_data_least_items, 0, -2);
?>
<?php $__env->stopSection(); ?>
        
<?php $__env->startSection('linkName'); ?>
    <h3><i class="fa fa-fw fa-dashboard"></i> Dashboard</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('right'); ?>
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
                                                do{
                                                    $dataQuery = "SELECT product_id from products join salable_items using(product_id) where product_id='".$row['product_id']."' and status='available' and quantity <= (Select reorder_level from products where product_id='".$row['product_id']."')";
                                                    
                                                    $dataResult = mysqli_query($connect, $dataQuery);
                                                    $dataRow = $dataResult->fetch_assoc();
                                                    
                                                    if (mysqli_num_rows($dataResult)!=0){
                                                        $count++;
                                                    }
                                                    // while($rowData = mysqli_fetch_array($data)){
                                                        // $count++;
                                                    // }
                                                }while($row = mysqli_fetch_array($result));
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
                        <div class="hidden alert-danger text-center">
                        </div>
                        <i class="fa fa-bar-chart-o fa-fw"></i> Fast Moving Items
                        <br>
                        <label for="from">From</label>
                        <input type="date">
                        <label for="to">to</label>
                        <input type="date">
                        <button id="FMI" onclick="createSlowFastMovingItem(this)">Filter</button>
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
                        <div class="hidden alert-danger text-center">
                        </div>
                        <i class="fa fa-bar-chart-o fa-fw"></i> Slow Moving Items
                        <br>
                        <label for="from">From</label>
                        <input type="date">
                        <label for="to">to</label>
                        <input type="date">
                        <button id="SMI" onclick="createSlowFastMovingItem(this)">Filter</button>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="bar-chart-least-items"></div>
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


<?php $__env->stopSection(); ?>     



<?php $__env->startSection('js_link'); ?>
<!--   Core JS Files   -->
<script src="<?php echo e(asset('assets/js/jquery-1.12.4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
<!-- Chart -->
<script src="<?php echo e(asset('assets/js/morris.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/morris.js')); ?>"></script>


<script type="text/javascript">
$(document).ready(function() {
  barChartTopItems();
  barChartLeastItems();
  $(window).resize(function() {
    window.barChartTopItems.redraw();
    window.barChartLeastItems.redraw();
  });
});
function createSlowFastMovingItem(button){
        var smiORfmi = button.id;
        // var dateFrom = document.getElementById("from").value;
        // var dateTo = document.getElementById("to").value;
        var dateFrom = button.parentNode.children[4].value;
        var dateTo = button.parentNode.children[6].value;

        var newDateFrom = new Date(dateFrom);
        newDateFrom.setDate(newDateFrom.getDate() - 1);
        
        var ddf = newDateFrom.getDate();
        var mmf = newDateFrom.getMonth() + 1;
        var yf = newDateFrom.getFullYear();

        var newDateTo = new Date(dateTo);
        newDateTo.setDate(newDateTo.getDate() + 1);

        var ddt = newDateTo.getDate();
        var mmt = newDateTo.getMonth() + 1;
        var yt = newDateTo.getFullYear();

        var formattedDateFrom = yf + '-' + mmf + '-' + ddf;
        var formattedDateTo = yt + '-' + mmt + '-' + ddt;

         $.ajax({
            type:'GET',
            url: "<?php echo e(route('reports.validateDateRange')); ?>",
            data: {
                'dateFrom':dateFrom,
                'dateTo':dateTo,
            },
            success:function(data){
                var url1 = "<?php echo e(route('admin.dashboard.createFastMovingItem')); ?>";
                var url2 = "<?php echo e(route('admin.dashboard.createSlowMovingItem')); ?>";
                
                $.ajax({
                    type: 'GET',
                    url: ( smiORfmi === "FMI" ? url1 : url2),
                    data: {
                        "dateFrom":formattedDateFrom,
                        "dateTo":formattedDateTo
                        
                    },
                    success: function(response)
                    {
                        if(response.length == 0){
                            $(button.parentNode.firstElementChild).hide(500);
                            $(button.parentNode.firstElementChild).removeClass("hidden");
                            $(button.parentNode.firstElementChild).slideDown("slow", function() {
                            $(button.parentNode.firstElementChild).html(function(){
                                return "no result";
                            });

                            });
                        }else{
                            $(button.parentNode.firstElementChild).hide(1000);
                            if(smiORfmi === "FMI"){
                                $('#bar-chart-top-items').empty(); //reinitialize chart
                                    window.barChartTopItems = Morris.Bar({
                                    element: 'bar-chart-top-items',
                                    data: response,
                                    xkey: 'name',
                                    ykeys: ['quantity'],
                                    labels: ['Qty sold'],
                                    lineColors: ['#1e88e5'],
                                    lineWidth: '3px',
                                    resize: true,
                                    redraw: true
                                });
                            }else{
                                $('#bar-chart-least-items').empty(); //reinitialize chart
                                    window.barChartLeastItems = Morris.Bar({
                                    element: 'bar-chart-least-items',
                                    data: response,
                                    xkey: 'name',
                                    ykeys: ['quantity'],
                                    labels: ['Qty sold'],
                                    lineColors: ['#1e88e5'],
                                    lineWidth: '3px',
                                    resize: true,
                                    redraw: true
                                });
                            }  
                        }
                    },
                    error: function(response){
                        console.log("errorr!");
                    }
                });
            },
            error:function(data){
                var response = data.responseJSON;
                console.log(response);
                $(button.parentNode.firstElementChild).hide(500);
                $(button.parentNode.firstElementChild).removeClass("hidden");
                $(button.parentNode.firstElementChild).slideDown("slow", function() {
                    $(button.parentNode.firstElementChild).html(function(){
                        var addedHtml="";
                        for (var key in response.errors) {
                            addedHtml += "<p>"+response.errors[key]+"</p>";
                        }
                        return addedHtml;
                    });

                });
            }
         });
}

function barChartTopItems() {
  window.barChartTopItems = Morris.Bar({
    element: 'bar-chart-top-items',
    data: [<?php echo $chart_data_top_items; ?>],
    xkey: 'name',
    ykeys: ['quantity'],
    labels: ['Qty sold'],
    lineColors: ['#1e88e5'],
    lineWidth: '3px',
    resize: true,
    redraw: true
  });
  console.log(<?php echo $chart_data_top_items; ?>)
}
  
function barChartLeastItems() {
  window.barChartLeastItems = Morris.Bar({
    element: 'bar-chart-least-items',
    data: [<?php echo $chart_data_least_items; ?>],
    xkey: 'name',
    ykeys: ['quantity'],
    labels: ['Qty sold'],
    lineColors: ['#1e88e5'],
    lineWidth: '3px',
    resize: true,
    redraw: true
  });
}

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>