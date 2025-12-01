<?php

function store_transaction_sale($db,$owner_mobile,$inputData,$deviceID)
{
  $response=[];

  foreach($inputData as $record)
  {
    $response[$record['_id']]=process_single_transactionSale($db,$owner_mobile,$record,$deviceID);
  }

  return ($response);

}


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

  $update_qry = "update `products` set `stock_on_locations`=:stock_on_locations, `sync`=:sync where `id`=:product_id and `owner_mobile`=:owner_mobile ";
  $update = $db->prepare($update_qry);

  $empty='';
  $update->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
  $update->bindParam('stock_on_locations', $new_stock_on_location);
  $update->bindParam('sync', $empty);
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

function get_item_total_costofsale_fifo($db, $item_id, $qty,$owner_mobile)
{
//  echo "Getting cost_of_sale: ";
  $available_stock_qty = gnrm($db,'products'," `owner_mobile`='$owner_mobile' and `id`='$item_id'", 'available_stock');
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
      $select_stock_history_qry = "select * from `stock_history` where `product_id`='$item_id' and `owner_mobile`='$_SESSION[sess_bp_username]' and (`in_out`='purchase' || `in_out`='in') order by id desc  limit $starting_limit,$ending_limit ";
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

function process_single_transactionSale($db,$owner_mobile,$postinfo,$deviceID)
{

  $_SESSION['sess_bp_username']=$owner_mobile;
  $table='sale_invoices';

  $response['code']=100;
  $response['msg']='invalid request.';

  $err=[];
  // print_r($postinfo);

  if(empty($postinfo['amountReceived'])){
    $err[]='Amount is Required.';
  }

  if(count($err)==0)
  {
    $response['code']=count($err);
    $response['msg']='no error found.';

    if($postinfo['id_on_server']==null || $postinfo['id_on_server']=='')
    {
      $response = insert_single_transaction_Sale($db,$owner_mobile,$postinfo,$deviceID,$table);

  }else{
    $response['msg']='id on server is not null '.$postinfo['id_on_server'];

    // update already existing product.
    // $response=update_single_transaction_Sale($db,$owner_mobile,$postinfo,$deviceID,$table);

  }


}else{
    $response['code']=count($err);
    $response['msg']=$err;
  }



  return json_encode($response);

}

function insert_single_transaction_Sale($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $insert_qry = "insert into `$table` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,`sync`=:sync, `posid`=:posid,  `cartitems`=:cartitems,  `variants_json`=:variants_json,  `secondary_json`=:secondary_json,  `service_count`=:service_count, `cart_items_services`=:cart_items_services, `contact_number`=:contact_number, `date`=:date, `sub_total`=:sub_total, `discount`=:discount, `tax`=:tax, `grand_total`=:grand_total, `amount_paid`=:amount_paid, `payment_method`=:payment_method, `remaining_amount`=:remaining_amount, `location_id`=:location_id, `cost_of_sale`=:cost_of_sale, `notes`=:notes, `attachments`=:attachments ";


  $insert_stmt = $db->prepare($insert_qry);



  $owner_mobile=$postinfo['owner_mobile'];
  $empty='';

  $time=time();
  $last_updated=time();

  $syncDevice = ','.$deviceID.',';
  $posid = $deviceID.'-'.$postinfo['_id'];
  // $cartitems = json_encode($postinfo['cartItems']);

  //print_r($_REQUEST);
  $location_id = '';
  $cost_of_sale=0;
  // $cart_items=json_decode($postinfo['cartItems'],true);
  // $lend_inventory_array=json_decode($postinfo['lend_inventory_json'],true);
  $lend_inventory_array=array();
  $lend_inventory_data = array();
  $insert_lend_inventory_qry = "insert into `lend_inventory` (`owner_mobile`, `timestamp`,  `added_by`,  `status`,  `last_updated`, `contact_number`, `invoice_id`, `invoice_type`, `item_id`, `old_qty`, `new_qty`, `total_qty`, `deposit_qty`, `grand_total_qty`) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

  if(is_array($postinfo['cartItems']))
  {

    foreach($postinfo['cartItems'] as $key => $val)
    {
      // change cost per unit here... as fifo
      $this_cost_of_sale=get_item_total_costofsale_fifo($db,$val['item_id'],$val['qty'],$owner_mobile);

      $cost_of_sale= $cost_of_sale+($this_cost_of_sale);
      $cost_per_unit = $this_cost_of_sale / $val['qty'];
      // change cost_per_unit here.
      $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['unitPrice'],'qty'=>$val['qty'],'qty_before'=>gnrm($db,'products'," `owner_mobile`='$owner_mobile' and `id`='$val[item_id]'", 'available_stock'),'cost_per_unit'=>$cost_per_unit,'unit_measure'=>$val['unit']);

      update_stock_on_location($db,$val['item_id'],$val['qty'],'sale',$location_id);
    }
  }

  $variants_array=array();
  $variants_items=array();
  // $variants_items = json_decode($_REQUEST['variants_json'],true);
  if(is_array($variants_items))
  {
    foreach ($variants_items as $key => $value) {
      $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['variant_qty'],'qty_before'=>$value['this_variant_qty_before']);
      // code...

    }
  }

  // $cart_items_services = json_decode($postinfo['cart_items_services'],true);
  // $service_count = count($cart_items_services);
  $service_count = '0';
  $status = 'Published';


  $cartitems=[];

  foreach ($postinfo['cartItems'] as $key => $value) {
    // code...
    $this_item=[];
    $this_item['item_id']=$value['item_id'];
    $this_item['row_rate']=$value['unitPrice'];
    $this_item['row_qty']=$value['qty'];
    $this_item['qty_before']=$value['qty'];
    $this_item['cost_per_unit']=get_item_total_costofsale_fifo($db,$value['item_id'],$value['qty'],$owner_mobile);
    $this_item['unit_measure']=$value['unit'];
    $cartitems[]=$this_item;
  }

  $cartitems=json_encode($cartitems);

  $variants_json = '';
  $secondary_json = '';
  $cart_items_services = '';
  $location_id = '';
  $attachments = '';

  $insert_stmt->bindParam('sync', $syncDevice);
  $insert_stmt->bindParam('timestamp', $time);
  $insert_stmt->bindParam('added_by', $postinfo['added_by']);
  $insert_stmt->bindParam('owner_mobile', $owner_mobile);
  $insert_stmt->bindParam('last_updated', $time);
  $insert_stmt->bindParam('status', $postinfo['status']);

  $insert_stmt->bindParam('posid', $posid);
  $insert_stmt->bindParam('cartitems', $cartitems);
  $insert_stmt->bindParam('variants_json', $postinfo['amountReceived']);
  $insert_stmt->bindParam('secondary_json', $postinfo['amountReceived']);
  $insert_stmt->bindParam('service_count', $postinfo['amountReceived']);
  $insert_stmt->bindParam('cart_items_services', $postinfo['amountReceived']);
  $insert_stmt->bindParam('contact_number', $postinfo['customerNumber']);
  $insert_stmt->bindParam('date', $postinfo['date']);
  $insert_stmt->bindParam('sub_total', $postinfo['subTotal']);
  $insert_stmt->bindParam('discount', $postinfo['discountAmount']);
  $insert_stmt->bindParam('tax', $postinfo['tax']);
  $insert_stmt->bindParam('grand_total', $postinfo['grandTotal']);
  $insert_stmt->bindParam('amount_paid', $postinfo['amountReceived']);
  $insert_stmt->bindParam('payment_method', $postinfo['paymentMethod']);
  $insert_stmt->bindParam('remaining_amount', $postinfo['amountDue']);
  $insert_stmt->bindParam('location_id', $location_id);
  $insert_stmt->bindParam('cost_of_sale', $cost_of_sale);
  $insert_stmt->bindParam('notes', $postinfo['notes']);
  $insert_stmt->bindParam('attachments', $attachments);



  // journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
  // journal_entry($db,$credit_array_discount,$debit_array_discount,$entry_type,$entry_link);

  $sales_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='Sales' and `status`='Published'",'id');
  $tax_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='All Taxes' and `status`='Published'",'id');
  $sales_discount_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='Sale Discount' and `status`='Published'",'id');

  $entry_type='Sale: '. $postinfo['notes'];
  //$entry_link='sale_id:'.$saleid;

  $debit1_amount=($postinfo['grandTotal']+$postinfo['discountAmount']);
  $credit2_amount=($postinfo['amountReceived']+$postinfo['discountAmount']);

  $debit_array1=array(array('account'=>'c'.$postinfo['customerNumber'],'amount'=>$debit1_amount));
  $credit_array1=array(array('account'=>$sales_account,'amount'=>$postinfo['subTotal']),array('account'=>$tax_account,'amount'=>$postinfo['tax']));
  //$journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


  $debit_array2=array(array('account'=>$sales_discount_account,'amount'=>$postinfo['discountAmount']),array('account'=>$postinfo['paymentMethod'],'amount'=>$postinfo['amountReceived']));
  $credit_array2=array(array('account'=>'c'.$postinfo['customerNumber'],'amount'=>$credit2_amount));
  //$journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);

  $gsub_total=$postinfo['grandTotal'];
  $gsale_discount = $postinfo['discountAmount'];
  $gcost_of_sale = $cost_of_sale;
  $gprofit = $gsub_total-$gcost_of_sale;


  try
  {

    $insert_stmt->execute();
    $saleid=$db->lastInsertId();

    $entry_link='sale_id:'.$saleid;

    $journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);
    $journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);


    if(is_array($lend_inventory_array))
    {
    //  print_r($lend_inventory_array);
      foreach ($lend_inventory_array as $lend_key => $lend_value) {
        // handling lend inventory... save to database...

          $lend_inventory_data[]=[$owner_mobile,$time,$owner_mobile,$status,$time,$postinfo['customerNumber'],$saleid,'sale',$lend_value['lend_id'],$lend_value['old_lend_qty'],$lend_value['new_lend_qty'],$lend_value['total_lend_qty'],$lend_value['deposit_lend_qty'],$lend_value['grand_total_lend_qty']];


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

    graph_entry($db,$postinfo['date'],$gsub_total,$gcost_of_sale,0,0,$gprofit,$gsale_discount,0);

    if(isset($products_array))
    {
      update_stock_history($db,$saleid,$postinfo['date'],'sale',$products_array);
    }
    if(count($variants_array)>0)
    {
      foreach ($variants_array as $key => $value) {
        // code...
        update_stock_variant_history($db,'sale_invoices:'.$saleid,$postinfo['date'],'sale',$value);
      }
    }


    $response['code'] = 200;
    $response['date_time'] = date('d-M, Y',$time);
    $response['msg'] = $saleid;
    $_SESSION['sess_bp_token'] = get_random(8);

    $response['code']=200;
    $response['msg']='Transcation Sale created successfully';
    $response['data']=['id_on_server'=>$saleid];


  } catch (PDOException $e) {
      $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
      $response['code'] = 300;
      $response['msg'] = $err;
  }



  return ($response);


}


