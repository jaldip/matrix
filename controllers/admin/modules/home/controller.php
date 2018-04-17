<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class homeController {

    public $aLayout = array('dashboard' => 'main','addeditesp'=> 'main');
    public $aLoginRequired = array('dashboard' => true,'addeditesp'=> true);

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
              "opens_rate",
              "sent",
              "clicks",
              "complaints",
              "complaints_rate"
           ],
           "from":"mailing",
           "order":[ 
              [ 
                 "list_id",
                 "desc"
              ]
           ],
           "group":[ 
              "esp_connection_id"
           ]
        }',TRUE);

        $aListData = json_decode(post_request($jRequest, URL.'/all/api/reports/query', 'post'), TRUE);
        
        $oEsp =new esp();
        $aListEspData = $oEsp->getEspList();
       
        $nCount = 0;
        if(isset($aListData["payload"]))
        {    
            foreach ($aListData["payload"] AS $aData)
            {   
                $aDetails = getTitleBYListId(URL.'/api/lists/'.(int)$aData['list_id'], 'get');
                $aListTitle = json_decode($aDetails);
                $aListData["payload"][$nCount]['list_name'] = $aListTitle->payload->name;
                $aEspNameList[] = $aListTitle->payload->name;
               // $aListData["payload"][$nCount]['open_percentage'] = ($aData['opens'] / $aData['sent']) * 100;
                foreach($aListEspData as $aEspData)
                {   if(date("Y-m-d H:i:s", $aData['delivery_date']) == $aEspData['esp_date'])
                    {   
                        $aListData["payload"][$nCount]['id_esp'] = $aEspData['id_esp'];
                        $aListData["payload"][$nCount]['range_one'] = $aEspData['range_one'];
                        $aListData["payload"][$nCount]['range_two'] = $aEspData['range_two'];
                        $aListData["payload"][$nCount]['range_three'] = $aEspData['range_three'];
                        $aListData["payload"][$nCount]['range_four'] = $aEspData['range_four'];
                        $aListData["payload"][$nCount]['range_five'] = $aEspData['range_five'];
                        $aListData["payload"][$nCount]['range_six'] = $aEspData['range_six'];
                        $aListData["payload"][$nCount]['color_picker_one'] = $aEspData['color_picker_one'];
                        $aListData["payload"][$nCount]['color_picker_two'] = $aEspData['color_picker_two'];
                        $aListData["payload"][$nCount]['color_picker_three'] = $aEspData['color_picker_three'];
                    }
                }
                $nCount++;
            }
            array_multisort($aEspNameList, SORT_ASC, $aListData["payload"] );
        }
        require("dashboard.tpl.php");
    }
    public function callAddEditEsp() {
        global $sAction;
        global $oUser, $oSession;
        
        $nIdEsp = isset($_POST['hidden_id_esp']) ? $_POST['hidden_id_esp'] : ''; 
        $sListName = isset($_POST['esp_list_name']) ? $_POST['esp_list_name'] : '';
        $dEspDate = isset($_POST['esp_date']) ? $_POST['esp_date'] : '';
        $nRangeOne = isset($_POST['range_one']) ? $_POST['range_one'] : '';
        $nRangeTwo = isset($_POST['range_two']) ? $_POST['range_two'] : '';
        $nRangeThree = isset($_POST['range_three']) ? $_POST['range_three'] : '';
        $nRangeFour = isset($_POST['range_four']) ? $_POST['range_four'] : '';
        $nRangeFive = isset($_POST['range_five']) ? $_POST['range_five'] : '';
        $nRangeSix = isset($_POST['range_six']) ? $_POST['range_six'] : '';
        $sColorPickerOne = isset($_POST['color-picker-one']) ? $_POST['color-picker-one'] : '';
        $sColorPickerTwo = isset($_POST['color-picker-two']) ? $_POST['color-picker-two'] : '';
        $sColorPickerThree = isset($_POST['color-picker-three']) ? $_POST['color-picker-three'] : '';
      
        $dUpdatedAt = date(getConfig('dtDateTime'));
        $aEspData = array(
                            'id_esp' => $nIdEsp,
                            'esp_date' => $dEspDate,
                            'esp_list_name' => $sListName,
                            'range_one' => $nRangeOne,
                            'range_two' => $nRangeTwo,
                            'range_three' => $nRangeThree,
                            'range_four' => $nRangeFour,
                            'range_five' => $nRangeFive,
                            'range_six' => $nRangeSix,
                            'color_picker_one' => $sColorPickerOne,
                            'color_picker_two' => $sColorPickerTwo,
                            'color_picker_three' => $sColorPickerThree,
                            'updated_at' => $dUpdatedAt,
                            'activated' => 1, 
                            'deleted' => 0   
                        );
          if(!isset($_POST['hidden_id_esp']))
        {    
            $dCreatedAt = date(getConfig('dtDateTime'));
            $aEspData['created_at'] = $dCreatedAt;
        }   
        $oEsp =new esp();
        $oEsp->addNewEsp($aEspData);
        redirect(getConfig('siteUrl') . '/home/dashboard');
    }     
}   