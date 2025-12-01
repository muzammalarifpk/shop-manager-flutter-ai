<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-payments.config.php");
require_once('includes/libs/telenor-smsapi.php');

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';

//print_r($_REQUEST);

$sale_qry = "insert into `payments` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,   `contact_number`=:contact_number,  `date`=:date,  `amount`=:amount,  `discount`=:discount,  `description`=:description,  `payment_method`=:payment_method, `payment_type`=:payment_type, `attachments`=:attachments ";

//echo $sale_qry;
$status = 'Published';


$stmt = $db->prepare($sale_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('contact_number', $_REQUEST['contact_number']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('payment_type',  $_REQUEST['payment_type']);
$stmt->bindParam('amount',  $_REQUEST['amount']);
$stmt->bindParam('discount',  $_REQUEST['discount']);
$stmt->bindParam('description',  $_REQUEST['description']);
$stmt->bindParam('payment_method',  $_REQUEST['payment_method']);
$stmt->bindParam('attachments',  $_SESSION['sess_bp_token']);

$old_balance = gnr($db,'contacts','number',$_REQUEST['contact_number'],'balance');


if($stmt->execute()){

  $payment_id = $db->lastInsertId();

  $sales_discount_account=$_SESSION['sess_account_keys']['salediscount'];
  $purchases_discount_account=$_SESSION['sess_account_keys']['purchasediscount'];

  $payment_account=$_REQUEST['payment_method'];
  $to_account='c'.$_REQUEST['contact_number'];
  $amount= $_REQUEST['amount'];
  $discount= $_REQUEST['discount'];
  $to= $_REQUEST['contact_number'];
  $owner_mobile=$_SESSION['sess_bp_username'];

  if($_REQUEST['payment_type']=='Paid')
  {
    $credit_array=array(array('account'=>$payment_account,'amount'=>$_REQUEST['amount']));
    $debit_array=array(array('account'=>$to_account,'amount'=>$_REQUEST['amount']));
  }else{
    $debit_array=array(array('account'=>$payment_account,'amount'=>$_REQUEST['amount']));
    $credit_array=array(array('account'=>$to_account,'amount'=>$_REQUEST['amount']));
  }

    if($_REQUEST['payment_type']=='Paid')
    {
      $credit_array_discount=array(array('account'=>$sales_discount_account,'amount'=>$_REQUEST['discount']));
      $debit_array_discount=array(array('account'=>$to_account,'amount'=>$_REQUEST['discount']));
    }else{
      $debit_array_discount=array(array('account'=>$purchases_discount_account,'amount'=>$_REQUEST['discount']));
      $credit_array_discount=array(array('account'=>$to_account,'amount'=>$_REQUEST['discount']));
    }


  $entry_type='payment.'.$_REQUEST['payment_type'];
  $entry_link='paymentid:'.$payment_id;
try{
  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
  journal_entry($db,$credit_array_discount,$debit_array_discount,$entry_type,$entry_link);

  $response['code'] = 200;
  $response['date_time'] = date('d-M, Y',$time);
  $response['msg'] = $payment_id;


$cname = gnr($db,'contacts','number',$_REQUEST['contact_number'],'name');
$country_code = gnr($db,'contacts','number',$_REQUEST['contact_number'],'country_code');
$mobile_number = gnr($db,'contacts','number',$_REQUEST['contact_number'],'mobile');
$new_bal = gnr($db,'contacts','number',$_REQUEST['contact_number'],'balance');


$messageText = substr($cname,0,11)."
Your Payment added to account
Amount: $_REQUEST[amount]
Old Bal: $old_balance
New Bal: $new_bal

".substr($_SESSION['sess_bp_name'],0,10)."
$_SESSION[sess_bp_username]
";

//sendtoPK($country_code,$mobile_number,$messageText,$mask,$db);


}catch(Exception $e)
{
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

}else{
  $err = "<ul><li>Some technical issue occur, please contact baseplan technical support.</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode_gfs($response));

?>
