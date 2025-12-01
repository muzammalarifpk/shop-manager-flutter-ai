<?php
  require_once("t-sale-tax.config.php");
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


                  <div id="contact_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title">Add New Contact</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">

                                <div id="add_new_customer">
                                    <div class="row">
                                      <div class="card">
                                        <div class="card-body">
                                          <form class="" name="add_new_customer_form" id="add_new_customer_form" action="" method="post">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="name"> Contact Name: <span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control" required="" id="name" name="name" aria-required="true">
                                                </div>
                                                </div>
                                              <div class="col-md-3 hide">
                                                <div class="form-group">
                                                  <label for="type"> Type: <span class="text-danger">*</span> </label>

                                                    <select class="custom-select form-control required " id="type" name="type" aria-required="true">
                                                      <option value="customer" selected>Customer</option>
                                                      <option value="supplier">Supplier</option>
                                                      <option value="employee">Employee</option>
                                                      <option value="agents">Agents</option>
                                                      <option value="other">Other</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-md-3 hide">
                                                  <div class="form-group">
                                                    <label for="status"> Status: <span class="text-danger">*</span> </label>
                                                    <select class="custom-select form-control required " id="status" name="status" aria-required="true">
                                                      <option value="published" selected>Published</option>
                                                      <option value="draft">Draft</option>
                                                      <option value="suspended">Suspended</option>
                                                      <option value="delete">Delete</option>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label for="country_code"> Country Code: <span class="text-danger">*</span> </label>
                                                    <select class="custom-select form-control required " id="country_code" name="country_code" aria-required="true">
                                                      <?php if(isset($_SESSION['location_code']))
                                                      {?>
                                                      <option value="+<?=$_SESSION['location_code']?>">+<?=$_SESSION['location_code']?></option>
                                                    <?php }else{
                                                      for($i=1; $i<1000; $i++){
                                                      ?>
                                                        <option value="<?=$i?>">+<?=$i?></option>
                                                      <?php
                                                    }
                                                    }?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label for="mobile"> Mobile Number: <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" required="" id="mobile" name="mobile" aria-required="true">
                                                  </div>
                                                </div>

                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label for="number"> International Format: </label>
                                                    <input type="text" class="form-control" readonly="" id="number" name="number">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row hide">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="balance_status"> Balance Status: <span class="text-danger">*</span> </label>
                                                    <select class="custom-select form-control required " id="balance_status" name="balance_status" aria-required="true">
                                                      <option selected value="receiveable">Receiveable</option>
                                                      <option value="payable">Payable</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="balance"> Current Balance: </label>
                                                    <input type="number" class="form-control" value="0" id="balance" name="balance">
                                                  </div>
                                                  </div>
                                              </div>
                                              <div class="row hide">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="email"> Email Address: </label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                    <input type="text" class="form-control" id="tags" name="tags">
                                                  </div>
                                                </div>

                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="duedate"> Due Date: </label>
                                                    <input type="date" class="form-control" id="duedate" name="duedate">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row hide">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="notes">Notes :</label>
                                                    <textarea name="notes" id="contact_notes" rows="6" class="form-control"></textarea>
                                                  </div>
                                                </div>
                                              </div>
                                          </form>

                                    </div>
                                  </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success waves-effect waves-light btn_save_contact">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="services_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Services</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                <div id="" class="m-t-20">
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <div class="row el-element-overlay" id="products_holder">
                                          <?php
                                          //  require_once("t-sale-tax.config.php");
                                            $services_query="select * from `services` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='published' order by `name`";
                                            foreach ($db->query($services_query) as $row)
                                            {
                                              ?>
                                              <div class="col-lg-3 col-md-6 add_services_to_cart" id="service_<?=$row['id']?>" data-services-id="<?=$row['id']?>" data-price="<?=$row['sale_price']?>" data-name="<?=$row['name']?>">
                                                <div class="card">
                                                  <div class="el-card-item">
                                                    <div class="el-card-content">
                                                        <h3 class="box-title"><?=$row['name']?></h3>
                                                        <p><?=$_SESSION['sess_bp_currency']?> <?=$row['sale_price']?></p>

                                                        <p><small><?=$row['tags']?></small></p>
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
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="product_variants_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                        <div class="col-sm-3">
                                          <label for="product_search_box">Search Products</label>
                                        </div>
                                        <div class="col-sm-3">
                                          <input type="text" id="product_search_box" class="form-control" name="" value="" placeholder="Search Product">
                                        </div>
                                        <div class="col-sm-6 hide">
                                          <div>
                                            <a class="btn btn-sm btn-success" id="startButton">Start barcode</a>
                                            <a class="btn btn-sm btn-danger" id="resetButton">Stop</a>
                                          </div>

                                          <div>
                                            <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                                          </div>

                                          <div class="hide--">
                                            <div id="sourceSelectPanel" style="display:none">
                                              <label for="sourceSelect">Change video source:</label>
                                              <select id="sourceSelect" style="max-width:400px">
                                              </select>
                                            </div>

                                            <label>Result:</label>
                                            <pre><code id="result"></code></pre>
                                          </div>
                                        </div>
                                      </div>

                                      <div id="" class="m-t-20">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="row el-element-overlay" id="products_holder">
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
                                                  rel="<?=strtolower_gfs($row['name'])?> <?=strtolower_gfs($row['tags'])?>"
                                                  data-tax-type="<?=$row['tax']?>"
                                                  data-variants-json='<?php echo implode('--,--',$variants_data_array);?>'
                                                  data-variants="<?=$row['variants']?>"
                                                  data-unit="<?=$row['measuring_unit']?>"
                                                  data-barcode="<?=$row['barcode']?>"
                                                  data-variant_count="<?php echo $variants_count?>"
                                                  data-secondary_units_count="<?=$row['secondary_unit_count']?>"
                                                  data-secondary-units-json='<?=$row['secondary_units']?>'
                                                  data-tax-rate="<?php if(strtolower_gfs($row['tax'])==strtolower_gfs('Exempted')){echo 0;}elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard GST')){ echo $_SESSION['sess_bp_gst']; }elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard VAT')){ echo $_SESSION['sess_bp_vat']; }else{ echo '0';}?>">
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
                                        <div class="col-md-6">
                                          <lable for="contact_name">Customer Name</lable>
                                          <select class="form-control select2" name="contact_name" id="contact_name">
                                            <option value="+0000">Walkin Customer</option>
                                            <?php
                                            $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='customer' and (`status`='published' or `status`='Published')";

                                            $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');

                                            foreach ($db->query($contacts_query) as $row)
                                            {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                              $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                             ?>
                                            <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                            <?php
                                              }

                                             ?>
                                          </select>
                                          <?php
                                            $json_contacts=json_encode_gfs($contacts_data,true);
                                           ?>
                                           <script type="text/javascript">
                                             var contacts_data=<?=$json_contacts?>;
                                           </script>
                                          <br />
                                          <a href="#" id="contact_modal_btn" data-toggle="modal" data-target="#contact_modal" class="btn btn-xs btn-link">Add New Customer</a>
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
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                              <tr>
                                                <th class="sr hide">#</th>
                                                <th class="name">Product Name</th>
                                                <th class="tax_td  <?php if($_SESSION['sess_bp_tax']!=='on'){ echo ' hide';} ?>">Tax</th>
                                                <th class="unit_price" width="20%">Unit Price</th>
                                                <th class="unit" width="20%">Unit</th>
                                                <th class="qty" width="20%">Qty</th>
                                                <th class="total">Total</th>
                                              </tr>
                                            </thead>
                                            <tbody id="cart_items">

                                            </tbody>
                                            </table>

                                            <table class="table hide table-bordered full-color-table hover-table" id="services_in_cart">
                                              <thead>
                                                <tr>
                                                  <th>Service Name</th>
                                                  <th>Unit Price</th>
                                                  <th>Qty</th>
                                                  <th>Total</th>
                                                </tr>
                                              </thead>
                                              <tbody id="services_cart_items">

                                              </tbody>
                                            </table>

                                            <a href="#" id="product_modal_btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to Bill</a>

                                            <a href="#" id="services_modal_btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#services_modal">Add Services to Bill</a>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="sub_total">Sub Total</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" readonly name="sub_total" id="sub_total" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="discount">Discount</label>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="input-group">
                                              <input type="number" class="form-control"  name="discount_percentage" id="discount_percentage" placeholder="Discount in Percentage" aria-describedby="discount_percentage_addon">
                                              <span class="input-group-addon" id="discount_percentage_addon">%</span>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <input type="number" class="form-control" name="discount" id="discount" value="0">
                                        </div>
                                      </div>
                                      <?php if($_SESSION['sess_bp_tax']!=='on')
                                        { ?>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <label for="tax">Tax</label>
                                          </div>
                                          <div class="col-sm-6">
                                            <input type="number" class="form-control" readonly name="tax" id="tax" value="0">
                                          </div>
                                        </div>
                                        <?php
                                          }
                                      ?>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="grand_total">Grand Total</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text"  class="form-control" readonly name="grand_total" id="grand_total" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="amount_paid">Amount Received</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="number" class="form-control" name="amount_paid" id="amount_paid" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="payment_method">Payment Method</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="payment_method" id="payment_method">
                                              <?php
                                            try{
                                               $bank_qry="select * from `chartofaccount` where (`account_type`=:type1 or `account_type`=:type2) and  `owner_mobile`=:owner_mobile";
                                               $banks=$db->prepare($bank_qry);

                                               $owner_mobile=$_SESSION['sess_bp_username'];
                                               $banks->execute(['type1'=>'Cash','type2'=>'Bank','owner_mobile'=>$owner_mobile]);

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
                                            </select>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="remaining_balance">Remaining Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="number"  class="form-control" readonly name="remaining_balance" id="remaining_balance" value="0">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="old_balance">Old Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <span id="old_balance_val"></span>
                                          <span id="old_balance_status"></span>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="new_balance">New Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <span id="new_balance_val"></span>
                                          <span id="new_balance_status"></span>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="notes">Notes</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <textarea name="notes" class="form-control" rows="5" id="notes" placeholder="Some notes about this sale." ></textarea>
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
          var this_module = 'sale';
          var post_url = 't-sale-tax-new.php';
          var invoice_url = 'h-sale-invoice.php?id=';
          var currency = '<?=$_SESSION['sess_bp_currency']?>';
          function check_empty(str)
          {
            if(str.length === 0)
            {
              return true;
            }else{
              return false;
            }
          }
            function save_contact(contacts_data){
              var contact_name = $("#name").val();
              var country_code = $("#country_code").val();
              var mobile_number = $("#mobile").val();
              var number = $("#number").val();
              console.log(contacts_data);
              if(check_empty(contact_name))
              {
                alert('You must write name of customer.');
                $("#name").focus();
                $('#name').addClass('form-control-danger');
                return false;
              }
              else if(check_empty(mobile_number))
              {
                alert('You must type customer mobile number.');
                $("#mobile").focus();
                $('#mobile').addClass('form-control-danger');
                return false;
              }else if(check_empty(country_code))
              {
                alert('You must select country code.');
                $('#country_code').addClass('form-control-danger');
                return false;
              }else{
                var formdata= $('#add_new_customer_form').serialize();
                $('.preloader').show();
//                contacts_data.push('"+92-341234124":{"balance":"0","status":"debit"}');
                contacts_data[number]={balance: "0", status: "debit"};
                $.post( "su-contacts-new-process.php", formdata)
                  .done(function( data ) {
                    console.log(data);

                      if(data=='success')
                      {
                        $('#contact_name').append('<option value="'+number+'" selected>'+contact_name+' ('+number+')</option>');
  //                      contacts_data.push('"'+number+'":{"balance":"0","status":"debit"}');

                        swal({
                          title: 'Success!',
                          text: 'Contact has been saved successfully.',
                          timer: 2000,
                          type: 'success',
                          showConfirmButton: false
                        });
                        $("#contact_modal").modal("hide");
                        $('.preloader').hide();
                      }else{
                        swal({
                          title: 'Error!',
                          text: 'Record not saved.',
                          timer: 2000,
                          type: 'danger',
                          showConfirmButton: false
                        });
                        alert("Erorr while updating. Please contact support with screenshot. " + data);
                        $('.preloader').hide();

                      }

                  })
                  .fail(
                    function (jqXHR, textStatus, errorThrown) {
                      console.log('jqXHR:');
                      console.log(jqXHR);
                      console.log('textStatus = ' + textStatus);
                      console.log('errorThrown = ' + errorThrown);
                      swal({
                         title: 'Failed!',
                         text: 'These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support. <ul><li>'+ jqXHR +'</li> <li>'+textStatus+'</li></ul>',
                         timer: 2000,
                         type: 'danger',
                         showConfirmButton: false
                      });
                      setTimeout(function(){ window.location.reload(); }, 5000);
                    });

              }
            }

          $(document).on('click','.btn_save_contact',function(e){
            e.preventDefault();
            save_contact(contacts_data);
          });

        </script>
        <script type="text/javascript" src="js/invoice.js"></script>
        <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
        <script type="text/javascript">
          window.addEventListener('load', function () {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserMultiFormatReader()
            console.log('ZXing code reader initialized')
            codeReader.getVideoInputDevices()
              .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                  videoInputDevices.forEach((element) => {
                    const sourceOption = document.createElement('option')
                    sourceOption.text = element.label
                    sourceOption.value = element.deviceId
                    sourceSelect.appendChild(sourceOption)
                  })

                  sourceSelect.onchange = () => {
                    selectedDeviceId = sourceSelect.value;
                  };

                  const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                  sourceSelectPanel.style.display = 'block'
                }

                document.getElementById('startButton').addEventListener('click', () => {
                  codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                    if (result) {
                      console.log(result);
                    //  alert(result);
                      var this_barcode_item=$("div[data-barcode="+result+"]").trigger('click');
                      codeReader.reset();

                    }
                    if (err && !(err instanceof ZXing.NotFoundException)) {
                      console.error(err)
                      document.getElementById('result').textContent = err
                    }
                  })
                  console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                })

                document.getElementById('resetButton').addEventListener('click', () => {
                  codeReader.reset()
                  document.getElementById('result').textContent = '';
                  console.log('Reset.')
                })

              })
              .catch((err) => {
                console.error(err)
              })
          });
        </script>

    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
