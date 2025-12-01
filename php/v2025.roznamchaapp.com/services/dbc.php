<?php
  require_once('../config.php');
  require_once('../includes/libs/func.class.php');

  try {
    $db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8mb4', $db_user , $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
  }

?>
