<?php

/**
 * StepIn Solutions venture
 * 
 *
 * @package Stepone 
 */
class graphData extends siCommon {

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
    public function getdenotChartData()
    {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND DATE_SUB(  CURDATE(), INTERVAL 30 DAY )";
        $sSql = "SELECT
                        SUM(success) as success,
                        SUM(opens) as opens,
                        SUM(failed) as failed
                    FROM
                            esp e
                    WHERE" . $sAndWhere;
        $sQueryHendler = $this->getList($sSql,array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getbargraphdata()
    {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND DATE_SUB( CURDATE( ) , INTERVAL 30 DAY )";
        $sAndWhere .= " GROUP BY esp_date";
        
        $sSql = "SELECT 
                        esp_list_name,
                        esp_date,
                        SUM( success ) AS success,
                        SUM( opens ) AS opens,
                        SUM( failed ) AS failed
                      
                    FROM
                        esp e
                    WHERE" . $sAndWhere;


        $sQueryHendler = $this->getList($sSql,array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getlinegraphdata()
    {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND DATE_SUB( CURDATE( ) , INTERVAL 30 DAY )";
        $sAndWhere .= " GROUP BY DATE( esp_date )";
        
        $sSql = "SELECT 
                        SUM( success ) AS success,
                        esp_date
                    FROM
                            esp e
                    WHERE" . $sAndWhere;

        
        $sQueryHendler = $this->getList($sSql,array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
}

