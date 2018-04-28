<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
    
    <script src="{{asset('assets/js/jquery.3.2.1.min.js')}}"></script>
    <script type="text/javascript">
    
      $(document).ready(function(){
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        $('#formForgotPassword').on('submit',function(e){
            var data = $(this).serialize();
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

                },
                error:function(data){
                 
                }

            });

        });

      });
    </script>
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('assets/login_v2/images/Logo3.png')}}');">
		
			<div class="wrap-login100">
                {!! Form::open(['method'=>'Get','id'=>'formForgotPassword']) !!}
                
                        {{ csrf_field() }}
                    
					<span class="login100-form-logo">
						<i class="zmdi zmdi-account"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Admin Forgot Password
                    </span>
  

                 
                    <div class="wrap-input100" >                        
                        {{Form::input('email','email',null, ['class'=>'input100', 'id'=>'email', 'placeholder'=>'Email', 'required','autofocus'])}}
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    
                    <div class="wrap-input100" >                        
                        {{Form::input('text','username',null, ['class'=>'input100', 'placeholder'=>'Username', 'required','autofocus'])}}
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
{{-- <!--
                        @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
--> --}}
                    </div>
                    <div class="container-login100-form-btn">
                        {{Form::button('Submit', array( 'type'=>'submit','class'=>'login100-form-btn'))}}
                    </div>
                {!! Form::close() !!}
                    

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
