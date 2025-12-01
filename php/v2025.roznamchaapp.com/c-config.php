<?php
  require_once("c-profile.config.php");
  require_once("includes/head.php");
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

<?php

  $select_qry="select * from `users` where `number`='$_SESSION[sess_bp_username]'";
  foreach ($db->query($select_qry) as $row) {

    $industry_type=$row['industry_type'];
    $business_type=$row['business_type'];
    $business_name=$row['business_name'];
    $address=$row['address'];
    $email=$row['email'];
    $currency=$row['currency'];
    $gst=$row['gst'];
    $vat=$row['vat'];
    $tax=$row['tax'];
    $variants=$row['variants'];
    $secondary_units=$row['secondary_units'];

  }

//  print_r($_SESSION);

 ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">

                                    <form class="form-horizontal" id="profile_form" action="" method="post">

                                      <div class="form-group col-xs-12">
                                              <label for="industry">Industry</label>
                                              <select class="form-control" name="industry_type" id="industry_type" required="required">
                                                <option value="">-- Select --</option>
                                                <?php
                                                  foreach ($list_industries as $key => $value) {
                                                    // code...
                                                    ?>
                                                      <option value="<?=$value?>"><?=$value?></option>
                                                    <?php
                                                  }
                                                ?>
                                                <option value="Others - ">Others</option>
                                              </select>
                                              <script type="text/javascript">
                                                $('#industry_type').val('<?=$industry_type?>');
                                              </script>
                                      </div>
                                      <div class="form-group col-xs-12 ">
                                            <h5>Business type</h5>
                                            <input name="business_type" type="radio" class="with-gap" id="Wholesaller" value="Wholesaller" <?php if($business_type == 'Wholesaller'){?>checked <?php }?> >
                                            <label for="Wholesaller">Wholesaller</label>
                                            <input name="business_type" type="radio" class="with-gap" id="distributor" value="Distributor" <?php if($business_type == 'Distributor'){?>checked <?php }?> >
                                            <label for="distributor">Distributor</label>
                                            <input name="business_type" type="radio" class="with-gap" id="retailer" value="Retailer" <?php if($business_type == 'Retailer'){?>checked <?php }?> >
                                            <label for="retailer">Retailer</label>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="business_name">Business Name</label>
                                              <input class="form-control" type="text" id="business_name" name="business_name" required="required" placeholder="Shop Name" value="<?=$business_name?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="address">Shop Address</label>
                                              <input class="form-control" type="text" id="address" name="address" required="required" placeholder="Shop Address" value="<?=$address?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="email">Email Address</label>
                                              <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" value="<?=$email?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="currency">Currency</label>
                                              <input class="form-control" type="text" id="currency" name="currency" required="required" placeholder="USD" value="<?=$currency?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="gst">General Sales Tax (GST) Percentage</label>
                                              <input class="form-control" type="text" id="gst" name="gst" required="required" placeholder="0" value="<?=$gst?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="vat">Value added tax (VAT) Percentage</label>
                                              <input class="form-control" type="text" id="vat" name="vat" required="required" placeholder="0" value="<?=$vat?>"> </div>
                                      </div>


                                      <div class="form-group col-xs-12">
                                              <label for="tax">Tax</label>
                                              <select class="form-control" name="tax" id="tax" required="required">
                                                <option value="off">Off</option>
                                                <option value="on">On</option>
                                              </select>
                                              <script type="text/javascript">
                                                $('#tax').val('<?=$tax?>');
                                              </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                              <label for="variants">Variants</label>
                                              <select class="form-control" name="variants" id="variants" required="required">
                                                <option value="off">Off</option>
                                                <option value="on">On</option>
                                              </select>
                                              <script type="text/javascript">
                                                $('#variants').val('<?=$variants?>');
                                              </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                              <label for="secondary_units">Secondary Units</label>
                                              <select class="form-control" name="secondary_units" id="secondary_units" required="required">
                                                <option value="off">Off</option>
                                                <option value="on">On</option>
                                              </select>
                                              <script type="text/javascript">
                                                $('#secondary_units').val('<?=$secondary_units?>');
                                              </script>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="username">Username</label>
                                              <p><?=$row['number']?></p>
                                            </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="account_type">Account Type</label>
                                              <p><?=$row['type']?></p>
                                          </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-12"><a href="#" id="resetbtn" class="btn btn-danger pull-left">Cancel</a><a href="#" id="submitbtn" class="btn btn-success pull-right">Save and Next</a></div>
                                      </div>


                                </form>
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
              $.post("c-profile.process.php", $("#profile_form").serialize(), function(data) {

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
                  }else{
                    swal({
                       title: 'Error!',
                       text: response.msg,
                       timer: 2000,
                       type: 'danger',
                       showConfirmButton: false
                    });
                  }
              });
            });
          });
        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
