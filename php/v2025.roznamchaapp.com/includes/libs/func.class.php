<?php
function v4db($inputdata)
{
  return $inputdata.'-'.time();
}

function trim_gfs($inputdata)
{
  return trim((string)$inputdata);
}

function strtolower_gfs($inputdata)
{
  return strtolower((string)$inputdata);
}

function json_decode_gfs($inputdata)
{
  return json_decode((string)$inputdata);
}

function json_encode_gfs($inputdata)
{
  return json_encode($inputdata);
}

function showbtn_main($type,$txt,$lnk)
{
  if($type=='success')
  {
    $icon='fa fa-check';
    $classname='editmodalbtn';
  }elseif ($type=='warning') {
    $icon='fa fa-pencil';
    $classname='editmodalbtn';
  }elseif ($type=='danger') {
    $icon='fa fa-trash-o';
    $classname='dangerbtn';
  }elseif ($type=='info') {
    $icon='fa fa-eye';
    $classname='editmodalbtn';
  }elseif ($type=='primary') {
    $icon='fa fa-heart';
    $classname='editmodalbtn';
  }elseif ($type=='secondary') {
    $icon='fa fa-heart';
    $classname='editmodalbtn';
  }else{
    $icon='fa fa-heart';
    $classname='editmodalbtn';
  }
  return showbtn($type,$classname,$txt,$lnk,$icon,true);
}

function showbtn($type,$classname,$txt,$link,$icon,$label)
{
  $btn='<a href="'.$link.'" rel="'.$link.'" class="'.$classname.' btn btn-outline-'.$type.'">';
  if($label)
  {
    $btn.='<span class="btn-label"><i class="'.$icon.'"></i></span>';
  }
  $btn.= ucfirst($txt).'</a>';
  return $btn;
}

function gnr($db,$table,$field,$where,$value)
{
  $select_qry = "select * from `$table` where `$field`='$where' ";

  $res = $db->query($select_qry);
  if ($res->fetchColumn() > 0)
  {
    foreach ($db->query($select_qry) as $row) {
      return $row[$value];
    }

  }else{
    return 'N/A';
  }


}

function glnr($db,$table,$field,$where,$value)
{
  $select_qry = "select $value from `$table` where `$field`='$where' order by `id` desc limit 1";

  $res = $db->query($select_qry);
  if ($res->fetchColumn() > 0)
  {
    foreach ($db->query($select_qry) as $row) {
      return $row[$value];
    }

  }else{
    return NULL;
  }


}

function gnrm($db,$table,$wheres,$value)
{

  $select_qry = "select * from `$table` where ".$wheres;
 // echo $select_qry;
  $res = $db->query($select_qry);
  if ($res->fetchColumn() > 0)
  {
    foreach ($db->query($select_qry) as $row) {
//      print_r($row);
      return $row[$value];
    }

  }else{
    return 'N/A';
  }
}

function gnrms($db,$table,$wheres,$value,$orderBy)
{

  $select_qry = "select * from `$table` where ".$wheres." order by `$orderBy` desc limit 1";
//  echo $select_qry;
  $res = $db->query($select_qry);
  if ($res->fetchColumn() > 0)
  {
    foreach ($db->query($select_qry) as $row) {
//      print_r($row);
      return $row[$value];
    }

  }else{
    return 'N/A';
  }
}

function dateDiffInDays($date1, $date2)
{
    // Calulating the difference in timestamps
    $diff = strtotime($date2) - strtotime($date1);

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return abs(round($diff / 86400));
}

function cnrm($db,$table,$wheres)
{
  $select_qry = "select id from `$table` where ".$wheres;
  //echo $select_qry;
  $stmt = $db->query($select_qry);
  $row_count = $stmt->rowCount();

  return $row_count;

}

function gnra($db,$table,$where,$value,$field)
{
  $string=$value;

  if($string[0]=='c')
  {

    $contact_where = " `number`='".substr($value,1)."' and `owner_mobile`='".$_SESSION['sess_bp_username']."'";
    //echo $contact_where;
    return gnrm($db,'contacts',$contact_where,'name');

  }else{
    return gnr($db,$table,$where,$value,$field);
  }
}


