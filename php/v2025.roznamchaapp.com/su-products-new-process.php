<?php
require_once("includes/dbc.php");
require_once("su-products.config.php");
require_once('su-products-func.php');

  if(isset($_GET['reqid']))
  {
    process_insert_form($db,$_POST,$all_fields,$meta['module'][0],$_GET['reqid']);
  }else{
    process_insert_form($db,$_POST,$all_fields,$meta['module'][0]);
  }


?>
