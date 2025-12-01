<?php

$shop=$path_info[1];
$shop_='+'.$shop;

$sql = "select * from `users` where `number`='$shop_'";
$stmt = $db->prepare($sql);
$stmt->execute();

if($stmt->rowCount()==1)
{
  if ($shop_data = $stmt->fetch())
  {
    do
    {
      $user_data=$shop_data;
      // echo $stmt->rowCount();
    }
    while ($shop_data = $stmt->fetch());
  }
  else
  {
    echo 'Empty Query.';
  }
}else
{
  echo '<h1>Shop Not found.</h1>';
  die();
}


  // print_r($user_data);

  $company_url = '/'.$path_info[0].'/'.$path_info[1].'/';

  $page_title= $user_data['business_name'];
  $company_logo = 'https://shop-manager.roznamchaapp.com/'.$user_data['logo'];

  $image_type_check = @exif_imagetype($company_logo);//Get image type + check if exists
  if (strpos($http_response_header[0], "403") || strpos($http_response_header[0], "404") || strpos($http_response_header[0], "302") || strpos($http_response_header[0], "301")) {
      $company_logo = 'https://shop-manager.roznamchaapp.com/img/imageholders.png';
  }

  $products_array = array();
  $products_array[]=array('url'=>'shop.html','img'=>'img/bg-img/1.jpg','price'=>'From $180','title'=>'Modern Chair');




  $sql_all_products = "select count(*) from `products` where `owner_mobile`='$shop_' and `status`='Published' order by `name` ";
  $stmt_all_products = $db->prepare($sql_all_products);
  $stmt_all_products->execute();

  $count_all_products = $stmt_all_products->fetchColumn();


  $sql_products = "select * from `products` where `owner_mobile`='$shop_' and `status`='Published' order by `name` ";
  $stmt_products = $db->prepare($sql_products);
  $stmt_products->execute();

  $sql_catagories = "select DISTINCT `category` from `products` where `owner_mobile`='$shop_' and `status`='Published' order by `category` ";
  $stmt_category = $db->prepare($sql_catagories);
  $stmt_category->execute();

  $products_count=$stmt_products->rowCount();
  // echo '<h1>Products Count: '.$products_count.'</h1>';
  unset($products_array);
  if($products_count>0)
  {
    if ($product_data = $stmt_products->fetch())
    {
      do
      {
        // print_r($product_data);

        $image_url = gnr($db,'gallery','ref_id',$product_data['id'],'file_path');

        if($image_url=='N/A')
        {
          $image_url='img/video_placeholder.png';
        }

        $products_data_array[]=array('url'=>'shop.html','img'=>$image_url,'price'=>$product_data['sale_price'],'title'=>$product_data['name']);
        // echo $stmt->rowCount();
      }
      while ($product_data = $stmt_products->fetch());
    }
    else
    {
      echo 'No Products Found...';
    }
  }

  // print_r($products_data_array);
  // die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title><?=$page_title?></title>

    <!-- Favicon  -->
    <link rel="icon" href="/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/css/core-style.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="/js/jquery/jquery-2.2.4.min.js"></script>


<script type="text/javascript">
$(document).on('click','li', function(e){
  $("li").removeClass('active');
  $(this).addClass('active');
});

$(document).on('click','a', function(e){
   if(!$(this).hasClass('root'))
   {
     e.preventDefault();
     $('#ajax-content-area').html('');

     var pageURL=$(this).attr('href');
     var page_no = 1;

     <?php
       if(isset($_GET['page_no']) && is_int($_GET['page_no']))
       {
         ?>
           page_no = <?=$_GET['page_no']?>;
         <?php
       }
     ?>

      history.pushState(null, '', pageURL);

       // alert(pageURL);

      $.ajax({
         type: "GET",
         url: 'get_contents.php',
         data:pageURL,
         dataType: "html",
         success: function(data){

          $('#ajax-content-area').html(data);

         }
     });
   }
});



$(document).ready(function(){

loadPageData();

});


