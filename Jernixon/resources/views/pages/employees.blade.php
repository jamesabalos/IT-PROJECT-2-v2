@extends('layouts.navbar') @section('employees_link') class="active" @endsection @section('linkName')
<div class="alert alert-success hidden" id="successDiv">
</div>
<h3><i class="fa fa-users" style="margin-right: 15px"></i> Users</h3> @endsection @section('headScript')
<script type="text/javascript">
    // function showDetails(button){
    //     //alert(button.parentNode.parentNode.parentNode);
    //     var data  = $(button.parentNode.parentNode.parentNode.innerHTML).slice(0,-1);
    //     var form = document.getElementById("formUpdateEmployeeAccount");
    //     console.log(form)
    //     form.elements[1].value = data[0].innerHTML;
    //     form.elements[2].value = data[2].innerHTML;
    //     form.elements[3].setAttribute("selected",data[5].innerHTML);
    //     // form.elements[3].value = data[5].innerHTML;
    // }

    // function removeEmployee(e){
    //     var button = document.getElementById(e.getAttribute("id"));
    //     button.addEventListener("click", function(event) {
    //         event.preventDefault();
    //         alert("success preventing..")

    //     });



    // }
    function User(){
        var user = document.getElementById("ll").value;
        if(user=="salesAssistant"){
            document.getElementById("address").setAttribute("class","visible form-group");
        }else if(user=="admin"){
            document.getElementById("address").setAttribute("class","hidden");
        }
        
        
        
//        document.getElementById("address").setAttribute("class","hidden");
//        document.getElementById("formAddNewEmployee").lastElementChild.lastElementChild.setAttribute("class","hidden");
//        document.getElementById("formAddNewEmployee").lastElementChild.lastElementChild.previousElementSibling.setAttribute("class","hidden");
    }
    function passEmployeeId(id){
        document.getElementById("resetPasswordEmployeeId").setAttribute("data-employee-id",id);
    }
    function resetPasswordConfirmation(button){
        var employeeId = button.getAttribute("data-employee-id");
        var fullRoute = "/admin/employees/resetPassword"; //id

        $.ajax({
            type: 'Post',
            // url:'admin/storeNewItem',
            // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
            url: fullRoute,
            data:{"employeeId":employeeId},
            success:function(data){
                $("#successDiv p").remove();
                $("#successDiv").removeClass("hidden")
                // .addClass("alert-success")
                    .html("<h3>Reset password successful</h3>");

                $("#successDiv").css("display:block");
                $("#successDiv").slideDown("slow").delay(1000).hide(1500);;
                $('#reset').modal('hide')                    

            }
        })

    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#formAddNewEmployee').on('submit', function(e) {
            e.preventDefault(); //prevent the page to load when submitting form
            //key value pair of form
            // var data = $(this).serialize();
            var arrayOfData = $(this).serializeArray();
            var password = (arrayOfData[2].value).split(" ", 1) + "@jernixon";
            var adminParam = {
                        'name': arrayOfData[1].value,
                        'email': arrayOfData[2].value,
                        'password': password,
            };
            var saParam = {
                        'name': arrayOfData[1].value,
                        'email': arrayOfData[2].value,
                        'contactNumber': arrayOfData[3].value,
                        'address': arrayOfData[4].value,
                        'password': password,
            };
            $.ajax({
                type: 'POST',
                // url:'admin/storeNewItem',
                url: (arrayOfData[5]['value'] === "salesAssistant") ?  "{{route('admin.addNewEmployee')}}" : "{{route('admin.addNewAdmin')}}",
                // dataType: 'json',
                // url: (num == 1) ? url1 : url2
                data:  (arrayOfData[5]['value'] === "salesAssistant") ? saParam : adminParam,

                success: function(data) {
                    console.log(data)
                    $('#addEmployee').modal('hide');
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                        .html("<h3>Success</h3>");
                    document.getElementById("formAddNewEmployee").reset();

                    $("#successDiv").css("display:block");
                    $("#successDiv").slideDown("slow", function() {
                        var thatTbody = document.getElementById("employeeTbody");
                        var newRow = thatTbody.insertRow(-1);

                        newRow.insertCell(-1).innerHTML = "<td class='text-center'>" + arrayOfData[1].value + "</td>";
                        newRow.insertCell(-1).innerHTML = "<td class='text-center'>" + arrayOfData[2].value + "</td>";
                        newRow.insertCell(-1).innerHTML = "<td class='text-center'>Active</td>";
                        // newRow.insertCell(-1).innerHTML ="<td class='text-center'>\
                        //                 <div class='btn-group'>\
                        //                     <a href='#editEmployee' onclick='showDetails(this)' class='btn btn-xs btn-warning' data-toggle='modal' >\
                        //                         <i class='glyphicon glyphicon-pencil'></i>\
                        //                     </a>\
                        //                 </div>\
                        //             </td>";
                        newRow.insertCell(-1).innerHTML = "<td class='text-center'><button data-id='" + data.id + "' data-status='inactive' data-status-reverse='active'  data-button-reverse='Activate' class='formUpdateEmployeeAccount btn btn-danger'>Deactivate</button><a href = '#reset' data-toggle='modal'><button type='button' class='btn btn-info'>Reset Password</button></a></td>";


                    })
                        .delay(1000)
                        .hide(1500);
                    location.reload();
                },
                error: function(data) {
                    var response = data.responseJSON;
                    $("#errorDivAddNewEmployee").hide(500);
                $("#errorDivAddNewEmployee").removeClass("hidden");
                $("#errorDivAddNewEmployee").slideDown("slow", function() {
                    $("#errorDivAddNewEmployee").html(function() {
                        var addedHtml = "";
                        for (var key in response.errors) {
                            addedHtml += "<p>" + response.errors[key] + "</p>";
                        }
                        return addedHtml;
                    });
                });

                    // document.getElementById("insertError").innerHTML = "<p>"+error.errors['description']+"</p>"
                    //alert(Object.keys(error.errors).length)
                    //console.log(error)

                }
            });

        });

        // $('#formUpdateEmployeeAccount').on('submit',function(e){
        //     e.preventDefault(); //prevent the page to load when submitting form
        //     var arrayOfData = $(this).serializeArray();
        //     var fullRoute = "/admin/employees/updateEmployeeAccount/"+arrayOfData[1].value;
        //     // var data = $(this).serialize();


        //     $.ajax({
        //         type:'POST',
        //         // url:'admin/storeNewItem',
        //         // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
        //         url: fullRoute,

        //         dataType:'json',
        //         data:{
        //             // 'description':'',
        //             // 'quantityInStock':4,
        //             // 'wholeSalePrice':10,
        //             // 'retailPrice':15,
        //             'status': arrayOfData[2].value,
        //         },

        //         //data:{data},
        //         // data:data,
        //         //_token:$("#_token"),
        //         success:function(data){
        //             $('#editEmployee').modal('hide')
        //             $("#successDiv p").remove();
        //             $("#successDiv").removeClass("hidden")
        //             // .addClass("alert-success")
        //             .html("<h3>Employee updated</h3>");

        //             $("#successDiv").css("display:block");
        //             $("#successDiv").slideDown("slow",function(){
        //                 document.getElementById(arrayOfData[1].value).cells[1].innerHTML = arrayOfData[2].value;
        //                 document.getElementById(arrayOfData[1].value).cells[2].innerHTML = arrayOfData[3].value;
        //             })
        //             .delay(1000)                        
        //             .hide(1500);




        //         },
        //         error:function(data){
        //             var response = data.responseJSON;
        //             $("#errorDivEditEmployee").removeClass("hidden")
        //             $("#errorDivEditEmployee").html(function(){
        //                 var addedHtml="";
        //                 for (var key in response.errors) {
        //                     addedHtml += "<p>"+response.errors[key]+"</p>";
        //                 }
        //                 return addedHtml;
        //             });
        //             // document.getElementById("insertError").innerHTML = "<p>"+error.errors['description']+"</p>"
        //             //alert(Object.keys(error.errors).length)
        //             //console.log(error)
        //         }
        //     });

        // });

        $(".formUpdateEmployeeAccount").on('click', function(button) {
            button.preventDefault(); //prevent the page to load when submitting form
            var fullRoute = "/admin/employees/updateEmployeeAccount/" + button.currentTarget.attributes[0].value; //id
            $.ajax({
                type: 'PUT',
                // url:'admin/storeNewItem',
                // url: '{{ route("admin.updateEmployeeAccount", ["id" =>"1"]) }}',
                url: fullRoute,

                dataType: 'json',
                data: {
                    // 'description':'',
                    // 'quantityInStock':4,
                    // 'wholeSalePrice':10,
                    'status': button.currentTarget.attributes[1].value, //'status': inactive | active
                    // 'buttonName':button.currentTarget.attributes[2].value, 
                },

                //data:{data},
                // data:data,
                //_token:$("#_token"),
                success: function(data) {
                    // $('#editEmployee').modal('hide')
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                    // .addClass("alert-success")
                        .html("<h3>Employee updated</h3>");

                    $("#successDiv").css("display:block");
                    $("#successDiv").slideDown("slow", function() {
                        //document.getElementById(button.currentTarget.attributes[0].value).cells[3].innerHTML = button.currentTarget.attributes[1].value;
                        // document.getElementById(button.currentTarget.attributes[0].value).cells[4].innerHTML = "<button data-id='" +button.currentTarget.attributes[0].value+ "' data-status='" +button.currentTarget.attributes[1].value+ "' data-status-reverse='" +button.currentTarget.attributes[2].value+ "' data-button-reverse='" +button.currentTarget.attributes[3].value+ "' class='formUpdateEmployeeAccount'>" +button.currentTarget.attributes[3].value+ "</button>"; 

                        // document.getElementById(button.currentTarget.attributes[0].value).cells[4].childNodes[1].setAttribute("data-status",button.currentTarget.attributes[1].value);
                        // document.getElementById(button.currentTarget.attributes[0].value).cells[4].childNodes[1].setAttribute("data-status-reverse",button.currentTarget.attributes[2].value);
                        // document.getElementById(button.currentTarget.attributes[0].value).cells[4].childNodes[1].setAttribute("data-button-reverse",button.currentTarget.attributes[3].value);
                        // document.getElementById(button.currentTarget.attributes[0].value).cells[4].childNodes[1].innerHTML = button.currentTarget.attributes[3].value;

                        if (button.currentTarget.attributes[1].value == "Active") {
                            // document.getElementById(button.currentTarget.attributes[0].value).cells[4].innerHTML ="<button data-id='' data-status='inactive' data-status-reverse='active'  data-button-reverse='Activate' class='formUpdateEmployeeAccount'>Deactivate</button>";

                            document.getElementById(button.currentTarget.attributes[0].value).cells[5].innerHTML = "Active";
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-status", "Inactive");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-status-reverse", "Active");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-button-reverse", "Active");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].innerHTML = "Deactivate";

                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("class", "formUpdateEmployeeAccount btn btn-danger");

                        } else {
                            // document.getElementById(button.currentTarget.attributes[0].value).cells[4].innerHTML = "<button data-id='' data-status='active' data-status-reverse='inactive' data-button-reverse='Diactivate' class='formUpdateEmployeeAccount'>Activate</button>";

                            document.getElementById(button.currentTarget.attributes[0].value).cells[5].innerHTML = "Inactive";
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-status", "Active");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-status-reverse", "Inactive");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("data-button-reverse", "Deactivate");
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].innerHTML = "Activate";
                            document.getElementById(button.currentTarget.attributes[0].value).cells[6].childNodes[1].setAttribute("class", "formUpdateEmployeeAccount btn btn-success");
                        }

                    })
                        .delay(1000)
                        .hide(1500);




                }
                // error:function(data){
                //     var response = data.responseJSON;
                //     $("#errorDivEditEmployee").removeClass("hidden")
                //     $("#errorDivEditEmployee").html(function(){
                //         var addedHtml="";
                //         for (var key in response.errors) {
                //             addedHtml += "<p>"+response.errors[key]+"</p>";
                //         }
                //         return addedHtml;
                //     });

                // }
            });

        });

    })
