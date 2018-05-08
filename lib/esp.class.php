<?php

/**
 * StepIn Solutions venture
 * 
 *
 * @package Stepone 
 */
class esp extends siCommon {

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
    public function addNewEsp($aEspData) {
        $sTableName = 'esp';

        $aInsertFieldArray = array(
                            'id_esp',
                            'list_id',   
                            'esp_date',
                            'esp_list_name',
                            'esp',
                            'domain_grouped_by_esp',
                            'success',
                            'open_percentage',
                            'clicks',
                            'complaints',
                            'complaints_rate',
                            'range_one',
                            'range_two',
                            'range_three',
                            'range_four',
                            'range_five',
                            'range_six',
                            'color_picker_one',
                            'color_picker_two',
                            'color_picker_three',
                            'created_at', 
                            'updated_at',
                            'activated', 
                            'deleted' 
        );
        $aInsertValueArray = array(
            array(
                $aEspData['id_esp'],
                $aEspData['list_id'],
                $aEspData['esp_date'],
                $aEspData['esp_list_name'],
                $aEspData['esp'],
                $aEspData['domain_grouped_by_esp'],
                $aEspData['success'],
                $aEspData['open_percentage'],
                $aEspData['clicks'],
                $aEspData['complaints'],
                $aEspData['complaints_rate'],
                $aEspData['range_one'],
                $aEspData['range_two'],
                $aEspData['range_three'],
                $aEspData['range_four'],
                $aEspData['range_five'],
                $aEspData['range_six'],
                $aEspData['color_picker_one'],
                $aEspData['color_picker_two'],
                $aEspData['color_picker_three'],
                $aEspData['created_at'],
                $aEspData['updated_at'],
                $aEspData['activated'],
                $aEspData['deleted']
            )
        );
        
        $this->saveRecords($sTableName, $aInsertFieldArray, $aInsertValueArray);
    }

    /**
     * function for get stock data
     * @param type 
     * @return boolean
     */
    public function getEspList() {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        
        $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        e.success as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate, 
                        e.range_one as range_one,
                        e.range_two as range_two,
                        e.range_three as range_three,
                        e.range_four as range_four,
                        e.range_five as range_five,
                        e.range_six as range_six,
                        e.color_picker_one as color_picker_one,
                        e.color_picker_two as color_picker_two,
                        e.color_picker_three as color_picker_three,
                        e.created_at as created_at,
                        e.updated_at as updated_at
                       
                    FROM
                            esp e
                    WHERE" . $sAndWhere;

        //var_dump($sSql);            
        $sQueryHendler = $this->getList($sSql,array(), array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getEspListByName($nListId) {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.list_id = ".'"'.$nListId.'"';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        
//        $aSort[] =   array(
//                                   ' ORDER BY e.id_esp' => array(' DESC')
//                               );
       $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        e.success as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate
                    FROM
                            esp e
                    WHERE" . $sAndWhere;
        
        //var_dump($sSql);            
        $sQueryHendler = $this->getList($sSql, array(), array(), array(), array(), array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getLastThirtyDaysRecords($sListName='ALR') {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND e.esp_date < CURDATE() - INTERVAL 30 DAY ";
        $sAndWhere .= " AND e.esp_list_name = '$sListName'";
        
        echo $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        e.success as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate, 
                        e.range_one as range_one,
                        e.range_two as range_two,
                        e.range_three as range_three,
                        e.range_four as range_four,
                        e.range_five as range_five,
                        e.range_six as range_six,
                        e.color_picker_one as color_picker_one,
                        e.color_picker_two as color_picker_two,
                        e.color_picker_three as color_picker_three,
                        e.created_at as created_at,
                        e.updated_at as updated_at
                       
                    FROM
                            esp e
                    WHERE" . $sAndWhere; exit;

        //var_dump($sSql);            
        $sQueryHendler = $this->getList($sSql,array(), array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
}

