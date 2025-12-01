<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-sale.config.php");


function update_stock_on_location($db,$product_id,$qty,$trans_type,$location_id)
{
/*
    echo '<hr />';
    echo "<h2>product_id: $product_id</h2>";
    echo "<h2>qty: $qty</h2>";
    echo "<h2>Trans Type: $trans_type</h2>";
    echo "<h2>Location id: $location_id</h2>";
    exit();
*/


  $old_stock_on_location = gnr($db,'products','id',$product_id,'stock_on_locations');
  $old_stock_on_location_array = json_decode($old_stock_on_location,true);
  $this_location_handle = 'sl_'.$location_id;

/*
  echo "<h2>Old stock on location array</h2>";
  print_r($old_stock_on_location_array);
  echo "<h2>to location handler</h2>";
  print_r($this_location_handle);
*/

  if(is_array($old_stock_on_location_array))
  {
//      echo "<h3>Old Data for this item already exists.</h3>";
    if(isset($old_stock_on_location_array[$this_location_handle]))
    {
      if(isset($old_stock_on_location_array['sl_'.$location_id]))
      {
//        echo "<h4>key already set for from location</h4>";
        $new_stock_on_location_array = $old_stock_on_location_array;
        if($trans_type=='purchase' || $trans_type == 'sale_return')
        {
          $new_stock_on_location_array[$this_location_handle] = $old_stock_on_location_array[$this_location_handle] + $qty;
        }else{
          $new_stock_on_location_array['sl_'.$location_id] = $old_stock_on_location_array['sl_'.$location_id] - $qty;
        }
      }else{
        if($trans_type=='purchase' || $trans_type == 'sale_return')
        {
          $new_stock_on_location_array[$this_location_handle] = $old_stock_on_location_array[$this_location_handle] + $qty;
        }else{
          $new_stock_on_location_array['sl_'.$location_id] = 0 - $qty;
        }
      }
    }else{
//      echo "<h4>key not found for to location</h4>";
      $old_stock_on_location_array[$this_location_handle] = $qty;

      if($trans_type=='purchase' || $trans_type == 'sale_return')
      {
        $old_stock_on_location_array['sl_'.$location_id] = 0 + $qty;
      }else{
        $old_stock_on_location_array['sl_'.$location_id] = 0 - $qty;
      }

      $new_stock_on_location_array = $old_stock_on_location_array;
    }
  }else{
//    echo "<h3>No Old data exists.</h3>";
    $new_stock_on_location_array[$this_location_handle] = $qty;
    if($trans_type=='purchase' || $trans_type == 'sale_return')
    {
      $new_stock_on_location_array['sl_'.$location_id] = ($qty)*(1);
    }else{
      $new_stock_on_location_array['sl_'.$location_id] = ($qty)*(-1);
    }
  }


//  echo '<h4>new stock on location array</h4>';
//  print_r($new_stock_on_location_array);
  $new_stock_on_location=json_encode($new_stock_on_location_array);
//  print_r($new_stock_on_location);

  $update_qry = "update `products` set `stock_on_locations`=:stock_on_locations where `id`=:product_id and `owner_mobile`=:owner_mobile ";
  $update = $db->prepare($update_qry);

  $update->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
  $update->bindParam('stock_on_locations', $new_stock_on_location);
  $update->bindParam('product_id', $product_id);

  try{
    $update->execute();
    return true;
  }catch (PDOException $e)
  {
    return false;
  }
  return false;

}

$cost_of_sale=0;
$cart_items=json_decode($_REQUEST['cart_items'],true);
foreach($cart_items as $key => $val)
{
  $cost_of_sale= $cost_of_sale+($val['cost_per_unit']*$val['row_qty']);
  $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
  update_stock_on_location($db,$val['item_id'],$val['row_qty'],'sale_return',$_REQUEST['location_id']);
}
$variants_array=array();
$variants_items = json_decode($_REQUEST['variants_json'],true);
if(is_array($variants_items))
{
  foreach ($variants_items as $key => $value) {
    $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['variant_qty'],'qty_before'=>$value['this_variant_qty_before']);
    // code...

  }
}

