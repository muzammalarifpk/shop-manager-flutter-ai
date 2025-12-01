<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('includes/dbc.php');
require_once('includes/libs/telenor-smsapi.php');


$select_qry="select * from `users` where `country_code`='+92'  order by `id` asc ";
foreach ($db->query($select_qry) as $row) {
  if($row['mobile'][0] == '0')
  {
    $this_mobile_number = substr($row['mobile'], 1);
  }else{
    $this_mobile_number = $row['mobile'];
  }
  if(strlen($this_mobile_number)==10)
  {
    $user_numbers_array[]='92'.$this_mobile_number;
  }
}



$select_off_qry="select * from `Users` where `mobile`like '+9203%' ||  `mobile`like '+923%'  order by `id` asc ";
foreach ($db_off->query($select_off_qry) as $row) {
  if(strlen($row['mobile'])==13)
  {
    $user_numbers_array[]=str_replace("+","",$row['mobile']);
  }elseif (strlen($row['mobile'])==13) {
    // code...

    $user_numbers_array[]=str_replace("+920","92",$row['mobile']);
  }
}
$user_numbers_array = array_unique($user_numbers_array);

  foreach ($user_numbers_array as $key => $value) {
    echo $value.'<br />';
    // code...
  }
//print_r($user_numbers_array);


die();

$_POST['country_code']='+92';
$_POST['mobile'] = '03434123489';



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

  $sent=sendSmsMessage($messageText,$toNumbersCsv,$mask);
}

?>
