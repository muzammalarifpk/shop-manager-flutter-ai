<?php
require_once('includes/dbc.php');
$date = date('D d M, Y');
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Karachi');

define("DB_USER", $db_user);
define("DB_PASSWORD", $db_pass);
define("DB_NAME", $db_name);
define("DB_HOST", $db_host);


// Recipient
$to = 'baseplan.pk@gmail.com,waseemakram.wa552@gmail.com';
// Sender
$from = 'norply@baseplan.pk';
$fromName = 'BasePlan Admin';

$long_msg=",
*Stock management and Accounting software*
Sale Invoice
Purchase Invoice
Expense
Cash Receive and pay.

Following reports are available realtime.

- Profit and Loss account
- Trial Balance
- Balance Sheet
- Most sold Items
- Least sold items
- Most profitable Items
- Least Profitable Items

- Daily Report
- Weekly Report
- Monthly Report
- Yearly Report

- Sales History
- Purchase History
- Expense History
- Payment History .


Download now:
https://play.google.com/store/apps/details?id=pk.baseplan.cloudinventorymanagerlearner";

$urdu_msg=",
Apni Dukan ka mukamal hisab kitab krne k lia hamara software download krne ka shukria. humne abi software mai kush new updates shamil ki hain. or ab ya tamam features na sirf apne mobile per balke computer pa b istamal kr sakte hain.

*Features*
- Stock reports
- Customer our parties ka khata jis mai naqad or udar ka hisab ho.
- Cash, bank, or udar ki sale or purchase ka option
- Expense(kharcha) ka hisab kitaab
- Payments ka lain dain
- Laptop or mobile pa ek sath istamal krain
- Sara data khud hi cloud pa save ho jaye ga
- Bill ko Print, Whatsapp or SMS b kr sakte hain
- Products ki photos
- Barcode (optional)
- Multi-user access


*Reports*

- Profit and Loss account
- Trial Balance
- Balance Sheet
- Most sold Items
- Least sold items
- Most profitable Items
- Least Profitable Items
- Expense Reports
- Payments Report
- Accounts Payable
- Accounts Receivable

- Daily Report
- Weekly Report
- Monthly Report
- Yearly Report

- Sales History
- Purchase History
- Expense History
- Payment History .


New software download krne k lia is link pa click krain:
https://play.google.com/store/apps/details?id=pk.baseplan.cloudinventorymanagerlearner";


$count_new_users_pk= 0;
$count_new_users= 0;
$count_new_users_offline=0;
$count_new_users_offline_pk=0;
$s_time = strtotime('yesterday');
$e_time = strtotime('today midnight');
$htmlContent='';

$select_pk = "select * from `users` where `country_name`='Pakistan' and `timestamp`>'$s_time' and `timestamp`<'$e_time' order by `entries` desc ";
$htmlContent .= '
    <h1>New users on cloud version from <u>Pakistan</ul></h1>
    <table width="100%" border="1"><tr><th>#</th><th>business_name</th><th>Entries</th><th>City</th><th>industry_type</th><th>business_type</th><th>Date</th></tr>
';
foreach ($db->query($select_pk) as $row_pk)
{
  if($row_pk['country_code']=='+92' || $row_pk['country_code']=='+91' || $row_pk['country_name']=='India' || $row_pk['country_name']=='Pakistan')
  {
    $long_msg =  $urdu_msg;
  }

  $whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row_pk['number'])).'?text='.urlencode("Hello *".$row_pk['business_name']."*".$long_msg);

  $count_new_users_pk++;
  $htmlContent.='<tr><td>'.$count_new_users_pk.'</td><td><a href="tel:'.$row_pk['number'].'">'.$row_pk['business_name'].'( '.$row_pk['number'].' )</a></td><td>'.$row_pk['entries'].'  <a href="'.$whatsapp_link.'" id="'.$row_pk['id'].'" class="btn btn-success btn-sm whatsapp_link" data-db="cloud_app" target="_blank" >WA</a> </td><td>'.$row_pk['city'].' </td><td> '.$row_pk['industry_type'].'  </td><td>'.$row_pk['business_type'].' </td><td> '.date('d M,Y H:i',$row_pk['timestamp']).' </td></tr>';
}
$htmlContent.='
    </table>
