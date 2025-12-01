<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-todo.config.php");

//print_r($_POST);


$insert_qry = "insert into `todo` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `job`=:job,  `date`=:date,  `customer`=:customer,  `item_name`=:item_name,  `uom`=:uom, `qty`=:qty, `brand`=:brand, `priority`=:priority, `notes`=:notes ";

$stmt = $db->prepare($insert_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $_POST['status']);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('job', $_POST['job']);
$stmt->bindParam('date', $_POST['date']);
$stmt->bindParam('customer', $_POST['customer']);
$stmt->bindParam('item_name', $_POST['item_name']);
$stmt->bindParam('uom', $_POST['uom']);
$stmt->bindParam('brand', $_POST['brand']);
$stmt->bindParam('qty', $_POST['qty']);
$stmt->bindParam('priority', $_POST['priority']);
$stmt->bindParam('notes', $_POST['notes']);

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
