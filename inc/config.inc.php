<?php

/**
 * StepIn Solutions venture, an MVC framework
 * configuration  file
 *
 * @package stepOne 
 */
$aConfig['common'] = array(
    'siteUrl' => "http://" . $_SERVER["HTTP_HOST"],
    'rootDir' => '/home/chirag/Web-Projects/matrix',
    'language' => 'en',
    'homeModule' => 'home',
    'homeAction' => 'dashboard',
    'loginModule' => 'users',
    'loginAction' => 'login',
    'dbHost' => 'localhost',
    'dbUser' => 'root',
    'dbPassword' => '',
    'dbName' => 'stepinso_mark_matrix',
    'nPagerLength' => '',
    'nPerPageRecords' => '',
    'sSessionName' => 'userSession',
    'DEVELOPERSTRING' => '!@#123!@#',
    'routerClassName' => 'routers',
    'dtDateTime' => "Y-m-d H:i:s",
);
