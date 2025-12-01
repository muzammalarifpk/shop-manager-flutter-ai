<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-stock-transfer.config.php");

//print_r($_POST);
function update_stock_on_location($db,$product_id,$qty,$from_location,$to_location)
{
  //  echo "<h2>product_id: $product_id</h2>";
  //  echo "<h2>from_location: $from_location</h2>";
  //  echo "<h2>to_location: $to_location</h2>";
  //   echo "<h2>qty: $qty</h2>";
  $old_stock_on_location = gnr($db,'products','id',$product_id,'stock_on_locations');
  $old_stock_on_location_array = json_decode($old_stock_on_location,true);
  $this_location_handle = 'sl_'.$to_location;

  //
  // echo "<h2>Old stock on location array</h2>";
  // print_r($old_stock_on_location_array);
  // echo "<h2>to location handler</h2>";
  // print_r($this_location_handle);


  if(is_array($old_stock_on_location_array))
  {
     // echo "<h3>Old Data for this item already exists.</h3>";
    if(isset($old_stock_on_location_array[$this_location_handle]))
    {
      if(isset($old_stock_on_location_array['sl_'.$from_location])){
//        echo "<h4>key already set for from location</h4>";
        $new_stock_on_location_array = $old_stock_on_location_array;

        $new_stock_on_location_array[$this_location_handle] = $old_stock_on_location_array[$this_location_handle] + $qty;
        $new_stock_on_location_array['sl_'.$from_location] = $old_stock_on_location_array['sl_'.$from_location] - $qty;
      }else{
        $new_stock_on_location_array[$this_location_handle] = $old_stock_on_location_array[$this_location_handle] + $qty;
        $new_stock_on_location_array['sl_'.$from_location] = 0 - $qty;
      }
    }else{
//      echo "<h4>key not found for to location</h4>";
      $old_stock_on_location_array[$this_location_handle] = $qty;
      $old_stock_on_location_array['sl_'.$from_location] = $old_stock_on_location_array['sl_'.$from_location] - $qty;
      $new_stock_on_location_array = $old_stock_on_location_array;
    }
  }else{
   // echo "<h3>No Old data exists.</h3>";
    $new_stock_on_location_array[$this_location_handle] = $qty;
    $new_stock_on_location_array['sl_'.$from_location] = ($qty)*(-1);
  }
//  echo '<h4>new stock on location array</h4>';
//  print_r($new_stock_on_location_array);
  $new_stock_on_location=json_encode($new_stock_on_location_array);
//  print_r($new_stock_on_location);

  $update_qry = "update `products` set `stock_on_locations`=:stock_on_locations where `id`=:product_id and `owner_mobile`=:owner_mobile ";
  $update = $db->prepare($update_qry);

  $update->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
  $update->bindParam('stock_on_locations', $new_stock_on_location);
  $update->bindParam('product_id', $product_id);

  try{
    $update->execute();
    return true;
  }catch (PDOException $e)
  {
    return false;
  }
  return false;


}

$insert_qry = "insert into `stock_transfer` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `from_location`=:from_location,  `to_location`=:to_location,  `cartitems`=:cartitems,  `notes`=:notes,  `date`=:date";

$stmt = $db->prepare($insert_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $_POST['status']);
$stmt->bindParam('last_updated', $time);
$stmt->bindParam('from_location', $_POST['from_location']);
$stmt->bindParam('to_location', $_POST['to_location']);
$stmt->bindParam('notes', $_POST['notes']);
$stmt->bindParam('date', $_POST['date']);
$stmt->bindParam('cartitems', $_POST['products']);

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';

try
{
  $stmt->execute();
  $job_id=$db->lastInsertId();
  $response['code'] = 200;
  $response['msg'] = $job_id;

  $products_array = json_decode_gfs($_POST['products'],true);
  foreach ($products_array as $key => $value) {
    // code...
   // print_r($value);
  // echo gettype($value);
    $product_id = $value->item_id;
    $qty = $value->item_qty;
    $from_location = $_POST['from_location'];
    $to_location = $_POST['to_location'];

/*
    echo "<h1>Product id: $product_id</h1>";
    echo "<h2>Product Qty: $qty</h2>";
    echo "<h2>From Location: $from_location</h2>";
    echo "<h2>To Location: $to_location</h2>";
*/
    update_stock_on_location($db,$product_id,$qty,$from_location,$to_location);
//    echo "<hr />";
  }

} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode($response));
?>
