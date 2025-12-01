<?php

function update_single_product($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $empty='';

  $status=$postinfo['status'];
  $name=$postinfo['title'];
  $category=$empty;
  $secondary_units=[];

  if(array_key_exists('secondary_unit',$postinfo))
  {
    foreach ($postinfo['secondary_unit'] as $key => $value) {
      // Secondary units array...
      if($postinfo['primary_unit_qty'][$key]!='')
      {
        $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$postinfo['primary_unit_qty'][$key]);
      }
    }
  }

  $lend_inventory = 'off';

  if(array_key_exists('lend_inventory',$postinfo))
  {
    $lend_inventory = $postinfo['lend_inventory'];
  }

  $secondary_units_count = count($secondary_units);
  $secondary_units_json = json_encode($secondary_units);

  $tax = '';
  if(isset($postinfo['tax'])){$tax=$postinfo['tax'];}

  $description=$empty;
  $measuring_unit=$postinfo['unit_measure'];
  $min_stock_limit=$postinfo['min_stock'];
  $max_stock_limit=$empty;
  $purchase_cost=$postinfo['purchaseCost'];
  $sale_price=$postinfo['retail_price'];
  $wholesale_price=$postinfo['wholesale_price'];
  $sku=$empty;
  $barcode=$postinfo['item_code'];
  $tags=','.$postinfo['tags'].',';
  $notes=$postinfo['note'];
  $salesman_commission = '';
  $agent_commission = '';
  if(isset($postinfo['salesman_commission'])){$salesman_commission=$postinfo['salesman_commission'];}
  if(isset($postinfo['agent_commission'])){$agent_commission=$postinfo['agent_commission'];}


  $id=$postinfo['id_on_server'];

  $secondary_units=[];
  if(array_key_exists('secondary_unit',$postinfo))
  {
    foreach ($postinfo['secondary_unit'] as $key => $value) {
      // Secondary units array...
      if($postinfo['primary_unit_qty'][$key]!='')
      {
        $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$postinfo['primary_unit_qty'][$key]);
      }
    }
  }

  $secondary_units_count = count($secondary_units);
  $secondary_units = json_encode($secondary_units);



  $update_qry="update `$table` set `status`='$status',`name`='$name', `category`='$category', `tax`='$tax', `lend_inventory`='$lend_inventory',  `sync`='$deviceID', `description`='$description', `measuring_unit`='$measuring_unit', `min_stock_limit`='$min_stock_limit', `max_stock_limit`='$max_stock_limit',  `purchase_cost`='$purchase_cost', `sale_price`='$sale_price',  `wholesale_price`='$wholesale_price', `sku`='$sku', `barcode`='$barcode', `tags`='$tags', `notes`='$notes', `secondary_unit_count`='$secondary_units_count', `secondary_units`='$secondary_units', `salesman_commission`='$salesman_commission', `agent_commission`='$agent_commission' where `owner_mobile`='$owner_mobile' and `id`='$id'";

  $stmt=$db->prepare($update_qry);

  try{

  $stmt->execute();

  $response['code']=200;
  $response['msg']='product updated successfully.';
  $response['data']=['id_on_server'=>$id];


}catch(Exception $e){

  $response['code']=300;
  $response['msg']='error updating product.';
  $response['data']=$e;

}

return ($response);

}

