<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-journal.config.php");


//print_r($_REQUEST);

$journal_qry = "insert into `journal_entries` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `debit`=:debit_account,  `date_time`=:date,  `amount`=:amount,  `description`=:description,  `credit`=:credit_account ";

//echo $sale_qry;
$status = 'Published';

$capital_account=$_SESSION['sess_account_keys']['capital'];
$entry_type = $_POST['entry_type'];
$coa_account='c'.$_POST['number'];

if($entry_type=='debit')
{
  $debit_account = $coa_account;
  $credit_account = $capital_account;
}else{
  $debit_account = $capital_account;
  $credit_account = $coa_account;

}
$date = date("Y-m-d H:i:s");//2019-07-23 11:20:57
$amount = floatval($_POST['entry_amount']);
$description = 'Adjusted Contact Balance .';

$stmt = $db->prepare($journal_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('debit_account', $debit_account);
$stmt->bindParam('credit_account',  $credit_account);
$stmt->bindParam('date',  $date);
$stmt->bindParam('amount',  $amount);
$stmt->bindParam('description',  $description);

if($stmt->execute()){


  $debit_array=array(array('account'=>$debit_account,'amount'=>$amount));
  $credit_array=array(array('account'=>$credit_account,'amount'=>$amount));

  $entry_type="journal_entry";
  $entry_link='journal_entry:'.$db->lastInsertId();

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

//  graph_entry($db,$_REQUEST['date'],0,0,0,$_REQUEST['amount'],0,0,0);
  echo 'success';
}else{
  $err = "<ul><li>Error : some technical issue occur.</li></ul>";
}


?>
