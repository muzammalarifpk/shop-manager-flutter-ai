<?php
function validate_token($db,$owner_mobile,$token,$api_v)
{
  if($owner_mobile != "" && $token != "" && $api_v==1)
  {
  try{
      $time = time();
      $query = "select * from `user_access` where `owner_mobile`=:owner_mobile and `token`=:token and `expiry`> :expiry";
      $stmt = $db->prepare($query);
      $stmt->bindParam('owner_mobile', $owner_mobile, PDO::PARAM_STR);
      $stmt->bindValue('token', $token, PDO::PARAM_STR);
      $stmt->bindValue('expiry', $time, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count!==1)
        {
          $response['code']=201;
          $response['msg']='Token Invalid.';
        }
        else{
          $response['code']=200;
          $response['msg']='Login successfully.';

        }


    }
    catch (PDOException $e){
      echo $e->getMessage();
    }
  }else{
    $response['code']=300;
    $response['msg']='All Fields are required.';
  }
  return $response['code'];
}

function processSync($response)
{
  return $response;

}

function get_data2sync_products($db,$owner_mobile)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `products` where `owner_mobile`='$owner_mobile' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $products=array();
        foreach ($db->query($qry) as $row)
        {
          $products[]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Products fetched successfully.';
        $response['data']=$products;
      }else{
        $response['code'] = 201;
        $response['msg'] = 'No Products Found.';
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
  if($response['code']==200)
  {
    return $response['data'];
  }else{
    return $response['msg'];
  }
}

function get_data2sync_services($db,$owner_mobile)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `services` where `owner_mobile`='$owner_mobile' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $products=array();
        foreach ($db->query($qry) as $row)
        {
          $products[]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Products fetched successfully.';
        $response['data']=$products;
      }else{
        $response['code'] = 201;
        $response['msg'] = 'No Products Found.';
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
  if($response['code']==200)
  {
    return $response['data'];
  }else{
    return $response['msg'];
  }
}

function get_data2sync_contacts($db,$owner_mobile)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `contacts` where `owner_mobile`='$owner_mobile' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $contacts=array();
        foreach ($db->query($qry) as $row)
        {
          $contacts[]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Contacts fetched successfully.';
        $response['data']=$contacts;
      }else{
        $response['code'] = 201;
        $response['msg'] = 'No contacts Found.';
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
  if($response['code']==200)
  {
    return $response['data'];
  }else{
    return $response['msg'];
  }
}


function get_data2sync_chartofaccount($db,$owner_mobile)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `chartofaccount` where `owner_mobile`='$owner_mobile' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $chartofaccount=array();
        foreach ($db->query($qry) as $row)
        {
          $chartofaccount[]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'chartofaccount fetched successfully.';
        $response['data']=$chartofaccount;
      }else{
        $response['code'] = 201;
        $response['msg'] = 'No chartofaccount Found.';
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
  if($response['code']==200)
  {
    return $response['data'];
  }else{
    return $response['msg'];
  }
}

function get_data2sync_product_variants($db,$owner_mobile)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `product_variants` where `owner_mobile`='$owner_mobile' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $product_variants=array();
        foreach ($db->query($qry) as $row)
        {
          $product_variants[]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'product_variants fetched successfully.';
        $response['data']=$product_variants;
      }else{
        $response['code'] = 201;
        $response['msg'] = 'No product_variants Found.';
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
  if($response['code']==200)
  {
    return $response['data'];
  }else{
    return $response['msg'];
  }
}

