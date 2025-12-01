<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("c-change-password.config.php");

function update_password($db,$data)
{
  if($_SESSION['sess_bp_privs']=='*')
  {
    $update_qry="update `users` set `password`=:new_pass , `last_updated`=:last_updated  where `number`=:number and `password`=:old_pass";
  }else{
    $update_qry="update `pos_access` set `password`=:new_pass, `last_updated`=:last_updated  where `number`=:number and `password`=:old_pass";
  }


  $stmt=$db->prepare($update_qry);

  $time=time();
  $stmt->bindParam('new_pass',$data['password']);
  $stmt->bindParam('old_pass',$data['old_pass']);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('number',$_SESSION['sess_bp_emp']);

  try{
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count==1)
    {
      $response['code']=200;
      $response['msg']='Password Changed successfully.';
    }else{
      $response['code']=300;
      $response['msg']='Error Changing Password.';
    }
  }
  catch(Exception $e)
  {
    $response['code']=300;
    $response['msg']=$e->getMessage();
  }

  return json_encode($response);
}

$data['old_pass']=md5($_POST['old_pass']);
$data['password']=md5($_POST['password']);
$data['confirmpassword']=$_POST['confirmpassword'];

if($_SESSION['sess_bp_emp']=='+1-0000')
{

  $response['code']=301;
  $response['msg']=$string['c']['change_password_guest_msg'];
  echo json_encode($response);
}else{
  echo update_password($db,$data);
}
?>
