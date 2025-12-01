<?php
//  require_once("t-sale-tax.config.php");
  $products_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='published' order by `name`";
  foreach ($db->query($products_query) as $row) {
    //print_r($row);

    $variants_qry= "select `name`,`available_stock`,`id` from `product_variants` where `owner_mobile`='$_SESSION[sess_bp_username]' and `product_id`='$row[id]' and `status` = 'Published'";

    $variants_count=0;
    $variants_data_array=Array();
    foreach ($db->query($variants_qry) as $row_variant)
    {
      $variants_count++;
      $variants_data_array[]=$row_variant['name'].'--:--'.$row_variant['available_stock'].'--:--'.$row_variant['id'];
    }


?>

<div class="col-lg-3 col-md-6 add_item_to_cart" id="item_<?=$row['id']?>_<?=$row['name']?>_<?=$row['sale_price']?>_<?=$row['available_stock']?>_<?=$row['purchase_cost']?>_<?=$row['measuring_unit']?>"
  rel="<?=strtolower($row['name'])?> <?=strtolower($row['tags'])?>"
  data-tax-type="<?=$row['tax']?>"
  data-variants-json='<?php echo implode('--,--',$variants_data_array);?>'
  data-variants="<?=$row['variants']?>"
  data-unit="<?=$row['measuring_unit']?>"
  data-variant_count="<?php echo $variants_count?>"
  data-secondary_units_count="<?=$row['secondary_unit_count']?>"
  data-secondary-units-json='<?=$row['secondary_units']?>'
  data-tax-rate="<?php if(strtolower($row['tax'])==strtolower('Exempted')){echo 0;}elseif(strtolower($row['tax'])==strtolower('Standard GST')){ echo $_SESSION['sess_bp_gst']; }elseif(strtolower($row['tax'])==strtolower('Standard VAT')){ echo $_SESSION['sess_bp_vat']; }else{ echo '0';}?>">
  <div class="card">
    <div class="el-card-item">
      <div class="el-card-content">
        <h3 class="box-title"><?=$row['name']?></h3>
        <p><?=$_SESSION['sess_bp_currency']?> <?=$row['sale_price']?></p>
        <p><small>Available Stock: <?=$row['available_stock']?></small></p>
        <p><small><?=$row['tags']?></small></p>
          </div>
      </div>
  </div>
</div>
<?php
}
?>
