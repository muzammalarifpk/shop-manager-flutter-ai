<?php
include("dbc.php");
//print_r($_POST);
if(isset($_POST['s_number']) && $_POST['s_number'] != '' && isset($_POST['e_number']) && $_POST['e_number'] != '' && isset($_POST['e_password']) && $_POST['e_password'] != '') {

  $s_number = trim($_POST['s_number']);
  $e_number = trim($_POST['e_number']);
  $e_password = md5(trim($_POST['e_password']));
  $status='published';

  if($s_number != "" && $e_number != "" && $e_password != "") {
    try {
      $query = "select * from `pos_access` where `number`=:e_number and  `owner_mobile`=:s_number and `password`=:password and `status`=:status";
      $stmt = $db->prepare($query);
      $stmt->bindParam('e_number', $e_number, PDO::PARAM_STR);
      $stmt->bindValue('s_number', $s_number, PDO::PARAM_STR);
      $stmt->bindValue('password', $e_password, PDO::PARAM_STR);
      $stmt->bindValue('status', $status, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
      //  echo 'employee found success.';
        $shop_query = "select * from `users` where `number`=:s_number";
        $shop_stmt = $db->prepare($shop_query);
        $shop_stmt->bindValue('s_number', $s_number, PDO::PARAM_STR);
        $shop_stmt->execute();

        $shop_count = $shop_stmt->rowCount();
        $shop_row   = $shop_stmt->fetch(PDO::FETCH_ASSOC);
        if($shop_count == 1 && !empty($shop_row)) {

          $_SESSION['sess_bp_user_id']   = $shop_row['id'];
          $_SESSION['sess_bp_username'] = $shop_row['number'];
          $_SESSION['sess_bp_emp'] = $row['number'];
          $_SESSION['sess_bp_timestamp'] = $shop_row['timestamp'];
          $_SESSION['sess_bp_privs'] = explode(',',str_replace(',-','',str_replace("-,",'',$row['privs'])));
          $_SESSION['sess_bp_name'] = $shop_row['business_name'];
          $_SESSION['sess_bp_currency'] = $shop_row['currency'];
          $_SESSION['sess_bp_gst'] = $shop_row['gst'];
          $_SESSION['sess_bp_vat'] = $shop_row['vat'];
          $_SESSION['sess_bp_barcode'] = $shop_row['barcode'];

          $_SESSION['sess_account_keys'] = json_decode($shop_row['default_account_keys'],true);
          echo "dashboard.php";

        }else{
          echo 'invalid';
        }
      } else {
        echo "invalid";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    echo "Both fields are required!";
  }
} else {
  echo 'invalid';
}
?>
