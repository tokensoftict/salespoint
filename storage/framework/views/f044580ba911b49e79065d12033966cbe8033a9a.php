<header id="header" class="ui-header">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand">
                        <span class="logo" style="font-size: 22px;font-weight: bolder"><?php echo e(getStoreSettings()->name); ?></span>
                    </a>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="user-avatar"><img src="<?php echo e(asset('imgs/a0.jpg')); ?>" alt="..."></div>
                                <span class="hidden-sm hidden-xs"><?php echo e(auth()->user()->name); ?></span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="<?php echo e(route('myprofile')); ?>"><i class="fa fa-user"></i> My Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                    <!--notification end-->

                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/layouts/header.blade.php ENDPATH**/ ?>