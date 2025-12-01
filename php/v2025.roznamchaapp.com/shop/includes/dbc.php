<?php
  require_once('../config.php');
  require_once('../includes/libs/func.class.php');

  require_once('../includes/lang/en.php');
//  require_once('includes/lang/ur.php');

  try {
    $db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8mb4', $db_user , $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $db_off = new PDO('mysql:host='.$db_host.';dbname='.$db_name_off.';charset=utf8mb4', $db_user , $db_pass);
    $db_off->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_off->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
  }
?>
