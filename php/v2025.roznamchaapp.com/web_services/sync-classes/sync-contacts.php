<?php


function update_single_contact($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $empty='';

  $status=$postinfo['status'];
  $last_updated=$postinfo['last_updated'];
  $sync=$deviceID;
  $country_code=$postinfo['country_code'];
  $mobile=$postinfo['mobile'];
  $number=$postinfo['number'];
  $name=$postinfo['name'];
  $type=$postinfo['type'];
  $balance_status=$postinfo['balance_status'];
  $balance=$postinfo['balance'];
  $notes=$postinfo['notes'];
  $email=$postinfo['email'];
  $city=$postinfo['city'];
  $duedate=$postinfo['duedate'];
  $tags=$postinfo['tags'];
  $owner_mobile=$postinfo['owner_mobile'];


  $id=$postinfo['id_on_server'];


    if($postinfo['balance_status']=='Debit')
    {
      $balance_drcr='Debit';
      $balance_type='dr';
      $balance_status='receiveable';
    }else{
      $balance_drcr='Credit';
      $balance_type='dr';
      $balance_status='payable';
    }

  $update_qry="update `$table` set `status`='$status',`last_updated`='$last_updated', `sync`='$sync', `name`='$name', `country_code`='$country_code',  `mobile`='$mobile', `number`='$number', `type`='$type', `notes`='$notes', `email`='$email',  `city`='$city', `duedate`='$duedate', `tags`='$tags' where `owner_mobile`='$owner_mobile' and `id`='$id'";

  $stmt=$db->prepare($update_qry);

  try{

  $stmt->execute();

  $response['code']=200;
  $response['msg']='contact updated successfully.';
  $response['data']=['id_on_server'=>$id];


}catch(Exception $e){

  $response['code']=300;
  $response['msg']='error updating contact.';
  $response['data']=$e;

}

return ($response);

}

function insert_single_contact($db,$owner_mobile,$postinfo,$deviceID,$table)
{
  $insert_qry = "insert into `$table` set `name`=:name,  `country_code`=:country_code,  `mobile`=:mobile,  `number`=:number,  `type`=:type,  `balance_status`=:balance_status,  `balance`=:balance,  `notes`=:notes,  `email`=:email,  `city`=:city,  `duedate`=:duedate,  `tags`=:tags,
  `status`=:status, `last_updated`=:last_updated,  `owner_mobile`=:owner_mobile,  `added_by`=:added_by,  `timestamp`=:timestamp,  `sync`=:sync ";



  $total_price=$postinfo['balance'];
  $capital_account=gnrm($db,'chartofaccount',"`owner_mobile`='$owner_mobile' and `account_type`='Equity' and `status`='Published'",'id');
  $coa_account='c'.$postinfo['number'];


  if($postinfo['balance_status']=='Debit')
  {
    $balance_drcr='Debit';
    $balance_type='dr';
    $balance_status='receiveable';
  }else{
    $balance_drcr='Credit';
    $balance_type='dr';
    $balance_status='payable';
  }

  $insert_stmt = $db->prepare($insert_qry);

  $owner_mobile=$postinfo['owner_mobile'];
  $empty='';

  $time=time();
  $last_updated=time();

  $insert_stmt->bindParam('timestamp', $time);
  $insert_stmt->bindParam('owner_mobile', $owner_mobile);
  $insert_stmt->bindParam('name', $postinfo['name']);
  $insert_stmt->bindParam('country_code', $postinfo['country_code']);
  $insert_stmt->bindParam('mobile', $postinfo['mobile']);
  $insert_stmt->bindParam('number', $postinfo['number']);
  $insert_stmt->bindParam('type', $postinfo['type']);
  $insert_stmt->bindParam('balance_status', $balance_status);
  $insert_stmt->bindParam('balance', $postinfo['balance']);
  $insert_stmt->bindParam('email', $postinfo['email']);
  $insert_stmt->bindParam('city', $postinfo['city']);
  $insert_stmt->bindParam('duedate', $postinfo['duedate']);
  $insert_stmt->bindParam('tags', $postinfo['tags']);
  $insert_stmt->bindParam('status', $postinfo['status']);
  $insert_stmt->bindParam('notes', $postinfo['notes']);
  $insert_stmt->bindParam('last_updated', $time);
  $insert_stmt->bindParam('added_by', $postinfo['added_by']);
  $insert_stmt->bindParam('sync', $deviceID);

  $insert_stmt->execute();

  $record_id=$db->lastInsertId();

  if($balance_status=='receiveable')
  {
    $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
    $debit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
  }else{

    $debit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
    $credit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
  }

  $entry_type='Create new Contact with beginning balance.';
  $entry_link='contactid:'.$postinfo['number'];

  journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);


  $response['code']=200;
  $response['msg']='Contact created successfully';
  $response['data']=['id_on_server'=>$record_id];


  return ($response);


}


