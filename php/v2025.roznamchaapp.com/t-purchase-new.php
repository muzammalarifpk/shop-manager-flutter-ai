<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-purchase.config.php");


//print_r($_REQUEST);

$purchase_qry = "insert into `purchase_invoices` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,  `cartitems`=:cartitems,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `remaining_amount`=:remaining_amount, `notes`=:notes, `attachments`=:attachments ";

//echo $purchase_qry;
$status = 'Published';


$stmt = $db->prepare($purchase_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('cartitems', $_REQUEST['cart_items']);
$stmt->bindParam('contact_number', $_REQUEST['cname']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('sub_total',  $_REQUEST['sub_total']);
$stmt->bindParam('discount',  $_REQUEST['discount']);
$stmt->bindParam('grand_total',  $_REQUEST['grand_total']);
$stmt->bindParam('amount_paid',  $_REQUEST['amount_paid']);
$stmt->bindParam('payment_method',  $_REQUEST['payment_method']);
$stmt->bindParam('remaining_amount',  $_REQUEST['remaining_balance']);
$stmt->bindParam('notes',  $_REQUEST['notes']);
$stmt->bindParam('attachments',  $_SESSION['sess_bp_token']);

$stmt->execute();

$purchaseid=$db->lastInsertId();

$purchases_account=$_SESSION['sess_account_keys']['purchases'];
$purchases_discount_account=$_SESSION['sess_account_keys']['purchasediscount'];

$debit_array=array(array('account'=>$purchases_account,'amount'=>$_REQUEST['sub_total']));
$credit_array=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$_REQUEST['remaining_balance']),array('account'=>$_REQUEST['payment_method'],'amount'=>$_REQUEST['amount_paid']),array('account'=>$purchases_discount_account,'amount'=>$_REQUEST['discount']));


$entry_type='purchase: '. $_REQUEST['notes'];
$entry_link='purchase_id:'.$purchaseid;

journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

$cart_items=json_decode_gfs($_REQUEST['cart_items'],true);

foreach($cart_items as $key => $val)
{
  $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
}


$gtotal_purchase = $_REQUEST['grand_total'];
$gpurchase_discount = $_REQUEST['discount'];
graph_entry($db,$_REQUEST['date'],0,0,$gtotal_purchase,0,0,0,$gpurchase_discount);
print_r($products_array);
update_stock_history($db,$purchaseid,$_REQUEST['date'],'purchase',$products_array);

echo $purchaseid;

try
{
} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
}


?>
