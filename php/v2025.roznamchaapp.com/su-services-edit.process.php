<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-services.config.php");

//print_r($_POST);

$tags_count=count(explode(',',$_POST['tags']));
$_POST['tags']='-,'.$_POST['tags'].',-';
$id=$_POST['reqid'];

$sync = '0';

$update_qry = "update `services` set `name`='$_POST[name]', `tags`='$_POST[tags]', `sync`='$sync', `category`='$_POST[category]', `description`='$_POST[description]' , `sale_price`='$_POST[sale_price]' , `wholesale_price`='$_POST[wholesale_price]' , `notes`='$_POST[notes]' where  `owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$id'";

$stmt = $db->prepare($update_qry);

  $response['code'] = 100;
  $response['msg'] = 'There was some issue processing request. Please contact technical support.';

try
{
  $stmt->execute();
  $job_id=$db->lastInsertId();
  $response['code'] = 200;
  $response['msg'] = $job_id;

} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode($response));
?>
