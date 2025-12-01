<?php
require_once('includes/dbc.php');


// print_r($_REQUEST);
// print_r($_SESSION);


$data = [
  'owner_mobile' => $_POST['shop_number'],
  'timestamp' => time(),
  'added_by' => 'moqame',
  'status' => 'Published',
  'last_updated' => time(),
  'sync' => '0',

  'PHPSESSID' => session_id(),
  'item_id' => $_POST['item_id'],
  'item_qty' => $_POST['item_qty'],
  'sale_price' => $_POST['sale_price'],
  'total' => $_POST['total'],
  ];
$addtocart_sql = "INSERT INTO `store_cart_items` (`owner_mobile`, `timestamp`, `added_by`, `status`, `last_updated`,`sync`, `PHPSESSID`, `item_id`, `item_qty`, `sale_price`, `total`) VALUES (:owner_mobile, :timestamp, :added_by, :status, :last_updated, :sync, :PHPSESSID, :item_id, :item_qty, :sale_price, :total)";
$stmt= $db->prepare($addtocart_sql);

try{
$stmt->execute($data);
$cartitem_id = $db->lastInsertId();

  $response = array('code' => 200,'msg'=>'Item Added to Cart', 'data'=>$cartitem_id );
} catch(PDOException $e) {
  $response = array('code' => 301,'msg'=>'Failed to add item to cart', 'data'=>$e );

}

echo json_encode($response);
?>
