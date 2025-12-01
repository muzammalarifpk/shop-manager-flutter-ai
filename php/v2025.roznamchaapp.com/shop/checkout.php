<?php
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
  $(document).prop('title', 'Checkout | <?=$user_data['business_name']?>');
</script>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>

                            <form action="#" method="post">
                                <div class="row">
                                  <div class="col-12 mb-3">
                                      <input type="text" class="form-control" id="full_name" value="" placeholder="Full Name" required>
                                  </div>
                                  <div class="col-3 mb-3">
                                      <select class="w-100" id="country">
                                        <option value="92">+92</option>
                                        <option value="91">+91</option>
                                      </select>
                                  </div>
                                  <div class="col-9 mb-3">
                                      <input type="number" class="form-control" id="phone_number" value="" placeholder="Mobile Number" required>
                                  </div>
                                  <div class="col-12 mb-3">
                                        <select class="w-100" id="country_code">
                                          <option value="pakistan">Pakistan</option>
                                          <option value="india">India</option>
                                          <option value="usa">United States</option>
                                          <option value="uk">United Kingdom</option>
                                          <option value="ger">Germany</option>
                                          <option value="fra">France</option>
                                          <option value="ind">India</option>
                                          <option value="aus">Australia</option>
                                          <option value="bra">Brazil</option>
                                          <option value="cana">Canada</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="email" value="" placeholder="Email Address" required>
                                    </div>
                                      <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" id="street_address" placeholder="Address" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Leave a comment about your order"></textarea>
                                    </div>

                                    <!-- <div class="col-12">
                                        <div class="custom-control custom-checkbox d-block mb-2">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                        </div>
                                        <div class="custom-control custom-checkbox d-block">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                        </div>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php

                    $total_price = 0;

                    foreach($products_in_cart as $row) {


                      $total_price += $row['sale_price'] * $row['item_qty'];

                      $where_img = " `type`='products' and `ref_id`='".$row['item_id']."' and `file_type`='image'";
                      $image_url = gnrm($db,'gallery',$where_img,'file_path');
                      if($image_url=='N/A')
                      {
                        $image_url='img/video_placeholder.png';
                      }

                        // print_r($row);
                    }

                    ?>

                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span> <?=$user_data['currency']?>  <?=$total_price?></span></li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span> <span> <?=$user_data['currency']?>  <?=$total_price?></span></li>
                            </ul>

                            <!-- <div class="payment-method">
                                <!-- Cash on delivery ->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal --
                            </div> -->

                            <div class="cart-btn mt-100">
                              <span><i class="btn amado-btn w-100 btncheckout" data-itemid=<?=$row['id']?>>Checkout</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

          var session_id = '<?=session_id()?>';
          $(document).on('click','.btncheckout',function(e){
            e.preventDefault();
            alert('checkout begin validation...');

            var process_checkout_url = "../../../checkout.process.php";
            var full_name = $("#full_name").val();
            var phone_number = $("#phone_number").val();
            var country_code = $("#country_code").val();
            var email = $("#email").val();
            var street_address = $("#street_address").val();
            var notes = $("#comment").val();

            var shop_number = "<?=$shop_?>";
            var node = this;

            var values = {'shop_number':shop_number, 'session_id':session_id,  'full_name':full_name, 'phone_number':phone_number, 'country_code':country_code, 'email':email, 'street_address':street_address, 'notes':notes};

            var json_text = JSON.stringify(values, null, 2);
            console.log(json_text);
            // $.ajax({
            //     url: removeitemfromcart_url,
            //     type: "post",
            //     data: values ,
            //     success: function (response) {
            //       // alert(response);
            //       var obj = jQuery.parseJSON( response);
            //       if(obj.code==200){
            //         location.reload();
            //         $("#cart_response").html('Item added to cart Successfully. <br /><a href="<?=$company_url?>cart/" class="btn amado-btn">Open Cart</a>');
            //       }else{
            //         $("#cart_response").html('Failed to add item to cart. '+obj.msg);
            //       }
            //     },
            //     error: function(jqXHR, textStatus, errorThrown) {
            //       alert("Error ");
            //       alert(textStatus);
            //        console.log(textStatus, errorThrown);
            //     }
            // });

        });
        </script>
