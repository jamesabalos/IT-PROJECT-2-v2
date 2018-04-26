<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{--  csrf_token  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password</title>
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
                // data: data,
                data: {
                    "Email":"jake",
                    "Username":"jakejames"
                },

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
    {!! Form::open(['method'=>'Get','id'=>'formForgotPassword']) !!}

        {{Form::label('Email:')}}
        {{ Form::text('Email','',['class'=>'form-control']) }}

        {{Form::label('Username:')}}
        {{ Form::text('Username','',['class'=>'form-control']) }}

        <button type="submit">Submit</button>
    {!! Form::close() !!}
</body>
</html>