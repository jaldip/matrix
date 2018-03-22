<?php

/**
 * StepIn Solutions venture
 *
 * To manage api transaction monitor related data
 * Author: Tushar Bhatt <tushar.bhatt.si@gmail.com>
 * @package Abc
 */
class emailTemplates extends siCommon {

    //Constructor
    public function __construct() {
            
            $sDbHost = getconfig('dbHost');
            $sDbUser = getconfig('dbUser');
            $sDbPassword = getconfig('dbPassword');
            $sDbName = getconfig('dbName');
            parent::__construct($sDbHost,$sDbUser,$sDbPassword,$sDbName);
    }

    /**
     * To add or update email template
     * @param type $aEmailData
     */
    public function addEditEmailTemplate($aEmailData) {
        $sTableName = 'mail_templates';
        $dTimeFormet = getConfig('dtDateTime');
        $dDate = date($dTimeFormet);

        $aEmailTemplateFields = array(
            'id_mail_template',
            'name',
            'mail_template_code',
            'subject',
            'template_body',
            'activated',
            'updated_at'
        );

        $aEmailTemplateValues = array(
            array(
                $aEmailData['id_mail_template'],
                $aEmailData['name'],
                $aEmailData['mail_template_code'],
                $aEmailData['subject'],
                $aEmailData['template_body'],
                $aEmailData['activated'],
                $dDate,
            )
        );
        if (empty($aEmailData['id_mail_template'])) {
            $aCreatedAtField = array('created_at');

            $aCreatedAtValue = array(array($dDate));

            $aEmailTemplateFields = array_merge($aEmailTemplateFields, $aCreatedAtField);
            $aEmailTemplateValues[0] = array_merge($aEmailTemplateValues[0], $aCreatedAtValue[0]);
        }
        $this->saveRecords($sTableName, $aEmailTemplateFields, $aEmailTemplateValues);
    }

    /**
     * Get all records from table
     * @return type array
     */
    public function getEmailTemplatelList($aLimit = array(), $aGroupBy = array(), $aSearch = array(), $aSort = array(), $sMode = '') {
        $sAndWhere = " 1 = 1";
        $sAndWhere .= " AND t.deleted = '0'";

        $sQuery = " 
                            SELECT 
                                    t.id_mail_template AS id_template,
                                    t.name AS name,
                                    t.mail_template_code AS code,
                                    t.subject AS subject,
                                    t.template_body AS template_body,
                                    t.activated AS activated
                            FROM
                                    mail_templates t
                            WHERE 
                                    " . $sAndWhere;

        $aResourse = $this->getList($sQuery, $aLimit, $aGroupBy, $aSearch, $aSort, $sMode);
        return $this->getData($aResourse, "ARRAY");
    }

    /**
     * Get specific record for edit
     * @param type $nEmailId
     * @return type array
     */
    public function getSpecificEmailTemplate($nEmailId) {
        $sAndWhere = " 1 = 1";
        $sAndWhere .= " AND t.id_mail_template = $nEmailId";
        $sQuery = "SELECT 
                    t.id_mail_template AS id_template,
                    t.name AS name,
                    t.mail_template_code AS code,
                    t.subject AS subject,
                    t.template_body AS template_body,
                    t.variable AS variable,
                    t.activated AS activated
              FROM
                    mail_templates t
              WHERE" . $sAndWhere;

        
        $aEmailTemplateResourse = $this->getList($sQuery);
        return $this->getData($aEmailTemplateResourse, "ARRAY");
    }

    public function getEmailTemplate($sEmailCode, $aVariable) {
        $aEmail = $this->getSpecificEmailTemplateByCode($sEmailCode);
        $sMsgBody = $aEmail[0]['template_body'];
        $aEmail[0]['template_body'] = $this->replaceArrayToValue($sMsgBody, $aVariable);
        return $aEmail[0];
    }

    public function replaceArrayToValue($sMsgBody, $aVariable) {
        foreach ($aVariable as $skey => $sValue) {
            $sMsgBody = str_replace('{' . $skey . '}', $sValue, $sMsgBody);
        }
        return $sMsgBody;
    }

    /**
     * Get specific record for edit
     * @param type $nEmailId
     * @return type array
     */
    public function getSpecificEmailTemplateByCode($sEmailCode) {
        $sAndWhere = " 1 = 1";
        $sAndWhere .= " AND t.mail_template_code = '$sEmailCode'";
        $sQuery = "SELECT 
                            t.subject AS subject,
                            t.template_body AS template_body
                    FROM
                            mail_templates t
                    WHERE" . $sAndWhere;
        $aEmailTemplateResourse = $this->getList($sQuery);
        return $this->getData($aEmailTemplateResourse, "ARRAY");
    }

    public function getStaticVariable() {
        $sAndWhere = " 1 = 1";
        $sQuery = " 
                            SELECT 
                                    t.id_variable AS id_variable,
                                    t.name AS name,
                                    t.value AS value
                            FROM
                                    mail_template_dynamic_variable t
                            WHERE 
                                    " . $sAndWhere;

        $aResourse = $this->getList($sQuery);
        return $this->getData($aResourse, "ARRAY");
    }

    public function saveStaticVariable($nVariableId = '', $sName, $sValue) {
        $sTableName = 'mail_template_dynamic_variable';

        $aDynamicVariableFields = array(
            'id_variable',
            'name',
            'value'
        );

        $aDynamicVariableValues = array(
            array(
                $nVariableId,
                $sName,
                $sValue
            )
        );
        $this->saveRecords($sTableName, $aDynamicVariableFields, $aDynamicVariableValues);
    }

    public function getSpecificStaticVariable($nVariableId) {
        $sAndWhere = " 1 = 1";
        $sAndWhere .= " AND t.id_variable = $nVariableId";
        $sQuery = "SELECT 
                            t.id_variable AS id_variable,
                            t.name AS name,
                            t.value AS value
                    FROM
                            mail_template_dynamic_variable t
                    WHERE" . $sAndWhere;

        $aVariableResourse = $this->getList($sQuery);
        return $this->getData($aVariableResourse, "ARRAY");
    }

    public function saveSingleDynamicVariable($nVariableId, $sValue) {
        $sQuery = "select variable from mail_templates where id_mail_template = $nVariableId";
        $aVariable = $this->getList($sQuery);
        $aVariable = $this->getData($aVariable, "ARRAY");
        if (empty($aVariable[0]['variable'])) {
            $sNewValue = $sValue;
        } else {
            $sNewValue = $aVariable[0]['variable'] . ',' . $sValue;
        }
        $sQuery = '';
        $sQuery = "UPDATE mail_templates SET variable= '$sNewValue' where id_mail_template = $nVariableId";
        $this->executeQuery($sQuery);
    }

    public function saveStringDynamicVariable($nVariableId, $sValue) {
        $sQuery = "UPDATE mail_templates SET variable = '$sValue' where id_mail_template = $nVariableId";
        $this->executeQuery($sQuery);
    }

}