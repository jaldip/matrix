<?php
/**
 * Description of routes
 *
 * @author <jaimin.stepin@gmail.com>
 */
class routers extends siCommon
{
    //Domain name
    protected $sDomainName;
    //Module || Action || Slug
    protected $aParams;
    
    /**
     * __construct
     * connetct parent class with mysql
     */
    public function __construct() 
    {
        $sDbHost = getconfig('dbHost');
        $sDbUser = getconfig('dbUser');
        $sDbPassword = getconfig('dbPassword');
        $sDbName = getconfig('dbName');
        parent::__construct($sDbHost, $sDbUser, $sDbPassword, $sDbName);
        $sRequestURL = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $aRequestURL = explode('?', $sRequestURL);
        $this->sDomainName = $_SERVER['SERVER_NAME'];
        $this->aParams = getParamsFromUrl($aRequestURL[0]);
        global $bIsPreview;
        $bIsPreview = FALSE;
        //To get first part of domain name explode sDomainName
        $aDomainName = explode(".",$this->sDomainName);
        //If preview site then set $bIsPreview to TRUE and made sDomainName again by removing preview from the URL
        if($aDomainName[0] == 'preview')
        {
            $bIsPreview = TRUE;
            $aReverseDomainName = array_reverse($aDomainName);
            array_pop($aReverseDomainName);
            $this->sDomainName = implode('.',array_reverse($aReverseDomainName));
        }
    }
   
    /**
     * 
     */
    public function mapSlug()
    {
        $aModuleAction = array();
        if(getConfig('checkSlug'))
        {
            // Check from database
            $aSlugsData = $this->getSlugFromDB($this->aParams[0]);
            if(count($aSlugsData)) 
            {
                $_GET['id_page'] = $aSlugsData[0]['id_page'];
                return $aModuleAction=array(
                                            'module'=>$aSlugsData[0]['module'],
                                            'action'=>$aSlugsData[0]['action']
                                            );
            }
            else 
            {
                // Check from routing file
                $aModuleAction = $this->getSlugFromFile($this->aParams[0]);
                //jo slug hoy to slug nahi to module action set karva mate if else banavi padse
                if(count($aModuleAction)) 
                {
                    //get parametar set
                    $_GET[] = isset($this->aParams[1]) ? $this->aParams[1] : '';
                    return $aModuleAction;
                }
                else 
                {
                    //jo first parameter slug pachi koi button per click kare to module action set karva mate aa function call karavu padse
                    //return $this->setModuleActionWithParameter();
                    return $this->generatePageNotFound();
                }
            }
        }
        else 
        {
            return $this->setDefaultModuleAction();
        }

    } 
    
    public function setDefaultModuleAction()
    {
        //Set get parameter      
        //Remove because getParamsFromUrl aa function ma eno code karelo chhe        
        $_GET[] = isset($this->aParams[2]) ? $this->aParams[2] : '';        
        //$this->setGetParameter($sGetParams);        
        return $aModuleAction = array(
                                    'module' => isset($this->aParams[0]) ? $this->aParams[0] : getConfig('homeModule'),
                                    'action' => isset($this->aParams[1]) ? $this->aParams[1] : getConfig('homeAction')
                            );
        
    }
    /**
     * setGetParameter to set get parameter into URL remove this function 
     * @param type $sGetParams
     */
    public function setGetParameter($sGetParams)
    {
        $oGetObject = empty($sGetParams) ?  array() : explode("&",$sGetParams);
        if(count($oGetObject))
        {    
            foreach($oGetObject as $sGet)
            {
                  $aGet = explode("=",$sGet);
                  //http://abc.com/jaimin/ajsdkfjaskfd/asdfasdf aavi url aave tyare notice aave chhe mate isset karvu padiyu chhe
                  $_GET[$aGet[0]] = isset($aGet[1]) ? $aGet[1] : '';
            }
        }
    }        
    
    /**
     * 
     */
    public function getSlugFromDB($sSlugName,$nIdSite='',$aLimit=array(), $aGroupBy=array(), $aSearch=array(), $aSort=array(), $sMode='')
    {
        $sRightJoin = '';
        if(empty($sSlugName)) return array();
        //Check into database slug is exist or not        
        $sAndWhere = " 1 = 1 ";        
        $sAndWhere .= " AND sg.slug_name = '$sSlugName' ";
        if(strlen($nIdSite)>0) 
        {    
            $sAndWhere .= " AND sg.id_site = $nIdSite ";
        }
        else
        {
            $sRightJoin = " RIGHT JOIN
                                domains d
                            ON
                                sg.id_domain = d.id_domain AND d.domain_name='".$this->sDomainName."'
                            AND sg.id_site = 0 ";
        }    
        $sQuery = "SELECT
                         sg.id_domain AS id_domain,
                         sg.id_slug AS id_slug,
                         sg.id_page AS id_page,
                         sg.module AS module,
                         sg.action AS action                         
                  FROM
                         slugs sg
                         
                  $sRightJoin   
                      
                  WHERE
                        " . $sAndWhere;
        $aLimit[] = array( ' LIMIT 1');
        $aSlugHandler = $this->getList($sQuery, $aLimit, $aGroupBy, $aSearch, $aSort, $sMode);
        return $this->getData($aSlugHandler,'ARRAY'); 
    }        
    /**
     * 
     */
    public function getSlugFromFile($sSlugName)
    {
        global $sAppName,$aRouteUrl;
	require(getConfig('rootDir')."/controllers/".$sAppName."/config/routing.inc.php");
        
        return $aModuleAction = isset($aRouteUrl[$sAppName][$sSlugName]) ? $aRouteUrl[$sAppName][$sSlugName] : array();
    }   
    
    /**
     * mail sent into error module and action
     * database entry into error module and action
     */
    public function generatePageNotFound()
    {     
      return $aModuleAction = array(
                                    'module' => getConfig('homeModule'),
                                    'action' => getConfig('homeAction')
                            );
 
    }
}

?>
