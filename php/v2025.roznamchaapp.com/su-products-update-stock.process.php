<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

//print_r($_SESSION['sess_account_keys']);


$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';

$owner_mobile=$_SESSION['sess_bp_username'];
$time=time();
$last_updated=time();
$product_id = $_POST['product_id'];


//print_r($_REQUEST);

$qry_stock_history="insert into `stock_history` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `product_id`=:product_id,  `date`=:date,  `qty`=:qty,  `in_out`=:in_out,  `qty_before`=:qty_before,  `qty_after`=:qty_after,  `measuring_unit`=:measuring_unit,  `unit_price`=:unit_price,  `total_price`=:total_price ";

$stock_history=$db->prepare($qry_stock_history);

$qty = $_POST['effected_qty'];
$status= 'Published';
$measuring_unit=$_POST['measuring_unit'];
$date=date("Y-m-d");

if($_POST['change_stock_reason']=='opening_balance')
{
  // add to stock_history
  $in_out = 'in';
  $description = 'Adjust stock: opening balance stock item';
  $unit_price=$_POST['purchase_cost'];
  $qty_before= $_POST['available_stock'];
  $qty_after = $_POST['available_stock']+$qty;
  $total_price=$_POST['purchase_cost']*$qty;

  // add to capital account journal entry

  // opening balance journal_entry.

  $capital_account=$_SESSION['sess_account_keys']['capital'];
  $inventory_account=$_SESSION['sess_account_keys']['inventory'];

  $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
  $debit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
  $entry_type='Adjust stock: opening balance stock item';
  $entry_link='product:'.$product_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  // end opening balance journal entry.

}elseif($_POST['change_stock_reason']=='extra')
{
  // add to stock_history
  $in_out = 'in';
  $description = 'Adjust stock: Extra stock item';
  $unit_price=$_POST['purchase_cost'];
  $qty_before= $_POST['available_stock'];
  $qty_after = $_POST['available_stock']+$qty;
  $total_price=$_POST['purchase_cost']*$qty;

  // add to capital account journal entry

  // opening balance journal_entry.

  $capital_account=$_SESSION['sess_account_keys']['profitandlose'];
  $inventory_account=$_SESSION['sess_account_keys']['inventory'];

  $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
  $debit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
  $entry_type='Adjust stock: Extra stock item';
  $entry_link='product:'.$product_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  // end opening balance journal entry.
}elseif($_POST['change_stock_reason']=='lost')
{
  // add to stock_history
  $in_out = 'out';
  $description = 'Adjust stock: Lost stock item.';
  $unit_price=$_POST['purchase_cost'];
  $qty_before= $_POST['available_stock'];
  $qty_after = $_POST['available_stock']-$qty;
  $total_price=$_POST['purchase_cost']*$qty;

  // add to capital account journal entry

  // opening balance journal_entry.

  $capital_account=$_SESSION['sess_account_keys']['expense'];
  $inventory_account=$_SESSION['sess_account_keys']['inventory'];

  $debit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
  $credit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
  $entry_type='Adjust stock: Lost stock item.';
  $entry_link='product:'.$product_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  // end opening balance journal entry.
}elseif($_POST['change_stock_reason']=='damage')
{
  // Subtract to stock_history
  // add to expense
  // add to stock_history
  $in_out = 'out';
  $description = 'Adjust stock: Damage stock item.';
  $unit_price=$_POST['purchase_cost'];
  $qty_before= $_POST['available_stock'];
  $qty_after = $_POST['available_stock']-$qty;
  $total_price=$_POST['purchase_cost']*$qty;

  // add to capital account journal entry

  // opening balance journal_entry.

  $capital_account=$_SESSION['sess_account_keys']['expense'];
  $inventory_account=$_SESSION['sess_account_keys']['inventory'];

  $debit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
  $credit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
  $entry_type='Adjust stock: Damage stock item.';
  $entry_link='product:'.$product_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
}

// stock update



$stock_history->bindParam('owner_mobile',$owner_mobile);
$stock_history->bindParam('timestamp',$time);
$stock_history->bindParam('added_by',$owner_mobile);
$stock_history->bindParam('status',$status);
$stock_history->bindParam('last_updated',$time);
$stock_history->bindParam('product_id',$product_id);
$stock_history->bindParam('date',$date);
$stock_history->bindParam('qty',$qty);
$stock_history->bindParam('in_out',$in_out);
$stock_history->bindParam('qty_before',$qty_before);
$stock_history->bindParam('qty_after',$qty_after);
$stock_history->bindParam('measuring_unit',$measuring_unit);
$stock_history->bindParam('unit_price',$unit_price);
$stock_history->bindParam('total_price',$total_price);

$stock_history->execute();



$stock_history_id=$db->lastInsertId();



$update_qry = "update `products` set `available_stock`='$qty_after' where  `owner_mobile`='$owner_mobile' and `id`='$product_id'";

$stmt = $db->prepare($update_qry);

try
{
  $stmt->execute();
  $response['code'] = 200;
  $response['msg'] = $stock_history_id;

} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode($response));


die();


// old script


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
