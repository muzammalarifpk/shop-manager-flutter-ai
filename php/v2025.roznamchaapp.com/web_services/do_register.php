<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');


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

if(!function_exists("isJson"))
{
  function isJson($string)
  {
   //json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}



$JSON = json_encode($_REQUEST);

//print_r($JSON);

$JSON = file_get_contents('php://input');
$JSON1 = stripslashes($JSON);
$JSON2 = json_decode($JSON,true);

//print_r($JSON2);

if(empty($JSON2))
{
  $response['code']=101;
  $response['msg']='Empty Request. No variable sent.';
  $response['data']=$JSON2;

}elseif(!isJson($JSON2))
{
  $response['code']=102;
  $response['msg']='Invalid request';
  $response['data']=$JSON2;

}else{

  if($JSON2['mobile']=='')
  {
    $response['code']=301;
    $response['msg']='Mobile number is required.';
  }elseif($JSON2['country_code']=='')
  {
    $response['code']=302;
    $response['msg']='Country code is required.';
  }elseif($JSON2['password']=='')
  {
    $response['code']=303;
    $response['msg']='Password is required.';
  }else
  {
    $response['code']=201;
    $response['msg']='Processing information.';

    $JSON2['number']=$JSON2['country_code'].'-'.$JSON2['mobile'];

    require_once('dbc.php');
    //require_once('../includes/libs/telenor-smsapi.php');
    $source='default';


    // set IP address and API access key
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_access_key = '2952774e664b62089373947213576930';

    // Initialize CURL:
    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$ip_access_key.'&fields=continent_name,country_name,country_code,region_name,city,location,currency');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    $ip_api_result = json_decode($json, true);

    //print_r($ip_api_result);

    // Output the "capital" object inside "location"
    //  echo $api_result['location']['capital'];

    $currency = 'Rs ';
    if(isset($ip_api_result['city']))
    {
      $continent_name = $ip_api_result['continent_name'];
      $country_name = $ip_api_result['country_name'];
      $country_code_iso = $ip_api_result['country_code'];
      $region_name = $ip_api_result['region_name'];
      $city = $ip_api_result['city'];
    }else{
      $continent_name = '';
      $country_name = '';
      $country_code_iso = '';
      $region_name = '';
      $city = '';
    }


    $fields['default']['timestamp']=$time;
    $fields['default']['added_by']='web';
    $fields['default']['status']='published';
    $fields['default']['last_updated']='';
    $fields['default']['ip']=$_SERVER['REMOTE_ADDR'];
    $fields['default']['sync']=0;
    $fields['default']['source']=$source;

    $fields['all']=array('industry_type','business_type','business_name','email','referby','country_code','mobile','number','password');
    $fields['req']=array('industry_type','business_type','business_name','country_code','mobile','number','password');
    $fields['unique']=array('number');

    $JSON2['password']=md5($JSON2['password']);

    $err=array();

    foreach ($fields['req'] as $key => $value) {
      // code...
      if(empty($JSON2[$value]))
      {
        $err[]=$value.' Is a required Field.';
      }
    }

    $response['code']=202;
    $response['msg']='Required fields loop finished..';

    foreach ($fields['unique'] as $key => $value) {
          // code...
          $query = "
          SELECT id
          FROM `users`
          WHERE
           `$value` = '".$JSON2[$value]."'
        ";

        $statement = $db->prepare($query);
        $statement->execute();

        if ($statement->rowCount() > 0)
        {
          $err[] = $JSON2[$value]. " Already Exists. $value must be unique. ";

          $items = $statement->fetchAll();
        }
    }

    $response['code']=203;
    $response['msg']='Unique fields loop finished...';


    if(!empty($err))
    {
      $err_html='<ol>';
        foreach($err as $error => $errmsg)
        {
          $err_html.='<li>'.$errmsg.'</li>';
        }
      $err_html.='</ol>';

      $response['code']=204;
      $response['msg']='<h3>Ops Validation Error</h3>'.$err_html;

    }else{
      $response['code']=204;
      $response['msg']='No error found...';

    $data=array();

    foreach($fields['default'] as $key => $value)
    {
      $data[$key]=$value;
    }

    foreach($fields['all'] as $key => $value)
    {
      $data[$value]=$JSON2[$value];
    }

    $data['bars']='---';


    $sql = " INSERT INTO users (" ;

      foreach($fields['default'] as $key => $value)
      {
        $sql.='`'.$key.'`, ';
      }

      foreach($fields['all'] as $key => $value)
      {
        $sql.='`'.$value.'`, ';
      }

      $sql.=' `---` ';

    $sql.=  ") VALUES (";

        foreach($fields['default'] as $key => $value)
        {
          $sql.=' :'.$key.', ';
        }

        foreach($fields['all'] as $key => $value)
        {
          $sql.=' :'.$value.', ';
        }

        $sql.=' :bars ';

        $sql.=  ")";

    $sql = "insert into `users` set `timestamp`=:timestamp, `cohort`=:cohort,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,  `ip`=:ip,  `sync`=:sync,  `source`=:source,  `industry_type`=:industry_type,  `business_type`=:business_type,  `business_name`=:business_name,  `email`=:email,  `referby`=:referby,  `country_code`=:country_code,  `mobile`=:mobile,  `number`=:number,  `password`=:password, `default_account_keys`=:default_account_keys,
    `logo`=:logo,
    `currency`=:currency,
    `continent_name`=:continent_name,
    `country_name`=:country_name,
    `country_code_iso`=:country_code_iso,
    `region_name`=:region_name,
    `city`=:city
           ";

    $stmt= $db->prepare($sql);

    $added_by = 'web';
    $ip=$_SERVER['REMOTE_ADDR'];
    $sync = '0';
    $default_accounts_keys = '';
    $status = 'Published';
    $cohort = date("Y-W");
    if($db_name=='bp_beta')
    {
      $status='draft';
    }

    $default_logo = 'uploads/images/default-logo.png';

    $stmt->bindParam('timestamp',$time);
    $stmt->bindParam('cohort',$cohort);
    $stmt->bindParam('added_by',$added_by);
    $stmt->bindParam('status',$status);
    $stmt->bindParam('continent_name',$continent_name);
    $stmt->bindParam('logo',$default_logo);
    $stmt->bindParam('country_name',$country_name);
    $stmt->bindParam('country_code_iso',$country_code_iso);
    $stmt->bindParam('region_name',$region_name);
    $stmt->bindParam('city',$city);
    $stmt->bindParam('last_updated',$time);
    $stmt->bindParam('ip',$ip);
    $stmt->bindParam('sync',$sync);
    $stmt->bindParam('currency',$currency);
    $stmt->bindParam('source',$source);
    $stmt->bindParam('industry_type',$JSON2['industry_type']);
    $stmt->bindParam('business_type',$JSON2['business_type']);
    $stmt->bindParam('business_name',$JSON2['business_name']);
    $stmt->bindParam('email',$JSON2['email']);
    $stmt->bindParam('referby',$JSON2['referby']);
    $stmt->bindParam('country_code',$JSON2['country_code']);
    $stmt->bindParam('mobile',$JSON2['mobile']);
    $stmt->bindParam('number',$JSON2['number']);
    $stmt->bindParam('password',$JSON2['password']);
    $stmt->bindParam('default_account_keys',$default_accounts_keys);

    $stmt->execute();

    $user_id = $db->lastInsertId();

    $qry_defaut_accounts = "insert into `chartofaccount` set `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `account_head`=:account_head, `account_type`=:account_type, `balance`=:balance, `balance_type`=:balance_type, `old_balance`=:old_balance, `old_balance_type`=:old_balance_type, `last_update_date`=:last_update_date, `notes`=:notes ";

    $owner_mobile = $JSON2['number'];
    $added_by='System';
    $status='Published';
    $balance=0;
    $balance_type='cr';
    $notes='';

    $default_accounts=$db->prepare($qry_defaut_accounts);

    foreach($list_default_accounts as $key => $account)
    {
      $default_accounts->bindParam('owner_mobile', $owner_mobile);
      $default_accounts->bindParam('timestamp', $time);
      $default_accounts->bindParam('added_by', $added_by);
      $default_accounts->bindParam('status', $status);
      $default_accounts->bindParam('last_updated', $time);
      $default_accounts->bindParam('account_head', $account['account_head']);
      $default_accounts->bindParam('account_type', $account['account_type']);
      $default_accounts->bindParam('balance', $balance);
      $default_accounts->bindParam('balance_type', $balance_type);
      $default_accounts->bindParam('old_balance', $balance);
      $default_accounts->bindParam('old_balance_type', $balance_type);
      $default_accounts->bindParam('last_update_date', $time);
      $default_accounts->bindParam('notes', $notes);

      $default_accounts->execute();

      $default_accounts_ids[$account['account_key']]=$db->lastInsertId();

    }

    $qry_walkin_contact = "insert into `contacts` set  `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `name`=:name , `country_code`=:country_code , `mobile`=:mobile , `number`=:number , `type`=:type , `balance`=:balance , `balance_status`=:balance_status ";


    $name='Walk-in Customer / Supplier';
    $country_code = '+';
    $mobile = '0000';
    $number = $country_code.''.$mobile;
    $type = 'customer';
    $balance = '0';
    $balance_status = 'payable';

    $walkin_contact = $db->prepare($qry_walkin_contact);

    $walkin_contact->bindParam('owner_mobile', $owner_mobile);
    $walkin_contact->bindParam('timestamp', $time);
    $walkin_contact->bindParam('added_by', $added_by);
    $walkin_contact->bindParam('status', $status);
    $walkin_contact->bindParam('last_updated', $time);

    $walkin_contact->bindParam('name', $name);
    $walkin_contact->bindParam('country_code', $country_code);
    $walkin_contact->bindParam('mobile', $mobile);
    $walkin_contact->bindParam('number', $number);
    $walkin_contact->bindParam('type', $type);
    $walkin_contact->bindParam('balance', $balance);
    $walkin_contact->bindParam('balance_status', $balance_status);

    $walkin_contact_result = $walkin_contact->execute();

    $default_accounts_keys=json_encode($default_accounts_ids);

    $update_qry="update `users` set `default_account_keys`=:default_account_keys where `id`=:id and `number`=:number";
    $update_stmt = $db->prepare($update_qry);

    $update_stmt -> bindParam('default_account_keys',$default_accounts_keys);
    $update_stmt -> bindParam('id',$user_id);
    $update_stmt -> bindParam('number',$owner_mobile);

    $reply_data['sess_bp_week'] = date("W");

    $update_stmt -> execute();

  if(!$stmt)
  {
    $response['code']=401;
    $response['msg']='Please take a screenshot and send email to baseplan.pk@gmail.com . Error code 401';

  }else{
    if(!$update_stmt)
    {
      $response['code']=402;
      $response['msg']='Please take a screenshot and send email to baseplan.pk@gmail.com . Error code 402';
    }else{


      /******************** Your code ***********************/
      $reply_data['sess_bp_user_id']   = $user_id;
      $reply_data['sess_bp_username'] = $owner_mobile;
      $reply_data['sess_bp_emp'] = $owner_mobile;
      $reply_data['sess_bp_name'] = $JSON2['business_name'];
      $reply_data['sess_bp_adr'] = '';
      $reply_data['sess_bp_logo'] = 'https://shop-manager.roznamchaapp.com/'.$default_logo;
      $reply_data['sess_bp_privs'] = '*';
      $reply_data['sess_bp_currency'] = $currency;
      $reply_data['sess_bp_gst'] = '';
      $reply_data['sess_bp_vat'] = '';
      $reply_data['sess_bp_tax'] = '';
      $reply_data['sess_bp_salesman_commission'] = '';
      $reply_data['sess_bp_agent_commision'] = '';
      $reply_data['sess_bp_timestamp'] = $time;

      $reply_data['sess_bp_print_header'] = 'on';
      $reply_data['sess_bp_print_urdu_invoice'] = 'off';

      $reply_data['sess_bp_print_header_note'] = '';
      $reply_data['sess_bp_print_footer_note'] = '';
      $reply_data['sess_bp_print_default_template'] = '';

      $reply_data['sess_bp_barcode']='off';
      $reply_data['sess_bp_variants'] = '';
      $reply_data['sess_bp_secondary_units'] = '';
      $reply_data['sess_account_keys'] = json_decode($default_accounts_keys,true);

      $reply_data['sess_bp_week'] = date("W",$time);
      $reply_data['sess_bp_token'] =  store_token($db,$owner_mobile);


      $response['code']=200;
      $response['msg']='Registered Successfully';
      $response['reply_data']=$reply_data;


      if($JSON2['country_code']=='+92')
      {
        $mobile_number = $JSON2['mobile'];

        if($mobile_number[0] == '0')
        {
          $mobile_number = substr($mobile_number, 1);
        }

        $toNumbersCsv = '92'.$mobile_number;
        $toNumbersCsv = str_replace("+",'',$toNumbersCsv);
        $toNumbersCsv = str_replace("-",'',$toNumbersCsv);


        $messageText = 'Cloud Shop Manager register krne ka shukria. Ya software apke karobar ko taraki daine mai maddgaar ha. Computer & Mobile pa istimal kr sakte hain. 0343-4123489';

//        $sent=sendSmsMessage($messageText,$toNumbersCsv,$mask);
      }


    }
  }

  }
}
}

$response_json=json_encode($response);
if(!isJson($response_json))
{
  echo 'Error creating json';
}else{
  echo $response_json;
}

require_once('close_dbc.php');
?>