function update_contacts_balance($db,$account_id,$balance,$balance_status,$owner_mobile)
{
  $time=time();
  $update_qry = "update `contacts` set `balance`=:balance, `balance_status`=:balance_status, `sync`=:sync, `last_updated`=:last_updated where `number`=:number and `owner_mobile`=:owner_mobile";

  $stmt=$db->prepare($update_qry);
  $empty='';

  $stmt->bindParam('balance',$balance);
  $stmt->bindParam('balance_status',$balance_status);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('sync',$empty);
  $stmt->bindParam('number',$account_id);
  $stmt->bindParam('owner_mobile',$owner_mobile);

  try{
    $stmt->execute();
  }catch (Exception $e)
  {
    echo $e->getMessage();
  }

}

function update_coa_balance($db,$account_id,$balance,$balance_type,$owner_mobile)
{
  $time=time();

  $update_qry = "update `chartofaccount` set `balance`=:balance, `balance_type`=:balance_type, `last_updated`=:last_updated, `last_update_date`=:last_update_date where `id`=:id and `owner_mobile`=:owner_mobile";

  $stmt=$db->prepare($update_qry);

  $stmt->bindParam('balance',$balance);
  $stmt->bindParam('balance_type',$balance_type);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('last_update_date',$time);
  $stmt->bindParam('id',$account_id);
  $stmt->bindParam('owner_mobile',$owner_mobile);

  try{
    $stmt->execute();
  }catch (Exception $e)
  {
    echo $e->getMessage();
  }
}

function create_ledger_account($db,$owner_details,$account_details)
{
  $insert_qry="insert into `chartofaccount` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `account_head`=:account_head,  `account_type`=:account_type,  `balance`=:balance,  `balance_type`=:balance_type,  `old_balance`=:old_balance,  `old_balance_type`=:old_balance_type,  `last_update_date`=:last_update_date, `notes`=:notes ";

  $insert=$db->prepare($insert_qry);

  $owner_mobile=$owner_details['owner_mobile'];
  $time=time();
  $added_by=$owner_details['added_by'];
  $status=$owner_details['status'];

  $account_head=$account_details['account_head'];
  $account_type=$account_details['account_type'];
  $balance=$account_details['balance'];
  $balance_type=$account_details['balance_type'];
  $old_balance=$account_details['old_balance'];
  $old_balance_type=$account_details['old_balance_type'];
  $last_update_date=$account_details['last_update_date'];
  $notes=$account_details['notes'];


  $insert->bindParam('owner_mobile',$owner_mobile);
  $insert->bindParam('timestamp',$time);
  $insert->bindParam('added_by',$added_by);
  $insert->bindParam('status',$status);

  $insert->bindParam('account_head',$account_head);
  $insert->bindParam('account_type',$account_type);
  $insert->bindParam('balance',$balance);
  $insert->bindParam('balance_type',$balance_type);
  $insert->bindParam('old_balance',$old_balance);
  $insert->bindParam('old_balance_type',$old_balance_type);
  $insert->bindParam('last_update_date',$last_update_date);
  $insert->bindParam('notes',$notes);

  $insert->execute();

  $ledger_account_id=$db->lastInsertId();

  return $ledger_account_id;

}

