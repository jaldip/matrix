<?php

class usersController extends siController{

    public $aLayout = array('addedituser' => 'json', 'login' => 'json', 'forgotpassword' => 'json', 'changepassword' => 'json', 'autologin' => 'json','logout' => 'json');

   
        
    public function callAddEditUser() {
        global $aApiResponseCode;
        global $oSession;
        global $oUser;
        $oRestApi = new restApi($_SERVER, $_POST);
        $aUser = $oUser->isLoggedin();
        
        try {
            
                //Edit Profile Code here
            $nUserId = isset($_GET['id_user']) ? $_GET['id_user'] : '';
            $aUserInfo = array();
            if (!empty($nUserId))
            {
                $aUserInfo = $oUser->getUserInfo ($nUserId);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                $nUserId=isset($aUser[0]['id_user']) ? $aUser[0]['id_user'] : '';
                if (!empty($nUserId))
                {
                    $aUserInfo = $oUser->getUserInfo ($nUserId);
                }
                $sUserName = isset($_POST['user_name']) ? $_POST['user_name'] : '';
                $sFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
                $sLastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
                $sPassword = isset($_POST['password']) ? $_POST['password'] : '';
                $sEmail = isset($_POST['email']) ? $_POST['email'] : '';
                $sPhoneNumber = isset($_POST['phone']) ? $_POST['phone'] : '';
                $sAddress = isset($_POST['address']) ? $_POST['address'] : '';
                $sDescription = isset($_POST['description']) ? $_POST['description'] : '';
                $sConfirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
                $sUniquekey = isset($_POST['unique_key']) ? $_POST['unique_key'] : '';
                $aFields = array(
                    array(
                        'field' => 'first_name',
                        'value' => $sFirstName,
                        'validation' => 'required',
                        'message' => __('first_name_required'),
                    ),
                    array(
                        'field' => 'last_name',
                        'value' => $sLastName,
                        'validation' => 'required',
                        'message' => __('last_name_required'),
                    ),
                   array(
                         'field' => 'email',
                         'value' => $sEmail,
                         'validation' => 'unique',
                         'id' => isset($_POST['id_user']) ? trim($_POST['id_user']) : '',
                         'table_field_id' => 'id_user',
                         'table_field_name' => 'email',
                         'table_name' => 'users',
                         'message' => __('Email_address_already_exist!!'),
                                    ),
                );
                //for new user only
                if (empty($nUserId)) 
                {
                    $aFieldsRequired = array
                        (
                            array(
                                'field' => 'user_name',
                                'value' => $sUserName,
                                'validation' => 'required',
                                'message' => __('user_name_required'),
                            ),
                            array
                            (
                                'field' => 'password',
                                'value' => $sPassword,
                                'validation' => 'required',
                                'message' => __('password_required'),
                            ),
                            array
                                (
                                    'field' => 'confirm_password',
                                    'value' => array($sPassword, $sConfirmPassword),
                                    'validation' => 'confirm',
                                    'message' => __('confirm_password_valid')
                                ),
                           array
                                (
                                    'field' => 'password_minimum_length',
                                    'value' => isset($_POST['password']) ? array($_POST['password'], 6) : '',
                                    'validation' => 'minimumlength',
                                    'message' => __('Minimum_6_character_length_required')
                                ),
                           array(
                                    'field' => 'email',
                                    'value' => $sEmail,
                                    'validation' => 'required',
                                    'message' => __('email_required'),
                                ),
                          
                            array(
                                    'field' => 'email',
                                    'value' => $sEmail,
                                    'validation' => 'email',
                                    'message' => __('Invalid_email_address'),
                                )
                                
                        );
                    $aFields = array_merge($aFields, $aFieldsRequired);
                    }
                $bIsValid = $oUser->validateData($aFields);
                if ($bIsValid) {
                    
                    $sImageName = "defaultuserprofile.png";
                    if (isset($_FILES["file_name"])) {
                        $aFile = explode(".", $_FILES["file_name"]["name"]);
                        $sImageName = prepareUniqueName($aFile);
                        $oImage = new image($_FILES);
                        $oImage->uploadAt(getConfig('uploadFilePathUsers') . '/' . $sImageName);
                    }
                    $sSalt = md5($sFirstName . gettimeofday(true));
                    $sPassword = sha1($sSalt . $sPassword);
                    $nActivated = '1';
                    $nDeleted = '0';
                    $aFieldValue = array(
                                        "id_user" => $nUserId,
                                        "user_name" => $sUserName=isset($aUserInfo[0]['user_name'])? $aUserInfo[0]['user_name'] : $_POST['user_name'],
                                        "first_name" => $sFirstName,
                                        "last_name" => $sLastName,
                                        "salt" => $sSalt= isset($aUserInfo[0]['salt'])? $aUserInfo[0]['salt'] : $sSalt,
                                        "password" => $sPassword= isset($aUserInfo[0]['password'])? $aUserInfo[0]['password'] : $sPassword,
                                        "confirm_password" => $sConfirmPassword,
                                        "email" => $sEmail= isset($aUserInfo[0]['email'])? $aUserInfo[0]['email'] : $_POST['email'],
                                        "image" => $sImageName,
                                        "phone" => $sPhoneNumber,
                                        "address" => $sAddress,
                                        "description" => $sDescription,
                                        "activated" => $nActivated,
                                        "deleted" => $nDeleted,
                                    );
                    $nNewUserId = $oUser->addedituser($aFieldValue);
                    $nUserId = !empty($nNewUserId) ? $nNewUserId :$nUserId;
                    $aFields = array(
                        array(
                            'field' => 'login',
                            'aCredentials' => array('user_name', 'password'),
                            'aDataForSession' => array('id_user', 'user_name'),
                            'tableName' => "users",
                            'value' => array($sUserName, $sPassword),
                            'validation' => 'isLoggedin',
                            'message' => 'username_or_password_not_valid'
                        ),
                    );
                    if(empty($nUserId))
                    {
                        $bIsValid = $oUser->validateData($aFields);
                    }
                    else {
                        $bIsValid = $oUser->getUserInfo ($nUserId);
                        
                    }
                        $aUserData = array();
                    
                    if ($bIsValid) {
                        if (isset($bIsValid[0]['id_user'])) {
                            $bIsValid = $oUser->getLoginSession($bIsValid[0]);
                            $aUserInfo = $oUser->getUserInfo($bIsValid[0]['id_user']);
                            
                            $aMessage['id_user'] = $bIsValid[0]['id_user'];
                            $aMessage['first_name'] = $aUserInfo[0]['first_name'];
                            $aMessage['last_name'] = $aUserInfo[0]['last_name'];
                            $aMessage['image'] = getConfig('mediaUrl') . '/uploads/users/'.$aUserInfo[0]['image'];
                        }
                        $aSaveUserSession = array(
                            'verification_key' => $sUniquekey
                        );
                        $oUser->doLogin($bIsValid, $aSaveUserSession);
                        $aUserData = $oUser->isLoggedin();
                        
                    }
                    $aMessage['id_user'] = $bIsValid[0]['id_user'];
                    $aMessage['user_session'] = $aUserData;
                    $aMessage['responseType'] = 'user_registration';
                    $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                } 
                else 
                {
                    if ($oSession->hasError('user_name')) {
                        $aMessage['validation']['user_name'] = $oSession->getError('user_name');
                    }
                    if ($oSession->hasError('first_name')) {
                        $aMessage['validation']['first_name'] = $oSession->getError('first_name');
                    }
                    if ($oSession->hasError('password')) {
                        $aMessage['validation']['password'] = $oSession->getError('password');
                    }
                    if ($oSession->hasError('email')) {
                        $aMessage['validation']['email'] = $oSession->getError('email');
                    }
                    if ($oSession->hasError('confirm_password')) {
                        $aMessage['validation']['confirm_password'] = $oSession->getError('confirm_password');
                    }
                    if ($oSession->hasError('password_minimum_length')) {
                        $aMessage['validation']['password_minimum_length'] = $oSession->getError('password_minimum_length');
                    }

                    $aMessage['responseType'] = 'user_registration';
                    $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                }
                echo $oRestApi->prepareResponse($aMessage);
                exit;
            }
            if(!empty($aUserInfo))
            {
                $aMessage['user_detail'] =  $aUserInfo[0];
                $aMessage['responseType'] = 'user_detail';
                $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                echo $oRestApi->prepareResponse($aMessage);
            }
        } catch (Exception $e) {
            redirect(getConfig('siteUrl') . '/error/404');
        }
    }

