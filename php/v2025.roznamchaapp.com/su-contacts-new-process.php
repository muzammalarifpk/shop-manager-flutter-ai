<?php
require_once("includes/dbc.php");
require_once("su-contacts.config.php");

  function process_insert_form($db,$postinfo,$all_fields,$table,$reqid='')
  {
    $err='<ol>';
    foreach ($all_fields as $key => $value)
    {
      # code...

      if(isset($all_fields[$key]['is_unique']))
      {
        if($all_fields[$key]['is_unique']==true)
        {

          $count_sql = "SELECT count(*) FROM `$table` WHERE `owner_mobile` = ? and `$key`= ? ";
          $result = $db->prepare($count_sql);
          $result->execute([$_SESSION['sess_bp_username'],$postinfo[$key]]);
          $number_of_rows = $result->fetchColumn();

          if($number_of_rows>0)
          {
            $err.='<li>'.$key.' should be unique, you have '.$number_of_rows.' already. </li>';
          }

        }
      }


      if($value['is_req']==1 && $value['type']!=='manual')
      {
//        echo $key.' - '.trim($postinfo[$key]);

        if(empty(trim($postinfo[$key])))
        {
          if($value['type']=='number')
          {
            $postinfo[$key]=0;
          }else{
            $err.='<li>'.$value['name']." is required, you can't leave it empty.</li>";
          }
        }

      }elseif($value['type']=='number')
      {
        if(empty(trim($postinfo[$key])))
        {
          $postinfo[$key]=0;
        }
      }

      if($value['type']=='manual')
      {

      }


      if(array_key_exists("attr",$value))
      {
        if(array_key_exists('unique',$value['attr']))
        {

              try {
                $query = "select * from `$table` where `".$key."`=:postdata";
                if($reqid!='')
                {
                  $query.= " and `id`!='".$reqid."' ";
                }
                $stmt = $db->prepare($query);
                $stmt->bindParam('postdata', $postinfo[$key], PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row   = $stmt->fetch(PDO::FETCH_ASSOC);
                if($count !== 0)
                {
                  $err.='<li>'.$value['name'].' must be unique.</li>';
                }
              } catch (PDOException $e) {
                  $err.= "<li>Error : ".$e->getMessage().'</li>';
              }

          }
      }

    }
    $err.='<ol/>';

    if($err=='<ol><ol/>')
    {
      try {

        if($reqid=='')
        {
          $query="insert into `$table` set ";
          foreach ($all_fields as $key => $value) {
              $query.=" `$key`=:$key".', ';
          }
          $query.=" `last_updated`=:last_updated, `owner_mobile`=:owner_mobile, `added_by`=:added_by, `timestamp`=:timestamp ";
        }else{

          $query= "update `$table` set ";
          foreach ($all_fields as $key => $value) {
              $query.=" `$key`=:$key".', ';
          }
          $query.=" `last_updated`=:last_updated, `added_by`=:added_by ";
          $query.= " where `id`='".$reqid."' ";
        }


        $stmt = $db->prepare($query);

        $owner_mobile=$_SESSION['sess_bp_username'];
        $added_by=$_SESSION['sess_bp_emp'];

        $time=time();
        $last_updated=time();

        if($reqid=='')
        {
          $stmt->bindParam('timestamp', $time);
          $stmt->bindParam('owner_mobile', $owner_mobile);
        }

        $stmt->bindParam('last_updated', $last_updated);
        $stmt->bindParam('added_by', $added_by);


        foreach ($all_fields as $key => $value) {
          # code...
          if($all_fields[$key]['type']!=='manual')
          {
            $stmt->bindParam($key, $_POST[$key]);
          }else{
            $stmt->bindParam($key,$$key);
          }
        }

        $stmt->execute();

        $contact_account=$db->lastInsertId();


        $owner_details['owner_mobile']=$owner_mobile;
        $owner_details['added_by']=$owner_mobile;
        $owner_details['status']='Published';

        if($_POST['balance_status']=='receiveable')
        {
          $balance_type='cr';
        }else{
          $balance_type='dr';
        }

        // $coa_account = create_ledger_account($db,$owner_details,$account_details);


        $total_price=$postinfo['balance'];
        $capital_account=$_SESSION['sess_account_keys']['capital'];
        $coa_account='c'.$_POST['number'];

        if($_POST['balance_status']=='receiveable')
        {

          $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
          $debit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
        }else{

          $debit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
          $credit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
        }

        $entry_type='Create new Contact with beginning balance.';
        $entry_link='contactid:'.$_POST['number'];

       journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);



        echo 'success';
      } catch (PDOException $e) {
        $err .= "<li>Error : ".$e->getMessage()."</li>";
      }
    }else{
      echo $err;
    }

  }



  if(isset($_GET['reqid']))
  {
    process_insert_form($db,$_POST,$all_fields,$meta['module'][0],$_GET['reqid']);
  }else{
    process_insert_form($db,$_POST,$all_fields,$meta['module'][0]);
  }


?>
