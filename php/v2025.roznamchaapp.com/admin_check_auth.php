<?php
// session_start();
include("includes/dbc.php");
if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  if($username != "" && $password != "") {
    try {
      $query = "select * from `admin` where `username`=:username and `password`=:password";
      $stmt = $db->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['sess_bp_admin_id']   = $row['id'];
        $_SESSION['sess_bp_admin_privs']   = $row['privs'];
        $_SESSION['sess_bp_admin'] = $row['username'];
        $_SESSION['sess_bp_name_admin'] = $row['fname'].' '.$row['lname'];
        echo "admin-dashboard.php";
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
  header('location:./');
}
?>
