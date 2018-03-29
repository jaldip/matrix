<div class="middle-box text-center animated fadeInDown">
    <div>
        <div>
            <h2 class="logo-name"><?php echo __('Matrix'); ?></h2>

        </div>
        <h3><?php echo __('welcome_message'); ?></h3>
        <?php
            if($oSession->getSession('sDisplayMessage'))
            {
               echo "<div class='validation_message'>".$oSession->getSession('sDisplayMessage',true)."</div>";
            }
         ?>
        
        <div class="animated fadeInDown" id="passwordBox">
            <div class="row">

                <div class="col-md-12">
                    <div class="ibox-content">

                        <h2 class="font-bold"><?php echo __('forgot_password'); ?></h2>

                        <p>
                            <?php echo __('forgot_password_message'); ?>
                        </p>

                        <div class="row">

                            <div class="col-lg-12">
                                <form class="m-t" role="form" action="<?php echo getConfig('siteUrl') . '/users/forgotpassword' ?>" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ;?>" id="email" placeholder="<?php echo __("enter_email")?>" name="email" autofocus/>
                                        <?php
                                            if($oSession->getSession('email_forgotPassword'))
                                            {
                                               echo "<span class='validation_message'>".$oSession->getSession('email',true)."</span>";
                                            }
                                        ?>
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-primary block full-width m-b" title="<?php echo __('send_new_password'); ?>"><?php echo __('send_new_password'); ?></button>
                                    <a name="cancel" id="cancel" class="btn btn-default block full-width m-b" href="<?php echo getConfig('siteUrl') . '/admins/login' ?>" title="<?php echo __('cancel_change'); ?>"><?php echo __('cancel'); ?></a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="m-t"> <small><?php echo __('copy_rights');?></small> </p>
    </div>
</div>

