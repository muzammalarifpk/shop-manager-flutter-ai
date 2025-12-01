<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-journal.config.php");


//print_r($_REQUEST);

$journal_qry = "insert into `journal_entries` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `debit`=:debit_account,  `date_time`=:date,  `amount`=:amount,  `description`=:description,  `credit`=:credit_account ";

//echo $sale_qry;
$status = 'Published';


$stmt = $db->prepare($journal_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('debit_account', $_REQUEST['debit_account']);
$stmt->bindParam('credit_account',  $_REQUEST['credit_account']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('amount',  $_REQUEST['amount']);
$stmt->bindParam('description',  $_REQUEST['description']);

if($stmt->execute()){

  $debit_account=$_REQUEST['debit_account'];
  $credit_account=$_REQUEST['credit_account'];

  $debit_array=array(array('account'=>$debit_account,'amount'=>$_REQUEST['amount']));
  $credit_array=array(array('account'=>$credit_account,'amount'=>$_REQUEST['amount']));
  $entry_type="journal_entry";
  $entry_link='journal_entry:'.$db->lastInsertId();

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

//  graph_entry($db,$_REQUEST['date'],0,0,0,$_REQUEST['amount'],0,0,0);
  echo 'success';
}else{
  $err = "<ul><li>Error : some technical issue occur.</li></ul>";
}


?>
