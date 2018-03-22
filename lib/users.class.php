<?php
 /**
  * StepIn Solutions venture
  * 
  *
  * @package Stepone 
  */
  class users extends siCommon
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
        // Do Login
        public function doLogin($sUserCredential) 
        {         
            $this->oSession->setSession(getconfig('sSessionName'),$sUserCredential);
        }
        // Is Logedin
        public function isLoggedin() 
        {
            return $this->oSession->getSession(getconfig('sSessionName'));
        }
        // Do LogOut
        public function doLogOut() 
        {
            $this->oSession->removeSession();
        }
        
        /**
         * function for varification of registered user
         * @param type $sVerificationKey
         * @return boolean
         */
        public function getLoginSessionAfterVerification($sVerificationKey) 
        {
            if(empty($sVerificationKey)) return false;
            $sAndWhere = ' 1 = 1';
            $sAndWhere .= " AND u.deleted = '0' AND u.activated = '1'";
            $sAndWhere .= " AND u.verification_key ='".$sVerificationKey."'";
            
            $sSql = "SELECT 
                            u.id_user,
                            u.first_name,
                            u.email,
                            u.verification_key,
                            u.mobile_number
                    FROM
                            users u
                    WHERE".$sAndWhere;
           
            $sQueryHendler = $this->oObject->getList($sSql,array(),array(),array(),array(),array());
            return $this->oObject->getData($sQueryHendler,"ARRAY");             
        }
        
        public function getSiteOwnerDetail($nIdUser,$aLimit = array())
        {
            if (empty($nIdUser) || !is_numeric($nIdUser))
                return false;

            $sAndWhere = " 1 = 1";
            $sAndWhere .= " AND u.deleted = '0'";
            $sAndWhere .= " AND u.id_user = $nIdUser";
            $sQuery = "SELECT
                                u.id_user AS id_user,
                                u.user_name AS login_name,
                                CONCAT(u.first_name,' ',u.last_name) AS owner_name,
                                u.first_name AS owner_first_name,
                                u.last_name AS owner_last_name,
                                u.email AS owner_email,
                                u.mobile AS owner_mobile,
                                u.office_number AS owner_office_number
                       FROM
                                users u
                       WHERE" . $sAndWhere;

            $sUSerSiteHandler = $this->getList($sQuery, $aLimit);
            return  $this->getData($sUSerSiteHandler,"ARRAY");
       }
        
       public function userRegister($aUserRegister) 
       {
        if(count($aUserRegister)==0 || !is_array($aUserRegister)) return false;
        $sTableName = 'users';
        $dTimeFormet = getConfig('dtDateTime');
        $dDate = date($dTimeFormet);

        $aInsertFieldArray = array(
            'id_user',
            'user_name',
            'first_name',
            'last_name',
            'email',
            'mobile',
            'office_number',
            'image',
            'salt',
            'password',
            'activated',
            'created_at',
            'updated_at',
        );
        $aInsertValueArray = array(
                                    array(
                                        $aUserRegister['id_user'],
                                        $aUserRegister['user_name'],
                                        $aUserRegister['owner_first_name'],
                                        $aUserRegister['owner_last_name'],
                                        $aUserRegister['owner_email'],
                                        $aUserRegister['owner_mobile'],
                                        $aUserRegister['owner_office_number'],
                                        $aUserRegister['owner_image'],
                                        $aUserRegister['salt'],
                                        $aUserRegister['password'],
                                        $aUserRegister['activated'],
                                        $dDate,
                                        $dDate
                                    )
        );
       
        $this->saveRecords($sTableName, $aInsertFieldArray, $aInsertValueArray);
        return !isset($aUserRegister['id_user']) || empty($aUserRegister['id_user']) ? mysql_insert_id() : $aUserRegister['id_user'];
  
        }
        public function getAdminEmailInfo($sEmail = '')
        {
            $sAndWhere = " 1 = 1";
            $sAndWhere .= " AND a.email = '$sEmail' ";
            $sAndWhere .= " AND a.activated='1' AND a.deleted = '0'";
            
            $sQuery = "SELECT
                                   a.id_admin AS id_admin,
                                   a.first_name AS first_name,
                                   a.last_name AS last_name,
                                   a.email AS email,
                                   a.login_name AS login_name
                          FROM
                                   admins a
                          WHERE " . $sAndWhere;
            $sUSerSiteHandler = $this->getList($sQuery);
            return $this->getData($sUSerSiteHandler, "ARRAY");
        }
  }
  
