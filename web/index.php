<?php
 /**
  * StepIn Solutions venture, an MVC framework index file, landing page for the project
  * 
  *
  * @package stepone 
  */
  ob_start();  
  require("../../inc/bootstrap.inc.php");  
  $oRouter = eval("return new ".getConfig('routerClassName')."();");
  
  $aRouterSlug = $oRouter->mapSlug();
  
  if(count($aRouterSlug))
  {
    $sModule = $aRouterSlug['module'];
    $sAction = $aRouterSlug['action'];
  }
  
  $sLayoutPath = '';
  
  if(file_exists(getconfig('rootDir')."/controllers/".$sAppName."/modules/".$sModule."/controller.php"))
  {   
       require(getconfig('rootDir')."/controllers/".$sAppName."/modules/".$sModule."/controller.php");
        
	$oMainController = eval("return new ".$sModule."Controller();");
	if(method_exists($oMainController,'call'.$sAction))
	{
            if($oMainController->aLayout[$sAction])
            {               
                require(getconfig('rootDir')."/controllers/".$sAppName."/templates/".$sLayoutPath.$oMainController->aLayout[$sAction].".layout.php");
            }
            else
            {
                eval('$oMainController->call'.$sAction.'();');
            }
                
	}
  }
  else 
  {   
      redirect(getConfig('siteUrl').'/users/login');
  }