function update_single_transaction_Sale($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $empty='';

  $owner_mobile=$postinfo['owner_mobile'];
  $status=$postinfo['status'];
  $last_updated=$postinfo['last_updated'];
  $sync=$deviceID;

  $amount=$postinfo['amountReceived'];
  $discount=$postinfo['discountAmount'];
  $date=$postinfo['date'];
  $contact_number=$postinfo['contact_number'];
  $payment_method=$postinfo['paymentMethod'];
  $payment_type=$postinfo['moduleType'];
  $description=$postinfo['description'];
  $attachments=$postinfo['attachments'];


  $id=$postinfo['id_on_server'];


  $update_qry="update `$table` set `status`='$status',`last_updated`='$last_updated', `sync`=',$sync,', `amount`='$amount', `discount`='$discount',  `date`='$date', `contact_number`='$contact_number',  `payment_method`='$payment_method', `payment_type`='$payment_type',  `description`='$description', `attachments`='$attachments' where `owner_mobile`='$owner_mobile' and `id`='$id'";

  $stmt=$db->prepare($update_qry);

  try{

  $stmt->execute();

  $response['code']=200;
  $response['msg']='Transcation Sale updated successfully.';
  $response['data']=['id_on_server'=>$id];


}catch(Exception $e){

  $response['code']=300;
  $response['msg']='error updating Sale Transcation.';
  $response['data']=$e;

}

return ($response);

}






//////////////////////////////////////////


function get_data2sync_Sale($db,$owner_mobile,$deviceID)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `sale_invoices` where `owner_mobile`='$owner_mobile' and  (`sync` is NULL || `sync` NOT LIKE '%$deviceID%' )";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $Sales=array();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
          $Sales[]=json_encode($row);
          $response['data'][$row['id']]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Transcation Sale fetched successfully.';
        $response['count']=count($Sales);
        }else{
        $response['code'] = 201;
        $response['msg'] = 'No Transcation Sale Found.';
      }
    }
    catch(PDOException $e)
    {
      $response['code'] = 300;
      $response['msg'] = $e->getMessage();
    }
  }else{
    $response['code'] = 100;
    $response['msg'] = 'owner_mobile not passed';
  }

  return $response;
}


?>