';



$select_intl = "select * from `users` where `country_name`!='Pakistan' and `timestamp`>'$s_time' and `timestamp`<'$e_time' order by `entries`,`country_name` desc";
$htmlContent .= '
    <h1>New users on cloud version from <u>Abroad</ul></h1>
    <table width="100%" border="1"><tr><th>#</th><th>business_name</th><th>Entries</th><th>Country</th><th>industry_type</th><th>business_type</th><th>Date</th></tr>
';
foreach ($db->query($select_intl) as $row_intl)
{

  if($row_intl['country_code']=='+92' || $row_intl['country_code']=='+91' || $row_intl['country_name']=='India' || $row_intl['country_name']=='Pakistan')
  {
    $long_msg =  $urdu_msg;
  }

  $whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row_intl['number'])).'?text='.urlencode("Hello *".$row_intl['business_name']."*".$long_msg);

  $count_new_users++;

  $htmlContent.='<tr><td>'.$count_new_users.'</td><td><a href="tel:'.$row_intl['number'].'">'.$row_intl['business_name'].'( '.$row_intl['number'].' )</a></td><td>'.$row_intl['entries'].'  <a href="'.$whatsapp_link.'" id="'.$row_intl['id'].'" class="btn btn-success btn-sm whatsapp_link" data-db="cloud_app" target="_blank" >WA</a> </td><td>'.$row_intl['country_name'].' </td><td> '.$row_intl['industry_type'].'  </td><td>'.$row_intl['business_type'].' </td><td> '.date('d M,Y H:i',$row_intl['timestamp']).' </td></tr>';



}
$htmlContent.='
    </table>
';




$select_off_pk = "select * from `Users` where `lastupdated`>'$s_time' and `lastupdated`<'$e_time' and `mobile` like '+92%' order by `mobile`";
$htmlContent .= '
    <h1>New users on Offline version <u>Pakistan</u></h1>
    <table width="100%" border="1"><tr><th>#</th><th>business_name</th><th>City</th><th>industry_type</th><th>business_type</th><th>Date</th></tr>';

foreach ($db_off->query($select_off_pk) as $row_off)
{
//  $count_new_users_offline++;
  $count_new_users_offline_pk++;
  $htmlContent.='<tr><td>'.$count_new_users_offline_pk.'</td><td><a href="tel:'.$row_off['mobile'].'">'.$row_off['business_name'].'</a> </td><td>'.$row_off['mobile'].' </td><td> '.$row_off['industry_type'].'  </td><td>'.$row_off['account_type'].' </td><td> '.date('d M,Y H:i',$row_off['lastupdated']).' </td></tr>';
}
$htmlContent.='
    </table>
';




$select_off = "select * from `Users` where `lastupdated`>'$s_time' and `lastupdated`<'$e_time' and `mobile` Not like '+92%' order by `mobile`";
$htmlContent .= '
    <h1>New users on Offline version </h1>
    <table width="100%" border="1"><tr><th>#</th><th>business_name</th><th>City</th><th>industry_type</th><th>business_type</th><th>Date</th></tr>';
foreach ($db_off->query($select_off) as $row_off)
{
  $count_new_users_offline++;
  $htmlContent.='<tr><td>'.$count_new_users_offline.'</td><td><a href="tel:'.$row_off['mobile'].'">'.$row_off['business_name'].'</a> </td><td>'.$row_off['mobile'].' </td><td> '.$row_off['industry_type'].'  </td><td>'.$row_off['account_type'].' </td><td> '.date('d M,Y H:i',$row_off['lastupdated']).' </td></tr>';
}
$htmlContent.='
    </table>
';



$subject = $count_new_users+$count_new_users_pk+$count_new_users_offline+$count_new_users_offline_pk.' New signup on '.$date;

error_reporting(E_ALL);
// Set script max execution time
set_time_limit(900); // 15 minutes

// Email body content

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

// Email sending status
echo $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>";

?>
