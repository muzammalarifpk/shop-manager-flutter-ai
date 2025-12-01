<?php
  require_once("t-sale.config.php");
  $report_date = ' select report date';
  if(isset($_GET['date']))
  {
    $report_date = date('d-M-Y',strtotime($_GET['date']));
  }else{
    $report_date = date('d-M-Y');
  }
  $today_date =  date('Y-m-d',strtotime($report_date));
  $meta['info']['title']='Daily Report '.$report_date;
  $meta['info']['des']='';
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


                              <div class="row form-material">
                                  <div class="col-4">
                                      <label class="m-t-20">Yesterday</label>
                                      <a href="r-daily-report.php?date=<?=date('d-M-Y',strtotime($report_date.' -1 day'))?>" class="btn btn-sm btn-info">Show <?=date('d-M-Y',strtotime($report_date.' -1 day'))?> Report</a>
                                  </div>
                                  <div class="col-4">
                                      <label class="m-t-20">Report Date</label>
                                      <input type="date" name="from_date" class="form-control" id="from_date" value="<?=date('Y-m-d',strtotime($report_date))?>" />
                                  </div>
                                  <div class="col-4">
                                    <label class="m-t-20">Tomorrow</label>
                                    <a href="r-daily-report.php?date=<?=date('d-M-Y',strtotime($report_date.' +1 day'))?>" class="btn btn-sm btn-info">Show <?=date('d-M-Y',strtotime($report_date.' +1 day'))?> Report</a>
                                  </div>
                              </div>
<?php

$totals['sales']['count']=0;
$totals['sales']['total']=0;
$totals['sales']['amount_paid']=0;
$totals['sales']['remaining_amount']=0;

$totals['purchases']['count']=0;
$totals['purchases']['total']=0;
$totals['purchases']['amount_paid']=0;
$totals['purchases']['remaining_amount']=0;

$totals['expenses']['count']=0;
$totals['expenses']['total']=0;
$totals['expenses']['amount_paid']=0;
$totals['expenses']['remaining_amount']=0;


