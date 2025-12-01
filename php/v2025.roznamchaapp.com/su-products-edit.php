<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

?>
<script src="js/JsBarcode.all.min.js"></script>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" class="" id="products_form">
            <input type="hidden" id="product_id" name="id" value="<?=$_GET['reqid']?>">
            <div class="modal-header">
                <h4 class="modal-title">Edit <?=ucwords($meta['info']['title']).' - '.$_GET['reqid']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">
                  <div class="col-12">

                      <div class="card wizard-content">
                          <div class="card-body">

                            <?php


                              $select_qry="SELECT * FROM `products` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `id`='$_GET[reqid]' ";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();
                              $row = $stmt->fetchAll();
                          //    print_r($row);

                             $tags=$row[0]['tags'];
                             $tags=trim($tags,'-,');
                             $tags=rtrim($tags,',-');


                             $variants=$row[0]['variants'];
                             $variants=trim_gfs($variants,'-,');
                             $variants=rtrim($variants,',-');

                              ?>

                              <h4 class="card-title">Basic Details</h4>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="name"> Item Name: <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" required="" id="name" name="name" aria-required="true" value="<?=$row[0]['name']?>">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="status"> Status: <span class="text-danger">*</span> </label>
                                      <select class="custom-select form-control required " id="status" name="status" aria-required="true">
                                        <option value="published">Published (Active)</option>
                                        <option value="draft">Draft</option>
                                        <option value="suspended">Suspended</option>
                                        <option value="delete">Delete</option>
                                      </select>
                                    </div>
                                  </div>
                              </div>
                              <script type="text/javascript">
                                $('#status').val('<?=$row[0]['status']?>');
                              </script>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="category"> Category / Brand:</label>
                                      <input type="text" class="form-control" required="" id="category" name="category" aria-required="true" value="<?=$row[0]['category']?>">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Tags: </label> <br />
                                      <input type="text" value="<?=$tags?>" class="form-control" name="tags" data-role="tagsinput" id="tags" >
                                      <br />
                                      <small>Comma separated. e.g Smartphone, Samsung, Android, 4G, white Color</small>
                                    </div>
                                  </div>
                              </div>


                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="barcode">Item code/Barcode:</label>
                                    <input type="text" class="form-control" required="" id="barcode" name="barcode" aria-required="true" value="<?=$row[0]['barcode']?>">
                                  </div>
                                  <?php
                                  if(!empty($row[0]['barcode'])){ ?>
                                  <svg id="barcode_view"></svg>
                                  <script type="text/javascript">
                                    JsBarcode("#barcode_view", "<?=$row[0]['barcode']?>");
                                  </script>
                                <?php }
                                ?>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="sku">SKU (Stock Keeping Unit):</label>
                                    <input type="text" class="form-control" required="" id="sku" name="sku" aria-required="true" value="<?=$row[0]['sku']?>">
                                    <input type="hidden" class="form-control" required="" id="available_stock" name="available_stock" aria-required="true" value="<?=$row[0]['available_stock']?>">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Item Description</label>
                                    <textarea class="form-control" name="description" id="description"><?=$row[0]['description']?></textarea>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Private Notes</label>
                                    <textarea class="form-control" name="notes" id="notes"><?=$row[0]['notes']?></textarea>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Stock Details</h4>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Measuring Unit <span class="text-danger">*</span> </label>
                                    <select name="measuring_unit" id="measuring_unit" class="form-control">
                                      <?php
                                        foreach ($list_measuring_units as $key )
                                        {
                                        ?>
                                          <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                        <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  <script type="text/javascript">
                                    $('#measuring_unit').val('<?=$row[0]['measuring_unit']?>');
                                  </script>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Available stock</label><br />
                                    <?=$row[0]['available_stock']?> <?=$row[0]['measuring_unit']?>
                                    <a href="#" class="btn btn-sm btn-warning pull-right changestockbtn" rel="2068">Change</a>
                                  </div>


                                </div>
                              </div>
                              <div class="row m-b-20" id="changestockbox">
                                <div class="col-sm-5">
                                  <label for="">Change stock Reason</label><br />
                                  <select class="form-control" name="change_stock_reason" id="change_stock_reason" >
                                    <option value="opening_balance">Openning Balance (Add)</option>
                                    <option value="extra">Found Extra (Add)</option>
                                    <option value="lost">Lost (Subtract)</option>
                                    <option value="damage">Damage (Subtract)</option>
                                  </select>
                                </div>
                                <div class="col-sm-4">
                                  <label for="">Effected Quantity</label><br />
                                  <input type="number" class="form-control" name="effected_qty" id="effected_qty">
                                </div>
                                <div class="col-sm-3">
                                  <br>

                                  <button type="button" class="btn btn-success waves-effect" id="change_stock_submit">Update Stock</button>
                                </div>
                              </div>
                              <script type="text/javascript">
                                $("#changestockbox").hide();
                              </script>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Minimum Stock Limit</label>
                                    <input type="number" class="form-control" name="min_stock_limit" id="min_stock_limit" value="<?=$row[0]['min_stock_limit']?>">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Reorder Stock Limit</label>
                                    <input type="number" class="form-control" name="max_stock_limit" id="max_stock_limit" value="<?=$row[0]['max_stock_limit']?>">
                                  </div>
                                </div>
                              </div>

                              <?php
                              if(isset($_SESSION['sess_bp_variants']))
                              {
                                  if($_SESSION['sess_bp_variants']=='on')
                                  {
                                    $select_variants_qry="SELECT * FROM `product_variants` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `product_id`='$_GET[reqid]' ";

                                    $stmt_variants = $db->prepare($select_variants_qry);
                                    $stmt_variants->execute();
                                    $row_variants = $stmt_variants->fetchAll();
                                //    print_r($row);
                                    ?>

                                    <div class="row p-t-20" id="row_variants">
                                      <div class="col-md-6"><label for="">Variants</label>
                                        <input type="text" data-role="tagsinput" value="<?=$variants?>" class="form-control" id="variants" name="variants" readonly />
                                        <br />
                                        <small>e.g Red, Green, Blue, Small, Large, Small Gray, Small Gray</small>
                                      </div>
                                    </div>
                                    <div id="variants_data">
                                      <?php
                                          foreach($row_variants as $variant_key => $variant_value)
                                          {
                                            ?>
                                            <div class="row p-t-20" id="<?=$variant_value['name']?>">
                                              <div class="col-md-4">
                                                <label for=""><?=$variant_value['name']?></label>
                                              </div>
                                              <div class="col-md-4">
                                                <input type="hidden" class="form-control" name="variants_fields[]" id="variants_fields_<?=$variant_value['name']?>" value="<?=$variant_value['name']?>">
                                                <input type="text" readonly class="form-control variants_qty_in" name="variant_<?=$variant_value['name']?>" id="variant_<?=$variant_value['name']?>" value="<?=$variant_value['available_stock']?>">
                                              </div>
                                              <div class="col-md-4"><?=$row[0]['measuring_unit']?></div>
                                            </div>
                                            <?php
                                          }
                                       ?>
                                    </div>
                                    <?php
                                  }
                                }

                               ?>


                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Price Details in <?=$_SESSION['sess_bp_currency']?></h4>

                                   <div class="row">
                                     <div class="col-md-6">
                                       <div class="form-group">
                                         <label for="">Purchase Cost <span class="text-danger">*</span> </label>
                                         <input type="number" class="form-control" name="purchase_cost" id="purchase_cost"  value="<?=$row[0]['purchase_cost']?>">
                                         <small>Per Unit</small>
                                       </div>
                                     </div>
                                   </div>

                                   <div class="row">
                                     <div class="col-md-6">
                                       <div class="form-group">
                                         <label for="">Sale Price <span class="text-danger">*</span> </label>
                                         <input type="number" class="form-control" name="sale_price" id="sale_price"  value="<?=$row[0]['sale_price']?>">
                                         <small>This is your ask price which can be changed on every bill</small>
                                       </div>
                                     </div>
                                     <div class="col-md-6">
                                       <div class="form-group">
                                         <label for="">Wholesale Price</label>
                                         <input type="number" class="form-control" name="wholesale_price" id="wholesale_price" value="<?=$row[0]['wholesale_price']?>">
                                         <small>Discounted sale price for bulk orders</small>
                                       </div>
                                     </div>

                                   </div>

                                 </div>
                               </div>
                               <div class="card">
                                 <div class="card-body">
                                   <h4 class="card-title">
                                     Sale on Platforms

                                     <?php
                                      // print_r($row);
                                     ?>
                                   </h4>
                                   <div class="row">
                                     <div class="col-md-12">
                                       <a href="https://www.moqame.com/<?=gnrm($db,'users',"`number`='$_SESSION[sess_bp_username]'",'country_code_iso')?>/<?=str_replace("+","",$_SESSION['sess_bp_username'])?>/product/<?=$row[0]['id']?>.html" class="pull-right btn btn-warning btn-sm" target="_blank">View on Store</a>
                                     </div>
                                   </div>
                                   <div class="row">
                                     <div class="col-md-12">
                                       <div class="form-group">
                                         <input name="platforms[]" value="moqame" type="radio" id="platforms_moqame_on" class="with-gap radio-col-cyan platforms_moqame" <?php if(strpos($row[0]['platforms'], 'moqame') !== false){ ?> checked <?php } ?>>
                                         <label for="platforms_moqame_on">Sale on moqame.com</label>
                                         <input name="platforms[]" value="" type="radio" id="platforms_moqame_off" class="with-gap radio-col-cyan platforms_moqame"  <?php if(strpos($row[0]['platforms'], 'moqame') !== false){}else{  ?> checked <?php } ?>>
                                         <label for="platforms_moqame_off">Dont Sale on moqame.com</label>
                                       </div>
                                     </div>
                                     <div class="col-md-8">
                                       <div class="form-group">
                                         <label for="">Youtube Demo Video Link</label>
                                         <input type="text" class="form-control" name="youtube_link" id="youtube_link" value="<?=$row[0]['youtube_link']?>">
                                         <small>(optional): Publish a demo video on youtube and paste link here</small>
                                       </div>
                                     </div>

                                     <div class="col-md-8">
                                       <div class="form-group">
                                         <label for="">Title</label>
                                         <input type="text" class="form-control" name="title" id="title" value="<?=$row[0]['title']?>">
                                         <small>Product title for moqame.com</small>
                                       </div>
                                     </div>

                                     <div class="col-md-12">
                                       <div class="form-group">
                                         <label for="">Product Description</label>
                                         <textarea name="product_description" class="form-control" rows="8" cols="80"><?=$row[0]['product_description']?></textarea>
                                       </div>
                                     </div>

                                   </div>
                                 </div>
                               </div>
                               <div class="card">
                                 <div class="card-body">
                                   <h4 class="card-title">Additional Features <small>(Configure <a href="c-profile.php" class="btn btn-link">Here</a>)</small></h4>


                               <?php
                               if(isset($_SESSION['sess_bp_tax']))
                               {
                                 if($_SESSION['sess_bp_tax']=='on')
                                 {
                                ?>
                                 <div class="row">
                                   <div class="col-md-12">
                                     <div class="form-group">
                                       <label for="">Tax Type</label>
                                       <select name="tax" id="tax" class="form-control">
                                       <?php
                                         foreach ($list_taxes as $key ) {
                                           // code...
                                           ?>
                                             <option value="<?=$key?>"><?=$key?></option>
                                           <?php
                                         }
                                        ?>
                                       </select>
                                     </div>
                                     <script type="text/javascript">
                                       $('#tax').val("<?=$row[0]['tax']?>");
                                     </script>
                                   </div>
                                 </div>
                               <?php

                             }                                }

                         if(isset($_SESSION['sess_bp_secondary_units']))
                         {
                           if($_SESSION['sess_bp_secondary_units']=='on')
                           {
                             $secondary_units = json_decode($row[0]['secondary_units'],true);
                             ?>
                             <h4>Secondary Units (Calculation)</h4>

                             <div class="secondary_unit_box">
                               <?php
                                foreach($secondary_units as $secondary_unit => $unit)
                                {
                                  ?>
                                    <div class="row p-t-20 secondary_unit_row">
                                      <div class="col-4">
                                        <select name="secondary_unit[]" required id="secondary_unit[]" class="form-control">
                                          <?php
                                            foreach ($list_measuring_units as $key )
                                            {
                                              // code...
                                              ?>
                                              <option value="<?=$key?>" <?php if(strtolower($unit['secondary_unit'])==strtolower($key)){ echo 'selected="selected"'; } ?>><?=ucfirst($key)?></option>
                                              <?php
                                            }
                                          ?>
                                        </select>
                                      </div>

                                      <div class="col-2">=</div>
                                      <div class="col-3">
                                        <input type="text" class="form-control" name="primary_unit_qty[]" value="<?=$unit['primary_unit_qty']?>">
                                      </div>
                                      <div class="col-2"><span class="primary_unit"></span></div>
                                      <div class="col-1 text-danger">
                                        <a href="#" class="remove_secondary_unit"><i class="mdi mdi-close text-danger"></i></a>
                                      </div>
                                    </div>
                                  <?php
                                }
                               ?>
                             </div>
                             <div class="row p-t-20 text-center">
                               <div class="col-12">
                                 <a href="#" id="add_secondary_unit_btn" class="btn btn-sm btn-inverse">Add More</a>
                               </div>
                             </div>

                           <?php
                           }
                         }
                       ?>

                       <div class="row">
                         <?php
                         if(isset($_SESSION['sess_bp_salesman_commission']))
                         {
                             if($_SESSION['sess_bp_salesman_commission']=='on')
                             {

                         ?>
                         <div class="col-md-6">
                           <div class="form-group">
                             <label for="">Salesman Commision</label>
                             <input type="number" class="form-control" name="salesman_commission" id="salesman_commission" value="<?=$row[0]['salesman_commission']?>">
                             <small>On every sale this amount will be added to salesman account. input fixed amount not in percentage.</small>
                           </div>
                         </div>
                       <?php
                             }
                         }

                         if(isset($_SESSION['sess_bp_lend_inventory']))
                         {
                             if($_SESSION['sess_bp_lend_inventory']=='on')
                             {

                         ?>
                         <div class="col-md-6">
                           <div class="form-group col-xs-12">
                               <h4 for="lend_inventory">Lendable Product</h4>
                               <input name="lend_inventory" value="on" type="radio" id="lend_inventory_on" class="with-gap radio-col-cyan lend_inventory">
                               <label for="lend_inventory_on">On</label>

                               <input name="lend_inventory" value="off" type="radio" id="lend_inventory_off" class="with-gap radio-col-blue-grey secondary_units" checked>
                               <label for="lend_inventory_off">off</label>
                           </div>
                           <script type="text/javascript">
                           $('#lend_inventory_<?=$row[0]['lend_inventory']?>').attr('checked','checked');
                           </script>
                         </div>
                       <?php
                             }
                         }

                         if(isset($_SESSION['sess_bp_agent_commision']))
                         {
                             if($_SESSION['sess_bp_agent_commision']=='on')
                             {
                       ?>
                         <div class="col-md-6">
                           <div class="form-group">
                             <label for="">Agent Commission</label>
                             <input type="number" class="form-control" name="agent_commission" id="agent_commission" value="<?=$row[0]['agent_commission']?>">
                             <small>On every sale this amount will be added to agent account. input fixed amount not in percentage.</small>
                           </div>
                         </div>
                       </div>
                       <?php
                             }
                         }
                       ?>
                     <div id="msgholder" class="alert alert-danger d-none"></div>

                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success waves-effect btn-block" id="editbtn">Update</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">
//  $("#my_awesome_dropzone").dropzone({ url: "/file/post" });
</script>
