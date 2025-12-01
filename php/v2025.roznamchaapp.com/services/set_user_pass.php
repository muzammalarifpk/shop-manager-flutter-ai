<?php
  require_once('dbc.php');
  $source='default';
  $respose=array('code'=>100,'msg'=>'URL Exists.');

//  print_r($_POST);

  $select_qry = "select * from `forget_pass` where `token`='".$_SESSION['forgot_token']."' and `number`='$_SESSION[forgot_user]' and `status`='Published' ";
  $stmt = $db->prepare($select_qry);
  $response = $stmt->execute();
  $user_rows=$stmt->fetch(PDO::FETCH_ASSOC);
  $user_count = $stmt->rowCount();

  if($user_count!==1)
  {
    $respose=array('code'=>201,'msg'=>'Link expired or already used.');
  }else{



    $insert_forget_token_qry = "update `users` set `password`='".md5($_POST['password'])."' where `number`='".$_SESSION['forgot_user']."'";
    //echo $insert_forget_token_qry;
    $insert_stmt=$db->prepare($insert_forget_token_qry);
    $insert_stmt->execute();

    $update_token_qry = "update `forget_pass` set `status`='used' where `token`='$_SESSION[forgot_token]'";
    $update_token=$db->prepare($update_token_qry);
    $update_token->execute();

    if($insert_stmt)
    {
      $respose=array('code'=>200,'msg'=>'Password Updated Successfully.');
    }
    else{
      $respose=array('code'=>203,'msg'=>'Error storing token, contact technical support staff','data'=>$user_rows);
  }

  }


  $respose_json=json_encode($respose);
  print_r($respose_json);
  require_once('close_dbc.php');
?>
