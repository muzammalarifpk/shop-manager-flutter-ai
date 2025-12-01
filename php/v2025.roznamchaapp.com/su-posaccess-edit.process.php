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


  $data['status']=$_POST['status'];
  $data['notes']=$_POST['notes'];
  $data['id']=$_POST['id'];

  $privs='-,';
  foreach ($_POST['privs'] as $key => $value) {
    $privs.=$value.',';
  }
  $privs.='-';

  $data['privs']=$privs;

  if(1==2)
  {
    $response['code']=301;
    $response['msg']='Access for this employee already exist.';
  }else{

    $time=time();
    $owner_mobile=$_SESSION['sess_bp_username'];

    $insert_qry="update `pos_access` set  `status`='$data[status]',  `last_updated`='$time', `notes`='$data[notes]', `privs`='$data[privs]' where `id`='$_POST[id]' and `owner_mobile` = '$owner_mobile' ";

    $stmt = $db->prepare($insert_qry);

    try{
      $stmt->execute();
    }catch(Exception $e){
      echo $e->getMessage();
    }


    $updated_rows = $stmt->rowCount();

    if($updated_rows>0)
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
