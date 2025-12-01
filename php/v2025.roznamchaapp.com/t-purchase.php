<?php
  require_once("t-purchase-tax.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
  $_SESSION['sess_bp_token'] = get_random(32);
  $default_size_template=gnr($db,'users','number',$_SESSION['sess_bp_username'],'print_default_template');
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
if($_SESSION['sess_bp_print_urdu_invoice']=='off')
{
  ?>
  .ur_lang{ display: none; }
  <?php
}
if($_SESSION['sess_bp_print_header']=='off')
{
  ?>
  #invoice_print_header{ display: none; }
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


                  <div id="contact_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title">Add New Contact</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">

                                <div id="">
                                    <div class="row">
                                      <div class="card">
                                        <div class="card-body">
                                      <form action="" class="form-horizontal">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="country_code"> Country Code: <span class="text-danger">*</span> </label>
                                            <select class="custom-select form-control required " id="country_code" name="country_code" aria-required="true">
                                              <option value="">Select Country Code</option><option value="+1">+1</option>
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
                                            <input type="number" class="form-control" readonly="" id="number" name="number">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <label for="name">Name</label>
                                          <input type="text" name="name" value="" class="form-control" >
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <label for="notes">Notes</label>
                                          <textarea name="name" rows="3" cols="80" class="form-control"></textarea>
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
                                  <button type="button" class="btn btn-success waves-effect waves-light">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div id="invoice_response_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="invoice_response_modal" aria-hidden="true" style="">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Invoice ID <span class="invoice_id">N/A</span></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row  el-element-overlay">

                                        <div id="invoice_printable_area">
                                          <style media="all">
                                            @page {
                                                margin: 0.5cm;
                                              }
                                            .invoice_body{
                                              margin: 10px;
                                              border: 0px sold #ccc;
                                              line-height: 1;
                                            }
                                            .invoice_body ul, .invoice_body ol, .invoice_body li{list-style: none; }
                                            .invoice_body li::before{ content: "-";}
                                            .print_logo{
                                              max-width: 150pt;
                                              max-height: 100pt;
                                              float: right;
                                            }
                                            .print_row{
                                              display: block;
                                            }
                                            .print_half{
                                              width:49.9%;
                                              float: left;
                                              display: inline-block;
                                            }
                                            .print_half:last-child{
                                              text-align: right;
                                            }
                                            .print_clearfix{
                                              clear: both;
                                            }
                                            .invoice_body h1{
                                              font-size: 24px;
                                              line-height: 1;
                                            }
                                            .invoice_body h2{
                                              font-size: 18px;
                                              line-height: 1;
                                            }
                                            .invoice_body h3{
                                              font-size: 18px;
                                              line-height: 1;
                                              font-weight: 600 !important;
                                            }
                                            .invoice_body h3 span{
                                              font-weight: 600 !important;

                                            }
                                            .print_center{
                                              text-align: center;
                                            }
                                            .print_pull_right{
                                              float: right;
                                              text-align: right;
                                              display: inline-block;
                                            }
                                            .print_inverse{
                                              background: rgba(0, 0, 0, 0.7);
                                              padding: 1px;
                                              color: #fff;
                                              -webkit-print-color-adjust: exact;
                                            }
                                            .print_table{
                                              display: table;
                                              border-collapse: collapse;
                                              width:100%;
                                              margin-top: 2px;
                                              margin-bottom: 2px;
                                              border: 1px solid #999;
                                              -webkit-print-color-adjust: exact !important;

                                            }
                                            .print_table th, .print_table td{
                                              border: 1px solid #999;
                                              font-size: 24px;

                                            }
                                            .print_number{
                                              text-align: right;
                                            }
                                            .print_footer{
                                              margin-top: 3px;
                                            }

                                            .align_center{
                                              text-align: center;
                                            }
                                            <?php
                                              if($_SESSION['sess_bp_print_default_template']=='Thermal_80mm')
                                              {
                                                ?>
                                                #invoice_printable_area{
                                                  width: 320px;
                                                  margin: 0;
                                                }


                                                .print_inverse{
                                                  background: rgba(0, 0, 0, 1);
                                                  color: #fff;
                                                  padding: 1px;
                                                  -webkit-print-color-adjust: exact;
                                                }

                                                .print_logo{
                                                  max-width: 100pt;
                                                  max-height: 70pt;
                                                }

                                                .invoice_body h1{
                                                  font-size: 20px !important;
                                                  font-weight: bold !important;
                                                }

                                                .invoice_body h2{
                                                  font-size: 14px;
                                                  font-weight: 900 !important;
                                                }
                                                .invoice_body h3{
                                                  font-size: 14px;
                                                  font-weight: bold !important;
                                                }
                                                .print_table{
                                                  margin: 5px 0;
                                                }

                                                .print_table th, .print_table td{
                                                  font-size: 14px;
                                                  font-weight: bold !important;
                                                  font-family: "Times New Roman", Times, serif;


                                                }
                                                <?php
                                              }
                                             ?>

                                          </style>
                                        <div id="print_size" class="print_size_<?=$default_size_template?>">
                                            <div class="invoice_body" >
                                            <div class="print_row">
                                              <p class="print_center"><?=$_SESSION['sess_bp_print_header_note']?></p>
                                            </div>
                                            <div class="print_row" id="invoice_print_header">
                                              <div class="print_half">
                                                <h1 class="print_name"><?=$_SESSION['sess_bp_name']?></h1>
                                                <h2 class="print_address"><i class="mdi mdi-map-marker"></i><?=$_SESSION['sess_bp_adr']?></h2>
                                                <h2 class="print_phone"><i class="mdi mdi-phone"></i><?=$_SESSION['sess_bp_username']?></h2>
                                              </div>
                                              <div class="print_half">
                                                <img src="<?=$_SESSION['sess_bp_logo']?>" alt="Logo" class="print_logo" />
                                              </div>
                                              <div class="print_clearfix"></div>
                                            </div>
                                            <div class="print_row">
                                              <h1 class="print_center"><span id="sale_invoice_label">Purchase Invoice</span> <span class="ur_lang">فروخت کا بل</span></h1>
                                            </div>
                                            <div class="print_row">
                                              <div class="print_half">
                                                <h2>To:</h2>
                                                <h3><span class="print_customer_name">N/A</span></h3>
                                                <h3><i class="mdi mdi-phone"></i><span class="print_customer_phone">N/A</span></h3>
                                              </div>
                                              <div class="print_half">
                                                <h2>&nbsp;</h2>
                                                <h3 class="">Invoice ID: <span class="print_invoice_no print_pull_right">N/A</span></h3>
                                                <h3 class="">Date: <span class="print_invoice_date print_pull_right">N/A</span></h3>
                                              </div>
                                              <div class="print_clearfix"></div>
                                            </div>
                                            <div class="print_row">
                                              <p>&nbsp;</p>
                                            </div>
                                            <div class="print_row">
                                              <table class="print_table" id="print_products">
                                                <thead class="print_inverse">
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Item Name <span class="ur_lang">مصنوعات</span></th>
                                                    <th>Qty <span class="ur_lang">مقدار</span></th>
                                                    <th class="tax_td   <?php if($_SESSION['sess_bp_tax']!=='on'){ echo ' hide';} ?>">Tax</th>
                                                    <th>Unit <span class="ur_lang">پیمائش</span></th>
                                                    <th>Rate <span class="ur_lang">اکائی قیمت</span></th>
                                                    <th>Total <span class="ur_lang">کل</span></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php for($i=1; $i<=5;$i++)
                                                  { ?>
                                                  <tr>
                                                    <td><?=$i?></td>
                                                    <td>Sample item <?=$i?></td>
                                                    <td class="print_number">100.00</td>
                                                    <td class="print_number">0.00%</td>
                                                    <td>Pcs</td>
                                                    <td class="print_number">0.00</td>
                                                    <td class="print_number">0.00</td>
                                                  </tr>
                                                <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                  <tr>
                                                    <th colspan="2" class="print_number">Total Qty</th>
                                                    <th class="print_number" id="print_items_total_qty">0.00</th>
                                                    <th colspan="2" class="print_number">Total</th>
                                                    <th class="tax_td"></th>
                                                    <th class="print_number" id="print_items_total_price">0.00</th>
                                                  </tr>
                                                </tfoot>
                                              </table>

                                              <table id="print_services" class="print_table">
                                                <thead class="print_inverse">
                                                  <th>#</th>
                                                  <th>Service Name <span class="ur_lang">سروس کا نام</span></th>
                                                  <th>Unit Price <span class="ur_lang">اکائی قیمت</span></th>
                                                  <th>Qty <span class="ur_lang">مقدار</span></th>
                                                  <th>Total <span class="ur_lang">کل</span></th>
                                                </thead>
                                                <tbody>
                                                  <?php for($i=1;$i<=5;$i++){
                                                    ?>
                                                      <tr>
                                                        <td><?=$i?></td>
                                                        <td>Sample Service <?=$i?></td>
                                                        <td class="print_number">0.00</td>
                                                        <td class="print_number">0.00</td>
                                                        <td class="print_number">0.00</td>
                                                      </tr>
                                                    <?php
                                                  } ?>
                                                </tbody>
                                                <tfoot>
                                                  <th colspan="3" class="print_number">Total</th>
                                                  <th class="print_number" id="services_total_qty">0.00</th>
                                                  <th class="print_number" id="services_total_price">0.00</th>
                                                </tfoot>

                                              </table>

                                            </div>

                                            <div class="print_row">
                                              <p>&nbsp;</p>
                                              <p>&nbsp;</p>
                                              <p>&nbsp;</p>
                                            </div>
                                            <div class="print_row" style="margin-top: 5px;">
                                              <div class="print_half">
                                                <p>Notes <span class="ur_lang">نوٹ</span></p>
                                                <p id="print_notes"></p>
                                                <p>&nbsp;</p>
                                                <p>&nbsp;</p>
                                                <p>&nbsp;</p>


                                                <h3>____________________</h3>
                                                <h3>Authorized Signatory</h3>

                                              </div>
                                              <div class="print_half">
                                                <h3>Sub Total: <span class="ur_lang">ذیلی کل</span><span class="print_pull_right" id="print_sub_total">0.00</span></h3>
                                                <h3>Discount: <span class="ur_lang">کم</span><span class="print_pull_right" id="print_discount">0.00</span></h3>
                                                <h3 class="tax_td">Tax: <span class="print_pull_right" id="print_tax">0.00</span></h3>
                                                <h2 class="print_inverse">Grand Total: <span class="ur_lang">مجموعی عدد</span><span id="print_grand_total" class="print_pull_right">0.00</span><span class="print_pull_right"><?=$_SESSION['sess_bp_currency']?>&nbsp; </span></h2>
                                                <h3>Pay Method: <span class="ur_lang">ادائیگی کا طریقہ</span><span class="print_pull_right" id="print_payment_method">N/A</span></h3>
                                                <h3>Paid: <span class="ur_lang">رقم موصول ہوئی</span><span class="print_pull_right" id="print_amount_recieived">0.00</span></h3>
                                                <h3>Due Amount: <span class="ur_lang">بقایا رقم</span><span class="print_pull_right" id="print_invoice_balance">0.00</span></h3>
                                                <hr>
                                                <h3>Old Bal: <span class="ur_lang">پرانی رقم</span><span class="print_pull_right" id="print_old_balance">0.00</span></h3>
                                                <h3>New Bal: <span class="ur_lang">نئی باقی رقم</span><span class="print_pull_right" id="print_total_balance">0.00</span></h3>
                                              </div>
                                              <div class="print_clearfix"></div>
                                            </div>
                                            <div class="print_row">
                                            <p>&nbsp;</p>
                                              <?php if($_SESSION['sess_bp_print_default_template']!=='Thermal_80mm')
                                              {
                                                ?>
                                                <p>&nbsp;</p>
                                            <?php } ?>
                                            </div>

                                          <div class="print_row print_footer" style="margin-top: 0px;">
                                          <br><br>    <p class="print_center"><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                            </div>
                                            <div class="print_row hide">
                                              <div class="print_center"><p class="print_center">Software Provided By www.RoznamchaApp.com</p></div>
                                              <div class="print_center"><p class="print_center">+92-343-4123489</p></div>
                                            </div>
                                          </div>
                                        </div>
                                        </div>


                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="dashboard.php" class="btn btn-info waves-effect waves-light pull-left ">Home Page</a>
                                    <a type="button" class="btn btn-warning waves-effect waves-light pull-left invoice_link" href="h-sale.php" target="_blank" accesskey="v"><u>V</u>iew Invoice</a>
                                    <a type="button" target="_blank" class="btn btn-success waves-effect waves-light pull-left whatsapp_link" href="#whatsapp">WhatsApp</a>

                                    <a type="button" class="btn btn-inverse waves-effect waves-light pull-left sms_summary" href="#sms_summary">SMS Summary</a>
                                    <a type="button" class="btn btn-inverse waves-effect waves-light pull-left sms_details" href="#sms_details">SMS Details</a>
                                    <button type="button" id="print_printable" class="btn btn-info waves-effect waves-light pull-right print_printable">Print</button>
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                  </div>
                              </div>
                          </div>
                        </div>

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
                                      <button type="button" id="update_variants" class="btn btn-success waves-effect waves-light pull-right  submit_variants_btn">Submit</button>
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

                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_<?=$row['id']?>_<?=$row['name']?>_<?=$row['purchase_cost']?>_<?=$row['available_stock']?>_<?=$row['purchase_cost']?>_<?=$row['measuring_unit']?>"
                                                  rel="<?=strtolower_gfs($row['name'])?> <?=$row['tags']?> <?=$row['barcode']?>"
                                                  data-tax-type="<?=$row['tax']?>"
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
                                                        <p><small><?=$row['barcode']?></small></p>
                                                        <p><?=$_SESSION['sess_bp_currency']?> <?=$row['purchase_cost']?></p>
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
                                    <h2 class="hide">Add New Purchase</h2>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-6">
                                          <lable for="contact_name">Supplier Name</lable>
                                          <select class="form-control select2" name="contact_name" id="contact_name">
                                            <option value="+0000">Walkin Supplier</option>
                                            <optgroup label="Customers">

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
                                           </optgroup>
                                           <optgroup label="Suppliers">
                                             <?php
                                             $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='supplier' and (`status`='published' or `status`='Published')";

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
                                           </optgroup>
                                           <optgroup label="Employees">
                                             <?php
                                             $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='employee' and (`status`='published' or `status`='Published')";

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
                                           </optgroup>
                                           <optgroup label="Agents">
                                             <?php
                                             $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='agents' and (`status`='published' or `status`='Published')";

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
                                           </optgroup>
                                           <optgroup label="Other">
                                             <?php
                                             $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='other' and (`status`='published' or `status`='Published')";

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
                                           </optgroup>
                                          </select>

                                          <?php
                                            $json_contacts=json_encode_gfs($contacts_data,true);
                                           ?>
                                           <script type="text/javascript">
                                           <?php
                                           if(isset($_GET['c']))
                                           {
                                             ?>
                                             $('#contact_name').val('<?=substr($_GET['c'],1)?>');
                                             <?php } ?>

                                             var contacts_data=<?=$json_contacts?>;
                                           </script>
                                          <br />
                                          <a href="#" id="contact_modal_btn" data-toggle="modal" data-target="#contact_modal" class="hide btn btn-sm btn-primary">Add New Customer</a>
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
                                            <a href="#" id="product_modal_btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to Bill</a>
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
                                           <input type="text" class="form-control" readonly name="tax" id="tax" value="0">
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
                                          <label for="amount_paid">Amount Paid</label>
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
                                            <select class="form-control select2" name="payment_method" id="payment_method">
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
                                          <input type="text"  class="form-control" readonly name="remaining_balance" id="remaining_balance" value="0">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="stock_location">Stock Location</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <select class="form-control select2" name="location_id" id="location_id">
                                            <option value="">Shop</option>
                                            <?php
                                            $locations_query="select * from `locations` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' order by `name` desc ";

                                            foreach ($db->query($locations_query) as $row)
                                            {
                                             ?>
                                             <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                            <?php
                                              }
                                             ?>
                                          </select>
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
                                      <?php
                                      if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                                        if($_SERVER['HTTP_X_REQUESTED_WITH'] == "pk.baseplan.cloudinventorymanagerlearner") {
                                          // echo '<h2>use software from browser to .</h2>';
                                        }
                                      }else{
                                        ?>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <label class="hide" for="Attachment">Attachment</label>
                                            <div class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                <h3 class="text-info"> Attachment</h3>It allows you to upload image as referance for this invoice. Invoice Attachments is a new feature that only work from web browser like Google Chrome, Firefox etc. it will not work in our Android app. <hr />
                                                Please test this feature and give us your valuable feedback.
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div data-action="t-invoice-gallery.process.php?invoice_token=" class="dropzone"></div>
                                          </div>
                                        </div>

                                        <?php
                                      }

                                       ?>


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
          var this_module = 'purchase';
          var post_url = 't-purchase-tax-new.php';
          var invoice_url = 'h-purchase-invoice.php?id=';
          var currency = '<?=$_SESSION['sess_bp_currency']?>';
          var pos_state = true;

          var currency = '<?=$_SESSION['sess_bp_currency']?>';
          var shop_name = '<?=$_SESSION['sess_bp_name']?>';
          var shop_address = '<?=$_SESSION['sess_bp_adr']?>';
          var shop_phone = '<?=$_SESSION['sess_bp_username']?>';


          $(document).on('click','#print_printable',function(e){
            e.preventDefault();
            $('.preloader').show();
  //          alert('sending print.');
            printJS('invoice_printable_area', 'html');
            $('.preloader').hide();
          });

        </script>
        <script type="text/javascript" src="js/invoice.js"></script>

        <script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
        <script type="text/javascript">
        //Disabling autoDiscover
        Dropzone.autoDiscover = false;

        $(function() {
            //Dropzone class
            var myDropzone = new Dropzone(".dropzone", {
                url: "t-invoice-gallery.process.php?type=purchase_invoice_attachment",
                paramName: "file",
                maxFilesize: 3,
                maxFiles: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                init: function()
                {
                  this.on('error', function(file, response) {
                    //console.log(file);
                    //console.log(response);
                      $(file.previewElement).attr('style','border: 2px solid red');
        //                  var this_previewElement =$(file.previewElement).html(); //.find('.dz-error-message').text(message.Message);
        //                  console.log(this_previewElement);
                  });
                  this.on('success', function(file, resp){
                    if(isValidJSONString(resp))
                    {
                      var response = jQuery.parseJSON( resp );
                      if(response.code == 200){
                        $(file.previewElement).attr('style','border: 2px solid green');
        //                        load_images();
        //                        window.location.reload();
                      }else{
                        alert(response.msg);
                      }
                    }else{
                      alert('invalid response: '+resp);
                    }

                  });
                  this.on("complete", function(file)
                  {
        //                    load_images();
                    console.log(file);
                    console.log(status);
                    if (file.size > 3*1024*1024)
                    {
                      this.removeFile(file);
                      alert('file too big');
                      return false;
                    }
                    if(!file.type.match('image.*'))
                    {
                      this.removeFile(file);
                      alert('Not an image')
                      return false;
                    }
                });
              },
            });
        });
        $(document).on('click','#reopen-last-print',function(){
          $('#invoice_response_modal').modal('show');
        });
        </script>    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
