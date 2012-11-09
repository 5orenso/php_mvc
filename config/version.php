<?php
define('APP_VERSION','0.0.1');

if (IS_LIVE) {
	define('APP_REVISION',substr('$Revision: 1 $',11,4));

} else {
	$v = shell_exec("git rev-parse HEAD 2>/dev/null");
	$v = trim($v);
	if ($v) {
		define('APP_REVISION', $v);
	} else {
		define('APP_REVISION', 'unknown';
	}

}
