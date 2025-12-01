<?php
$target_dir = "uploads/images/";

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

$insert_qry = "insert into `gallery` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `ref_id`=:ref_id, `type`=:type, `file_type`=:file_type,  `file_path`=:file_path,  `file_name`=:file_name";

$stmt = $db->prepare($insert_qry);

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';

try
{


  if (!empty($_FILES)) {

       $status = 'Published';
       $type = 'contacts';
       $ref_id = $_GET['id'];

       // Upload file
       $tempFile = basename($_FILES["file"]["name"]);
       $new_file_name = $type.'-'.floatval($_SESSION['sess_bp_username']).'-'.$time.'-'.strtolower(str_replace(" ",'',$tempFile));
       $target_file = $target_dir . $new_file_name;

       $file_size = getimagesize($_FILES["file"]["tmp_name"]);
       if($file_size !== false) {
         $file_type = 'image';
       } else {
         $file_type = 'video';
       }


       if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
         $response['code'] = 200;
         $response['msg'] = $target_file;
       }else{
         $response['code'] = 201;
         $response['msg'] = 'Failed to upload file php'." Not uploaded because of error #".$_FILES["file"]["error"];

        }
       $stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
       $stmt->bindParam('timestamp', $time);
       $stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
       $stmt->bindParam('status', $status);
       $stmt->bindParam('last_updated', $time);
       $stmt->bindParam('type', $type);
       $stmt->bindParam('file_type', $file_type);
       $stmt->bindParam('ref_id', $ref_id);
       $stmt->bindParam('file_path', $target_file);
       $stmt->bindParam('file_name', $tempFile);

       if($response['code'] == 200)
       {
         $stmt->execute();
         $job_id=$db->lastInsertId();
      }

  }else{
    $response['code'] = 300;
    $response['msg'] = 'No File Received';

  }


} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode($response));
?>
