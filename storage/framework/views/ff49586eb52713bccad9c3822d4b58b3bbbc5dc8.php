<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Budgeting App
        | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(asset('public/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/ionicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/icheck-bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/adminlte.min.css')); ?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Budgeting App</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session()->get('error')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session()->has('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email"
                            value="<?php echo e(old('email')); ?>" required autofocus>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" placeholder="Password"
                            class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password"
                            required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">
                    <a href="<?php echo e(route('resetPassword.view')); ?>">I forgot my password</a>
                </p>

            </div>

        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/finance/resources/views/welcome.blade.php ENDPATH**/ ?>