<?php
require_once('includes/dbc.php');
 $owner_mobile=$_SESSION['sess_bp_username'];
//print_r($_REQUEST);



//$select_lend_qry = "SELECT m1.* FROM lend_inventory m1 LEFT JOIN lend_inventory m2 ON (m1.item_id = m2.item_id AND m1.id < m2.id) WHERE `m2.owner_mobile`=:owner_mobile and `m2.contact_number`=:cname  and  m2.id IS NULL";
// echo $select_lend_qry;


$cname=trim($_REQUEST['cname']);
if(substr($cname,0,1)=='+')
{
  // do nothing
}else{
  $cname='+'.$cname;
}
// echo $cname;

$lend_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and `lend_inventory`='on' and (`status`='published' or `status`='Published')";

$lend_inventory_array=[];

foreach ($db->query($lend_query) as $lend)
{
  $grand_total_qty = gnrms($db,'lend_inventory',"`owner_mobile`='$owner_mobile' and `item_id`='$lend[id]' and `contact_number`='$cname'",'grand_total_qty','id');
  $lend_inventory_array[]=['item_id'=>$lend['id'],'grand_total_qty'=>$grand_total_qty];
}

// $select_lend_qry="select MAX(id),contact_number,item_id,grand_total_qty from `lend_inventory` where `owner_mobile`=:owner_mobile and `contact_number`=:cname group by `item_id`";
//
// $select_lend_qry = "SELECT   * FROM `lend_inventory` WHERE `id` IN (SELECT MAX(id) FROM `lend_inventory`  GROUP BY `item_id`)";
//
// $lends=$db->prepare($select_lend_qry);
//
// //print_r($data);
// $data=['cname'=>$cname,'owner_mobile'=>$owner_mobile];
// $lends->execute($data);
//
//
// while($lend_row=$lends->fetch())
// {
// //  echo 'while';
//   $grand_total_qty = glnr($db,'lend_inventory','item_id',$lend_row['item_id'],'grand_total_qty');
//   $lend_inventory_array[]=['item_id'=>$lend_row['item_id'],'grand_total_qty'=>$grand_total_qty];
// //  print_r($lend_row);
// }


echo json_encode_gfs($lend_inventory_array);

?>
