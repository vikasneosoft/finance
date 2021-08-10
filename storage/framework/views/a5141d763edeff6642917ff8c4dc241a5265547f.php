<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Budgeting App | <?php echo $__env->yieldContent('title'); ?> </title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(asset('public/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/ionicons.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('public/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('public/css/icheck-bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/adminlte.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/OverlayScrollbars.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/custom.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('employee-css'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="loadingImage" style="display: none">
        <img src="<?php echo e(asset('public/images/ajax-loader.gif')); ?>">
    </div>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <div style="margin-left: 10px" class="navbar-nav row col-md-offset-2">

                <?php echo e(userDetail()->company['name']); ?>

                <?php if(isset(userDetail()->department['name'])): ?>
                || <?php echo e(userDetail()->location['name']); ?>

                <?php endif; ?>
                <?php if(isset(userDetail()->division['name'])): ?>
                || <?php echo e(userDetail()->division['name']); ?>

                <?php endif; ?>

                <?php if(isset(userDetail()->department['name'])): ?>
                || <?php echo e(userDetail()->department['name']); ?>

                <?php endif; ?>
                <?php if(isset(userDetail()->section['name'])): ?>
                || <?php echo e(userDetail()->section['name']); ?>

                <?php endif; ?>

            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                        class="nav-link dropdown-toggle"><?php echo Auth::user()->name; ?></a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"
                        style="left: 0px; right: inherit;">
                        <li><a href="<?php echo e(route('employee.logout')); ?>" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
<?php /**PATH /var/www/html/finance/resources/views/employee/header.blade.php ENDPATH**/ ?>