<?php

  // print_r($_GET);
  // $get_explode= explode('/',array_key_first($_GET));
  // print_r($get_explode);
  // echo $_GET['?shop'];
  // // die();
  // print_r($path_info);

  if(!isset($path_info[1]))
  {
    echo '<h1>Shop Not found.</h1>';
    die();
  }else
  {
    $company_url = '/'.$path_info[0].'/'.$path_info[1].'/';

    require_once('includes/dbc.php');
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
  }



$active_page= 1;
$items_per_page = 15;

if(isset($_GET['page_no']))
{

  $active_page = $_GET['page_no'];
  // echo '<h2>Page No: '.$active_page.'</h2>';
}
if($active_page<1)
{
  echo '<h1>Invalid Request.</h1>';
  die();
}
$start_limit=($active_page-1)*$items_per_page;
$end_limit=$start_limit+$items_per_page;


$sql_all_products = "select count(*) from `products` where `owner_mobile`='$shop_' and `platforms` like '%moqame%' and `status`='Published' order by `name` ";
$stmt_all_products = $db->prepare($sql_all_products);
$stmt_all_products->execute();

$count_all_products = $stmt_all_products->fetchColumn();
$total_pages = ceil($count_all_products/$items_per_page);

$sql_products = "select * from `products` where `owner_mobile`='$shop_' and `platforms` like '%moqame%'  and `status`='Published' order by `name` limit $start_limit,$items_per_page ";
$stmt_products = $db->prepare($sql_products);
$stmt_products->execute();

// print_r($stmt_products);

$products_count=$stmt_products->rowCount();
// echo '<h1>Products Count: '.$products_count.'</h1>';

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

      $products_data_array[]=array('url'=>$company_url.'product/'.$product_data['id'].'.html','img'=>$image_url,'price'=>$product_data['sale_price'],'title'=>$product_data['name']);
      // echo $stmt->rowCount();
    }
    while ($product_data = $stmt_products->fetch());
  }
  else
  {
    echo 'No Products Found...';
  }
}

?>
<script type="text/javascript">
$(document).prop('title', 'Products | <?=$user_data['business_name']?>');
</script>

<!-- Product Catagories Area Start -->
    <div class="amado-pro-catagory clearfix">

      <?php

      if($products_count>0)
        {
          foreach ($products_data_array as $key => $product) {
            // code...
            ?>
            <!-- Single Catagory -->
            <div class="single-products-catagory clearfix">
                <a href="<?=$product['url']?>">
                    <img src="https://shop-manager.roznamchaapp.com/<?=$product['img']?>" alt="">
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <div class="line"></div>
                        <p>Price <?=$user_data['currency']?><?=$product['price']?></p>
                        <h4><?=$product['title']?></h4>
                    </div>
                </a>
            </div>
            <?php
          }
        }
       ?>

    </div>

    <section class="slider-pagination" role="navigation">

      <div class="pageSlider long"></div>

      <form class="pageForm" action="#">

        <label class="pageLabel" for="pageInput">
          Page number you'd like to go to. (Max of <?=$total_pages?>)
        </label>

         <a
        class="pagePrev pageSkip"
        href="get_products.php?shop=<?=$shop?>&page_no=<?=$active_page-1?>"
        title="Previous Page (<?=$active_page-1?>)">Previous Page</a>

        <input id="pageInput" class="pageInput"
        type="text" maxlength="3" placeholder="#">

        <a
        class="pageNext pageSkip"
        href="get_products.php?shop=<?=$shop?>&page_no=<?=$active_page+1?>"
        title="Next Page (<?=$active_page+1?>)">Next Page</a>

        <a class="pageButton"
        href="get_products.php?shop=<?=$shop?>&page_no=<?=$active_page+1?>"
        title="Go to chosen page of results">Go</a>

      </form>

    </section>



