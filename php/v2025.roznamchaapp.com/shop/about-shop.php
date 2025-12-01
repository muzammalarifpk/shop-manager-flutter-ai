<?php

  // print_r($_GET);
  // echo $_GET['?shop'];
  // // die();

  if(!isset($path_info[1]))
  {
    echo '<h1>Shop Not found.</h1>';
    die();
  }else
  {
    $company_url = '/'.$path_info[0].'/'.$path_info[1].'/';

    require_once('includes/dbc.php');
      $shop=$path_info[1];
    $shop_='+'.$shop;

    $sql = "select * from `users` where `number`='$shop_'";
    $stmt = $db->prepare($sql);
    $stmt->execute();


    if($stmt->rowCount()==1)
    {
      if ($shop_data = $stmt->fetch())
      {
        do
        {
          $user_data=$shop_data;
          // echo $stmt->rowCount();
        }
        while ($shop_data = $stmt->fetch());
      }
      else
      {
        echo 'Empty Query.';
      }
    }else
    {
      echo '<h1>Shop Not found.</h1>';
      die();
    }
  }



?>
<script type="text/javascript">
$(document).prop('title', '<?=$user_data['business_name']?> | <?=$user_data['business_type']?> | <?=$user_data['industry_type']?> | <?=$user_data['city']?>');
</script>

<!-- Product Catagories Area Start -->
    <div class="amado-pro-catagory clearfix">
      <div class="row">
        <div class="col-sm-6">
          <h1><?=$user_data['business_name']?></h1>
          <h2>Contact Details</h2>
          <h3>Address: <?=$user_data['address']?></h3>
          <h3>Phone: <?=$user_data['number']?></h3>
          <h2>Business Details</h2>
          <h3>Business Type: <?=$user_data['business_type']?></h3>
          <h3>Industry Type: <?=$user_data['industry_type']?></h3>
        </div>
        <div class="col-sm-6">
            <?php
            $url = "https://$_SERVER[HTTP_HOST]$_SERVER[ORIG_PATH_INFO]";

            $url=str_replace("get_contents.php","",$url);
            // $url='abc.om';
            // echo $url;

            // include("https://moqame.com/qrcode.php?code=$url");

            // print_r($_SERVER);
            ?>
            <img src="https://moqame.com/qrlogo.php?data=<?=urlencode($url)?>" alt="">
        </div>
      </div>



    </div>




<!-- Product Catagories Area End -->
<script src="https://www.moqame.com/js/active.js"></script>