</script>
@endsection @section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">

                    <a href="#addEmployee" data-toggle="modal">
                        <button type="button" class="btn btn-success"><i class=" fa fa-plus"></i> Add User</button>
                    </a>

                    <div class="content table-responsive table-full-width">
                        <table class="table table-bordered table-striped" id="employeeTable">
                            <thead>
                                <tr>
                                    <th class="text-center hidden" style="width: 50px;">#</th>
                                    <th class="text-center">Name </th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center" style="width: 15%;">Contact Number</th>
                                    <th class="text-center" style="width: 10%;">Address</th>
                                    <th class="text-center" style="width: 20%;">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="employeeTbody">
                                @if(count($employees) >= 0)
                                @foreach($employees as $employee)
                                <tr id="{{$employee->id}}">
                                    <td class="text-center hidden">{{$employee->id}}</td>
                                    <td class="text-center">{{$employee->name}}</td>
                                    <td class="text-center">{{$employee->email}}</td>
                                    <td class="text-center">{{$employee->contact_number}}</td>
                                    <td class="text-center">{{$employee->address}}</td>
                                    <td class="text-center">{{$employee->status}}</td>
                                    <td class="text-center">
                                        {{--
                                        <a href="#editEmployee" onclick="showDetails(this)" class="btn btn-xs btn-warning" data-toggle="modal">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a> --}} {{-- {!! Form::open(['method'=>'POST','id'=>'formUpdateEmployeeAccount']) !!}
                                        <input type="hidden" value="{{$employee->id}}" name="employeeId"> @if( $employee->status == "active")
                                        <input type="hidden" name="status" value="Inactive"> {{Form::hidden('_method','PUT')}}
                                        <button type="submit">Deactivate</button>
                                        @else
                                        <input type="hidden" name="status" value="Active"> {{Form::hidden('_method','PUT')}}
                                        <button type="submit">Activate</button>
                                        @endif {!! Form::close() !!} --}} @if( $employee->status == "active")

                                        <button data-id="{{$employee->id}}" data-status="Inactive" data-status-reverse="active" data-button-reverse="Activate" class="formUpdateEmployeeAccount btn btn-danger"><i class="fa fa-times-circle"></i> Deactivate</button>
                                        <a href="#reset" data-toggle="modal">
                                            <button onclick="passEmployeeId(this.parentNode.parentNode.childNodes[1].getAttribute('data-id'))" type="button" class="btn btn-info">Reset Password</button>
                                        </a>


                                        @else

                                        <button data-id="{{$employee->id}}" data-status="Active" data-status-reverse="inactive" data-button-reverse="Deactivate" class="formUpdateEmployeeAccount btn btn-success"><i class="fa fa-check"></i> Activate</button>
                                        <a href="#reset" data-toggle="modal">
                                            <button type="button" onclick="passEmployeeId(this.parentNode.parentNode.childNodes[1].getAttribute('data-id'))" class="btn btn-info">Reset Password</button>
                                        </a>

                                        @endif

                                    </td>
                                </tr>
                                @endforeach @else
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