function ledger_entry($db,$description,$account_id,$amount,$amount_type,$entry_link='')
{
  if($amount==0)
  {

  }else{

  try{
    $owner_mobile=$_SESSION['sess_bp_username'];

    $ledger_data= $db -> prepare("select * from `ledger` where `account_id`=:account_id and `owner_mobile`=:owner_mobile order by `id` desc");
    $ledger_data->execute(['account_id'=>$account_id,'owner_mobile'=>$owner_mobile]);

    $ledger_account=$ledger_data->fetch();

    if( is_array($ledger_account) ) {
      $old_balance=$ledger_account['balance'];
      $old_balance_type=$ledger_account['balance_type'];
    }else{
      $old_balance='0';
      $old_balance_type='debit';

    }

    $ledger_qry="insert into `ledger` set `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `date`=:date, `account_id`=:account_id, `description`=:description, `amount`=:amount, `amount_type`=:amount_type, `balance`=:balance, `balance_type`=:balance_type, `entry_link`=:entry_link ";
      $ledger = $db->prepare($ledger_qry);

      $time=time();
      $added_by=$_SESSION['sess_bp_username'];
      $status='Published';

      $description= $description;
      $date_time= date("Y-m-d H:i:s");

      $balance='';
      $balance_type = '';

      if(!$old_balance)
      {
        $balance_type=$amount_type;
        $balance=$amount;
      }
      elseif($old_balance_type == 'debit' && $amount_type == 'debit')
      {
        $balance_type='debit';
        $balance=floatval($old_balance)+floatval($amount);
      }
      elseif($old_balance_type == 'credit' && $amount_type == 'credit')
      {
        $balance_type='credit';
        $balance=floatval($old_balance)+floatval($amount);
      }
      elseif($old_balance_type == 'credit' && $amount_type == 'debit')
      {
        if($amount>$old_balance)
        {
          $balance_type='debit';
          $balance=floatval($amount)-floatval($old_balance);
        }else {
          $balance_type='credit';
          $balance=$old_balance-$amount;
        }
      }
      else
      {
        if($amount>$old_balance)
        {
          $balance_type='credit';
          $balance=$amount-$old_balance;
        }else {
          $balance_type='debit';
          $balance=$old_balance-$amount;
        }
      }


      $ledger->bindParam('owner_mobile',$owner_mobile);
      $ledger->bindParam('timestamp',$time);
      $ledger->bindParam('added_by',$added_by);
      $ledger->bindParam('status',$status);
      $ledger->bindParam('last_updated',$time);
      $ledger->bindParam('date',$date_time);
      $ledger->bindParam('account_id',$account_id);
      $ledger->bindParam('description',$description);
      $ledger->bindParam('amount',$amount);
      $ledger->bindParam('amount_type',$amount_type);
      $ledger->bindParam('balance',$balance);
      $ledger->bindParam('balance_type',$balance_type);
      $ledger->bindParam('entry_link',$entry_link);

      $ledger->execute();

      if((substr( $account_id, 0, 1 ) === "c") || (substr( $account_id, 0, 1 ) === "+") )
      {
        $account_id = ltrim($account_id,'c');
        update_contacts_balance($db,$account_id,$balance,$balance_type,$owner_mobile);
      }else{
        echo update_coa_balance($db,$account_id,$balance,$balance_type,$owner_mobile);
      }

  }
  catch (Exception $e) {
      echo $e->getMessage();
  }
}


}

function journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link)
{
  $entry_qry="insert into `journal` set `description`=:description, `date_time`=:date_time, `credit_json`=:credit_json, `debit_json`=:debit_json, `entry_type`=:entry_type, `entry_link`=:entry_link, `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated";


  try {
      // run your code here
      $stmt = $db->prepare($entry_qry);

      $description= $entry_type;
      $date_time= date("Y-m-d H:i:s");
      $credit_json=json_encode($credit_array);
      $debit_json=json_encode($debit_array);
      $owner_mobile=$_SESSION['sess_bp_username'];
      $time=time();
      $added_by=$_SESSION['sess_bp_username'];
      $status='Published';

      $stmt->bindParam("description",$description);
      $stmt->bindParam('date_time',$date_time);
      $stmt->bindParam('credit_json',$credit_json);
      $stmt->bindParam('debit_json',$debit_json);
      $stmt->bindParam('entry_type',$entry_type);
      $stmt->bindParam('entry_link',$entry_link);
      $stmt->bindParam('owner_mobile',$owner_mobile);
      $stmt->bindParam('timestamp',$time);
      $stmt->bindParam('added_by',$added_by);
      $stmt->bindParam('status',$status);
      $stmt->bindParam('last_updated',$time);

      $stmt->execute();

      foreach($credit_array as $key => $val)
      {
        ledger_entry($db,$description,$val['account'],$val['amount'],'credit',$entry_link);
      }

      foreach($debit_array as $key => $val)
      {
        $amount=$val['amount'];
        ledger_entry($db,$description,$val['account'],$val['amount'],'debit',$entry_link);
      }

      $date=date('Y-m-d');


      $update_entries_count_qry = "UPDATE  `users` SET `entries`=entries+1 WHERE `number`='$owner_mobile' ";
      $update_entries_count=$db->prepare($update_entries_count_qry);
      $update_entries_count->execute();





      return 'Journal Entry ID: '.$db->lastInsertId();

  }
  catch (Exception $e) {
      echo $e->getMessage();
  }
  catch (InvalidArgumentException $e) {
      echo $e->getMessage();
  }
}



