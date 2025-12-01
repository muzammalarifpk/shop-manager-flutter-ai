<?php

require_once("su-products.config.php");
require_once("includes/libs/form.cls.php");

$status=$_POST['status'];
$name=$_POST['name'];
$category=$_POST['category'];
$secondary_units=[];

if(array_key_exists('secondary_unit',$_POST))
{
  foreach ($_POST['secondary_unit'] as $key => $value) {
    // Secondary units array...
    if($_POST['primary_unit_qty'][$key]!='')
    {
      $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$_POST['primary_unit_qty'][$key]);
    }
  }
}
$lend_inventory = 'off';
if(array_key_exists('lend_inventory',$_POST))
{
  $lend_inventory = $_POST['lend_inventory'];
}

$secondary_units_count = count($secondary_units);
$secondary_units_json = json_encode($secondary_units);

$tax = '';
if(isset($_POST['tax'])){$tax=$_POST['tax'];}

$description=$_POST['description'];
$measuring_unit=$_POST['measuring_unit'];
$min_stock_limit=$_POST['min_stock_limit'];
$max_stock_limit=$_POST['max_stock_limit'];
$purchase_cost=$_POST['purchase_cost'];
$sale_price=$_POST['sale_price'];
$wholesale_price=$_POST['wholesale_price'];
$sku=$_POST['sku'];

$platforms = implode(",",$_POST['platforms']);
$youtube_link=$_POST['youtube_link'];
$title=$_POST['title'];
$product_description=$_POST['product_description'];



$barcode=$_POST['barcode'];
$tags=','.$_POST['tags'].',';
$notes=$_POST['notes'];
$salesman_commission = '';
$agent_commission = '';
if(isset($_POST['salesman_commission'])){$salesman_commission=$_POST['salesman_commission'];}
if(isset($_POST['agent_commission'])){$agent_commission=$_POST['agent_commission'];}

$owner_mobile=$_SESSION['sess_bp_username'];

$id=$_POST['id'];

$secondary_units=[];
if(array_key_exists('secondary_unit',$_POST))
{
  foreach ($_POST['secondary_unit'] as $key => $value) {
    // Secondary units array...
    if($_POST['primary_unit_qty'][$key]!='')
    {
      $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$_POST['primary_unit_qty'][$key]);
    }
  }
}

$secondary_units_count = count($secondary_units);
$secondary_units = json_encode($secondary_units);

//echo $lend_inventory;

$update_qry="update `products` set `status`='$status',`name`='$name', `category`='$category', `tax`='$tax', `lend_inventory`='$lend_inventory', `description`='$description', `measuring_unit`='$measuring_unit', `min_stock_limit`='$min_stock_limit', `max_stock_limit`='$max_stock_limit',  `purchase_cost`='$purchase_cost', `sale_price`='$sale_price',  `wholesale_price`='$wholesale_price', `sku`='$sku', `product_description`='$product_description', `title`='$title', `youtube_link`='$youtube_link', `platforms`='$platforms', `barcode`='$barcode', `tags`='$tags', `notes`='$notes', `secondary_unit_count`='$secondary_units_count', `secondary_units`='$secondary_units', `salesman_commission`='$salesman_commission', `agent_commission`='$agent_commission' where `owner_mobile`='$owner_mobile' and `id`='$id'";

$stmt=$db->prepare($update_qry);


try{

$stmt->execute();

echo 'success';
}catch(Exception $e){
  echo 'Error.';
}
?>
