<?php

  // print_r($_GET);
  // print_r($path_info[2]);

  if($path_info[2]=='services')
  {
    require_once('services.php');
  }elseif($path_info[2]=='products'){
    require_once('products.php');
  }elseif($path_info[2]=='category'){
    require_once('category.php');
  }elseif($path_info[2]=='product'){
    require_once('product-single.php');
  }elseif($path_info[2]=='addtocart'){
    require_once('addtocart.php');
  }elseif($path_info[2]=='cart'){
    require_once('cart.php');
  }elseif($path_info[2]=='checkout'){
    require_once('checkout.php');
  }elseif($path_info[2]=='get_contents.php'){
    require_once('products.php');
    // require_once('about-shop.php');
  }else{
    echo $path_info[2];
  }
?>
