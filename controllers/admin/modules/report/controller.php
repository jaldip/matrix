<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class reportController {

    public $aLayout = array('linegraph' => 'main');
    public $aLoginRequired = array('linegraph' => true);

    public function __construct() {
        global $sAction;
        global $oUser;
        
        //Login Is Required
        if ($this->aLoginRequired[$sAction]) {
            if (!$oUser->isLoggedin()) {
                redirect(getConfig('siteUrl') . '/users/login');
            }
        }
    }

    /* Last Modified on 13-01-18 */

    public function callLineGraph() {
        global $sAction;
        global $oUser, $oSession;
        $aListData["payload"] = array();
        $oEsp =new esp();
        var_dump($_POST); exit;
        $sListName = 'ALR';
        $aListEspData = $oEsp->getLastThirtyDaysRecords($sListName);
        
        //var_dump($aListEspData); exit;
        require("linegraph.tpl.php");
    }
    
}   