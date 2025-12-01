<?php
  require_once("t-shipping.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
  $_SESSION['sess_bp_token'] = get_random(8);
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
                <div class="hide">
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
                                      /* A4 page CSS */
                                      .invoice_body #A4 {
                                        margin: 10px;
                                        border: 1px sold #ccc;
                                        line-height: 1;
                                      }
                                      .invoice_body #A4  ul, .invoice_body #A4  ol,#A4  .invoice_body li{list-style: none; }
                                      .invoice_body #A4  li::before{ content: "-";}
                                      #A4 .print_logo{
                                        max-width: 150pt;
                                        max-height: 100pt;
                                        float: right;
                                      }
                                      #A4 .print_row{
                                        display: block;
                                      }
                                      #A4 .print_half{
                                        width:49.9%;
                                        float: left;
                                        display: inline-block;
                                      }
                                      #A4 .print_half:last-child{
                                        text-align: right;
                                      }
                                      #A4 .print_clearfix{
                                        clear: both;
                                      }
                                      .invoice_body #A4  h1{
                                        font-size: 24px;
                                        line-height: 1;
                                      }
                                      .invoice_body #A4  h2{
                                        font-size: 18px;
                                        line-height: 1;
                                      }
                                      .invoice_body #A4  h3{
                                        font-size: 14px;
                                        line-height: 1;
                                      }
                                      #A4 .print_center{
                                        text-align: center;
                                      }
                                      #A4 .print_pull_right{
                                        float: right;
                                        text-align: right;
                                        display: inline-block;
                                      }
                                      #A4 .print_inverse{
                                        background: rgba(0, 0, 0, 0.7);
                                        color: #fff;
                                        -webkit-print-color-adjust: exact;
                                      }
                                      #A4 .print_table{
                                        display: table;
                                        border-collapse: collapse;
                                        width:100%;
                                        margin-top: 20px;
                                        margin-bottom: 20px;
                                        border: 1px solid #999;
                                        -webkit-print-color-adjust: exact !important;

                                      }
                                      #A4 .print_table th,#A4  .print_table td{
                                        border: 1px solid #999;

                                      }
                                      #A4 .print_number{
                                        text-align: right;
                                      }
                                      #A4 .print_footer{
                                        margin-top: 20px;
                                      }

                                      /* A5 page CSS */
                                      .invoice_body #A5 {
                                        margin: 10px;
                                        border: 1px sold #ccc;
                                        line-height: 1;
                                      }
                                      .invoice_body #A5  ul, .invoice_body #A5  ol,#A5  .invoice_body li{list-style: none; }
                                      .invoice_body #A5  li::before{ content: "-";}
                                      #A5 .print_logo{
                                        max-width: 150pt;
                                        max-height: 100pt;
                                        float: right;
                                      }
                                      #A5 .print_row{
                                        display: block;
                                      }
                                      #A5 .print_half{
                                        width:49.9%;
                                        float: left;
                                        display: inline-block;
                                      }
                                      #A5 .print_half:last-child{
                                        text-align: right;
                                      }
                                      #A5 .print_clearfix{
                                        clear: both;
                                      }
                                      .invoice_body #A5  h1{
                                        font-size: 24px;
                                        line-height: 1;
                                      }
                                      .invoice_body #A5  h2{
                                        font-size: 18px;
                                        line-height: 1;
                                      }
                                      .invoice_body #A5  h3{
                                        font-size: 14px;
                                        line-height: 1;
                                      }
                                      #A5 .print_center{
                                        text-align: center;
                                      }
                                      #A5 .print_pull_right{
                                        float: right;
                                        text-align: right;
                                        display: inline-block;
                                      }
                                      #A5 .print_inverse{
                                        background: rgba(0, 0, 0, 0.7);
                                        color: #fff;
                                        -webkit-print-color-adjust: exact;
                                      }
                                      #A5 .print_table{
                                        display: table;
                                        border-collapse: collapse;
                                        width:100%;
                                        margin-top: 20px;
                                        margin-bottom: 20px;
                                        border: 1px solid #999;
                                        -webkit-print-color-adjust: exact !important;

                                      }
                                      #A5 .print_table th,#A5  .print_table td{
                                        border: 1px solid #999;

                                      }
                                      #A5 .print_number{
                                        text-align: right;
                                      }
                                      #A5 .print_footer{
                                        margin-top: 20px;
                                      }




                                      /* Thermal_80mm page CSS */
                                      .invoice_body #Thermal_80mm{ }

                                    .invoice_body #Thermal_80mm ul, .invoice_body #Thermal_80mm ol, .invoice_body #Thermal_80mm li{list-style: none; }
                                    .invoice_body #Thermal_80mm li::before{ content: "-";}
                                    #Thermal_80mm .print_logo{
                                      max-width: 100pt;
                                      max-height: 70pt;
                                      float: right;
                                    }
                                    #Thermal_80mm .print_row{
                                      display: block;
                                      border: 0px solid #000;
                                    }
                                    #Thermal_80mm .print_half{
                                      width:49.5%;
                                      float: left;
                                      display: inline-block;
                                      border: 0px dotted #000;
                                    }
                                    #Thermal_80mm .print_half:last-child{
                                      text-align: right;
                                      float: left;
                                      display: inline-block;
                                    }
                                    #Thermal_80mm .print_clearfix{
                                      clear: both;
                                    }
                                    .invoice_body #Thermal_80mm h1{
                                      font-size: 18px;
                                      line-height: 1;
                                      font-weight: 900 !important;
                                        }
                                    .invoice_body #Thermal_80mm h2{
                                      font-size: 14px;
                                      font-weight: bold !important;
                                      line-height: 1;}
                                    .invoice_body #Thermal_80mm h3{
                                      font-size: 18px;
                                      font-weight: bold !important;
                                      line-height: 1;}
                                    .invoice_body #Thermal_80mm h3 span{
                                      font-size: 18px;
                                      font-weight: bold !important;
                                      line-height: 1;
                                    }
                                    #Thermal_80mm .print_center{
                                      text-align: center;
                                    }
                                    #Thermal_80mm .print_pull_right{
                                      float: right;
                                      text-align: right;
                                      display: inline-block;
                                    }
                                    #Thermal_80mm .print_inverse{
                                      padding: 4px 4px;
                                      font-weight: bold !important;
                                      font-size: 20px !important;
                                      background: rgba(0, 0, 0, 1);
                                      color: #fff;
                                      font-weight: bold;
                                      -webkit-print-color-adjust: exact;
                                    }
                                    #Thermal_80mm .print_table{
                                      display: table;
                                      border-collapse: collapse;
                                      width:100%;
                                      margin-top: 2px;
                                      margin-bottom: 2px;
                                      border: 1px solid #999;
                                      font-weight: bold !important;
                                      -webkit-print-color-adjust: exact !important;

                                    }
                                    #Thermal_80mm .print_table th,#Thermal_80mm  .print_table td{
                                      border: 1px solid #999;
                                      font-weight: bold !important;
                                    }
                                    #Thermal_80mm .print_number{
                                      text-align: right;
                                      font-weight: bold;
                                    }
                                    #Thermal_80mm .print_footer{
                                      font-weight: bold;
                                      margin-top: 2px;
                                    }




                                    <?php
                                      if($_SESSION['sess_bp_print_default_template']=='Thermal_80mm')
                                      {
                                        ?>
                                        #invoice_printable_area{
                                          width: 320px;
                                          margin: 0;
                                        }
                                    <?php } ?>
                                  </style>
                                  <div class="invoice_body">
                                    <div class="print_size" id="<?=$_SESSION['sess_bp_print_default_template']?>">
                                      <div class="print_row">
                                        <p class="print_center"><?=$_SESSION['sess_bp_print_header_note']?></p>
                                      </div>
                                      <div class="print_row">
                                        <div class="print_half">
                                          <h1 class="print_name"><?=$_SESSION['sess_bp_name']?></h1>
                                          <h2 class="print_shop_address"><?=$_SESSION['sess_bp_adr']?></h2>
                                          <h2 class="print_phone">Phone: <?=$_SESSION['sess_bp_username']?></h2>
                                        </div>
                                        <div class="print_half">
                                          <img src="<?=$_SESSION['sess_bp_logo']?>" alt="Logo" class="print_logo" />
                                        </div>
                                        <div class="print_clearfix"></div>

                                      </div>
                                      <div class="print_row">
                                        <h1 class="print_center">Shipping Order</h1>
                                      </div>
                                      <div class="print_row">
                                        <div class="print_halfb">
                                          <h3>Date: <span class="print_date print_pull_right">N/A</span></h3>
                                          <h3 class="print_center">Shipping Company: </h3>
                                          <h3 class="print_center"><span class="print_shipping_company aprint_pull_right">N/A</span></h3>
                                          <h3 class="print_center">Pickup person: <br /><br /><span class="print_pickup_person print_pull_righta">N/A</span></h3>
                                        </div>
                                        <div class="print_halfa">
                                          <h2>&nbsp;</h2>
                                          <h3  class="print_center">Customer Shop Name: </h3>
                                          <h3  class="print_center"><span class="print_customer_name aprint_pull_right">N/A</span></h3>
                                          <h3  class="print_center">Address: <br><br /><span class="print_address aprint_pull_right">N/A</span></h3>
                                          <h3 class="">Phone: <span class="print_customer_phone print_pull_right">N/A</span></h3>
                                        </div>
                                        <div class="print_clearfix"></div>
                                      </div>
                                      <div class="print_row">
                                        <div class="print_half">
                                          <br />
                                          <h3><span id="print_unit1"></span> <span class="print_pull_right" id="print_qty1">N/A</span></h3>
                                          <h3><span id="print_unit2"></span> <span class="print_pull_right" id="print_qty2">N/A</span></h3>
                                          <h3><span id="print_unit3"></span> <span class="print_pull_right" id="print_qty3">N/A</span></h3>
                                          <h3><span id="print_unit4"></span> <span class="print_pull_right" id="print_qty4">N/A</span></h3>
                                          <h3><span id="print_unit5"></span> <span class="print_pull_right" id="print_qty5">N/A</span></h3>
                                          <h3><span id="print_unit6"></span> <span class="print_pull_right" id="print_qty6">N/A</span></h3>
                                          <h3><span id="print_unit7"></span> <span class="print_pull_right" id="print_qty7">N/A</span></h3>
                                          <!-- <h3><span id="print_unit_total">Total</span> <span class="print_pull_right" id="print_qty_total">N/A</span></h3> -->
                                          <h3 class="print_inverse">خرچہ: <span class="print_pull_right" id="print_amount">N/A</span></h3><br>
                                          <div class="print_clearfix"></div>
                                      </div>
                                        <div class="print_clearfix"></div>
                                    </div>
                                  <div class="print_row">
                                        <div class="print_halfa">
                                          <p>&nbsp;</p>
                                          <p>&nbsp;</p>
                                          <p>&nbsp;</p>

                                          <h3>____________________</h3>
                                          <h3>Authorized Signatory</h3>

                                        </div>
                                      </div>
                                      <div class="print_clearfix"></div>
                                      <div class="print_row">
                                        <p>&nbsp;</p>
                                      </div>
                                      <div class="print_row print_footer">
                                        <p class="print_center">نوٹ!
