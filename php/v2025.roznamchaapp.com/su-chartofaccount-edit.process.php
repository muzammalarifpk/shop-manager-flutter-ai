<?php

require_once("su-chartofaccount.config.php");
require_once("includes/libs/form.cls.php");


$account_head=$_POST['account_head'];
$status=$_POST['status'];
$notes=$_POST['notes'];
$id=$_POST['id'];
$owner_mobile=$_SESSION['sess_bp_username'];


$update_qry="update `chartofaccount` set `status`='$status', `account_head`='$account_head',  `notes`='$notes' where `owner_mobile`='$owner_mobile' and `id`='$id'";

$stmt=$db->prepare($update_qry);


try{

$stmt->execute();

echo 'success';
}catch(Exception $e){
  echo 'Error.';
}
?>
