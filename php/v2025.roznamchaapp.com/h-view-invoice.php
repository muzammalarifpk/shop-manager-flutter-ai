<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once("t-sale.config.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
                              <?php
                                $invoice_qry="select * from `$_GET[table]` where `id`='$_GET[invoice_id]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

                                if ($res = $db->query($invoice_qry)) {

                                    /* Check the number of rows that match the SELECT statement */
                                    if ($res->fetchColumn() > 0) {


                                        foreach ($db->query($invoice_qry) as $row) {
                                          ?>
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h4 class="modal-title">Invoice ID <span class="invoice_id"><?=$row['id']?></span></h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="row  el-element-overlay">

                                                        <div id="invoice_printable_area">

                                                          <style media="all">
                                                            #invoice_printable_area{
                                                              width: 100%;
                                                              margin: 0 auto;
                                                            }
                                                            @page {
                                                                margin: 0.5cm;
                                                              }
                                                            .invoice_body{
                                                              margin: 10px;
                                                              border: 1px sold #ccc;
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
                                                              font-size: 30px;
                                                              line-height: 1;
                                                            }
                                                            .invoice_body h2{
                                                              font-size: 24px;
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
                                                              color: #fff;
                                                              -webkit-print-color-adjust: exact;
                                                            }
                                                            .print_table{
                                                              display: table;
                                                              border-collapse: collapse;
                                                              width:100%;
                                                              margin-top: 20px;
                                                              margin-bottom: 20px;
                                                              border: 1px solid #999;
                                                              -webkit-print-color-adjust: exact !important;

                                                            }
                                                            .print_table th, .print_table td{
                                                              border: 1px solid #999;
                                                              font-size: 24px;
                                                              text-align: center;
                                                            }
                                                            .print_number{
                                                              text-align: right;
                                                            }
                                                            .print_footer{
                                                              margin-top: 20px;
                                                            }
                                                            <?php
                                                              if($_SESSION['sess_bp_print_default_template']=='Thermal_80mm')
                                                              {
                                                                ?>
                                                                #invoice_printable_area{
                                                                  width: 300px;
                                                                  margin: 0;
                                                                }

                                                                @media  print {
                                                                  body{
                                                                    font-weight: 900 !important;
                                                                    font-family: sans-serif;
                                                                  }

                                                                }


                                                                .print_inverse{
                                                                  background: rgba(0, 0, 0, 1);
                                                                  color: #fff;
                                                                  -webkit-print-color-adjust: exact;
                                                                }

                                                                .print_logo{
                                                                  max-width: 100pt;
                                                                  max-height: 70pt;
                                                                }
                                                                .invoice_body h1{
                                                                  font-size: 16px;
                                                                }
                                                                .invoice_body h2{
                                                                  font-size: 14px;
                                                                }
                                                                .invoice_body h3{
                                                                  font-size: 12px;
                                                                }
                                                                .print_table th, .print_table td{
                                                                  font-size: 12px;
                                                                  font-weight: 900 !important;
                                                                }
                                                                <?php
                                                              }
                                                             ?>
                                                          </style>
                                                          <div class="print_size" id="<?=$_SESSION['sess_bp_print_default_template']?>">
                                                          <div class="invoice_body">
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
                                                              <h1 class="print_center"><?=str_replace('_',' ',$_GET['table'])?></h1>
                                                            </div>
                                                            <div class="print_row">
                                                              <div class="print_half">
                                                                <h2>To:</h2>
                                                                <h3>Name: <span class="print_customer_name"><?=gnr($db,'contacts','number',$row['contact_number'],'name')?></span></h3>
                                                                <h3>Phone: <span class="print_customer_phone"><?=$row['contact_number']?></span></h3>
                                                              </div>
                                                              <div class="print_half">
                                                                <h2>&nbsp;</h2>
                                                                <h3 class="">Invoice ID: <span class="print_invoice_no print_pull_right"><?=$row['id']?></span></h3>
                                                                <h3 class="">Date: <span class="print_invoice_date print_pull_right"><?=date('D - d-m-Y',strtotime($row['date']))?></span></h3>
                                                              </div>
                                                              <div class="print_clearfix"></div>
                                                            </div>
                                                            <?php if($_SESSION['sess_bp_print_default_template']!=='Thermal_80mm')
                                                            {
                                                              ?>
                                                            <div class="print_row">
                                                              <p>&nbsp;</p>
                                                            </div>
                                                          <?php }?>
                                                            <div class="print_row">
                                                              <?php
                                                              $cartitems = json_decode($row['cartitems'],true);
                                                              if(is_array($cartitems))
                                                              {
                                                              ?>
                                                              <table class="print_table" id="print_products">
                                                                <thead class="print_inverse">
                                                                  <tr>
                                                                    <th>#</th>
                                                                    <th>Item Name</th>
                                                                    <th>Qty</th>
                                                                    <th>Measure</th>
                                                                    <th class="do_mode">Rate</th>
                                                                    <th class="do_mode">Total</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php
                                                                  $item_counter=0;
                                                                  $items_qty = 0;
                                                                  $items_total = 0;
                                                                  foreach ($cartitems as $key => $value)
                                                                  {
                                                                    $item_counter++;
                                                                    $items_qty = $items_qty + floatval($value['row_qty']);
                                                                    $items_total = $items_total + (floatval($value['row_qty'])*floatval($value['row_rate']));
                                                                    // code...
//                                                                   print_r($value);
                                                                    ?>
                                                                  <tr>
                                                                    <td><?=$item_counter?></td>
                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'name')?></td>
                                                                    <td class="print_number"><?=$value['row_qty']?></td>
                                                                    <td ><?=$value['unit_measure']?></td>
                                                                    <td class="print_number do_mode"><?=$value['row_rate']?></td>
                                                                    <td class="print_number do_mode"><?=$value['row_qty']*$value['row_rate']?></td>
                                                                  </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                  <tr class="">
                                                                    <th colspan="2" class="print_number">Total Qty</th>
                                                                    <th class="print_number" id="print_items_total_qty"><?=$items_qty?></th>
                                                                    <th colspan="2" class="print_number  do_mode">Total</th>
                                                                    <th class="print_number do_mode" id="print_items_total_price"><?=$items_total?></th>
                                                                  </tr>
                                                                </tfoot>
                                                              </table>
                                                              <?php
                                                              }

                                                              $cart_items_services = json_decode($row['cart_items_services'],true);
                                                              if(is_array($cart_items_services) && (count($cart_items_services)>0))
                                                              {

                                                             ?>
                                                              <table id="print_services" class="print_table">
                                                                <thead class="print_inverse">
                                                                  <th>#</th>
                                                                  <th>Service Name</th>
                                                                  <th class="do_mode">Unit Price</th>
                                                                  <th>Qty</th>
                                                                  <th class="do_mode">Total</th>
                                                                </thead>
                                                                <tbody>
                                                                  <?php
                                                                  $service_counter=0;
                                                                  $service_qty=0;
                                                                  $service_total=0;
                                                                  foreach ($cart_items_services as $key => $svalue)
                                                                  {
//                                                                    print_r($svalue);
                                                                    $service_counter++;
                                                                    $service_qty=$service_qty+floatval($svalue['qty']);
                                                                    $service_total=$service_total+floatval($svalue['this_total']);


                                                                    ?>
                                                                      <tr>
                                                                        <td><?=$service_counter?></td>
                                                                        <td><?=gnr($db,'services','id',$svalue['service_id'],'name')?></td>
                                                                        <td class="print_number do_mode"><?=$svalue['sale_price']?></td>
                                                                        <td class="print_number"><?=$svalue['qty']?></td>
                                                                        <td class="print_number do_mode"><?=$svalue['this_total']?></td>
                                                                      </tr>
                                                                    <?php
                                                                  } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                  <tr class="do_mode">
                                                                    <th colspan="3" class="print_number">Total</th>
                                                                    <th class="print_number" id="services_total_qty"><?=$service_qty?></th>
                                                                    <th class="print_number do_mode" id="services_total_price"><?=$service_total?></th>
                                                                  </tr>
                                                                </tfoot>
                                                              </table>
                                                              <?php
                                                            } ?>
                                                            </div>
                                                            <div class="print_row">
                                                              <p>&nbsp;</p>
                                                              <p>&nbsp;</p>
                                                            </div>
                                                            <div class="print_row">
                                                              <div class="print_half">
                                                                <p>Notes</p>
                                                                <p id="print_notes"><?=$row['notes']?></p>
                                                                <p>&nbsp;</p>
                                                                <p>&nbsp;</p>
                                                                <p>&nbsp;</p>


                                                                <h3>____________________</h3>
                                                                <h3>Authorized Signatory</h3>

                                                              </div>
                                                              <div class="print_half  do_mode" id="invoice_totals">
                                                                <h3>Sub Total: <span class="print_pull_right" id="print_sub_total"><?=$row['sub_total']?></span></h3>
                                                                <h3>Discount: <span class="print_pull_right" id="print_discount"><?=$row['discount']?></span></h3>
                                                                <?php
                                                                  if($_SESSION['sess_bp_tax']=='on')
                                                                  {
                                                                ?>
                                                                <h3>Tax: <span class="print_pull_right" id="print_tax"><?=$row['tax']?></span></h3>
                                                              <?php }
                                                              ?>
                                                                <h2 class="print_inverse">Grand Total: <span id="print_grand_total" class="print_pull_right"><?=$row['grand_total']?></span><span class="print_pull_right"><?=$_SESSION['sess_bp_currency']?>&nbsp; </span></h2>
                                                                <h3>Payment Method: <span class="print_pull_right" id="print_payment_method"><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></span></h3>
                                                                <h3>Amount Received: <span class="print_pull_right" id="print_amount_recieived"><?=$row['amount_paid']?></span></h3>
                                                                <h3>Remaining Amount: <span class="print_pull_right" id="print_invoice_balance"><?=$row['remaining_amount']?></span></h3>
                                                              </div>
                                                              <div class="print_clearfix"></div>
                                                            </div>
                                                            <?php if($_SESSION['sess_bp_print_default_template']!=='Thermal_80mm')
                                                            {
                                                              ?>
                                                            <div class="print_row">
                                                              <p>&nbsp;</p>
                                                              <p>&nbsp;</p>
                                                            </div>
                                                          <?php } ?>
                                                          
                                                            <div class="print_row print_footer">
                                                              <p class="print_center"><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                                            </div>
                                                            <div class="print_row">
                                                              <div class="print_center"><p class="print_center">Powered by www.RoznamchaApp.com</p></div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        </div>

                                                        <div class="attachments-area"  style="width:100%; margin:10px;">
              <?php
              $attachments_qry="select * from `gallery` where `ref_id`='$row[attachments]' and `owner_mobile`='$_SESSION[sess_bp_username]'";
              foreach ($db->query($attachments_qry) as $attachments_row) {
                ?>
                  <a href="<?=$attachments_row['file_path']?>" target="_blank"><img src="<?=$attachments_row['file_path']?>" class="img img-thumbnail" alt="<?=$attachments_row['file_name']?>" style="max-width: 25%;"></a>
                <?php
              }
               ?>
                                                        </div>


                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <div class="pull-left">
                                                      <a href="#" rel="<?=$row['id']?>" class="btn btn-success btn-sm delivery_mode">DO Mode</a>
                                                    </div>
                                                    <?php
                                                      if($_SESSION['sess_bp_privs']=='*')
                                                     {
                                                       if($_GET['table']=='purchase_invoices')
                                                       {
                                                       ?>

                                                      <a href="#" rel="<?=$row['id']?>" class="btn btn-danger btn-sm delete_btn">Delete</a>
                                                      <a href="t-purchase-invoice-edit.php?id=<?=$row['id']?>" rel="Edit" class="btn btn-primary btn-sm edit_btn">Edit</a>
                                                      <?php
                                                    }elseif($_GET['table']!=='sale_quotations')
                                                      {
                                                      ?>

                                                     <a href="#" rel="<?=$row['id']?>" class="btn btn-danger btn-sm delete_btn">Delete</a>
                                                     <a href="t-sale-Invoice-edit.php?id=<?=$row['id']?>" rel="Edit" class="btn btn-primary btn-sm edit_btn">Edit</a>
                                                     <?php
                                                     }else{
                                                        ?>
                                                        <a href="t-sale-quotation-edit.php?id=<?=$row['id']?>" rel="Edit" class="btn btn-primary btn-sm edit_btn">Edit</a>
                                                        <?php
                                                      }
                                                    }
                                                    ?>


                                                    <button type="button" id="print_printable" class="btn btn-info waves-effect waves-light pull-right print_printable">Print</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                  </div>
                                              </div>
                                          </div>


                                        <?php
                                      }
                          }
                          /* No rows matched -- do something else */
                          else {
                              print "No rows matched the query.";
                          }
                      }

                     ?>
