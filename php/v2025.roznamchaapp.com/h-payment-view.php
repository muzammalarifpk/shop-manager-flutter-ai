<?php
  require_once("t-payments.config.php");
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

</style>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Payment Receipt</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="t-payments.php">New Payments</a></li>
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
                                $invoice_qry="select * from `payments` where `id`='$_GET[id]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

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
                                          <label for="contact_name"><b>Contact Name </b></label>
                                          <p><?=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]'",'name')?> (<?=$row['contact_number']?>)</p>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date"><b>Date </b></label>
                                          <p><?=$row['date']?></p>
                                        </div>
                                      </div>

                                      <div class="row">

                                        <div class="col-md-6">
                                          <label for="amount"><b>Amount </b></label>
                                          <p><?=$row['payment_type']?> <?=$row['amount']?> </p>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="amount"><b>Discount </b></label>
                                          <p><?=$row['discount']?> </p>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="payment_method"><b>Payment Method </b></label>
                                          <p><?=gnrm($db,'chartofaccount',"`owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$row[payment_method]'",'account_head')?> </p>
                                        </div>
                                      </div>

                                      <div class="row">

                                        <div class="col-md-12">
                                          <label for="description"><b>Description </b></label>
                                          <p><?=$row['description']?></p>
                                        </div>
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

                                      <div class="row">
                                        <div class="d-none d-print-block  text-center"><p class=" text-center">Powered by www.BasePlan.pk</p></div>
                                        <div class="col-sm-6">
                                          <a href="t-payments.php" id="new_sale" class="btn btn-warning d-print-none">Add New Payment</a>
                                          <?php if($row['status']=='Published' || $row['status']=='published')
                                          {
                                            ?>
                                          <a href="t-payments.delete.process.php" id="delete-payment" class="btn btn-sm btn-danger d-print-none" rel="<?=$_GET['id']?>">Delete</a>
                                        <?php } ?>
                                        </div>
                                        <div class="col-sm-6">
                                          <a href="sms:<?=$row['contact_number']?>?&body=<?=urlencode('Dear Customer%0aWe have successfully '.$row['payment_type'].' '.$row['amount'].' %0aDate: '.$row['date'].'%0aYour New Balance: '.gnrm($db,'ledger',"`account_id`='c$row[contact_number]' and `owner_mobile`='$_SESSION[sess_bp_username]' order by `id` desc",'balance').'%0a%0aPowered by BasePlan.pk')?>"
                                             id="smsbtn" class="btn btn-primary pull-right d-print-none">Send SMS</a>
                                          <a href="#" id="printbtn" class="btn btn-success pull-right d-print-none">Print</a></div>
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
        function isValidJSONString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }



        $("#printbtn").click(function(e){
          e.preventDefault();
          var data = $(".col-12").html();
          Popup(data);
          return false;
        });

        $(document).on('click','#delete-payment',function(e){
          e.preventDefault();
          $('.preloader').show();

          var payment_id = $(this).attr('rel');
          var formdata = {"invoiceid":payment_id};

          $.post( "t-payment-delete.process.php", formdata)
            .done(function( data ) {
              //alert(data);
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
                    window.location.href='h-payments.php';


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
