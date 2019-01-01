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
        $previousDate = date('Y-m-d',strtotime("-1 days"));
        $dCreatedAt = date(getConfig('dtDateTime'));
        
        $jRequest = json_decode('{
           "select":[
              "stats_date",
              "mailing_sending_end_date",
              "list_id",
              "isp_id",
              "esp_connection_id",
              "esp_name",
              "isp_name",
              "list_name",
              "sum(`success`)",
              "sum(`opens`)",
              "sum(`clicks`)",
              "sum(`complaints`)",
              "complaints_rate",
              "sum(`opens`)",
              "opens_rate",
              "sum(`failed`)"
           ],
           "from":"mailing",
           "group":[
              "list_id",
              "isp_id"
           ],
           "list_ids" : "all",
           "filter":[
              [ 
                "is_test_campaign",
                "=",
                0
              ],
              [
                "stats_date",
                "=",
                "'.$previousDate.'"
              ]
           ]
        }',TRUE);

        $aListData = json_decode(post_request($jRequest, URL.'/all/api/reports/query', 'post'), TRUE);
        // echo '<pre>';var_dump($aListData);exit;
        $previousDate = date('Y-m-d',strtotime("-1 days"));
        $oEsp = new esp();
        $aListEspData = $oEsp->getEspList($previousDate);
        // var_dump($aListEspData);exit;
        $oThreshold = new threshold();
        $aThresholdFilterData=$oThreshold->getthresholdData();
        $aUniqueField = array();
        foreach ($aThresholdFilterData as $aData) {
            $aUniqueField[$aData['threshold key']] = $aData;
        }
        // var_dump($aUniqueField);exit;
        // foreach ($aListEspData as $aListDataForFilter) {
        //     $sespConnectionIdForFilter=$aListDataForFilter['esp_connection_id'];
        //     $sIspIdForFilter=$aListDataForFilter['isp_id'];
        //     $sListidForFilter=$aListDataForFilter['list_id'];
        //     $aThresholdFilterData=$oThreshold->getthresholdData($sespConnectionIdForFilter,$sIspIdForFilter,$sListidForFilter);
        // }

        $bFlag = FALSE;
        if(isset($aListEspData))
        {    
            $nCount = 0;

            foreach($aListEspData AS $aEspCountData)
            { 
                
                $aEspDate = explode(' ',$aListEspData[$nCount]['esp_date']);
                $previousDate .= " ".$aEspDate[1];
            
                if (array_search($previousDate,$aListEspData[$nCount])) {
                      $bFlag = TRUE;
                }
                $nCount++;
            }
        }   
        if(empty($aListEspData) || $bFlag == FALSE)
        {
            $nCount = 0;
            foreach ($aListData["payload"] AS $aData)
            {
                if ($aData['isp_name'] == 'gmail.com' || $aData['isp_name'] == 'yahoo.com' || $aData['isp_name'] == 'hotmail.com') 
                {
                    $aDetails = getTitleBYListId(URL.'/api/lists/'.(int)$aData['list_id'], 'get');
                    $aListTitle = json_decode($aDetails);
                 
                    $nIdEsp = '';
                    $nEspConnectionId = isset($aData['esp_connection_id']) ? $aData['esp_connection_id'] : '';
                    $nIspId = isset($aData['isp_id']) ? $aData['isp_id'] : '';
                    $nListId = isset($aData['list_id']) ? $aData['list_id'] : '';
                    $dEspDate = (date("Y-m-d H:i:s", $aData['stats_date']) != null) ? date("Y-m-d H:i:s", $aData['stats_date']) : '';
                    $dSentDate = (date("Y-m-d H:i:s", $aData['stats_date']) != null) ? date("Y-m-d H:i:s", $aData['mailing_sending_end_date']) : '';
                    $sListName = isset($aListTitle->payload->name) ? $aListTitle->payload->name : '';
                    $sEsp = isset($aData['esp_name']) ? $aData['esp_name'] : '';
                    $sDomainGroupedByEsp = isset($aData['isp_name']) ? $aData['isp_name'] : '';
                    $nSuccess = isset($aData['success']) ? $aData['success'] : '';
                    $nOpenPercentage = isset($aData['opens_rate']) ? $aData['opens_rate'] : '';
                    $nClicks = isset($aData['clicks']) ? $aData['clicks'] : '';
                    $nComplaints = isset($aData['complaints']) ? $aData['complaints'] : '';
                    $nComplaintsRate = isset($aData['complaints_rate']) ? $aData['complaints_rate'] : '';
                    $nOpens = isset($aData['opens']) ? $aData['opens'] : '';
                    $nFailed = isset($aData['failed']) ? $aData['failed'] : '';

                    $dUpdatedAt = date(getConfig('dtDateTime'));
                    $aEspData = array(
                        'id_esp' => $nIdEsp,
                        'esp_connection_id' => $nEspConnectionId,
                        'isp_id' => $nIspId, 
                        'list_id' => $nListId,
                        'esp_date' => $dEspDate,
                        'esp_list_name' => $sListName,
                        'esp' => $sEsp,
                        'domain_grouped_by_esp' => $sDomainGroupedByEsp,
                        'success' => $nSuccess,
                        'open_percentage' => $nOpenPercentage,
                        'clicks' => $nClicks,
                        'complaints' => $nComplaints,
                        'complaints_rate' => $nComplaintsRate,
                        'opens' => $nOpens,
                        'failed' => $nFailed,
                        'created_at' => $dCreatedAt,
                        'updated_at' => $dUpdatedAt,
                        'activated' => 1, 
                        'deleted' => 0   
                    );

                    $oEsp =new esp();
                    $oEsp->addNewEsp($aEspData);
                }
                $nCount++;
            }   
        }    
        $nCount = 0;
        
        // if(isset($aListData["payload"]))
        // {    
        //     foreach ($aListData["payload"] AS $aData)
        //     {   
        //         $aDetails = getTitleBYListId(URL.'/api/lists/'.(int)$aData['list_id'], 'get');
        //         $aListTitle = json_decode($aDetails);
        //         $aListData["payload"][$nCount]['list_name'] = $aListTitle->payload->name;
        //         $aEspNameList[] = $aListTitle->payload->name;
        //       // $aListData["payload"][$nCount]['open_percentage'] = ($aData['opens'] / $aData['sent']) * 100;
        //         foreach($aListEspData as $aEspData)
        //         {   
        //             if($aEspData['list_id'] == $aData['list_id'] && date("Y-m-d H:i:s", $aData['stats_date']) == $aEspData['esp_date'])
        //             {   
        //                 $aListData["payload"][$nCount]['id_esp'] = $aEspData['id_esp'];
        //                 $aListData["payload"][$nCount]['list_id'] = $aEspData['list_id'];
        //                 $aListData["payload"][$nCount]['range_one'] = $aEspData['range_one'];
        //                 $aListData["payload"][$nCount]['range_two'] = $aEspData['range_two'];
        //                 $aListData["payload"][$nCount]['range_three'] = $aEspData['range_three'];
        //                 $aListData["payload"][$nCount]['range_four'] = $aEspData['range_four'];
        //                 $aListData["payload"][$nCount]['range_five'] = $aEspData['range_five'];
        //                 $aListData["payload"][$nCount]['range_six'] = $aEspData['range_six'];
        //                 $aListData["payload"][$nCount]['color_picker_one'] = $aEspData['color_picker_one'];
        //                 $aListData["payload"][$nCount]['color_picker_two'] = $aEspData['color_picker_two'];
        //                 $aListData["payload"][$nCount]['color_picker_three'] = $aEspData['color_picker_three'];
        //             } 
        //         }
        //         $nCount++;
        //     }
        //     array_multisort($aEspNameList, SORT_ASC, $aListData["payload"] );
        // }
        require("dashboard.tpl.php");
    }
    public function callAddEditEsp() {
        global $sAction;
        global $oUser, $oSession;
        // var_dump($_POST);exit;
        $nThreshoId = isset( $_POST['id_threshold']) ? $_POST['id_threshold'] : '0'; 
        $nIdEsp = isset( $_POST['esp_connection_id']) ? $_POST['esp_connection_id'] : ''; 
        $sListid = isset($_POST['esp_list_id']) ? $_POST['esp_list_id'] : '';
        $sIspId = isset($_POST['isp_id']) ? $_POST['isp_id'] : '';
        $sDomainGroupdByEsp = isset($_POST['domain_grouped_by_esp']) ? $_POST['domain_grouped_by_esp'] : '';
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
        $oEsp = new esp();

             // exit();   
         $aThresholdData = array(
                            'id_threshold' => $nThreshoId,
                            'id_esp' => $nIdEsp,
                            'id_list' => $sListid,
                            'id_isp' => $sIspId,
                            'domain_groupd_by_esp' => $sDomainGroupdByEsp,
                            'range_one' => $nRangeOne,
                            'range_two' => $nRangeTwo,
                            'range_three' => $nRangeThree,
                            'range_four' => $nRangeFour, 
                            'range_five' => $nRangeFive, 
                            'range_six' => $nRangeSix,
                            'color_picker_one' => $sColorPickerOne,
                            'color_picker_two' => $sColorPickerTwo,
                            'color_picker_three' => $sColorPickerThree,
                            'created_at' => $dUpdatedAt,
                            'updated_at' => $dUpdatedAt,
                            
                        );
        
        $oEsp->addnewthreshold($aThresholdData,$nThreshoId);
        
        redirect(getConfig('siteUrl') . '/home/dashboard');

        // echo isset($_POST['hidden_id_esp']) ? $_POST['hidden_id_esp'] : 'hidden_id_esp';
        // echo "<br>";
        // echo isset($_POST['esp_list_name']) ? $_POST['esp_list_name'] : 'No esp_list_name';
        // echo "<br>";
        // echo isset($_POST['esp_list_id']) ? $_POST['esp_list_id'] : 'No esp_list_id'; 
        // echo "<br>";
        // echo isset($_POST['esp_date']) ? $_POST['esp_date'] : 'No esp_date';
        // echo "<br>";
        // echo isset($_POST['range_one']) ? $_POST['range_one'] : 'No range one';
        // echo "<br>";
        // echo isset($_POST['range_two']) ? $_POST['range_two'] : 'No range two';
        // echo "<br>";
        // echo isset($_POST['range_three']) ? $_POST['range_three'] : 'No range three';
        // echo "<br>";
        // echo isset($_POST['range_four']) ? $_POST['range_four'] : 'No range four';
        // echo "<br>";
        // echo isset($_POST['range_five']) ? $_POST['range_five'] : 'No range five';
        // echo "<br>";
        // echo isset($_POST['range_six']) ? $_POST['range_six'] : 'No range six';
        // echo "<br>";
        // echo isset($_POST['color-picker-one']) ? $_POST['color-picker-one'] : 'No color-picker-one';
        // echo "<br>";
        // echo isset($_POST['color-picker-two']) ? $_POST['color-picker-two'] : 'No color-picker-two';
        // echo "<br>";
        // echo isset($_POST['color-picker-three']) ? $_POST['color-picker-three'] : 'No color-picker-three';
        
        // exit;
        global $sAction;
        global $oUser, $oSession;
        $oESP = new esp();
        $aEspListData = $oESP->getEspListByName($_POST['esp_list_id']);
        $nIdEsp = isset($aEspListData[0]['id_esp']) ? $aEspListData[0]['id_esp'] : ''; 
        $nListId = isset($aEspListData[0]['list_id']) ? $aEspListData[0]['list_id'] : ''; 
        $sListName = isset($_POST['esp_list_name']) ? $_POST['esp_list_name'] : '';
        $sEsp = isset($aEspListData[0]['esp']) ? $aEspListData[0]['esp'] : '';
        $sDomainGroupedByEsp = isset($aEspListData[0]['domain_grouped_by_esp']) ? $aEspListData[0]['domain_grouped_by_esp'] : ''; 
        $sSuccess = isset($aEspListData[0]['success']) ? $aEspListData[0]['success'] : ''; 
        $nOpenPercentage = isset($aEspListData[0]['open_percentage']) ? $aEspListData[0]['open_percentage'] : ''; 
        $nClick = isset($aEspListData[0]['clicks']) ? $aEspListData[0]['clicks'] : '';
        $nComplaints = isset($aEspListData[0]['complaints']) ? $aEspListData[0]['complaints'] : ''; 
        $nComplaintsRate = isset($aEspListData[0]['complaints_rate']) ? $aEspListData[0]['complaints_rate'] : ''; 
        $nOpens = isset($aData['opens']) ? $aData['opens'] : '';
        $nFailed = isset($aData['failed']) ? $aData['failed'] : '';
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
                            'list_id' => $nListId,
                            'esp_date' => $dEspDate,
                            'esp_list_name' => $sListName,
                            'esp' => $sEsp,
                            'domain_grouped_by_esp' => $sDomainGroupedByEsp,
                            'success' => $sSuccess,
                            'open_percentage' => $nOpenPercentage, 
                            'clicks' => $nClick, 
                            'complaints' => $nComplaints,
                            'complaints_rate' => $nComplaintsRate,
                            'opens' => $nOpens,
                            'failed' => $nFailed,
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
        
        $aListEspData = $oEsp->getEspList();
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
        redirect(getConfig('siteUrl') . '/home/dashboard');
    }
    
}   