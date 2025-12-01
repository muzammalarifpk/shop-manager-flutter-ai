<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-sale.config.php");
require_once('includes/libs/telenor-smsapi.php');

// set_time_limit(600);

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';


function update_stock_on_location($db,$product_id,$qty,$trans_type,$location_id)
{

    // echo '<hr />';
    // echo "<h2>product_id: $product_id</h2>";
    // echo "<h2>qty: $qty</h2>";
    // echo "<h2>Trans Type: $trans_type</h2>";
    // echo "<h2>Location id: $location_id</h2>";
    // exit();



  $old_stock_on_location = gnr($db,'products','id',$product_id,'stock_on_locations');
  $old_stock_on_location_array = json_decode_gfs($old_stock_on_location,true);
  $this_location_handle = 'sl_'.$location_id;


  // echo "<h2>Old stock on location array</h2>";
  // print_r($old_stock_on_location_array);
  // echo "<h2>to location handler</h2>";
  // print_r($this_location_handle);
  //
  // exit();

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

function get_item_total_costofsale_fifo($db, $item_id, $qty)
{
//  echo "Getting cost_of_sale: ";
  $available_stock_qty = gnrm($db,'products'," `owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$item_id'", 'available_stock');
//  echo 'Available Qty: '.$available_stock_qty;

  $cost_of_sale = 0;
  $selected_stock_qty = 0;
  $starting_limit=0;
  $ending_limit=1;
  $cost_array=[];
  $available_stock_cost_array=[];
  $selected_cost_array=[];
  $remain_qty=$available_stock_qty;
  $this_element_qty=0;

  while($available_stock_qty>$selected_stock_qty)
  {
    if($selected_stock_qty<=$available_stock_qty)
    {
      $select_stock_history_qry = "select * from `stock_history` where `product_id`='$item_id' and `owner_mobile`='$_SESSION[sess_bp_username]' and (`in_out`='purchase' || `in_out`='in' || `in_out`='activity_output') order by id desc  limit $starting_limit,$ending_limit ";
      foreach ($db->query($select_stock_history_qry) as $stock_row)
      {
        $cost_array[$stock_row['id']]=['unit_cost'=>$stock_row['unit_price'],'qty'=>$stock_row['qty']];
        $selected_stock_qty+=$stock_row['qty'];
      }
      $starting_limit+=1;
    }
  }

  //echo json_encode($cost_array);

  foreach ($cost_array as $key => $value)
  {
    // code...
      if($remain_qty>0)
      {
//        echo "unit_cost: $value[unit_cost] , qty: $value[qty] --------- ";

        if($remain_qty>=$value['qty'])
        {
          $this_element_qty = $value['qty'];
        }else{
          $this_element_qty = $remain_qty;
        }

        $available_stock_cost_array[]=['qty'=>$this_element_qty, 'unit_cost'=>$value['unit_cost']];
        $remain_qty = $remain_qty - $value['qty'];

//        $cost_of_sale+=($this_element_qty*$value['unit_cost']);
      }
  }

  $remain_qty=$qty;
  //echo json_encode($available_stock_cost_array);
  asort($available_stock_cost_array);
  //echo json_encode($available_stock_cost_array);

  $this_stock_element_qty=0;
  foreach ($available_stock_cost_array as $stock_key => $stock_value) {
    // code...
    if($remain_qty>0)
    {
      if($remain_qty>=$stock_value['qty'])
      {
        $this_stock_element_qty=$stock_value['qty'];
      }else{
        $this_stock_element_qty=$remain_qty;
      }

      $selected_cost_array[]=['unit_cost'=>$stock_value['unit_cost'], 'this_qty'=>$this_stock_element_qty,'this_total_cost'=>($this_stock_element_qty*$stock_value['unit_cost'])];

      $remain_qty = $remain_qty - $stock_value['qty'];
      $cost_of_sale+= ($this_stock_element_qty*$stock_value['unit_cost']);
    }
  }

//echo json_encode($selected_cost_array);
//echo $cost_of_sale;
return $cost_of_sale;

}

//print_r($_REQUEST);
$cost_of_sale=0;
$cart_items=json_decode($_REQUEST['cart_items'],true);
$lend_inventory_array=json_decode($_REQUEST['lend_inventory_json'],true);
$lend_inventory_data = array();
$insert_lend_inventory_qry = "insert into `lend_inventory` (`owner_mobile`, `timestamp`,  `added_by`,  `status`,  `last_updated`, `contact_number`, `invoice_id`, `invoice_type`, `item_id`, `old_qty`, `new_qty`, `total_qty`, `deposit_qty`, `grand_total_qty`) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";



if(is_array($cart_items))
{

  foreach($cart_items as $key => $val)
  {
    // change cost per unit here... as fifo
    $this_cost_of_sale=get_item_total_costofsale_fifo($db,$val['item_id'],$val['row_qty']);

    $cost_of_sale= $cost_of_sale+($this_cost_of_sale);
    $cost_per_unit = $this_cost_of_sale / $val['row_qty'];
    // change cost_per_unit here.
    $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$cost_per_unit,'unit_measure'=>$val['unit_measure']);

    update_stock_on_location($db,$val['item_id'],$val['row_qty'],'sale',$_REQUEST['location_id']);
  }
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
$cart_items_services = json_decode_gfs($_REQUEST['cart_items_services'],true);
$service_count = count($cart_items_services);

$sale_qry = "insert into `sale_invoices` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `cartitems`=:cartitems,  `variants_json`=:variants_json,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `tax`=:tax,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `cost_of_sale`=:cost_of_sale,  `remaining_amount`=:remaining_amount, `notes`=:notes, `attachments`=:attachments, `location_id`=:location_id,  `secondary_json`=:secondary_json, `cart_items_services`=:cart_items_services, `service_count`=:service_count";

//echo $sale_qry;
$status = 'Published';
if(isset($_REQUEST['secondary_json']))
{
  $secondary_json = json_encode_gfs($_REQUEST['secondary_json']);
}
$wherem="`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$_REQUEST[cname]'";
$old_balance = gnrm($db,'contacts',$wherem,'balance');

$stmt = $db->prepare($sale_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $status);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('cartitems', $_REQUEST['cart_items']);
$stmt->bindParam('cart_items_services', $_REQUEST['cart_items_services']);
$stmt->bindParam('service_count', $service_count);
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
$stmt->bindParam('attachments',  $_SESSION['sess_bp_token']);
$stmt->bindParam('remaining_amount',  $_REQUEST['remaining_balance']);
$stmt->bindParam('location_id',  $_REQUEST['location_id']);
$oldtoken=$_SESSION['sess_bp_token'];
//$stmt->execute();

//$saleid=$db->lastInsertId();
$sales_account=$_SESSION['sess_account_keys']['sales'];
$tax_account=$_SESSION['sess_account_keys']['tax'];
$sales_discount_account=$_SESSION['sess_account_keys']['salediscount'];

$entry_type='Sale: '. $_REQUEST['notes'];
//$entry_link='sale_id:'.$saleid;

$debit1_amount=($_REQUEST['grand_total']+$_REQUEST['discount']);
$credit2_amount=($_REQUEST['amount_paid']+$_REQUEST['discount']);

$debit_array1=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$debit1_amount));
$credit_array1=array(array('account'=>$sales_account,'amount'=>$_REQUEST['sub_total']),array('account'=>$tax_account,'amount'=>$_REQUEST['tax']));
//$journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


