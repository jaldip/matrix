<?php
 /**
  * StepIn Solutions venture
  * 
  *
  * @package stepone
  */
  class restApi extends siCommon
  {     
    private $mRequest = array('');
    private $mResponse = array('');
    private $bLoggedin = '';
      
    /**
     * Constructer
     * @param type $aServerParam
     * @param type $aPostParam 
     */
    public function __construct($aServerParam,$aPostParam)
    {
        global $aUserAgents;
        $sDbHost = getConfig('dbHost');
        $sDbUser = getConfig('dbUser');
        $sDbPassword = getConfig('dbPassword');
        $sDbName = getConfig('dbName');
        $this->bLoggedin =  getConfig('sLogAndDebug');
        $this->mRequest = $aServerParam;
        $this->mResponse = $aPostParam;
        
        parent::__construct($sDbHost,$sDbUser,$sDbPassword,$sDbName);
        
//        $matches = null;	
//        if(!(preg_match('/CFNetwork\/(\d+(\.\d+)?)/', $this->mRequest['HTTP_USER_AGENT'], $matches)) && ($this->mRequest['HTTP_USER_AGENT'] != "Grab The Challenge"))
//        {
//             $this->commitLog();
//             throw new Exception('Browser not compitable');
//        }
    }

    /**
     *
     * @param type $sDebugLocation
     * @param type $sDebugInfo
     * @return array or true 
     */
    public function apiDebug($sDebugLocation,$sDebugInfo)
    {
        if($this->bLoggedin != 'logAndDebug') 
        {    
            return true;
        }
        else
        {
            $this->mResponse['debug'] = array($sDebugLocation => $sDebugInfo);
        }   
    }

    /**
     *
     * @return array or true
     */
    public function apiLog($sJsonData)
    {
        if($this->bLoggedin == false) 
        {    
            return true;
        }
        else
        {
            return $this->mRequest = $sJsonData;
        }   
    }
    /**
     *
     * @param type $aParams
     * @return array 
     */
    public function prepareResponse($aParams)
    {
        $sJsonData =  json_encode($aParams);     
        if($this->bLoggedin == 'logAndDebug')
        {
            $this->apiDebug('prepareResponse',$sJsonData);
        }   
        else if($this->bLoggedin == 'logOnly')
        {
            $this->apiLog($sJsonData);
        }   
        return $sJsonData;
    }
    /**
     * 
     */
    public function commitLog()
    {
        if($this->bLoggedin != false)
        {
            $oApiLogs = new apiLogs();           
            $oApiLogs->saveLog($this->mRequest,$this->mResponse);
        }
        return true;
    }
    /**
     * 
     */
    public function __destruct() 
    {   
            $this->commitLog();
    }
    
        
  }
                  
 
