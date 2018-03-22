<?php
 /**
  * StepIn Solutions venture
  * 
  *
  * @package Stepone 
  */
  class siController
  {
  	 
        public $aUserRolePemissions;
        // constructor
        public function __construct() 
        {
            global $oUser;
            
            $this->oSession = new sessionManager();
            
            
            $aUserData = $oUser->isLoggedin();
            
            $nIdUser = isset($aUserData[0]['id_user'])?$aUserData[0]['id_user']:'';
            
            $this->releaseLock($nIdUser);
            
        }
        
        public function releaseLock($nIdUser) 
        {
            global $oUser;
            
            $sTableName = " project_specific_checklists";
            $oUser->updateRecord($sTableName,array('locked_by','locked_by'),array($nIdUser,'0'));
            
           
        }
        
        public function lockChecklist($nIdUser, $nIdChecklist) 
        {
            global $oUser;
            $sTableName = " project_specific_checklists";
            $oUser->updateRecord($sTableName,array('id_project_specific_checklist','locked_by'),array($nIdChecklist,$nIdUser));
            
        }
        
        public function isLocked($nIdUser, $nIdChecklist)
        {
            global $oUser;
       
            $oChecklists = new checklists();
            $aChecklistDetails = $oChecklists->getChecklistDetails($nIdChecklist);
            return ($aChecklistDetails[0]['locked_by'] == 0 || $aChecklistDetails[0]['locked_by'] == $nIdUser) ? true : false;
            
        }
        
  }
  
