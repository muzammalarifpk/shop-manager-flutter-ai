<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-services.config.php");

//print_r($_POST);

$tags_count=count(explode(',',$_POST['tags']));
$_POST['tags']='-,'.$_POST['tags'].',-';


$insert_qry = "insert into `services` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `name`=:name,  `tags`=:tags,  `category`=:category,  `description`=:description,  `sale_price`=:sale_price,  `wholesale_price`=:wholesale_price,  `notes`=:notes";

$stmt = $db->prepare($insert_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $_POST['status']);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('name', $_POST['name']);
$stmt->bindParam('tags', $_POST['tags']);
$stmt->bindParam('category', $_POST['category']);
$stmt->bindParam('description', $_POST['description']);
$stmt->bindParam('sale_price', $_POST['sale_price']);
$stmt->bindParam('wholesale_price', $_POST['wholesale_price']);
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
