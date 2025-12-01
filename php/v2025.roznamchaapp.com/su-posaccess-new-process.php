<?php
require_once("includes/dbc.php");
require_once("su-posaccess.config.php");

$JSON = file_get_contents('php://input');
$JSON1 = stripslashes($JSON);
$JSON2 = json_decode($JSON1,true);

$response['code']=100;
$response['msg']='Invalid Json';

if(isJson($JSON1))
{
  $response['code']=100;
  $response['msg']='Invalid Request';
}else{


  $data['number']=$_POST['number'];
  $data['password']=md5($_POST['password']);
  $data['status']=$_POST['status'];
  $data['notes']=$_POST['notes'];

  $privs='-,';
  foreach ($_POST['privs'] as $key => $value) {
    $privs.=$value.',';
  }
  $privs.='-';

  $data['privs']=$privs;

  $select_old_token_qry="select count(*) from `pos_access` where `owner_mobile` = ? and `number`= ?";
  $owner_mobile=$_SESSION['sess_bp_username'];
  $stmt = $db->prepare($select_old_token_qry);
  $stmt->execute([$owner_mobile,$data['number']]);
  $count = $stmt->fetchColumn();

  if(intval($count)!==0)
  {
    $response['code']=301;
    $response['msg']='Access for this employee already exist. ';
  }else{

    $insert_qry="insert into `pos_access` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp, `password`=:password,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `notes`=:notes, `number`=:number, `privs`=:privs ";

    $stmt = $db->prepare($insert_qry);
    $time=time();

    $stmt->bindParam('owner_mobile', $owner_mobile);
    $stmt->bindParam('timestamp', $time);
    $stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
    $stmt->bindParam('status', $data['status']);
    $stmt->bindParam('last_updated', $time);
    $stmt->bindParam('privs', $data['privs']);
    $stmt->bindParam('number', $data['number']);
    $stmt->bindParam('password', $data['password']);
    $stmt->bindParam('notes', $data['notes']);

    $stmt->execute();
    $insertid=$db->lastInsertId();

    if($insertid)
    {
      $response['code']=200;
      $response['msg']='Added successfully.';
    }else{
      $response['code']=300;
      $response['msg']='Failed to store data.';
    }
  }

}
echo json_encode($response);

?>
