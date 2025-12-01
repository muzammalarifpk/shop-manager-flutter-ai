<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-payments.config.php");

//echo $_POST['invoiceid'];

$id = $_POST['invoiceid'];

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';


$owner_mobile=$_SESSION['sess_bp_username'];
$time=time();
$last_updated=time();
$invoice_id = $_POST['invoiceid'];

if($_SESSION['sess_bp_privs']!='*')
{
  $response['code'] = 403;
  $response['msg'] = 'Only admin can delete an invoice.';
}else{
    $status = 'delete';

    $update_invoice_qry="update `payments` set `status`='$status' where `owner_mobile`='$owner_mobile' and `id`='$id'";
    $stmt_update_invoice_qry=$db->prepare($update_invoice_qry);


    $select_invoice_qry="select * from `payments` where `id`='$id' and `owner_mobile`='$_SESSION[sess_bp_username]'";

    if ($res = $db->query($select_invoice_qry))
    {
        if ($res->fetchColumn() > 0)
        {
            foreach ($db->query($select_invoice_qry) as $row)
            {

              $payment_type = $row['payment_type'];
              if($payment_type=='Received')
              {
                $payment_type = 'Paid';
              }else{
                $payment_type = 'Received';
              }
              $amount = $row['amount'];
              $date = $row['date'];
              $contact_number = 'c'.$row['contact_number'];
              $payment_method = $row['payment_method'];
              $description = $row['description'];


              $sale_qry = "insert into `payments` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `amount`=:amount, `date`=:date, `contact_number`=:contact_number, `payment_method`=:payment_method, `description`=:description, `payment_type`=:payment_type ";

              //echo $sale_qry;

              $status = 'delete';
              $stmt = $db->prepare($sale_qry);

              $stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
              $stmt->bindParam('timestamp', $time);
              $stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
              $stmt->bindParam('status', $status);
              $stmt->bindParam('last_updated', $time);

              $stmt->bindParam('contact_number', $row['contact_number']);
              $stmt->bindParam('date',  $date);
              $stmt->bindParam('payment_type',  $payment_type);
              $stmt->bindParam('amount',  $amount);
              $stmt->bindParam('description',  $description);
              $stmt->bindParam('payment_method',  $payment_method);

              try{
                $stmt->execute();
                $saleid=$db->lastInsertId();
              }catch(Exception $e){
                $response['code'] = 401;
                $response['msg'] = 'Error creating counter entry...';
                print_r($response);
                die();
              }


              if($payment_type=='Paid')
              {
                $credit_array=array(array('account'=>$payment_method,'amount'=>$amount));
                $debit_array=array(array('account'=>$contact_number,'amount'=>$amount));
              }else{
                $debit_array=array(array('account'=>$payment_method,'amount'=>$amount));
                $credit_array=array(array('account'=>$contact_number,'amount'=>$amount));
              }

              $entry_type='paymentid: '. $description;
              $entry_link='paymentid:'.$saleid;
              journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
    }

    $update_ledger_qry="update `ledger` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='paymentid:$id'";
    $stmt_update_ledger_qry=$db->prepare($update_ledger_qry);

    $update_ledger_return_qry="update `ledger` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='paymentid:$saleid'";
    $stmt_update_ledger_return_qry=$db->prepare($update_ledger_return_qry);

    $update_journal_return_qry="update `journal` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='paymentid:$saleid'";
    $stmt_update_journal_return_qry=$db->prepare($update_journal_return_qry);

    $update_journal_qry="update `journal` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='paymentid:$saleid'";
    $stmt_update_journal_qry=$db->prepare($update_journal_qry);


  }
}



    try{

      $stmt_update_invoice_qry->execute();

      $stmt_update_ledger_qry->execute();
      $stmt_update_ledger_return_qry->execute();
      $stmt_update_journal_return_qry->execute();
      $stmt_update_journal_qry->execute();

      $response['code'] = 200;
      $response['msg'] = 'Invoice Status updated successfully...';

    }catch(Exception $e){
      $response['code'] = 401;
      $response['msg'] = 'Error deleting invoice...';
    }

}
print_r(json_encode_gfs($response));
die();

?>
