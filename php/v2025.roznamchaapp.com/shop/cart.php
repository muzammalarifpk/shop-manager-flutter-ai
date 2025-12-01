<?php
// require_once('includes/dbc.php');
$get_keys=array_keys($_GET);
$url_parts = explode('/',$get_keys[0]);

$shop=$path_info[1];
$shop_='+'.$shop;
$PHPSESSID = session_id();
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


$sql = "select * from `store_cart_items` where `owner_mobile`='$shop_' and `PHPSESSID`='$PHPSESSID' and (`status`='published' or `status`='Published')";
$stmt = $db->prepare($sql);
$stmt->execute();
//
// print_r($stmt);
// echo $stmt->rowCount();

if($stmt->rowCount()>0)
{
  $products_in_cart =  $stmt->fetchAll();


}else
{
  echo '<h1>Cart is Empty.</h1>';
  die();
}



?>
<script type="text/javascript">
$(document).prop('title', 'Cart | <?=$user_data['business_name']?>');
</script>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Shopping Cart</h2>
                </div>

                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php

                          $total_price = 0;

                          foreach($products_in_cart as $row) {

                            $product_url=$company_url.'product/'.$row['item_id'].'.html';


                            $total_price += $row['sale_price'] * $row['item_qty'];

                            $where_img = " `type`='products' and `ref_id`='".$row['item_id']."' and `file_type`='image'";
                            $image_url = gnrm($db,'gallery',$where_img,'file_path');
                            if($image_url=='N/A')
                            {
                              $image_url='img/video_placeholder.png';
                            }

                              // print_r($row);
                              ?>
                              <tr>
                                  <td class="cart_product_img">
                                      <a href="<?=$product_url?>">
                                        <img src="https://shop-manager.roznamchaapp.com/<?=$image_url?>" alt="">
                                      </a>
                                  </td>
                                  <td class="cart_product_desc">
                                      <h5><?=gnr($db,'products','id',$row['item_id'],'name')?></h5>
                                  </td>
                                  <td class="price">
                                      <span><?=$user_data['currency']?> <?=$row['sale_price']?></span>
                                  </td>
                                  <td class="qty">
                                    <span><?=$row['item_qty']?></span>
                                    <span><i class="fa fa-trash pull-right btndelete btn btn-danger" data-itemid=<?=$row['id']?>></i></span>
                                  </td>
                              </tr>
                              <?php
                          }

                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span> <?=$user_data['currency']?>  <?=$total_price?></span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span> <?=$user_data['currency']?>  <?=$total_price?></span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                      <?php
                      $msg_contents = 'Hello *'.$user_data['business_name'].',*

I want to purchase following items.

';

foreach($products_in_cart as $row) {

$msg_contents.= '*'.trim(gnr($db,'products','id',$row['item_id'],'name')).'*
'.$row['item_qty'].' @ '.$row['sale_price'].' = *'.$row['item_qty']*$row['sale_price'].'*

';

}

$msg_contents.='

----------------------------
*Total: '.$user_data['currency'].' '.$total_price.'*

Please contact me
';

$whatsapp_checkout = 'https://api.whatsapp.com/send?phone='.$shop.'&text='.urlencode($msg_contents);
$checkout_link = '../checkout/';
                       ?>
                       <!-- <a href="<?=$checkout_link?>" class="root btn amado-btn w-100">Checkout</a> -->
                       <a href="<?=$whatsapp_checkout?>" class="root btn amado-btn w-100">Whatsapp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).on('click','.btndelete',function(e){
    e.preventDefault();
    // alert('Remove Item from Cart.');
    var removeitemfromcart_url = "../../../removeitemfromcart.php";
    var item_id = $(this).attr('data-itemid');
    var shop_number = "<?=$shop_?>";
    var node = this;

    var values = {'item_id':item_id, 'shop_number':shop_number};
    $.ajax({
        url: removeitemfromcart_url,
        type: "post",
        data: values ,
        success: function (response) {
          // alert(response);
          var obj = jQuery.parseJSON( response);
          if(obj.code==200){
            location.reload();
            $("#cart_response").html('Item added to cart Successfully. <br /><a href="<?=$company_url?>cart/" class="btn amado-btn">Open Cart</a>');
          }else{
            $("#cart_response").html('Failed to add item to cart. '+obj.msg);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Error ");
          alert(textStatus);
           console.log(textStatus, errorThrown);
        }
    });

});
</script>
