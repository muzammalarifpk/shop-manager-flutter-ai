<?php
  require_once("va-jobs.config.php");
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

                        <div id="expense_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <form class="" action="" method="post" name="expense_form">

                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Expense to Activity</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <lable for="expense_type">Expense Type</lable>
                                      </div>
                                      <div class="col-sm-6">
                                        <select class="form-control" name="expense_type" id="expense_type">
                                          <?php
                                          foreach ($list_expense_types as $key => $row )
                                          {

                                           ?>
                                          <option value="<?=$row?>"><?=$row?></option>
                                          <?php
                                            }

                                           ?>
                                           <option value="Others">Others</option>
                                        </select>
                                        <br />
                                      </div>

                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="amount">Amount</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="number" required class="form-control" name="amount" id="amount" value="">
                                      </div>
                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="payment_method">Payment Method</label>
                                      </div>
                                      <div class="col-sm-6">
                                          <select class="form-control" name="payment_method" id="payment_method">
                                            <optgroup label="Cash and Banks">
                                            <?php
                                         try{
                                             $bank_qry="select * from `chartofaccount` where (`account_type`=:type1 or `account_type`=:type2) and  `owner_mobile`=:owner_mobile and `status`=:status ";
                                             $banks=$db->prepare($bank_qry);

                                             $owner_mobile=$_SESSION['sess_bp_username'];
                                             $banks->execute(['type1'=>'Cash','type2'=>'Bank','owner_mobile'=>$owner_mobile, 'status'=>'Published']);

                                             while($bank=$banks->fetch())
                                             {
                                               ?>
                                                 <option value="<?=$bank['id']?>"><?=$bank['account_head']?></option>
                                               <?php
                                             }
                                           }  catch (Exception $e) {
                                                 echo $e->getMessage();
                                             }
                                             ?>
                                           </optgroup>
                                             <optgroup label="Suppliers, customers and employees">
                                             <?php
                                             $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='customer' and (`status`='published' or `status`='Published')";

                                             $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');

                                             foreach ($db->query($contacts_query) as $row)
                                             {
                                               $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                              ?>
                                             <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                             <?php
                                               }

                                              ?>
                                              </optgroup>
                                            </select>
                                      </div>
                                    </div>

                                    <div class="row p-t-20">
                                      <div class="col-sm-6">
                                        <label for="description">Description</label>
                                      </div>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="description" id="description" placeholder="paid x amount for ...">
                                      </div>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" id="submit_expense_btn">Submit</button>
                                    </div>
                                  </form>
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
                                                  $products_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='published' order by `name` ";
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
                                                  data-item-cost="<?=$row['purchase_cost']?>"
                                                  data-item-unit="<?=$row['measuring_unit']?>"
                                                  data-variants-json='<?php echo implode('--,--',$variants_data_array);?>'
                                                  data-variants="<?=$row['variants']?>"
                                                  data-unit="<?=$row['measuring_unit']?>"
                                                  data-variant_count="<?php echo $variants_count?>"
                                                  data-secondary_units_count="<?=$row['secondary_unit_count']?>"
                                                  data-secondary-units-json='<?=$row['secondary_units']?>'
                                                  data-tax-rate="<?php if(strtolower_gfs($row['tax'])==strtolower_gfs('Exempted')){echo 0;}elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard GST')){ echo $_SESSION['sess_bp_gst']; }elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard VAT')){ echo $_SESSION['sess_bp_vat']; }else{ echo '0';}?>">
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
                                    <form class="form-horizontal" id="" action="" method="post">
                                      <input type="hidden" id="btn_name_holder" name="" value="">
                                      <div class="row">


                                      <div class="col-md-6">
                                        <label for="name">Activity Name </label>

                                        <div class="input-group">
                                            <input type="hidden" name="job_id" class="form-control" id="job_id" value="<?=$_GET['job_id']?>" >
                                            <input type="text" name="name" class="form-control" id="name" >
                                        </div>
                                      </div>



                                      <div class="col-md-6">
                                        <label for="date">Date </label>

                                        <div class="input-group">
                                            <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-12 block12">
                                        <h2>Raw Material (Input Items)</h2>
                                          <table class="table table-bordered full-color-table hover-table" id="input_cartitems">
                                            <thead>
                                            <tr>
                                              <th class="sr hide">#</th>
                                              <th class="name">Product Name</th>
                                              <th class="unit">Measuring Unit</th>
                                              <th class="qty">Qty</th>
                                              <th class="cost">Unit Cost</th>
                                              <th class="total">Total</th>
                                              <th class="status"></th>
                                            </tr>
                                          </thead>
                                          <tbody class="cart_items">

                                          </tbody>
                                          </table>
                                          <a href="#" id="input_cartitems_btn" class="add_items_btn btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to List</a>

                                      </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-6">
                                          <h5>Raw Material Total cost</h5>
                                        </div>
                                        <div class="col-6">
                                          <input type="number" class="form-control" id="input_items_total" readonly name="input_items_total" value="0">
                                        </div>
                                      </div>

                                    <div class="row">
                                      <div class="col-12">
                                        <table class="table table-bordered full-color-table hover-table" id="expense_cartitems">
                                          <thead>
                                          <tr>
                                            <th class="Type">Expense Type</th>
                                            <th class="Payment Method">Payment Method</th>
                                            <th class="Description">Description</th>
                                            <th class="Cost">Cost</th>
                                            <th class="status"></th>
                                          </tr>
                                        </thead>
                                        <tbody class="cart_items">

                                        </tbody>
                                        </table>
                                        <a href="#" id="expense_modal" class="expense_modal_btn btn btn-sm btn-primary" data-toggle="modal" data-target="#expense_modal">Add Items to List</a>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <h5>Expense Total cost</h5>
                                      </div>
                                      <div class="col-6">
                                        <input type="number" class="form-control" readonly id="total_expense" name="expense_total" value="0">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <h3>Input Total Value (Raw Material + Expense)</h3>
                                      </div>
                                      <div class="col-6">
                                        <input type="number" class="form-control" readonly name="input_total" id="total_input" value="0">
                                      </div>
                                    </div>


                                    <div class="row">
                                      <div class="col-md-12 block12">
                                        <h2>Finished Goods (Output Items)</h2>
                                          <table class="table table-bordered full-color-table hover-table" id="output_cartitems">
                                            <thead>
                                            <tr>
                                              <th class="sr hide">#</th>
                                              <th class="name">Product Name</th>
                                              <th class="unit">Measuring Unit</th>
                                              <th class="qty">Qty</th>
                                              <th class="cost">Unit Cost</th>
                                              <th class="total">Total</th>
                                              <th class="status"></th>
                                            </tr>
                                          </thead>
                                          <tbody class="cart_items">

                                          </tbody>
                                          </table>
                                          <a href="#" id="output_cartitems_btn" class="add_items_btn btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to List</a>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <h3>Finished Items Total Value</h3>
                                      </div>
                                      <div class="col-6">
                                        <input type="number" class="form-control" readonly name="output_items_total" id="total_item_output" value="0">
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
                                      <div class="row">
                                        <div class="col-12">
                                          <div id="msgholder" class="alert alert-danger d-none"></div>
                                        </div>
                                      </div>
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

          function update_cart_total(cart_id)
          {
            var this_cart_total = 0;

            $("#"+cart_id+ " tbody tr").each(function(){
              var this_row_id = $(this).attr('id');
              var this_qty = $('#'+this_row_id + " .item_qty").val();
              var this_cost = $('#'+this_row_id + " .item_cost").val();
              var this_total = parseFloat(this_qty)*parseFloat(this_cost);
              this_cart_total = this_cart_total + this_total;

              this_total = this_total.toFixed(2);
              $('#'+this_row_id + '  .item_total').val(this_total);

            });
            this_cart_total =  parseFloat(this_cart_total).toFixed(2);
            return this_cart_total;
          }

          function update_expense_total()
          {
            var total_expense = 0;
            $("#expense_cartitems tbody tr").each(function(index){
              $(this).addClass('row_'+index);
              var this_expense = $(".row_"+index+" .expense_amount").val();
              this_expense = parseFloat(this_expense);
              total_expense = total_expense + this_expense;
            });
            return total_expense;
          }

          function get_expense_json()
          {
            var full_json = '[';


            $("#expense_cartitems tbody tr").each(function(index){
              $(this).addClass('row_'+index);

              var this_expense_amount = $(".row_"+index+" .expense_amount").val();
              var this_expense_type = $(".row_"+index+" .type").html();
              var expense_payment_account = $(".row_"+index+" .expense_payment_account").val();
              var this_expense_des = $(".row_"+index+" .des").html();
              var this_expense_type = $(".row_"+index+" .type").html();

              full_json+='{"this_expense_amount":"'+this_expense_amount+'","this_expense_type":"'+this_expense_type+'","expense_payment_account":"'+expense_payment_account+'","this_expense_des":"'+this_expense_des+'","this_expense_type":"'+this_expense_type+'"},';
            });

            full_json = full_json.slice(0,-1);
            full_json+=']';
//            console.log(full_json);
            return full_json;
          }

          function get_cart_json(cart_id)
          {
            var full_json = '[';

            $("#"+cart_id+ " tbody tr").each(function(index){
              var item_id = $(this).attr('data-item_id');
              var item_qty = $('#'+cart_id+ ' #row_'+item_id+ ' .item_qty').val();
              var item_rate = $('#'+cart_id+ ' #row_'+item_id+' .item_rate').val();
              var item_total = parseFloat(item_qty)*parseFloat(item_rate);

              var item_variants_json = '[';

              $("#"+cart_id+ " tbody #row_"+item_id+" .variants_cart li").each(function(index){
                var this_variant_id = $(this).attr('data-variant');
                var this_variant_qty = $("#"+cart_id+ " tbody #row_"+item_id+" #item_variant_"+this_variant_id+" input").val();
                item_variants_json+='{"variant_id":"'+this_variant_id+'","qty":"'+this_variant_qty+'"},';
              });

              item_variants_json = item_variants_json.slice(0,-1);
              item_variants_json+= ']';

//                item_variants_json = item_variants_json.replace('"','&#34;');
                item_variants_json = item_variants_json.replace(/"/g, "&#34;");
              full_json+='{"item_id":"'+item_id+'","item_qty":"'+item_qty+'","item_rate":"'+item_rate+'","item_total":"'+item_total+'","variants_json":"'+item_variants_json+'"},';
            });


            full_json = full_json.slice(0,-1);
            full_json+=']';
//            console.log(full_json);
            return full_json;
          }

          function remove_item(row_id){
              $('#row_'+row_id).remove();
              update_total();
          }

          function update_item_total(item_id)
          {
            update_total();
          }

          function update_total()
          {
            var total_expense = update_expense_total();
            var total_item_input = update_cart_total('input_cartitems');
            var total_item_output = update_cart_total('output_cartitems');
            var total_input = parseFloat(total_expense)+parseFloat(total_item_input);
            total_input = total_input.toFixed(2);

            $('#input_items_total').val(total_item_input);
            $('#total_expense').val(total_expense);
            $('#total_input').val(total_input);
            $('#total_item_output').val(total_item_output);
          }

          function update_variant_qty(item_id,active_table_id)
          {
            var total_qty = 0;
            var this_qty = 0;
            $('#'+active_table_id+' #row_'+item_id + ' input.item_variant_qty').each(function(){
              this_qty = $(this).val();
              total_qty = parseFloat(this_qty) + total_qty;

            });

            $('#'+active_table_id+ ' #item_'+item_id).val(total_qty);
            update_total();
          }

          $(document).on('click','.add_items_btn',function(){
            var this_id = $(this).attr('id');
            this_id = this_id.slice(0,-4);
            $("#btn_name_holder").val(this_id);
          });


          $(document).on('click','.remove_item',function(){
            var this_id = $(this).attr('data-item-id');
            remove_item(this_id);
            update_total();
          });

          $(document).on('change','.expense_amount',function(){
              update_total();
          });

          $(document).on('click','.add_item_to_cart',function(){
              var item_id = $(this).attr('data-item-id');
              var item_name = $(this).attr('data-item-name');
              var item_cost = $(this).attr('data-item-cost');
              var item_unit = $(this).attr('data-item-unit');
              var this_unit=$(this).attr('data-unit');
              var item_variants_count=$(this).attr('data-variant_count');
              var item_variants_json=$(this).attr('data-variants-json');
              var item_secondary_units_count=$(this).attr('data-secondary_units_count');
              var item_secondary_units_json=$(this).attr('data-secondary-units-json');
              var item_total = parseFloat(item_cost);
              var active_cart = $("#btn_name_holder").val();

              var item_row = '<tr id="row_'+item_id+'" data-item_id="'+item_id+'"><td class="hide">'+item_id+'</td><td class="item_name">'+item_name+'</td><td class="unit">'+item_unit+'</td><td class="qty"><input type="number" name="item_'+item_id+'" data-item_id="'+item_id+'" id="item_'+item_id+'" value="1" class="form-control item_qty"  onchange="update_item_total('+item_id+')" /></td><td class="unit_price"><input type="number" class="form-control item_cost item_rate" onchange="update_item_total('+item_id+')" value="'+item_cost+'" /></td><td class="total"><input type="number" readonly class="form-control item_total" value="'+item_total+'"  /></td><td><a style="color:#fff;"  class="btn btn-sm btn-danger remove_item pull-right" title="" data-item-id="'+item_id+'" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td></tr>';
              $("#"+active_cart+' .cart_items').append(item_row);
              $('#product_modal').modal('hide');


              if(item_variants_count>0)
              {
                $('#product_variants_modal .modal-body .row').html('');
                if(item_secondary_units_count==0)
                {

                  $('#product_variants_modal .product_name').html(item_name);
                  $('#product_variants_modal .modal-body .row').html('');
                  $('#product_variants_modal .product_id').val(item_id);

                  var variants_array = item_variants_json.split("--,--");
                  var counter = 1;
                  $.each( variants_array, function( key, value ) {
                    variant_holder = value.split("--:--");


                    var html_content = '<div class="col-lg-4 col-md-6 select_variant" data-variant_id="'+variant_holder[2]+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+variant_holder[0]+'</h3><p><small>Available Stock: '+variant_holder[1]+'</small></p><p><input type="number" name="variant_id_'+variant_holder[2]+'" value="'+counter+'" data-variant-name="'+variant_holder[0]+'" data-qty-before="'+variant_holder[1]+'" class="variant_qty form-control" /></p></div></div></div></div>';
                    counter=0;
                    $('#product_variants_modal .modal-body .row').append(html_content);
                  });
                  $(".submit_variants_btn").prop('id', 'update_variants');

                }else{
                  $('#product_variants_modal .product_name').html(item_name);
                  $('#product_variants_modal .modal-body .row').html('');
                  $('#product_variants_modal .product_id').val(item_id);
                  var variants_array='';

                  variants_array = item_variants_json.split("--,--");
                  var counter = 1;
                  var units = JSON.parse(item_secondary_units_json);

                  $.each( variants_array, function( key, value ) {
                    variant_holder = value.split("--:--");

                    var html_content = '<div class="col-12"><h3 class="box-title">'+variant_holder[0]+'</h3><p><small>Available Stock: '+variant_holder[1]+'</small></p></div>';


                    $.each(units , function(index, unit) {

                      html_content += '<div class="col-lg-4 col-md-6 select_units" data-units="'+unit.secondary_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+unit.secondary_unit+'</h3><p><small>1 '+unit.secondary_unit+'= '+unit.primary_unit_qty+' '+this_unit+'</small></p><p><input type="number" data-variant-id="'+variant_holder[2]+'" data-variant-name="'+variant_holder[0]+'" name="secondary_unit_'+unit.secondary_unit+'" value="'+counter+'" data-qty-before="'+variant_holder[1]+'" data-primary-unit-qty="'+unit.primary_unit_qty+'" class="variant_secondary_unit form-control" /></p></div></div></div></div>';
                      counter=0;

                    });

                    html_content += '<div class="col-lg-4 col-md-6 select_units" data-units="'+this_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+this_unit+'</h3><p><small>1 '+this_unit+'= 1 '+this_unit+'</small></p><p><input type="number" name="secondary_unit_'+this_unit+'" value="'+counter+'" data-variant-id="'+variant_holder[2]+'"  data-variant-name="'+variant_holder[0]+'"  data-qty-before="'+variant_holder[1]+'" data-primary-unit-qty="1" class="variant_secondary_unit form-control" /></p></div></div></div></div>';

              //        html_content += '</div></div></div></div></div>';


                    $('#product_variants_modal .modal-body .row').append(html_content);
                  });

                  $(".submit_variants_btn").prop('id', 'update_variants_with_secondary');
                }

                $('#product_variants_modal').modal('show');
              }

              update_total();
              $('#product_search_box').val('');
          });


          $(document).on( "click", "#product_variants_modal #update_variants_with_secondary", function(e) {
            e.preventDefault();

            var active_cart = $("#btn_name_holder").val();
            var total_qty=0;
            var qty_array = [];
            var secondary_variants_array =[];
            var html_content_vs = '';
            var this_product_id = $('#product_variants_modal .product_id').val();
            $('#item_'+this_product_id+" .variants_cart").html('');


              $('.variant_secondary_unit').each(function(){
                var this_secondary_name = $(this).attr('name');
                var this_secondary_qty = parseFloat($(this).val());
                var this_primary_qty = parseFloat($(this).attr('data-primary-unit-qty'));
                var this_variant_id = parseFloat($(this).attr('data-variant-id'));
                var this_qty_before = parseFloat($(this).attr('data-qty-before'));
                var this_variant_name = $(this).attr('data-variant-name');
                var this_variant_qty = 0;
                var this_qty = (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));
                this_qty = this_qty.toFixed(2);
                this_secondary_name = this_secondary_name.replace('secondary_unit_','');

                if(this_secondary_qty>0)
                {
                  if(secondary_variants_array.hasOwnProperty(this_variant_id)){

                    secondary_variants_array[this_variant_id]['qty']=secondary_variants_array[this_variant_id]['qty']+this_qty;

                  }else{
                    secondary_variants_array[this_variant_id]={'name':this_variant_name, 'qty':this_qty, 'qty_before':this_qty_before};
                  }
                   var this_secondary_data = {'item':this_product_id,'variant_id':this_variant_id,'variant_name':this_variant_name,'secondary_unit':this_secondary_name,'secondary_unit_qty':this_secondary_qty,'primary_unit_qty':this_primary_qty,'this_net_qty':this_qty};
                   qty_array.push(this_secondary_data);

          //        qty_array[this_variant_id][]=(parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));
                  total_qty = parseFloat(total_qty) + (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));

                }
              });
              $('#item_'+this_product_id+' .secondary_cart').html('');

              $.each(secondary_variants_array, function(key, value)
              {
                if(typeof value != "undefined")
                {
          //        $('#item_'+this_product_id+' .variants_cart').append('<li>'+value['name']+'</li>');
                  $("#"+active_cart+' .cart_items #row_'+this_product_id+' .item_name').append('<ul class="variants_cart"><li id="item_variant_'+key+'" data-qty-before="'+value['qty_before']+'" data-variant="'+key+'" class="list-group-item item_variant">'+value['name']+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+value['qty']+'" readonly="readonly"></span></li></ul>');
                }
              });

              $.each( qty_array, function( key, value ) {
                $("#"+active_cart+' .cart_items #row_'+value['item']+' .item_name').append('<ul class="secondary_cart"><li id="item_variant_secondary_'+value['variant_id']+'" class="list-group-item item_variant_secondary_li">'+value['variant_name']+' <span class="this_secondary_qty_span"> '+value['secondary_unit_qty']+' '+value['secondary_unit']+' </span></li></ul>');
              });
              total_qty = total_qty.toFixed(2);
            $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_qty").val(total_qty);
            $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_qty").attr('readonly','readonly');
            update_total();
            $('#product_variants_modal').modal('hide');

          });

          // variants only
          $(document).on( "click", "#product_variants_modal #update_variants", function() {
            var total_qty=0;
            var this_product_id = $('#product_variants_modal .product_id').val();
            $('#item_'+this_product_id+" .variants_cart").html('');
            var active_cart = $("#btn_name_holder").val();
            $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_name").append('<ul class="variants_cart  list-group"></ul>');

            $('.variant_qty').each(function(){
              var this_variant_id = $(this).attr('name');
              var this_variant_name = $(this).attr('data-variant-name');
              var this_variant_qty_before = $(this).attr('data-qty-before');
              var this_variant_qty = $(this).val();
              this_variant_qty = parseFloat(this_variant_qty).toFixed(2);
              this_variant_id = this_variant_id.replace('variant_id_','');

              if(this_variant_qty>0)
              {
                total_qty = parseFloat(total_qty) + parseFloat(this_variant_qty);
                if ( $( "#"+active_cart+"#item_variant_"+this_variant_id ).length ) {
                    // do nothing
                }else{
                  $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_name .variants_cart").append('<li id="item_variant_'+this_variant_id+'"  data-qty-before="'+this_variant_qty_before+'"  data-variant="'+this_variant_id+'" class="list-group-item item_variant">'+this_variant_name+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+this_variant_qty+'" /></span></li>');
                }

              }
            });

            $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_qty").val(total_qty);
            $("#"+active_cart+' .cart_items #row_'+this_product_id+" .item_qty").attr('readonly','readonly');

            update_total();
            $('#product_variants_modal').modal('hide');
            //update_cart_total(contacts_data);

          });


          $(document).on('click','#submit_expense_btn',function(){
            var expense_type = $('#expense_type').val();
            var expense_amount = $('#amount').val();
            var expense_des = $('#description').val();
            var expense_payment_account = $('#payment_method').val();
            var expense_payment_account_name = $('#payment_method option:selected').text();

            var expense_row  = '<tr><td class="type">'+expense_type+'</td><td class="account"><input type="hidden" class="expense_payment_account" value="'+expense_payment_account+'" />'+expense_payment_account_name+'</td><td class="des">'+expense_des+'</td><td class="amount"><input type="number"  class="form-control expense_amount" value="'+expense_amount+'" /></td><td><a style="color:#fff;"  class="btn btn-sm btn-danger remove_expense pull-right" title="" data-item-id="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td></tr>';

            $('#expense_cartitems .cart_items').append(expense_row);
            update_total();
            $('#expense_modal').modal('hide');
          });


          $(document).on('change','input.item_variant_qty',function(){
            var item_id = $(this).closest('tr').attr('data-item_id');
            var active_table_id = $(this).closest('table').attr('id');
            update_variant_qty(item_id,active_table_id);
            update_total();
            });

          $(document).on('click','#submitbtn',function(e){
            e.preventDefault();
            $('.preloader').show();
            update_total();

            var job_id = $('#job_id').val();
            var activity_name = $('#name').val();
            var notes = $('#notes').val();
            var date = $('#datepicker-autoclose').val();
            var total_item_input = $('#input_items_total').val();
            var total_expense = $('#total_expense').val();
            var total_input = $('#total_input').val();
            var total_item_output = $('#total_item_output').val();

            var input_cartitems = get_cart_json('input_cartitems');
            var expense_cartitems = get_expense_json();
            var output_cartitems = get_cart_json('output_cartitems');

//            alert(input_cartitems);

            var form_data = {job_id: job_id, notes: notes, activity_name: activity_name, date: date, total_item_input: total_item_input, total_expense: total_expense, total_input: total_input, total_item_output: total_item_output, input_cartitems: input_cartitems, expense_cartitems: expense_cartitems, output_cartitems: output_cartitems};

//            console.log(form_data);
            var post_url = 'va-jobs-new-activity.process.php';

            var jqxhr = $.post( post_url, form_data)
              .done(function(msg) {
//                console.log(msg);
                if(isValidJSONString(msg))
                {
                  var response = jQuery.parseJSON( msg );
                  if(response.code == 200){

                      swal({
                         title: 'Submited!',
                         text: 'Record has been added successfully.',
                         timer: 3000,
                         type: 'success',
                         showConfirmButton: false
                      });
                      window.location.href='va-jobs.php';


                  }else{
                      $("#msgholder").html(response.msg);
                      $("#msgholder").removeClass('d-none');
                      $('.preloader').hide();
                  }

                }else{
                  alert('not valid response');
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

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
