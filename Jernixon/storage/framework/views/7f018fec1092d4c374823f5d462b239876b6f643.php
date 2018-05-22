<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>Jernixon Motorparts and Accessories</title>
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('assets/img/logo3.png')); ?>">
    
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" />
    
    
    <!-- Animation library for notifications   -->
    <link href="<?php echo e(asset('assets/css/animate.min.css')); ?>" rel="stylesheet"/>
    
    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo e(asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')); ?>" rel="stylesheet"/>
    
    <!--     Fonts and icons     -->
    <link href="<?php echo e(asset('assets/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    
    <script src="<?php echo e(asset('assets/js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chartist.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap-notify.js')); ?>"></script>
    
    
    
    
    
    
    <?php echo $__env->yieldContent('headScript'); ?>
    <script type="text/javascript">
    var notifications = "";
    //     function getNotifications(){
    //         $.ajax({
    //             method: 'get',
    //             //url: 'items/' + document.getElementById("inputItem").value,
    //             url:"<?php echo e(route('admin.notification')); ?>",
                
    //             success: function(data){
    //                 console.log(data)
    //                 var result = "";
    //                 for (var i = 0; i < data.length; i++) {
    //                     result += "<div class='card'>";
    //                         if(data[i][0] === "reorder"){
    //                             result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
    //                                 <p style='font-size: 12px'><b>Item " +data[i][2]+ " is below reorder level.</b></p>\
    //                                 <p style='font-size: 12px'><b>"+data[i][3]+" item(s) left</b></p>\
    //                                 <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
    //                             </div>\
    //                         </div>";
    //                     }else{
    //                         result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
    //                             <p style='font-size: 12px'><b>Item " +data[i][2]+ " quantity adjusted.</b></p>\
    //                             <p style='font-size: 12px'><b>"+data[i][3]+" item(s) deducted by " + data[i][5] +".</b></p>\
    //                             <p style='font-size: 12px'><b>Reason: " +data[i][4]+ "</b></p>\
    //                             <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
    //                         </div>\
    //                     </div>";
                        
    //                 }
    //             }
    //             document.getElementById("listOfNotif").innerHTML = "";
    //             document.getElementById("listOfNotif").innerHTML = result;
    //             $("a[class='badge1']").attr("data-badge", data.length);

    //         }
    //     });
    // }
    // function removeNotification(divId){   
    //     console.log(divId)                       
    //     $('#'+divId).slideDown("slow")
    //         .delay(500)                        
    //         .hide(1500);
    // }
    function hideNumberOfNotif(link){
        link.removeAttribute("data-badge");
    }
    // function markAsRead(e){

    //     $.ajax({
    //         method: 'get',
    //         url:"<?php echo e(route('admin.notification.markAsRead')); ?>",
    //         data: {
    //             "notifications":window.notifications
    //         },

    //         success: function(data){
    //             console.log(data)
    //         }
    //     });
    // }
    function logoutRemoveCart(){
        localStorage.clear();
    }
    $(document).ready(function(){
        // $('button.myClass').click(function() {
        //     alert( "Handler" );
        // });
        console.log( '<?php echo str_contains(request()->path(),'admin') ?>' )
        $.ajax({
                method: 'get',
                //url: 'items/' + document.getElementById("inputItem").value,
                url: ( '<?php echo str_contains(request()->path(),'admin') ?>' === 1) ? "<?php echo e(route('admin.notification')); ?>" : "<?php echo e(route('salesAssistant.notification')); ?>",
                
                success: function(data){
                    notifications = data;
                    console.log(data)
                    var result = "";
                    for (var i = 0; i < data.length; i++) {
                        result += "<div class='card' id='notification" +i+ "'>";
                        if(data[i][0] === "reorder"){
                                result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
                                                    <p style='font-size: 12px'><b>Item " +data[i][2]+ " is below reorder level.</b></p>\
                                                    <p style='font-size: 12px'><b>"+data[i][3]+" item(s) left</b></p>\
                                                    <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b></p>\
                                                </div>\
                                            </div>";
                                            // <button data-notificationid='notification" +i+ "' onclick='removeNotification(this.dataset.notificationid)' type='button' class='btn btn-info'>Close</button>\
                        }else{
                            result += "<div class='card-container bg-info' style='padding: 1em; margin-bottom: -1.7em'>\
                                            <p style='font-size: 12px'><b>Item " +data[i][2]+ " quantity adjusted.</b></p>\
                                            <p style='font-size: 12px'><b>"+data[i][3]+" item(s) deducted by " + data[i][5] +".</b></p>\
                                            <p style='font-size: 12px'><b>Reason: " +data[i][4]+ "</b></p>\
                                            <p style='font-size: 12px'><b>Date: " +data[i]['date']+ "</b><u style='font-size: 12px; float: right' onclick='markAsRead(this)'><b>Mark As Read</b></u></p>\
                                        </div>\
                                    </div>";
                                        // <button data-notificationid='notification" +i+ "' onclick='removeNotification(this.dataset.notificationid)' type='button' class='btn btn-info'>Close</button>\
                        }
                }
                document.getElementById("listOfNotif").innerHTML = "";
                document.getElementById("listOfNotif").innerHTML = result;
                $("a[class='badge1']").attr("data-badge", data.length);

            },
            error: function(data){
                console.log(data)
            }
        });



        $('#formChangePassword').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            
            $.ajax({
                type:'POST',
                
                <?php if(str_contains(request()->path(),'admin') == 1): ?>
                url: "<?php echo e(route('admin.changePassword')); ?>",
                <?php elseif(str_contains(request()->path(),'salesAssistant') == 1): ?>
                url: "<?php echo e(route('salesAssistant.changePassword')); ?>",
                <?php endif; ?>
                data: data,
                
                success:function(data){
                    console.log(data)
                    $('#changePassword').modal('hide');
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                    // .addClass("alert-success")
                    .html("<h3>Change password successful</h3>");
                    $("#successDiv").css("display:block");                             
                    $("#successDiv").slideDown("slow")
                    .delay(1000)                        
                    .hide(1500);
                    
                },
                error: function(data){
                    var response = data.responseJSON;
                    $("#errorDivChangePassword").hide(500);
                    $("#errorDivChangePassword").removeClass("hidden");
                    $("#errorDivChangePassword").slideDown("slow", function() {
                    $("#errorDivChangePassword").html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });
                    });
                }
            })
        })
    })
