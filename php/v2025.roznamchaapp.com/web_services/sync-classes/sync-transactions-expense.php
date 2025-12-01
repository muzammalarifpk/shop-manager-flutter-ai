<?php

function store_transaction_expense($db,$owner_mobile,$inputData,$deviceID)
{
  $response=[];

  foreach($inputData as $record)
  {
    $response[$record['_id']]=process_single_transactionExpense($db,$owner_mobile,$record,$deviceID);
  }

  return ($response);

}

function process_single_transactionExpense($db,$owner_mobile,$postinfo,$deviceID)
{

  // $all_fields = array();
  //
  //
  // $all_fields['name']=array('name'=>'Contact Name','is_req'=>1,'type'=>'text');
  // $all_fields['tags']=array('name'=>'Tags','is_req'=>0,'type'=>'tags');
  // $all_fields['duedate']=array('name'=>'Due Date','is_req'=>0,'type'=>'date');
  // $all_fields['email']=array('name'=>'Email Address','is_req'=>0,'type'=>'text');
  // $all_fields['city']=array('name'=>'City','is_req'=>0,'type'=>'text');
  // $all_fields['country_code']=array('name'=>'Country Code','is_req'=>1,'type'=>'dropdown');
  // $all_fields['mobile']=array('name'=>'Mobile Number/Customer ID','is_req'=>1,'type'=>'number');
  // $all_fields['number']=array('name'=>'International Format','is_req'=>0,'type'=>'text');
  // $all_fields['type']=array('name'=>'Type','is_req'=>1,'type'=>'dropdown');
  // $all_fields['balance_status']=array('name'=>'Balance Status','is_req'=>1,'type'=>'dropdown');
  // $all_fields['balance']=array('name'=>'Current Balance','is_req'=>0,'type'=>'number');
  // $all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown');
  // $all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

  $_SESSION['sess_bp_username']=$owner_mobile;
  $table='expense';

  $response['code']=100;
  $response['msg']='invalid request.';

  $err=[];
  // print_r($postinfo);

  if(empty($postinfo['amount'])){
    $err[]='Amount is Required.';
  }

  if(count($err)==0)
  {
    $response['code']=count($err);
    $response['msg']='no error found.';

    if($postinfo['id_on_server']==null || $postinfo['id_on_server']=='')
    {
      $response[] = insert_single_transaction_expense($db,$owner_mobile,$postinfo,$deviceID,$table);
    //
    //   $response['msg']='id on server is null';
    //   if($postinfo['title']=='' || $postinfo['title']==null)
    //   {
    //
    //     // report error because number can't be empty.
    //
    //
    //
    //   }else{
    //     $published_status='Published';
    //     $unique_name_qry = "select * from `$table` where `owner_mobile`=:owner_mobile and `name`=:name and `status`=:status";
    //     $stmt = $db->prepare($unique_name_qry);
    //     $stmt->bindParam('owner_mobile', $postinfo['owner_mobile'], PDO::PARAM_STR);
    //     $stmt->bindParam('name', $postinfo['name'], PDO::PARAM_STR);
    //     $stmt->bindParam('status', $published_status, PDO::PARAM_STR);
    //     $stmt->execute();
    //
    //     $count = $stmt->rowCount();
    //
    //     if($count == 0)
    //     {
    //       // insert item
    //       $response = insert_single_service($db,$owner_mobile,$postinfo,$deviceID,$table);
    //
    //    }else{
    //      // return error...
    //      $err[]='Service Name must be unique. count:' .$count;
    //      while($row   = $stmt->fetch(PDO::FETCH_ASSOC))
    //      {
    //        $err[]='id: '.$row['id'].' name: '.$row['name'];
    //      }
    //
    //      $response['code']=303;
    //      $response['msg']=$err;
    //
    //    }
    //
    //
    //
    // }

  }else{
    $response['msg']='id on server is not null '.$postinfo['id_on_server'];

    // update already existing product.
    $response=update_single_transaction_expense($db,$owner_mobile,$postinfo,$deviceID,$table);

  }


}else{
    $response['code']=count($err);
    $response['msg']=$err;
  }



  return json_encode($response);

}

