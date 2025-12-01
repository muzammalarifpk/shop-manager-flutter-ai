<?php
  $meta=array();
  $meta['info']['title']='Login';
  $meta['info']['des']='Description';
  require_once("includes/dbc.php");
  if(isset($_SESSION['sess_bp_user_id']) && isset($_SESSION['sess_bp_username']) && isset($_SESSION['sess_bp_name']))
  {
    header("Location: dashboard.php");
  }
  if(isset($_GET{'device'}))
  {
    $_SESSION['sess_bp_device']=$_GET['device'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$meta['info']['des']?>">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title><?=$meta['info']['title'].$signature?></title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background:#aaa;">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="login-box card">
                <div class="card-body">
                      <div class="tab-pane active" id="admin" role="tabpanel">
                          <div class="p-20">
                            <form class="form-horizontal form-material loginform" id="loginform" method="post" action="">
                                <h3 class="box-title m-b-20">Sign In - Your Account</h3>
                                <div class="alert alert-danger errorMsg hide" id="errorMsg"></div>
                                <div class="row number_details" id="number_details">
                                <div class="form-group col-md-4">
                                    <label for="country_code">Country Code</label>
                                    <select class="form-control" id="country_code" name="country_code" required="required">
                                      <option value="+92">+92</option>
                                      <?php
                                        for($i = 1; $i < 1000 ; $i++) {
                                          // code...
                                          ?>
                                            <option value="+<?=$i?>">+<?=$i?></option>
                                          <?php
                                        }
                                      ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-8 ">
                                        <label for="mobile">Mobile<br />Number</label>
                                        <input class="form-control" type="number" id="mobile" name="mobile" required="required" placeholder="">
                                </div>
                                  <div class="col-md-12 m-b-20 hide"><p>Your Username: <input type="hidden" id="username" class="username_input" name="number"><code><span id="username_box" class="username_box"></span></code></p></div>
                                </div>


                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" required="required" > </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 font-14">
                                        <a href="c-forget.php" id="to-recover" class="text-dark pull-right"> <i class="fa fa-lock m-r-5"></i> Forgot Password?</a> </div>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" id="loginbtn" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-20">
                                    <div class="col-sm-12 text-center">
                                      <div>Don't have an account? <a href="register.php" class=" m-l-5 btn btn-md btn-danger"><b>Register / Sign Up</b></a></div>
                                    </div>
                                </div>

                                <div class="form-group m-b-20 hide">
                                    <div class="col-sm-12 text-center">
                                      <div>Want to try first? <a href="#" id="doguestlogin" class=" m-l-5 btn btn-sm btn-warning"><b>Login as Guest</b></a></div>
                                    </div>
                                </div>

                                <div class="row hide">
                                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                        <div class="social">
                                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="login-box card">
                <iframe width="100%" height="260" src="https://www.youtube.com/embed/4US1c6o4pQk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            </div>
          </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122818105-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-122818105-2');
    </script>
    <?php require_once('includes/location.php');?>

    <script type="text/javascript">
      $(document).ready(function (e) {
        <?php
        if(isset($ip_calling_code))
        { ?>
          $('#country_code').val('+'+'<?=$ip_calling_code?>');
        <?php
        }
        ?>
        function update_number_generic(thisid)
        {

          var c_code=$("#"+thisid+" select").val();
          var mobile_number= $("#"+thisid+" input").val();

          var your_number = c_code + '-' + mobile_number;

          $("#"+thisid+" .username_box").html(your_number);
          $("#"+thisid+" .username_input").val(your_number);
        }


        $(".number_details select").change(function(e){
          var thisid=$(this).parents('.number_details').attr('id');
          update_number_generic(thisid);
        });

        $(".number_details input").change(function(e){
          var thisid=$(this).parents('.number_details').attr('id');
          update_number_generic(thisid);
        });


        $("#loginform").submit(function(e){
          e.preventDefault();
          console.log('Requesting login');
          $.ajax({
            url:'services/do_login.php',
            type:'POST',
            data: {username:$(".loginform #username").val(), password:$(".loginform #password").val()},
            success: function(resp) {
              // console.log("Response: "+resp);
              if(resp == "invalid") {
                $("#errorMsg").html("Invalid username and password! ");
                $("#errorMsg").show('slow');
              } else {
                console.log('valid details...');
               window.location.href= resp;
              }
            },error: function( jqXhr, textStatus, errorThrown ){
              alert( errorThrown );

            }
          });
        });
        $("#doguestlogin").click(function(e){
          e.preventDefault();
          $('#loginform #country_code').val('+1');
          $('#loginform #mobile').val('0000');
          $('#loginform #username').val('+1-0000');
          $('#loginform #username_box').val('+1-0000');
          $('#loginform #password').val('123456');

          $( "#loginbtn" ).trigger("click");


        });

        $("#e_loginform").submit(function(e){
          e.preventDefault();
          var employeedata=$(this).serialize();
          $.ajax({
            url:'services/do_employee_login.php',
            type:'POST',
            data: employeedata,
            success: function(resp) {
              if(resp == "invalid") {
                $("#errorMsg").html("Invalid username and password! ");
                $("#errorMsg").show('slow');
              } else {
                window.location.href= 'dashboard.php';
              }
            },error: function( jqXhr, textStatus, errorThrown ){
              alert( errorThrown );

            }
          });
        });

      });
    </script>
  </body>

</html>
