<?php
session_set_cookie_params(0, '/', '.roznamchaapp.com');
session_start();

print_r($_SESSION);


echo $_SESSION["1"];

echo '<br />';
echo 'session is set: ';
echo date("H:i:s");
?>
