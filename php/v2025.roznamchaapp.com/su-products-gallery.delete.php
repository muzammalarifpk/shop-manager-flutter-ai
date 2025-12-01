<?php

require_once('includes/dbc.php');
require_once("su-products.config.php");

//  print_r($_REQUEST);

$select_images_qry = "select * from `gallery` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='products' and `id`='$_GET[file_id]' and `status`='Published' order by `id` asc";
$images_array=array();
foreach ($db->query($select_images_qry) as $row) {
  $images_array[]=array('img_id'=>$row['id'],'file_path' => $row['file_path'], 'file_name'=>$row['file_name'], 'uploaddate'=>date("d-M-Y",$row['timestamp']),'filetype'=> $row['file_type']);

  if(file_exists($row['file_path'])){
    unlink($row['file_path']);
  }else{
    echo 'file not found';
    die();
  }
}


  $sql = "update `gallery` set `status`=:newstatus, `last_updated`=:time
      WHERE `id`=:reqid and `owner_mobile`=:owner_mobile";
  $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $sth->execute(array(':newstatus' => 'trashed', ':time' => time(), 'reqid'=>$_GET['file_id'], 'owner_mobile'=>$_SESSION['sess_bp_username']));

  if($sth)
  {
    $response['code'] = 200;
    $response['msg'] = 'File deleted successfully.';
  }else{
    $response['code'] = 300;
    $response['msg'] = 'Error Deleted file.';
  }
  print_r(json_encode($response));

?>
