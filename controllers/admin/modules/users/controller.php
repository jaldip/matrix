<?php
/**
 *
 * @package RTS
 */
class usersController 
{
    public $aLayout = array('login' => 'login','logout'=>false,'changepassword' => 'login');
    public $aLoginRequired = array('login' => false,'logout'=>true,'changepassword' => true);
    
    public function __construct() 
    {
        global $sAction;
        global $oUser;
        global $oSession;
        
        if($this->aLoginRequired[$sAction])
        {                   
            if(!$oUser->isLoggedin())
            {  
                unset($_SESSION);
                redirect(getConfig('siteUrl').'/'.getConfig('loginModule').'/'.getConfig('loginAction'));
            }
      }
    }
    public function callLogin()
    {
        global $oSession;
        global $oUser;
        
        $sMessage =__('user_logged_in_successfully');
        $sTableName = 'admins';
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $sLoginName = $_POST['login_name'];
            $aFields = array
                           (   
                                array 
                                    (
                                        'field'=>'login_name',
                                        'value'=>$_POST['login_name'],
                                        'validation'=>'required',
                                        'message'=>__('login_name_required')
                                    ),
                                array 
                                    (
                                        'field'=>'password',
                                        'value'=>$_POST['password'],
                                        'validation'=>'required',
                                        'message'=>__('password_required')
                                    ),
                                array 
                                    (
                                        'field'=>'invalid_login',
                                        'aCredentials'=>array('login_name','password'),
                                        'aDataForSession'=>  array('id_admin','login_name'),
                                        'tableName'=>$sTableName,
                                        'value'=>array($_POST['login_name'],$_POST['password']),
                                        'validation'=>'isLoggedin',
                                        'message'=>__('username_or_password_is_not_valid')
                                    )
                          );

            $bIsValid = $oUser->validateData($aFields);
            if($bIsValid)
            {         
                 $oUser->doLogin($bIsValid);
                 $oUser->isLoggedin();
                 $oSession->setSession('sDisplayMessage',$sMessage);
                 $oSession->setSession('sDisplayName', $bIsValid[0]['login_name']);
                 redirect(getConfig('siteUrl').'/'.getConfig('homeModule').'/'.getConfig('homeAction'));
             }
        }
        if($oUser->isLoggedin())
        {
            redirect(getConfig('siteUrl').'/'.getConfig('homeModule').'/'.getConfig('homeAction'));
        }
        else
            require 'login.tpl.php';
    }
    
    public function callLogOut()
    {   
        global $oUser;

        $oUser->doLogOut();
        unset($oUser);
        unset($_SESSION);
        redirect(getConfig('siteUrl').'/users/login');
    }
    
    public function callChangePassword()
    {
        global $oSession;
        global $oUser;
        $aUser = $oUser->isLoggedin();
        
        if(isset($_POST['submit']))
        {   
            $nUserId = isset($aUser[0]['id_admin']) ?  $aUser[0]['id_admin'] : '';
            $sTableName = "admins";

            $sNewPassword = isset($_POST ['new_password'])? $_POST ['new_password'] : '';
            $sConfirmPassword = isset($_POST ['confirm_password'])?$_POST ['confirm_password']:'';

            $aFields = array(
                            array(
                                    'field'=>'current_password',
                                    'value'=> $_POST['current_password'],
                                    'idValue'=> $nUserId,
                                    'idField'=> 'id_admin',
                                    'tableName'=> $sTableName,
                                    'validation'=>'currentPassword',
                                    'message'=>__('current_password_not_valid')
                            ),
                            array (
                                    'field'=>'current_password',
                                    'value'=>$_POST['current_password'],
                                    'validation'=>'required',
                                    'message'=>__('current_password_required')
                            ),  
                            array (
                                    'field'=>'new_password',
                                    'value'=>isset($_POST['new_password']) ? array($_POST['new_password'],6) : '',
                                    'validation'=>'minimumlength',
                                    'message'=>__('minimum_6_character_length_required')
                                 ), 
                           array (
                                    'field'=>'new_password',
                                    'value'=>$_POST['new_password'],
                                    'validation'=>'required',
                                    'message'=>__('new_password_required')
                            ),
                            array (
                                    'field'=>'confirm_password',
                                    'value'=>array($_POST['new_password'],$_POST['confirm_password']),
                                    'validation'=>'confirm',
                                    'message'=>__('confirm_password_not_valid')
                            ),
                            array (
                                    'field'=>'confirm_password',
                                    'value'=>$_POST['confirm_password'],
                                    'validation'=>'required',
                                    'message'=>__('confirm_password_required')
                            )
                 );
  
            $bIsValid = $oUser->validateData($aFields);
            
            if($bIsValid)
            {
                $aFields = isset ($aUser[0]['login_name']) ? array('id_admin','password') : array('id_user','password');
                $aPrepareData = array(
                                    array(
                                        $nUserId,
                                        sha1($bIsValid[0]['salt'].$sNewPassword)
                                     )
                                );

                $oUser->saveRecords($sTableName,$aFields,$aPrepareData);

                $sMessage = __('password_changed_successfully');
                $oSession->setSession('sDisplayMessage',$sMessage);
                redirect(getConfig('siteUrl').'/users/login');
            }
            else
            {
                $sMessage = __('password_not_changed');
                $oSession->setSession('sDisplayMessage',$sMessage);
                redirect(getConfig('siteUrl').'/users/changepassword');
            }

      }
      require("changePassword.tpl.php");
    }
    public function callForgotPassword()
    {   
         global $sAction;
         global $oUser;
         global $oSession;

         $sEmail = isset($_POST['email'])? $_POST['email'] : '';
         
         if ($_SERVER['REQUEST_METHOD'] == 'POST') 
         {
             $aFields = array(
                             array(
                                 'field' => 'email_forgotPassword',
                                 'value' => trim($sEmail),
                                 'validation' => 'required',
                                 'message' => __('email_required')
                             )
                         );
             $bIsValid = $oUser->validateData($aFields);
             if ($bIsValid) {
                 $aAdmins = $oUser->getAdminEmailInfo(trim($sEmail));
                 if (count($aAdmins) > 0) {

                     $sTableName = 'admins';
                     $nIdUser = $aAdmins[0]['id_admin'];
                     $sFirstName = $aAdmins[0]['first_name'];
                     $sLastName = $aAdmins[0]['last_name'];
                     $sEmail = $aAdmins[0]['email'];
                     $sGeneratePassword = getRandomPassword();
                     $salt = md5($sFirstName . gettimeofday(true));
                     $sPassword = sha1($salt . $sGeneratePassword);
                     $aInsertFields = array(
                                             'id_admin',
                                             'salt',
                                             'password'
                                         );
                     $aInsertValues[] = array(
                                               $nIdUser,
                                               $salt,
                                               $sPassword
                                         );
                     $oUser->saveRecords($sTableName, $aInsertFields, $aInsertValues);
                     $sSubject = 'Forgot Password';
                     $sUserName = $sFirstName.' '.$sLastName;

                     $headers = "From: " .  __('rts') . "\r\n";
                     $headers .= "MIME-Version: 1.0\r\n";
                     $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                     $mBody = 'user_name '.$sUserName.' user_email_id '.$sEmail.' new_password '.$sGeneratePassword;
                     mail($sEmail, $sSubject, $mBody);
                     $sMessage = __('please_check_your_mail_box');
                     $oSession->setSession('sDisplayMessage',$sMessage);
                     redirect(getConfig('siteUrl').'/'.getConfig('loginModule').'/'.getConfig('loginAction'));
                 } 
                 else 
                 {
                     $sMessage = __('email_addres_doesnot_exists');
                     $oSession->setSession('sDisplayMessage',$sMessage);
                 }
             }
         }
         require("forgotpassword.tpl.php");
    }
}
