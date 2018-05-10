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
        $aLists = $oEsp->getAllListName();
        if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != '')
        {    
            $sListName = isset($_POST['hidden_list_name']) ? $_POST['hidden_list_name'] : '';
            $aListEspData = $oEsp->getRecordsByList($sListName);
            //$aLineGraphData = $aListEspData; 
        }else{
            
            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
            $aListEspData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
            
//            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
//            $aLineGraphData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
        }
        require("graph.tpl.php");
    }
    
}   