function update_stock_history($db,$invoice_id,$date,$in_out,$products_array)
{
  foreach($products_array as $prod => $product){

    $owner_mobile = $_SESSION['sess_bp_username'];
    $time =time();
    $status='Published';
    $product_id = $product['product_id'];
    $qty = $product['qty'];

    $wheres = " `id`='".$product_id."' and `owner_mobile`='".$_SESSION['sess_bp_username']."' ORDER BY id DESC LIMIT 1";
    $qty_before = gnrm($db,'products',$wheres,'available_stock');

    $product['qty_before'];
    $measuring_unit = $product['unit_measure'];
    $unit_price = $product['unit_price'];
    $total_price = $product['qty']*$product['unit_price'];
    $cost_per_unit = $product['cost_per_unit'];

    if($in_out=='sale' || $in_out == 'purchase_return' || $in_out == 'activity_input')
    {
      $qty_after = floatval($qty_before)-floatval($product['qty']);
      $updated_qty = floatval($qty_before)-floatval($product['qty']);
      $profit_per_unit =$product['unit_price'] - $product['cost_per_unit'];
      $total_profit = $profit_per_unit*$qty;
    }else{
      $profit_per_unit = 0;
      $qty_after = $qty_before+$product['qty'];
      $updated_qty = $qty_before+$product['qty'];
      $total_profit = 0;
    }

    $insert_update="insert into `stock_history` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `last_updated`=:last_updated,  `status`=:status,  `product_id`=:product_id,  `date`=:date,  `qty`=:qty,  `in_out`=:in_out,  `qty_before`=:qty_before,  `qty_after`=:qty_after,  `invoice_id`=:invoice_id,  `measuring_unit`=:measuring_unit,  `unit_price`=:unit_price,  `total_price`=:total_price,  `cost_per_unit`=:cost_per_unit,  `profit_per_unit`=:profit_per_unit, `total_profit`=:total_profit  ";

    $stock=$db->prepare($insert_update);


    $stock->bindParam('owner_mobile',$owner_mobile);
    $stock->bindParam('timestamp',$time);
    $stock->bindParam('added_by',$owner_mobile);
    $stock->bindParam('last_updated',$time);
    $stock->bindParam('status',$status);
    $stock->bindParam('product_id',$product_id);
    $stock->bindParam('date',$date);
    $stock->bindParam('qty',$qty);
    $stock->bindParam('in_out',$in_out);
    $stock->bindParam('qty_before',$qty_before);
    $stock->bindParam('qty_after',$qty_after);
    $stock->bindParam('invoice_id',$invoice_id);
    $stock->bindParam('measuring_unit',$measuring_unit);
    $stock->bindParam('unit_price',$unit_price);
    $stock->bindParam('total_price',$total_price);
    $stock->bindParam('cost_per_unit',$cost_per_unit);
    $stock->bindParam('profit_per_unit',$profit_per_unit);
    $stock->bindParam('total_profit',$total_profit);

    $stock->execute();


    if($in_out=='purchase')
    {
      $update_qry="update `products` set `purchase_cost`=:purchase_cost where `id`=:product_id and `owner_mobile`=:owner_mobile";
      $stock=$db->prepare($update_qry);

      $stock->bindParam('purchase_cost',$unit_price);
      $stock->bindParam('product_id',$product_id);
      $stock->bindParam('owner_mobile',$_SESSION['sess_bp_username']);

      $stock->execute();

    }

    update_stock($db,$product_id,$qty_after);
  }
}

