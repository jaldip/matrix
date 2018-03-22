<?php
/**
 * StepIn Solutions venture, an MVC framework
 * Application configuration  file
 *  
 * @package GTC
 */

     /* Constants */
     
            
            $aConfig[$sAppName] = array(
                                            'siteUrl' => "http://".$_SERVER["HTTP_HOST"],
                                            'language'=>'en',
                                            'homeModule'=>'rest',
                                            'homeAction'=>'processRequest',
                                            'nPagerLength'=>'3',
                                            'nPerPageRecords'=>'10',  
                                            'checkSlug'=>false,
                                            'sLogAndDebug'=>'logAndDebug', //values for sLogAndDebug are 'logOnly', 'false' and 'logAndDebug'. 
                                                                      //logOnly - Entry in database when IPhone send request to server.
                                                                      //false - No entry in database when Iphone don't send request to server. 
                                                                      //logAndDebug -  Entry in database and code should be debug.
                                            //Constant define into constant.inc.php file   
                                             'scoreType'=>'',
                                             'nInterval'=>'', //Interval to get count of users who have completed activity in last week
                                             'nNotificationLimit' => '10', //Latest 10 notification display
                                             'sRangeMeter'=>10, // range meter use to calculate for attempt verify (lat, long)
                                             'nPercentage'=>95 ,// use into function.inc
                                             'akmlAltitudeToRemove'=>',0.000000|,0.0'
                                        );
            
            
            
            $aApiResponseCode =   array (
                                         'SUCCESS'=> '1',
                                         'ERROR'=> '0'
                                        );
            
            
            $aUserAgents =        array ( 
                                         'GTC/1.0 CFNetwork/548.0.3 Darwin/10.8.0', //HTTP_USER_AGENT Value when there is API call from Iphone
                                         'GTC/1.0 CFNetwork/609 Darwin/13.0.0'
                                       );
            
