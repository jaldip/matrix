<?php
    $sHexColorCodes = array('#8A2BE2','#CC5500','#E30022','#DE6FA1','#03C03C','#00BFFF','#FFD300','#556B2F','#77B5FE','#81613C','#4169E1','#E34234','#7FFF00','#36454F','#2F847C','#88540B','#BF4F51','#87A96B','#665D1E','#FFBF00','#9966CC','#8DB600','#007FFF','#9C2542','#54626F','#3B3C36');
    $sHiddenListName = (isset($_POST['hidden_list_name'])) ? $_POST['hidden_list_name'] : 'ALL';
    $aDates = array();
    $aListNames = array();
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
//    var_dump($rgbSuccess);
//    var_dump($rgbFailed);
    $nTotalSuccess = 0;
    $nTotalOpens = 0;
    $nTotalFailed = 0;
    $Tmp = 0;
    foreach ($aListEspData AS $aRecords) {
        $nTotalSuccess += isset($aRecords['success']) ? $aRecords['success'] : 0;
        $nTotalOpens += isset($aRecords['opens']) ? $aRecords['opens'] : 0;
        $nTotalFailed += isset($aRecords['failed']) ? $aRecords['failed'] : 0;                    
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

     $aFinalBarData = array();
     // for ($nCount=0; $nCount < sizeof($aListEspData) ; $nCount++) { 
     //    $sDate = date_format(date_create($aListEspData[$nCount]['esp_date']),"m/d/Y");
     //    if(findKey($aFinalBarData,$sDate) && findKey($aFinalBarData,$aListEspData[$nCount]["esp_list_name"]))
     //    {
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["opens"] += $aListEspData[$nCount]['opens'];
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["success"] += $aListEspData[$nCount]['success'];
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["failed"] += $aListEspData[$nCount]['failed'];    
     //    }
     //    else
     //    {
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["opens"] = $aListEspData[$nCount]['opens'];
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["success"] = $aListEspData[$nCount]['success'];
     //        $aFinalBarData[$aListEspData[$nCount]["esp_list_name"]]["$sDate"]["failed"] = $aListEspData[$nCount]['failed'];   
     //    }
        
     //    // $nCount++;
     //    // $sDate = date_format(date_create($aListEspData[$i]['esp_date']),"m/d/Y");
     //    // $aFinalBarData[$aListEspData[$i]["esp_list_name"]]["$sDate"]["opens"] += $aListEspData[$i]['opens'];
     //    // $aFinalBarData[$aListEspData[$i]["esp_list_name"]]["$sDate"]["success"] += $aListEspData[$i]['success'];
     //    // $aFinalBarData[$aListEspData[$i]["esp_list_name"]]["$sDate"]["failed"] += $aListEspData[$i]['failed'];
     // }
     foreach ($aListEspData as $aRecords){
        $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
        $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = 0;
        $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = 0;
        $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = 0;
        if(findKey($aFinalBarData,$sDate) && findKey($aFinalBarData,$aRecords["esp_list_name"]))
        {
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] += $aRecords['opens'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] += $aRecords['success'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] += $aRecords['failed'];    
        }
        else
        {
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
            $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];    
        }
     }

     //    $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
     //    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
     //    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
     //    $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];
     //    $aDomain[$aRecords['domain_grouped_by_esp']] = $aFinalBarData;


    foreach ($aListNames as $item){
        foreach ($aDates as $date){
            $sDate = date_format(date_create($date),"m/d/Y");
            if(!isset($aFinalBarData[$item][$sDate])){
                $aFinalBarData[$item][$sDate]["opens"] = "0";
                $aFinalBarData[$item][$sDate]["success"] = "0";
                $aFinalBarData[$item][$sDate]["failed"] = "0";
            }
        }
    }
