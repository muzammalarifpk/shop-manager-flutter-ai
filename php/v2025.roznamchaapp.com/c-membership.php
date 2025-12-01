<?php

  require_once("c-change-password.config.php");
  $meta['info']['title']='Membership Center';
  $meta['info']['des']='Customer Love Center';

  //print_r($_SESSION);
  require_once("includes/head.php");

  //die();
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");

  ?>
<style>
.block12{width: 100% !important;}
.block11{width: 91.63% !important;}
.block10{width: 83.33% !important;}
.block9{width: 75% !important;}
.block8{width: 66.64% !important;}
.block7{width: 58.31% !important;}
.block6{width: 50% !important;}
.block5{width: 41.65% !important;}
.block4{width: 33.32% !important;}
.block3{width: 25% !important;}
.block2{width: 16.66% !important;}
.block1{width: 8.33% !important;}
.form-horizontal{width: 100%;}
.form-horizontal .row{ margin-top: 10px; margin-bottom: 10px;}
</style>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php"><?=$string['g']['home']?></a></li>
                    </ol>
                </div>
                <div  class="hide">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <?php

              $select_qry="select * from `users` where `number`='$_SESSION[sess_bp_username]'";
              foreach ($db->query($select_qry) as $row) {

                $industry_type=$row['industry_type'];
                $business_type=$row['business_type'];
                $business_name=$row['business_name'];
                $email=$row['email'];
                $currency=$row['currency'];

              }

              $invite_wa_msg = 'https://wa.me/?text='.urlencode("Hello, I had like to invite you to join baseplan for *Inventory and Accounts management*. I have been using this app and it had helped me improve my buisness. click this link to get discount. https://shop-manager.roznamchaapp.com/register.php?referby=".urlencode($_SESSION['sess_bp_username']));

             ?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

              <div class="row">
                <div class="col-12">
                  <div class="card" style="background:#fff;">
                    <div class="card-body">
                      <div class="row justify-content-md-center">
                        <div class="col-md-8 col-lg-8 text-center">
                          <h1><i class="fa fa-cubes text-info" style="font-size: 10em;"></i></h2>
                            <h2 class="hide">Available Coins: <span class="text-info"></span></h2>
                            <h2 class="">Username: <span class="text-info"><?=$_SESSION['sess_bp_username']?></span></h2>
                            <h2 class="">Membership Type: <span class="text-info"><?=$_SESSION['sess_bp_type']=gnr($db,'users','number',$_SESSION['sess_bp_username'],'type')?></span></h2>
                            <h2 class="">Cohort: <span class="text-info"><?=gnr($db,'users','number',$_SESSION['sess_bp_username'],'cohort')?></span></h2>
                            <h2>Expiry Date: <span class="text-success">
                            <?php
                            if($_SESSION['sess_bp_type']=='prepaid')
                              {
                                echo date("d M, Y",($_SESSION['sess_bp_timestamp']+($free_trial_days*$one_day_ms)));
                              }else {
                                echo $_SESSION['sess_bp_expiry_date']=(gnr($db,'users','number',$_SESSION['sess_bp_username'],'date'));

                              }
                            ?></span></h2>
                            <h2 class="">Coins Left: <span class="text-info"><?=gnr($db,'users','number',$_SESSION['sess_bp_username'],'coins')?></span> (<a href="<?=$invite_wa_msg?>">Get Free Coins</a>)</h2>
                          </div>
                      </div>
                      <div class="row text-center m-t-30">
                          <!-- $6/month button -->
                          <div class="col text-center">
                              <button id="monthly-membership" class="btn btn-success btn-block">$6 / Month</button>
                          </div>

                          <!-- $56/year button -->
                          <div class="col text-center">
                              <button id="yearly-membership" class="btn btn-success btn-block">$56 / Year</button>
                          </div>

                          <!-- $149 once only button -->
                          <div class="col text-center">
                              <button id="lifetime-membership" class="btn btn-success btn-block">$149 Once Only</button>
                          </div>
                      </div>

                      <div class="row text-center m-t-30">
                        <div class="col text-center"><a target="_blank"  href="https://wa.me/923434123489?text=<?=urlencode("Hello BasePlan, I want to buy membership of *cloud version*. username: ".$_SESSION['sess_bp_username'])?>" class="btn btn-success btn-block">Buy using WhatsApp</a></div>
                        <div class="col text-center"><a target="_blank" href="<?=$invite_wa_msg?>" class="btn btn-primary btn-block">Invite Friends</a></div>
                        <div class="col text-center"><a  target="_blank" href="https://wa.me/923434123489?text=<?=urlencode("Hello BasePlan, I need some help about Membership on *cloud version*. username: ".$_SESSION['sess_bp_username'])?>" class="btn btn-success btn-block">Customer Support</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php require_once("includes/right.php"); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"><?=$footer_note?></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <?php
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script>
          $(document).ready(function(e){

            $('#submitbtn').click(function(e){
              e.preventDefault();
              $('.preloader').show();


              var new_pass=$('#password').val();
              var con_pass=$('#confirmpassword').val();
              if(new_pass!==con_pass)
              {
                swal({
                  title: "<?=$string['c']['error']?>",
                  text: "<?=$string['c']['error_msg']?>",
                  type: "error"
                });
                $('.preloader').hide();
                return false;
              }else{


              $.post("c-change-password.process.php", $("#profile_form").serialize(), function(data) {
                  var response = JSON.parse(data);

                  if(response.code==200)
                  {
                    swal({
                       title: 'Submited!',
                       text: response.msg,
                       timer: 2000,
                       type: 'success',
                       showConfirmButton: false
                    });
                    $('.preloader').hide();
                    window.location.reload();
                  }else{
                    swal({
                      title: "Error",
                      text: response.msg,
                      type: "error"
                    });

                    $('.preloader').hide();
                  }
              });
            }
            });
          });
        </script>
        <script>
    // Define Stripe publishable key, price IDs, and URLs

    var mode= 'test'; // live

    if(mode=='test')
    {
      var stripePublishableKey = 'pk_test_51NxBxbGblhBcoZes5cR8SvXaJSyBmqdfMUj2vsxFcUf1VEKoPsWR4h0bfvlMROFMnz8OHAeNMTnDRZ0xSbM0JNbw00SgzHySzD';
      var priceIdMonthly = 'price_1OgGO1GblhBcoZesLiDp8TI6';
      var priceIdYearly = 'price_1OgGOhGblhBcoZesuRC9F0Ex';
      var priceIdLifetime = 'price_1OgGPPGblhBcoZesFtLjvJ46';
      }else{
      var stripePublishableKey = 'pk_live_51NxBxbGblhBcoZesmgk5hrQAtCnrRIhyWyKEGyLV3L5WtguaMEj4NLMDTBYoJPSWTRJpvZaskrO6APQT93tVFFur00xLCs5YW3';
      var priceIdMonthly = 'price_1OgGW2GblhBcoZes7TQ2oxxy';
      var priceIdYearly = 'price_1OgGWNGblhBcoZes3cicCIkk';
      var priceIdLifetime = 'price_1OgGWqGblhBcoZesyNIE9RNH';

    }

    var successUrl = 'https://shop-manager.roznamchaapp.com/c-stripe-success.php?session_id={CHECKOUT_SESSION_ID}';
    var cancelUrl = 'https://shop-manager.roznamchaapp.com/c-stripe-cancel.php';

    var stripe = Stripe(stripePublishableKey);

    document.getElementById('monthly-membership').addEventListener('click', function(e) {
        stripe.redirectToCheckout({
            lineItems: [{price: priceIdMonthly, quantity: 1}],
            mode: 'subscription',
            successUrl: successUrl,
            cancelUrl: cancelUrl,
        }).then(handleResult);
    });

    document.getElementById('yearly-membership').addEventListener('click', function(e) {
        stripe.redirectToCheckout({
            lineItems: [{price: priceIdYearly, quantity: 1}],
            mode: 'subscription',
            successUrl: successUrl,
            cancelUrl: cancelUrl,
        }).then(handleResult);
    });

    document.getElementById('lifetime-membership').addEventListener('click', function(e) {
        stripe.redirectToCheckout({
            lineItems: [{price: priceIdLifetime, quantity: 1}],
            mode: 'payment',
            successUrl: successUrl,
            cancelUrl: cancelUrl,
        }).then(handleResult);
    });

    function handleResult(result) {
        if (result.error) {
            alert(result.error.message);
        }
    }
</script>

    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
