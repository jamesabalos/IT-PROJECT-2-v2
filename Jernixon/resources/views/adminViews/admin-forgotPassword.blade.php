<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password</title>
    
    <!-- Styles -->
    <!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo3.png') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login_v2/css/main.css')}}">
    <!--===============================================================================================-->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/jquery.3.2.1.min.js')}}"></script>
    <script type="text/javascript">
    function sumbitButton(){
        var data = $('#formForgotPassword').serialize();        
        // var data = document.getElementById("formForgotPassword");
        $.ajax({
            type:'POST',
            url: "{{route('admin.forgotPassword')}}",
            data: data,
            // data: {
            //     "Email":"jake",
            //     "Username":"jakejames"
            // },

            success:function(data){
                console.log(data)   
                // $("#errorDivForgotPassword p").remove();
                    $("#errorDivForgotPassword").removeClass("hidden")
                    // .addClass("alert-success")
                    .html("<h4>Success</h4>");
                    $("#errorDivForgotPassword").css("background-color","green");                             
                    $("#errorDivForgotPassword").slideDown("slow")
                    .delay(1000)                        
                    .hide(1500);

                    document.getElementById("formForgotPassword").reset();
                // window.location.replace('/admin/login'); 
            },
            error:function(data){
                // document.getElementById("emailError").innerHTML = "";   
                // document.getElementById("usernameError").innerHTML = "";                                                     
                
                var response = data.responseJSON; 
                // console.log(response)
                // if(response.errors.hasOwnProperty('email')){
                //     document.getElementById("emailError").innerHTML = "<h5 style='color:red'>"+response.errors.email+"</h5>";
                // }else{
                //     document.getElementById("emailError").innerHTML = "";                    
                // }
                // if(response.errors.hasOwnProperty('username')){
                //     document.getElementById("usernameError").innerHTML = "<h5 style='color:red'>"+response.errors.username+"</h5>";
                // }else{
                //     document.getElementById("usernameError").innerHTML = "";                    
                // }
                    $("#errorDivForgotPassword").css("background-color","#721c24");                             
                    $("#errorDivForgotPassword").hide(500);
                    $("#errorDivForgotPassword").removeClass("hidden");
                    $("#errorDivForgotPassword").slideDown("slow", function() {
                    $("#errorDivForgotPassword").html(function(){
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
      $(document).ready(function(){
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        // $('#formForgotPassword').on('submit',function(e){
        //     var data = $(this).serialize();
        //     $.ajax({
        //     type:'POST',
        //     url: "{{route('admin.forgotPassword')}}",
        //     data: data,
        //     // data: {
        //     //     "Email":"jake",
        //     //     "Username":"jakejames"
        //     // },

        //     success:function(data){
        //         console.log(data)   
        //         // window.location.replace('/admin/login'); 
        //     },
        //     error:function(data){
        //         var response = data.responseJSON; 
        //         console.log(response)
        //         if(response.errors.hasOwnProperty('email')){
        //             document.getElementById("emailError").innerHTML = "<h5>"+response.errors.email+"</h5>";
        //         }
        //         if(response.errors.hasOwnProperty('username')){
        //             document.getElementById("usernameError").innerHTML = "<h5>"+response.errors.username+"</h5>";
        //         }
        //     }
        // });

        // });

      });
    </script>
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('assets/login_v2/images/Logo3.png')}}');">
		
			<div class="wrap-login100">
                {!! Form::open(['method'=>'get','id'=>'formForgotPassword']) !!}
                {{-- <input type="hidden" name="adminId" value=" {{ Auth::user()->id }}"> --}}
                <span class="login100-form-logo">
                    <i class="zmdi zmdi-account"></i>
                </span>
                <span class="login100-form-title p-b-34 p-t-27">
                    Admin Forgot Password
                </span>
                
                <div id="errorDivForgotPassword" style="background-color:#721c24" class="hidden alert-danger text-center">
                    </div>
                    <div class="wrap-input100" >                        
                        {{Form::input('email','email',null, ['class'=>'input100', 'id'=>'email', 'placeholder'=>'Email', 'required'])}}
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        <span id="emailError"></span>
                    </div>
                    
                    <div class="wrap-input100" >                        
                        {{Form::input('text','username',null, ['class'=>'input100', 'placeholder'=>'Username', 'required'])}}
                        
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        <span id="usernameError"></span>
                     
                    </div>
                    <div class="container-login100-form-btn">
                        {{Form::button('Submit', array( 'type'=>'button','class'=>'login100-form-btn','onclick'=>'sumbitButton()'))}}
                    </div>
                {!! Form::close() !!}

                {{-- {!! Form::open(['method'=>'get','id'=>'formForgotPassword']) !!}
                <div class="form-group">                                
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('Email')}}
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('Email','',['class'=>'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">                                
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('Username')}}
                        </div>
                        <div class="col-md-9">
                            {{ Form::text('Username','',['class'=>'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="text-right">                                           
                            <div class="col-md-12">   
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                
                {!! Form::close() !!}  --}}

					<div class="text-center p-t-90">
                    <a class="txt1" href="{{ route('admin.login') }}">
                            Go to Admin Login
					</a>
                     
					</div>
				
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

   
    <!-- Scripts -->
    {{--  <script src="{{ asset('js/app.js') }}"></script>  --}}
    <!--===============================================================================================-->
	    <script src="{{ asset( 'assets/login_v2/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/vendor/bootstrap/js/popper.js')}}"></script>
        <script src="{{ asset( 'assets/login_v2/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/vendor/daterangepicker/moment.min.js')}}"></script>
        <script src="{{ asset( 'assets/login_v2/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
        <script src="{{ asset( 'assets/login_v2/js/main.js')}}"></script>
    

    
</body>
</html>
