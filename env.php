<?php

$env = array();
//getenv(varname)

//echo '<h2>_ENV</h2>';
$ENV['_ENV'] = array();
while (list($key, $val) = each($_ENV)) {
    $env['_ENV'][$key] = $val;
}
$ENV['_REQUEST'] = array();
while (list($key, $val) = each($_REQUEST)) {
    $env['_REQUEST'][$key] = $val;
}
$ENV['_GET'] = array();
while (list($key, $val) = each($_GET)) {
    $env['_GET'][$key] = $val;
}
$ENV['_POST'] = array();
while (list($key, $val) = each($_POST)) {
    $env['_POST'][$key] = $val;
}
$ENV['_SERVER'] = array();
while (list($key, $val) = each($_SERVER)) {
    $env['_SERVER'][$key] = $val;
}
$ENV['_FILES'] = array();
while (list($key, $val) = each($_FILES)) {
    $env['_FILES'][$key] = $val;
}
$ENV['_SESSION'] = array();
while (list($key, $val) = each($_SESSION)) {
    $env['_SESSION'][$key] = $val;
}
$ENV['http_response_header'] = array();
while (list($key, $val) = each($http_response_header)) {
    $env['http_response_header'][$key] = $val;
}

// echo '<h2>_POST</h2>';
// while (list($key, $val) = each($_POST)) {
//     print $key.' = '.$val."<br>\n";
// }
// echo '<h2>_SERVER</h2>';
// while (list($key, $val) = each($_SERVER)) {
//     print $key.' = '.$val."<br>\n";
// }
// echo '<h2>_FILES</h2>';
// while (list($key, $val) = each($_FILES)) {
//     print $key.' = '.$val."<br>\n";
// }
// echo '<h2>_SESSION</h2>';
// while (list($key, $val) = each($_SESSION)) {
//     print $key.' = '.$val."<br>\n";
// }
// echo '<h2>http_response_header</h2>';
// while (list($key, $val) = each($http_response_header)) {
//     print $key.' = '.$val."<br>\n";
// }


echo json_encode($env);

?>
