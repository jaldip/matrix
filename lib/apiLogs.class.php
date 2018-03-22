<?php
 /**
  * StepIn Solutions venture
  * 
  *
  * @package stepone
  */
  class apiLogs extends siCommon
  {     
      
      //Constructer
  	public function __construct()
	{
            $sDbHost = getConfig('dbHost');
            $sDbUser = getConfig('dbUser');
            $sDbPassword = getConfig('dbPassword');
            $sDbName = getConfig('dbName');
            parent::__construct($sDbHost,$sDbUser,$sDbPassword,$sDbName);
	}
        /**
         *
         * @param type $aRequestParam
         * @param type $aResponseParam 
         */
        public function saveLog($aRequestParam,$aResponseParam)
        {
            $sRequestParam = json_encode($aRequestParam);
            $sResponseParam = json_encode($aResponseParam);
            
            $sTableName = 'api_logs';
            $dCreatedAt = date("Y-m-d H:i:s");

            $aInsertFieldArray = array
                                     ( 
                                        'request_parameter',
                                        'response_parameter',
                                        'created_at',
                                        'updated_at'
                                     );
            $aInsertValueArray =array
                                    (
                                        array
                                             ( 
                                               $sRequestParam,
                                               $sResponseParam,
                                               $dCreatedAt,
                                               $dCreatedAt
                                             )
                                    );
                         
            $this->saveRecords($sTableName,$aInsertFieldArray,$aInsertValueArray);
        }
        
  }
                  
 
