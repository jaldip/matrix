<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo __("rts_login"); ?></title>
        <link href="<?php echo getConfig('siteUrl') . '/css/bootstrap.min.css' ?>" rel="stylesheet">
        <link href="<?php echo getConfig('siteUrl') . '/font-awesome/css/font-awesome.css' ?>" rel="stylesheet">
        <link href="<?php echo getConfig('siteUrl') . '/css/animate.css' ?>" rel="stylesheet">
        <link href="<?php echo getConfig('siteUrl') . '/css/style.css' ?>" rel="stylesheet">

    </head>

    <body>
        <?php
            eval('$oMainController->call'.$sAction.'();');
        ?>
        <!-- Mainly scripts -->
        <script src="<?php echo getConfig('siteUrl') . '/js/jquery-3.1.1.min.js' ?>"></script>
        <script src="<?php echo getConfig('siteUrl') . '/js/bootstrap.min.js' ?>"></script>
       
    </body>
</html>