function update_stock($db,$product_id,$new_qty)
{
  $update_qry="update `products` set `available_stock`=:available_stock, `sync`=:sync where `id`=:product_id and `owner_mobile`=:owner_mobile";
  $stock=$db->prepare($update_qry);

  $empty='';

  $stock->bindParam('available_stock',$new_qty);
  $stock->bindParam('sync',$empty);
  $stock->bindParam('product_id',$product_id);
  $stock->bindParam('owner_mobile',$_SESSION['sess_bp_username']);

  $stock->execute();

  $product_min_limit=gnr($db,'products','id',$product_id,'min_stock_limit');

  if($new_qty<=$product_min_limit)
  {
    create_notification($db,'Low Stock Alert',gnr($db,'products','id',$product_id,'name').' product is running low on stock','r-stock-view.php?id='.$product_id);
  }

  if($stock)
  {
    return true;
  }else{
    return false;
  }
}

function create_notification($db,$title,$text,$link)
{
    $insert_qry="insert into `inbox` set `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `title`=:title, `text`=:text, `date_time`=:date_time, `link`=:link, `read_status`=:read_status";
    $notify=$db->prepare($insert_qry);

    $time=time();
    $added_by=$_SESSION['sess_bp_username'];
    $status='Published';
    $last_updated=$time;
    $date_time=$time;
    $read_status=0;


    $notify->bindParam('owner_mobile',$_SESSION['sess_bp_username']);
    $notify->bindParam('timestamp',$time);
    $notify->bindParam('added_by',$added_by);
    $notify->bindParam('status',$status);
    $notify->bindParam('last_updated',$last_updated);
    $notify->bindParam('title',$title);
    $notify->bindParam('text',$text);
    $notify->bindParam('date_time',$date_time);
    $notify->bindParam('link',$link);
    $notify->bindParam('read_status',$read_status);


    $notify->execute();

    if($notify)
    {
      return true;
    }else{
      return false;
    }
}

