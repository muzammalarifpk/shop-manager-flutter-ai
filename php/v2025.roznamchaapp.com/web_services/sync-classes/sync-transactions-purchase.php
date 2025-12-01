<?php

function store_transaction_purchase($db,$owner_mobile,$inputData,$deviceID)
{
  $response=[];

  foreach($inputData as $record)
  {
    $response[$record['_id']]=process_single_transactionPurchase($db,$owner_mobile,$record,$deviceID);
  }

  return ($response);

}

function process_single_transactionPurchase($db,$owner_mobile,$postinfo,$deviceID)
{

  $_SESSION['sess_bp_username']=$owner_mobile;
  $table='purchase_invoices';

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
      $response = insert_single_transaction_Purchase($db,$owner_mobile,$postinfo,$deviceID,$table);

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

function insert_single_transaction_Purchase($db,$owner_mobile,$postinfo,$deviceID,$table)
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
  //
  // if(is_array($postinfo['cartItems']))
  // {
  //
  //   foreach($postinfo['cartItems'] as $key => $val)
  //   {
  //     // change cost per unit here... as fifo
  //     $this_cost_of_sale=get_item_total_costofsale_fifo($db,$val['item_id'],$val['qty'],$owner_mobile);
  //
  //     $cost_of_sale= $cost_of_sale+($val['cost_per_unit']*$val['row_qty']);
  //     $cost_per_unit = $this_cost_of_sale / $val['qty'];
  //     // change cost_per_unit here.
  //     $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['unitPrice'],'qty'=>$val['qty'],'qty_before'=>gnrm($db,'products'," `owner_mobile`='$owner_mobile' and `id`='$val[item_id]'", 'available_stock'),'cost_per_unit'=>$cost_per_unit,'unit_measure'=>$val['unit']);
  //
  //     update_stock_on_location($db,$val['item_id'],$val['qty'],'purchase',$location_id);
  //   }
  // }


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

        update_stock_on_location($db,$val['item_id'],$val['qty'],'purchase',$location_id);
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

  $insert_stmt->bindParam('sync', $syncDevice);// extra
  $insert_stmt->bindParam('timestamp', $time);
  $insert_stmt->bindParam('added_by', $postinfo['added_by']);
  $insert_stmt->bindParam('owner_mobile', $owner_mobile);
  $insert_stmt->bindParam('last_updated', $time);
  $insert_stmt->bindParam('status', $postinfo['status']);
  $insert_stmt->bindParam('posid', $posid);// extra
  $insert_stmt->bindParam('cartitems', $cartitems);
  $insert_stmt->bindParam('variants_json', $empty);
  $insert_stmt->bindParam('secondary_json', $empty);
  $insert_stmt->bindParam('service_count', $empty);
  $insert_stmt->bindParam('cart_items_services', $empty);
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
  $insert_stmt->bindParam('cost_of_sale', $cost_of_sale); // extra
  $insert_stmt->bindParam('notes', $postinfo['notes']);
  $insert_stmt->bindParam('attachments', $attachments);



  // journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
  // journal_entry($db,$credit_array_discount,$debit_array_discount,$entry_type,$entry_link);

  $sales_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='purchases' and `status`='Published'",'id');
  $tax_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='All Taxes' and `status`='Published'",'id');
  $purchase_discount_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_head`='Purchase Discount' and `status`='Published'",'id');

  $entry_type='Purchase: '. $postinfo['notes'];
  //$entry_link='sale_id:'.$saleid;

  $debit1_amount=($postinfo['grandTotal']+$postinfo['discountAmount']);
  $credit2_amount=($postinfo['amountReceived']+$postinfo['discountAmount']);

  $credit_array1=array(array('account'=>'c'.$postinfo['customerNumber'],'amount'=>$debit1_amount));
  $debit_array1=array(array('account'=>$sales_account,'amount'=>$postinfo['subTotal']),array('account'=>$tax_account,'amount'=>$postinfo['tax']));
  //$journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


  $credit_array2=array(array('account'=>$purchase_discount_account,'amount'=>$postinfo['discountAmount']),array('account'=>$postinfo['paymentMethod'],'amount'=>$postinfo['amountReceived']));
  $debit_array2=array(array('account'=>'c'.$postinfo['customerNumber'],'amount'=>$credit2_amount));
  //$journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);

  $gsub_total=$postinfo['grandTotal'];
  $gsale_discount = $postinfo['discountAmount'];
  $gcost_of_sale = $cost_of_sale;
  $gprofit = $gsub_total-$gcost_of_sale;


  try
  {

    $insert_stmt->execute();
    $saleid=$db->lastInsertId();

    $entry_link='Purchase_id:'.$saleid;

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
      update_stock_history($db,$saleid,$postinfo['date'],'purchase',$products_array);
    }
    if(count($variants_array)>0)
    {
      foreach ($variants_array as $key => $value) {
        // code...
        update_stock_variant_history($db,'purchase_invoice:'.$saleid,$postinfo['date'],'purchase',$value);
      }
    }


    $response['code'] = 200;
    $response['date_time'] = date('d-M, Y',$time);
    $response['msg'] = $saleid;
    $_SESSION['sess_bp_token'] = get_random(8);

    $response['code']=200;
    $response['msg']='Transcation Purchase created successfully';
    $response['data']=['id_on_server'=>$saleid];


  } catch (PDOException $e) {
      $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
      $response['code'] = 300;
      $response['msg'] = $err;
  }



  return ($response);


}


function update_single_transaction_Purchase($db,$owner_mobile,$postinfo,$deviceID,$table)
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


function get_data2sync_Purchase($db,$owner_mobile,$deviceID)
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