function process_single_contact($db,$owner_mobile,$postinfo,$deviceID)
{

  $all_fields = array();


  $all_fields['name']=array('name'=>'Contact Name','is_req'=>1,'type'=>'text');
  $all_fields['tags']=array('name'=>'Tags','is_req'=>0,'type'=>'tags');
  $all_fields['duedate']=array('name'=>'Due Date','is_req'=>0,'type'=>'date');
  $all_fields['email']=array('name'=>'Email Address','is_req'=>0,'type'=>'text');
  $all_fields['city']=array('name'=>'City','is_req'=>0,'type'=>'text');
  $all_fields['country_code']=array('name'=>'Country Code','is_req'=>1,'type'=>'dropdown');
  $all_fields['mobile']=array('name'=>'Mobile Number/Customer ID','is_req'=>1,'type'=>'number');
  $all_fields['number']=array('name'=>'International Format','is_req'=>0,'type'=>'text');
  $all_fields['type']=array('name'=>'Type','is_req'=>1,'type'=>'dropdown');
  $all_fields['balance_status']=array('name'=>'Balance Status','is_req'=>1,'type'=>'dropdown');
  $all_fields['balance']=array('name'=>'Current Balance','is_req'=>0,'type'=>'number');
  $all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown');
  $all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

  $_SESSION['sess_bp_username']=$owner_mobile;
  $table='contacts';

  $response['code']=100;
  $response['msg']='invalid request.';

  $err=[];
  // print_r($postinfo);

  if(empty($postinfo['name'])){
    $err[]='Contact Name is Required.';
  }

  if(empty($postinfo['country_code'])){
    $err[]='Code is Required.';
  }

  if(empty($postinfo['mobile'])){
    $err[]='Mobile Number / ID is Required.';
  }

  if(empty($postinfo['balance_status'])){
    $err[]='Balance Type is Required.';
  }

  if(empty($postinfo['status'])){
    $err[]='Status is Required.';
  }

  if(count($err)==0)
  {
    $response['code']=count($err);
    $response['msg']='no error found.';

    if($postinfo['id_on_server']==null)
    {
      $response['msg']='id on server is null';
      if($postinfo['number']=='' || $postinfo['number']==null)
      {

        // report error because number can't be empty.

        $response[] = insert_single_contact($db,$owner_mobile,$postinfo,$deviceID,$table);


      }else{
        $published_status='Published';
        $unique_number_qry = "select * from `$table` where `owner_mobile`=:owner_mobile and `number`=:number and `status`=:status";
        $stmt = $db->prepare($unique_number_qry);
        $stmt->bindParam('owner_mobile', $postinfo['owner_mobile'], PDO::PARAM_STR);
        $stmt->bindParam('number', $postinfo['number'], PDO::PARAM_STR);
        $stmt->bindParam('status', $published_status, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();

        if($count == 0)
        {
          // insert item
          $response = insert_single_contact($db,$owner_mobile,$postinfo,$deviceID,$table);

       }else{
         // return error...
         $err[]='Contact Number must be unique. count:' .$count;
         while($row   = $stmt->fetch(PDO::FETCH_ASSOC))
         {
           $err[]='id: '.$row['id'].' name: '.$row['name'].' number: '.$row['number'];
         }

         $response['code']=303;
         $response['msg']=$err;

       }



    }

  }else{
    $response['msg']='id on server is not null '.$postinfo['id_on_server'];

    // update already existing product.
    $response=update_single_contact($db,$owner_mobile,$postinfo,$deviceID,$table);

  }


}else{
    $response['code']=count($err);
    $response['msg']=$err;
  }



  return json_encode($response);

}


function store_contacts($db,$owner_mobile,$inputData,$deviceID)
{
  $response=[];

  foreach($inputData as $record)
  {
    $response[$record['_id']]=process_single_contact($db,$owner_mobile,$record,$deviceID);
  }

  return ($response);

}

//////////////////////////////////////////


function get_data2sync_contacts($db,$owner_mobile,$deviceID)
{
  if($owner_mobile)
  {
    $time = time();
    $qry = "select * from `contacts` where `owner_mobile`='$owner_mobile' and `sync` NOT LIKE '%$deviceID%' ";
    $stmt = $db->prepare($qry);

    try{
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count>0)
      {
        $contacts=array();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
          $contacts[]=json_encode($row);
          $response['data'][$row['id']]=$row;
        }
        $response['code'] = 200;
        $response['msg'] = 'Contacts fetched successfully.';
        $response['count']=count($contacts);
        }else{
        $response['code'] = 201;
        $response['msg'] = 'No Contacts Found.';
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
