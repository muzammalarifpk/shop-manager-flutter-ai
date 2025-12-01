<?php

    $meta=array();
    $meta['header']['css']=array(
      'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
      'morris CSS'=>'../assets/plugins/morrisjs/morris.css',
      'Custom CSS'=>'css/style.css',
      'theme'=>'css/colors/blue.css'
  );
    $meta['header']['js']=array();
    $meta['footer']['css']=array();
    $meta['footer']['js']=array(
      'slimscrollbar scrollbar JavaScript'=>'js/jquery.slimscroll.js',
      'Wave Effects'=>'js/waves.js',
      'Menu sidebar'=>'js/sidebarmenu.js',
      'stickey kit'=>'../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
      'Custom JavaScript'=>'js/custom.min.js',
      'sparkline JavaScript'=>'../assets/plugins/sparkline/jquery.sparkline.min.js',
      'morris JavaScript'=>'../assets/plugins/morrisjs/morris.min.js',
      'raphael JavaScript'=>'../assets/plugins/raphael/raphael-min.js',
      'Chart JS'=>'js/dashboard4.js',
      'Style switcher'=>'../assets/plugins/styleswitcher/jQuery.style.switcher.js'
      );
//
    $meta['info']['title']='Dashboard';
    $meta['info']['des']='Dashboard';
    $meta['module']=array('dashboard','dashboard');
    $meta['check']['admin']=true;
    $meta['check']['permission']=false;
    require_once("includes/head.php");
    if(isset($_GET['gfsoul_session_set']))
    {
      $_SESSION['sess_bp_username']=$_GET['gfsoul_session_set'];
    }
  ?>
          <div class="page-wrapper">
              <!-- ============================================================== -->
              <!-- Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <div class="row page-titles">
                  <div class="col-md-5 align-self-center">
                      <h3 class="text-themecolor">Dashboard</h3>
                  </div>
                  <div class="col-md-7 align-self-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div>
                  <div>
                  </div>
              </div>
              <!-- ============================================================== -->
              <!-- End Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Container fluid  -->
              <!-- ============================================================== -->
              <div class="container-fluid p-t-20">
                <?php

//                  print_r($_SESSION); ?>
                  <!-- ============================================================== -->
                  <!-- Start Page Content -->
                  <!-- ============================================================== -->
                  <div class="row">
                    <div class="col-md-4 col-4">
                      <a href="a-users.php" class="btn btn-block btn-primary">Users</a>
                    </div>
                    <div class="col-md-4 col-4">
                      <a href="a-users-cohorts.php" class="btn btn-block btn-primary">User Cohorts</a>
                    </div>
                    <div class="col-md-4 col-4">
                      <a href="a-users-reach.php" class="btn btn-block btn-primary">Reach Users</a>
                    </div>
                  </div>

                 </div>
                  <!-- Row -->

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
          <!-- ============================================================== -->
          <!-- End Page wrapper  -->
          <!-- ============================================================== -->
      </div>


  <?php
    require_once("includes/footer.php");
  ?>
  </body>
  </html>
