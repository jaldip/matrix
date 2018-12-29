<?php
/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class reportController {
    public $aLayout = array('graph' => 'main','graphbylist' => 'main','bargraphgata' => '','linegraphdata' => '','DonutGraphData' => '');
    public $aLoginRequired = array('graph' => true,'graphbylist' => true,'bargraphgata' => true,'linegraphdata' => true,'DonutGraphData' => false);
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
            
            // exit;
            // var_dump($aListEspData);exit;
            //$aLineGraphData = $aListEspData; 
        }else{
            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
            $aListEspData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
//            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
//            $aLineGraphData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
        }
        require("graph.tpl.php");
    }
    
    public function callBarGraphData(){
    }
    public function callLineGraphData(){
        echo "hello";
    }
    public function callDonutGraphData(){
        $oGraphData =new graphData();
        $aGraphData = $oGraphData->getdenotChartData();
        // echo json_encode($aGraphData);
        // var_dump($aGraphData);


        $nTotalSuccess = 0;
        $nTotalOpens = 0;
        $nTotalFailed = 0;
        $aDonetGraphData[]="";
        foreach ($aGraphData as $aDonetGraphData) {
        $nTotalSuccess += isset($aDonetGraphData['success']) ? $aDonetGraphData['success'] : 0;
        $nTotalOpens += isset($aDonetGraphData['opens']) ? $aDonetGraphData['opens'] : 0;
        $nTotalFailed += isset($aDonetGraphData['failed']) ? $aDonetGraphData['failed'] : 0;
        }
        $nSuccessPercent = 0;
        $nOpensPercent = 0;
        $nFailedPercent = 0;
        $nTotal = $nTotalSuccess+ $nTotalOpens+$nTotalFailed;
        if($nTotal != 0)
        {    
            $nSuccessPercent = round($nTotalSuccess/$nTotal *100,2);
            $nOpensPercent = round($nTotalOpens/$nTotal *100,2);
            $nFailedPercent = round($nTotalFailed/$nTotal *100,2);

        } 
        $aDonetGraphData[]=array("success"=>$nSuccessPercent,"opens"=>$nOpensPercent,"failed"=>$nFailedPercent);
        echo json_encode($aDonetGraphData[3]);
        
        

    }
}   