$totals['payments']['count']=0;
$totals['payments']['paid']=0;
$totals['payments']['received']=0;

 ?>

                              <div class="table-responsive m-t-40" id="no-more-tables">

                                <div class="cashflow">
                                  <h2>Cash Flow</h2>

                                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable">
                                    <thead>
                                      <tr class="cf">
                                        <th>Account head</th>
                                        <th>Cash In</th>
                                        <th>Cash Out</th>
                                        <th>Balance</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $account_query="select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type`='cash' or `account_type`='bank' ) and (`status` = 'Published' or `status` = 'published')";
                                        $i=0;
                                        foreach ($db->query($account_query) as $account)
                                        {
                                          $i++;
                                          $ledger_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='".$account['id']."' ";


                                          $flow_account_qry_credit="select sum(`amount`) as flow_amount from ledger where $ledger_where and `date` like '$today_date%' and `amount_type`='credit' ";

                                          $flow_account_qry_debit="select sum(`amount`) as flow_amount from ledger where $ledger_where and `date` like '$today_date%' and `amount_type`='debit' ";


                                          $cashin=get_sum($db,$flow_account_qry_debit);
                                          if($cashin=='')
                                          {
                                            $cashin=0;
                                          }
                                          $cashout=get_sum($db,$flow_account_qry_credit);
                                          if($cashout=='')
                                          {
                                            $cashout=0;
                                          }
                                          $balance= $cashin-$cashout;
                                        ?>
                                        <tr>
                                          <td data-title="" class="bolder"><a href="r-ledgerview.php?id=<?=$account['id']?>"><?=$account['account_head']?></a></td>
                                          <td data-title="Cash In: "><?=$_SESSION['sess_bp_currency']?> <?php echo $cashin; ?></td>
                                          <td data-title="Cash Out: "><?=$_SESSION['sess_bp_currency']?> <?php echo $cashout; ?></td>
                                          <td data-title="Balance: "><?=$_SESSION['sess_bp_currency']?> <?php echo  $balance; ?></td>
                                        </tr>
                                      <?php
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>


                                <div class="sold-items">
                                  <h2>Sold Items</h2>
                                      <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                          <thead>
                                            <tr class="cf">
                                              <th>Name</th>
                                              <th>Sold Qty</th>
                                              <th>Total Price</th>
                                              <th>Total Profit</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $total_sold_stock=0;
                                              $total_sale=0;
                                              $total_profit=0;


                                              $select_qry="select sum(`qty`) as sold_qty,sum(`total_price`) as total_price, sum(`total_profit`) as total_profit, product_id, measuring_unit from `stock_history` where `owner_mobile`='$_SESSION[sess_bp_username]' and `in_out`='sale' and `date` = '$today_date' and (`status` = 'Published' or `status` = 'published') group by `product_id` order by `id` desc";

//                                            echo $select_qry;

                                              foreach ($db->query($select_qry) as $row)
                                              {
                                                $select_qry_return="select sum(`qty`) as sold_qty,sum(`total_price`) as total_price, sum(`total_profit`) as total_profit, product_id, measuring_unit from `stock_history` where `owner_mobile`='$_SESSION[sess_bp_username]' and `in_out`='sale_return' and `date` = '$today_date' and `product_id` = '$row[product_id]' and (`status` = 'Published' or `status` = 'published') group by `product_id` order by `id` desc";

                                                $row_return['sold_qty'] = 0;
                                                foreach ($db->query($select_qry_return) as $row_return)
                                                {
                                                      //print_r($row_return);
                                                }
                                                if($row_return['sold_qty']>0)
                                                {
                                                  $row['sold_qty']=$row['sold_qty']-$row_return['sold_qty'];
                                                  $row['total_price']=$row['total_price']-$row_return['total_price'];
                                                  $row['total_profit']=$row['total_profit']-$row_return['total_profit'];
                                                }
                                               ?>
                                                  <tr>
                                                    <td class="bolder"><?=gnr($db,'products','id',$row['product_id'],'name')?></td>
                                                    <td data-title="Qty: "><?=$row['sold_qty']?></td>
                                                    <td data-title="Total Price: "><?=$row['total_price']?></td>
                                                    <td data-title="Total Profit: "><?=$row['total_profit']?></td>
                                                  </tr>
                                                  <?php
                                                $total_sold_stock=$total_sold_stock+$row['sold_qty'];
                                                $total_sale=$total_sale+$row['total_price'];
                                                $total_profit=$total_profit+$row['total_profit'];
                                              }
                                             ?>
                                          </tbody>
                                      </table>

                                      <h2>Sale Stock Summary</h2>
                                      <table id="totals_table" class="table full-color-table full-info-table hover-table" cellspacing="0" width="100%">
                                          <thead>
                                            <tr class="cf">
                                              <th>Total Sold Stock</th>
                                              <th>Total Sale</th>
                                              <th>Total Gross Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td data-title="Total Stock sold: " id="total_sold_stock"><?=$total_sold_stock?></td>
                                            <td data-title="Total Sale: " id="total_sale"><?=$total_sale?></td>
                                            <td class="bolder" data-title="Profit: " id="total_profit"><?=$total_profit?></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>


                                <div class="sales">
                                  <h2>Sales</h2>
                                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Contact Number</th>
                                            <th>Grand total</th>
                                            <th>Amount Received</th>
                                            <th>Remaining</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                          </tr>
                                      </thead>
                                    <tbody>
                                      <?php
                                        $select_qry="select * from `sale_invoices` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$today_date'  and (`status` = 'Published' or `status` = 'published') order by `id` desc";

                                        foreach ($db->query($select_qry) as $row) {
                                          $totals['sales']['count']+=1;
                                          $totals['sales']['total']+=$row['grand_total'];
                                          $totals['sales']['amount_paid']+=$row['amount_paid'];
                                          $totals['sales']['remaining_amount']+=$row['remaining_amount'];

                                          ?>
                                          <tr>
                                            <td data-title="ID: #" class="bolder"><?=$row['id']?></td>
                                            <td data-title="Contact: "><?=gnr($db,'contacts','number',$row['contact_number'],'name')?><br /><?=$row['contact_number']?></td>
                                            <td data-title="Total: "><?=$row['grand_total']?></td>
                                            <td data-title="Received: "><?=$row['amount_paid']?></td>
                                            <td data-title="Remaining: "><?=$row['remaining_amount']?></td>
                                            <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                            <td data-title=""><a href="h-sale-invoice.php?id=<?=$row['id']?>" data-invoice_type="sale_invoices" rel="<?=$row['id']?>" class="btn btn-sm btn-secondary view_invoice_btn">View Invoice</a></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>

                                  <h2>Sales Summary</h2>
                                  <table id="totals_table" class="table full-color-table full-success-table hover-table">
                                    <thead>
                                        <tr class="cf">
                                          <th>Sales Count</th>
                                          <th>Total Sale</th>
                                          <th>Amount Received</th>
                                          <th>Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="bolder" id="" data-title="Sales Count:"> <?=$totals['sales']['count']?></td>
                                        <td id="" data-title="Total Sale: "><?=$totals['sales']['total']?></td>
                                        <td id="" data-title="Received: "><?=$totals['sales']['amount_paid']?></td>
                                        <td id="" data-title="Remaining: "><?=$totals['sales']['remaining_amount']?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>

                                <div class="purchases">
                                  <h2>Purchases</h2>
                                  <table id="example24" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Contact Number</th>
                                            <th>Grand total</th>
                                            <th>Amount Paid</th>
                                            <th>Remaining</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                          </tr>
                                      </thead>
                                    <tbody>
                                      <?php
                                        $select_qry="select * from `purchase_invoices` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$today_date'  and (`status` = 'Published' or `status` = 'published') order by `id` desc";

                                        foreach ($db->query($select_qry) as $row) {
                                          $totals['purchases']['count']+=1;
                                          $totals['purchases']['total']+=$row['grand_total'];
                                          $totals['purchases']['amount_paid']+=$row['amount_paid'];
                                          $totals['purchases']['remaining_amount']+=$row['remaining_amount'];

                                          ?>
                                          <tr>
                                            <td data-title="ID: #" class="bolder"><?=$row['id']?></td>
                                            <td data-title="Contact: "><?=gnr($db,'contacts','number',$row['contact_number'],'name')?><br /><?=$row['contact_number']?></td>
                                            <td data-title="Total: "><?=$row['grand_total']?></td>
                                            <td data-title="Received: "><?=$row['amount_paid']?></td>
                                            <td data-title="Remaining: "><?=$row['remaining_amount']?></td>
                                            <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                            <td data-title=""><a href="h-purchase-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-secondary">View Invoice</a></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>

                                  <h2>Purchases Summary</h2>
                                  <table id="totals_table" class="table full-color-table full-warning-table hover-table">
                                    <thead>
                                        <tr class="cf">
                                          <th>Purchases Count</th>
                                          <th>Total Purchase</th>
                                          <th>Amount Paid</th>
                                          <th>Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="bolder" id="" data-title="Purchases Count:"> <?=$totals['purchases']['count']?></td>
                                        <td id="" data-title="Total Purchases: "><?=$totals['purchases']['total']?></td>
                                        <td id="" data-title="Received: "><?=$totals['purchases']['amount_paid']?></td>
                                        <td id="" data-title="Remaining: "><?=$totals['purchases']['remaining_amount']?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>


                                <div class="expenses">
                                  <h2>Expenses</h2>
                                  <table id="example24" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Method</th>
                                          </tr>
                                      </thead>
                                    <tbody>
                                      <?php
                                        $select_qry="select * from `expense` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$today_date'  and (`status` = 'Published' or `status` = 'published') order by `id` desc";

                                        foreach ($db->query($select_qry) as $row) {
                                          $totals['expenses']['count']+=1;
                                          $totals['expenses']['total']+=$row['amount'];

                                          ?>
                                          <tr>
                                            <td data-title="ID: #" class="bolder"><?=$row['id']?></td>
                                            <td data-title="Type: "><?=$row['expense_type']?></td>
                                            <td data-title="Description: "><?=$row['description']?></td>
                                            <td data-title="Amount: "><?=$row['amount']?></td>
                                            <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>

                                  <h2>Expenses Summary</h2>
                                  <table id="totals_table" class="table full-color-table full-danger-table hover-table">
                                    <thead>
                                        <tr class="cf">
                                          <th>Expenses Count</th>
                                          <th>Total Expenses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="bolder" id="" data-title="Expenses Count:"> <?=$totals['expenses']['count']?></td>
                                        <td id="" data-title="Total Expenses: "><?=$totals['expenses']['total']?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>



                                <div class="payments">
                                  <h2>Payments Paid</h2>
                                  <table id="example24" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Contact</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Method</th>
                                          </tr>
                                      </thead>
                                    <tbody>
                                      <?php
                                        $select_qry="select * from `payments` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$today_date' and `payment_type`='Paid'  and (`status` = 'Published' or `status` = 'published') order by `id` desc";

                                        foreach ($db->query($select_qry) as $row) {
                                          $totals['payments']['count']+=1;
                                          $totals['payments']['paid']+=$row['amount'];

                                          ?>
                                          <tr>
                                            <td data-title="ID: #" class="bolder"><?=$row['id']?></td>
                                            <td data-title="Contact: "><?=gnr($db,'contacts','number',$row['contact_number'],'name')?><br /><?=$row['contact_number']?></td>
                                            <td data-title="Amount: "><?=$row['amount']?></td>
                                            <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>

                                  <h2>Payments Received</h2>
                                  <table id="example24" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Contact</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Method</th>
                                          </tr>
                                      </thead>
                                    <tbody>
                                      <?php
                                        $select_qry="select * from `payments` where `owner_mobile`='$_SESSION[sess_bp_username]' and `date`='$today_date' and `payment_type`='Received'  and (`status` = 'Published' or `status` = 'published') order by `id` desc";

                                        foreach ($db->query($select_qry) as $row) {
                                          $totals['payments']['count']+=1;
                                          $totals['payments']['received']+=$row['amount'];

                                          ?>
                                          <tr>
                                            <td data-title="ID: #" class="bolder"><?=$row['id']?></td>
                                            <td data-title="Contact: "><?=gnr($db,'contacts','number',$row['contact_number'],'name')?><br /><?=$row['contact_number']?></td>
                                            <td data-title="Amount: "><?=$row['amount']?></td>
                                            <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>

                                  <h2>Payments Summary</h2>
                                  <table id="totals_table" class="table full-color-table full-info-table hover-table">
                                    <thead>
                                        <tr class="cf">
                                          <th>Payments Count</th>
                                          <th>Total Received</th>
                                          <th>Total Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="bolder" id="" data-title="Payments Count:"> <?=$totals['payments']['count']?></td>
                                        <td id="" data-title="Payments Received: "><?=$totals['payments']['received']?></td>
                                        <td id="" data-title="Payments Paid: "><?=$totals['payments']['paid']?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>

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
                                      <h1 class="print_center">Sale Invoice</h1>
                                    </div>
                                    <div class="print_row">
                                      <div class="print_half">
                                        <h2>Bill to:</h2>
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

      $(document).on('click','.view_invoice_btn',function(e){
        e.preventDefault();
        var inv_id = $(this).attr('rel');
        var invoice_type = $(this).attr('data-invoice_type');
        view_invoice(invoice_type,inv_id);

      });
      $(document).on('click','#print_printable',function(e){
        e.preventDefault();
        $('.preloader').show();
  //          alert('sending print.');
        printJS('invoice_printable_area', 'html');
        $('.preloader').hide();
      });

    </script>
</body>
</html>