function insert_single_product($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $insert_qry = "insert into `$table` set `name`=:name,  `category`=:category,  `sku`=:sku,  `barcode`=:barcode,  `salesman_commission`=:salesman_commission,  `agent_commission`=:agent_commission,  `variants`=:variants,  `description`=:description,  `measuring_unit`=:measuring_unit,  `tax`=:tax,  `available_stock`=:available_stock,  `min_stock_limit`=:min_stock_limit,  `max_stock_limit`=:max_stock_limit,  `purchase_cost`=:purchase_cost,  `sale_price`=:sale_price,  `wholesale_price`=:wholesale_price,  `tags`=:tags,  `status`=:status,  `notes`=:notes,  `last_updated`=:last_updated,  `owner_mobile`=:owner_mobile,  `added_by`=:added_by,  `timestamp`=:timestamp,  `sync`=:sync ";

  $insert_stmt = $db->prepare($insert_qry);

  $owner_mobile=$postinfo['owner_mobile'];
  $empty='';

  $time=time();
  $last_updated=time();

  $insert_stmt->bindParam('timestamp', $time);
  $insert_stmt->bindParam('owner_mobile', $owner_mobile);
  $insert_stmt->bindParam('name', $postinfo['title']);
  $insert_stmt->bindParam('category', $empty);
  $insert_stmt->bindParam('sku', $empty);
  $insert_stmt->bindParam('barcode', $postinfo['item_code']);
  $insert_stmt->bindParam('salesman_commission', $empty);
  $insert_stmt->bindParam('agent_commission', $empty);
  $insert_stmt->bindParam('variants',$empty);
  $insert_stmt->bindParam('description', $empty);
  $insert_stmt->bindParam('measuring_unit', $postinfo['unit_measure']);
  $insert_stmt->bindParam('tax', $empty);
  $insert_stmt->bindParam('available_stock', $postinfo['availableStock']);
  $insert_stmt->bindParam('min_stock_limit', $postinfo['min_stock']);
  $insert_stmt->bindParam('max_stock_limit', $empty);
  $insert_stmt->bindParam('purchase_cost', $postinfo['purchaseCost']);
  $insert_stmt->bindParam('sale_price', $postinfo['retail_price']);
  $insert_stmt->bindParam('wholesale_price', $postinfo['wholesale_price']);
  $insert_stmt->bindParam('tags', $postinfo['tags']);
  $insert_stmt->bindParam('status', $postinfo['status']);
  $insert_stmt->bindParam('notes', $postinfo['note']);
  $insert_stmt->bindParam('last_updated', $time);
  $insert_stmt->bindParam('added_by', $postinfo['added_by']);
  $insert_stmt->bindParam('sync', $deviceID);

  $insert_stmt->execute();

  $product_id=$db->lastInsertId();



  $qry_stock_history="insert into `stock_history` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `product_id`=:product_id,  `date`=:date,  `qty`=:qty,  `in_out`=:in_out,  `qty_before`=:qty_before,  `qty_after`=:qty_after,  `measuring_unit`=:measuring_unit,  `unit_price`=:unit_price,  `total_price`=:total_price ";

  $stock_history=$db->prepare($qry_stock_history);


  $status= 'Published';
  $qty= $postinfo['availableStock'];
  $in_out = 'in';
  $qty_before= 0;
  $qty_after = $qty;
  $description = 'Begining Balance of item';
  $measuring_unit=$postinfo['unit_measure'];
  $unit_price=$postinfo['purchaseCost'];
  $total_price=$postinfo['purchaseCost']*$qty;
  $date=date("Y-m-d");

  $stock_history->bindParam('owner_mobile',$owner_mobile);
  $stock_history->bindParam('timestamp',$time);
  $stock_history->bindParam('added_by',$postinfo['added_by']);
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

  //
  // $capital_account=$_SESSION['sess_account_keys']['capital'];
  // $inventory_account=$_SESSION['sess_account_keys']['inventory'];

  $capital_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_type`='Equity' and `status`='Published'",'id');
  $inventory_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_type`='Assets' and `status`='Published'",'id');

  $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
  $debit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
  $entry_type='Create new Product with beginning balance.';
  $entry_link='product:'.$product_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  $response['code']=200;
  $response['msg']='Product created successfully';
  $response['data']=['id_on_server'=>$product_id];


  return ($response);


}

