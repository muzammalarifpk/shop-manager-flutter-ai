<?php

$meta=array();
$meta['module']=array('users','c-profile');
$meta['check']['admin']=false;
$meta['check']['permission']=true;

  require_once('includes/dbc.php');

  $meta['info']['title']=$string['c']['profile_title'];
  $meta['info']['des']=$string['c']['profile_des'];

  $meta['header']['css']=array(
    'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
    'Steps'=>'../assets/plugins/wizard/steps.css',
    'select2'=>'../assets/plugins/select2/dist/css/select2.min.css',
    'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
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
    'Validate Form'=>'../assets/plugins/wizard/jquery.validate.min.js',
    'sweetalert'=>'../assets/plugins/sweetalert/sweetalert.min.js',
    'sweetalert_custom'=>'../assets/plugins/sweetalert/jquery.sweet-alert.custom.js',
    'select2'=>'../assets/plugins/select2/dist/js/select2.full.min.js'
  );
  $meta['footer']['script']="";


?>
