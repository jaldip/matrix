<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
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
                <ul class="nav side-menu">
                    <li><a href="<?php echo getConfig('siteUrl') . '/home/dashboard' ?>"><i class="fa fa-home"><?php echo __('Home'); ?></i></a></li>
                </ul>
                <ul class="nav side-menu">
                    <li><a href="<?php echo getConfig('siteUrl') . '/graph/linegraph' ?>"><i class="fa fa-bar-chart-o"><?php echo __('Line Graph'); ?></i></a></li>
                </ul>
            </ul>

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
                <h2><?php echo __('MATRIX GRAPH'); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo getConfig('siteUrl') . '/home/dashboard'; ?>"><?php echo __('home'); ?></a>
                    </li>
                    <li>
                        <a><?php echo __('Matrix Graph'); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo __('Data Graph'); ?></strong>
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

            <!-- bar chart -->
<!--            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                
                <div class="x_content">
                  <div id="graph_bar" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>-->
            <!-- /bar charts -->

            <!-- bar chart -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Bar Charts <small>Sessions</small></h2>
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
                <div class="x_content">
                  <div id="graph_bar" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
            <!-- /bar charts --> 

             <!--bar charts group--> 
<!--            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                
                <div class="x_content2">
                  <div id="graphx" style="width:100%; height:300px;"></div>
                </div>
              </div>
            </div>-->
            <!-- /bar charts group -->

            <!-- pie chart -->
<!--            <div class="col-md-6 col-sm-6 col-xs-12">
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
            </div>-->
            <!-- /Pie chart -->

            <!-- graph area -->
<!--            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Graph area <small>Sessions</small></h2>
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
                  <div id="graph_area" style="width:100%; height:300px;"></div>
                </div>
              </div>
            </div>-->
            <!-- /graph area -->

            <!-- line graph -->
            <div class="col-md-12 col-sm-12 col-xs-12">
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

    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type 
     * 
     */
    <?php foreach($aListEspData['payload'] AS $aListData){
        alert($aListData['list_name']);
    } ?>
    Morris.Bar({
        element: 'graph_bar',
        data: [
            {date: '2018-05-07', success: 00},
            {date: '2018-05-06', success: 500},
            {date: '2018-05-05', success: 850},
            {date: '2018-05-04', success: 71000},
            {date: '2018-05-03', success: 55000},
            {date: '2018-05-02', success: 1540},
            {date: '2018-05-01', success: 440},
            {date: '2018-04-30', success: 7100},
            {date: '2018-04-29', success: 14710},
            {date: '2018-04-28', success: 710},
            {date: '2018-04-27', success: 1410},
            {date: '2018-04-26', success: 14000},
            {date: '2018-04-25', success: 15710},
            {date: '2018-04-24', success: 16710},
            {date: '2018-04-23', success: 17100},
            {date: '2018-04-22', success: 1910},
            {date: '2018-04-21', success: 1310},
            {date: '2018-04-20', success: 11000},
            {date: '2018-04-19', success: 13100},
            {date: '2018-04-18', success: 17010},
            {date: '2018-04-17', success: 18010},
            {date: '2018-04-16', success: 1900},
            {date: '2018-04-15', success: 2300},
            {date: '2018-04-14', success: 21010},
            {date: '2018-04-13', success: 5010},
            {date: '2018-04-12', success: 6300},
            {date: '2018-04-11', success: 8500},
            {date: '2018-04-10', success: 12500},
            {date: '2018-04-09', success: 14610},
            {date: '2018-04-08', success: 16610},
        ],
        xkey: 'date',
        ykeys: ['success'],
        labels: ['ALR'],
        barRatio: 1000,
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        xLabelAngle: 1000,
        hideHover: 'auto'
    });


    new Morris.Line({
        element: 'graph_line',
        xkey: 'date',
        ykeys: ['success'],
        labels: ['Success'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
            {date: '2018-05-07', success: 00},
            {date: '2018-05-06', success: 1500},
            {date: '2018-05-05', success: 5000},
            {date: '2018-05-04', success: 55000},
            {date: '2018-05-03', success: 2500},
            {date: '2018-05-02', success: 3000},
            {date: '2018-05-01', success: 4000},
            {date: '2018-04-30', success: 44000},
            {date: '2018-04-29', success: 45000},
            {date: '2018-04-28', success: 46000},
            {date: '2018-04-27', success: 33000},
            {date: '2018-04-26', success: 32000},
            {date: '2018-04-25', success: 1000},
            {date: '2018-04-24', success: 00},
            {date: '2018-04-23', success: 9600},
            {date: '2018-04-22', success: 16500},
            {date: '2018-04-21', success: 17500},
            {date: '2018-04-20', success: 5896},
            {date: '2018-04-19', success: 7500},
            {date: '2018-04-18', success: 7400},
            {date: '2018-04-17', success: 5200},
            {date: '2018-04-16', success: 8693},
            {date: '2018-04-15', success: 9693},
            {date: '2018-04-14', success: 10000},
            {date: '2018-04-13', success: 12000},
            {date: '2018-04-12', success: 15000},
            {date: '2018-04-11', success: 16000},
            {date: '2018-04-10', success: 17000},
            {date: '2018-04-09', success: 18000},
            {date: '2018-04-08', success: 22000},
            {date: '2018-04-07', success: 00},
        ]
    });

});

</script>    