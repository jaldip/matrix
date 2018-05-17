<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><?php echo __('Matrix'); ?></h1>

            </div>
            <h3><?php echo __('welcome_to_Matrix'); ?></h3>
            <br>
            <p><?php echo __('login_to_see_action');?></p>
            <?php
                if($oSession->hasError('invalid_login'))
                {
                       echo "<label class='error'>".$oSession->getError('invalid_login')."</label>";
                }
            ?>
            <form class="m-t" role="form" action="<?php echo getConfig('siteUrl').'/users/login' ?>" id="loginForm" method="POST" novalidate="novalidate">
                <div class="form-group">
                    <input type="text" name="login_name" id="login_name" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b"><?php echo __('login'); ?></button>

                <a href="<?php echo getConfig('siteUrl').'/users/forgotpassword' ?>"><small><?php echo __('forgot_password'); ?></small></a>
             </form>
        </div>
    </div>