function graph_entry($db,$date,$now_sale,$now_cost_of_sale,$now_total_purchase,$now_expense,$now_profit,$now_sale_discount,$now_purchase_discount)
{
  $date=date("d-M, Y",strtotime($date));
  $select_qry = "select `id` from `graph` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$date'";
  $select_stmt=$db->prepare($select_qry);
  $select_stmt->execute();

  $select_count=$select_stmt->rowCount();

  if($select_count==1)
  {

    $owner_mobile = $_SESSION['sess_bp_username'];
    $time=time();
    $added_by = $_SESSION['sess_bp_username'];
    $status = 'Published';
    $last_updated= time();
    $total_sale = $now_sale;
    $cost_of_sale = $now_cost_of_sale;
    $total_purchase= $now_total_purchase;
    $expense = $now_expense;
    $profit = $now_profit;
    $sale_discount = $now_sale_discount;
    $purchase_discount = $now_purchase_discount;

    $update_qry = "update `graph` set
    `last_updated`=:last_updated,
    `total_sale`= `total_sale` + :total_sale,
    `cost_of_sale`=`cost_of_sale` + :cost_of_sale,
    `total_purchase` = `total_purchase` + :total_purchase,
    `expense`=`expense` + :expense,
    `profit`=`profit` + :profit,
    `sale_discount`=`sale_discount` + :sale_discount,
    `purchase_discount`=`purchase_discount` + :purchase_discount

    where `owner_mobile`=:owner_mobile and `date`=:date";
    $update_stmt = $db->prepare($update_qry);

    $update_stmt->bindParam('last_updated',$last_updated);
    $update_stmt->bindParam('total_sale',$total_sale);
    $update_stmt->bindParam('cost_of_sale',$cost_of_sale);
    $update_stmt->bindParam('total_purchase',$total_purchase);
    $update_stmt->bindParam('expense',$expense);
    $update_stmt->bindParam('profit',$profit);
    $update_stmt->bindParam('sale_discount',$sale_discount);
    $update_stmt->bindParam('purchase_discount',$purchase_discount);

    $update_stmt->bindParam('owner_mobile',$owner_mobile);
    $update_stmt->bindParam('date',$date);

    try{
      $update_stmt->execute();
      charge_coins($db,1);

    }catch(Exception $e)
    {
      print_r($e);
    }


  }else{

    $owner_mobile = $_SESSION['sess_bp_username'];
    $time=time();
    $added_by = $_SESSION['sess_bp_username'];
    $status = 'Published';
    $last_updated= time();
    $total_sale = $now_sale;
    $cost_of_sale = $now_cost_of_sale;
    $total_purchase= $now_total_purchase;
    $expense = $now_expense;
    $profit = $now_profit;
    $sale_discount = $now_sale_discount;
    $purchase_discount = $now_purchase_discount;


    $insert_qry = "insert into `graph` set
    `owner_mobile`=:owner_mobile,
    `timestamp`=:timestp,
    `added_by`=:added_by,
    `status`=:status,
    `last_updated`=:last_updated,
    `date`=:date,
    `total_sale`=:total_sale,
    `cost_of_sale`=:cost_of_sale,
    `total_purchase`=:total_purchase,
    `expense`=:expense,
    `profit`=:profit,
    `sale_discount`=:sale_discount,
    `purchase_discount`=:purchase_discount

    ";

    $insert_stmt = $db->prepare($insert_qry);

    $insert_stmt->bindParam('owner_mobile',$owner_mobile);
    $insert_stmt->bindParam('timestp',$time);
    $insert_stmt->bindParam('added_by',$added_by);
    $insert_stmt->bindParam('status',$status);
    $insert_stmt->bindParam('last_updated',$last_updated);
    $insert_stmt->bindParam('date',$date);
    $insert_stmt->bindParam('total_sale',$total_sale);
    $insert_stmt->bindParam('cost_of_sale',$cost_of_sale);
    $insert_stmt->bindParam('total_purchase',$total_purchase);
    $insert_stmt->bindParam('expense',$expense);
    $insert_stmt->bindParam('profit',$profit);
    $insert_stmt->bindParam('sale_discount',$sale_discount);
    $insert_stmt->bindParam('purchase_discount',$purchase_discount);

    try{
      $insert_stmt->execute();

      charge_coins($db,1);
    }catch(Exception $e)
    {
      print_r($e);
    }
  }
}

function get_sum($db,$query)
{
  $sth = $db->prepare($query);
  $sth->execute();

  /* Fetch all of the values of the first column */
  $result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
  return $result[0];
}
if(!function_exists("isJson")) {
function isJson($string)
{
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}
}

function inprivs($this_module,$meta_check)
{
//  echo '<h2>Module: '.$this_module.'</h2>';
//  echo '<h2>Check Permission: '.$meta_check.'</h2>';

  if($meta_check==true)
  {
    if($_SESSION['sess_bp_privs']!=='*')
    {
      if(!in_array($this_module,$_SESSION['sess_bp_privs']))
      {
        header('Location: dashboard.php');
        die();
      }else{
  //      echo '<h3>permission granted...</h3>';
      }
    }
  }
}

function create_variant($db,$owner_mobile,$added_by,$status,$product_id,$name,$available_stock,$date)
{
  $query = "insert into `product_variants` set `owner_mobile`=:owner_mobile, `timestamp`=:timestamp, `added_by`=:added_by, `status`=:status, `last_updated`=:last_updated, `product_id`=:product_id, `name`=:name, `available_stock`=:available_stock";

  $stmt = $db->prepare($query);

  $time=time();

  $stmt->bindParam('owner_mobile',$owner_mobile);
  $stmt->bindParam('timestamp',$time);
  $stmt->bindParam('added_by',$added_by);
  $stmt->bindParam('status',$status);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('product_id',$product_id);
  $stmt->bindParam('name',$name);
  $stmt->bindParam('available_stock',$available_stock);

  try{
    $stmt->execute();
    $variant_id=$db->lastInsertId();
    $products_array=array('variant_id'=>$variant_id,'qty'=>$available_stock,'qty_before'=>0);
    update_stock_variant_history($db,'0',$date,'new',$products_array);
  }catch(Exception $e)
  {
    print_r($e);
  }


}

