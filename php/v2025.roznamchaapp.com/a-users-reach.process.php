<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("a-users.config.php");

  if($_POST['app_db']=='offline_app')
  {
    $app_db_name = 'bp_backend_admin';
    try {
      $app_db = new PDO('mysql:host='.$db_host.';dbname='.$app_db_name.';charset=utf8mb4', $db_user , $db_pass);
      $app_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $app_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      echo "Connection failed : ". $e->getMessage();
    }

    $sql = "update `Users` set `reach_counter`= '$_POST[msg_id]'   WHERE `id`='$_POST[user_id]' ";
  //  echo $sql;
    $sth = $app_db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  }else{
    $sql = "update `users` set `reach_counter`= '$_POST[msg_id]'   WHERE `id`='$_POST[user_id]' ";
  //  echo $sql;
    $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  }
try{


  $sth->execute();

  if($sth)
  {
    echo 'success';
  }else{
    echo 'error';
  }

}catch(PDOException $e)
{
  print_r($e);
}

?>
