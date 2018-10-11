<?php

/**
 * StepIn Solutions venture, an MVC framework
 * configuration  file
 *
 * @package stepOne 
 */
$aConfig['common'] = array(
    'siteUrl' => "http://" . $_SERVER["HTTP_HOST"],
    'rootDir' => '/home/lm/public_html/matrix',
    'language' => 'en',
    'homeModule' => 'home',
    'homeAction' => 'dashboard',
    'loginModule' => 'users',
    'loginAction' => 'login',
    'dbHost' => 'localhost',
    'dbUser' => 'lm_matrixuser',
    'dbPassword' => 'lopMatrix123!@#',
    'dbName' => 'lm_matrix',
    'nPagerLength' => '',
    'nPerPageRecords' => '',
    'sSessionName' => 'userSession',
    'DEVELOPERSTRING' => '!@#123!@#',
    'routerClassName' => 'routers',
    'dtDateTime' => "Y-m-d H:i:s",
);
