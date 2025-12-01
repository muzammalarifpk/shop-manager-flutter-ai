<?php
  require_once('includes/dbc.php');
  $_POST['to_chat']=str_replace('c_','+',$_POST['to_chat']);
  try
  {

    $load_chat="select count(*) as msg_count,owner_mobile as to_contact from `chats` where  (`to_contact`='$_SESSION[sess_bp_username]' and `seen_status` < 2 ) group by `owner_mobile` order by `id` asc";
    $chat_row=array();
    foreach ($db->query($load_chat) as $row)
    {
      $chat_row[]=array('to_contact'=>str_replace('+','c_',$row['to_contact']),'count'=>$row['msg_count']);
    }
    echo json_encode($chat_row);

  }
  catch(Exception $e)
  {
    print_r($e);
  }
?>
