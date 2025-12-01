<?php
require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

$select_qry="select * from `shipping_receipt_history` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' and `id`='$_GET[invoiceId]' order by `id` desc";

$shipping_data=array();

foreach ($db->query($select_qry) as $row) {

  $customer_shop_address = gnr($db,'contacts','number',$row['contact_number'],'city');
  $shipping_company = gnr($db,'contacts','number',$row['contact_number'],'notes');
  $customer_shop_name = gnr($db,'contacts','number',$row['contact_number'],'name');

  $shipping_data[]=array('contact_number'=>$row['contact_number'],'date' => $row['date'], 'id' => $row['id'], 'total_expense'=>$row['total_expense'], 'picker_guy'=>$row['picker_guy'],'unit7'=>$row['unit7'],'unit6'=>$row['unit6'],'unit5'=>$row['unit5'],'unit4'=>$row['unit4'],'unit3'=>$row['unit3'],'unit2'=>$row['unit2'],'unit1'=>$row['unit1'],'qty1'=>$row['qty1'],'qty2'=>$row['qty2'],'qty3'=>$row['qty3'],'qty4'=>$row['qty4'],'qty5'=>$row['qty5'],'qty6'=>$row['qty6'],'qty7'=>$row['qty7'],'customer_shop_address'=>$customer_shop_address,'shipping_company'=>$shipping_company,'customer_shop_name'=>$customer_shop_name);
}
$response['code'] = 200;
$response['msg'] = $shipping_data;

print_r(json_encode($response));

?>