function store_data_function_sale_invoices($db,$owner_mobile,$data)
{
  $owner_data=gnr($db,'users','number',$owner_mobile,'default_account_keys');
  $owner_data_array=json_decode($owner_data,true);
  //die();
  $_SESSION['sess_bp_username']=$owner_mobile;
  $cost_of_sale=0;
  $cart_items=json_decode($data['cartitems'],true);
  foreach($cart_items as $key => $val)
  {
    $cost_of_sale= $cost_of_sale+($val['cost_per_unit']*$val['row_qty']);
    $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
  }

  $variants_items = json_decode($data['variants_json'],true);
  $variants_array=array();
  if(is_array($variants_items))
  {
    foreach ($variants_items as $key => $value) {
      $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['variant_qty'],'qty_before'=>$value['this_variant_qty_before']);
      // code...

    }
  }

  $sale_qry = "insert into `sale_invoices` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `posid`=:posid, `cartitems`=:cartitems,  `variants_json`=:variants_json,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `tax`=:tax,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `cost_of_sale`=:cost_of_sale,  `remaining_amount`=:remaining_amount, `notes`=:notes ";

  $stmt = $db->prepare($sale_qry);

  $stmt->bindParam('owner_mobile', $data['owner_mobile']);
  $stmt->bindParam('timestamp', $data['timestamp']);
  $stmt->bindParam('added_by', $data['added_by']);
  $stmt->bindParam('status', $data['status']);
  $stmt->bindParam('last_updated', $data['last_updated']);
  $stmt->bindParam('posid', $data['posid']);
  $stmt->bindParam('cartitems', $data['cartitems']);
  $stmt->bindParam('variants_json',  $data['variants_json']);
  $stmt->bindParam('contact_number',  $data['contact_number']);
  $stmt->bindParam('date',  $data['date']);
  $stmt->bindParam('sub_total',  $data['sub_total']);
  $stmt->bindParam('discount',  $data['discount']);
  $stmt->bindParam('tax',  $data['tax']);
  $stmt->bindParam('grand_total',  $data['grand_total']);
  $stmt->bindParam('amount_paid',  $data['amount_paid']);
  $stmt->bindParam('payment_method',  $data['payment_method']);
  $stmt->bindParam('cost_of_sale',  $cost_of_sale);
  $stmt->bindParam('notes',   $data['notes']);
  $stmt->bindParam('remaining_amount',   $data['remaining_amount']);
  $stmt->execute();

  $saleid=$db->lastInsertId();
  $sales_account=$owner_data_array['sales'];
  $tax_account=$owner_data_array['tax'];
  $sales_discount_account=$owner_data_array['salediscount'];

  $entry_type='Sale: '. $data['notes'];
  $entry_link='sale_id:'.$saleid;

  $debit1_amount=($data['grand_total']+$data['discount']);
  $credit2_amount=($data['amount_paid']+$data['discount']);

  $debit_array1=array(array('account'=>'c'.$data['contact_number'],'amount'=>$debit1_amount));
  $credit_array1=array(array('account'=>$sales_account,'amount'=>$data['sub_total']),array('account'=>$tax_account,'amount'=>$data['tax']));
  $journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


  $debit_array2=array(array('account'=>$sales_discount_account,'amount'=>$data['discount']),array('account'=>$data['payment_method'],'amount'=>$data['amount_paid']));
  $credit_array2=array(array('account'=>'c'.$data['contact_number'],'amount'=>$credit2_amount));
  $journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);

  $gsub_total=$data['grand_total'];
  $gsale_discount = $data['discount'];
  $gcost_of_sale = $cost_of_sale;
  $gprofit = $gsub_total-$gcost_of_sale;

  echo graph_entry($db,$data['date'],$gsub_total,$gcost_of_sale,0,0,$gprofit,$gsale_discount,0);

  update_stock_history($db,$saleid,$data['date'],'sale',$products_array);
  if($variants_array)
  {
    if(is_array($variants_array)){
      foreach ($variants_array as $key => $value) {
        // code...
        update_stock_variant_history($db,'sale_invoices:'.$saleid,$data['date'],'sale',$value);
      }
    }
  }
  $return_data=array('remote_id'=>$saleid,'posid'=>$data['posid']);
  return $return_data;
}


