<?php
require_once('includes/dbc.php');
$date = date('D d M, Y');
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Karachi');
require_once('includes/libs/telenor-smsapi.php');

// Recipient
$s_time = strtotime('yesterday');
$e_time = strtotime('today midnight');


$sms_templates[]="Cloud Shop manager app ko app computer or mobile pa ek sath use kr sakte hain. Unlimited users k lia click here: cutt.ly/bpshop";

$sms_templates[]="hamari app mai ap stock ka mukamal hisab rakh sakte hain. konsi item kis jagha ha or kis quantity mai ha. cutt.ly/shopapp";

$sms_templates[]="Cloud shop manager mai ap apne customer or vendors dono ka khata bana sakte hain, mazeed maloomat k lia call 0343-4123489 HelpLine";

$sms_templates[]="ab apne business ko online krna or b asan. bus apni products ki pictures add krain or apka onliine store ready ho jaye ga. cutt.ly/bpshop";

$sms_templates[]="Customer sa payment laine k lia usko reminder sms send krne ki option b mojood ha. software ko online or offline b use kr sakte hain. cutt.ly/bpshop";

$sms_templates[]="apki free trial expire hone wali ha. abi call krain or premium features sa faida uthain. 0343-4123489";

$sms_templates[]="17000 shops apne business ko taraqi dane k lia cloud shop manager app use kr rahe hain. ap b join krain 0343-4123489";

//echo '<ol>';
foreach ($sms_templates as $key => $value) {
  // code...
  //echo $value.'<br />';
}
//echo '</ol>';

$message_array = [];

for($i=0; $i<=6; $i++)
{
  $select_pk = "select * from `users` where `country_name`='Pakistan' and `timestamp`>'$s_time' and `timestamp`<'$e_time' order by `entries` desc";

  foreach ($db->query($select_pk) as $row_pk)
  {
    $this_number=$row_pk['mobile'];
    $this_number=str_replace("+","",$this_number);
    $this_number=str_replace("-","",$this_number);

    $msg_len = strlen($sms_templates[$i]);

    $this_msg = $sms_templates[$i];
    $name_len=strlen($row_pk['business_name']);

    if(156-($msg_len+$name_len) > 0)
    {
      $this_msg = trim($row_pk['business_name']).', '.$this_msg;
    }else{
      $strlimit = 156 - $msg_len;
      $this_msg = trim(substr($row_pk['business_name'],0,$strlimit)).', '.$this_msg;

    }

    if($row_pk['country_code']=='+92' || $row_pk['country_name']=='Pakistan')
    {
      $message_array[]=['country_code'=>'+92','mobile'=>$this_number,'msg'=>$this_msg];
    }
  }


//  echo "<h2>Start: ".date("Y-m-d H:i:s",$s_time)." ----- End: ".date("Y-m-d H:i:s",$e_time)."</h2>";
  $s_time-=86400;
  $e_time-=86400;

//  echo "<h1>$i</h1>";
}

foreach ($message_array as $key => $value) {
  // code...

  sendtoPK($value['country_code'],$value['mobile'],$value['msg'],$mask,$db);
}
echo 'finish';
?>