function insert_single_transaction_expense($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $insert_qry = "insert into `$table` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,`sync`=:sync, `expense_type`=:expense_type,  `date`=:date,  `amount`=:amount,  `description`=:description,  `payment_method`=:payment_method, `attachments`=:attachments ";


  $insert_stmt = $db->prepare($insert_qry);

  $owner_mobile=$postinfo['owner_mobile'];
  $empty='';

  $time=time();
  $last_updated=time();

  $insert_stmt->bindParam('sync', $deviceID);
  $insert_stmt->bindParam('timestamp', $time);
  $insert_stmt->bindParam('added_by', $postinfo['added_by']);
  $insert_stmt->bindParam('owner_mobile', $owner_mobile);
  $insert_stmt->bindParam('last_updated', $time);
  $insert_stmt->bindParam('status', $postinfo['status']);

  $insert_stmt->bindParam('expense_type', $postinfo['expense_type']);
  $insert_stmt->bindParam('date', $postinfo['date']);
  $insert_stmt->bindParam('amount', $postinfo['amount']);
  $insert_stmt->bindParam('description', $postinfo['description']);
  $insert_stmt->bindParam('payment_method', $postinfo['payment_method']);
  $insert_stmt->bindParam('attachments', $postinfo['image_path']);

  $insert_stmt->execute();

  $record_id=$db->lastInsertId();

  $payment_account=$postinfo['payment_method'];
  $expense_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_type`='Expense' and `status`='Published'",'id');


  $credit_array   =array(array('account'=>$payment_account,'amount'=>$postinfo['amount']));
  $debit_array    =array(array('account'=>$expense_account,'amount'=>$postinfo['amount']));
  $entry_type     ="expense";
  $entry_link     ='expense:'.$record_id;

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

  graph_entry($db,$postinfo['date'],0,0,0,$postinfo['amount'],0,0,0);


  $response['code']=200;
  $response['msg']='Transcation expense created successfully';
  $response['data']=['id_on_server'=>$record_id];


  return ($response);


}


function update_single_transaction_expense($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $empty='';

  $owner_mobile=$postinfo['owner_mobile'];
  $status=$postinfo['status'];
  $last_updated=$postinfo['last_updated'];
  $sync=$deviceID;

  $expense_type=$postinfo['expense_type'];
  $date=$postinfo['date'];
  $amount=$postinfo['amount'];
  $description=$postinfo['description'];
  $payment_method=$postinfo['payment_method'];
  $attachments=$postinfo['image_path'];


  $id=$postinfo['id_on_server'];


  $update_qry="update `$table` set `status`='$status',`last_updated`='$last_updated', `sync`='$sync', `expense_type`='$expense_type', `date`='$date',  `amount`='$amount', `description`='$description',  `payment_method`='$payment_method', `attachments`='$attachments' where `owner_mobile`='$owner_mobile' and `id`='$id'";

  $stmt=$db->prepare($update_qry);

  try{

  $stmt->execute();

  $response['code']=200;
  $response['msg']='Transcation Expense updated successfully.';
  $response['data']=['id_on_server'=>$id];


}catch(Exception $e){

  $response['code']=300;
  $response['msg']='error updating service.';
  $response['data']=$e;

}

return ($response);

}






//////////////////////////////////////////


function get_data2sync_expense($db,$owner_mobile,$deviceID)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `expense` where `owner_mobile`='$owner_mobile' and  (`sync` is NULL || `sync` NOT LIKE '%$deviceID%' )";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $stockLocations=array();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
          $stockLocations[]=json_encode($row);
          $response['data'][$row['id']]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Transcation Expense fetched successfully.';
        $response['count']=count($stockLocations);
        }else{
        $response['code'] = 201;
        $response['msg'] = 'No Transcation Expense Found.';
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
