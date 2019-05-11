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
                <div class="x_title bargraphcheckbox">
                    <h2>Success,Open and Failed total for every list name.<small></small></h2>
                    <!-- <label class="checkbox-container">
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
                            <?php 
                            } 
                            ?>
                            </label>
                    <?php } ?> -->
                        
                  <ul class="nav panel_toolbox">                    
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1"> 
                    <img id="loadingbar" src='<?php echo getConfig('siteUrl').'/img/source.gif' ?>' height='50px' width='50px' />                 
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
                    <img id="load" src='<?php echo getConfig('siteUrl').'/img/source.gif' ?>' height='50px' width='50px' />
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
                    <img id="loading" src='<?php echo getConfig('siteUrl').'/img/source.gif' ?>' height='50px' width='50px' />
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
$( document ).ready(function() {
    $.ajax({
        url: "<?php echo getConfig('siteUrl').'/report/bargraphdata' ?>",
        method: "POST",
        // data: {hidden_list_name : HiddenListName},
        beforeSend: function() {
            $('#loadingbar').show();
        },
        success: function(data){
            $('#loadingbar').hide();
            var graphData = data.split('-');
            var sSeries = JSON.parse(graphData[0]);
            var sCategories = ("[" + graphData[1] + "]");
            sCategories = sCategories.replace(/,(?=[^,]*$)/, '');
            sCategories = sCategories.replace(/'/g, '"');
            sCategories = JSON.parse(sCategories);
            var sEspNames = ("[" +graphData[2]+ "]");
            sEspNames = sEspNames.replace(/,(?=[^,]*$)/, '');
            sEspNames = sEspNames.replace(/'/g, '"');
            sEspNames = JSON.parse(sEspNames);
            var sColor = ("[" +graphData[3]+ "]");
            sColor = sColor.replace(/,(?=[^,]*$)/, '');
            sColor = sColor.replace(/'/g, '"');
            sColor = JSON.parse(sColor);
            // Highcharts.chart('container', {
            // chart: {
            //     type: 'column'
            // },
            // title: {
            //     text: ''
            // },
            // xAxis: {
            //     categories: sCategories
            // },
            // yAxis: {
            //     allowDecimals: false,
            //     min: 0,
            //     lineColor: '#FF0000',
            //     lineWidth: 1,
            //     title: {
            //         text: ''
            //     }
            // },
            // tooltip: {
            //     formatter: function () {
            //         return '<b>' + this.x + '</b><br/>' +
            //             this.series.name + ': ' + this.y + '<br/>' +
            //             'Total: ' + this.point.stackTotal;
            //     }
            // },
            // plotOptions: {
            //     column: {
            //         stacking: 'normal'
            //     }
            // },
            // series: sSeries
            // }); 

            $('.bargraphcheckbox').append('<label class="checkbox-container"><input type="checkbox" class="test" name="allchklist" id="allCheckBox" value="ALL" onchange="allCheckboxClick()" checked>ALL&nbsp;<span class="checkmark" style="background-color: #000000"></span></label>');

            $.each(sEspNames, function (index, value) {
                $('.bargraphcheckbox').append('<label class="checkbox-container"><input type="checkbox" name="chklist" id="'+sColor[index]+'" value="'+value+'" onchange="getListBarGraphData()" checked>'+ value +'&nbsp;<span class="checkmark" style="background-color: '+sColor[index]+';"></span></label>');

            });
            
            getListBarGraphData();
        },
    });
});

function getListBarGraphData(){
    var aCheckBoxValue = $('input[name=chklist]:checked').map(function(_, el) {
        return $(el).val();
    }).get();

    var selectedCheckBoxColour = [];

    $("input[name=chklist]:checked").each(function() {
      if ($(this).is(":checked")) {
        selectedCheckBoxColour.push($(this).attr('id'));
      }
    });
    var totalListCount = $('input[name=chklist]').length;

    if (aCheckBoxValue.length == totalListCount) 
    {
        $("input[name='allchklist']").prop('checked', true);
    }
    else
    {
        $("input[name='allchklist']").prop('checked', false);
    }

    
    if(aCheckBoxValue=='')
    {
        aCheckBoxValue = "nothing";
    }
    var form_data = new FormData();
    form_data.append('hidden_list_name', aCheckBoxValue);
    form_data.append('selected_checkbox_colour', selectedCheckBoxColour);

    $.ajax({
        type: 'POST',
        url: "<?php echo getConfig('siteUrl') . '/report/bargraphdata' ?>",
        contentType: false,
        processData: false,
        data: form_data,
        success: function(data) {
            $('#loadingbar').hide();
            if(data!='')
            {
                var graphData = data.split('-');
                var sSeries = JSON.parse(graphData[0]);
                var sCategories = ("[" + graphData[1] + "]");
                sCategories = sCategories.replace(/,(?=[^,]*$)/, '');
                sCategories = sCategories.replace(/'/g, '"');
                sCategories = JSON.parse(sCategories);
                var sEspNames = ("[" +graphData[2]+ "]");
                sEspNames = sEspNames.replace(/,(?=[^,]*$)/, '');
                sEspNames = sEspNames.replace(/'/g, '"');
                sEspNames = JSON.parse(sEspNames);
                var sColor = ("[" +graphData[3]+ "]");
                sColor = sColor.replace(/,(?=[^,]*$)/, '');
                sColor = sColor.replace(/'/g, '"');
                sColor = JSON.parse(sColor);
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
                series: sSeries
                });
            }
            else
            {
                var chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container'
                },
                title: {
                        text: ''
                    },
                xAxis: {
                    categories: []
                },
                series: []

                });
            }
        }   
    });
}

function allCheckboxClick()
{
    var checkedValue = $('input[name=allchklist]:checked').val();
    if (checkedValue =="ALL") 
    {
        $("input[name='chklist']").prop('checked', true);
        getListBarGraphData();
    }
    else
    {
        $("input[name='chklist']").prop('checked', false);
        getListBarGraphData();
    }   
}

$( document ).ready(function() { 
    $.ajax({
        url: "<?php echo getConfig('siteUrl').'/report/DonutGraphData' ?>",
        method: "POST", 
        beforeSend: function() {
            $('#loading').show();
        },
        success: function(result){
            $('#loading').hide();
            
            var JSONObject
            if(result !== "")
            {   
                JSONObject = JSON.parse(result);        
            }
            Morris.Donut({
                element: 'graph_donut',
                data: [
                {label: 'Total Success', value: JSONObject.success},
                {label: 'Total Open', value: JSONObject.opens},
                {label: 'Total Fail', value: JSONObject.failed},
                ],
                colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                formatter: function (y) {
                return y + "%"
                }
            });
        }
    });
});

$( document ).ready(function() {
    $.ajax({
        url: "<?php echo getConfig('siteUrl').'/report/linegraphdata' ?>",
        dataType: 'json',
        method: "POST",
        beforeSend: function() {
            $('#load').show();
        },
        success: function(data)
        {   
            $('#load').hide();
            var morrisData = [];

            $.each(data, function(key, val){
                morrisData.push({'date': val.esp_date, 'success' : val.success, 'opens' : val.opens}); 
            })

            new Morris.Line({
                element: 'graph_line',
                xkey: 'date',
                ykeys: ['success','opens'],
                labels: ['Total Success','Total Opens'],
                hideHover: 'auto',
                lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                data: morrisData
            });
        }
    });
});  
</script>