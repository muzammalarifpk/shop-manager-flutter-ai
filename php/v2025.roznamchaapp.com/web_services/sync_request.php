<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

if(!function_exists("isJson")) {
  function isJson($string)
  {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}

$JSON = file_get_contents('php://input');
$JSON1 = stripslashes($JSON);
$JSON2 = json_decode($JSON1,true);

require_once('dbc.php');
require_once('sync.class.php');

$response['code']=100;
$response['msg']='Invalid request';

$time=time();
$date_time=date("Y m d H i s");


if(!isJson($JSON1))
{
  $response['code']=101;
  $response['msg']='Invalid request';
  $response['data']=$JSON2;

}else{
  $owner_mobile = trim($JSON2['basic']['username']);
  $token = trim($JSON2['basic']['token']);
  $api_v = trim($JSON2['basic']['version']);
  $token_response=validate_token($db,$owner_mobile,$token,$api_v);
  if($token_response!==200)
  {
    $response['code']=102;
    $response['msg']='Invalid Token';

  }else{
    foreach($JSON2['request'] as $key => $value)
    {
      $get_data_function = "get_data2sync_".$value;
      $response['data'][$value] = $get_data_function($db,$owner_mobile);
    }
    $response['code']=200;
    $response['msg']= 'Valid Token';
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
