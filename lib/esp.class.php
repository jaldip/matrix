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
                            'esp_connection_id',
                            'isp_id',  
                            'esp_date',
                            'esp_list_name',
                            'esp',
                            'domain_grouped_by_esp',
                            'success',
                            'open_percentage',
                            'clicks',
                            'complaints',
                            'complaints_rate',
                            'opens',
                            'failed',
                            'created_at', 
                            'updated_at',
                            'activated', 
                            'deleted' 
        );
        $aInsertValueArray = array(
            array(
                $aEspData['id_esp'],
                $aEspData['list_id'],
                $aEspData['esp_connection_id'],
                $aEspData['isp_id'],
                $aEspData['esp_date'],
                $aEspData['esp_list_name'],
                $aEspData['esp'],
                $aEspData['domain_grouped_by_esp'],
                $aEspData['success'],
                $aEspData['open_percentage'],
                $aEspData['clicks'],
                $aEspData['complaints'],
                $aEspData['complaints_rate'],
                $aEspData['opens'],
                $aEspData['failed'],
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
    public function getEspList($sPreviousESPDate = "") {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        if($sPreviousESPDate != ""){
            $sAndWhere .= " AND CAST(e.esp_date AS DATE) = '$sPreviousESPDate'";
        }
        $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_connection_id as esp_connection_id,
                        e.isp_id as isp_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        e.success as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate,
                        e.opens as opens,
                        e.failed as failed,
                        e.created_at as created_at,
                        e.updated_at as updated_at
                       
                    FROM
                            esp e
                    WHERE" . $sAndWhere;

        //var_dump($sSql); exit;           
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
                        e.complaints_rate as complaints_rate,
                        e.opens as opens,
                        e.failed as failed,
                        
                    FROM
                            esp e
                    WHERE" . $sAndWhere;
        
        //var_dump($sSql);            
        $sQueryHendler = $this->getList($sSql, array(), array(), array(), array(), array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getLastThirtyDaysRecords($aGroupBy) {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND e.esp_date > CURDATE() - INTERVAL 31 DAY ";
        $sAndWhere .= " AND e.esp_date < CURDATE() ";
        
        $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        SUM(success) as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate, 
                        SUM(opens) as opens,
                        SUM(failed) as failed,
                        e.created_at as created_at,
                        e.updated_at as updated_at
                      
                    FROM
                            esp e
                    WHERE" . $sAndWhere;

             
        $sQueryHendler = $this->getList($sSql,array(),$aGroupBy, array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getAllListName() {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        
        $sSql = "SELECT 
                       DISTINCT e.esp_list_name as esp_list_name
                    FROM
                            esp e
                    WHERE" . $sAndWhere;

        
        $sQueryHendler = $this->getList($sSql,array(),array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function getRecordsByList($sListName='') {
        $sAndWhere = ' 1 = 1';
        $sAndWhere .= " AND e.deleted = 0 AND e.activated = 1 ";
        $sAndWhere .= " AND e.esp_date > CURDATE() - INTERVAL 31 DAY ";
        $sAndWhere .= " AND e.esp_date < CURDATE() ";
        if($sListName != ""){
            // $sAndWhere .= " AND e.esp_list_name IN $sListName";

            $sListName = explode(',', $sListName);    
            $aListName = "'" . implode("','",  array_map("trim",array_filter($sListName))) . "'";
            $sAndWhere .= " AND (e.esp_list_name IN (". $aListName . "))";
        }
        $sAndWhere .= " GROUP BY e.esp_date";
        
        $sSql = "SELECT 
                        e.id_esp as id_esp,
                        e.list_id as list_id,
                        e.esp_date as esp_date,
                        e.esp_list_name as esp_list_name,
                        e.esp as esp,
                        e.domain_grouped_by_esp as domain_grouped_by_esp,
                        SUM( e.success ) as success,
                        e.open_percentage as open_percentage, 
                        e.clicks as clicks, 
                        e.complaints as complaints,
                        e.complaints_rate as complaints_rate, 
                        SUM( e.opens ) as opens,
                        SUM( e.failed ) as failed,
                        e.created_at as created_at,
                        e.updated_at as updated_at
                       
                    FROM
                            esp e
                    WHERE" . $sAndWhere;          
        $sQueryHendler = $this->getList($sSql,array(),array(), array(), array(),array());
        return $this->getData($sQueryHendler, "ARRAY");
    }
    public function addnewthreshold($aThresholdData,$nThreshoId)
    {
        $sTableName = 'threshold';

        $aInsertFieldArray = array(
                            'id_threshold',
                            'id_esp',
                            'id_list', 
                            'id_isp',
                            'domain_groupd_by_esp',  
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
        );
        $aInsertValueArray = array(
            array(
                $nThreshoId,
                $aThresholdData['id_esp'],
                $aThresholdData['id_list'],
                $aThresholdData['id_isp'],
                $aThresholdData['domain_groupd_by_esp'],
                $aThresholdData['range_one'],
                $aThresholdData['range_two'],
                $aThresholdData['range_three'],
                $aThresholdData['range_four'],
                $aThresholdData['range_five'],
                $aThresholdData['range_six'],
                $aThresholdData['color_picker_one'],
                $aThresholdData['color_picker_two'],
                $aThresholdData['color_picker_three'],
                $aThresholdData['created_at'],
                $aThresholdData['updated_at'],
            )
        );
        $this->saveRecords($sTableName, $aInsertFieldArray, $aInsertValueArray);   
    }
}