?>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> 
                                <span class="text-muted text-xs block"><?php echo __('profile'); ?><b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo getConfig('siteUrl') . '/users/changepassword' ?>"><?php echo __('change_password'); ?></a></li>
                            <li><a href="<?php echo getConfig('siteUrl') . '/users/logout' ?>"><?php echo __('logout'); ?></a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <?php echo __('MATRIX'); ?>
                    </div>
                </li>
            </ul>
                <div class="menu_section">
                  <ul class="nav side-menu">
                    <li><a href="<?php echo getConfig('siteUrl') . '/home/dashboard' ?>"><i class="fa fa-home"></i>  Home </a>
                    </li>
                    <li><a href="<?php echo getConfig('siteUrl') . '/report/graph' ?>"><i class="fa fa-bar-chart-o" ></i>  Report</a></li>
                  </ul>  
                </div>
          </div>      
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><?php echo __('welcome_to'); ?> <?php echo 'admin'; ?>.</span>
                    </li>

                    <li>
                        <a href="<?php echo getConfig('siteUrl') . '/users/logout' ?>">
                            <i class="fa fa-sign-out"></i> <?php echo __('logout'); ?>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo __('REPORT'); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo getConfig('siteUrl') . '/home/dashboard'; ?>"><?php echo __('home'); ?></a>
                    </li>
                    <li>
                        <a><?php echo __('Report'); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo __('Data'); ?></strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          
          <div class="row">

             <!-- bar charts group -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                     <h2>Success,Open and Failed total for every list name.<small></small></h2>
                      <label class="checkbox-container">
                          <input type="checkbox" id="idChkAll" value="" <?php echo ($sHiddenListName == "ALL" || $sHiddenListName == "") ? 'checked' : ''; ?>  onchange="onCheckboxAllChanged(this.value,'<?php echo getConfig('siteUrl').'/report/graph';?>')"> ALL &nbsp;
                        <span class="checkmark" style="background-color: #000000;"></span>
                      </label>
                        <?php foreach ($aLists as $item){?>
                  
                            <label class="checkbox-container">
                                <?php if($item[0] != "") 
                                    { 
                                   // in_array(item[0], );
                                ?>
                                <input type="checkbox" name="chklist[]" value="<?php echo $item[0]; ?>" <?php echo (strchr($sHiddenListName,$item[0]) != "" || $sHiddenListName == "ALL" || $sHiddenListName == "") ? 'checked' : ''; ?> onchange="getReportData(this.value,'<?php echo getConfig('siteUrl').'/report/graph';?>')"> <?php echo $item[0]; ?>  &nbsp;
                                <span class="checkmark" style="background-color: <?php echo $sHexColorCodes[$aList2ColorCodes[$item[0]]];?>;"></span>
                                <?php } ?>
                            </label>
                        <?php } ?>
                        
                  <ul class="nav panel_toolbox">                    
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">                  
		          <div id="container" style="width:100%; height:650px;"></div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <!-- /bar charts group -->

            <!-- line graph -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Total success of esp list name for each day<small></small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                  <div id="graph_line" style="width:100%; height:300px;"></div>
                </div>
              </div>
            </div>
            <!-- /line graph -->

            <!-- pie chart -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Total Sucess and Open percentage <small></small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                  <div id="graph_donut" style="width:100%; height:300px;"></div>
                </div>
              </div>
            </div>
            <!-- /Pie chart -->
          </div>
        </div>

        <form id="commonForm" name="commonForm" method="POST">
            <input type="hidden" name="hidden_list_name" id="hidden_list_name" value=""/>
        </form>    
        <div class="footer">
            <div>
                <strong><?php echo __('for_any_query_please_contact_stepinsolutions'); ?></strong>
            </div>
        </div>

      </div>
      <!-- /page content -->
    </div>

  </div>
<script>
$(function () {
        <?php   
        $i = 0;
        $sSeries = "[";
        foreach ($aListNames as $item){
            $sDataSeries = "{ name: 'open', data: [";
            $sDataSeries1 = "{ name: 'success', data: [";
            $sDataSeries2 = "{ name: 'failed', data: [";
            foreach ($aDates as $date){
                $sDate = date_format(date_create($date),"m/d/Y");
                $sDataSeries .= $aFinalBarData[$item][$sDate]["opens"].",";
                $sDataSeries1 .= $aFinalBarData[$item][$sDate]["success"].",";
                $sDataSeries2 .= $aFinalBarData[$item][$sDate]["failed"].",";
            }
            $sDataSeries .= "], stack: '".$item."', color: '".$rgbOpens[$aList2ColorCodes[$item]]."', showInLegend: false},\n";
            $sDataSeries1 .= "], stack: '".$item."', color: '".$rgbSuccess[$aList2ColorCodes[$item]]."', showInLegend: false},\n";
            $sDataSeries2 .= "], stack: '".$item."', color: '".$rgbFailed[$aList2ColorCodes[$item]]."', showInLegend: false},\n";
            $sDataSeries .= $sDataSeries1.$sDataSeries2;
            $sSeries .= $sDataSeries;
            $i++;
        }
        $sSeries .= "]";
        $sSeries = str_replace(",]","]",$sSeries);
        echo "var sDataSeries = ".$sSeries;
        ?>
        
        var sCategories = [
            <?php
                $sPrevDate = ""; 
                foreach ($aDates AS $sDate) {
                    if($sPrevDate != ""){
                        echo ", ";
                    }
                    $sPrevDate = $sDate;
                    echo "'".$sDate."'";
                 }
            ?>
        ];
        
       
            
Highcharts.chart('container', {

    chart: {
        type: 'column'
    },

    title: {
        text: ''
    },

    xAxis: {
        categories: sCategories
    },

    yAxis: {
        allowDecimals: false,
        min: 0,
        lineColor: '#FF0000',
        lineWidth: 1,
        title: {
            text: ''
        }
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
        }
    },

    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },

    series: sDataSeries
});

    new Morris.Line({
        element: 'graph_line',
        xkey: 'date',
        ykeys: ['success'],
        labels: ['Total Success'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
            <?php foreach ($aListEspData AS $aRecords) { ?>
            { date: '<?php echo $aRecords['esp_date']; ?>', success: <?php echo $aRecords['success']; ?>},
            <?Php } ?>
        ]
    });
    Morris.Donut({
        element: 'graph_donut',
        data: [
            {label: 'Total Success', value: <?php echo $nSuccessPercent; ?>},
            {label: 'Total Open', value: <?php echo $nOpensPercent; ?>},
            {label: 'Total Fail', value: <?php echo $nFailedPercent; ?>},
        ],
        colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        formatter: function (y) {
            return y + "%"
        }
    });

});    
</script>
<script>
$( document ).ready(function() {
    
});
</script>