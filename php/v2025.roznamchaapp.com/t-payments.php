<?php
  require_once("t-payments.config.php");
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
                                      .invoice_body #Thermal_80mm{   font-family: "Times New Roman", Times, serif;}

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
                                      font-weight: bold !important;
                                        }
                                    .invoice_body #Thermal_80mm h2{
                                      font-size: 16px;
                                    font-weight: bold !important;
                                    line-height: 1;}
                                    .invoice_body #Thermal_80mm h3{
                                      font-size: 14px;
                                      font-weight: bold !important;
                                      line-height: 1.8;}
                                    .invoice_body #Thermal_80mm h3 span{
                                      font-size: 14px;
                                      font-weight: bold !important;
                                      line-height: 1.8;
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
                                      padding: 4px 0;
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
                                          <h2 class="print_address"><?=$_SESSION['sess_bp_adr']?></h2>
                                          <h2 class="print_phone">Phone: <?=$_SESSION['sess_bp_username']?></h2>
                                        </div>
                                        <div class="print_half">
                                          <img src="<?=$_SESSION['sess_bp_logo']?>" alt="Logo" class="print_logo" />
                                        </div>
                                        <div class="print_clearfix"></div>

                                      </div>
                                      <div class="print_row">
                                        <h1 class="print_center">Payment Receipt</h1>
                                      </div>
                                      <div class="print_row">
                                        <div class="print_half">
                                          <h2>To:</h2>
                                          <h3>Name: <span class="print_customer_name">N/A</span></h3>
                                          <h3>Phone: <span class="print_customer_phone">N/A</span></h3>
                                        </div>
                                        <div class="print_half">
                                          <h2>&nbsp;</h2>
                                          <h3 class="">Invoice ID: <span class="print_invoice_no print_pull_right">N/A</span></h3>
                                          <h3 class="">Date: <span class="print_invoice_date print_pull_right">N/A</span></h3>
                                        </div>
                                        <div class="print_clearfix"></div>
                                      </div>

                                      <div class="print_row">
                                        <h3>Payment Method: <span class="print_pull_right" id="print_payment_method">N/A</span></h3>
                                        <h3>Payment Type: <span class="print_pull_right" id="print_payment_type">--</span></h3>
                                        <h2 class="print_inverse">Amount: <span id="print_grand_total" class="print_pull_right">0.00</span><span class="print_pull_right"><?=$_SESSION['sess_bp_currency']?>&nbsp; </span></h2>
                                        <h2 class="">Discount: <span id="print_discount" class="print_pull_right">0.00</span><span class="print_pull_right"><?=$_SESSION['sess_bp_currency']?>&nbsp; </span></h2>
                                        <hr />
                                        <h3>Old Balance: <span class="print_pull_right" id="print_old_balance">0.00</span></h3>
                                        <h3>New Balance: <span class="print_pull_right" id="print_total_balance">0.00</span></h3>
                                      </div>
                                      <div class="print_row">
                                        <div class="print_half">
                                          <p>&nbsp;</p>
                                          <p>Notes</p>
                                          <p id="print_notes"></p>

                                        </div>
                                        <div class="print_half">
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
                                        <p class="print_center"><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                      </div>
                                      <div class="print_row hide">
                                        <div class="print_center"><p class="print_center">Software Provided By www.BasePlan.pk</p></div>
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
                                             <option value="+0000">Walkin Customer</option>
                                          </select>
                                          <?php
                                            $json_contacts=json_encode_gfs($contacts_data,true);
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
                                          <div class="col-sm-6">
                                            <label for="amount">Amount</label>
                                            <input type="number" required class="form-control" name="amount" id="amount" value="0">
                                          </div>
                                          <div class="col-sm-6">
                                            <label for="payment_method">Payment Method</label>
                                              <select class="form-control" name="payment_method" id="payment_method">
                                                <?php
                                             try{
                                                 $bank_qry="select * from `chartofaccount` where (`account_type`=:type1 or `account_type`=:type2) and  `owner_mobile`=:owner_mobile";
                                                 $banks=$db->prepare($bank_qry);

                                                 $owner_mobile=$_SESSION['sess_bp_username'];
                                                 $banks->execute(['type1'=>'cash','type2'=>'bank','owner_mobile'=>$owner_mobile]);

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
                                            <input type="radio" name="payment_type" value="Paid" class="form-control" id="type_paid" checked> <label for="type_paid">Paid</label>
                                            <input type="radio" name="payment_type" value="Received" class="form-control" id="type_received" <?php if(isset($_GET['type']))
                                            {
                                                if($_GET['type']=='received')
                                                { echo 'checked';}
                                            }?> > <label for="type_received">Received</label>
                                          </div>
                                          <div class="col-sm-6">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" id="description" placeholder="paid x amount for ...">
                                          </div>
                                        </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                          <div class="col-sm-6">
                                            <label for="discount">Discount Amount</label>
                                            <input type="number" required class="form-control" name="discount" id="discount" value="0">
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

                                          </div>
                                          <div class="col-sm-6">
                                            <div data-action="t-invoice-gallery.process.php?invoice_token=" class="dropzone"></div>
                                          </div>
                                        </div>

                                        <?php
                                      }

                                       ?>


                                      <div class="row">
                                        <div class="col-sm-6"><a href="#" id="resetbtn" class="btn btn-danger">Cancel</a></div>
                                        <div class="col-sm-6"><a href="#" id="submitbtn" class="btn btn-success pull-right">Save and Next</a></div>
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
              var amount_input=$('#amount').val();
              if(amount_input == ''){
                alert('You must enter some amount...');
                return false;
              }
              $('.preloader').show();
              $(this).attr('disabled',true);

                var contact_number = $("#contact_number").val();
                var date = $("#datepicker-autoclose").val();
                var amount = $("#amount").val();
                var discount = $("#discount").val();
                var payment_type = $("input[name='payment_type']:checked").val();
                var description = $("#description").val();
                var payment_method = $("#payment_method").val();

                $.post( "t-payments-new.php", { contact_number: contact_number, date: date, amount: amount, discount: discount, description: description, payment_method: payment_method, payment_type:payment_type })
                  .done(function( data ) {

                    if(isValidJSONString(data))
                    {
                      var response = JSON.parse(data);

                      var print_customer_name = $.trim($('#select2-contact_number-container').attr('title'));
                      var print_name_parts = print_customer_name.split('(');
                      var print_customer_name = print_name_parts[0];
                      var old_remaining_balance = $('#old_balance_val').html();
                      var old_remaining_balance_status = $('#old_balance_status').html();
                      var total_remaining_balance = $('#new_balance_val').html();
                      var total_remaining_balance_status = $('#new_balance_status').html();
                      var payment_method_name = $( "#payment_method option:selected" ).text();
                      var notes = $("#description").val();
                      var amount = $('#amount').val();
                      var discount = $('#discount').val();
                      var selected_date = $('#datepicker-autoclose').val();

                      var days = ['Sun', 'Mon', 'Tues', 'Wed', 'Thur', 'Fri', 'Sat'];
                      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'];
                      var d = new Date(selected_date);
                      var getDayName = days[d.getDay()];
                      var getDateNumber = d.getDate();
                      var getMonthName = months[d.getMonth()];
                      var getYear = d.getFullYear();

                      var formated_date = getDayName+' '+getDateNumber+'-'+getMonthName+'-'+getYear;

                      var payment_type = $('input[name="payment_type"]:checked').val();
                      var whatsapp_valid_phone = contact_number.replace('-','');

                      var wa_invoice_msg = "Dear *"+print_customer_name.slice(0,-1)+ "* \n\n Your payment of *"+parseFloat(amount).toFixed(2)+"* has been added to your account. \n\nReceipt No: "+response['msg']+" \nDate: "+response['date_time']+" \n\n New Balance:       *"+total_remaining_balance+" "+total_remaining_balance_status+"* \n\n\n\n\n*"+shop_name+"*\nPhone: "+shop_phone+"\nAddress: "+shop_address+" \nSoftware By www.BasePlan.pk\nThank you for your business, Visit Again.";

                      var msg_start = "Dear "+print_customer_name+" \nYour payment of: "+parseFloat(amount).toFixed(2)+" has been added to your account. Receipt No: "+response['msg']+"\n Date: "+response['date_time']+" \n ================\n";
                      var msg_end = "\n New Balance:       "+total_remaining_balance+" "+total_remaining_balance_status+" \n\n\n "+shop_name;

                      var whatsapp_link = 'https://api.whatsapp.com/send?phone='+whatsapp_valid_phone+'&text='+encodeURI(wa_invoice_msg);
                      var sms_summary_link = 'sms://'+whatsapp_valid_phone+'/?&body='+encodeURI(msg_start+msg_end);


                      $(".print_customer_name").html(print_customer_name);
                      $(".print_customer_phone").html(contact_number);
                      $(".print_invoice_date").html(formated_date);
                      $(".print_invoice_no").html(response['msg']);

                      $("#print_notes").html(notes);
                      $("#print_payment_method").html(payment_method_name);
                      $("#print_payment_type").html(payment_type);
                      $("#print_grand_total").html(parseFloat(amount).toFixed(2));
                      $("#print_discount").html(parseFloat(discount).toFixed(2));
                      $("#print_old_balance").html(old_remaining_balance+' '+old_remaining_balance_status);
                      $("#print_total_balance").html(total_remaining_balance+' '+total_remaining_balance_status);

                      $('#amount').val(0);
                      $('#discount').val(0);
                      $('#description').val('');

                      $('.whatsapp_link').attr('href',whatsapp_link);
                      $('.sms_summary').attr('href',sms_summary_link);

                      $('#invoice_response_modal').modal('show');
                      $('.preloader').hide();
                    }
                    else{
                      console.log(data);
                      //          alert(data);
                      swal({
                        title: 'Error!',
                        text: 'Some error occur while processing.',
                        timer: 2000,
                        type: 'error',
                        showConfirmButton: false
                      });
                      alert(data);
                      $('.preloader').hide();
                      }
                  });

                return false;

            });
            function update_balance()
            {

              var old_amount = 0;
              var new_amount = 0;
              var old_status = 'debit';
              var new_status = 'debit';
              var selected_contact_details=$("#contact_number").val();
              var old_amount=contacts_data[selected_contact_details]['balance'];
              var old_status=contacts_data[selected_contact_details]['status'];
              var payment_type = $('input[name="payment_type"]:checked').val();
              var amount_paid = $('#amount').val();
              var amount_discount = $('#discount').val();

              if(amount_paid=='')
              {
                amount_paid=0;
              }
              amount_paid = parseFloat(amount_paid);

              if(amount_discount=='')
              {
                amount_discount=0;
              }
              amount_discount = parseFloat(amount_discount);



              if(payment_type=='Received')
              {
                if(old_status=='credit' || old_status == 'payable')
                {
                  new_status = 'payable';
                  new_amount = parseFloat(old_amount) + parseFloat(amount_paid) + parseFloat(amount_discount);
                }else{
                  if(old_amount >= amount_paid )
                  {
                    new_status = 'receiveable';
                    new_amount = parseFloat(old_amount) - parseFloat(amount_paid) - parseFloat(amount_discount);
                  }else{
                    new_status = 'payable';
                    new_amount = parseFloat(amount_paid) - parseFloat(old_amount) - parseFloat(amount_discount);
                  }
                }

              }else{

                if(old_status=='debit' || old_status == 'receiveable')
                {
                  new_status = 'receiveable';
                  new_amount = parseFloat(old_amount) + parseFloat(amount_paid) + parseFloat(amount_discount);
                }else{
                  if(old_amount >= amount_paid )
                  {
                    new_status = 'payable';
                    new_amount = parseFloat(old_amount) - parseFloat(amount_paid)  - parseFloat(amount_discount);
                  }else{
                    new_status = 'receiveable';
                    new_amount = parseFloat(amount_paid) - parseFloat(old_amount)  - parseFloat(amount_discount);
                  }
                }
              }



              old_amount = parseFloat(old_amount).toFixed(2);
              new_amount = parseFloat(new_amount).toFixed(2);


              var numberEncode = encodeURIComponent(selected_contact_details);
              var ledger_url = 'r-ledgerview.php?id=c'+numberEncode;
              $('#ledger_url').attr('href',ledger_url);
              //alert(ledger_url);

              $('#old_balance_val').html(old_amount);
              $('#old_balance_status').html(old_status);

              $('#new_balance_val').html(new_amount);
              $('#new_balance_status').html(new_status);


            }

            $(document).on('change','select',function(e){
              update_balance();
            });
            $(document).on('change','input',function(e){
              update_balance();
            });
            $(document).on('click','#print_printable',function(e){
              e.preventDefault();
              $('.preloader').show();
    //          alert('sending print.');
              printJS('invoice_printable_area', 'html');
              $('.preloader').hide();
            });
        </script>
        <script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
        <script type="text/javascript">
        //Disabling autoDiscover
        Dropzone.autoDiscover = false;

        $(function() {
            //Dropzone class
            var myDropzone = new Dropzone(".dropzone", {
                url: "t-invoice-gallery.process.php?type=payment_attachment",
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
        </script>    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