ڈیکوریشن- نازک مال- احتیاط کریں</p>
                                      </div>
                                      <div class="print_row hide">
                                        <div class="print_center"><p class="print_center">Software Provided By www.roznamchaapp.com</p></div>
                                        <div class="print_center"><p class="print_center">+92-343-4123489</p></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                            </div>
                          </div>
                          <div class="modal-footer">
                            <a type="button" target="_blank" class="btn btn-success waves-effect waves-light pull-left whatsapp_link" href="#whatsapp">WhatsApp</a>

                            <a type="button" class="btn btn-inverse waves-effect waves-light pull-left sms_summary" href="#sms_summary">SMS Summary</a>
                            <button type="button" id="print_printable" class="btn btn-info waves-effect waves-light pull-right print_printable">Print</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
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
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-6">
                                          <lable for="contact_number">Contact / Party</lable>
                                          <select class="form-control select2" name="contact_number" id="contact_number">
                                            <option value="+0000">Walkin Customer</option>
                                            <?php
                                            $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable','address'=>'','notes'=>'');
                                            $products_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`status` = 'Published' || `status`='published')";
                                            foreach ($db->query($products_query) as $row)
                                            {
                                              $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status'],'address'=>$row['city'],'notes'=>$row['notes']);

                                             ?>
                                            <option value="<?=$row['number']?>"><?=$row['name']?></option>
                                            <?php
                                              }


                                             ?>
                                             <option value="+0000">Walkin Customer</option>
                                          </select>
                                          <?php
                                            $json_contacts=json_encode($contacts_data,true);
                                           ?>
                                           <script type="text/javascript">
                                           <?php
                                           if(isset($_GET['c']))
                                           {
                                             ?>
                                             $('#contact_number').val('<?=substr($_GET['c'],1)?>');
                                             <?php } ?>

                                             var contacts_data=<?=$json_contacts?>;
                                           </script>
                                           <a href="r-ledgerview.php?id=c" id="ledger_url" class="btn btn-xs btn-link">View ledger</a>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date">Date </label>

                                          <div class="input-group">
                                              <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                              <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-6">
                                          <!-- <lable for="contact_number">Shipping By</lable>
                                          <select class="form-control select2" name="shipping" id="shipping_by">
                                            <option value="+0000">Walkin Customer</option>
                                            <?php
                                            $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');
                                            $products_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`status` = 'Published' || `status`='published')";
                                            foreach ($db->query($products_query) as $row)
                                            {
                                              $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                             ?>
                                            <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                            <?php
                                              }
                                             ?>
                                          </select> -->
                                        </div>
                                        <div class="col-sm-6">
                                          <label for="amount">Total Expense</label>
                                          <input type="number" required class="form-control" name="amount" id="amount" value="0">
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="pickup_person">Pickup Guy:</label>
                                            <input type="text" class="form-control" required="" id="pickup_person" name="pickup_person" aria-required="true">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 1<span class="text-danger"></span> </label>
                                            <select name="measuring_unit1" id="measuring_unit1" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty1">Qty 1</label>
                                          <input type="number" required class="form-control" name="qty1" id="qty1" value="">
                                        </div>

                                      </div>


                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 2<span class="text-danger"></span> </label>
                                            <select name="measuring_unit2" id="measuring_unit2" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty2">Qty 2</label>
                                          <input type="number" required class="form-control" name="qty2" id="qty2" value="">
                                        </div>

                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 3<span class="text-danger"></span> </label>
                                            <select name="measuring_unit3" id="measuring_unit3" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty3">Qty 3</label>
                                          <input type="number" required class="form-control" name="qty3" id="qty3" value="">
                                        </div>

                                      </div>

                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 4<span class="text-danger"></span> </label>
                                            <select name="measuring_unit4" id="measuring_unit4" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty4">Qty 4</label>
                                          <input type="number" required class="form-control" name="qty4" id="qty4" value="">
                                        </div>

                                      </div>

                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 5<span class="text-danger"></span> </label>
                                            <select name="measuring_unit5" id="measuring_unit5" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty5">Qty 5</label>
                                          <input type="number" required class="form-control" name="qty5" id="qty5" value="">
                                        </div>

                                      </div>

                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 6<span class="text-danger"></span> </label>
                                            <select name="measuring_unit6" id="measuring_unit6" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty6">Qty 6</label>
                                          <input type="number" required class="form-control" name="qty6" id="qty6" value="">
                                        </div>

                                      </div>


                                      <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label for="">Measuring Unit 7<span class="text-danger"></span> </label>
                                            <select name="measuring_unit7" id="measuring_unit7" class="form-control">
                                              <option value=""></option>
                                              <?php
                                                foreach ($list_shipping_units as $key )
                                                {
                                                ?>
                                                  <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                                <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label for="Qty7">Qty 7</label>
                                          <input type="number" required class="form-control" name="qty7" id="qty7" value="">
                                        </div>

                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6"><a href="#" id="resetbtn" class="btn btn-danger">Cancel</a></div>
                                        <div class="col-sm-6"><a href="#" id="submitbtn" class="btn btn-success pull-right">Create Receipt</a></div>
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
        <script>


        var shop_name = '<?=$_SESSION['sess_bp_name']?>';
        var currency = '<?=$_SESSION['sess_bp_currency']?>';
        var shop_address = '<?=$_SESSION['sess_bp_adr']?>';
        var shop_phone = '<?=$_SESSION['sess_bp_username']?>';

        function isValidJSONString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
          function reload_page()
          {
            window.location.reload();
          }
            $("#submitbtn").click(function(e){
              e.preventDefault();
              $(this).attr('disabled',true);



              var pickup_person = $('#pickup_person').val();

              var contact_number_data = $('#contact_number').select2('data')

              var customer_name = contact_number_data[0].text;
              var customer_phone = contact_number_data[0].id;
              var customer_address =contacts_data[customer_phone]['address'];
              var shipping_company = contacts_data[customer_phone]['notes'];

              var unit1 = $('#measuring_unit1').val();
              var unit2 = $('#measuring_unit2').val();
              var unit3 = $('#measuring_unit3').val();
              var unit4 = $('#measuring_unit4').val();
              var unit5 = $('#measuring_unit5').val();
              var unit6 = $('#measuring_unit6').val();
              var unit7 = $('#measuring_unit7').val();

              var qty1 = $('#qty1').val();
              var qty2 = $('#qty2').val();
              var qty3 = $('#qty3').val();
              var qty4 = $('#qty4').val();
              var qty5 = $('#qty5').val();
              var qty6 = $('#qty6').val();
              var qty7 = $('#qty7').val();

              var sum_qty = parseFloat(qty1) + parseFloat(qty2) + parseFloat(qty3) + parseFloat(qty4) + parseFloat(qty5);


              var expense_amount = $('#amount').val();
              var selected_date = $("#datepicker-autoclose").val();

              var days = ['Sun', 'Mon', 'Tues', 'Wed', 'Thur', 'Fri', 'Sat'];
              var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'];
              var d = new Date(selected_date);
              var getDayName = days[d.getDay()];
              var getDateNumber = d.getDate();
              var getMonthName = months[d.getMonth()];
              var getYear = d.getFullYear();

              var formated_date = getDayName+' '+getDateNumber+'-'+getMonthName+'-'+getYear;

              $(".print_shipping_company").html(shipping_company);
              $(".print_pickup_person").html(pickup_person);
              $(".print_customer_phone").html(customer_phone);
              $(".print_customer_name").html(customer_name);
              $(".print_address").html(customer_address);

              $("#print_unit1").html(unit1);
              $("#print_unit2").html(unit2);
              $("#print_unit3").html(unit3);
              $("#print_unit4").html(unit4);
              $("#print_unit5").html(unit5);
              $("#print_unit6").html(unit6);
              $("#print_unit7").html(unit7);

              $("#print_qty1").html(qty1);
              $("#print_qty2").html(qty2);
              $("#print_qty3").html(qty3);
              $("#print_qty4").html(qty4);
              $("#print_qty5").html(qty5);
              $("#print_qty6").html(qty6);
              $("#print_qty7").html(qty7);

              $("#print_qty_total").html(sum_qty);
              // alert(sum_qty);

              $("#print_amount").html(expense_amount);
              $(".print_date").html(formated_date);



                          $.post( "t-shipping-new.php", { contact_number: customer_phone,  date: formated_date,  total_expense: expense_amount,  picker_guy: pickup_person,  unit1: unit1,  qty1: qty1,  unit2: unit2,  qty2: qty2,  unit3: unit3,  qty3: qty3,  unit4: unit4,  qty4: qty4,  unit5: unit5,  qty5: qty5 ,  unit6: unit6,  qty6: qty6 ,  unit7: unit7,  qty7: qty7 })
                            .done(function( data ) {
                              //alert(data);
                              if(data == 'success')
                              {

                                  $('#invoice_response_modal').modal('show');

                //                      alert('success');
                                  swal({
                                    title: 'Success!',
                                    text: 'Expense Added successfully.',
                                    timer: 2000,
                                    type: 'success',
                                    showConfirmButton: false
                                  });
                                  // setTimeout(function() {
                                  //   window.location.reload();
                                  // }, 3000);

                              }else{

                                alert('error'+data);
                              }
                            });


            });

            $(document).on('click','#print_printable',function(e){
              e.preventDefault();
              $('.preloader').show();
    //          alert('sending print.');
              printJS('invoice_printable_area', 'html');
              $('.preloader').hide();
            });

        </script>
        <!-- ============================================================== -->
</body>
</html>
