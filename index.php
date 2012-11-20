<?php
/**
 * Define document paths
 */
define('SERVER_ROOT', __DIR__);
define('SITE_ROOT',   'http://dev.zu.no');
define('START_TIME',  microtime(TRUE));

ini_set('display_errors', 0);

/**
 * Fetch the router
 */
require_once(SERVER_ROOT . '/controller/' . 'router.php');

