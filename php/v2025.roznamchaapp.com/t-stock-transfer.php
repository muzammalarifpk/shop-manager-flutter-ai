<?php
  require_once("t-stock-transfer.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<style>
.block12{width: 100% !important;}
.block11{width: 91.63% !important;}
.block10{width: 83.33% !important;}
.block9{width: 75% !important;}
.block8{width: 66.64% !important;}
.block7{width: 58.31% !important;}
.block6{width: 50% !important;}
.block5{width: 41.65% !important;}
.block4{width: 33.32% !important;}
.block3{width: 25% !important;}
.block2{width: 16.66% !important;}
.block1{width: 8.33% !important;}
.form-horizontal{width: 100%;}
.form-horizontal .row{ margin-top: 10px; margin-bottom: 10px;}
<?php
if($_SESSION['sess_bp_tax']!=='on')
{
  ?>
  .tax_td{ display: none;}
  <?php

}
?>
</style>
<?php
if($_SESSION['sess_bp_username']=='+92-03454242342')
{
  ?>
    <script type="text/javascript">
      window.location.href='t-sale-923454242342.php';
    </script>
  <?php
}

?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <?php
                          $module_count=count($meta['module']);
                          $counter=1;
                          foreach ($meta['module'] as $key => $value) {

                            ?>
                              <li class="breadcrumb-item
                              <?php

                                if($counter==$module_count)
                                {
                                  echo 'active';
                                }

                              ?>"><?=ucfirst($value)?></li>
                            <?php
                            $counter++;
                          }
                        ?>
                    </ol>
                </div>
                <div  class="hide">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <div class="row">

                        <div id="product_variants_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; position:inherit !important;">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <input type="hidden" class="product_id" name="" value="">
                                      <h4 class="modal-title">Select Variant for <span class="product_name"></span></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row  el-element-overlay"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" id="update_variants" class="btn btn-success waves-effect waves-light pull-right submit_variants_btn">Submit</button>
                                  </div>
                              </div>
                          </div>
                        </div>


                        <div id="product_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Products to Bill</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                      <div class="row">
                                        <div class="col-sm-4">
                                          <label for="product_search_box">Search Products</label>
                                        </div>
                                        <div class="col-sm-4">
                                          <input type="text" id="product_search_box" class="form-control" name="" value="" placeholder="Search Product">
                                        </div>
                                      </div>

                                      <div id="" class="m-t-20">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="row el-element-overlay">

                                                <?php
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
                                                  data-item-id="<?=$row['id']?>"
                                                  data-item-name="<?=$row['name']?>"
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
                                                        <p><small>Available Stock: <?=$row['available_stock']?></small></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            <?php
                                            }
                                           ?>
                                          </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </div>




                  </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">
                              <?php
                                $all_fields=array('contact_name','invoice_date','sub_total','discount','grand_total','amount_paid','payment_method','remaining_balance','products_json','invoice_number');
                               ?>
                                    <h2 class="hide">Add New sale</h2>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-4">
                                          <label for="from_location">From Location </label>
                                          <select class="form-control select2" name="contact_name" id="from_location">
                                            <option value="">Shop</option>
                                            <?php
                                            $locations_query="select * from `locations` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' order by `name` asc ";

                                            foreach ($db->query($locations_query) as $row)
                                            {
                                             ?>
                                             <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                            <?php
                                              }

                                             ?>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="to_location">To Location </label>
                                          <select class="form-control select2" name="contact_name" id="to_location">
                                            <?php
                                            $locations_query="select * from `locations` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' order by `name` desc ";

                                            foreach ($db->query($locations_query) as $row)
                                            {
                                             ?>
                                             <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                            <?php
                                              }
                                             ?>
                                             <option value="">Shop</option>
                                          </select>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="date">Date </label>

                                          <div class="input-group">
                                              <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                              <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12 block12">
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                              <tr>
                                                <th class="sr hide">#</th>
                                                <th class="name">Product Name</th>
                                                <th class="qty">Qty</th>
                                                <th class="status" width="20%"></th>
                                              </tr>
                                            </thead>
                                            <tbody id="cart_items">

                                            </tbody>
                                            </table>
                                            <a href="#" id="product_modal_btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to List</a>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-4">
                                          <label for="notes">Notes</label>
                                        </div>
                                        <div class="col-sm-8">
                                          <textarea name="notes" class="form-control" rows="5" id="notes" placeholder="Some notes about this sale." ></textarea>
                                        </div>
                                      </div>

                                      <div id="msgholder" class="alert alert-danger d-none"></div>

                                      <div class="row">
                                        <div class="col-sm-12"><a href="#" id="resetbtn" class="btn btn-danger pull-left">Cancel</a><a href="#" id="submitbtn" class="btn btn-success pull-right">Save and Next</a></div>
                                      </div>


                                </form>
                              </div>
                            </div>

                          </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php require_once("includes/right.php"); ?>
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
        <?php
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script type="text/javascript">
          function isValidJSONString(str) {
              try {
                  JSON.parse(str);
              } catch (e) {
                  return false;
              }
              return true;
          }

          function remove_item(row_id){
              $('#row_'+row_id).remove();
          }

          $('#product_search_box').keyup(function(e){
            var key = $(this).val();

            if(key.length>1)
            {
              $('.add_item_to_cart').hide();
              $("[rel*='"+key+"']").show();
            }else{
              $('.add_item_to_cart').show();
            }
          });


          $(document).on('click','.remove_item',function(){
            var this_id = $(this).attr('data-item-id');
            remove_item(this_id);
          });

          $(document).on('click','.add_item_to_cart',function(){
              var item_id = $(this).attr('data-item-id');
              var item_name = $(this).attr('data-item-name');

              var item_row = '<tr id="row_'+item_id+'" data-item_id="'+item_id+'"><td class="hide"></td><td>'+item_name+'</td><td><input type="number" name="item_'+item_id+'" data-item_id="'+item_id+'" id="item_'+item_id+'" value="1" class="form-control" /></td><td><a style="color:#fff;"  class="btn btn-sm btn-danger remove_item pull-right" title="" data-item-id="'+item_id+'" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td></tr>';
              $('#cart_items').append(item_row);
              $('#product_modal').modal('hide')
              $('#product_search_box').val('');
              $('.add_item_to_cart').show();
          });

          $(document).on('click','#submitbtn',function(e){
            e.preventDefault();
            $('.preloader').show();
//            alert('lets submit');

            var from_location = $('#from_location').val();
            var to_location = $('#to_location').val();
            var date = $('#datepicker-autoclose').val();
            var notes = $('#notes').val();
            var products = '[';

            $("#produutsincart tbody tr").each(function(){
              var item_id = $(this).attr('data-item_id');
              var item_qty = $('#item_'+item_id).val();
//              products['_'+item_id]=item_qty;
              products+='{"item_id":"'+item_id+'","item_qty":"'+item_qty+'"},';
            });

            products = products.slice(0,-1);
            products+=']';

            var post_url = 't-stock-transfer.process.php';
            var form_data = {from_location: from_location, to_location: to_location, date: date, notes: notes, products: products};

            var jqxhr = $.post( post_url, form_data)
              .done(function(msg) {
                console.log(msg);
                if(isValidJSONString(msg))
                {
                  var response = jQuery.parseJSON( msg );
                  if(response.code == 200){

                      swal({
                         title: 'Submited!',
                         text: 'Record has been added successfully.',
                         timer: 2000,
                         type: 'success',
                         showConfirmButton: false
                      });
                      location.reload();


                  }else{
                      $("#msgholder").html(response.msg);
                      $("#msgholder").removeClass('d-none');
                      $('.preloader').hide();
                  }

                }else{
                  $("#msgholder").html(msg);
                  $("#msgholder").removeClass('d-none');
                  $('.preloader').hide();
                }

              })
              .fail(function (jqXHR, textStatus, errorThrown) {
                alert("There has been an issue while loading: "+errorThrown+". Please report this issue to technical support.");
                setTimeout(function(){ window.location.reload(); }, 3000);
              });



          });
        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
