<?php 
    ob_clean();
    header("Pragma: no-cache");
    header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
    header('Content-Type: application/json');
    eval('$oMainController->call'.$sAction.'();');
?>
