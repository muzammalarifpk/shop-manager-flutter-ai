<?php

require_once('includes/dbc.php');

// print_r($_REQUEST);

$PHPSESSID=session_id();
$data = [
  'owner_mobile' => $_POST['shop_number'],
  'timestamp' => time(),
  'added_by' => 'moqame',
  'status' => 'Published',
  'last_updated' => time(),
  'sync' => '0',

  'PHPSESSID' => $PHPSESSID,
  'item_id' => $_POST['item_id'],
  ];

  // echo json_encode($data);
  // die();
$cart_sql = "DELETE FROM `store_cart_items` WHERE `id`='$_POST[item_id]' and `PHPSESSID`='$PHPSESSID'";
// echo $cart_sql;
$stmt= $db->prepare($cart_sql);

try{
$stmt->execute();
$cartitem_id = $db->lastInsertId();

  $response = array('code' => 200,'msg'=>'Item Removed from Cart', 'data'=>$cartitem_id );
} catch(PDOException $e) {
  $response = array('code' => 301,'msg'=>'Failed to remove item from cart', 'data'=>$e );

}

echo json_encode($response);
?>
