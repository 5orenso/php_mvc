<?php
define('APP_VERSION','2.6.0');
if (_CORE_IS_LIVE) {
    define('APP_REVISION',substr('$Revision: 3908 $',11,4));
} else {
    // Try SVN version
    $v = shell_exec("(svn info | grep Revision | cut -d' ' -f 2) 2>/dev/null");
    $v = trim($v);
    if (is_numeric($v)) {
        define('APP_REVISION', $v);
    } else {
        // git-svn/git?
        $v = shell_exec("git rev-parse HEAD 2>/dev/null");
        $v = trim($v);
        if ($v) {
            define('APP_REVISION', $v);
        } else {
            // I've no clue
            define('APP_REVISION', time());
        }
    }
}
