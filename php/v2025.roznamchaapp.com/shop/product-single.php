<?php

$get_keys=array_keys($_GET);
$url_parts = explode('/',$get_keys[0]);

$shop=$path_info[1];
$shop_='+'.$shop;
 // echo '<h2>'.$shop_.'</h2>';
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

$company_url = '/'.$path_info[0].'/'.$path_info[1].'/';

$product_page= $url_parts[count($url_parts)-1];

$product_id=intval($product_page);
// echo '<h2>'.$product_id.'</h2>';


$sql = "select * from `products` where `owner_mobile`='$shop_' and `id`='$product_id' and `platforms` like '%moqame%' and (`status`='published' or `status`='Published')";
$stmt = $db->prepare($sql);
$stmt->execute();

// print_r($stmt);

if($stmt->rowCount()==1)
{
  if ($query_data = $stmt->fetch())
  {
    do
    {
      $product_data=$query_data;
      // echo $stmt->rowCount();
    }
    while ($query_data = $stmt->fetch());
  }
  else
  {
    echo 'Empty Query.';
  }
}else
{
  echo '<h1>Product Not found.</h1>';
  die();
}

// print_r($product_data);

?>
<script type="text/javascript">
$(document).prop('title', '<?=$product_data['title']?>');
</script>

<?php


$yt_url = $product_data['youtube_link'];
if($yt_url!=null || $yt_url!='')
{
  parse_str(parse_url( $url, $output ), $my_array_of_vars );


if (array_key_exists("v",$my_array_of_vars))
  {

    ?>
      <script type="text/javascript">
        validVideoId("<?=$my_array_of_vars['v']?>");
      </script>
    <?php
  }
}

 ?>
     <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">
<?php




$select_images_qry = "select * from `gallery` where `owner_mobile`='$shop_' and `type`='products' and `ref_id`='$product_data[id]' and `status`='Published' order by `id` asc";
$images_array=array();
foreach ($db->query($select_images_qry) as $row) {
  $images_array[]=array('img_id'=>$row['id'],'file_path' => $row['file_path'], 'file_name'=>$row['file_name'], 'uploaddate'=>date("d-M-Y",$row['timestamp']),'filetype'=> $row['file_type']);
}


 ?>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="youtube_video">

                        </div>
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">

                                  <?php
                                  $i=0;
                                  foreach ($images_array as $image_key => $image_value) {
                                    // code...

                                    // print_r($image_value);

                                   ?>
                                    <li class="<?php if($i==0){ echo 'active';}?>" data-target="#product_details_slider" data-slide-to="<?=$i?>" style="background-image: url(https://shop-manager.roznamchaapp.com/<?=$image_value['file_path']?>);">
                                    </li>
                                  <?php
                                  $i++;
                                    }
                                  ?>


                                </ol>
                                <div class="carousel-inner">
                                  <?php
                                  foreach ($images_array as $image_key => $image_value) {
                                    // code...
                                    $i=0;
                                   ?>
                                   <div class="carousel-item <?php if($i==0){ echo 'active';}?>">
                                       <a class="gallery_img root" href="https://shop-manager.roznamchaapp.com/<?=$image_value['file_path']?>">
                                           <img class="d-block w-100" src="https://shop-manager.roznamchaapp.com/<?=$image_value['file_path']?>" alt="First slide">
                                       </a>
                                   </div>
                                   <?php
                                    $i++;
                                  }
                                  ?>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price"><?=$product_data['name']?></p>
                                <h6><?=$user_data['currency']?> <?=$product_data['sale_price']?></h6>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    </div>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                                <br>
                                <p class="item_id">Item ID: <?=$product_data['id']?></p>
                                <p class="item_code">Item Code: <?=$product_data['barcode']?></p>
                            </div>

                            <div class="short_overview my-5">
                                <p><?=$product_data['product_description']?></p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" method="post">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <button type="submit" name="addtocart" value="5" class="btn amado-btn addtocart">Add to cart</button>
                                <div id="cart_response"></div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
  $(document).on('click','.addtocart',function(e){
    e.preventDefault();
    $(this).attr('disabled','disabled');
    // alert('add to cart.');
    var addtocart_url = "../../../addtocart.php";
    var item_qty = $('#qty').val();
    var sale_price = <?=$product_data['sale_price']?>;

    var total=item_qty*sale_price;
    var item_id = "<?=$product_data['id']?>";
    var shop_number = "<?=$shop_?>";

    var values='';

    values = {'item_qty':item_qty, 'sale_price':sale_price, 'total': total, 'item_id':item_id, 'shop_number':shop_number};


    // alert(JSON.stringify(values));
    $.ajax({
        url: addtocart_url,
        type: "POST",
        data: values ,
        success: function (response) {
          var obj = jQuery.parseJSON( response);
          // alert(JSON.stringify(obj));
          if(obj.code==200){
            $("#cart_response").html('Item added to cart Successfully. <br /><a href="<?=$company_url?>cart/" class="btn amado-btn">Open Cart</a>');
          }else{
            $("#cart_response").html('Failed to add item to cart. '+obj.msg);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Error ");
          // alert(addtocart_url);
          alert(JSON.stringify(values));
          console.log(textStatus, errorThrown);
        }
    });

});
</script>
