<?php
require_once('dbc.php');
require_once('sync.class.php');
//echo 'request received...';
$response['code']=100;
$response['msg']='Invalid request';

$time=time();
$date_time=date("Y m d H i s");

$request_data=$_POST;
$request_json = json_encode($request_data);
//print_r($request_data);
if(!isJson($request_json))
{
  $response['code']=101;
  $response['msg']='Invalid request';
  $response['data']=$request_data;

}else{

    $owner_mobile = trim($request_data['basic']['username']);
    $token = trim($request_data['basic']['token']);
    $api_v = trim($request_data['basic']['version']);
    $token_response=validate_token($db,$owner_mobile,$token,$api_v);
    if($token_response!==200)
    {
      $response['code']=102;
      $response['msg']='Invalid Token';

    }else{
      foreach ($request_data['post'] as $key => $value) {
        // store data for each module from offline pos...
        $store_data_function = "store_data_function_".$value;
        if (array_key_exists('post_data',$request_data))
        {
          if(array_key_exists($value,$request_data['post_data']))
          {
            if(is_array($request_data['post_data'][$value]))
            {
              foreach ($request_data['post_data'][$value] as $data_key => $data_value) {
                // call function to store data into database...
                $response['stored'][$value][]=$store_data_function($db,$owner_mobile,$data_value);
              }
            }
          }
        }
      }


      foreach($request_data['request'] as $key => $value)
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
