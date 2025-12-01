<?php

require_once("su-contacts.config.php");
require_once("includes/libs/form.cls.php");


$name=$_POST['name'];
$email=$_POST['email'];
$type=$_POST['type'];
$city=$_POST['city'];
$duedate=$_POST['duedate'];
$status=$_POST['status'];
$notes=$_POST['notes'];
$id=$_POST['id'];
$owner_mobile=$_SESSION['sess_bp_username'];
$tags=','.$_POST['tags'].',';


$update_qry="update `contacts` set `status`='$status', `type`='$type', `tags`='$tags', `name`='$name', `email`='$email',  `city`='$city',  `duedate`='$duedate', `notes`='$notes' where `owner_mobile`='$owner_mobile' and `id`='$id'";

$stmt=$db->prepare($update_qry);


try{

  $stmt->execute();

  echo 'success';
}catch(Exception $e){
  echo 'Error.';
}
?>