function process_single_product($db,$owner_mobile,$postinfo,$deviceID)
{

  $all_fields = array();
  $all_fields['name']=array('name'=>'Product Name','is_req'=>1,'type'=>'text');
  $all_fields['category']=array('name'=>'Category','is_req'=>0,'type'=>'text');
  $all_fields['sku']=array('name'=>'SKU','is_req'=>0,'type'=>'text');
  $all_fields['barcode']=array('name'=>'barcode','is_req'=>0,'type'=>'text');
  $all_fields['salesman_commission']=array('name'=>'salesman commission','is_req'=>0,'type'=>'text');
  $all_fields['agent_commission']=array('name'=>'Agent Commission','is_req'=>0,'type'=>'text');
  $all_fields['variants']=array('name'=>'Variants','is_req'=>0,'type'=>'dropdown');
  $all_fields['description']=array('name'=>'Description','is_req'=>0,'type'=>'textarea');
  $all_fields['measuring_unit']=array('name'=>'Measuring Unit','is_req'=>1,'type'=>'dropdown');
  $all_fields['tax']=array('name'=>'Tax Type','is_req'=>0,'type'=>'dropdown');
  $all_fields['available_stock']=array('name'=>'Available Stock','is_req'=>1,'type'=>'number');
  $all_fields['min_stock_limit']=array('name'=>'Minimum Stock Limit','is_req'=>0,'type'=>'number');
  $all_fields['max_stock_limit']=array('name'=>'Maximum Stock Limit','is_req'=>0,'type'=>'number');
  $all_fields['purchase_cost']=array('name'=>'purchase cost','is_req'=>1,'type'=>'number');
  $all_fields['sale_price']=array('name'=>'sale price','is_req'=>1,'type'=>'number');
  $all_fields['wholesale_price']=array('name'=>'Wholesale price','is_req'=>1,'type'=>'number');
  $all_fields['tags']=array('name'=>'Tags','is_req'=>0,'type'=>'tags');
  $all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown');
  $all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

  $_SESSION['sess_bp_username']=$owner_mobile;
  $table='products';

  $response['code']=100;
  $response['msg']='invalid request.';

  $err=[];
  $secondary_units=[];
  if(array_key_exists('secondary_unit',$postinfo))
  {
    foreach ($postinfo['secondary_unit'] as $key => $value) {
      // Secondary units array...
      if($postinfo['primary_unit_qty'][$key]!='')
      {
        $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$postinfo['primary_unit_qty'][$key]);
      }
    }
  }

  if(array_key_exists('lend_inventory',$postinfo))
  {
    $lend_inventory = $postinfo['lend_inventory'];
  }

  $secondary_units_count = count($secondary_units);

  $product_variants=[];

  if(!isset($postinfo['variants_fields']))
  {
    $postinfo['product_variants']='';
  }else{

    foreach ($postinfo['variants_fields'] as $key => $value) {
        $variant_name='variant_'.$value;
        $product_variants[]=['name'=>$value,'available_stock'=>$postinfo[$variant_name]];
    }
    $postinfo['product_variants']=$product_variants;
  }

  // print_r($postinfo);

  if(empty($postinfo['title'])){
    $err[]='Product Name is Required.';
  }

  if(empty($postinfo['item_code'])){
    $err[]='Item_code is Required.';
  }

  if(empty($postinfo['retail_price'])){
    $err[]='retail price is Required.';
  }

  if(empty($postinfo['unit_measure'])){
    $err[]='unit_measure is Required.';
  }

  if(empty($postinfo['availableStock'])){
    $err[]='availableStock is Required.';
  }

  if(count($err)==0)
  {
    $response['code']=count($err);
    $response['msg']='no error found.';

    if($postinfo['id_on_server']==null)
    {
      $response['msg']='id on server is null';
      if($postinfo['item_code']=='' || $postinfo['item_code']==null)
      {

        $response[] = insert_single_product($db,$owner_mobile,$postinfo,$deviceID,$table);


      }else{
        $published_status='Published';
        $unique_barcode_qry = "select * from `$table` where `owner_mobile`=:owner_mobile and `barcode`=:barcode and `status`=:status";
        $stmt = $db->prepare($unique_barcode_qry);
        $stmt->bindParam('owner_mobile', $postinfo['owner_mobile'], PDO::PARAM_STR);
        $stmt->bindParam('barcode', $postinfo['item_code'], PDO::PARAM_STR);
        $stmt->bindParam('status', $published_status, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();

        if($count == 0)
        {
          // insert item
          $response = insert_single_product($db,$owner_mobile,$postinfo,$deviceID,$table);

       }else{
         // return error...
         $err[]='Item code must be unique. count:' .$count;
         while($row   = $stmt->fetch(PDO::FETCH_ASSOC))
         {
           $err[]='id: '.$row['id'].' name: '.$row['name'].' barcode: '.$row['barcode'];
         }

         $response['code']=303;
         $response['msg']=$err;

       }



        }

  }else{
    $response['msg']='id on server is not null '.$postinfo['id_on_server'];

    // update already existing product.
    $response=update_single_product($db,$owner_mobile,$postinfo,$deviceID,$table);

  }


}else{
    $response['code']=count($err);
    $response['msg']=$err;
  }



  return json_encode($response);

}

function store_products($db,$owner_mobile,$inputData,$deviceID)
{
  $response=[];

  foreach($inputData as $product)
  {
    $response[$product['_id']]=process_single_product($db,$owner_mobile,$product,$deviceID);
  }

  return ($response);

}

//////////////////////////////////////////



function get_data2sync_products($db,$owner_mobile,$deviceID)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `products` where `owner_mobile`='$owner_mobile' and `sync` NOT LIKE '%$deviceID%' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $products=array();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
          $products[]=json_encode($row);
          $response['data'][$row['id']]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Products fetched successfully.';
        $response['count']=count($products);
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

  return $response;
}

?>
