<?php
require_once('dbc.php');
// require_once('../includes/libs/telenor-smsapi.php');
  $source='default';
  $respose=array('code'=>100,'msg'=>'URL Exists.');

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

  $_POST['password']=md5($_POST['password']);

  $err=array();

  foreach ($fields['req'] as $key => $value) {
    // code...
    if(empty($_POST[$value]))
    {
      $err[]=$value.' Is a required Field.';
    }
  }

  foreach ($fields['unique'] as $key => $value) {
        // code...
        $query = "
        SELECT id
        FROM `users`
        WHERE
         `$value` = '".$_POST[$value]."'
      ";

      $statement = $db->prepare($query);
      $statement->execute();

      if ($statement->rowCount() > 0)
      {

        // echo 'select unique count is: '.$statement->rowCount();
        $err[] = $_POST[$value]. " Already Exists. $value must be unique. ";

        $items = $statement->fetchAll();
      }
  }



      if(!empty($err))
      {
        $err_html='<ol>';
          foreach($err as $error => $errmsg)
          {
            $err_html.='<li>'.$errmsg.'</li>';
          }
        $err_html.='</ol>';
        $respose=array('code'=>301,'msg'=>'<h3>Ops Validation Error</h3>'. $err_html);
      }else{


      $data=array();

      foreach($fields['default'] as $key => $value)
      {
        $data[$key]=$value;
      }

      foreach($fields['all'] as $key => $value)
      {
        $data[$value]=$_POST[$value];
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

  $stmt->bindParam('timestamp',$time);
  $stmt->bindParam('cohort',$cohort);
  $stmt->bindParam('added_by',$added_by);
  $stmt->bindParam('status',$status);
  $stmt->bindParam('continent_name',$continent_name);
  $stmt->bindParam('country_name',$country_name);
  $stmt->bindParam('country_code_iso',$country_code_iso);
  $stmt->bindParam('region_name',$region_name);
  $stmt->bindParam('city',$city);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('ip',$ip);
  $stmt->bindParam('sync',$sync);
  $stmt->bindParam('currency',$currency);
  $stmt->bindParam('source',$source);
  $stmt->bindParam('industry_type',$_POST['industry_type']);
  $stmt->bindParam('business_type',$_POST['business_type']);
  $stmt->bindParam('business_name',$_POST['business_name']);
  $stmt->bindParam('email',$_POST['email']);
  $stmt->bindParam('referby',$_POST['referby']);
  $stmt->bindParam('country_code',$_POST['country_code']);
  $stmt->bindParam('mobile',$_POST['mobile']);
  $stmt->bindParam('number',$_POST['number']);
  $stmt->bindParam('password',$_POST['password']);
  $stmt->bindParam('default_account_keys',$default_accounts_keys);

  $stmt->execute();

  $user_id = $db->lastInsertId();

  $qry_defaut_accounts = "insert into `chartofaccount` set `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `account_head`=:account_head, `account_type`=:account_type, `balance`=:balance, `balance_type`=:balance_type, `old_balance`=:old_balance, `old_balance_type`=:old_balance_type, `last_update_date`=:last_update_date, `notes`=:notes ";

  $owner_mobile = $_POST['number'];
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

  $_SESSION['sess_bp_week'] = date("W");

  $update_stmt -> execute();

  if(!$stmt)
  {
    $respose=array('code'=>401,'msg'=>'Please take a screenshot and send email to baseplan.pk@gmail.com . Error code 401');
  }else{
    if(!$update_stmt)
    {
      $respose=array('code'=>402,'msg'=>'Please take a screenshot and send email to baseplan.pk@gmail.com . Error code 402');
    }else{
      $respose=array('code'=>200,'msg'=>'Registered Successfully.');


      /******************** Your code ***********************/
      $_SESSION['sess_bp_user_id']   = $user_id;
      $_SESSION['sess_bp_username'] = $owner_mobile;
      $_SESSION['sess_bp_country'] = $_POST['country_code'];
      $_SESSION['sess_bp_emp'] = $owner_mobile;
      $_SESSION['sess_bp_name'] = $_POST['business_name'];
      $_SESSION['sess_bp_adr'] = '';
      $_SESSION['sess_bp_privs'] = '*';
      $_SESSION['sess_bp_currency'] = $currency;
      $_SESSION['sess_bp_gst'] = '';
      $_SESSION['sess_bp_vat'] = '';
      $_SESSION['sess_bp_tax'] = '';
      $_SESSION['sess_bp_barcode']='off';
      $_SESSION['sess_bp_salesman_commission'] = '';
      $_SESSION['sess_bp_agent_commision'] = '';

      $_SESSION['sess_bp_type'] = '';
      $_SESSION['sess_bp_timestamp'] = $time;
      $_SESSION['sess_bp_date'] = '';
      $_SESSION['sess_bp_coin'] = '';

      $_SESSION['sess_bp_print_header'] = 'on';
      $_SESSION['sess_bp_print_urdu_invoice'] = 'off';

      $_SESSION['sess_bp_print_header_note'] = '';
      $_SESSION['sess_bp_print_footer_note'] = '';
      $_SESSION['sess_bp_print_default_template'] = '';

      $_SESSION['sess_bp_variants'] = '';
      $_SESSION['sess_bp_secondary_units'] = '';
      $_SESSION['sess_bp_lend_inventory'] = 'off';
      $_SESSION['sess_account_keys'] = json_decode($default_accounts_keys,true);

      $_SESSION['sess_bp_week'] = date("W",$time);

      if($_POST['country_code']=='+92')
      {
        $mobile_number = $_POST['mobile'];

        if($mobile_number[0] == '0')
        {
          $mobile_number = substr($mobile_number, 1);
        }

        $toNumbersCsv = '92'.$mobile_number;
        $toNumbersCsv = str_replace("+",'',$toNumbersCsv);
        $toNumbersCsv = str_replace("-",'',$toNumbersCsv);


        $messageText = 'Cloud Shop Manager register krne ka shukria. Ya software apke karobar ko taraki daine mai maddgaar ha. Computer & Mobile pa istimal kr sakte hain. 0343-4123489';

        // $sent=sendSmsMessage($messageText,$toNumbersCsv,$mask);
      }

      give_referal_bonus($db,$_POST['referby']);


    }
  }

  }


  $respose_json=json_encode($respose);
  print_r($respose_json);
  require_once('close_dbc.php');
?>
