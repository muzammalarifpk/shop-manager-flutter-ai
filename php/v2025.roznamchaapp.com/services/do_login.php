<?php
include("dbc.php");
if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
  $username = trim($_POST['username']);
  $password = md5(trim($_POST['password']));
  $status='Published';
  if($username != "" && $password != "") {
    try {
      $query = "select * from `users` where `number`=:username and `password`=:password and `status`=:status";
      $stmt = $db->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->bindValue('status', $status, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        $time=time();

        $update_login_count_qry = "UPDATE  `users` SET `login_count`=login_count+1 WHERE `number`='$username' ";
        $update_login_count=$db->prepare($update_login_count_qry);
        $update_login_count->execute();


        /******************** Your code ***********************/
        $_SESSION['sess_bp_user_id']   = $row['id'];
        $_SESSION['sess_bp_username'] = $row['number'];
        $_SESSION['sess_bp_country'] = $row['country_code'];
        $_SESSION['sess_bp_emp'] = $row['number'];
        $_SESSION['sess_bp_name'] = $row['business_name'];
        $_SESSION['sess_bp_adr'] = $row['address'];
        $_SESSION['sess_bp_privs'] = '*';
        $_SESSION['sess_bp_currency'] = $row['currency'];
        $_SESSION['sess_bp_gst'] = $row['gst'];
        $_SESSION['sess_bp_vat'] = $row['vat'];
        $_SESSION['sess_bp_tax'] = $row['tax'];
        $_SESSION['sess_bp_barcode'] = $row['barcode'];
        $_SESSION['sess_bp_salesman_commission'] = $row['salesman_commission'];
        $_SESSION['sess_bp_agent_commision'] = $row['agent_commision'];

        $_SESSION['sess_bp_type'] = $row['type'];
        $_SESSION['sess_bp_timestamp'] = $row['timestamp'];
        $_SESSION['sess_bp_date'] = $row['date'];
        $_SESSION['sess_bp_coin'] = $row['coins'];

        $_SESSION['sess_bp_print_header'] = $row['print_header'];
        $_SESSION['sess_bp_print_urdu_invoice'] = $row['print_urdu_invoice'];

        $_SESSION['sess_bp_print_header_note'] = $row['print_header_note'];
        $_SESSION['sess_bp_print_footer_note'] = $row['print_footer_note'];
        $_SESSION['sess_bp_print_default_template'] = $row['print_default_template'];

        $_SESSION['sess_bp_variants'] = $row['variants'];
        $_SESSION['sess_bp_secondary_units'] = $row['secondary_units'];
        $_SESSION['sess_bp_lend_inventory'] = $row['lend_inventory'];
        $_SESSION['sess_account_keys'] = json_decode($row['default_account_keys'],true);

        $logo_file = $row['logo'];
          if(file_exists('../'.$logo_file))
          {
            $logo_url=$logo_file;
          }else{
            $logo_url = 'img/imageholders.png';
          }


        if($row['timestamp']>1577836800)
        {
          $_SESSION['sess_bp_week'] = date("W",$row['timestamp']);
        }else{
          $_SESSION['sess_bp_week'] = 0;
        }

        // print_r($_SESSION);

        echo "dashboard.php";
      } else {

        $s_number = trim($_POST['username']);
        $e_password = md5(trim($_POST['password']));

        if($s_number != "" && $e_password != "") {
          try {
            $query = "select * from `pos_access` where `number`=:s_number and  `password`=:password and `status`=:status";
            $stmt = $db->prepare($query);
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
              $shop_stmt->bindValue('s_number', $row['owner_mobile'], PDO::PARAM_STR);
              $shop_stmt->execute();

              $shop_count = $shop_stmt->rowCount();
              $shop_row   = $shop_stmt->fetch(PDO::FETCH_ASSOC);
              if($shop_count == 1 && !empty($shop_row)) {

                /******************** Your code ***********************/
                $_SESSION['sess_bp_emp'] = $row['number'];
                $_SESSION['sess_bp_user_id']   = $shop_row['id'];
                $_SESSION['sess_bp_username'] = $shop_row['number'];
                $_SESSION['sess_bp_country'] = $shop_row['country_code'];
                $_SESSION['sess_bp_name'] = $shop_row['business_name'];
                $_SESSION['sess_bp_adr'] = $shop_row['address'];
                $_SESSION['sess_bp_privs'] = explode(',',str_replace(',-','',str_replace("-,",'',$row['privs'])));
                $_SESSION['sess_bp_currency'] = $shop_row['currency'];
                $_SESSION['sess_bp_gst'] = $shop_row['gst'];
                $_SESSION['sess_bp_vat'] = $shop_row['vat'];
                $_SESSION['sess_bp_tax'] = $shop_row['tax'];
                $_SESSION['sess_bp_barcode'] = $shop_row['barcode'];

                $_SESSION['sess_bp_salesman_commission'] = $shop_row['salesman_commission'];
                $_SESSION['sess_bp_agent_commision'] = $shop_row['agent_commision'];

                $_SESSION['sess_bp_print_header_note'] = $shop_row['print_header_note'];
                $_SESSION['sess_bp_print_footer_note'] = $shop_row['print_footer_note'];
                $_SESSION['sess_bp_print_default_template'] = $shop_row['print_default_template'];

                $_SESSION['sess_bp_variants'] = $shop_row['variants'];
                $_SESSION['sess_bp_secondary_units'] = $shop_row['secondary_units'];
                $_SESSION['sess_bp_lend_inventory'] = $shop_row['lend_inventory'];
                $_SESSION['sess_account_keys'] = json_decode($shop_row['default_account_keys'],true);
                if($shop_row['timestamp']>1577836800)
                {
                  $_SESSION['sess_bp_week'] = date("W",$shop_row['timestamp']);
                }else{
                  $_SESSION['sess_bp_week'] = 0;
                }



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
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    echo "Both fields are required!";
  }
} else {
  header('location:./');
}
?>
