<?php
//config/database.php
require_once('../config.php');
return [

    'development' => [
        'type' => 'mysql',
        'host' => $db_host,
        'port' => '3306',
        'user' => $db_user,
        'pass' => $db_pass,
        'database' => $db_name,
        'singleTransaction' => false
    ],
    'production' => [
        'type' => 'mysql',
        'host' => $db_host,
        'port' => '3306',
        'user' => $db_user,
        'pass' => $db_pass,
        'database' => $db_name,
    ],
]
?>
