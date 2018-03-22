<?php
 /**
  * StepIn Solutions venture
  * 
  *
  * @package Stepone 
  */
  class stock extends siCommon
  {
  	 
        // constructor
        public function __construct() 
        {
            $this->oSession = new sessionManager();
            $sDbHost = getconfig('dbHost');
            $sDbUser = getconfig('dbUser');
            $sDbPassword = getconfig('dbPassword');
            $sDbName = getconfig('dbName');
            parent::__construct($sDbHost, $sDbUser, $sDbPassword, $sDbName);
            
        }
       
       /**
         * function for insert stock data
         * @param type $aStockData
         * @return boolean
         */
         
       public function insertStockData($aStockData) 
       {
        $sTableName = 'stocks';
        $dTimeFormet = getConfig('dtDateTime');
        $dDate = date($dTimeFormet);

        $aInsertFieldArray = array(
            'stock_id',
            'stock',
            'live_current_price',
            'today_volume',
            'historical_volume',
            'up_day1',
            'up_day2',
            'up_day3',
            'up_day4',
            'live_up_day',
            'less_than3',
            'created_at',
            'updated_at',
            'activated',
            'deleted'
        );
        $aInsertValueArray = array(
                                    array(
                                        $aStockData['stock_id'],
                                        $aStockData['stock'],
                                        $aStockData['live_current_price'],
                                        $aStockData['today_volume'],
                                        $aStockData['historical_volume'],
                                        $aStockData['up_day1'],
                                        $aStockData['up_day2'],
                                        $aStockData['up_day3'],
                                        $aStockData['up_day4'],
                                        $aStockData['live_up_day'],
                                        $aStockData['less_than3'],
                                        $dDate,
                                        $dDate,
                                        $aStockData['activated'],
                                        $aStockData['deleted']
                                    )
        );
       
        $this->saveRecords($sTableName, $aInsertFieldArray, $aInsertValueArray);
        }
        
        /**
         * function for get stock data
         * @param type 
         * @return boolean
         */
        public function getStockData() 
        {
            $sAndWhere = ' 1 = 1';
            $sAndWhere .= " AND s.deleted = '0' AND s.activated = '1'";
            
            $sSql = "SELECT 
                        s.stock_id as stock_id,
                        s.stock as stock,
                        s.live_current_price as live_current_price,
                        s.today_volume as today_volume,
                        s.historical_volume as historical_volume,
                        s.up_day1 as up_day1,
                        s.up_day2 as up_day2,
                        s.up_day3 as up_day3,
                        s.up_day4 as up_day4,
                        s.live_up_day as live_up_day,
                        s.less_than3 as less_than3,
                        s.created_at as created_at,
                        s.updated_at as updated_at,
                        s.activated as activated,
                        s.deleted as deleted       
                    FROM
                            stocks s
                    WHERE".$sAndWhere;
            
            //var_dump($sSql);            
            $sQueryHendler = $this->getList($sSql,array(),array(),array(),array(),array());
            //var_dump($sQueryHendler);
            return $this->getData($sQueryHendler,"ARRAY");             
        }
  }
  
