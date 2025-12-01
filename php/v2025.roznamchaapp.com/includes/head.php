<?php
  require_once("includes/dbc.php");


  if(isset($_SESSION['sess_bp_user_id']) || isset($_SESSION['sess_bp_admin_id']))
  {
    // admin or user logged in successfully...
  }else{
    header("Location: index.php");
  }

  if($meta['check']['admin']==true)
  {
    if(!isset($_SESSION['sess_bp_admin_id']))
    {
      // only admin is allowed to access it...
      header("Location: index.php");
    }
  }

  inprivs($meta['module'][0],$meta['check']['permission']);
  $all_status_where = " and (`status`='published' or `status`='Published') ";
  if(isset($_GET['show_all_status']) )
  {
    if($_GET['show_all_status']=='yes')
    {
      $all_status_where = '';
    }
  }

  //print_r($_SERVER['REQUEST_URI']);


//die();
if($_SERVER['REQUEST_URI']!=='/c-membership.php' && (!isset($_SESSION['sess_bp_admin'])))
{

  $coins = gnr($db,'users','number',$_SESSION['sess_bp_username'],'coins');


//  print_r($_SESSION);
  if(isset($_SESSION['sess_bp_type']))
  {
    $wheres = "`owner_mobile`='".$_SESSION['sess_bp_username']."'";
    $entries_count=cnrm($db,'journal',$wheres);

    if($_SESSION['sess_bp_type']=='prepaid' && (time()>($_SESSION['sess_bp_timestamp']+($free_trial_days*$one_day_ms))))
    {
//      echo date("d M. Y",($_SESSION['sess_bp_timestamp']+($free_trial_days*$one_day_ms)));
      ?>
      <script type="text/javascript">
        window.location.href='c-membership.php';
      </script>
      <?php
      die();

    }else{
      if($_SESSION['sess_bp_type']=='sponsor')
      {
        if(!isset($_SESSION['sess_bp_expiry_date']))
        {
          $_SESSION['sess_bp_expiry_date']=(gnr($db,'users','number',$_SESSION['sess_bp_username'],'date'));
        }

        if(isset($_SESSION['sess_bp_expiry_date']))
        {

          if(strtotime($_SESSION['sess_bp_expiry_date'])<time() )
          {
//            echo '<h3>Expiry Date: '.strtotime($_SESSION['sess_bp_expiry_date']).'</h3>';
            ?>
            <script type="text/javascript">
              window.location.href='c-membership.php';
            </script>
            <?php
            die();
          }

        }
      }
    }
  }
}

//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$meta['info']['title']?>">
    <meta name="author" content="Muzammal Arif">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title><?=$meta['info']['title'].$signature?></title>

    <?php
      foreach ($meta['header']['css'] as $key => $value) {
      ?>
      <!-- <?=$key?>  -->
      <link href="<?=$value?>" id="<?=strtolower(str_replace(" ","_",$key));?>" rel="stylesheet">
      <?php
      }
    ?>

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
if(!isset($_SESSION['sess_bp_admin_id'])){
?>
<?php
  $wheres = "`owner_mobile`='".$_SESSION['sess_bp_username']."'";
  $entries_count=cnrm($db,'journal',$wheres);

  if($entries_count>5)
  {
    ?>
      <style media="screen">
        .new_guide{display: none;}
      </style>
    <?php
  }else{
    ?>
      <style media="screen">
        .new_guide{display: inline-block; position: absolute; background:#ef534f; border-radius:3px; padding: 3px 7px; right: 20px; top: 12px;}
        .btn-primary .new_guide{top: -8px !important;}
      </style>
    <?php
  }

  if($entries_count<50)
  {
    ?>
        <!-- fullstory snippit for screen recording-->
    <script>
        window['_fs_debug'] = false;
        window['_fs_host'] = 'fullstory.com';
        window['_fs_script'] = 'edge.fullstory.com/s/fs.js';
        window['_fs_org'] = 'QV62D';
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


        // This is an example script - don't forget to change it!
        FS.identify('<?=$_SESSION['sess_bp_username']?>', {
          displayName: '<?=$_SESSION['sess_bp_name']?>',
          email: '<?=$_SESSION['sess_bp_username']?>',
          // TODO: Add your own custom user variables here, details at
          // https://help.fullstory.com/hc/en-us/articles/360020623294
          reviewsWritten_int: <?=$_SESSION['sess_bp_week']?>
        });
    </script>
            <?php
  }
    if(isset($_SESSION['location']))
    {
    if($_SESSION['location']=='Pakistan' && $entries_count<150)
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


        // This is an example script - don't forget to change it!
        FS.identify('<?=$_SESSION['sess_bp_username']?>', {
          displayName: '<?=$_SESSION['sess_bp_name']?>',
          email: '<?=$_SESSION['sess_bp_username']?>',
          // TODO: Add your own custom user variables here, details at
          // https://help.fullstory.com/hc/en-us/articles/360020623294
          reviewsWritten_int: <?=$_SESSION['sess_bp_week']?>
        });
    </script>
            <?php
          }
        }
}
 ?>
 <script type="text/javascript">
 $(document).on('click','.reload_page',function(e){
   $('.preloader').show();
   location.reload();
 });
 $(document).on('click','.go_back',function(e){
   $('.preloader').show();
   window.history.back();
 });
