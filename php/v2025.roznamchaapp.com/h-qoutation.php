<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Qoutations History';
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<script>

function loadtdata(newname, newphone, newemail, newprivs, newstatus, newid)
{
  dtable.row.add(newname, newphone, newemail, newprivs, newstatus, newid ).draw(false);

}
function check_access_level_radio(clas)
{
  var val = $('.'+clas).val();

  if(val=='*'){
    $(".access_level #super_admin").removeClass('d-none');
    $(".access_level #co_admin").addClass('d-none');
  }else if (val=='coadmin') {
    $(".access_level #super_admin").addClass('d-none');
    $(".access_level #co_admin").removeClass('d-none');

  }
}

  $(document).ready(function(e){

    $('.access_level_select').click(function(){
      check_access_level_radio('access_level_select');
    });

    $('.access_level_select').on('change', function() {


      console.log("Changed one!");
      if ($(this).prop('checked', true)) {
        $('#id1,#id2,#id3').not(this).prop('checked', false);
      }
    });

    $(".editmodalbtn").click(function(e){
      e.preventDefault();
      var reqid=$(this).attr('rel');
      //  alert(reqid);
        $.get( "<?=$meta['module'][1]?>-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "<?=$meta['module'][1]?>-new.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });

    $('#editmodal').on('change',function(){
      if($(this).hasClass('show')){
        alert('shown');
      }else{
        alert('hidden');
      }

    });
  });

</script>
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
                        <div class="card">
                            <div class="card-body">
                              <div class="row">

                                <div class="col-md-12">
                                  <h4 class="card-title"><?=ucwords($meta['info']['title'])?></h4>
                                  <h6 class="card-subtitle"><?=ucwords($meta['info']['des'])?></h6>
                                </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-12">
                                    <h3>Customize Qoutations History</h3>
                                    <form action="" class="" method="get">
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="">From Date</label>
                                              <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date'] ?? ''?>">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="">To Date</label>
                                              <input type="date" name="to_date" class="form-control" id="to_date" value="<?=$_GET['to_date'] ?? ''?>">
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <div class="form-actions">
                                          <button type="submit" class="btn btn-info pull-right"> Submit</button>
                                      </div>
                                    </form>
                                  </div>

                              </div>

                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table class="nowrap table table-hover table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Qoutations Count</th>
                                      <th>Total</th>
                                      <th>Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td data-title="Qoutations Count" id="sales_count"></td>
                                      <td data-title="Total" id="total_sale"></td>
                                      <td data-title="Total Received" id="total_received"></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Contact Number</th>
                                        <th>Grand total</th>
                                        <th>Amount Paid</th>
                                        <th>Remaining</th>
                                        <th>Payment Method</th>
                                      </tr>
                                  </thead>
                                </tfoot>
                                <tbody>
                                  <?php
                                  $where = 'and 1 = 1 ';

                                  if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                  {

                                    $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                    $where.= " and `date` <= '$_GET[to_date]' ";
                                  }
                                  if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                  {
                                    $where.= " and `date` >= '$_GET[from_date]' ";
                                  }

                                    $select_qry="select * from `sale_quotations` where `owner_mobile`='$_SESSION[sess_bp_username]' $where $all_status_where order by `id` desc";

                                    $total_sale=0;
                                    $sales_count=0;
                                    $total_received=0;

                                    $contacts_fatched=[];
                                    foreach ($db->query($select_qry) as $row) {
                                      $sales_count++;
                                      $total_sale+=intval($row['grand_total']);
                                      $total_received+=intval($row['amount_paid']);
                                      $contact_where = "`number` = '$row[contact_number]' and `owner_mobile`='$_SESSION[sess_bp_username]'";
                                      if(!in_array($row['contact_number'],$contacts_fatched))
                                      {
                                        $contacts_fatched[$row['contact_number']]=gnrm($db,'contacts',$contact_where,'name');
                                      }
                                   ?>
                                    <tr <?php if($row['status']=='delete'){ echo 'class="text-danger"';} ?>>
                                      <td data-title="ID: #" class="bolder num"><?=$row['id']?><br /><a href="h-sale-quote.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning view_invoice_btn" rel="<?=$row['id']?>" >View</a></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Contact: "><?=$contacts_fatched[$row['contact_number']]?><br /><?=$row['contact_number']?></td>
                                      <td data-title="Total: "><?=$row['grand_total']?></td>
                                      <td data-title="Received: "><?=$row['amount_paid']?></td>
                                      <td data-title="Remaining: "><?=$row['remaining_amount']?></td>
                                      <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                    </tr>
                                    <?php
                                    }
                                   ?>
                                </tbody>
                            </table>
                            </div>
                            <br>
                            <p>
                              <a href="h-sale.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                              <a href="h-sale.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div id="invoice_response_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="invoice_response_modal" aria-hidden="true" style="">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Qoutation ID <span class="invoice_id">N/A</span></h4>
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
                                      <h1 class="print_center">Sale Qoutation</h1>
                                    </div>
                                    <div class="print_row">
                                      <div class="print_half">
                                        <h2>Bill to:</h2>
                                        <h3>Name: <span class="print_customer_name">N/A</span></h3>
                                        <h3>Phone: <span class="print_customer_phone">N/A</span></h3>
                                      </div>
                                      <div class="print_half">
                                        <h2>&nbsp;</h2>
                                        <h3 class="">Qoutation ID: <span class="print_invoice_no print_pull_right">N/A</span></h3>
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
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Tax</th>
                                            <th>Unit Measure</th>
                                            <th>Qty</th>
                                            <th>Total</th>
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
                                            <th colspan="5" class="print_number">Total</th>
                                            <th class="print_number" id="print_items_total_qty">0.00</th>
                                            <th class="print_number" id="print_items_total_price">0.00</th>
                                          </tr>
                                        </tfoot>
                                      </table>

                                      <table id="print_services" class="print_table">
                                        <thead class="print_inverse">
                                          <th>#</th>
                                          <th>Service Name</th>
                                          <th>Unit Price</th>
                                          <th>Qty</th>
                                          <th>Total</th>
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
                                    </div>
                                    <div class="print_row">
                                      <div class="print_half">
                                        <p>Notes</p>
                                        <p id="print_notes"></p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>


                                        <h3>____________________</h3>
                                        <h3>Authorized Signatory</h3>

                                      </div>
                                      <div class="print_half">
                                        <h3>Sub Total: <span class="print_pull_right" id="print_sub_total">0.00</span></h3>
                                        <h3>Discount: <span class="print_pull_right" id="print_discount">0.00</span></h3>
                                        <h3>Tax: <span class="print_pull_right" id="print_tax">0.00</span></h3>
                                        <h2 class="print_inverse">Grand Total: <span id="print_grand_total" class="print_pull_right">0.00</span><span class="print_pull_right"><?=$_SESSION['sess_bp_currency']?>&nbsp; </span></h2>
                                        <h3>Payment Method: <span class="print_pull_right" id="print_payment_method">N/A</span></h3>
                                        <h3>Amount Received: <span class="print_pull_right" id="print_amount_recieived">0.00</span></h3>
                                        <h3>Remaining Amount: <span class="print_pull_right" id="print_invoice_balance">0.00</span></h3>
                                        <h3>Old Balance: <span class="print_pull_right" id="print_old_balance">0.00</span></h3>
                                        <h3>Total Balance: <span class="print_pull_right" id="print_total_balance">0.00</span></h3>
                                      </div>
                                      <div class="print_clearfix"></div>
                                    </div>
                                    <div class="print_row">
                                      <p>&nbsp;</p>
                                      <p>&nbsp;</p>
                                    </div>
                                    <div class="print_row print_footer">
                                      <p class="print_center"><?=$_SESSION['sess_bp_print_footer_note']?></p>
                                    </div>
                                    <div class="print_row">
                                      <div class="print_center"><p class="print_center">Powered by www.BasePlan.pk</p></div>
                                    </div>
                                  </div>
                                </div>


                            </div>
                          </div>
                          <div class="modal-footer">
                            <a type="button" class="btn btn-warning waves-effect waves-light pull-left invoice_link" href="h-sale.php">View Invoice</a>
                            <a type="button" target="_blank" class="btn btn-success waves-effect waves-light pull-left whatsapp_link" href="#whatsapp">WhatsApp</a>

                            <a type="button" class="btn btn-inverse waves-effect waves-light pull-left sms_summary" href="#sms_summary">SMS Summary</a>
                            <a type="button" class="btn btn-inverse waves-effect waves-light pull-left sms_details" href="#sms_details">SMS Details</a>
                            <button type="button" id="print_printable" class="btn btn-info waves-effect waves-light pull-right print_printable">Print</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script type="text/javascript" src="js/invoice.js"></script>
    <script type="text/javascript" src="js/print.min.js"></script>
    <script type="text/javascript">
      $("#sales_count").html("<?=$sales_count?>");
      $("#total_sale").html("<?=$total_sale?>");
      $("#total_received").html("<?=$total_received?>");

      $(document).on('click','.view_invoice_btn',function(e){
        e.preventDefault();
        var inv_id = $(this).attr('rel');
        view_invoice('sale_quotations',inv_id);

      });
      $(document).on('click','#print_printable',function(e){
        e.preventDefault();
        $('.preloader').show();
//          alert('sending print.');
        printJS('invoice_printable_area', 'html');
        $('.preloader').hide();
      });

      $(document).on('click','.delivery_mode',function(e){
        return enable_domode();
      });


      function enable_domode()
      {
        $('.do_mode').toggleClass('hide');
        $('#invoice_totals').toggle();
        return false;
      }

              $(document).on('click','.delete_btn',function(e)
              {

                e.preventDefault();
                $('.preloader').show();

                var this_id = $(this).attr('rel');

                var formdata = {"invoiceid":this_id};
                $.post( "t-sale-qoutation-delete.process.php", formdata)
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
                          window.location.href='h-qoutation.php';


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
</body>
</html>
