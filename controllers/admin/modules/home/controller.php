<?php

/**
 * StepIn Solutions venture
 *
 *
 * @package stepOne
 */
class homeController {

    public $aLayout = array('dashboard' => 'main');
    public $aLoginRequired = array('dashboard' => true);

    public function __construct() {
        global $sAction;
        global $oUser;

        //Login Is Required
        if ($this->aLoginRequired[$sAction]) {
            if (!$oUser->isLoggedin()) {
                redirect(getConfig('siteUrl') . '/users/login');
            }
        }
    }

    /* Last Modified on 13-01-18 */

    public function callDashboard() {
        global $sAction;
        global $oUser, $oSession;
        require("dashboard.tpl.php");
    }

    