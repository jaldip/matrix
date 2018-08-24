<?php
$sAppName = 'admin';
require('../inc/bootstrap.inc.php');
global $sAction;
global $oUser, $oSession;
// example of how to create an export
$previousDate = date('Y-m-d', strtotime("-1 days"));
$dCreatedAt = date(getConfig('dtDateTime'));

$jRequest = json_decode('{ 
           "select":[
                [ 
                    "MAX(`stats_date`)",
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
                "complaints_rate",
                "opens",
                "failed"
           ],
           "filter": [
                [ "delivery_date", "=", "' . $previousDate . '" ]
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
        }', TRUE);

$aListData = json_decode(post_request($jRequest, URL . '/all/api/reports/query', 'post'), TRUE);
// echo '<pre>';var_dump($aListData);exit;

$oEsp = new esp();
$aListEspData = $oEsp->getEspList();
//var_dump($aListEspData);
$bFlag = FALSE;
if (isset($aListEspData)) {
    $nCount = 0;

    foreach ($aListEspData AS $aEspCountData) {
        $previousDate = date('Y-m-d', strtotime("-1 days"));
        $aEspDate = explode(' ', $aListEspData[$nCount]['esp_date']);
        $previousDate .= " " . $aEspDate[1];

        if (array_search($previousDate, $aListEspData[$nCount])) {
            $bFlag = TRUE;
        }
        $nCount++;
    }
}
if (empty($aListEspData) || $bFlag == FALSE) {
    $nCount = 0;
    foreach ($aListData["payload"] AS $aData) {
        if ($aData['isp_name'] == 'gmail.com' || $aData['isp_name'] == 'yahoo.com') {
            $aDetails = getTitleBYListId(URL . '/api/lists/' . (int) $aData['list_id'], 'get');
            $aListTitle = json_decode($aDetails);

            $nIdEsp = '';
            $nListId = isset($aData['list_id']) ? $aData['list_id'] : '';
            $dEspDate = (date("Y-m-d H:i:s", $aData['delivery_date']) != null) ? date("Y-m-d H:i:s", $aData['delivery_date']) : '';
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
            $nRangeOne = '';
            $nRangeTwo = '';
            $nRangeThree = '';
            $nRangeFour = '';
            $nRangeFive = '';
            $nRangeSix = '';
            $sColorPickerOne = '';
            $sColorPickerTwo = '';
            $sColorPickerThree = '';

            $dUpdatedAt = date(getConfig('dtDateTime'));
            $aEspData = array(
                'id_esp' => $nIdEsp,
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
                'range_one' => $nRangeOne,
                'range_two' => $nRangeTwo,
                'range_three' => $nRangeThree,
                'range_four' => $nRangeFour,
                'range_five' => $nRangeFive,
                'range_six' => $nRangeSix,
                'color_picker_one' => $sColorPickerOne,
                'color_picker_two' => $sColorPickerTwo,
                'color_picker_three' => $sColorPickerThree,
                'created_at' => $dCreatedAt,
                'updated_at' => $dUpdatedAt,
                'activated' => 1,
                'deleted' => 0
            );
            
            $oEsp = new esp();
            $oEsp->addNewEsp($aEspData);
        }
        $nCount++;
    }
}

?>
