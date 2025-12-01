<?php
  header('Content-Type: text/html; charset=utf-8');

  require_once("t-sale.config.php");
  $meta['info']['title']='View Invoice';
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles d-print-none">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="t-sale.php">New Invoice</a></li>
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
                  <select class="form-control d-print-none" name="print_default_template" id="print_default_template" required="required">
                    <?php
                      foreach ($list_print_templates as $key => $value) {
                        // code...
                        ?>
                          <option value="<?=$value?>"><?=$value?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <script type="text/javascript">
                    $("#print_default_template").val('<?=gnr($db,'users','number',$_SESSION['sess_bp_username'],'print_default_template')?>');
                    $(document).on('change','#print_default_template',function(){
                      var new_print_class = $("#print_default_template").val();
                      $("#print_size").attr('class','print_size_'+new_print_class);
                    });
                  </script>


                    <div class="col-12 print_area">
                        <div class="card" style="background:#fff;">
                          <div id="print_size" class="print_size_<?=gnr($db,'users','number',$_SESSION['sess_bp_username'],'print_default_template')?>">
                            <div class="card-body">

                              <?php
                                $invoice_qry="select * from `sale_invoices` where `id`='$_GET[id]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

                                if ($res = $db->query($invoice_qry)) {

                                    /* Check the number of rows that match the SELECT statement */
                                    if ($res->fetchColumn() > 0) {


                                        foreach ($db->query($invoice_qry) as $row) {
                                          ?>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">

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
                                          <label for="customer_number"><b>Customer</b></label>
                                          <p><?=$customer_name=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'name')?> <br /><?=str_replace("+",'',str_replace('-','',$row['contact_number']))?></p>
                                        </div>

                                        <div class="col-4">
                                          <label for="date"><b>Date</b></label>
                                          <p><?=$row['date']?></p>
                                        </div>

                                        <div class="col-4">
                                          <label for="invoiceid"><b>Invoice</b></label>
                                          <p>#<?=$row['id']?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php
                                    $cartitems_json=$row['cartitems'];
                                    $variants_items=json_decode($row['variants_json'],true);
                                    //print_r($variants_items);

                                    $items_array = json_decode($cartitems_json, true);

                                    $secondary_json = json_decode($row['secondary_json'],true);
                                    $secondary_array = [];

                                    $services_cart_item=$row['cart_items_services'];

                                    $services_cart_item_array = json_decode($services_cart_item,true);
                                    if(is_array($items_array))
                                    {
                                    ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                              <tr>
                                                <th class="sr_number"  >#</th>
                                                <th >Product Name</th>
                                                <th >Unit Price</th>
                                                <th  class="unit_measure">Unit Measure</th>
                                                <th >Qty</th>
                                                <th >Total</th>
                                              </tr>
                                            </thead>
                                            <tbody id="cart_items">
                                              <?php


                                              if(is_array($secondary_json))
                                              {
                                                if(count($secondary_json)>0)
                                                {
                                                  foreach($secondary_json as $s_key => $s_value)
                                                  {
                                                    if(isset($s_value['secondary_html']))
                                                    {
                                                      $secondary_array[$s_value['item_id']]=$s_value['secondary_html'];
                                                    }
                                                  }
                                                }
                                              }

                                              //print_r($secondary_json);
                                              //print_r($secondary_array);
                                              if(is_array($items_array))
                                              {
                                              foreach ($items_array as $key => $value) {
                                                // code...
                                                ?>
                                                  <tr>
                                                    <td  class="sr_number"><?=$value['item_id']?></td>
                                                    <td ><?=gnr($db,"products",'id',$value['item_id'],'name')?>
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
                                                    <td ><?=$value['row_rate']?></td>
                                                    <td  class="unit_measure"><?=$value['unit_measure']?></td>
                                                    <td ><?=$value['row_qty']?></td>
                                                    <td ><?=$value['row_rate']*$value['row_qty']?></td>
                                                  </tr>
                                                <?php
                                              }
                                            }


                                              ?>

                                            </tbody>
                                            </table>
                                        </div>
                                      </div>
                                      <?php
                                        }
                                        if(is_array($services_cart_item_array) && (count($services_cart_item_array)>0))
                                        {
                                          ?>
                                            <div class="row">
                                              <div class="col-12">
                                                <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                                  <thead>
                                                  <tr>
                                                    <th class="sr_number"  >#</th>
                                                    <th >Service Name</th>
                                                    <th >Unit Price</th>
                                                    <th >Qty</th>
                                                    <th >Total</th>
                                                  </tr>
                                                </thead>
                                                <tbody id="services_cart_item">
                                                  <?php
                                                  $s_counter = 1;
                                                  foreach ($services_cart_item_array as $key => $value) {
                                                    // code...
                                                    ?>
                                                      <tr>
                                                        <td><?=$s_counter?></td>
                                                        <td><?=gnr($db,'services','id',$value['service_id'],'name')?></td>
                                                        <td><?=$value['sale_price']?></td>
                                                        <td><?=$value['qty']?></td>
                                                        <td><?=$_SESSION['sess_bp_currency']?> <?=$value['this_total']?></td>
                                                      </tr>
                                                    <?php
                                                    $s_counter++;
                                                  }
                                                   ?>
                                                </tbody>
                                              </table>

                                              </div>
                                            </div>
                                          <?php
                                        }
                                      ?>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="sub_total"> <b>Sub Total </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['sub_total']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-6">
                                            <label for="discount"> <b>Discount </b></label>
                                          </div>
                                          <div class="col-6 text-right">
                                            <p><?=$row['discount']?></p>
                                          </div>
                                        </div>

                                      <div class="row">
                                          <div class="col-6">
                                            <label for="tax"> <b>Tax </b></label>
                                          </div>
                                          <div class="col-6 text-right">
                                            <p><?=$row['tax']?></p>
                                          </div>
                                        </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="grand_total"> <b><u>Grand Total</u></b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><strong><u><?=$_SESSION['sess_bp_currency']?> <?=$row['grand_total']?></u></strong></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="amount_paid"> <b>Amount Received </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['amount_paid']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="payment_method"> <b>Payment Method </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$payment_method=gnr($db,"chartofaccount",'id',$row['payment_method'],'account_head')?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="remaining_balance"> <b>Invoice Remaining Balance </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$row['remaining_amount']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-6">
                                          <label for="remaining_balance"> <b>Total Balance </b></label>
                                        </div>
                                        <div class="col-6 text-right">
                                          <p><?=$new_balance=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'balance')?> <?php echo $balance_status = gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'balance_status');

                                          if($balance_status=='debit')
                                          { echo ' ( Payable )';}else{
                                            echo ' ( Receivable )';
                                          }
                                          ?>  </p>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-6">
                                          <label for="notes"> <b>Notes </b></label>
                                        </div>
                                        <div class="col-6">
                                          <p><?=$row['notes']?></p>
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-12">
                                          <p><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                        </div>
                                      </div>

                                      <div class="row d-none d-print-block text-center">
                                        <div class="text-center"><p class=" text-center">Powered by www.BasePlan.pk</p></div>
                                      </div>


                                      <div class="row">
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


<?php
$msg_start='Dear customer,
 Your bill added to your account
 Date: '.$row['date'].' ';

$item_details='
 Item Details:

';
if(is_array($items_array))
{
foreach ($items_array as $key => $value) {
$item_details.=' '.gnr($db,"products",'id',$value['item_id'],'name').' '.$value['row_qty'].' @ '.$value['row_rate'].' = '.($value['row_rate']*$value['row_qty']).'
';
}
}

$msg_mid='
 Amount: '.$row['grand_total'].'
 Received: '.$row['amount_paid'].'
 Balance: '.$row['remaining_amount'].'
 Total Balance: '.gnrm($db,'ledger',"`account_id`='c$row[contact_number]' and `owner_mobile`='$_SESSION[sess_bp_username]' order by `id` desc",'balance').'
';
$msg_end=' Powered by BasePlan.pk '. $_SESSION['sess_bp_name'];

$short_msg  = $msg_start.$msg_mid.$msg_end;
$long_msg   = $msg_start.$item_details.$msg_mid.$msg_end;

$whatsapp_msg = "Dear *$customer_name*

This bill total amount is *".number_format($row['grand_total'], 2)."*

Receipt No: ".$_GET['id']."
Date: ".$row['date']."
========================
";
if(is_array($items_array))
{
foreach ($items_array as $key => $value) {
  $whatsapp_msg.="
  ".gnr($db,"products",'id',$value['item_id'],'name')."
  ".$value['row_qty']." @ ".$value['row_rate']."              ".number_format($value['row_qty']*$value['row_rate'], 2)."
  ";
}
}

$whatsapp_msg.="

-------------------------
Sub total        ".number_format($row['sub_total'], 2)."
-------------------------
Discount        ".number_format($row['discount'], 2)."
Total           ".$_SESSION['sess_bp_currency']." *".number_format(floatval($row['grand_total']), 2)."*
========================
Payment Method: ".$payment_method."

*New Balance: ".$_SESSION['sess_bp_currency']." ".number_format(floatval($new_balance), 2)."*

*".trim($_SESSION['sess_bp_name'])."*
Address: ".$_SESSION['sess_bp_adr']."
Call: ".$_SESSION['sess_bp_username']."

Software by www.baseplan.pk
Thank you, Visit again.";

$whatsapp_link = 'https://api.whatsapp.com/send?phone='.str_replace('-','',str_replace('+','',$row['contact_number'])).'&text='.urlencode($whatsapp_msg);
?>
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

                            <div class="row d-print-none">
                              <div class="col-sm-6"><a href="t-sale.php" id="new_sale" class="btn btn-warning d-print-none">Add New Sale</a>
                                <?php
                                  if($_SESSION['sess_bp_privs']=='*')
                                 {
                                ?>
                                <a href="#" rel="<?=$_GET['id']?>" class="btn btn-danger btn-sm delete_btn">Delete</a>
                                <a href="t-sale-Invoice-edit.php?id=<?=$_GET['id']?>" rel="Edit" class="btn btn-primary btn-sm edit_btn">Edit</a>
                              <?php } ?>
                              </div>
                              <div class="col-sm-6">
                                <a href="sms://<?=$row['contact_number']?>/?&body=<?=($short_msg)?>" id="smsbtn" class="btn btn-primary pull-right d-print-none">Short SMS</a>
                                <a href="<?=$whatsapp_link?>" target="_blank" class="btn btn-success pull-right d-print-none">Whatsapp</a>
                                <a href="sms://<?=$row['contact_number']?>/?&body=<?=($long_msg)?>" id="smsbtn" class="btn btn-primary pull-right d-print-none">Long SMS</a>
                                <a href="#" id="printbtn" class="btn btn-inverse pull-right d-print-none">Print</a>
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
            <footer class="footer d-print-none"><?=$footer_note?></footer>
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

            mywindow.document.write('<style type="text/css" media="all">.form-horizontal{width: 100%;} body{margin:0 0 0 5%; padding:10%;}  .border-box{ border: 1px solid #000; padding:15px;} .clearfix{ clear:both;} .list-group-item{border:0 !important;} .print_size_A4 h1{font-size: 6vw;} .print_size_A4 h5{font-size: 3vw;}</style>');

            mywindow.document.write('<style type="text/css" media="all"> .print_size_A5 .table-bordered td, .print_size_A5 .table-bordered th{border:1pt solid #000 !important;} .print_size_A5 .border-box{ border: none;} .print_size_A5 h1{font-size: 6vw;} .print_size_A5 h5{font-size: 3vw;}</style>');

            mywindow.document.write('<style type="text/css" media="all"> .print_size_Thermal_80mm h1{font-size: 6vw !important; text-align:center;}  .print_size_Thermal_80mm h5{font-size: 3vw;}  .print_size_Thermal_80mm h5{font-size: 10px !important; text-align:center;} .print_size_Thermal_80mm .border-box{border:none;} .print_size_Thermal_80mm label, .print_size_Thermal_80mm p{ font-size:14px;} .print_size_Thermal_80mm .col-4{ width:33%; float:left;} .print_size_Thermal_80mm .row{ padding:0; margin:0;} .print_size_Thermal_80mm .col-6{float:left; width:49%; } .print_size_Thermal_80mm .col-6:even{text-align:right; } .print_size_Thermal_80mm table{ padding: 2px; cell-spacing:0; cell-padding:2px; width:100%; font-size: 14px;} .print_size_Thermal_80mm .unit_measure,  .print_size_Thermal_80mm .sr_number {display:none;} .print_size_Thermal_80mm th, .print_size_Thermal_80mm td{ font-size:12px;} .print_size_Thermal_80mm div, .print_size_Thermal_80mm h1, .print_size_Thermal_80mm h2, .print_size_Thermal_80mm h3, .print_size_Thermal_80mm h4, .print_size_Thermal_80mm h5, .print_size_Thermal_80mm h6, .print_size_Thermal_80mm p, .print_size_Thermal_80mm ul, .print_size_Thermal_80mm ol, .print_size_Thermal_80mm li, .print_size_Thermal_80mm tr, .print_size_Thermal_80mm th, .print_size_Thermal_80mm td{padding:0; margin:0; font-weight:bold;} body{display: block; margin: 0 auto;background: #fff;width: 99%; padding: 1px;clear: both;overflow: hidden;}@media print {  .pagebreaker {page-break-after: always;}}</style>');

            mywindow.document.write('</head><body>');
            mywindow.document.write(data);
            mywindow.document.write('</body></`html`>');
            mywindow.document.close();
            mywindow.print();
        }

        $(document).on('click','#print__btn_2',function(e){
            e.preventDefault();
            window.print();
        });

        $("#printbtn").click(function(e){
          e.preventDefault();
          var data = $(".col-12").html();
          Popup(data);
          return false;
        });

        function isValidJSONString(str)
        {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }

        $(document).on('click','.delete_btn',function(e)
        {

          e.preventDefault();
          $('.preloader').show();

          var formdata = {"invoiceid":'<?=$_GET['id']?>'};
          $.post( "t-sale-delete.process.php", formdata)
            .done(function( data ) {
              if(isValidJSONString(data))
              {
                var response = jQuery.parseJSON( data );
                if(response.code == 200){

                    swal({
                       title: 'Submited!',
                       text: 'Record has been Deleted successfully.',
                       timer: 2000,
                       type: 'success',
                       showConfirmButton: false
                    });
                    window.location.href='h-sale.php';


                }else{
                    $("#msgholder").html(response.msg);
                    $("#msgholder").removeClass('d-none');
                    $('.preloader').hide();
                }

              }else{
                $("#msgholder").html(data);
                $("#msgholder").removeClass('d-none');
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
        });

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
