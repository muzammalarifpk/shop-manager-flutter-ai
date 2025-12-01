<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-shipping.config.php");


//print_r($_REQUEST);

$expense_qry = "insert into `shipping_receipt_history` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,  `contact_number`=:contact_number,  `date`=:date,  `total_expense`=:total_expense,  `picker_guy`=:picker_guy, `unit1`=:unit1,  `qty1`=:qty1,  `unit2`=:unit2,  `qty2`=:qty2,  `unit3`=:unit3,  `qty3`=:qty3,  `unit4`=:unit4,  `qty4`=:qty4,  `unit5`=:unit5,  `qty5`=:qty5,  `unit7`=:unit7,  `qty6`=:qty6,  `unit6`=:unit6,  `qty7`=:qty7";

//echo $sale_qry;
$status = 'Published';


$stmt = $db->prepare($expense_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('contact_number', $_REQUEST['contact_number']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('total_expense',  $_REQUEST['total_expense']);
$stmt->bindParam('picker_guy',  $_REQUEST['picker_guy']);
$stmt->bindParam('unit1',  $_REQUEST['unit1']);
$stmt->bindParam('qty1',  $_REQUEST['qty1']);
$stmt->bindParam('unit2',  $_REQUEST['unit2']);
$stmt->bindParam('qty2',  $_REQUEST['qty2']);
$stmt->bindParam('unit3',  $_REQUEST['unit3']);
$stmt->bindParam('qty3',  $_REQUEST['qty3']);
$stmt->bindParam('unit4',  $_REQUEST['unit4']);
$stmt->bindParam('qty4',  $_REQUEST['qty4']);
$stmt->bindParam('unit5',  $_REQUEST['unit5']);
$stmt->bindParam('qty5',  $_REQUEST['qty5']);
$stmt->bindParam('unit6',  $_REQUEST['unit6']);
$stmt->bindParam('qty6',  $_REQUEST['qty6']);
$stmt->bindParam('unit7',  $_REQUEST['unit7']);
$stmt->bindParam('qty7',  $_REQUEST['qty7']);

if($stmt->execute()){
  echo 'success';
}else{
  $err = "<ul><li>Error : some technical issue occur.</li></ul>";
}


?>
