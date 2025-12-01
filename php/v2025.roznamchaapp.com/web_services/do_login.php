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
  // json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}


function store_token($db,$owner_mobile)
{
  $length = 64;
  $token=   substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

  $select_old_token_qry="select count(*) from `user_access` where `owner_mobile` = ?";

  $stmt = $db->prepare($select_old_token_qry);
  $stmt->execute([$owner_mobile]);
  $count = $stmt->fetchColumn();

  if($count!==0)
  {
    $update_token_qry="update `user_access` set `token`=:token, `expiry`=:expiry, `timestamp`=:timestamp, `ip`=:ip, `access_logs`=:access_logs, `access_header`=:access_header where `owner_mobile`=:owner_mobile ";

    $stmt = $db->prepare($update_token_qry);

    $expiry=strtotime("+7 days",time());
    $timestamp=time();
    $ip=$_SERVER['REMOTE_ADDR'];
    $access_logs='';
    $access_header=json_encode($_SERVER);

    $stmt->bindParam('owner_mobile', $owner_mobile);
    $stmt->bindParam('token', $token);
    $stmt->bindParam('expiry', $expiry);
    $stmt->bindParam('timestamp', $timestamp);
    $stmt->bindParam('ip', $ip);
    $stmt->bindParam('access_logs', $access_logs);
    $stmt->bindParam('access_header', $access_header);

    $stmt->execute();
    $token_id =  true;
  }else{



    $token_qry = "insert into `user_access` set `owner_mobile` = :owner_mobile, `status`=:status,  `ip`=:ip,  `token`=:token,  `timestamp`=:timestamp, `expiry`=:expiry,  `access_logs`=:access_logs,  `access_header`=:access_header";
    $stmt = $db->prepare($token_qry);

    $status='Published';
    $ip=$_SERVER['REMOTE_ADDR'];
    $timestamp=time();
    $expiry=strtotime("+7 days",time());
    $access_logs='';
    $access_header=json_encode($_SERVER);

    $stmt->bindParam('owner_mobile', $owner_mobile);
    $stmt->bindParam('status', $status);
    $stmt->bindParam('ip', $ip);
    $stmt->bindParam('token', $token);
    $stmt->bindParam('timestamp', $timestamp);
    $stmt->bindParam('expiry', $expiry);
    $stmt->bindParam('access_logs', $access_logs);
    $stmt->bindParam('access_header', $access_header);

    $stmt->execute();
    $token_id =  $db->lastInsertId();
  }
  if($token_id)
  {
    return $token;
  }else{
    return false;
  }
}


//print_r($_REQUEST);
$JSON = json_encode($_REQUEST);

//$JSON = file_get_contents('php://input');
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
  $username = trim($JSON2['country_code']).'-'.trim($JSON2['mobile']);

//  echo($username);

  if(substr($username,0,1)=='+')
  {
    // do nothing
  }else{
    $username='+'.$username;
  }
  $password = md5(trim($JSON2['password']));
  if($username != "" && $password != "")
  {
//    echo json_encode($JSON2);
//    die();
    try {



      require_once('dbc.php');
      $query = "select * from `users` where `number`=:username and `password`=:password";
      $stmt = $db->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count!==1)
        {
          $response['code']=201;
          $response['msg']='Login Fail. '.$username;
        }
        else{

          $token = store_token($db,$row['number']);
          if($token)
          {
            $response['code']=200;
            $response['msg']='Login successfully.';
            $response['data']=array('id'=>$row['id'],'token'=>$token,
            'username'=>$row['number'],'name'=>$row['business_name'],'account_keys'=>json_decode($row['default_account_keys']),
          'industry_type'=>$row['industry_type'],'business_type'=>$row['business_type'],'address'=>$row['address'],'email'=>$row['email'],'country_code'=>$row['country_code'],'mobile'=>$row['mobile'],'number'=>$row['number'],'currency'=>$row['currency'],
          'gst'=>$row['gst'],'vat'=>$row['vat'],'negative'=>$row['negative'],'tax'=>$row['tax'],'secondary_units'=>$row['secondary_units'],'variants'=>$row['variants'],'barcode'=>$row['barcode'],'salesman_commission'=>$row['salesman_commission']
          ,'print_header_note'=>$row['print_header_note'],'print_footer_note'=>$row['print_footer_note'],'status'=>$row['status'],'privs'=>'*');
          }else{
            $response['code']=210;
            $response['msg']='Login Success but failed to store...';
            $response['data']=array('id'=>$row['id'],'username'=>$row['number'],'name'=>$row['business_name'],'account_keys'=>json_decode($row['default_account_keys']),'token'=>$token);
          }

        }


      }
      catch (PDOException $e){
        echo $e->getMessage();
      }
  }
  else
  {
    $response['code']=300;
    $response['msg']='All Fields are required.';
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
