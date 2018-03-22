
<script>
    $( document ).ready(function() {
        <?php
           if($oSession->getSession('sDisplayMessage'))
           { 
        ?>
            $(document).ready(function() {
                showNotification("<?php echo $oSession->getSession('sDisplayMessage',1); ?>");
            });

        <?php
           }
        ?>
});      
</script>

<div class="heading">
    <h3><?php echo __('change_password'); ?></h3>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <span><?php echo __('change_password'); ?></span>
                </h4>
            </div>
            <div class="panel-body">
                <form action ="<?php echo getConfig('siteUrl').'/users/changepassword' ?>" method ="POST" id="changePasswordForm" name="changePasswordForm" class="form-horizontal" autocomplete="off">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="CurrentPassword"><?php echo __("current_password"); ?><font color="red">*</font></label>
                        <div class="col-lg-6">                            
                            <input type="password" id="current_password" name="current_password" maxlength="255" class="form-control uniform-input text" >
                            <?php
                            if ($oSession->hasError('current_password')) {
                                echo "<label class='error'>" . $oSession->getError('current_password') . "</label>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="NewPassword"><?php echo __("new_password"); ?><font color="red">*</font></label>
                        <div class="col-lg-6">                            
                            <input type="password"  id="new_password" maxlength="255" class="form-control uniform-input text" name="new_password">
                            <?php
                            if ($oSession->hasError('new_password')) {
                                echo "<label class='error'>" . $oSession->getError('new_password') . "</label>";
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="ConfirmPassword"><?php echo __("confirm_password"); ?><font color="red">*</font></label>
                        <div class="col-lg-6">                            
                            <input type="password" id="confirm_password" maxlength="255" class="form-control uniform-input text" id="confirm_password" name="confirm_password">
                            <?php
                            if ($oSession->hasError('confirm_password')) {
                                echo "<label class='error'>" . $oSession->getError('confirm_password') . "</label>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button class="btn btn-primary" type="submit" name="submit" id="submit" value="<?php echo __('submit'); ?>"><?php echo __('save_changes'); ?></button>
                            <a href="<?php echo getConfig('siteUrl').'/'.getConfig('homeModule').'/'.getConfig('homeAction'); ?>" class="btn btn-default" title="<?php echo __('cancel_change'); ?>"><?php echo __('cancel'); ?></a>
                        </div>    
                    </div> 
                </form>
            </div>
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div><!-- End .row-fluid -->
