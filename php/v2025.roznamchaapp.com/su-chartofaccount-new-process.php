<?php
require_once("includes/dbc.php");
require_once("su-chartofaccount.config.php");

  function process_insert_form($db,$postinfo,$all_fields,$table,$reqid='')
  {
    $err='<ol>';
    foreach ($all_fields as $key => $value) {
      # code...


      if($value['is_req']==1 && $value['type']!=='manual')
      {
//        echo $key.' - '.trim($postinfo[$key]);

        if(empty(trim($postinfo[$key])))
        {
          $err.='<li>'.$value['name']." is required, you can't leave it empty.</li>";
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
//        print_r($query);
        try {

        $stmt = $db->prepare($query) ;
        }
        catch(Exception $e) {
          print_r($e);
        }

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
        try{

          $stmt->execute();
        }catch(Exception $e)
        {
          print_r($e);
        }
        $coa_account=$db->lastInsertId();

        $total_price=$_POST['balance'];
        $capital_account=$_SESSION['sess_account_keys']['capital'];

        $coa_account=$coa_account;

        if($_POST['balance_type']=='debit')
        {

          $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
          $debit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
        }else{

          $debit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
          $credit_array=array(array('account'=>$coa_account,'amount'=>$total_price));
        }

        $entry_type='New Account with beginning balance.';
        $entry_link='accountid:'.$coa_account;

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
