<?php
/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class reportController {

    public $aLayout = array('graph' => 'main','graphbylist' => 'main','bargraphdata' => '','linegraphdata' => '','DonutGraphData' => '');
    public $aLoginRequired = array('graph' => true,'graphbylist' => true,'bargraphdata' => false
        ,'linegraphdata' => false,'DonutGraphData' => false);

    public function __construct() {
        global $sAction;
        global $oUser;
        
        //Login Is Required
        // if ($this->aLoginRequired[$sAction]) {
        //     if (!$oUser->isLoggedin()) {
        //         redirect(getConfig('siteUrl') . '/users/login');
        //     }
        // }
    }
    /* Last Modified on 13-01-18 */
    public function callGraph() {
        global $sAction;
        global $oUser, $oSession;
        $aListData["payload"] = array();
        $oEsp = new esp();
        $aLists = $oEsp->getAllListName();

        if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != '')
        {    
            $sListName = isset($_POST['hidden_list_name']) ? $_POST['hidden_list_name'] : '';
            $aListEspData = $oEsp->getRecordsByList($sListName);
            
            // exit;
            // var_dump($aListEspData);exit;
            $aLineGraphData = $aListEspData; 
        }else
        {
            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
            $aListEspData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
            $aGroupBy = array(' GROUP BY' => ' e.esp_date');
            $aLineGraphData = $oEsp->getLastThirtyDaysRecords($aGroupBy);
        }
        require("graph.tpl.php");
    }
    

    public function callBarGraphData(){
        global $sAction;
        global $oUser, $oSession;
        $oGraphData =new graphData();
        $aListData["payload"] = array();
        $sHexColorCodes = array('#8A2BE2','#CC5500','#E30022','#DE6FA1','#03C03C','#067fa8','#c6a400','#556B2F','#5f91cc','#81613C','#4169E1','#E34234','#62c401','#36454F','#2F847C','#88540B','#BF4F51','#87A96B','#665D1E','#FFBF00','#9966CC','#8DB600','#007FFF','#9C2542','#54626F','#3B3C36');
        $aDates = array();
        $oEsp = new esp();
        $aListNames = array();
        $aLists = $oEsp->getAllListName();
        $result='';
        if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != '')
        {   
            $sListName = isset($_POST['hidden_list_name']) ? $_POST['hidden_list_name'] : '';
            $aListEspData = $oEsp->getRecordsByList($sListName); 
            $aListNames = explode(",",$sListName);
            foreach ($aListEspData AS $aRecords) 
            {
                $sLabel = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                if(!in_array($sLabel, $aDates)){
                    $aDates[] = $sLabel;
                }
                
            }
            
            $sColorCode = "";
            foreach ($sHexColorCodes AS $Color) {
                $sColorCode .= "'".$Color."', ";
            }
            $sListNames = "";
            foreach ($aListNames AS $ListName) {
                $sListNames .= "'".$ListName."', ";
            }

            $i = 0;
            $aList2ColorCodes = array();
            $rgbOpens = $rgbSuccess = $rgbFailed = array();
            foreach ($aLists as $item){
                list($r, $g, $b) = sscanf($sHexColorCodes[$i], "#%02x%02x%02x");
                $rgbOpens[] = fromRGB((5*$r/10), (5*$g/10), (5*$b/10));
                $rgbSuccess[] = fromRGB((11*$r/10), (11*$g/10), (11*$b/10));
                $rgbFailed[] = fromRGB($r, $g, $b);
                $aList2ColorCodes[$item[0]] = $i;
                $i++;
            }

            $aFinalBarData = array();
            if(!empty($aListEspData))
            {
                foreach ($aListEspData as $aRecords){
                    $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
                    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
                    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];
                }

                $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];
                foreach ($aListNames as $item){
                    foreach ($aDates as $date)
                    {
                        $sDate = date_format(date_create($date),"m/d/Y");
                        if(!isset($aFinalBarData[$item][$sDate]))
                        {
                            $aFinalBarData[$item][$sDate]["opens"] = "0";
                            $aFinalBarData[$item][$sDate]["success"] = "0";
                            $aFinalBarData[$item][$sDate]["failed"] = "0";
                        }
                    }
                }

                $i = 0;
                $sSeries = "[";
                foreach ($aListNames as $item)
                {
                    $sDataSeries = '{ "name": "open", "data": [';
                    $sDataSeries1 = '{ "name": "success", "data": [';
                    $sDataSeries2 = '{ "name": "failed", "data": [';
                    foreach ($aDates as $date)
                    {
                        $sDate = date_format(date_create($date),"m/d/Y");
                        $sDataSeries .= $aFinalBarData[$item][$sDate]["opens"].",";
                        $sDataSeries1 .= $aFinalBarData[$item][$sDate]["success"].",";
                        $sDataSeries2 .= $aFinalBarData[$item][$sDate]["failed"].",";
                    }
                    $sDataSeries .= '], "stack": "'.$item.'", "color": "'.$rgbOpens[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                    $sDataSeries1 .= '], "stack": "'.$item.'", "color": "'.$rgbSuccess[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                    $sDataSeries2 .= '], "stack": "'.$item.'", "color": "'.$rgbFailed[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                    $sDataSeries .= $sDataSeries1.$sDataSeries2;
                    $sSeries .= $sDataSeries;
                    $i++;
                }
                $sSeries .= ']';
                $sSeries = str_replace(",]","]",$sSeries);
                $Date = "";
                foreach ($aDates AS $sDate) {
                    $Date .= "'".$sDate."', ";
                }
                $result = $sSeries . '-' . $Date . '-' . $sListNames . '-' .$sColorCode;
            }
            echo $result;
        }
        else
        {
            $oGraphData =new graphData();
            $sHiddenListName = (isset($_POST['hidden_list_name'])) ? $_POST['hidden_list_name'] : 'ALL';
            $aDates = array();
            $aListNames = array();
            $aListEspData = $oGraphData->getbargraphdata($sHiddenListName);
            foreach ($aListEspData AS $aRecords) {
                $sLabel = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                $sListName = $aRecords['esp_list_name'];
                if(!in_array($sLabel, $aDates)){
                    $aDates[] = $sLabel;
                }
                if(!in_array($sListName, $aListNames)){
                    $aListNames[] = $sListName;
                }
            }
           
            $sListNames = "";
            foreach ($aListNames AS $ListName) {
                $sListNames .= "'".$ListName."', ";
            }
            
            $sColorCode = "";
            foreach ($sHexColorCodes AS $Color) {
                $sColorCode .= "'".$Color."', ";
            }

            //for color codes
            $i = 0;
            $aList2ColorCodes = array();
            $rgbOpens = $rgbSuccess = $rgbFailed = array();
            foreach ($aLists as $item){
                list($r, $g, $b) = sscanf($sHexColorCodes[$i], "#%02x%02x%02x");
                $rgbOpens[] = fromRGB((5*$r/10), (5*$g/10), (5*$b/10));
                $rgbSuccess[] = fromRGB((11*$r/10), (11*$g/10), (11*$b/10));
                $rgbFailed[] = fromRGB($r, $g, $b);
                $aList2ColorCodes[$item[0]] = $i;
                $i++;
            }

            $aFinalBarData = array();

            foreach ($aListEspData as $aRecords){
                $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];
            }

            $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];

            foreach ($aListNames as $item){
                foreach ($aDates as $date)
                {
                    $sDate = date_format(date_create($date),"m/d/Y");
                    if(!isset($aFinalBarData[$item][$sDate]))
                    {
                        $aFinalBarData[$item][$sDate]["opens"] = "0";
                        $aFinalBarData[$item][$sDate]["success"] = "0";
                        $aFinalBarData[$item][$sDate]["failed"] = "0";
                    }
                }
            }

            $i = 0;
            $sSeries = "[";
            foreach ($aListNames as $item)
            {
                $sDataSeries = '{ "name": "open", "data": [';
                $sDataSeries1 = '{ "name": "success", "data": [';
                $sDataSeries2 = '{ "name": "failed", "data": [';
                foreach ($aDates as $date)
                {
                    $sDate = date_format(date_create($date),"m/d/Y");
                    $sDataSeries .= $aFinalBarData[$item][$sDate]["opens"].",";
                    $sDataSeries1 .= $aFinalBarData[$item][$sDate]["success"].",";
                    $sDataSeries2 .= $aFinalBarData[$item][$sDate]["failed"].",";
                }
                $sDataSeries .= '], "stack": "'.$item.'", "color": "'.$rgbOpens[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                $sDataSeries1 .= '], "stack": "'.$item.'", "color": "'.$rgbSuccess[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                $sDataSeries2 .= '], "stack": "'.$item.'", "color": "'.$rgbFailed[$aList2ColorCodes[$item]].'", "showInLegend": false},';
                $sDataSeries .= $sDataSeries1.$sDataSeries2;
                $sSeries .= $sDataSeries;
                $i++;
            }
            $sSeries .= ']';
            $sSeries = str_replace(",]","]",$sSeries);
            $Date = "";
            foreach ($aDates AS $sDate) {
                $Date .= "'".$sDate."', ";
            }
            $result = $sSeries . '-' . $Date . '-' . $sListNames . '-' .$sColorCode;
            echo $result;
        }
    }

    public function callLineGraphData()
    {
        $oLineGraphData =new graphData();
        $aGetLineGraphData = $oLineGraphData->getlinegraphdata();
        echo json_encode($aGetLineGraphData);
    }

    public function callDonutGraphData(){
        $oGraphData =new graphData();
        $aGraphData = $oGraphData->getdenotChartData();
        // echo json_encode($aGraphData);

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
