<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

$response['code']=100;
$response['msg']='Invalid request';

$time=time();
$date_time=date("Y m d H i s");

if(!function_exists("isJson"))
{
  function isJson($string)
  {
   //json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}


function storeDevice($db,$platformOS)
{
  $length = 3;
  $token=   substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

  $select_old_token_qry="select count(*) from `deviceList` where `token` = ?";

  $stmt = $db->prepare($select_old_token_qry);
  $stmt->execute([$token]);
  $count = $stmt->fetchColumn();
  //
  // while($count!==0)
  // {
  //   $token=   substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  //
  //   $select_old_token_qry="select count(*) from `deviceList` where `token` = ?";
  //
  //   $stmt = $db->prepare($select_old_token_qry);
  //   $stmt->execute([$token]);
  //   $count = $stmt->fetchColumn();
  //
  // }

    $token_qry = "insert into `deviceList` set `status`=:status,  `platformOS`=:platformOS,   `ip`=:ip,  `token`=:token,  `timestamp`=:timestamp";
    $stmt = $db->prepare($token_qry);

    $status='Published';
    $ip=$_SERVER['REMOTE_ADDR'];
    $timestamp=time();

    $stmt->bindParam('status', $status);
    $stmt->bindParam('platformOS', $platformOS);
    $stmt->bindParam('ip', $ip);
    $stmt->bindParam('token', $token);
    $stmt->bindParam('timestamp', $timestamp);

    $stmt->execute();
    $token_id =  $db->lastInsertId();

  if($token_id)
  {
    return $token;
  }else{
    return false;
  }
}


//print_r($_REQUEST);
$JSON = json_encode($_REQUEST);

$JSON = file_get_contents('php://input');
//print_r($JSON);
$JSON1 = stripslashes($JSON);
$JSON2 = json_decode($JSON,true);
//print_r($JSON2);
if(!isJson($JSON2))
{
  $response['code']=101;
  $response['msg']='Invalid request';
  $response['data']=$JSON2;

}else{

  $platformOS = $JSON2['platform'];

    try {
      require_once('dbc.php');
      $token = storeDevice($db,$platformOS);
      if($token)
      {
        $response['code']=200;
        $response['msg']='Device Registered successfully.';
        $response['data']=array('token'=>$token);

      }else{
            $response['code']=210;
            $response['msg']='Login Success but failed to store...';
          }

        }
      catch (PDOException $e){
        echo $e->getMessage();
      }
  }

  $response=json_encode($response);
  if(!isJson($response))
  {
    echo 'Error creating json';
  }else{
    echo $response;
  }

  require_once('close_dbc.php');
?>