<!-- Product Catagories Area End -->
<script src="https://www.moqame.com/js/active.js"></script>
<script type="text/javascript">
$(document).ready( function() {



var pagesMax =  <?=$total_pages?>;
var pagesMin = 1;
var startPage =  <?=$active_page?>;
var url = "https://www.moqame.com/?shop=<?=$shop?>&page_no={{1}}";

$('.slider-pagination .pageSlider').slider({

  value: startPage, max: pagesMax, min: pagesMin,
  animate: true,

  create: function( event, ui ) {

    $('.slider-pagination .pageSlider .ui-slider-handle').attr({
      "aria-valuenow": startPage,
      "aria-valuetext": "Page " + startPage,
      "role": "slider",
      "aria-valuemin": pagesMin,
      "aria-valuemax": pagesMax,
      "aria-describedby": "pageSliderDescription"
    });

    $('.slider-pagination .pageInput').val( startPage );

  }

}).on( 'slide', function(event,ui) {

    // let user skip 10 pages with keyboard ;)
    if( event.metaKey || event.ctrlKey ) {

      if( ui.value > $(this).slider('value') ) {

        if( ui.value+9 < pagesMax ) { ui.value+=9; }
        else { ui.value=pagesMax }
        $(this).slider('value',ui.value);

      } else {

        if( ui.value-9 > pagesMin ) { ui.value-=9; }
        else { ui.value=pagesMin }
        $(this).slider('value',ui.value);

      }

      event.preventDefault();

    }

    $('.slider-pagination .pageNumber span').text( ui.value );
    $('.slider-pagination .pageInput').val( ui.value );

}).on('slidechange', function(event, ui) {

    $('.slider-pagination .pageNumber')
      .attr('role','alert')
      .find('span')
      .text( ui.value );

    $('.slider-pagination .pageInput').val( ui.value );

    $('.slider-pagination .pageSlider .ui-slider-handle').attr({
      "aria-valuenow": ui.value,
      "aria-valuetext": "Page " + ui.value
    });

    var hrefStr='get_products.php?shop=<?=$shop?>&page_no=' + ui.value;

    $('.pageButton').attr('href',hrefStr);

});




$('.slider-pagination .pageSlider .ui-slider-handle').on( 'keyup' , function(e) {

if( e.which == 13 ) {
  var curPage = $('.slider-pagination .pageSlider').slider('value');
  // alert( 'we would now send you to: ' + url.replace( /{{.}}/ , curPage ));
}

});


$('.slider-pagination .pageInput').on( 'change' , function(e) {
$('.slider-pagination .pageSlider').slider( 'value', $(this).val() );
});





var tmr;
$('.pageSkip').on('click', function(e) {


  e.preventDefault();

  var $this = $(this);

  if( $this.hasClass('pageNext') ) {
    var curPage = $('.slider-pagination .pageSlider').slider('value')+1;
  } else if( $this.hasClass('pagePrev') ) {
    var curPage = $('.slider-pagination .pageSlider').slider('value')-1;
  }

  $('.slider-pagination .pageSlider').slider('value',curPage);

  clearTimeout(tmr);
  tmr = setTimeout( function() {
    // alert( 'we would now send you to: ' + url.replace( /{{.}}/ , curPage ));
  },1000);

});





function sliderPips( min, max ) {

var pips = max-min;
var $pagination = $('.slider-pagination .pageSlider');

for( i=0; i<=pips; i++ ) {

  var s = $('<span class="pagePip"/>').css({
    left: '' + (100/pips)*i + '%'
  });

  $pagination.append( s );

}

var minPip = $('<span class="pageMinPip">'+min+'</span>');
var maxPip = $('<span class="pageMaxPip">'+max+'</span>');
$pagination.prepend( minPip, maxPip );

};sliderPips( pagesMin, pagesMax );


function sliderLabel() {
$('.slider-pagination .ui-slider-handle').append(
  '<span class="pageNumber">Page <span>' +
  $('.slider-pagination .pageSlider').slider('value') +
  '</span></span>');
};sliderLabel();





$('.slider-pagination .pageButton').on('click', function(e) {

  e.preventDefault();
  var curPage = $('.slider-pagination .pageSlider').slider('value');


});






});


</script>
