<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/simple-line-icons/css/simple-line-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/weather-icons/css/weather-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/themify-icons/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/main.css')); ?>">
    <script src="<?php echo e(asset('assets/js/modernizr-custom.js')); ?>"></script>
</head>
<body>


<div class="sign-in-wrapper">
    <div class="sign-container">
        <div class="text-center">
            <h2 class="logo"><?php echo e(getStoreSettings()->name); ?></h2>
            <h4>Sign In</h4>
        </div>
        <?php if(session()->has('message')): ?>
            <h5 class="text-danger text-center"><?php echo e(session()->get('message')); ?></h5>
        <?php endif; ?>
        <form class="sign-in-form" method="post" role="form" action="<?php echo e(route('process_login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="User name" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
        </form>
        <div class="text-center copyright-txt">
            <small>© Inventory System Tokensoft ICT <?php echo e(date('Y')); ?></small>
        </div>
    </div>
</div>



<script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/autosize/dist/autosize.min.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/main.js')); ?>"></script>
</body>
</html>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/login.blade.php ENDPATH**/ ?>