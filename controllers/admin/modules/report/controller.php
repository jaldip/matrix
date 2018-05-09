<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class reportController {

    public $aLayout = array('graph' => 'main','graphbylist' => 'main');
    public $aLoginRequired = array('graph' => true,'graphbylist' => true);

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

    public function callGraph() {
        global $sAction;
        global $oUser, $oSession;
        $aListData["payload"] = array();
        $oEsp =new esp();
        
        $sListName = isset($_POST['list_name']) ? $_POST['list_name'] : '';
        $aListEspData = $oEsp->getLastThirtyDaysRecords($sListName);
        
        require("graph.tpl.php");
    }
    public function callGraphByList() {
        global $sAction;
        global $oUser, $oSession;
        $aListData["payload"] = array();
        $oEsp =new esp();
        
        $sListName = isset($_POST['hidden_list_name']) ? $_POST['hidden_list_name'] : '';
        $aListEspData = $oEsp->getLastThirtyDaysRecords($sListName);
        
        require("graph.tpl.php");
    }
}   