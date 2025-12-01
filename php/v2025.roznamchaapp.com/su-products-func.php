<?php
function process_insert_form($db,$postinfo,$all_fields,$table,$reqid='')
{
  $err='<ol>';

  $secondary_units=[];
  if(array_key_exists('secondary_unit',$postinfo))
  {
    foreach ($postinfo['secondary_unit'] as $key => $value) {
      // Secondary units array...
      if($postinfo['primary_unit_qty'][$key]!='')
      {
        $secondary_units[$key]=array('secondary_unit'=>$value,'primary_unit_qty'=>$postinfo['primary_unit_qty'][$key]);
      }
    }
  }

  $secondary_units_count = count($secondary_units);

  $product_variants=[];

  if(!isset($postinfo['variants_fields']))
  {
    $postinfo['product_variants']='';
  }else{

    foreach ($postinfo['variants_fields'] as $key => $value) {
        $variant_name='variant_'.$value;
        $product_variants[]=['name'=>$value,'available_stock'=>$postinfo[$variant_name]];
    }
    $postinfo['product_variants']=$product_variants;
  }



  foreach ($all_fields as $key => $value) {
    # code...


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
        $query.="`product_description`=:product_description,  `title`=:title,  `youtube_link`=:youtube_link,  `platforms`=:platforms,  `secondary_unit_count`=:secondary_unit_count,  `secondary_units`=:secondary_units,  `last_updated`=:last_updated, `owner_mobile`=:owner_mobile, `added_by`=:added_by, `timestamp`=:timestamp ";

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

      $product_description=$postinfo['product_description'];
      $title=$postinfo['title'];
      $youtube_link=$postinfo['youtube_link'];
      $platforms=implode(",",$postinfo['platforms']);


      $time=time();
      $last_updated=time();

      if($reqid=='')
      {
        $secondary_units_json = json_encode($secondary_units);
        $stmt->bindParam('product_description', $product_description);
        $stmt->bindParam('title', $title);
        $stmt->bindParam('youtube_link', $youtube_link);
        $stmt->bindParam('platforms', $platforms);
        $stmt->bindParam('secondary_unit_count', $secondary_units_count);
        $stmt->bindParam('secondary_units', $secondary_units_json);
        $stmt->bindParam('timestamp', $time);
        $stmt->bindParam('owner_mobile', $owner_mobile);
      }

      $stmt->bindParam('last_updated', $last_updated);
      $stmt->bindParam('added_by', $owner_mobile);
      $_POST['tags']='-,'.$_POST['tags'].',-';
      if(empty($_POST['tax']) || ($_POST['tax']==''))
      {
        $_POST['tax']='Exempted';
      }


      foreach ($all_fields as $key => $value) {
        # code...
        if($all_fields[$key]['type']!=='manual')
        {
          $stmt->bindParam($key, $postinfo[$key]);
        }else{
          $stmt->bindParam($key,$$key);
        }
      }

      $stmt->execute();

      $product_id=$db->lastInsertId();


      if($reqid=='')
      {

        $qry_stock_history="insert into `stock_history` set `owner_mobile`=:owner_mobile,  `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `product_id`=:product_id,  `date`=:date,  `qty`=:qty,  `in_out`=:in_out,  `qty_before`=:qty_before,  `qty_after`=:qty_after,  `measuring_unit`=:measuring_unit,  `unit_price`=:unit_price,  `total_price`=:total_price ";

        $stock_history=$db->prepare($qry_stock_history);


        $status= 'Published';
        $qty= $postinfo['available_stock'];
        $in_out = 'in';
        $qty_before= 0;
        $qty_after = $qty;
        $description = 'Begining Balance of item';
        $measuring_unit=$postinfo['measuring_unit'];
        $unit_price=$postinfo['purchase_cost'];
        $total_price=$postinfo['purchase_cost']*$qty;
        $date=date("Y-m-d");

        $stock_history->bindParam('owner_mobile',$owner_mobile);
        $stock_history->bindParam('timestamp',$time);
        $stock_history->bindParam('added_by',$owner_mobile);
        $stock_history->bindParam('status',$status);
        $stock_history->bindParam('last_updated',$time);
        $stock_history->bindParam('product_id',$product_id);
        $stock_history->bindParam('date',$date);
        $stock_history->bindParam('qty',$qty);
        $stock_history->bindParam('in_out',$in_out);
        $stock_history->bindParam('qty_before',$qty_before);
        $stock_history->bindParam('qty_after',$qty_after);
        $stock_history->bindParam('measuring_unit',$measuring_unit);
        $stock_history->bindParam('unit_price',$unit_price);
        $stock_history->bindParam('total_price',$total_price);

        $stock_history->execute();



        $stock_history_id=$db->lastInsertId();


        $capital_account=$_SESSION['sess_account_keys']['capital'];
        $inventory_account=$_SESSION['sess_account_keys']['inventory'];

        $credit_array=array(array('account'=>$capital_account,'amount'=>$total_price));
        $debit_array=array(array('account'=>$inventory_account,'amount'=>$total_price));
        $entry_type='Create new Product with beginning balance.';
        $entry_link='product:'.$product_id;

       journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);

       if(is_array($postinfo['product_variants']))
       {

         foreach($postinfo['product_variants'] as $key => $value)
         {
           create_variant($db,$owner_mobile,$owner_mobile,$status,$product_id,$value['name'],$value['available_stock'],$date);
         }
       }

      }

      echo 'success';
    } catch (PDOException $e) {
      $err .= "<li>Error : ".$e->getMessage()."</li>";
      echo $err;
    }
  }else{
    echo $err;
  }

}
 ?>