@endsection @section('modals')
<div id="addEmployee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class=" fa fa-plus" style="margin-right: 5px"></i> Add User</h3>
            </div>

            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="fa fa-wrench"></span>
                            New User
                        </strong>
                    </div>
                    {!! Form::open(['method'=>'post','id'=>'formAddNewEmployee']) !!}
                    
                    <div class="panel-body">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Name', 'Name:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Name','',['class'=>'form-control','placeholder'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Email:')}}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('Email','',['class'=>'form-control','placeholder'=>'']) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Contact No', 'Contact No:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::number('Contact No','',['class'=>'form-control','placeholder'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="address">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Address', 'Address:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::text('Address','',['class'=>'form-control','placeholder'=>''])}}
                                </div>
                            </div>
                        </div><div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Type', 'Type of User:')}}
                                </div>
                                <div class="col-md-9">
                                    {{Form::select('radioButton',['salesAssistant'=>'Sales Assistant','admin'=>'Admin'],'Sales Assistant',['class'=>'form-control ','id'=>'ll','onclick'=>'User()'])}}                                          
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div id="errorDivAddNewEmployee" class="hidden alert-danger text-center">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="text-right">
                            <div class="col-md-12">
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit User information</h3>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-th"></span>
                            Update User's Account
                        </strong>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger hidden" id="errorDivEditEmployee">

                        </div>
                        {!! Form::open(['method'=>'POST','id'=>'formUpdateEmployeeAccount2']) !!}

                        <input type="hidden" value="" name="employeeId">
                        <div class="form-group">
                            {{Form::label('name', 'Name:',['class'=>'control-label'])}} {{Form::text('name','',['class'=>'form-control'])}}

                        </div>


                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div>
                        {{--
                        <div class="form-group">
                            {{Form::label('password', 'Update Password:',['class'=>'control-label'])}} {{Form::password('password','',['class'=>'form-control','placeholder'=>'Type user new password'])}}

                        </div> --}} {{Form::hidden('_method','PUT')}}
                        <div class="form-group clearfix">
                            <button type="submit" name="update" class="btn btn-info">Update</button>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <p></p>
            </div>
            <div class="text-center">
                <strong>
                    <h3> <i class="fa fa-exclamation-triangle" style="margin-right: 15px"> </i> Are you sure?</h3>
                    <p>Do you really want to reset the password? This process cannot be undone.</p>
                </strong>
            </div>

            <div class="panel-body">
                <div class="text-center">
                    <div class="form-group clearfix">
                        <button id="resetPasswordEmployeeId" onclick="resetPasswordConfirmation(this)" type="button" class="btn btn-success">Reset</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js_link')
<!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection