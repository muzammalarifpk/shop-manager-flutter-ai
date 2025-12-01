<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("a-users.config.php");

//  print_r($_REQUEST);


  $sql = "update `users` set `business_name`=:business_name, `status`=:status, `type`=:type, `date`=:date
      WHERE `id`=:reqid ";
  //echo $sql;

  $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  try{


  $sth->execute(array(':business_name' => $_POST['name'], ':status' => $_POST['status'], ':type' => $_POST['type'], ':date' => $_POST['date'], 'reqid'=>$_POST['id']));

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
