<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-sale.config.php");

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

    $update_invoice_qry="update `sale_invoices` set `status`='$status' where `owner_mobile`='$owner_mobile' and `id`='$id'";
    $stmt_update_invoice_qry=$db->prepare($update_invoice_qry);


    $select_invoice_qry="select * from `sale_invoices` where `id`='$id' and (`status` ='Published' || `status`= 'published' ) and `owner_mobile`='$_SESSION[sess_bp_username]'";

    if ($res = $db->query($select_invoice_qry))
    {
        if ($res->fetchColumn() > 0)
        {
            foreach ($db->query($select_invoice_qry) as $row)
            {


              $cost_of_sale=0;
              $cart_items=json_decode($row['cartitems'],true);

              foreach($cart_items as $key => $val)
              {
                $cost_of_sale= $cost_of_sale+($val['cost_per_unit']*$val['row_qty']);
                $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
              }
              $variants_array=array();
              $variants_items = json_decode($row['variants_json'],true);
              if(is_array($variants_items))
              {
                foreach ($variants_items as $key => $value)
                {
                  $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['variant_qty'],'qty_before'=>$value['this_variant_qty_before']);
                }
              }

              $sale_qry = "insert into `sale_invoices_returns` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `cartitems`=:cartitems,  `variants_json`=:variants_json,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `tax`=:tax,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `cost_of_sale`=:cost_of_sale,  `remaining_amount`=:remaining_amount, `notes`=:notes, `secondary_json`=:secondary_json, `services_count`=:services_count, `cart_items_services`=:cart_items_services ";

              //echo $sale_qry;

              $status = 'delete';
              $secondary_json = json_encode($row['secondary_json']);

              $stmt = $db->prepare($sale_qry);

              $stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
              $stmt->bindParam('timestamp', $time);
              $stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
              $stmt->bindParam('status', $status);
              $stmt->bindParam('last_updated', $time);
              $stmt->bindParam('cartitems', $row['cartitems']);
              $stmt->bindParam('variants_json', $row['variants_json']);
              $stmt->bindParam('secondary_json', $secondary_json);
              $stmt->bindParam('contact_number', $row['contact_number']);
              $stmt->bindParam('date',  $row['date']);
              $stmt->bindParam('sub_total',  $row['sub_total']);
              $stmt->bindParam('discount',  $row['discount']);
              $stmt->bindParam('tax',  $row['tax']);
              $stmt->bindParam('services_count',  $row['service_count']);
              $stmt->bindParam('cart_items_services',  $row['cart_items_services']);
              $stmt->bindParam('grand_total',  $row['grand_total']);
              $stmt->bindParam('amount_paid',  $row['amount_paid']);
              $stmt->bindParam('payment_method',  $row['payment_method']);
              $stmt->bindParam('cost_of_sale',  $cost_of_sale);
              $stmt->bindParam('notes',  $row['notes']);
              $stmt->bindParam('remaining_amount',  $row['remaining_amount']);
              $stmt->execute();

              $saleid=$db->lastInsertId();
              $sales_account=$_SESSION['sess_account_keys']['sales'];
              $tax_account=$_SESSION['sess_account_keys']['tax'];
              $sales_discount_account=$_SESSION['sess_account_keys']['salediscount'];

              $entry_type='sale_return: '. $row['notes'];
              $entry_link='sale_return_id:'.$saleid;




              $debit1_amount=($row['grand_total']+$row['discount']);
              $credit2_amount=($row['amount_paid']+$row['discount']);

              $credit_array1=array(array('account'=>'c'.$row['contact_number'],'amount'=>$debit1_amount));
              $debit_array1=array(array('account'=>$sales_account,'amount'=>$row['sub_total']),array('account'=>$tax_account,'amount'=>$row['tax']));
              $journal1=journal_entry($db,$credit_array1,$debit_array1,$entry_type,$entry_link);


              $credit_array2=array(array('account'=>$sales_discount_account,'amount'=>$row['discount']),array('account'=>$row['payment_method'],'amount'=>$row['amount_paid']));
              $debit_array2=array(array('account'=>'c'.$row['contact_number'],'amount'=>$credit2_amount));
              $journal2=journal_entry($db,$credit_array2,$debit_array2,$entry_type,$entry_link);


              $gsub_total=$row['grand_total'];
              $gsale_discount = $row['discount'];
              $gcost_of_sale = $cost_of_sale;
              $gprofit = $gsub_total-$gcost_of_sale;


              $total_sale_return = ($gsub_total) * (-1);
              $total_cost_of_sale_return = ($gcost_of_sale) * (-1);
              $total_profit_return = ($gprofit) * (-1);
              $total_sale_discount_return = ($gsale_discount) * (-1);

              graph_entry($db,$row['date'],$gsub_total*(-1),$gcost_of_sale*(-1),0,0,$gprofit*(-1),$gsale_discount*(-1),0);

              update_stock_history($db,$saleid,$row['date'],'sale_return',$products_array);
              if(count($variants_array)>0)
              {
                foreach ($variants_array as $key => $value) {
                  // code...
                  update_stock_variant_history($db,'sale_invoices:'.$saleid,$row['date'],'sale_return',$value);
                }
              }



    }

    $update_ledger_qry="update `ledger` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='sale_id:$id'";
    $stmt_update_ledger_qry=$db->prepare($update_ledger_qry);

    $update_ledger_return_qry="update `ledger` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='sale_return_id:$saleid'";
    $stmt_update_ledger_return_qry=$db->prepare($update_ledger_return_qry);

    $update_journal_return_qry="update `journal` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='sale_return_id:$saleid'";
    $stmt_update_journal_return_qry=$db->prepare($update_journal_return_qry);

    $update_journal_qry="update `journal` set `status`='$status' where `owner_mobile`='$owner_mobile' and `entry_link`='sale_id:$saleid'";
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
print_r(json_encode($response));
die();

?>