function store_data_function_purchase_invoices($db,$owner_mobile,$data)
{
  $owner_data=gnr($db,'users','number',$owner_mobile,'default_account_keys');
  $owner_data_array=json_decode($owner_data,true);
  //die();
  $_SESSION['sess_bp_username']=$owner_mobile;


  $cost_of_sale=0;
  $cart_items=json_decode($data['cartitems'],true);
  foreach($cart_items as $key => $val)
  {
    $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
  }


  $variants_items = json_decode($data['variants_json'],true);
  $variants_array=array();
  if(is_array($variants_items))
  {
    foreach ($variants_items as $key => $value) {
      $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['variant_qty'],'qty_before'=>$value['this_variant_qty_before']);
      // code...

    }
  }

  $purchase_qry = "insert into `purchase_invoices` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `posid`=:posid, `cartitems`=:cartitems,  `variants_json`=:variants_json,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `tax`=:tax,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method, `remaining_amount`=:remaining_amount, `notes`=:notes ";

  //echo $sale_qry;
  $status = 'Published';


  $stmt = $db->prepare($purchase_qry);

  $stmt->bindParam('owner_mobile', $data['owner_mobile']);
  $stmt->bindParam('timestamp', $data['timestamp']);
  $stmt->bindParam('added_by', $data['added_by']);
  $stmt->bindParam('status', $data['status']);
  $stmt->bindParam('last_updated', $data['last_updated']);
  $stmt->bindParam('posid', $data['posid']);
  $stmt->bindParam('cartitems', $data['cartitems']);
  $stmt->bindParam('variants_json', $data['variants_json']);
  $stmt->bindParam('contact_number', $data['contact_number']);
  $stmt->bindParam('date',  $data['date']);
  $stmt->bindParam('sub_total',  $data['sub_total']);
  $stmt->bindParam('discount',  $data['discount']);
  $stmt->bindParam('tax',  $data['tax']);
  $stmt->bindParam('grand_total',  $data['grand_total']);
  $stmt->bindParam('amount_paid',  $data['amount_paid']);
  $stmt->bindParam('payment_method',  $data['payment_method']);
  $stmt->bindParam('remaining_amount',  $data['remaining_amount']);
  $stmt->bindParam('notes',  $data['notes']);
  $stmt->execute();

  $purchaseid=$db->lastInsertId();
  $purchase_account=$owner_data_array['purchases'];
  $tax_account=$owner_data_array['tax'];
  $purchase_discount_account=$owner_data_array['purchasediscount'];

  $entry_type='Purchase: '. $data['notes'];
  $entry_link='Purchase_id:'.$purchaseid;

  $debit1_amount=($data['grand_total']+$data['discount']);
  $credit2_amount=($data['amount_paid']+$data['discount']);

  $credit_array1=array(array('account'=>'c'.$data['contact_number'],'amount'=>$debit1_amount));
  $debit_array1=array(array('account'=>$purchase_account,'amount'=>$data['sub_total']),array('account'=>$tax_account,'amount'=>$data['tax']));
  $journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


  $credit_array2=array(array('account'=>$purchase_discount_account,'amount'=>$data['discount']),array('account'=>$data['payment_method'],'amount'=>$data['amount_paid']));
  $debit_array2=array(array('account'=>'c'.$data['contact_number'],'amount'=>$credit2_amount));
  $journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);

  $gsub_total=$data['grand_total'];
  $gpurchase_discount = $data['discount'];
  $gcost_of_sale = $cost_of_sale;
  $gprofit = $gsub_total-$gcost_of_sale;

  graph_entry($db,$data['date'],0,0,$gsub_total,0,0,0,$gpurchase_discount);

  update_stock_history($db,$purchaseid,$data['date'],'purchase',$products_array);

  if(is_array($variants_array))
  {
    foreach ($variants_array as $key => $value) {
      // code...
      update_stock_variant_history($db,'purchase_invoice:'.$purchaseid,$data['date'],'purchase',$value);
    }
  }
  $return_data=array('remote_id'=>$purchaseid,'posid'=>$data['posid']);
  return $return_data;
}