function update_stock_variant_history($db,$invoice_id,$date,$in_out,$product)
{
  $insert_update="insert into `stock_variant_history` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `last_updated`=:last_updated,  `status`=:status,  `variant_id`=:variant_id,  `date`=:date,  `qty`=:qty,  `in_out`=:in_out,  `qty_before`=:qty_before,  `qty_after`=:qty_after,  `invoice_id`=:invoice_id ";

  $stock=$db->prepare($insert_update);

  $owner_mobile = $_SESSION['sess_bp_username'];
  $time =time();
  $status='Published';


    $variant_id = $product['variant_id'];
    $qty = $product['qty'];
    $wheres = " `variant_id`='".$variant_id."' and `owner_mobile`='".$_SESSION['sess_bp_username']."' ORDER BY id DESC LIMIT 1";

    $qty_before = gnrm($db,'stock_variant_history',$wheres,'qty_after');
    $product['qty_before'];

    if($in_out=='sale' || $in_out == 'purchase_return' || $in_out == 'activity_input')
    {
      $qty_after = floatval($qty_before)-floatval($product['qty']);
      $updated_qty = floatval($qty_before)-floatval($product['qty']);
    }else{
      $qty_after = floatval($qty_before)+floatval($product['qty']);
      $updated_qty = floatval($qty_before)+floatval($product['qty']);
    }

    $stock->bindParam('owner_mobile',$owner_mobile);
    $stock->bindParam('timestamp',$time);
    $stock->bindParam('added_by',$owner_mobile);
    $stock->bindParam('last_updated',$time);
    $stock->bindParam('status',$status);
    $stock->bindParam('variant_id',$variant_id);
    $stock->bindParam('date',$date);
    $stock->bindParam('qty',$qty);
    $stock->bindParam('in_out',$in_out);
    $stock->bindParam('qty_before',$qty_before);
    $stock->bindParam('qty_after',$qty_after);
    $stock->bindParam('invoice_id',$invoice_id);

    $stock->execute();


    update_stock_variant($db,$variant_id,$qty_after);
}

function update_stock_variant($db,$variant_id,$new_qty)
{
  $update_qry="update `product_variants` set `available_stock`=:available_stock where `id`=:variant_id and `owner_mobile`=:owner_mobile";
  $stock=$db->prepare($update_qry);

  $stock->bindParam('available_stock',$new_qty);
  $stock->bindParam('variant_id',$variant_id);
  $stock->bindParam('owner_mobile',$_SESSION['sess_bp_username']);

  $stock->execute();

  if($stock)
  {
    return true;
  }else{
    return false;
  }
}


function get_random($strength = 16,$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}


function get_daily_data($db,$table,$column,$for_date)
{
    $expense_where = '';
    if($table=='expense')
    {
      $expense_where = " and `status`='published' ";
    }
    $select_daily_qry = "select sum($column) as sum_total from `$table` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$for_date' $expense_where";
//    echo $select_daily_qry;
    $select_daily_stmt = $db->prepare($select_daily_qry);
    $select_daily_stmt->execute();

    $daily_row = $select_daily_stmt->fetch(PDO::FETCH_ASSOC);
    $daily_grand_total=$daily_row['sum_total'];
//    echo '<h3>Daily grand total: '.$daily_grand_total.'</h3>';
    return $daily_grand_total;

}


function give_referal_bonus($db, $referby){

  $sql = "UPDATE users SET coins = coins + 50 WHERE `number` = :user_id";

  // Prepare the statement
  $statement = $db->prepare($sql);

  // Bind the parameter(s)
  $statement->bindParam(':user_id', $referby);


  // Execute the statement
  $statement->execute();


}

function charge_coins($db, $coins_count){

  $owner_mobile = $_SESSION['sess_bp_username'];

  $update_coins_count_qry = "UPDATE  `users` SET `coins`=coins-$coins_count WHERE `number`='$owner_mobile' ";
  $update_coins_count=$db->prepare($update_coins_count_qry);
  $update_coins_count->execute();

}

?>
