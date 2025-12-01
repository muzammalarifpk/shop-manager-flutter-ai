<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-purchase.config.php");

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';


$owner_mobile=$_SESSION['sess_bp_username'];
$time=time();
$last_updated=time();
$invoice_id = $_POST['invoiceid'];
$id = $_POST['invoiceid'];

if($_SESSION['sess_bp_privs']!='*')
{
  $response['code'] = 403;
  $response['msg'] = 'Only admin can delete an invoice.';
}else{
    $status = 'delete';

    $update_invoice_qry="update `purchase_invoices` set `status`='$status' where `owner_mobile`='$owner_mobile' and `id`='$invoice_id'";
    $stmt_update_invoice_qry=$db->prepare($update_invoice_qry);


    $select_invoice_qry="select * from `purchase_invoices` where `id`='$id' and `owner_mobile`='$_SESSION[sess_bp_username]'";

    if ($res = $db->query($select_invoice_qry))
    {
        if ($res->fetchColumn() > 0)
        {
            foreach ($db->query($select_invoice_qry) as $row)
            {

              /*
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
              */

              $purchase_qry = "insert into `purchase_invoices_returns` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated,  `cartitems`=:cartitems,  `contact_number`=:contact_number,  `date`=:date,  `sub_total`=:sub_total,  `discount`=:discount,  `grand_total`=:grand_total,  `amount_paid`=:amount_paid,  `payment_method`=:payment_method,  `remaining_amount`=:remaining_amount, `notes`=:notes ";

              //echo $sale_qry;

              $status = 'delete';
//              $secondary_json = json_encode($row['secondary_json']);

              $stmt = $db->prepare($purchase_qry);

              $stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
              $stmt->bindParam('timestamp', $time);
              $stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
              $stmt->bindParam('status', $status);
              $stmt->bindParam('last_updated', $time);
              $stmt->bindParam('cartitems', $row['cartitems']);
//              $stmt->bindParam('variants_json', $row['variants_json']);
//              $stmt->bindParam('secondary_json', $secondary_json);
              $stmt->bindParam('contact_number', $row['contact_number']);
              $stmt->bindParam('date',  $row['date']);
              $stmt->bindParam('sub_total',  $row['sub_total']);
              $stmt->bindParam('discount',  $row['discount']);
//              $stmt->bindParam('tax',  $row['tax']);
              $stmt->bindParam('grand_total',  $row['grand_total']);
              $stmt->bindParam('amount_paid',  $row['amount_paid']);
              $stmt->bindParam('payment_method',  $row['payment_method']);
//              $stmt->bindParam('cost_of_sale',  $cost_of_sale);
              $stmt->bindParam('notes',  $row['notes']);
              $stmt->bindParam('remaining_amount',  $row['remaining_amount']);
              $stmt->execute();

              $purchaseid=$db->lastInsertId();

              $purchases_account=$_SESSION['sess_account_keys']['purchases'];
              $purchases_discount_account=$_SESSION['sess_account_keys']['purchasediscount'];


              $credit_array=array(array('account'=>$purchases_account,'amount'=>$row['sub_total']));
              $debit_array=array(array('account'=>'c'.$row['contact_number'],'amount'=>$row['remaining_amount']),array('account'=>$row['payment_method'],'amount'=>$row['amount_paid']),array('account'=>$purchases_discount_account,'amount'=>$row['discount']));


              $entry_type='purchase_return: '. $row['notes'];
              $entry_link='purchase_return_id:'.$purchaseid;


              journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

              $cart_items=json_decode_gfs($row['cartitems'],true);

              foreach($cart_items as $key => $val)
              {
                $products_array[]=array('product_id'=>$val['item_id'],'unit_price'=>$val['row_rate'],'qty'=>$val['row_qty'],'qty_before'=>$val['qty_before'],'cost_per_unit'=>$val['cost_per_unit'],'unit_measure'=>$val['unit_measure']);
              }


              $gtotal_purchase = $row['grand_total'];
              $gpurchase_discount = $row['discount'];
              graph_entry($db,$row['date'],0,0,$gtotal_purchase,0,0,0,$gpurchase_discount);

              update_stock_history($db,$purchaseid,$row['date'],'purchase_return',$products_array);

              try{

                $stmt_update_invoice_qry->execute();

                $response['code'] = 200;
                $response['msg'] = 'Invoice Status updated successfully...';

              }catch(Exception $e){
                $response['code'] = 401;
                $response['msg'] = 'Error deleting invoice...';
              }



    }
  }
}


}
print_r(json_encode_gfs($response));

?>
