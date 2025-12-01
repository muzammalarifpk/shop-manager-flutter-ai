<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-expense.config.php");


//print_r($_REQUEST);

$expense_qry = "insert into `expense` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `expense_type`=:expense_type,  `date`=:date,  `amount`=:amount,  `description`=:description,  `payment_method`=:payment_method, `attachments`=:attachments ";

//echo $sale_qry;
$status = 'Published';


$stmt = $db->prepare($expense_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('expense_type', $_REQUEST['expense_type']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('amount',  $_REQUEST['amount']);
$stmt->bindParam('description',  $_REQUEST['description']);
$stmt->bindParam('payment_method',  $_REQUEST['payment_method']);
$stmt->bindParam('attachments',  $_SESSION['sess_bp_token']);

if($stmt->execute()){

  $payment_account=$_REQUEST['payment_method'];
  $expense_account=$_SESSION['sess_account_keys']['expense'];

  $credit_array   =array(array('account'=>$payment_account,'amount'=>$_REQUEST['amount']));
  $debit_array    =array(array('account'=>$expense_account,'amount'=>$_REQUEST['amount']));
  $entry_type     ="expense";
  $entry_link     ='expense:'.$db->lastInsertId();

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  graph_entry($db,$_REQUEST['date'],0,0,0,$_REQUEST['amount'],0,0,0);
  echo 'success';
}else{
  $err = "<ul><li>Error : some technical issue occur.</li></ul>";
}


?>
