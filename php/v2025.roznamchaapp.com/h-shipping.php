<?php
  require_once("t-shipping.config.php");
  $meta['info']['title']='Shipping Prints History';
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
                <div>
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

                              <div class="table-responsive m-t-40" id="no-more-tables">

                              <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Contact Number</th>
                                        <th>Date</th>
                                        <th>Total Expense</th>
                                        <th>Picker Guy</th>
                                        <th class="d-none">Action</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php

                                  $where = 'and 1 = 1 ';
                                  $total_expense=0;

                                  if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                  {
                                    $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                    $where.= " and `date` <= '$_GET[to_date]' ";
                                  }
                                  if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                  {
                                    $where.= " and `date` >= '$_GET[from_date]' ";
                                  }


                                    $select_qry="select * from `shipping_receipt_history` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' $where order by `id` desc";
                                    foreach ($db->query($select_qry) as $row) {
                                   ?>

                                    <tr class="row_<?=$row['id']?>">
                                      <td class="bolder" data-title="ID: "><?=$row['id']?>
                                        <a rel="<?=$row['id']?>" href="#" onclick='return show_shipping("<?=$row['id']?>");' class="text-info pull-right btn-view-shipping" title="" data-toggle="tooltip" data-original-title="View"><i class="ti-eye"></i></a>
                                      </td>
                                      <td data-title="Contact Number: "><?=$row['contact_number']?></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Expense: "><?=$row['total_expense']?></td>
                                      <td data-title="picker guy: "><?=$row['picker_guy']?></td>
                                      <td class="d-none"><a href="h-shipping-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">View Details</a></td>
                                    </tr>
                                    <?php
                                    }
                                   ?>
                                </tbody>
                            </table>





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
                                        <h1 class="print_center">Shipping Order <span class="print_shipping_id"></span></h1>
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
        $("#total_expense").html("<?=$total_expense?>");

        // $( ".btn-view-shipping" ).click(function(e) {
        //   e.preventDefault();
        //   // alert( "Handler for .click() called." );
        // });

  function show_shipping(id)
  {
    // alert(id);

    $.ajax({
      url: "h-shipping-get-data.php",
      type: "GET",
      data: {
        invoiceId: id // Replace with the actual invoice ID
      },
      dataType: "json",
      success: function(data) {
        // Handle the JSON response
        console.log(data);
        // Access and manipulate the retrieved data as needed

        //
        $(".print_shipping_id").html(data.msg[0].id);
        $(".print_shipping_company").html(data.msg[0].shipping_company);
        $(".print_pickup_person").html(data.msg[0].picker_guy);
        $(".print_customer_phone").html(data.msg[0].contact_number);
        $(".print_customer_name").html(data.msg[0].customer_shop_name);
        $(".print_address").html(data.msg[0].customer_shop_address);
        //
        $("#print_unit1").html(data.msg[0].unit1);
        $("#print_unit2").html(data.msg[0].unit2);
        $("#print_unit3").html(data.msg[0].unit3);
        $("#print_unit4").html(data.msg[0].unit4);
        $("#print_unit5").html(data.msg[0].unit5);
        $("#print_unit6").html(data.msg[0].unit6);
        $("#print_unit7").html(data.msg[0].unit7);

        $("#print_qty1").html(data.msg[0].qty1);
        $("#print_qty2").html(data.msg[0].qty2);
        $("#print_qty3").html(data.msg[0].qty3);
        $("#print_qty4").html(data.msg[0].qty4);
        $("#print_qty5").html(data.msg[0].qty5);
        $("#print_qty6").html(data.msg[0].qty6);
        $("#print_qty7").html(data.msg[0].qty7);
        //
        // $("#print_qty_total").html(data.msg[0].);
        // // alert(sum_qty);
        //
        $("#print_amount").html(data.msg[0].total_expense);
        $(".print_date").html(data.msg[0].date);
        //
        $('#invoice_response_modal').modal('show');


      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.error("AJAX Error: " + status + " - " + error);
        // Handle any errors that occurred during the request
      }
    });

    return false;
  }
</script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
