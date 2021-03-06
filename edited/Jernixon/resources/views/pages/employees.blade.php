@extends('layouts.navbar')
@section('employees_link')
class="active"
@endsection

@section('linkName')
    <h3>Employees</h3>
@endsection

@section('headScript')
<script vtype="text/javascript">
    function showDetails(button){
        //alert(button.parentNode.parentNode.parentNode);
        var data  = $(button.parentNode.parentNode.parentNode.innerHTML).slice(0,-1);
        var form = document.getElementById("formUpdateEmployeeAccount");
        form.elements[2].value = data[0].innerHTML;
        form.elements[3].value = data[2].innerHTML;
        form.elements[4].value = data[4].innerHTML;
    }
    
    function removeEmployee(e){
        var button = document.getElementById(e.getAttribute("id"));
        button.addEventListener("click", function(event) { 
            event.preventDefault();
            alert("success preventing..")
            
        });

         
        
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#formAddNewEmployee').on('submit',function(e){
            e.preventDefault(); //prevent the page to load when submitting form
            //key value pair of form
            var data = $(this).serialize();
            var arrayOfData = $(this).serializeArray();
            
            $.ajax({
                type:'POST',
                // url:'admin/storeNewItem',
                url: "{{route('admin.addNewEmployee')}}",
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
                    $('#addEmployee').modal('hide')                    
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                                    .html("<h3>Success</h3>");
                     document.getElementById("formAddNewEmployee").reset();
                    
                    $("#successDiv").css("display:block");
                    $("#successDiv").slideDown("slow",function(){
                        var thatTbody = document.getElementById("employeeTbody");
                        var newRow = thatTbody.insertRow(-1);
                    
                        newRow.insertCell(-1).innerHTML ="<td class='text-center'>"+arrayOfData[1].value+"</td>";
                        newRow.insertCell(-1).innerHTML ="<td class='text-center'>"+arrayOfData[2].value+"</td>";
                        newRow.insertCell(-1).innerHTML ="<td></td>";
                        newRow.insertCell(-1).innerHTML ="<td class='text-center'>\
                                        <div class='btn-group'>\
                                            <a href='#editEmployee' onclick='showDetails(this)' class='btn btn-xs btn-warning' data-toggle='modal' >\
                                                <i class='glyphicon glyphicon-pencil'></i>\
                                            </a>\
                                        </div>\
                                    </td>";
                                            // <a href='' class='btn btn-xs btn-danger' data-toggle='tooltip' >\
                                            //     <i class='glyphicon glyphicon-remove'></i>\
                                            // </a>\
                        

                    })
                    .delay(1000)                        
                    .hide(1500);
                },
                error:function(data){
                    var response = data.responseJSON;
                    $("#errorDivAddNewEmployee").removeClass("hidden").addClass("alert-danger");
                    $("#errorDivAddNewEmployee").html(function(){
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
            });
            
        });
        
        $('#formUpdateEmployeeAccount').on('submit',function(e){
            e.preventDefault(); //prevent the page to load when submitting form
            var arrayOfData = $(this).serializeArray();
            var fullRoute = "/admin/employees/updateEmployeeAccount/"+arrayOfData[1].value;
            var data = $(this).serialize();

            $.ajax({
                type:'POST',
                // url:'admin/storeNewItem',
                // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
                url: fullRoute,
                
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
                    $('#editEmployee').modal('hide')
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                    // .addClass("alert-success")
                    .html("<h3>Employee updated</h3>");
                    
                    $("#successDiv").css("display:block");
                    $("#successDiv").slideDown("slow",function(){
                        document.getElementById(arrayOfData[1].value).cells[1].innerHTML = arrayOfData[2].value;
                        document.getElementById(arrayOfData[1].value).cells[2].innerHTML = arrayOfData[3].value;
                    })
                    .delay(1000)                        
                    .hide(1500);

                    


                },
                error:function(data){
                    var response = data.responseJSON;
                    $("#errorDivEditEmployee").removeClass("hidden")
                    $("#errorDivEditEmployee").html(function(){
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
            });
            
        });


    })
</script>
@endsection

@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                        <div class="alert alert-success hidden" id="successDiv">
                            
                            </div>
                    <div class = "col-md-12">
                        <a href = "#addEmployee" data-toggle="modal">
                            <div class="content table-responsive table-full-width">
                            <button type="button" class="btn btn-success"><i class = "ti-plus"></i> Add Employee</button>
                            </div>
                        </a>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="employeeTable">
                            <thead>
                                <tr>
                                    <th class="text-center hidden" style="width: 50px;">#</th>
                                    <th class="text-center">Name </th>
                                    <th class="text-center">Email</th>
                                    {{--  <th class="text-center" style="width: 15%;">User Role</th>  --}}
                                    {{--  <th class="text-center" style="width: 10%;">Status</th>  --}}
                                    <th class="text-center" style="width: 20%;">Status</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="employeeTbody">
                                @if(count($employees) >= 0)
                                @foreach($employees as $employee)
                                <tr id="{{$employee->id}}">
                                    <td class="text-center hidden" >{{$employee->id}}</td>
                                    <td class="text-center">{{$employee->name}}</td>
                                    <td class="text-center">{{$employee->email}}</td>
                                    {{--  <td class="text-center">under-construction</td>  --}}
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#editEmployee" onclick="showDetails(this)" class="btn btn-xs btn-warning" data-toggle="modal" >
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            
                                            {{--  <form action="{{ route('admin.destroyEmployeeAccount',['id' =>$employee->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                             <button type="submit" id="{{$employee->id}}" onclick="removeEmployee(this)">Delete</button>
                                            </form>  --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <p>no account</p>
                                @endif
                                
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
<div id="addEmployee" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class = "modal-body">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class = "text-center">Add employee</h4>
                <div class="alert alert-danger hidden" id="errorDivAddNewEmployee">
                    
                </div>
                {!! Form::open(['method'=>'post','id'=>'formAddNewEmployee']) !!}
                
                {{--  <input type="hidden" id="_token" value="{{ csrf_token() }}">                      --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            {{Form::label('name', 'Name:')}}                                
                        </div>
                        <div class="col-md-9">
                            {{--  <input type="" class="form-control border-input" name="employeename" form="addnewform">  --}}
                            {{Form::text('name','',['class'=>'form-control  border-input'], 'autofocus')}}                                
                        </div>
                    </div>
                </div>
                {{--  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label>Username:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="" form="addnewform" class="form-control border-input" name="username">
                        </div>
                    </div>
                </div>  --}}
                {{--  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label>Mobile Number:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" form="addnewform" class="form-control border-input">
                            
                        </div>
                    </div>
                </div>  --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            {{Form::label('email', 'Email:')}}                                
                            
                        </div>
                        <div class="col-md-9">
                            {{--  <input type="email" form="addnewform" class="form-control border-input" name="email">  --}}
                            {{Form::email('email','',['class'=>'form-control  border-input'])}}                                
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            {{Form::label('password', 'Password:')}}                                
                            
                        </div>
                        <div class="col-md-9">
                            {{--  <input type="password" form="addnewform" name="password" class="form-control border-input">    --}}
                            {{Form::password('password','',['class'=>'form-control  border-input'])}}                                
                            
                        </div>
                    </div>
                </div>
                {{--  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label>Confirm Password:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" form="addnewform" class="form-control border-input">
                        </div>
                    </div>
                </div>  --}}
                <div class="form-group">
                    <div class="row">
                        <div class="text-center">                                           
                            <div class="col-md-12">                                                    
                                {{--  <input type="submit" form="addnewform" name="save" value="Save" class="btn btn-success">  --}}
                                <button type="submit" class="btn btn-success">Save</button>                                    
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>                             
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>

<div id="editEmployee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit Employee</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update Employee Account
                        </strong>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger hidden" id="errorDivEditEmployee">
                            
                        </div>
                        {!! Form::open(['method'=>'POST','id'=>'formUpdateEmployeeAccount']) !!}
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        
                        <input type="hidden"  value="" name="employeeId">
                        <div class="form-group">
                            {{Form::label('name', 'Name:',['class'=>'control-label'])}}                                
                            {{Form::text('name','',['class'=>'form-control'])}}
                            
                        </div>
                        <div class="form-group">
                            {{Form::label('email', 'Email:',['class'=>'control-label'])}}                                                                
                            {{Form::email('email','',['class'=>'form-control'])}}
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="Active">Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{Form::label('password', 'Update Password:',['class'=>'control-label'])}}                                                                
                            {{Form::password('password','',['class'=>'form-control','placeholder'=>'Type user new password'])}}
                            
                        </div>
                        
                        {{Form::hidden('_method','PUT')}}
                        <div class="form-group clearfix">
                            <button type="submit" name="update" class="btn btn-info">Update</button>
                        </div>
                        
                        {!! Form::close() !!}
                        
                    </div>
                </div>
                
                {{--  <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Change Employee password
                        </strong>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post" class="clearfix" pb-autologin="true">
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Type user new password" pb-role="password">
                            </div>
                            <div class="form-group clearfix">
                                <button type="submit" name="update" class="btn btn-danger">Change</button>
                            </div>
                        </form>
                    </div>
                </div>  --}}
                
                
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
