<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("va-jobs.config.php");

//print_r($_POST);

$tags_count=count(explode(',',$_POST['tags']));
$_POST['tags']='-,'.$_POST['tags'].',-';


$insert_qry = "insert into `locations` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `name`=:name,  `type`=:type,  `description`=:description,  `tags`=:tags,  `notes`=:notes";

$stmt = $db->prepare($insert_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $_POST['status']);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('name', $_POST['name']);
$stmt->bindParam('type', $_POST['type']);
$stmt->bindParam('description', $_POST['description']);
$stmt->bindParam('tags', $_POST['tags']);
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