window.onpopstate = function() {
   loadPageData();
}; history.pushState({}, '');

function loadPageData(){
  var req_url = $(location).attr('href');
  // alert(req_url);
  var pageURL= newStr = req_url.substr(23, req_url.length);
  // alert(pageURL);

  $.ajax({
     type: "GET",
     url: 'get_contents.php',
     data:pageURL,
     dataType: "html",
     success: function(data){

     $('#ajax-content-area').html(data);

     }
  });



}
</script>
</head>
<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="<?=$company_url?>" class="root"><img src="<?=$company_logo?>" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="<?=$company_url?>" class="root"><img src="<?=$company_logo?>" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a  class="root" href="<?=$company_url?>">Home</a></li>
                    <li><a href="<?=$company_url?>cart/">Cart</a></li>

                    <!-- <li><a href="<?=$company_url?>services/">Services</a></li> -->
                    <!-- <li><a href="<?=$company_url?>products/">Product</a></li> -->
                    <!-- <li><a href="<?=$company_url?>checkout/">Checkout</a></li> -->
                </ul>
            </nav>
            <nav class="amado-nav">
                <ul>
                  <?php
                  if($stmt_products->rowCount()>0)
                  {
                    if ($category_row = $stmt_category->fetch())
                    {
                      do
                      {
                        // print_r();
                        ?>
                        <li class="-active"><a  class="root" href="<?=$company_url?>category/<?=($category_row['category'])?>"><?=$category_row['category']?></a></li>
                        <?php
                        // print_r($product_data);
                      }
                      while ($category_row = $stmt_category->fetch());
                    }
                    else
                    {
                      // echo 'No Products Found...';
                    }
                  }
                  ?>
                </ul>
            </nav>
            <!-- Button Group -->
            <!-- <div class="amado-btn-group mt-30 mb-100 hide">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div> -->
            <!-- Cart Menu -->
            <!-- <div class="cart-fav-search mb-100">
                <a href="cart.html" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div> -->
            <!-- Social Button -->
            <!-- <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div> -->
        </header>
        <!-- Header Area End -->
        <div class="products-catagories-area clearfix" id="ajax-content-area">
        </div>
  </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <!-- <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!- - Newsletter Text  - - >
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!- - Newsletter Form - - >
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <!-- <a href="<?=$company_url?>"><img src="img/core-img/logo2.png" alt=""></a> -->
                        </div>
                        <!-- Copywrite Text -->
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link root" href="<?=$company_url?>">Home</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="<?=$company_url?>services/">Services</a>
                                        </li>-->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="<?=$company_url?>products/">Products</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?=$company_url?>cart/">Cart</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="<?=$company_url?>checkout/">Checkout</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- Popper js -->
    <script src="/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="/js/plugins.js"></script>
    <!-- Active js -->
    <script src="/js/active.js"></script>
<script type="text/javascript">
function validVideoId(id) {
  var img = new Image();
  img.src = "http://img.youtube.com/vi/" + id + "/mqdefault.jpg";
  img.onload = function () {
    checkThumbnail(this.width,this.src,id);
  }
}

function checkThumbnail(width,image,video_id) {
  //HACK a mq thumbnail has width of 320.
  //if the video does not exist(therefore thumbnail don't exist), a default thumbnail of 120 width is returned.
  if (width === 120) {
    // alert("Error: Invalid video id");
  }else{
    // $(".carousel-indicators li").removeClass('active');
    // $(".carousel-inner .carousel-item").removeClass('active');
    // $( ".carousel-indicators" ).append('<li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url('+image+');"></li>');
    $( ".youtube_video" ).html('<iframe id="player" type="text/html" class="d-block w-100"  width="100%" height="390" src="https://www.youtube.com/embed/'+video_id+'?autoplay=1&origin=https://moqame.com" frameborder="0"></iframe>');
  }
}

$(".amado-navbar-toggler").click(function(){
  // alert('hello');
  $(".header-area").toggleClass("bp-xs-on");
});

</script>
</body>
</html>
