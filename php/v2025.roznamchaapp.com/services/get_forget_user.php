<?php
  require_once('dbc.php');
  $source='default';
  $respose=array('code'=>100,'msg'=>'URL Exists.');

//  print_r($_POST);

  $select_qry = "select * from `users` where `number`='$_POST[number]' ";
  $stmt = $db->prepare($select_qry);
  $response = $stmt->execute();
  $user_rows=$stmt->fetch(PDO::FETCH_ASSOC);
  $user_count = $stmt->rowCount();

  if($user_count!==1)
  {
    $respose=array('code'=>201,'msg'=>'User not found.');
  }else{


    $token=get_random();
    $recovery_link='https://shop-manager.roznamchaapp.com/c-recover.php?number='.urlencode($_POST['number']).'&token='.$token;

    $insert_forget_token_qry = "insert into `forget_pass` set `number`=:number, `token`=:token, `timestamp`=:timestamp";
    $insert_stmt = $db->prepare($insert_forget_token_qry);

    $insert_stmt->bindParam('number', $_POST['number']);
    $insert_stmt->bindParam('token', $token);
    $insert_stmt->bindParam('timestamp', $time);

    $insert_stmt->execute();

    if($insert_stmt){



    $subject = 'BasePlan Shop Manager Password Reset';

    // Recipient
    $to = $user_rows['email'];
    // Sender
    $from = 'norply@baseplan.pk';
    $fromName = 'System BasePlan';

    $htmlContent='<h2>Hey '.$user_rows['business_name'].',</h2>

      To reset your password for <strong>BasePlan Shop manager Cloud</strong> , please click the following link:
        <br /><br /><br />
        '.$recovery_link.'
        <br /><br /><br />

      If you don’t want to reset your password, you can ignore this message - someone probably typed in your username or email address by mistake.

      Thanks!
      Team BasePlan.pk';

    error_reporting(E_ALL);
    // Set script max execution time
    set_time_limit(900); // 15 minutes

    // Header for sender info
    $headers = "From: $fromName"." <".$from.">";

    // Boundary
    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    // Headers for attachment
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

    // Multipart boundary
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

    // Preparing attachment
    if(!empty($file) > 0){
        if(is_file($file)){
            $message .= "--{$mime_boundary}\n";
            $fp =    @fopen($file,"rb");
            $data =  @fread($fp,filesize($file));

            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
            "Content-Description: ".basename($file)."\n" .
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
    }
    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $from;

    // Send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath);


    if($mail)
    {
          $respose=array('code'=>200,'msg'=>'User found.','data'=>$user_rows);
    }else{
      $respose=array('code'=>202,'msg'=>'You dont have valid email address associated to your account.','data'=>$user_rows);
    }
  }else{
      $respose=array('code'=>203,'msg'=>'Error storing token, contact technical support staff','data'=>$user_rows);
  }

  }


  $respose_json=json_encode($respose);
  print_r($respose_json);
  require_once('close_dbc.php');
?>
