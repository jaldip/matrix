<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class homeController {

    public $aLayout = array('dashboard' => 'main');
    public $aLoginRequired = array('dashboard' => true);

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

    public function callDashboard() {
        global $sAction;
        global $oUser, $oSession;
        // example of how to create an export
        $jRequest = json_decode('{ 
           "select":[
              [ 
                "MAX(`delivery_timestamp`)",
                "delivery_date"
             ],
             "list_id",
              "esp_name",
              "isp_name",
              "success",
              "opens",
              "clicks",
              "complaints",
              "complaints_rate"
           ],
           "from":"mailing",
           "order":[ 
              [ 
                 "esp_name",
                 "desc"
              ]
           ],
           "group":[ 
              "esp_connection_id"
           ]
        }',TRUE);

        $aListData = json_decode(post_request($jRequest, URL.'/all/api/reports/query', 'post'), TRUE);
        $nCount = 0;
        foreach ($aListData["payload"] AS $aData)
        {    
            $aDetails = getTitleBYListId(URL.'/api/lists/'.(int)$aData['list_id'], 'get');
            $aListTitle = json_decode($aDetails);
            $aListData["payload"][$nCount]['list_name'] = $aListTitle->payload->name;
            $nCount++;
        }
        require("dashboard.tpl.php");
    }

}   