$debit_array2=array(array('account'=>$sales_discount_account,'amount'=>$_REQUEST['discount']),array('account'=>$_REQUEST['payment_method'],'amount'=>$_REQUEST['amount_paid']));
$credit_array2=array(array('account'=>'c'.$_REQUEST['cname'],'amount'=>$credit2_amount));
//$journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);

$gsub_total=$_REQUEST['grand_total'];
$gsale_discount = $_REQUEST['discount'];
$gcost_of_sale = $cost_of_sale;
$gprofit = $gsub_total-$gcost_of_sale;

try
{

  $stmt->execute();
  $saleid=$db->lastInsertId();
  $entry_link='sale_id:'.$saleid;
  $journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);
  $journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);


  if(is_array($lend_inventory_array))
  {
  //  print_r($lend_inventory_array);
    foreach ($lend_inventory_array as $lend_key => $lend_value) {
      // handling lend inventory... save to database...

        $lend_inventory_data[]=[$_SESSION['sess_bp_username'],$time,$_SESSION['sess_bp_emp'],$status,$time,$_REQUEST['cname'],$saleid,'sale',$lend_value['lend_id'],$lend_value['old_lend_qty'],$lend_value['new_lend_qty'],$lend_value['total_lend_qty'],$lend_value['deposit_lend_qty'],$lend_value['grand_total_lend_qty']];


    }
    $lend_stmt = $db->prepare($insert_lend_inventory_qry);

    try {

      $db->beginTransaction();
//      echo 'beginTransaction';
      foreach ($lend_inventory_data as $lend_row)
      {
          $lend_stmt->execute($lend_row);
//          print_r($lend_row);
      }
  //    echo 'commit lend';

      $db->commit();
    }catch (Exception $e){
      $db->rollback();
      throw $e;
  //    echo 'throw error lend.';
    }
  }

  graph_entry($db,$_REQUEST['date'],$gsub_total,$gcost_of_sale,0,0,$gprofit,$gsale_discount,0);

  if(isset($products_array))
  {
    update_stock_history($db,$saleid,$_REQUEST['date'],'sale',$products_array);
  }
  if(count($variants_array)>0)
  {
    foreach ($variants_array as $key => $value) {
      // code...
      update_stock_variant_history($db,'sale_invoices:'.$saleid,$_REQUEST['date'],'sale',$value);
    }
  }


  $response['code'] = 200;
  $response['date_time'] = date('d-M, Y',$time);
  $response['msg'] = $saleid;
  $_SESSION['sess_bp_token'] = get_random(8);


  $country_code =  gnr($db,'contacts','number',$_REQUEST['cname'],'country_code');
  $mobile_number = gnr($db,'contacts','number',$_REQUEST['cname'],'mobile');

  $cname = gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$_REQUEST[cname]'",'name');

  $new_bal = gnrm($db,'contacts',$wherem,'balance');

$messageText = substr($cname,0,11)."
Bill added
Total: $_REQUEST[grand_total]
Paid: $_REQUEST[amount_paid]
Bal: $_REQUEST[remaining_balance]
Old Bal: $old_balance
New Bal: $new_bal

".substr($_SESSION['sess_bp_name'],0,10)."
$_SESSION[sess_bp_username]

baseplan.pk/vi/?t=".$oldtoken;

  //sendtoPK($country_code,$mobile_number,$messageText,$mask,$db);



} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode_gfs($response));


?>