function store_data_function_expense($db,$owner_mobile,$data)
{
  $owner_data=gnr($db,'users','number',$owner_mobile,'default_account_keys');
  $owner_data_array=json_decode($owner_data,true);
  //die();
  $_SESSION['sess_bp_username']=$owner_mobile;


  $expense_qry = "insert into `expense` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `posid`=:posid, `expense_type`=:expense_type,  `date`=:date,  `amount`=:amount,  `description`=:description,  `payment_method`=:payment_method ";

  //echo $sale_qry;
  $status = 'Published';


  $stmt = $db->prepare($expense_qry);

  $stmt->bindParam('owner_mobile', $data['owner_mobile']);
  $stmt->bindParam('timestamp', $data['timestamp']);
  $stmt->bindParam('added_by', $data['added_by']);
  $stmt->bindParam('status', $data['status']);
  $stmt->bindParam('last_updated', $data['last_updated']);
  $stmt->bindParam('posid', $data['posid']);

  $stmt->bindParam('expense_type', $data['expense_type']);
  $stmt->bindParam('date',  $data['date']);
  $stmt->bindParam('amount',  $data['amount']);
  $stmt->bindParam('description',  $data['description']);
  $stmt->bindParam('payment_method',  $data['payment_method']);

  if($stmt->execute())
  {

    $payment_account=$data['payment_method'];
    $expense_account=$owner_data_array['expense'];
    $expense_id=$db->lastInsertId();

    $credit_array   =array(array('account'=>$payment_account,'amount'=>$data['amount']));
    $debit_array    =array(array('account'=>$expense_account,'amount'=>$data['amount']));
    $entry_type     ="expense";
    $entry_link     ='expense:'.$db->lastInsertId();

    journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

    graph_entry($db,$data['date'],0,0,0,$data['amount'],0,0,0);

    $return_data=array('remote_id'=>$expense_id,'posid'=>$data['posid']);
    return $return_data;
  }

}


function store_data_function_payments($db,$owner_mobile,$data)
{
  $owner_data=gnr($db,'users','number',$owner_mobile,'default_account_keys');
  $owner_data_array=json_decode($owner_data,true);
  //die();
  $_SESSION['sess_bp_username']=$owner_mobile;


  $sale_qry = "insert into `payments` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `posid`=:posid,  `contact_number`=:contact_number,  `date`=:date,  `amount`=:amount,  `description`=:description,  `payment_method`=:payment_method, `payment_type`=:payment_type ";

  //echo $sale_qry;
  $status = 'Published';


  $stmt = $db->prepare($sale_qry);

  $stmt->bindParam('owner_mobile', $data['owner_mobile']);
  $stmt->bindParam('timestamp', $data['timestamp']);
  $stmt->bindParam('added_by', $data['added_by']);
  $stmt->bindParam('status', $data['status']);
  $stmt->bindParam('last_updated', $data['last_updated']);
  $stmt->bindParam('posid', $data['posid']);

  $stmt->bindParam('contact_number', $data['contact_number']);
  $stmt->bindParam('date',  $data['date']);
  $stmt->bindParam('payment_type',  $data['payment_type']);
  $stmt->bindParam('amount',  $data['amount']);
  $stmt->bindParam('description',  $data['description']);
  $stmt->bindParam('payment_method',  $data['payment_method']);


  if($stmt->execute()){


    $payment_id=$db->lastInsertId();
    $payment_account=$data['payment_method'];
    $to_account='c'.$data['contact_number'];
    $amount= $data['amount'];
    $to= $data['contact_number'];
    $owner_mobile=$data['owner_mobile'];

    if($data['payment_type']=='Paid')
    {
      $credit_array=array(array('account'=>$payment_account,'amount'=>$data['amount']));
      $debit_array=array(array('account'=>$to_account,'amount'=>$data['amount']));
    }else{
      $debit_array=array(array('account'=>$payment_account,'amount'=>$data['amount']));
      $credit_array=array(array('account'=>$to_account,'amount'=>$data['amount']));
    }
    $entry_type='payment.'.$data['payment_type'];
    $entry_link='paymentid:'.$data['contact_number'];
    try{
      journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

      $return_data=array('remote_id'=>$payment_id,'posid'=>$data['posid']);
      return $return_data;

    }catch(Exception $e)
    {
      echo $e->getMessage();
    }
  }
  else
  {
    $err = "<ul><li>Error : some technical issue occur.</li></ul>";
  }


}


?>
