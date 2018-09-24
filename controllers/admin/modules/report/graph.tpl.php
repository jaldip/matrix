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
                  <h2>Bar Chart Group <small>Sessions</small></h2>
                  <ul class="nav panel_toolbox">
                    <li>
                        <select class="form-control" onchange="getReportData(this.value,'<?php echo getConfig('siteUrl').'/report/graph';?>')">
                            <option value="">ALL</option>
                            <?php foreach($aLists AS $aListData){ ?>
                            <option value="<?php echo $aListData['esp_list_name']; ?>" <?php echo ($aListData['esp_list_name'] == $_POST['hidden_list_name']) ? 'selected' : ''; ?>><?php echo $aListData['esp_list_name']; ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    
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
                  <h2>Line Graph <small>Sessions</small></h2>
                  
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
                  <h2>Pie Chart <small>Sessions</small></h2>
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
        $r = array(228, 12, 38, 115, 12, 175, 64, 18, 222, 13, 83, 199, 11, 157, 164, 17, 197, 110, 17, 197, 25, 148, 169, 89, 213, 219, 39, 193, 119, 25, 166, 172, 175, 231, 76, 60, 218, 247, 166, 26, 188, 156, 33, 47, 61, 148, 49, 38, 253, 254, 254);
        $g = array(12, 115, 175, 18, 13, 199, 157, 17, 110, 197, 17, 25, 169, 213, 39, 119, 166, 172, 148, 11, 66, 81, 154, 135, 188, 148, 169, 89, 213, 219, 39, 193, 119, 25, 166, 172, 175, 231, 76, 60, 218, 247, 166, 26, 188, 156, 33, 47, 61, 148, 49);
        $b = array(164, 11, 83, 222, 64, 12, 38, 228, 110, 197, 17, 25, 169, 213, 39, 119, 166, 172, 148, 11, 66, 81, 154, 64, 18, 222, 13, 83, 199, 11, 157, 164, 17, 197, 110, 17, 197, 25, 148, 169, 89, 213, 156, 33, 47, 61, 61, 148, 49, 38, 253);
                $nTotalSuccess = 0;
                $nTotalOpens = 0;
                $nTotalFailed = 0;
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
        
        $sPrevDate = "";
        $aDates = array();
        $aListNames = array();
        foreach ($aListEspData AS $aRecords) {

                if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != ''){ 
                    $aDate = explode(' ',$aRecords['esp_date']);
                    $sLabel = $aRecords['esp_list_name'].' '.$aDate[0];
                }else{
                    $aDate = explode(' ',$aRecords['esp_date']);
                    $sLabel = $aDate[0];
                    $sListName = $aRecords['esp_list_name'];
                }
                if($sLabel != $sPrevDate){
                    $sPrevDate = $sLabel;
                    $aDates[] = $sLabel;
                }
                if(!in_array($sListName, $aListNames)){
                    $aListNames[] = $sListName;
                }
         }
         $aFinalBarData = array();
         foreach ($aListEspData as $aRecords){
            
                $sDate = date_format(date_create($aRecords['esp_date']),"m/d/Y");
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["opens"] = $aRecords['opens'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["success"] = $aRecords['success'];
                $aFinalBarData[$aRecords["esp_list_name"]]["$sDate"]["failed"] = $aRecords['failed'];
         }
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
        
        //for color codes
        $i = 0;
        $rgbOpens = $rgbSuccess = $rgbFailed = array();
        foreach ($aListNames as $item){
            $rgbOpens[] = fromRGB($r[$i], $g[$i], $b[$i]);
            $rgbSuccess[] = fromRGB((11*$g[$i]/10), (12*$b[$i]/10), (13*$r[$i]/10));
            $rgbFailed[] = fromRGB((4*$b[$i]/10), (4*$r[$i]/10), (4*$g[$i]/10));
            $i++;
        }
        
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
            $sDataSeries .= "], stack: '".$item."', color: '".$rgbOpens[$i]."', showInLegend: false},";
            $sDataSeries1 .= "], stack: '".$item."', color: '".$rgbSuccess[$i]."', showInLegend: false},";
            $sDataSeries2 .= "], stack: '".$item."', color: '".$rgbFailed[$i]."', showInLegend: false},";
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
        	    foreach ($aListEspData AS $aRecords) {
        	    	            	    
			    if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != ''){ 
				$aDate = explode(' ',$aRecords['esp_date']);
				$sLabel = $aRecords['esp_list_name'].' '.$aDate[0];
			    }else{
                                $sLabel = date_format(date_create($aRecords['esp_date']),"m/d/Y");
			    }
			    if($sLabel != $sPrevDate){
			    	if($sPrevDate != ""){
				    echo ", ";
				}
				$sPrevDate = $sLabel;
				echo "'".$sLabel."'";
			    }
		     }
		?>
        ];
        
        var sLists = [
        	<?php
        	    $sListName = "";
        	    foreach ($aListEspData AS $aRecords) {
			    if(isset($_POST['hidden_list_name']) && $_POST['hidden_list_name'] != ''){ 
				
			    }else{
				if($sListName != ""){
				    echo ", ";
				}
				$sListName = $aRecords['esp_list_name'];
				echo "'".$sListName."'";
			    }
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
        max: 50000000,
        tickInterval: 1000000,
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
