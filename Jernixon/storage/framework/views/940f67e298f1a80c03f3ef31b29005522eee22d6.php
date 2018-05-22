<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/logo3.png')); ?>"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/bootstrap/css/bootstrap.min.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/fonts/iconic/css/material-design-iconic-font.min.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/animate/animate.css')); ?>">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/css-hamburgers/hamburgers.min.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/animsition/css/animsition.min.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/select2/select2.min.css')); ?>">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/vendor/daterangepicker/daterangepicker.css')); ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/css/util.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/login_v2/css/main.css')); ?>">
<!--===============================================================================================-->

</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo e(asset('assets/login_v2/images/Logo3.png')); ?>');">
			<div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    
					<span class="login100-form-logo">
						<i class="zmdi zmdi-account"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Sales Assistant Login
					</span>
                 
					<div class="wrap-input100">
						<input id="email" type="email" class="input100"  name="email" placeholder="Email" value="<?php echo e(old('email')); ?>">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        <?php if($errors->has('email')): ?> 
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                        <?php endif; ?>
					</div>


                
					<div class="wrap-input100">
						<input id="password" class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                        <?php endif; ?>
					</div>

                 
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
						<label class="label-checkbox100" for="ckb1">
							Remember me
                        </label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
                        <a class="txt1" href="<?php echo e(route('admin.login')); ?>">
							Go to Admin Login
						</a>
					</div>
                </form>



                
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

   
    <!-- Scripts -->
    
    <!--===============================================================================================-->
	    <script src="<?php echo e(asset( 'assets/login_v2/vendor/jquery/jquery-3.2.1.min.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/animsition/js/animsition.min.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/bootstrap/js/popper.js')); ?>"></script>
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/select2/select2.min.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/daterangepicker/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/daterangepicker/daterangepicker.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/vendor/countdowntime/countdowntime.js')); ?>"></script>
    <!--===============================================================================================-->
        <script src="<?php echo e(asset( 'assets/login_v2/js/main.js')); ?>"></script>
    

    
</body>
</html>
