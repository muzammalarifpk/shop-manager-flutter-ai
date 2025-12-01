<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-sale.config.php");


//print_r($_REQUEST);
$cost_of_sale=0;
$cart_items=json_decode($_REQUEST['cart_items'],true);
foreach($cart_items as $key => $val)
{
  $cost_of_sale= $cost_of_sale+($val['cost_per_unit']*$val['row_qty']);
  $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
}

$sale_qry = "insert into `sale_invoices` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `cartitems`=:cartitems,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `cost_of_sale`=:cost_of_sale,  `remaining_amount`=:remaining_amount, `notes`=:notes ";

//echo $sale_qry;
$status = 'Published';


$stmt = $db->prepare($sale_qry);

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
$stmt->bindParam('cost_of_sale',  $cost_of_sale);
$stmt->bindParam('notes',  $_REQUEST['notes']);
$stmt->bindParam('remaining_amount',  $_REQUEST['remaining_balance']);

$stmt->execute();

$saleid=$db->lastInsertId();

$sales_account=$_SESSION['sess_account_keys']['sales'];
$sales_discount_account=$_SESSION['sess_account_keys']['salediscount'];

$credit_array=array(array('account'=>$sales_account,'amount'=>$_REQUEST['sub_total']));
$debit_array=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$_REQUEST['remaining_balance']),array('account'=>$_REQUEST['payment_method'],'amount'=>$_REQUEST['amount_paid']),array('account'=>$sales_discount_account,'amount'=>$_REQUEST['discount']));


$entry_type='Sale: '. $_REQUEST['notes'];
$entry_link='sale_id:'.$saleid;

journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);




$gsub_total=$_REQUEST['grand_total'];
$gsale_discount = $_REQUEST['discount'];
$gcost_of_sale = $cost_of_sale;
$gprofit = $gsub_total-$gcost_of_sale;

graph_entry($db,$_REQUEST['date'],$gsub_total,$gcost_of_sale,0,0,$gprofit,$gsale_discount,0);

update_stock_history($db,$saleid,$_REQUEST['date'],'sale',$products_array);

echo $saleid;

try
{
} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
}


?>
