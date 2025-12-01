<?php
require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-contacts.config.php");

$select_images_qry = "select * from `gallery` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='contacts' and `ref_id`='$_GET[id]' and `status`='Published' order by `id` asc";
$images_array=array();
foreach ($db->query($select_images_qry) as $row) {
  $images_array[]=array('img_id'=>$row['id'],'file_path' => $row['file_path'], 'file_name'=>$row['file_name'], 'uploaddate'=>date("d-M-Y",$row['timestamp']),'filetype'=> $row['file_type']);
}
$response['code'] = 200;
$response['msg'] = $images_array;

print_r(json_encode($response));
?>