$sale_qry = "insert into `sale_invoices_returns` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `cartitems`=:cartitems,  `variants_json`=:variants_json,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `tax`=:tax,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `cost_of_sale`=:cost_of_sale,  `remaining_amount`=:remaining_amount, `location_id`=:location_id,  `notes`=:notes, `secondary_json`=:secondary_json ";

//echo $sale_qry;

$status = 'Published';
$secondary_json = json_encode($_REQUEST['secondary_json']);

$stmt = $db->prepare($sale_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('cartitems', $_REQUEST['cart_items']);
$stmt->bindParam('variants_json', $_REQUEST['variants_json']);
$stmt->bindParam('secondary_json', $secondary_json);
$stmt->bindParam('contact_number', $_REQUEST['cname']);
$stmt->bindParam('date',  $_REQUEST['date']);
$stmt->bindParam('sub_total',  $_REQUEST['sub_total']);
$stmt->bindParam('discount',  $_REQUEST['discount']);
$stmt->bindParam('tax',  $_REQUEST['tax']);
$stmt->bindParam('grand_total',  $_REQUEST['grand_total']);
$stmt->bindParam('amount_paid',  $_REQUEST['amount_paid']);
$stmt->bindParam('payment_method',  $_REQUEST['payment_method']);
$stmt->bindParam('cost_of_sale',  $cost_of_sale);
$stmt->bindParam('notes',  $_REQUEST['notes']);
$stmt->bindParam('remaining_amount',  $_REQUEST['remaining_balance']);
$stmt->bindParam('location_id',  $_REQUEST['location_id']);
$stmt->execute();

$saleid=$db->lastInsertId();
$sales_account=$_SESSION['sess_account_keys']['sales'];
$tax_account=$_SESSION['sess_account_keys']['tax'];
$sales_discount_account=$_SESSION['sess_account_keys']['salediscount'];

$entry_type='sale_return: '. $_REQUEST['notes'];
$entry_link='sale_return_id:'.$saleid;




$debit1_amount=($_REQUEST['grand_total']+$_REQUEST['discount']);
$credit2_amount=($_REQUEST['amount_paid']+$_REQUEST['discount']);

$credit_array1=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$debit1_amount));
$debit_array1=array(array('account'=>$sales_account,'amount'=>$_REQUEST['sub_total']),array('account'=>$tax_account,'amount'=>$_REQUEST['tax']));
$journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


$credit_array2=array(array('account'=>$sales_discount_account,'amount'=>$_REQUEST['discount']),array('account'=>$_REQUEST['payment_method'],'amount'=>$_REQUEST['amount_paid']));
$debit_array2=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$credit2_amount));
$journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);


$gsub_total=$_REQUEST['grand_total'];
$gsale_discount = $_REQUEST['discount'];
$gcost_of_sale = $cost_of_sale;
$gprofit = $gsub_total-$gcost_of_sale;


$total_sale_return = ($gsub_total) * (-1);
$total_cost_of_sale_return = ($gcost_of_sale) * (-1);
$total_profit_return = ($gprofit) * (-1);
$total_sale_discount_return = ($gsale_discount) * (-1);

graph_entry($db,$_REQUEST['date'],$gsub_total*(-1),$gcost_of_sale*(-1),0,0,$gprofit*(-1),$gsale_discount*(-1),0);

update_stock_history($db,$saleid,$_REQUEST['date'],'sale_return',$products_array);
if(count($variants_array)>0)
{
  foreach ($variants_array as $key => $value) {
    // code...
    update_stock_variant_history($db,'sale_invoices:'.$saleid,$_REQUEST['date'],'sale',$value);
  }
}
echo $saleid;

try
{
} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
}

?>