</script>
<!-- Global site tag (gtag.js) - Google Ads: 811004310 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-811004310"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-811004310');
</script>

</head>

<body class="fix-header fix-sidebar card-no-border">

  <?php
  if(!isset($_SESSION['sess_bp_admin_id'])){

  if($entries_count>25000){



   ?>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '592610734907705',
        cookie     : true,
        xfbml      : true,
        version    : 'v5.0'
      });

      FB.AppEvents.logPageView();

    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
<?php } }?>

    <!-- ====================================================== 000 ======== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <header class="topbar d-print-none">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link go_back"><i class="mdi mdi-arrow-left"></i></a>
                        </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item span-holder"><span class="nav-page-title ml-md-5 pt-sm-2"><?=$meta['info']['title']?></span></li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item">
                          <a href="dashboard.php" class="nav-link"><i class="mdi mdi-home"></i></a>
                        </li>
                        <li class="nav-item">
                          <a href="https://moqame.com/PK/<?=str_replace("+","",$_SESSION['sess_bp_username'] ?? '')?>/" target="_blank" class="nav-link"><i class="mdi mdi-web"></i></a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
        <!--                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> - ->
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -- >
                                            <?php
                                            $notifications_query="select * from `inbox` where `owner_mobile`='$_SESSION[sess_bp_username]' and `read_status`='0' order by `id` desc";
                                            foreach ($db->query($notifications_query) as $row)
                                            {
                                              ?>
                                              <a href="<?=$row['link']?>">
                                                  <div class="btn btn-warning btn-circle"><i class="fa fa-exclamation-triangle"></i></div>
                                                  <div class="mail-contnet">
                                                      <h5><?=$row['title']?></h5> <span class="mail-desc"><?=$row['text']?></span> <span class="time"><?=date("d-m-Y",$row['date_time'])?></span> </div>
                                              </a>
                                              <!-- Message - ->
                                              <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                                    <li class="hide">
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <li class="nav-item">
                          <a href="#" class="nav-link reload_page"><i class="mdi mdi-reload"></i></a>
                        </li>
                        <!-- <li class="nav-item hidden-sm-down search-box hide"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li> -->
                        <li class="nav-item">
                          <a href="c-membership.php" class="nav-link"><i class="fa fa-user"></i><div class="notify"> <span class="heartbit"></span> <span class="point"><?=$coins?></span> </div></a>
                        </li>

                    </ul>
                </div>
            </nav>
            <?php
            if(isset($_SESSION['sess_bp_type']))
            {
              if($_SESSION['sess_bp_type']=='sponsor')
              {

                if(isset($_SESSION['sess_bp_expiry_date']))
                {

                  if((strtotime($_SESSION['sess_bp_expiry_date']) - ($one_day_ms*3))<time())
                  {
                    ?>
                      <div class="noticebar" style="text-align: center; padding: 10px; background: #f00; color: #fff; font-size: 18px;">
                        <p>Your account is going to expire soon. check details <a href="c-membership.php">here</a>... </p>
                      </div>
                      <?php
                  }
                }
              }
            }
          ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <aside class="left-sidebar hide d-print-none">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <?php
        //              echo $logo_file = gnrm($db,'users',"`number`='$_SESSION[sess_bp_username]'",'logo');
                    if(isset($_SESSION['sess_bp_name']))
                    {

                      if(!isset($_SESSION['sess_bp_logo']) || ($_SESSION['sess_bp_logo']=='img/imageholders.png'))
                      {
                        $logo_file = gnrm($db,'users',"`number`='$_SESSION[sess_bp_username]'",'logo');
                        // echo $logo_file;
                        if(file_exists($logo_file ?? ''))
                        {
                          $logo_url=$logo_file;
                        }else{
                          $logo_url = 'img/imageholders.png';
                        }
                        $_SESSION['sess_bp_logo']=$logo_url;
                      }
                    }else{
                      $logo_url = 'img/imageholders.png';
                      $_SESSION['sess_bp_logo']=$logo_url;
                    }
                    ?>
                    <div class="profile-img"> <img src="<?=$_SESSION['sess_bp_logo']?>" alt="Logo" />
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?php if(isset($_SESSION['sess_bp_name'])){ echo $_SESSION['sess_bp_name'];}else{ echo 'Admin Panel';}?></h5>
                        <?php
                          if(isset($_SESSION['sess_bp_admin_id']))
                          {
                        ?>
                        <a href="admin-dashboard.php" class="" data-toggle="tooltip" title="DashBaord"><i class="mdi mdi-home"></i></a>

                      <?php }else{
                        ?>
                        <a href="dashboard.php" class="" data-toggle="tooltip" title="DashBaord"><i class="mdi mdi-home"></i></a>
                        <?php
                      } ?>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="logout.php" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="c-profile.php" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <!-- text-->
                            <a href="c-change-password.php" class="dropdown-item"><i class="ti-key"></i> Change Password</a>
                            <!-- text-->
                            <a href="c-membership.php" class="dropdown-item"><i class="ti-wallet"></i> Membership</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="t-sale.php" class="dropdown-item"><i class="ti-settings"></i> Create Invoice</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Main Menu</li>
                        <?php
                          if(isset($_SESSION['sess_bp_admin_id']))
                          {
                        ?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Manage</span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if(isset($_SESSION['sess_bp_admin_privs']))
                                {
                                    if($_SESSION['sess_bp_admin_privs']=='*')
                                    {
                               ?>
                                <li><a href="admin.php">Admins </a></li>
                                <li><a href="apackages.php">Packages</a></li>

                                <li><a href="a-users-cohorts.php">Users Cohorts</a></li>
                                <li><a href="a-users-reach.php">Reach Users</a></li>
                                <?php

                                    }
                                }
                               ?>
                                <li><a href="a-users.php">Users</a></li>
                            </ul>
                        </li>
                        <?php
                          }
                        ?>
                        <?php
                          if(!isset($_SESSION['sess_bp_admin_id']))
                          {
                        ?>
                        <li>
                          <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>Manage<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('chartofaccount',$_SESSION['sess_bp_privs'])) )
                                {
                               ?>
                                <li><a href="su-chartofaccount.php">Banks and Accounts</a></li>
                              <?php
                                }
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('products',$_SESSION['sess_bp_privs'])) )
                                {
                              ?>
                              <li><a href="su-products.php">Products</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('services',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="su-services.php">Services</a></li>
                                  <?php
                                    }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('contacts',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="su-contacts.php">All Contacts</a></li>
                                <li><a href="su-contacts.php?type=Customer">Customers</a></li>
                                <li><a href="su-contacts.php?type=Supplier">Suppliers</a></li>
                                <li><a href="su-contacts.php?type=Agents">Agents</a></li>
                                <li><a href="su-contacts.php?type=Employee">Employees</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('posaccess',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="su-posaccess.php">Employees Access</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('expense_types',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="su-expense.php">Expense Types</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('locations',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="su-locations.php">Locations/Warehouse</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('va-jobs',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="va-jobs.php">Manufacturing Jobs</a></li>
                                  <?php
                                  }
                                ?>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>Transaction<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('t-sale',$_SESSION['sess_bp_privs'])) )
                                {
                              ?>
                                <li><a href="t-sale.php">Sale Invoice</a></li>
                                <li><a href="t-wholesale.php">WholeSale Invoice</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-sale-returns',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-sale-returns.php">Sales Return</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-purchase',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-purchase.php">Purchase Invoice</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-purchase-returns',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-purchase-returns.php">Purchase Return</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-expense',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-expense.php">New Expense</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-payments',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-payments.php">New Payments</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-stock-transfer',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-stock-transfer.php">Stock Transfer</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('va-jobs',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="va-jobs.php">Manufacturing Jobs</a></li>
                                  <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('t-journal',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="t-journal.php">Journal Entry</a></li>
                                <?php
                                  }
                                ?>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>Reports<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('r-journal',$_SESSION['sess_bp_privs'])) )
                                {
                              ?>
                                <li><a href="r-journal.php">General Journal</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-stock',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="r-stock.php?stock_status=available_stock">Stock Report</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' )
                                  {
                                ?>
                                <li><a href="r-lend-inventory.php">Lended Inventory</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-purchase_ratelist',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="su-products.php?ratelist=purchase">Purchase Rate List</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-sale_ratelist',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="su-products.php?ratelist=sale">Sale Rate List</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-sold-items',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="r-sold-items.php">Sold Items</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-profitnloss',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="r-profitnloss.php">Profit and Loss</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-balance-sheet',$_SESSION['sess_bp_privs'])) )
                                  {
                                    ?>
                                    <li><a href="r-balance-sheet.php">Balance Sheet</a></li>
                                    <?php
                                  }

                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-receivable',$_SESSION['sess_bp_privs'])) )
                                  {
                                  ?>
                                  <li><a href="r-receivable.php">Receivable / Payable</a></li>
                                  <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-daily-report',$_SESSION['sess_bp_privs'])) )
                                  {
                                  ?>
                                  <li><a href="r-daily-report.php">Daily Report</a></li>
                                  <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('r-sales',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="r-purchase-by-contact.php">Purchase Report by Supplier</a></li>
                                <li><a href="r-sale-by-customer.php">Sales Report by Customer</a></li>
                                <li><a href="r-sales.php">Sales Report</a></li>
                                <li><a href="r-sales.php?sale_type=cash">Cash Sales</a></li>
                                <li><a href="r-sales.php?sale_type=credit">Credit Sales</a></li>
                                <li><a href="r-sales.php?sale_type=partial">Partially Paid Sales</a></li>
                                <?php
                                  }

                                ?>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>History<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('h-sale',$_SESSION['sess_bp_privs'])) )
                                {
                              ?>
                                <li><a href="h-sale.php">Sales History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-sale-return',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-sale-return.php">Sales Return History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-qoutation',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                  <li><a href="h-qoutation.php">Sales Qoutation History</a></li>
                                  <?php
                                    }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-purchase',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-purchase.php">Purchases History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-purchase-return',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-purchase-return.php">Purchases Return History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-expense',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-expense.php">Expense History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-payments',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-payments.php">Payment History</a></li>
                                <?php
                                  }
                                  if($_SESSION['sess_bp_privs']=='*' || (in_array('h-stock_transfer',$_SESSION['sess_bp_privs'])) )
                                  {
                                ?>
                                <li><a href="h-stock-transfer.php">Stock Transfer</a></li>
                                <?php
                                  }
                                ?>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>Utilities<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <li><a href="su-todo.php">ToDo List</a></li>
                              <li><a href="t-shipping.php">Print Shipping</a></li>
                              <li><a href="h-shipping.php">Shipping History</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i>Setting<span class="hide-menu"></span></a>
                            <ul aria-expanded="false" class="collapse">
                              <?php
                                if($_SESSION['sess_bp_privs']=='*' || (in_array('chartofaccount',$_SESSION['sess_bp_privs'])) )
                                {
                              ?>
                              <li><a href="c-profile.php">Profile</a></li>
                              <?php
                                }
                                $whatsapp_link_buynow = 'https://wa.me/'.str_replace('-','',str_replace('+','','923434123489')).'?text='.urlencode("Hello BasePlan, I am using your cloud version and want to buy it. Please help me. My Username is: ".$_SESSION['sess_bp_username']);
                              ?>
                              <li><a href="c-change-password.php">Change Password</a></li>
                              <li><a href="c-membership.php">Membership</a></li>
        <!--                      <li><a href="app-chat.php">Chat</a></li>-->
                              <li><a href="<?=$whatsapp_link_buynow?>" target="_blank">Buy Now</a></li>
                              <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                      <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--

        <div class="danger_bar" style="background: red; width:100%; padding:5px;">
          <p>hello world.</p>
        </div>
      -->


        <?php
//          require_once("includes/header.php");
          ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
