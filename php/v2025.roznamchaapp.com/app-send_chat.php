<?php
  require_once('includes/dbc.php');
  $_POST['to_chat']=str_replace('c_','+',$_POST['to_chat']);
  $store_chat_qry = "insert into `chats` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,  `sync`=:sync, `seen_status`=:seen_status , `to_contact`=:to_contact , `chat_msg`=:chat_msg ";

  $stmt = $db->prepare($store_chat_qry);

  $time=time();
  $status='Published';
  $sync='';
  $seen_status='1';
  $to_contact=$_POST['to_chat'];
  $chat_msg=$_POST['chat_msg'];


  $stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
  $stmt->bindParam('timestamp', $time);
  $stmt->bindParam('added_by', $_SESSION['sess_bp_username']);
  $stmt->bindParam('status', $status);
  $stmt->bindParam('last_updated', $time);
  $stmt->bindParam('sync', $sync);
  $stmt->bindParam('seen_status', $seen_status);
  $stmt->bindParam('to_contact', $to_contact);
  $stmt->bindParam('chat_msg', $chat_msg);


  try
  {
    $stmt->execute();
    echo 'saved';
  }
  catch(Exception $e)
  {
    print_r($e);
  }
?>
