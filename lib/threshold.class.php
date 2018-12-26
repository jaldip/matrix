<?php

/**
 * StepIn Solutions venture
 * 
 *
 * @package Stepone 
 */
class threshold extends siCommon {

    // constructor
    public function __construct() {
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
    public function getthresholdData()
    {
        $sAndWhere = ' 1 = 1';
        $sSql = "SELECT 
                        t.id_threshold as id_threshold,
                        t.id_esp as id_esp,
                        t.id_list as id_list,
                        t.id_isp as id_isp,
                        t.domain_groupd_by_esp as domain_groupd_by_esp,
                        t.range_one as range_one,
                        t.range_two as range_two,
                        t.range_three as range_three,
                        t.range_four as range_four,
                        t.range_five as range_five,
                        t.range_six as range_six,
                        t.color_picker_one as color_picker_one,
                        t.color_picker_two as color_picker_two,
                        t.color_picker_three as color_picker_three,
                        CONCAT(t.id_esp,'_',t.id_list,'_',t.id_isp) as 'threshold key'

                    FROM
                        threshold t
                    WHERE" . $sAndWhere;

                
        $mQueryHendler = $this->getList($sSql,array(),array(), array(), array(),array());

        return $this->getData($mQueryHendler, "ARRAY");
        
    }    
}