</script>
<style>
    .badge1[data-badge]:after {
    content:attr(data-badge);
    position: absolute;
    background: green;
    height:2rem;
    top:-.1rem;
    right:-.1rem;
    width:2rem;
    text-align: center;
    line-height: 2rem;;
    font-size: 1rem;
    border-radius: 50%;
    color:white;
    border:1px solid white;
    }
	u:hover{
		cursor:pointer;
	}
</style>
</head>

<body <?php echo $__env->yieldContent('ng-app'); ?>>
    
    
    
    <div class="wrapper">
        <div class="sidebar" data-color="navcolor">
            <div class="sidebar-wrapper">
                <div class="logo">
                    
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="simple-text"> 
                        <img src="<?php echo e(asset('assets/img/logo3.png')); ?>" style="height:150px;width:160px">
                        <!--Jernixon Motorparts and Accessories-->
                    </a>
                    
                </div>
                
                <ul class="nav" id="navs">
                    
                    
                    <?php if(str_contains(request()->path(),'admin') == 1): ?>
                        <li  <?php echo $__env->yieldContent('dashboard_link'); ?>>
                            
                            <a href=<?php echo e(route('admin.dashboard')); ?>><i class="fa fa-fw fa-dashboard"></i><p>Dashboard</p></a>
                        </li>       
                        
                        <li <?php echo $__env->yieldContent('sales_link'); ?>>
                            <a href=<?php echo e(route('admin.sales')); ?>><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>  
                        
                        <li <?php echo $__env->yieldContent('purchases_link'); ?>>
                            <a href=<?php echo e(route('admin.purchases')); ?>><i class="fa fa-cube"></i><p>Purchases</p></a>
                        </li>  
                        
                        <li <?php echo $__env->yieldContent('returns_link'); ?>>
                            <a href=<?php echo e(route('admin.returns')); ?>><i class="fa fa-mail-reply"></i><p>Returns</p></a>
                        </li> 
                        
                        <li <?php echo $__env->yieldContent('physicalCount_link'); ?>>
                            <a href=<?php echo e(route('admin.physicalCount')); ?>><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>  
                        
                        <li  <?php echo $__env->yieldContent('reports_link'); ?> >
                            <a href=<?php echo e(route('admin.reports')); ?>><i class="fa fa-line-chart"></i><p>Reports</p></a>
                        </li>
                        
                        <li  <?php echo $__env->yieldContent('items_link'); ?> >
                            <a href=<?php echo e(route('admin.items')); ?>><i class=" fa fa-bars"></i><p>Items</p></a>
                        </li>
                        
                        <li <?php echo $__env->yieldContent('employees_link'); ?>>
                            <a href=<?php echo e(route('admin.employees')); ?>><i class="fa fa-users"></i><p>Account Management</p></a>
                        </li>
                        
                        <li <?php echo $__env->yieldContent('stockAdjustment_link'); ?>>
                            <a href=<?php echo e(route('admin.stockAdjustment')); ?>><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                    
                        <?php endif; ?>
                        
                        <!-- Sales Assistant -->
                    
                    <?php if(str_contains(request()->path(),'salesAssistant') == 1): ?>
                        <?php if($physicalCount[0]["status"] === "inactive" ): ?>
                        <li <?php echo $__env->yieldContent('sales_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.sales')); ?>><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>
                        
                        <li   <?php echo $__env->yieldContent('return_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.return')); ?>><i class="fa fa-mail-reply"></i><p>Returns</p></a>
                        </li>
                        
                        <li   <?php echo $__env->yieldContent('stockAdjustment_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.stockAdjustment')); ?>><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                        
                        <?php else: ?>
                        <li <?php echo $__env->yieldContent('physicalCount_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.physicalCount')); ?>><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>
                        <?php endif; ?>
                    
                    <?php endif; ?>
                    
                </ul>
                
            </div>      
        </div> 
        
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed navbar1">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <?php echo $__env->yieldContent('linkName'); ?>
                        <div class="alert alert-success hidden" id="successDiv">
                            
                        </div>
                    </div>
                    
                    <div>
                        <ul class="nav navbar-nav navbar-right ">
                            <li class="dropdown">
                                <a class="badge1" href="#notification" data-toggle="modal" data-toggle="dropdown" > <i class="fa fa-bell"></i>
                                <?php if(auth()->user()->unreadnotifications->count()): ?>
                                    <span class="badge badge-light"><?php echo e(auth()->user()->unreadnotifications->count()); ?></span>
                                <?php endif; ?>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a data-toggle="dropdown">
                                    <?php echo e(Auth::user()->name); ?>

                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php if(str_contains(request()->path(),'admin') == 1): ?>
                                        
                                        <a href="#changePassword" data-toggle="modal">
                                            Change Password
                                        </a>
                                        
                                        <a href="<?php echo e(route('admin.logout')); ?>" onclick="logoutRemoveCart()">
                                            
                                            
                                            Logout
                                        </a>
                                        
                                        
                                        
                                        <?php elseif(str_contains(request()->path(),'salesAssistant') == 1): ?>
                                        <a href="#changePassword" data-toggle="modal">
                                            Change Password
                                        </a>
                                        <a href="<?php echo e(route('salesAssistant.logout')); ?>" onclick="logoutRemoveCart()">
                                            
                                            Logout
                                        </a>
                                        
                                        
                                        <?php endif; ?>
                                        
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <nav class="navbar navbar-color navbar-fixed hiddenm" role="navigation">         
                <div class="navbar-header navbar-custom">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span><i class = 'fa fa-bars'></i>
                    </button>
                    <div class="small-title">
                        <img id = "logo" src = "<?php echo e(asset('assets/img/logo3.png')); ?>" width = "40" height = "40">
                        <p class="brand title">Jernixon Motorparts and Accessories </p> 
                    </div>
                    
                    <div class="small-logo-container">
                        <ul class="list-inline">                                
                            <li>
                                <ul class="nav navbar-right user-margin">

                                    <li class="dropdown">
                                        <a class="badge1" href="#notification" data-toggle="modal" data-toggle="dropdown"> </a>
                                        <i class="fa fa-bell"></i>

                                    </li>

                                    <li class="dropdown">
                                        
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <p>
                                                <?php echo e(Auth::user()->name); ?>

                                                <b class="caret"></b>
                                            </p>
                                            
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?php if(str_contains(request()->path(),'admin') == 1): ?>
                                                <a href="#changePassword" data-toggle="modal">
                                                    Change Password
                                                </a>
                                                <a href="<?php echo e(route('admin.logout')); ?>" onclick="logoutRemoveCart()">
                                                    
                                                    
                                                    Logout
                                                </a>
                                                
                                                
                                                <?php elseif(str_contains(request()->path(),'salesAssistant') == 1): ?>
                                                <a href="<?php echo e(route('salesAssistant.logout')); ?>" onclick="logoutRemoveCart()">
                                                    
                                                    Logout
                                                </a>
                                                
                                                
                                                <?php endif; ?>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-collapse collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(str_contains(request()->path(),'admin') == 1): ?>
                        <li <?php echo $__env->yieldContent('dashboard_link'); ?>>
                            <a href=<?php echo e(route('admin.dashboard')); ?>> <i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
                        </li>     
                        
                        <li <?php echo $__env->yieldContent('sales_link'); ?>>
                            <a href=<?php echo e(route('admin.sales')); ?>><i class="fa fa-dollar"></i>Sales</a>
                        </li> 
                        
                        <li <?php echo $__env->yieldContent('purchases_link'); ?>>
                            <a href=<?php echo e(route('admin.purchases')); ?>><i class="fa fa-cube"></i>Purchases</a>
                        </li>  
                        
                        <li <?php echo $__env->yieldContent('returns_link'); ?>>
                            <a href=<?php echo e(route('admin.returns')); ?>><i class="fa fa-mail-reply"></i>Returns</a>
                        </li> 
                        
                        <li <?php echo $__env->yieldContent('physicalCount_link'); ?>>
                            <a href=<?php echo e(route('admin.physicalCount')); ?>><i class="fa fa-check-square-o"></i>Physical count</a>
                        </li> 
                        
                        <li  <?php echo $__env->yieldContent('reports_link'); ?> >
                            <a href=<?php echo e(route('admin.reports')); ?>><i class="fa fa-line-chart"></i>Reports</a>
                        </li>
                        
                        <li  <?php echo $__env->yieldContent('items_link'); ?> >
                            <a href=<?php echo e(route('admin.items')); ?>><i class=" fa fa-bars"></i>Items</a>
                        </li>
                        
                        <li <?php echo $__env->yieldContent('employees_link'); ?>>
                            <a href=<?php echo e(route('admin.employees')); ?>><i class="fa fa-users"></i>Account Management</a>
                        </li>
                        
                        <li <?php echo $__env->yieldContent('stockAdjustment_link'); ?>>
                            <a href=<?php echo e(route('admin.stockAdjustment')); ?>><i class="fa fa-adjust"></i>Stock Adjustment</a>
                        </li>
                        
                        
                        
                        <?php elseif(str_contains(request()->path(),'salesAssistant') == 1): ?>
                        <?php if($physicalCount[0]["status"] === "inactive" ): ?>
                        <li   <?php echo $__env->yieldContent('sales_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.sales')); ?>><i class="fa fa-dollar"></i><p>Sales</p></a>
                        </li>
                        <li   <?php echo $__env->yieldContent('return_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.return')); ?>><i class="fa fa-mail-reply"></i><p>Return</p></a>
                        </li>
                        
                        <li   <?php echo $__env->yieldContent('stockAdjustment_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.stockAdjustment')); ?>><i class="fa fa-adjust"></i><p>Stock Adjustment</p></a>
                        </li>
                        
                        <?php else: ?>
                        <li <?php echo $__env->yieldContent('physicalCount_link'); ?>>
                            <a href=<?php echo e(route('salesAssistant.physicalCount')); ?>><i class="fa fa-check-square-o"></i><p>Physical count</p></a>
                        </li>
                        <?php endif; ?> 
                        
                        
                        
                        
                        <?php endif; ?>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </nav>
            
            <div class="content" ng-controller="customerPurchase">
                <div class="linkName"><?php echo $__env->yieldContent('linkName'); ?></div>
                <?php echo $__env->yieldContent('right'); ?>
            </div>
        </div>
        <?php echo $__env->yieldContent('modals'); ?>
        <div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
            <div class = "modal-dialog modal-md">
                <div class = "modal-content">
                    
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><i class="fa fa-wrench" style="margin-right: 15px;"></i>Change Password</h3>
                    </div>
                    
                    <div class = "modal-body">  
                        <div class="panel panel-default">
                            
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-th"></span>
                                    Update Password
                                </strong>
                            </div>
                            
                            <div id="errorDivChangePassword" class="hidden alert-danger text-center">
                            </div>
                <?php echo Form::open(['method'=>'post','id'=>'formChangePassword']); ?>

                            <div class="panel-body">
                                <input type="hidden" value="<?php echo e(csrf_token()); ?>">
                                <input type="hidden" name="authName" value=" <?php echo e(Auth::user()->name); ?>">
                                <input type="hidden" name="adminId" value=" <?php echo e(Auth::user()->id); ?>">
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php echo e(Form::label('Email', 'Email:')); ?>

                                        </div>
                                        <div class="col-md-9">
                                            <?php echo e(Form::text('Email','',['class'=>'form-control'])); ?>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php echo e(Form::label('Current Password:')); ?>

                                        </div>
                                        <div class="col-md-9">
                                            <?php echo e(Form::password('Current_Password',array('class'=>'form-control'))); ?>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php echo e(Form::label('New Password', 'New Password:')); ?>

                                        </div>
                                        <div class="col-md-9">
                                            <?php echo e(Form::password('New_Password',array('class'=>'form-control'))); ?>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php echo e(Form::label('Confirm Password', 'Confirm Password:')); ?>

                                        </div>
                                        <div class="col-md-9">
                                            <?php echo e(Form::password('Confirm_Password',array('class'=>'form-control'))); ?>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="text-right">                                           
                                <div class="col-md-12">   
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                        <?php echo Form::close(); ?>

                        
                    </div>
                </div>
            </div>
        </div>
        
        <div id="notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
            <div class = "modal-dialog modal-md">
                <div class = "modal-content">
                    
                    
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><i class="fa fa-bell" style="margin-right: 10px;"></i> Notifications</h3>
                    </div>
                    
                    <div class = "modal-body">  
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-list"></span>
                                    List of Notifications
                                </strong>
                            </div>
                            
                            <div class="panel-body">
                                <div class="autocomplete" style="width:200px;">
                                    
                                    <div id="searchResultDiv" class="searchResultDiv">
                                    </div>
                                    
                                </div>
                                <div id="listOfNotif">
                                    <ul class="list-group">
                                        <?php $__currentLoopData = Auth::user()->Notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($notification->read_at) ): ?>
                                                <li class='list-group-item list-group-item-success'>
                                                    <p><b>Reorder Item:</b>  <?php echo e($notification->data['description']); ?></p>
                                                    
                                                    <p><b>Remaining Quantity:</b> <?php echo e($notification->data['quantity']); ?>

                                                    </p>         
                                                </li>
                                            <?php else: ?>       
                                                <li class='list-group-item list-group-item-danger'>
                                                    <p><b>Reorder Item:</b>  <?php echo e($notification->data['description']); ?></p>
                                                    
                                                    <p><b>Remaining Quantity:</b> <?php echo e($notification->data['quantity']); ?>

                                                    </p>                              
                                                    <a href="/markAsRead/<?php echo e($notification->id); ?>" style="color:black;"><button >Mark As Read</button></a>
                                                </li>
                                            <?php endif; ?>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->yieldContent('jqueryScript'); ?>
</body>

<?php echo $__env->yieldContent('js_link'); ?>

</html>