<?php
require_once("includes/dbc.php");
require_once("acompany-admin.config.php");

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
          $query.=" `last_updated`=:last_updated ";
        }else{

          $query= "update `$table` set ";
          foreach ($all_fields as $key => $value) {
              $query.=" `$key`=:$key".', ';
          }
          $query.=" `last_updated`=:last_updated ";
          $query.= " where `id`='".$reqid."' ";
        }


        $stmt = $db->prepare($query);

        $stmt->bindParam('last_updated', $last_updated);


        foreach ($all_fields as $key => $value) {
          # code...
          if($all_fields[$key]['type']!=='manual')
          {
            $stmt->bindParam($key, $_POST[$key]);
          }else{
            $stmt->bindParam($key,$$key);
          }
        }

        $time=time();
        $added_by='userphp';
        $last_updated=time();

        $stmt->execute();
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