    public function callLogin() {
        global $aApiResponseCode;
        global $oSession;
        global $oUser;
        $sTableName = 'users';
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $oRestApi = new restApi($_SERVER, $_POST);
                $sUserName = isset($_POST['user_name']) ? $_POST['user_name'] : '';
                $sPassword = isset($_POST['password']) ? $_POST['password'] : '';
                $sUniqueKey = isset($_POST['unique_key']) ? $_POST['unique_key'] : '';
                $aFields = array(
                    array(
                        'field' => 'login',
                        'aCredentials' => array('email', 'password'),
                        'aDataForSession' => array('id_user', 'user_name','email'),
                        'tableName' => $sTableName,
                        'value' => array($sUserName, $sPassword),
                        'validation' => 'isLoggedin',
                        'message' => __('invalid_username_and_password'),
                    ),
                    array(
                        'field' => 'user_name',
                        'value' => $sUserName,
                        'validation' => 'required',
                        'message' => __('user_name_required'),
                    ),
                    array(
                        'field' => 'password',
                        'value' => $sPassword,
                        'validation' => 'required',
                        'message' => __('password_required')
                    )
                );
                $bIsValid = $oUser->validateData($aFields);
                if ($bIsValid) {
                    if (isset($bIsValid[0]['id_user'])) {
                        
                        $bIsValid = $oUser->getLoginSession($bIsValid[0]);
                        $aUserInfo = $oUser->getUserInfo($bIsValid[0]['id_user']);
                    
                        $aMessage['id_user'] = $bIsValid[0]['id_user'];
                        $aMessage['first_name'] = $aUserInfo[0]['first_name'];
                        $aMessage['last_name'] = $aUserInfo[0]['last_name'];
                        $aMessage['image'] = getConfig('mediaUrl') . '/uploads/users/'.$aUserInfo[0]['image'];
                    }
                    $aSaveUserSession = array(
                        'verification_key' => $sUniqueKey
                    );
                    $oUser->doLogin($bIsValid, $aSaveUserSession);
                    $aUserData = $oUser->isLoggedin();
                    $aMessage['user_session'] = $aUserData;
                    $aMessage['responseType'] = 'user_login';
                    $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                } else {
                    if ($oSession->hasError('login')) {
                        $aMessage['validation']['login'] = $oSession->getError('login');
                    }
                    if ($oSession->hasError('password')) {
                        $aMessage['validation']['password'] = $oSession->getError('password');
                    }
                    if ($oSession->hasError('user_name')) {
                        $aMessage['validation']['user_name'] = $oSession->getError('user_name');
                    }
                    $aMessage['responseType'] = 'user_login';
                    $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                }
            }
            echo $oRestApi->prepareResponse($aMessage);
        } catch (Exception $e) {
            redirect(getConfig('siteUrl') . '/error/404');
        }
    }

    public function callForgotPassword() {
        global $oSession;
        global $aApiResponseCode;
        global $oUser;
        try {
            $sFromEmail = getconfig('adminEmail');
            $sTableName = 'users';
            $oRestApi = new restApi($_SERVER, $_POST);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$sEmail = isset($_POST['email'])? $_POST['email'] : '';
                $sEmail = 'dhaval.stepin@gmail.com';
                $aFields = array(
                    array(
                        'field' => 'email_forgotPassword',
                        'value' => trim($_POST['email']),
                        'validation' => 'required',
                        'message' => __('Email address required')
                    ),
                );
                $bIsValid = $oUser->validateData($aFields);
                $aMessage = array();
                if ($bIsValid) {
                    $aUsers = $oUser->getEmailUserInfo(trim($_POST['email']));
                    if (count($aUsers) > 0) {
                        $nIdUser = $aUsers[0]['id_user'];
                        $sLoginName = $aUsers[0]['user_name'];
                        $sLoginEmail = $aUsers[0]['email'];
                        $sGeneratePassword = generatePassword(10);
                        $salt = md5($sLoginName . gettimeofday(true));
                        $sPassword = sha1($salt . $sGeneratePassword);
                        $aInsertFields = array(
                            'id_user',
                            'salt',
                            'password'
                        );
                        $aInsertValues[] = array(
                            $nIdUser,
                            $salt,
                            $sPassword
                        );
                        $oUser->saveRecords($sTableName, $aInsertFields, $aInsertValues);
                        $sSubject = __('CTRL - ForgotPassword');
                        $mBody = __('Hello ' . $sLoginName . ',<br>
                                     We came to know you have lost your CTRL password. Sorry to know about that.<br>
                                     But do not worry!<br>
                                     We have generated new password for you.<br>
                                     Password : <b>' . $sGeneratePassword . '</b><br><br>
                                     If you still have issues accessing your account, Please do not hesitate to contact us.<br><br>
                                     We strongly recommend that you change this password once you get into your account.<br><br>
                                     <br><br>
                                     Thankz,<br>
                                      Your friends at CTRL Team.');
                        
                       /* $from = $sFromEmail;
                        $to = $sLoginEmail;
                        $headers = 'MIME-Version: 1.0' . "\r\n";
                        $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers.= "From:" . $from . "\r\n";
                        mail($to, $subject, $mBody, $headers);
                        */
                        
                        /*Implement PEAR Mail functionality */
                        require("Mail.php");

                        $mime_boundary=md5(mt_rand()); //------ Main Boundary
                        $alt_boundary=md5(mt_rand()); //------ Alternate Boundary

                        $from = $sFromEmail;
                        $to = $sEmail;
                        $subject = $sSubject;
                        $body = $mBody;

                        $headers = array(
                        'From' => $from,
                        'To' => $to,
                        'Subject' => $subject,
                        'MIME-Version' => "1.0",
                        'Content-Type' => "multipart/mixed;\n boundary=\"".$mime_boundary."\"");

                        $body = "--".$mime_boundary."\r\n" .
                        "Content-Type: multipart/alternative;\n".
                        " boundary=\"".$alt_boundary."\"\n\n".
                        "--".$alt_boundary."\n" .
                        "Content-Type: text/plain; \n" .
                        "Content-Transfer-Encoding: 7bit\r\n" .
                        $sSubject . "\n\n"."--".$alt_boundary."\r\n" .
                        "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
                        "Content-Transfer-Encoding: 7bit\r\n" .
                        $mBody . "\n\n"."--".$alt_boundary."--\r\n";

                        $smtp = Mail::factory('smtp', array(
                                'host' => getConfig('pearMailHost'),
                                'port' => getConfig('pearMailPost'),
                                'auth' => true,
                                'username' => getConfig('pearMailUsername'),
                                'password' => getConfig('pearMailPassword')
                            ));

                        $mail = $smtp->send($to, $headers, $body);
                        var_dump($mail); exit;
                        if (PEAR::isError($mail)) {
                                $sMessage = __($mail->getMessage());
                            } else {
                                $aMessage['responseMessage'] = __('Please check your mail box');
                         }
                        
                        $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                    } else {
                        $aMessage['responseMessage'] = __('Record not found, Please try again');
                        $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                    }
                } else {
                    if ($oSession->hasError('email_forgotPassword')) {
                        $aMessage['responseMessage'] = $oSession->getError('email_forgotPassword');
                    }
                    $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                }
                echo $oRestApi->prepareResponse($aMessage);
            }
        } catch (Exception $e) {
            redirect(getConfig('siteUrl') . '/error/404');
        }
    }

    public function callChangePassword() {
        global $aApiResponseCode;
        global $oSession;
        global $oUser;
        $aUser = $oUser->isLoggedin();
        $sMessage = __('change_password_successfully');
        try {
            $oRestApi = new restApi($_SERVER, $_POST);
            $sCurrentPassword = isset($_POST['current_password']) ? $_POST['current_password'] : '';
            $nUserId = isset($aUser[0]['id_user']) ? $aUser[0]['id_user'] : '';
            if (isset($aUser[0]['id_user']) || !empty($nUserId)) {
                $nUserId = isset($aUser[0]['id_user']) ? $aUser[0]['id_user'] : '';
                $sTableName = 'users';
                $aFields = array
                    (
                    array
                        (
                        'field' => 'current_password',
                        'value' => $sCurrentPassword,
                        'idValue' => $nUserId,
                        'idField' => 'id_user',
                        'tableName' => $sTableName,
                        'validation' => 'currentPassword',
                        'message' => __('Current_password_not_Valid')
                    ),
                    array
                        (
                        'field' => 'new_password',
                        'value' => isset($_POST['new_password']) ? array($_POST['new_password'], 6) : '',
                        'validation' => 'minimumlength',
                        'message' => __('Minimum_6_character_length_required')
                    ),
                    array
                        (
                        'field' => 'new_password',
                        'value' => $_POST['new_password'],
                        'validation' => 'required',
                        'message' => __('new_password_required')
                    ),
                    array
                        (
                        'field' => 'confirm_password',
                        'value' => array($_POST['new_password'], $_POST['confirm_password']),
                        'validation' => 'confirm',
                        'message' => __('confirm_password_not_valid')
                    ),
                    array
                        (
                        'field' => 'confirm_password',
                        'value' => $_POST['confirm_password'],
                        'validation' => 'required',
                        'message' => __('confirm_password_required')
                    )
                );
                $bIsValid = $oUser->validateData($aFields);
                if ($bIsValid) {
                    $aPassword = array(
                        "id_user" => $aUser[0]['id_user'],
                        "new_password" => sha1($bIsValid[0]['salt'] . $_POST['new_password'])
                    );
                    $oUser->changePassword($aPassword);
                    $aMessage = array('responseMessage' => __('Your Password Change Successfully'));
                    $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                } else {
                    if ($oSession->hasError('confirm_password')) {
                        $aMessage['validation']['confirm_password'] = $oSession->getError('confirm_password');
                    }
                    if ($oSession->hasError('current_password')) {
                        $aMessage['validation']['current_password'] = $oSession->getError('current_password');
                    }
                    if ($oSession->hasError('new_password')) {
                        $aMessage['validation']['new_password'] = $oSession->getError('new_password');
                    }
                    if ($oSession->hasError('confirm_password')) {
                        $aMessage['validation']['confirm_password'] = $oSession->getError('confirm_password');
                    }
                    $aMessage['responseType'] = 'changepassword';
                    $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                }
                echo $oRestApi->prepareResponse($aMessage);
            }
        } catch (Exception $e) {
            redirect(getConfig('siteUrl') . '/error/404');
        }
    }

    public function callLogout() {
        global $oUser;
        global $aApiResponseCode;
        try {
            $oRestApi = new restApi($_SERVER, $_POST);
            $oUser->doLogOut();
            $aMessage = array('responseMessage' => __('Logout Successfully'));
            $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
            echo $oRestApi->prepareResponse($aMessage);
            }
        catch (Exception $e) 
            {
                redirect(getConfig('siteUrl') . '/error/404');
            }
    }

    public function callAutoLogin() {
        global $aApiResponseCode;
        global $oSession;
        global $oUser;
        
        try {
            $oRestApi = new restApi($_SERVER, $_POST);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $sVerificationKey = $_POST['unique_key'];
                $aUser = $oUser->getUserSessionFromVerification($sVerificationKey);
                $aMessage = array();
                
                if (count($aUser)) {
                    $bIsValid = $oUser->getLoginSession($aUser[0]);
                    $oSession->setSession(getconfig('sSessionName'), $bIsValid);
                    
                    $aUserInfo = $oUser->getUserInfo($bIsValid[0]['id_user']);
                    
                    $aMessage['id_user'] = $bIsValid[0]['id_user'];
                    $aMessage['first_name'] = $aUserInfo[0]['first_name'];
                    $aMessage['last_name'] = $aUserInfo[0]['last_name'];
                    $aMessage['image'] = getConfig('mediaUrl') . '/uploads/users/'.$aUserInfo[0]['image'];
                    $aMessage['responseMessage'] = __('Login_Successful');
                    $aMessage['responseCode'] = $aApiResponseCode['SUCCESS'];
                } else {
                    $aMessage['responseMessage'] = __('verification_key_not_vaild');
                    $aMessage['responseCode'] = $aApiResponseCode['ERROR'];
                }
                echo $oRestApi->prepareResponse($aMessage);
            }
        } catch (Exception $e) {
            redirect(getConfig('siteUrl') . '/error/404');
        }
    }
}