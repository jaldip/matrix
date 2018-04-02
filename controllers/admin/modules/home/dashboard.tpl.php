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
                <li>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo __('Switch'); ?></label>
                        <div class="col-md-9 col-sm-9 col-xs-12" onclick="switchServer('<?php echo $bServerSwitch; ?>')">
                            <div class="">
                                <input class="js-switch" type="checkbox" style="display: none;" data-switchery="true" value="1" name="filter_status" id="filter_status" <?php echo ($bServerSwitch == 'on') ? 'checked' : ''; ?> />
                            </div>
                        </div>
                    </div>   
                </li>

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
                <h2><?php echo __('MATRIX_filter'); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo getConfig('siteUrl') . '/home/dashboard'; ?>"><?php echo __('home'); ?></a>
                    </li>
                    <li>
                        <a><?php echo __('MATRIX_filter'); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo __('data_tables'); ?></strong>
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
                            <div class="table-responsive" id="stock-table">
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th width="150" align="center"><?php echo __('Date'); ?></th>
                                            <th width="150" align="center"><?php echo __('Esp connection id'); ?></th>
                                            <th width="150" align="center"><?php echo __('ESP'); ?></th>
                                            <th width="150" align="center"><?php echo __('Domain Grouped by ESP');?></th>
                                             <th width="150" align="center"><?php echo __('Success'); ?></th>
                                             <th width="150" align="center"><?php echo __('Opens'); ?></th>
                                             <th width="150" align="center"><?php echo __('Clicks'); ?></th>
                                             <th width="150" align="center"><?php echo __('Complaints'); ?></th>
                                             <th width="15  0" align="center"><?php echo __('Complaints Rate'); ?></th>
                                             <th width="250" align="center"><?php echo __('Thrash Hold'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($aListData['payload'])) {
                                        $nCount = 1;
                                        foreach($aListData['payload'] AS $aDataList)
                                        {
                                         ?>
                                         <tr  id="<?php echo $nCount;?>">
                                                
                                               <td align="center" ><b>
                                                    <font  face="Arial" >
                                                        <?php echo date("Y-m-d ", $aDataList['delivery_date']); ?>
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
                                                        <?php if($aDataList['isp_name'] =='gmail.com' || $aDataList['isp_name'] =='yahoo.com') {?>
                                                            <?php echo $aDataList['isp_name']; ?>
                                                        <?php } else{
                                                                echo '-';
                                                        } ?>
                                                    </font></b>
                                               </td>
                                               <td align="center" ><b>
                                                    <font  face="Arial" >
                                                        <?php echo $aDataList['success']; ?>
                                                    </font></b>
                                               </td>
                                                <td align="center" ><b>
                                                    <font  face="Arial" >
                                                        <?php echo $aDataList['opens']; ?>
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
                                                        <input type="text" name="range1" id="range-one-<?php echo $nCount;?>" value="0" style="width:53%" />
                                                        <input type="text" name="range2" id="range-two-<?php echo $nCount;?>" value="10" style="width:53%" /> 
                                                       ​ <input type="color" name="colomn-color" id="colomn-color-<?php echo $nCount;?>" value="#000000" onchange="changeColor(<?php echo $nCount ; ?>,<?php echo $aDataList['success']; ?>)"/>
                                               </td>
                                         </tr>    
                                   <?php $nCount++;
                                        }    
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
<script>
    function changeColor(nCount,nSuccessValue)
    {
        if(nSuccessValue >= $('#range-one-'+nCount).val() && nSuccessValue <= $('#range-two-'+nCount).val())
        {    
            $('#'+nCount).css('background-color',$('#colomn-color-'+nCount).val());
//            if( 0 >= $('#range-one-'+nCount).val() && 10 <= $('#range-two-'+nCount).val())
//            {
//                $('#'+nCount).css('background-color','red');
//            } 
//            if(11 >= $('#range-one-'+nCount).val() && 20 <= $('#range-two-'+nCount).val())
//            {
//                $('#'+nCount).css('background-color','yellow');
//            }
//            if(21 <= $('#range-one-'+nCount).val())
//            {
//                $('#'+nCount).css('background-color','green');
//            }  
        }    
    }
</script>    