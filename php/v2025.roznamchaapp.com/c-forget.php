<?php
  $meta=array();
  $meta['info']['title']='Forget Password';
  $meta['info']['des']='Forgot password';
  $source='default';
  require_once("includes/dbc.php");
  if(isset($_SESSION['sess_bp_user_id']) && isset($_SESSION['sess_bp_username']) && isset($_SESSION['sess_bp_name']))
  {
    header("Location: dashboard.php");
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title><?=$meta['info']['title']?></title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/intlTelInput.css" rel="stylesheet">
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

  <?php

  if(isset($_SESSION['location']))
  {
  if($_SESSION['location']=='Pakistan')
  {
  ?>
      <!-- fullstory snippit for screen recording-->
      <script>
      window['_fs_debug'] = false;
      window['_fs_host'] = 'fullstory.com';
      window['_fs_script'] = 'edge.fullstory.com/s/fs.js';
      window['_fs_org'] = 'Q2E63';
      window['_fs_namespace'] = 'FS';
      (function(m,n,e,t,l,o,g,y){
          if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
          g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
          o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_script;
          y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
          g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
          g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
          g.log = function(a,b) { g("log", [a,b]) };
          g.consent=function(a){g("consent",!arguments.length||a)};
          g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
          g.clearUserCookie=function(){};
      })(window,document,window['_fs_namespace'],'script','user');

          </script>
          <?php
          }
          }

          ?>
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
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="register_form" action="">
                      <div class="">
                        <div class="col-xs-12">
                          <h3 class="box-title m-b-20">Recover Password</h3>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label for="country_code">Country Code</label>
                            <select class="form-control" id="country_code" name="country_code" required="required">
                              <option value="">--</option>
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
                          <div class="hide col-md-12 m-b-20"><p>Your Username: <input type="hidden" id="number" name="number"><code><span id="your_number"></span></code></p></div>
                        </div>
                        <div id="response">

                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require_once('includes/location.php');?>
    <script type="text/javascript">
        $(document).ready(function() {
          <?php if(isset($ip_calling_code))
          {
            ?>
          $('#country_code').val('+'+'<?=$ip_calling_code?>');
          <?php }
          ?>
          function update_number()
          {
            var c_code=$("#country_code").val();
            var mobile_number= $("#mobile").val();

            var your_number = c_code + '-' + mobile_number;

            $("#your_number").html(your_number);
            $("#number").val(your_number);
          }


          $("#register_form").submit(function(e){
            e.preventDefault();
            $('.preloader').show();
            var form_data = $("#register_form").serialize();
//            alert(form_data);

            $.ajax({
              url:'services/get_forget_user.php',
              type:'POST',
              data: form_data,
              success: function(resp) {
  //              alert(resp);
                //  console.log(resp);
                data = jQuery.parseJSON(resp);
                //  alert(data['msg']);
                if(data['code'] == 200) {
                  $('#response').html('<div class="alert alert-success">User found, <strong>An email has been sent to <u>'+data['data']['email']+'</u> for password recovery. if you dont find in inbox.</strong> Please check spam/junk.</div>');

                } else {
                  $('#response').html('<div class="alert alert-danger">'+data['msg']+'</div>');
                }
              }
            });


            $('.preloader').hide();

          });


          $("#country_code").change(function(e){
            update_number();
          });

          $( "#mobile" ).keyup(function() {
            update_number();
          });

          update_number();

        });
    </script>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
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
    <script src="js/intlTelInput.js"></script>
    <script src="js/mask.js"></script>
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
    </body>

</html>
