<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("va-jobs.config.php");

//print_r($_POST);

$tags_count=count(explode(',',$_POST['tags']));
$_POST['tags']='-,'.$_POST['tags'].',-';
$id=$_POST['reqid'];


$update_qry = "update `locations` set `name`='$_POST[name]', `type`='$_POST[type]', `description`='$_POST[description]', `notes`='$_POST[notes]' where  `owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$id'";

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
