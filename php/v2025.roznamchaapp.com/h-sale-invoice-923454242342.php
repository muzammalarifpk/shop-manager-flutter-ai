<?php
  require_once("t-sale.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Sale Invoice</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="t-sale.php">New Sale</a></li>
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


                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">

                              <?php
                                $invoice_qry="select * from `sale_invoices` where `id`='$_GET[id]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

                                if ($res = $db->query($invoice_qry)) {

                                    /* Check the number of rows that match the SELECT statement */
                                    if ($res->fetchColumn() > 0) {


                                        foreach ($db->query($invoice_qry) as $row) {
                                          ?>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row d-print-block ">

                                        <div class="col-12">
                                          <h1 class="text-center"><?=$_SESSION['sess_bp_name']?></h1>
                                        </div>

                                        <div class="col-12">
                                          <h5 class="text-center"><?=$_SESSION['sess_bp_username']?></h5>
                                        </div>
                                        <div class="col-12">
                                          <h5 class="text-center"><?=$_SESSION['sess_bp_adr']?></h5>
                                        </div>
                                      </div>

                                      <div class="row border-box">

                                        <div class="col-4">
                                          <label for="customer_number"><b>صارف </b></label>
                                          <p><?=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'name')?> (<?=$row['contact_number']?>)</p>
                                        </div>

                                        <div class="col-4">
                                          <label for="date"><b>تاریخ </b></label>
                                          <p><?=$row['date']?></p>
                                        </div>

                                        <div class="col-4">
                                          <label for="invoiceid"><b>رسید نمبر </b></label>
                                          <p>#<?=$row['id']?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>شے کا نام</th>
                                                <th>سپلائی</th>
                                                <th>یونٹ پیمائش</th>
                                                <th>مقدار</th>
                                                <th>کل</th>
                                              </tr>
                                            </thead>
                                            <tbody id="cart_items">
                                              <?php

                                              $cartitems_json=$row['cartitems'];
                                              $variants_items=json_decode($row['variants_json'],true);
                                              //print_r($variants_items);

                                              $items_array = json_decode($cartitems_json, true);

                                              $secondary_json = json_decode($row['secondary_json'],true);


                                              $secondary_array = [];

                                              if(is_array($secondary_json))
                                              {
                                                if(count($secondary_json)>0)
                                                {
                                                  foreach($secondary_json as $s_key => $s_value)
                                                  {
                                                    $secondary_array[$s_value['item_id']]=$s_value['secondary_html'];
                                                  }
                                                }
                                              }

                                              //print_r($secondary_json);
                                              //print_r($secondary_array);

                                              foreach ($items_array as $key => $value) {
                                                // code...
                                                ?>
                                                  <tr>
                                                    <td><?=$value['item_id']?></td>
                                                    <td><?=gnr($db,"products",'id',$value['item_id'],'name')?>
                                                      <ul class="list-group variants_cart">
                                                        <?php
                                                        if(is_array($variants_items))
                                                        {
                                                          foreach($variants_items as $v_key => $v_value)
                                                          {
                                                            if($v_value['item_id']==$value['item_id'])
                                                            {
                                                              echo '<li class="list-group-item">'.$v_value['variant_qty'].' X '.gnr($db,'product_variants','id',$v_value['variant_id'],'name').'</li>';
                                                            }
                                                          }
                                                        }
                                                        ?>
                                                      </ul>
                                                      <ul class="list-group secondary_cart">
                                                        <?php if(array_key_exists($value['item_id'],$secondary_array))
                                                            {
                                                              echo $secondary_array[$value['item_id']];
                                                            }
                                                           ?>
                                                      </ul>

                                                </td>
                                                    <td><?=$row['custom_fields']?></td>
                                                    <td><?=$value['unit_measure']?></td>
                                                    <td><?=$value['row_qty']?></td>
                                                    <td><?=$value['row_rate']*$value['row_qty']?></td>
                                                  </tr>
                                                <?php
                                              }



                                              ?>

                                            </tbody>
                                            </table>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-6">
                                          <label for="sub_total"> <b>سب ٹوٹل </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['sub_total']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-6">
                                            <label for="discount"> <b>چھوٹ </b></label>
                                          </div>
                                          <div class="col-6 text-right">
                                            <p><?=$row['discount']?></p>
                                          </div>
                                        </div>

                                      <div class="row">
                                          <div class="col-6">
                                            <label for="tax"> <b>ٹیکس </b></label>
                                          </div>
                                          <div class="col-6 text-right">
                                            <p><?=$row['tax']?></p>
                                          </div>
                                        </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="grand_total"> <b><u>مجموعی عدد</u></b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><strong><u><?=$_SESSION['sess_bp_currency']?> <?=$row['grand_total']?></u></strong></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="amount_paid"> <b>رقم موصول ہوئی </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['amount_paid']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="payment_method"> <b>ادائیگی کا طریقہ </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=gnr($db,"chartofaccount",'id',$row['payment_method'],'account_head')?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="remaining_balance"> <b>یہ بل باقی بچ جانے والا بیلنس </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['remaining_amount']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="remaining_balance"> <b>کل بیلنس </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'balance')?> <?php echo $balance_status = gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'balance_status');

                                          if($balance_status=='debit')
                                          { echo ' ( Payable )';}else{
                                            echo ' ( Receivable )';
                                          }
                                          ?>  </p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-12">
                                          <p><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                        </div>
                                      </div>

                                      <div class="row d-print-none">
                                        <div class="col-6">
                                          <label for="notes"> <b>نوٹ </b></label>
                                        </div>
                                        <div class="col-6">
                                          <p><?=$row['notes']?></p>
                                        </div>
                                      </div>
                                      <div class="row d-none d-print-block text-center">
                                        <div class="text-center"><p class=" text-center">www.BasePlan.pk کے ذریعہ تیار کردہ سافٹ ویئر</p></div>
                                      </div>
                                      <div class="row d-print-none">
                                        <div class="col-sm-6"><a href="t-sale.php" id="new_sale" class="btn btn-warning d-print-none">Add New Sale</a></div>
                                        <div class="col-sm-6">
<?php
$msg_start='Dear customer,
 Your bill added to your account
 Date: '.$row['date'].' ';

$item_details='
 Item Details:

';

foreach ($items_array as $key => $value) {
$item_details.=' '.gnr($db,"products",'id',$value['item_id'],'name').' '.$value['row_qty'].' @ '.$value['row_rate'].' = '.($value['row_rate']*$value['row_qty']).'
';
}


$msg_mid='
 Amount: '.$row['grand_total'].'
 Received: '.$row['amount_paid'].'
 Balance: '.$row['remaining_amount'].'
 Total Balance: '.gnrm($db,'ledger',"`account_id`='c$row[contact_number]' and `owner_mobile`='$_SESSION[sess_bp_username]' order by `id` desc",'balance').'
';
$msg_end=' Powered by BasePlan.pk';

$short_msg  = $msg_start.$msg_mid.$msg_end;
$long_msg   = $msg_start.$item_details.$msg_mid.$msg_end;

$whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row['contact_number'])).'?text='.urlencode($long_msg);
?>

                                          <a href="sms:<?=$row['contact_number']?>?&body=<?=$short_msg?>" id="smsbtn" class="btn btn-primary pull-right d-print-none">Short SMS</a>
                                          <a href="<?=$whatsapp_link?>" target="_blank" class="btn btn-success pull-right d-print-none">Whatsapp</a>
                                          <a href="sms:<?=$row['contact_number']?>?&body=<?=$long_msg?>" id="smsbtn" class="btn btn-primary pull-right d-print-none">Long SMS</a>
                                          <a href="#" id="printbtn" class="btn btn-inverse pull-right d-print-none">Print</a></div>
                                      </div>
                                </form>
<?php                              }
                          }
                          /* No rows matched -- do something else */
                          else {
                              print "No rows matched the query.";
                          }
                      }




                     ?>
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

        function PrintElem(elem) {
            Popup(jQuery(elem).html());
        }

        function Popup(data) {
            var mywindow = window.open('', 'my div', 'height=400,width=600');
            mywindow.document.write('<html><head><title>Invoice: #<?=$row['id']?></title>');
            mywindow.document.write('<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" type="text/css" />');
            mywindow.document.write('<style type="text/css">.form-horizontal{width: 100%;} .row{ margin-top: 10px; margin-bottom: 10px;} .border-box{ border: 1px solid #000; padding:15px;} .clearfix{ clear:both;} .list-group-item{border:0 !important;}</style></head><body>');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.print();
        }



        $("#printbtn").click(function(e){
          e.preventDefault();
          var data = $(".col-12").html();
          Popup(data);
          return false;
        });

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
