<?php

require_once('includes/dbc.php');

//  print_r($_REQUEST);


  $sql = "update `company-admin` set `status`=:newstatus, `last_updated`=:time
      WHERE `id`=:reqid ";
  $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $sth->execute(array(':newstatus' => 'trashed', ':time' => time(), 'reqid'=>$_GET['reqid']));

  if($sth)
  {
    echo 'success';
  }else{
    echo 'error';
  }
?>
