<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-todo.config.php");

//print_r($_POST);

$id=$_POST['reqid'];



$update_qry = "update `todo` set `job`='$_POST[job]', `date`='$_POST[date]', `customer`='$_POST[customer]', `item_name`='$_POST[item_name]', `uom`='$_POST[uom]', `qty`='$_POST[qty]', `brand`='$_POST[brand]', `priority`='$_POST[priority]', `notes`='$_POST[notes]' where  `owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$id'";

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
