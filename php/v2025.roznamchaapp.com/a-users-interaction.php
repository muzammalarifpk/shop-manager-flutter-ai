<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("a-users.config.php");

  $sql = "insert into `user_interaction` set `user_id`=:user_id, `timestamp`=:timestamp, `comment`=:comment ";
  //echo $sql;

  $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  try{


  $sth->execute(array(':user_id' => $_POST['id'], ':comment' => $_POST['comment'], ':timestamp' => time()));

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
