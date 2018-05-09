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
                  <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <select class="form-control" onchange="getReportData(this.value,'<?php echo getConfig('siteUrl').'/report/graphbylist';?>')">
                            <option value="ALR">ALR</option>
                            <option value="FPP">FPP</option>
                            <option value="WA">WA</option>
                        </select>
                    <li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  <div id="graph_bar_group" style="width:100%; height:280px;"></div>
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
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
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
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
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
            $nSuccessPercent = $nTotalSuccess/$nTotal *100;
            $nOpensPercent = $nTotalOpens/$nTotal *100;
            $nFailedPercent = $nTotalFailed/$nTotal *100;
        }   
        ?>
        var day_data = [
                {"date": "All", "Total Success": <?php echo $nTotalSuccess; ?>, "Total Open": <?php echo $nTotalOpens; ?>, "Total Fail": <?php echo $nTotalFailed; ?>},
        ];
    Morris.Bar({
        element: 'graph_bar_group',
        data: day_data,
        xkey: 'date',
        barColors: ['#0000FF', '#2ecc71','#f43015'],
        ykeys: ['Total Success','Total Open','Total Fail'],
        labels: ['Total Success','Total Open','Total Fail'],
        hideHover: 'auto',
        xLabelAngle: 60
    });

    new Morris.Line({
        element: 'graph_line',
        xkey: 'date',
        ykeys: ['success'],
        labels: ['Total Success'],
        hideHover: 'auto',
        lineColors: ['#0000FF', '#2ecc71','#f43015'],
        data: [
            <?php foreach ($aListEspData AS $aRecords) { ?>
            {date: '<?php echo $aRecords['esp_date']; ?>', success: <?php echo $aRecords['success']; ?>},
            <?Php } ?>
        ]
    });
    alert('sainath');
    Morris.Donut({
        element: 'graph_donut',
        data: [
            {label: 'Total Success', value: <?php echo $nSuccessPercent; ?>},
            {label: 'Total Open', value: <?php echo $nOpensPercent; ?>},
            {label: 'Total Fail', value: <?php echo $nFailedPercent; ?>},
        ],
        colors: ['#0000FF', '#2ecc71','#f43015'],
        formatter: function (y) {
            return y + "%"
        }
    });

});

</script>    
  