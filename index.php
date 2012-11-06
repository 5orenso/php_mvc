<?php
/**
 * Define document paths
 */
define('SERVER_ROOT' , '/var/www/project/test/mvc');
define('SITE_ROOT' , 'http://dev.zu.no');
define('START_TIME', microtime(TRUE));

/**
 * Fetch the router
 */
require_once(SERVER_ROOT . '/controller/' . 'router.php');

