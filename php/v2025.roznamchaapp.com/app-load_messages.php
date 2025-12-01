<?php
  require_once('includes/dbc.php');
  $_POST['to_chat']=str_replace('c_','+',$_POST['to_chat']);
  try
  {

    $load_chat="select * from `chats` where  `to_contact`='$_SESSION[sess_bp_username]' and `owner_mobile`='$_POST[to_chat]' and `seen_status` < 2 order by `id` asc";
    $chat_row='';
    foreach ($db->query($load_chat) as $row)
    {
      if($_SESSION['sess_bp_username']==$row['owner_mobile'])
      {
        $class_reverse=' class="reverse"';
      }else{
        $class_reverse='';
      }
      $chat_row.='<li'.$class_reverse.'><div class="chat-content"><div class="box bg-light-inverse">'.$row['chat_msg'].'</div></div><div class="chat-time">'.date('Y-m-d',$row['timestamp']).'<br />'.date('H:i',$row['timestamp']).'</div></li>';
    }
    echo $chat_row;
    $time=time();
    $update_chat_qry = "update `chats` set `seen_status` = :new_seen, `last_updated`=:last_updated where `to_contact`=:to_contact and `owner_mobile`=:owner_mobile and `seen_status` < 2 ";

    $stmt = $db->prepare($update_chat_qry);

    $seen_status = 2;

    $stmt->bindParam('new_seen', $seen_status);
    $stmt->bindParam('last_updated', $time);
    $stmt->bindParam('to_contact', $_SESSION['sess_bp_username']);
    $stmt->bindParam('owner_mobile', $_POST['to_chat']);

    $stmt->execute();


  }
  catch(Exception $e)
  {
    print_r($e);
  }
?>
