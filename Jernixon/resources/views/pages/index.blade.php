<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <title>{{config('app.name')}}</title>

    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>


    <div class="container" >
        <form class="form-signin" style="border-style: solid">
        <h3 class="form-signin-heading">Jernixon Inventory System</h3>
     
        <div style="margin-bottom: 15px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control" name="username" placeholder="username" required autofocus>                                        
        </div>

        
        <div style="margin-bottom: 20px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control"  placeholder="Password" required>                                        
        </div>
        <p>hlooo</p>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      
        </form>

     </div> <!-- /container -->
    

</body>
</html>

