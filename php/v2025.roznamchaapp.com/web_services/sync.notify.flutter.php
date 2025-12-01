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

$JSON = json_encode($_REQUEST);

$JSON = file_get_contents('php://input');
//print_r($JSON);
$JSON1 = stripslashes($JSON);
$JSON2 = json_decode($JSON,true);

if(!isJson($JSON2))
{
  $response['code']=101;
  $response['msg']='Invalid request';
  $response['data']=$JSON2;

}else{

  $response['data']=$JSON2;
  $token = $JSON2['basic'][0]['token'];
  $deviceID = $JSON2['basic'][0]['deviceID'];
  $owner_mobile = $JSON2['basic'][0]['username'];
  $api_v = $JSON2['basic'][0]['api_v'];

    try {
      require_once('dbc.php');
      require_once('flutter.sync.class.php');


      $response['data']=$JSON2;



        $token_response=validate_token($db,$owner_mobile,$token,$api_v);
        if(intval(($token_response['code']))!==200)
        {
          $response['code']=102;
          $response['msgz']='Invalid Token';
          $response['data']=$token_response;

        }else{
          $response['code']=200;
          $response['msg']= 'Valid Token';
          // $response['data']=$token_response;

          // $response['data']=$JSON2['products'][0]['title'];
          $response['data']=ProcessSyncNotify($db,$owner_mobile,$JSON2,$deviceID);
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
