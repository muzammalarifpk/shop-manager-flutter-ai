<?php
session_set_cookie_params(0, '/', '.roznamchaapp.com');
session_start();
$_SESSION["1"] = "LOGGED";

echo 'session is set: ';
echo date("H:i:s");
?>
