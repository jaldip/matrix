<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class graphController {

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
        
        $oEsp =new esp();
        $aListEspData = $oEsp->getLastThirtyDaysRecords();
        
        $nCount = 0;
        foreach ($aListEspData as $aEspDetails)
        {    
            $aListData["payload"][$nCount] = $aEspDetails['id_esp'];
            $aListData["payload"][$nCount] = $aEspDetails['list_id'];
            $aListData["payload"][$nCount] = $aEspDetails['esp_date'];
            $aListData["payload"][$nCount] = $aEspDetails['esp_list_name'];
            $aListData["payload"][$nCount] = $aEspDetails['esp'];
            $aListData["payload"][$nCount] = $aEspDetails['domain_grouped_by_esp'];
            $aListData["payload"][$nCount] = $aEspDetails['success'];
            $aListData["payload"][$nCount] = $aEspDetails['open_percentage'];
            $aListData["payload"][$nCount] = $aEspDetails['clicks'];
            $aListData["payload"][$nCount] = $aEspDetails['complaints'];
            $aListData["payload"][$nCount] = $aEspDetails['complaints_rate'];
            $aListData["payload"][$nCount] = $aEspDetails['range_one'];
            $aListData["payload"][$nCount] = $aEspDetails['range_two'];
            $aListData["payload"][$nCount] = $aEspDetails['range_three'];
            $aListData["payload"][$nCount] = $aEspDetails['range_four'];
            $aListData["payload"][$nCount] = $aEspDetails['range_five'];
            $aListData["payload"][$nCount] = $aEspDetails['range_six'];
            $aListData["payload"][$nCount] = $aEspDetails['color_picker_one'];
            $aListData["payload"][$nCount] = $aEspDetails['color_picker_two'];
            $aListData["payload"][$nCount] = $aEspDetails['color_picker_three'];
            $nCount++;
        }    
        require("linegraph.tpl.php");
    }
    
}   