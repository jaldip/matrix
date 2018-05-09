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
                <h2><?php echo __('MATRIX FILTER'); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo getConfig('siteUrl') . '/home/dashboard'; ?>"><?php echo __('home'); ?></a>
                    </li>
                    <li>
                        <a><?php echo __('MATRIX FILTER'); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo __('Data Tables'); ?></strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo __('Matrix Data'); ?></h5>
                        </div>    
                        <div class="ibox-content">
                            <div class="table-responsive" >

                                <table class="table table-bordered table-hover" >

                                    <thead>
                                        <tr>
                                            <th width="150" align="center"><?php echo __('Date'); ?></th>
                                            <th width="150" align="center"><?php echo __('Esp List Name'); ?></th>
                                            <th width="150" align="center"><?php echo __('ESP'); ?></th>
                                            <th width="150" align="center"><?php echo __('Domain Grouped by ESP'); ?></th>
                                            <th width="100" align="center"><?php echo __('Success'); ?></th>
                                            <th width="100" align="center"><?php echo __('Open Percentage'); ?></th>
                                            <th width="150" align="center"><?php echo __('Clicks'); ?></th>
                                            <th width="100" align="center"><?php echo __('Complaints'); ?></th>
                                            <th width="100" align="center"><?php echo __('Complaints Rate'); ?></th>
                                            <th width="250" align="center"><?php echo __('Thrash Hold'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($aListData['payload'])) {
                                        $nCount = 1;
                                        foreach ($aListData['payload'] AS $aDataList) {
                                            if ($aDataList['isp_name'] == 'gmail.com' || $aDataList['isp_name'] == 'yahoo.com') {

                                                $nRangeOne = isset($aDataList['range_one']) ? $aDataList['range_one'] : 0;
                                                $nRangeTwo = isset($aDataList['range_two']) ? $aDataList['range_two'] : 10;
                                                $nRangeThree = isset($aDataList['range_three']) ? $aDataList['range_three'] : 11;
                                                $nRangeFour = isset($aDataList['range_four']) ? $aDataList['range_four'] : 20;
                                                $nRangeFive = isset($aDataList['range_five']) ? $aDataList['range_five'] : 21;
                                                $sBGColor ='';
                                               
                                                if ($aDataList['success'] >= $nRangeOne && $aDataList['success'] <= $nRangeTwo) {
                                                   $sBGColor = isset($aDataList['color_picker_one']) ? $aDataList['color_picker_one'] : '';
                                                } elseif ($aDataList['success'] >= $nRangeThree && $aDataList['success'] <= $nRangeFour) {
                                                   $sBGColor = isset($aDataList['color_picker_two']) ? $aDataList['color_picker_two'] : '';
                                                } else {
                                                    if ($aDataList['success'] >= $nRangeFive) {
                                                        $sBGColor = isset($aDataList['color_picker_three']) ? $aDataList['color_picker_three'] : '';
                                                    }   
                                                }
                                                ?>
                                                <tr  id="<?php echo $nCount; ?>" style="background-color:<?php echo $sBGColor;?>">
                                                <input type="hidden" name="id_esp_<?php echo $nCount; ?>" id="id_esp_<?php echo $nCount; ?>" value="<?php echo $aDataList['id_esp']; ?>" /> 
                                                <input type="hidden" name="esp_list_id_<?php echo $nCount; ?>" id="esp_list_id_<?php echo $nCount; ?>" value="<?php echo $aDataList['list_id']; ?>" /> 
                                                <input type="hidden" name="esp_list_name_<?php echo $nCount; ?>" id="esp_list_name_<?php echo $nCount; ?>" value="<?php echo $aDataList['list_name']; ?>" /> 
                                                <input type="hidden" name="esp_date_<?php echo $nCount; ?>" id="esp_date_<?php echo $nCount; ?>" value="<?php echo date("Y-m-d H:i:s", $aDataList['delivery_date']); ?>" />
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                            <?php echo date("Y-m-d H:i:s", $aDataList['delivery_date']); ?>
                                                        </font></b>
                                                </td>

                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['list_name']; ?>
                                                        </font></b>
                                                </td>

                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['esp_name']; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['isp_name']; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['success']; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo round($aDataList['opens_rate'],2).' %'; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['clicks']; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" ><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['complaints']; ?>
                                                        </font></b>
                                                </td>
                                                <td align="center" id="one"><b>
                                                        <font  face="Arial" >
                                                        <?php echo $aDataList['complaints_rate']; ?>
                                                        </font></b>
                                                </td>

                                                <td align="center" >
                                                    <input type="text" name="range-one-<?php echo $nCount; ?>" id="range-one-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_one']) ? $aDataList['range_one'] : ''; ?>" style="width:30%" />
                                                    <input type="text" name="range-two-<?php echo $nCount; ?>" id="range-two-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_two']) ? $aDataList['range_two'] : ''; ?>" style="width:30%" /> 
                                                    <div class="input-group demo2 colorpicker-element" style="width:30%; float:right">
                                                        <input type ="hidden" name="colomn-color-one-<?php echo $nCount; ?>" id="colomn-color-one-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['color_picker_one']) ? $aDataList['color_picker_one'] : 'red'; ?>" class="form-control colorpicker-element" />
                                                        <span class="input-group-addon"><i style="background-color: red !important;"></i></span>
                                                    </div><br/>
                                                    <!--<input class="input-group-addon" type="color" name="colomn-color" id="colomn-color-<?php //echo $nCount;   ?>" value="#000000" onchange="changeColor(<?php //echo $nCount ;    ?>,<?php //echo $aDataList['success'];    ?>)"  style="width:30%" />-->
                                                    <input type="text" name="range-three-<?php echo $nCount; ?>" id="range-three-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_three']) ? $aDataList['range_three'] : ''; ?>" style="width:30%" />
                                                    <input type="text" name="range-four-<?php echo $nCount; ?>" id="range-four-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_four']) ? $aDataList['range_four'] : ''; ?>" style="width:30%" /> 
                                                    <div class="input-group demo2 colorpicker-element" style="width:30%; float:right">
                                                        <input type ="hidden" name="colomn-color-two-<?php echo $nCount; ?>" id="colomn-color-two-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['color_picker_two']) ? $aDataList['color_picker_two'] : 'yellow'; ?>" class="form-control colorpicker-element" />
                                                        <span class="input-group-addon"><i style="background-color: yellow !important;"></i></span>
                                                    </div><br/>

                                 <!--<input type="color" name="colomn-color" id="colomn-color-<?php echo $nCount; ?>" value="#000000" onchange="changeColor(<?php echo $nCount; ?>,<?php echo $aDataList['success']; ?>)"  style="width:30%" />-->
                                                    <input type="text" name="range-five-<?php echo $nCount; ?>" id="range-five-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_five']) ? $aDataList['range_five'] : ''; ?>" style="width:30%" />
                                                    <input type="text" name="range-six-<?php echo $nCount; ?>" id="range-six-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['range_six']) ? $aDataList['range_six'] : ''; ?>" style="width:30%" /> 
                                                    <!--<input type="color" name="colomn-color" id="colomn-color-<?php echo $nCount; ?>" value="#000000" onchange="changeColor(<?php echo $nCount; ?>,<?php echo $aDataList['success']; ?>)" style="width:30%"  />-->
                                                    <div class="input-group demo2 colorpicker-element" style="width:30%; float:right; margin-bottom: 2px;">
                                                        <input type ="hidden" name="colomn-color-three-<?php echo $nCount; ?>" id="colomn-color-three-<?php echo $nCount; ?>" value="<?php echo isset($aDataList['color_picker_three']) ? $aDataList['color_picker_three'] : 'green'; ?>" class="form-control colorpicker-element" />
                                                        <span class="input-group-addon"><i style="background-color: green;" ></i></span>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <button id="submit" type="submit" name="submit" style="width:100%" class="btn btn-success" onclick="changeColor(<?php echo $nCount; ?>,<?php echo $aDataList['success']; ?>);"><?php echo __('Set'); ?></button>
                                                    </div> 

                                                </td>
                                                </tr>    
                                                <?php
                                            }
                                            $nCount++;
                                        }
                                    } else {
                                        echo __('No Data Found !!!');
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div> 
        <div class="footer">
            <div>
                <strong><?php echo __('for_any_query_please_contact_stepinsolutions'); ?></strong>
            </div>
        </div>
    </div>
</div>
<form name="updateEspForm" id="updateEspForm" method="POST" action="<?php echo getConfig('siteUrl') . '/home/addeditesp'; ?>">
    <input type="hidden" name="hidden_id_esp" id="hidden_id_esp" value="" /> 
    <input type="hidden" name="esp_list_name" id="esp_list_name" value="" /> 
    <input type="hidden" name="esp_list_id" id="esp_list_id" value="" /> 
    <input type="hidden" name="esp_date" id="esp_date" value="" />
    <input type="hidden" name="range_one" id="range_one" value="" />
    <input type="hidden" name="range_two" id="range_two" value="" />
    <input type="hidden" name="range_three" id="range_three" value="" />
    <input type="hidden" name="range_four" id="range_four" value="" />
    <input type="hidden" name="range_five" id="range_five" value="" />
    <input type="hidden" name="range_six" id="range_six" value="" />
    <input type="hidden" name="color-picker-one" id="color-picker-one" value="" />
    <input type="hidden" name="color-picker-two" id="color-picker-two" value="" />
    <input type="hidden" name="color-picker-three" id="color-picker-three" value="" />
</form> 
<script>
   
    function changeColor(nCount,nSuccessValue)
    {
        document.getElementById('hidden_id_esp').value = $("#id_esp_"+nCount).val();
        document.getElementById('esp_list_id').value = $("#esp_list_id_"+nCount).val();
        document.getElementById('esp_list_name').value = $("#esp_list_name_"+nCount).val();
        document.getElementById('esp_date').value = $("#esp_date_"+nCount).val();
        document.getElementById('range_one').value = $("#range-one-"+nCount).val();
        document.getElementById('range_two').value = $("#range-two-"+nCount).val();
        document.getElementById('range_three').value = $("#range-three-"+nCount).val();
        document.getElementById('range_four').value = $("#range-four-"+nCount).val();
        document.getElementById('range_five').value = $("#range-five-"+nCount).val();
        document.getElementById('range_six').value = $("#range-six-"+nCount).val();
        document.getElementById('color-picker-one').value = $("#colomn-color-one-"+nCount).val();
        document.getElementById('color-picker-two').value = $("#colomn-color-two-"+nCount).val();
        document.getElementById('color-picker-three').value = $("#colomn-color-three-"+nCount).val();
        //if(nSuccessValue >= $('#range-one-'+nCount).val() && nSuccessValue <= $('#range-two-'+nCount).val())
        //        {    
        //$('#'+nCount).css('background-color',$('#colomn-color-'+nCount).val());
        if( nSuccessValue >= $('#range-one-'+nCount).val() && nSuccessValue <= $('#range-two-'+nCount).val())
        {
            $('#'+nCount).css('background-color',$('#colomn-color-one-'+nCount).val());
        } 
        else if(nSuccessValue >= $('#range-three-'+nCount).val() && nSuccessValue <= $('#range-four-'+nCount).val())
        {
            $('#'+nCount).css('background-color',$('#colomn-color-two-'+nCount).val());
        }
        else
        {    if(nSuccessValue >= $('#range-five-'+nCount).val())
            {
                $('#'+nCount).css('background-color',$('#colomn-color-three-'+nCount).val());  
            }
        }
        document.getElementById("updateEspForm").submit();
        //        }    
    }
</script>    