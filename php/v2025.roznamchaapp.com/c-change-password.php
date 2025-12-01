<?php
  require_once("c-change-password.config.php");
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
    $email=$row['email'];
    $currency=$row['currency'];

  }


 ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">

                                    <form class="form-horizontal" id="profile_form" action="" method="post">


                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="username"><?=$string['c']['username']?>: </label>
                                            <?=$_SESSION['sess_bp_emp']?></div>
                                    </div>


                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="old_pass"><?=$string['c']['old_pass']?></label>
                                            <input class="form-control" type="password" id="old_pass" name="old_pass" required="required" placeholder="old password"> </div>
                                    </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="password"><?=$string['c']['password']?></label>
                                              <input class="form-control" type="password" id="password" name="password" required="required" placeholder="new password"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="confirmpassword"><?=$string['c']['confirmpassword']?></label>
                                              <input class="form-control" type="password" id="confirmpassword" name="confirmpassword" required="required" placeholder="confirm password"> </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-12"><a href="#" id="resetbtn" class="btn btn-danger pull-left"><?=$string['g']['resetbtn']?></a><a href="#" id="submitbtn" class="btn btn-success pull-right"><?=$string['g']['submitbtn']?></a></div>
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
        function isValidJSONString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }

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
                  if(isValidJSONString(data))
                  {
                    var response = JSON.parse(data);
                    if(response.code==200)
                    {
                      swal({
                         title: 'Submited!',
                         text: response.msg,
                         timer: 3000,
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
                  }else{
                    alert(data);
                  }
              });
            }
            });
          });
        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
