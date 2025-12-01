<?php
  header('Content-Type: text/html; charset=utf-8');
  require_once("t-sale.config.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
                              <?php
                                $invoice_qry="select * from `stock_transfer` where `id`='$_REQUEST[invoiceid]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

                                if ($res = $db->query($invoice_qry)) {

                                    /* Check the number of rows that match the SELECT statement */
                                    if ($res->fetchColumn() > 0) {


                                        foreach ($db->query($invoice_qry) as $row) {
                                          ?>
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h4 class="modal-title">Transfer ID <span class="invoice_id"><?=$row['id']?></span></h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="row  el-element-overlay">

                                                        <div id="invoice_printable_area" style="width:100%; margin:10px;">
                                                          <style media="all">
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
                                                              font-size: 24px;
                                                              line-height: 1;
                                                            }
                                                            .invoice_body h2{
                                                              font-size: 18px;
                                                              line-height: 1;
                                                            }
                                                            .invoice_body h3{
                                                              font-size: 14px;
                                                              line-height: 1;
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

                                                            }
                                                            .print_number{
                                                              text-align: right;
                                                            }
                                                            .print_footer{
                                                              margin-top: 20px;
                                                            }
                                                          </style>
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
                                                              <h1 class="print_center">Stock Transfer</h1>
                                                            </div>
                                                            <div class="print_row">
                                                              <div class="print_half">
                                                                <h3>From Location: <span class="print_customer_name">
                                                                  <?php
                                                                  if($row['from_location']=='')
                                                                  { echo 'Shop';}
                                                                  else{
                                                                    echo gnr($db,'locations','id',$row['from_location'],'name');
                                                                  }
                                                                  ?>
                                                                </span></h3>
                                                                <h3>To Location: <span class="print_customer_phone">
                                                                  <?php
                                                                  if($row['to_location']=='')
                                                                  { echo 'Shop';}
                                                                  else{
                                                                    echo gnr($db,'locations','id',$row['to_location'],'name');
                                                                  }
                                                                  ?></span></h3>
                                                              </div>
                                                              <div class="print_half">
                                                                <h2>&nbsp;</h2>
                                                                <h3 class="">Transfer ID: <span class="print_invoice_no print_pull_right"><?=$row['id']?></span></h3>
                                                                <h3 class="">Date: <span class="print_invoice_date print_pull_right"><?=$row['date']?></span></h3>
                                                              </div>
                                                              <div class="print_clearfix"></div>
                                                            </div>
                                                            <div class="print_row">
                                                              <p>&nbsp;</p>
                                                            </div>
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
                                                                    <th>Product</th>
                                                                    <th>Qty</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php
                                                                  $item_counter=0;
                                                                  $items_qty = 0;
                                                                  $items_total = 0;
                                                                  foreach ($cartitems as $key => $value)
                                                                  {
//                                                                    print_r($value);
                                                                    $item_counter++;
                                                                    ?>
                                                                  <tr>
                                                                    <td><?=$item_counter?></td>
                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'name')?></td>
                                                                    <td class="print_number"><?=$value['item_qty']?></td>
                                                                  </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                              </table>
                                                              <?php
                                                              }
                                                              ?>
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

                                                            </div>
                                                            <div class="print_row">
                                                              <p>&nbsp;</p>
                                                              <p>&nbsp;</p>
                                                            </div>
                                                            <div class="print_row">
                                                              <div class="print_center"><p class="print_center">Powered by www.BasePlan.pk</p></div>
                                                            </div>
                                                          </div>
                                                        </div>


                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">

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
                            echo 'error';
                          }
                      }

                     ?>
