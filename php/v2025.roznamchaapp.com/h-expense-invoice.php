<?php
  require_once("t-sale.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<script>
</script>
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

                                      <div class="row d-none d-print-block ">

                                        <div class="col-md-12">
                                          <h1 class="text-center"><?=$_SESSION['sess_bp_name']?></h1>
                                        </div>

                                        <div class="col-md-12">
                                          <h3 class="text-center"><?=$_SESSION['sess_bp_username']?></h3>
                                        </div>
                                      </div>

                                      <div class="row">

                                        <div class="col-md-6">
                                          <lable for="contact_name"><b>Customer Name</b></lable>
                                          <p><?=$row['contact_number']?></p>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date"><b>Date </b></label>
                                          <p><?=$row['contact_number']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12 block12">
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th width="20%">Unit Price</th>
                                                <th width="20%">Qty</th>
                                                <th>Total</th>
                                              </tr>
                                            </thead>
                                            <tbody id="cart_items">
                                              <?php

                                              $cartitems_json=$row['cartitems'];

                                              $items_array = json_decode($cartitems_json, true);

                                              foreach ($items_array as $key => $value) {
                                                // code...
                                                ?>
                                                  <tr>
                                                    <td><?=$value['item_id']?></td>
                                                    <td><?=gnr($db,"products",'id',$value['item_id'],'name')?></td>
                                                    <td><?=$value['row_rate']?></td>
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
                                        <div class="col-sm-6">
                                          <label for="sub_total"> <b>Sub Total </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['sub_total']?></p>
                                        </div>
                                      </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                          <label for="discount"> <b>Discount </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['discount']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="grand_total"> <b>Grand Total </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['grand_total']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="amount_paid"> <b>Amount Paid </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['amount_paid']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="payment_method"> <b>Payment Method </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['payment_method']?></p>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="remaining_balance"> <b>Remaining Balance </b></label>
                                        </div>
                                        <div class="col-sm-6">
                                          <p><?=$row['remaining_amount']?></p>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="d-none d-print-block  text-center"><p class=" text-center">Powered by www.BasePlan.pk</p></div>
                                        <div class="col-sm-6"><a href="#" id="resetbtn" class="btn btn-danger d-print-none">Cancel</a></div>
                                        <div class="col-sm-6"><a href="#" id="printbtn" class="btn btn-success pull-right d-print-none">Print</a></div>
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
            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write('<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" type="text/css" />');
            mywindow.document.write('<style type="text/css">.test { color:red; } </style></head><body>');
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
