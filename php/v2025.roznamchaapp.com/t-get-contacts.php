<?php
$contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]'";

$contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');

foreach ($db->query($contacts_query) as $row)
{
  $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

  $balance=gnrm($db,'ledger',$contact_where,'balance');
  $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

  $contacts_data[$row['number']]=array('balance'=>$balance,'status'=>$balance_status);
 ?>
<option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
<?php
  }

 ?>
