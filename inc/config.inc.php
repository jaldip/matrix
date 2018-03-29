<?php

/**
 * StepIn Solutions venture, an MVC framework
 * configuration  file
 *
 * @package stepOne 
 */
$aConfig['common'] = array(
    'siteUrl' => "http://" . $_SERVER["HTTP_HOST"],
    'rootDir' => '/home/stepinso/projects/mark_matrix/matrix',
    'language' => 'en',
    'homeModule' => 'home',
    'homeAction' => 'dashboard',
    'loginModule' => 'users',
    'loginAction' => 'login',
    'dbHost' => 'localhost',
    'dbUser' => 'stepinso_mark',
    'dbPassword' => '$!matrix$!',
    'dbName' => 'stepinso_mark_matrix',
    'nPagerLength' => '',
    'nPerPageRecords' => '',
    'sSessionName' => 'userSession',
    'DEVELOPERSTRING' => '!@#123!@#',
    'routerClassName' => 'routers',
    'dtDateTime' => "Y-m-d H:i:s",
);
