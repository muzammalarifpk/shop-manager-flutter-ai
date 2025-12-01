<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Balance Sheet';
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

                              <div class="alert alert-warning">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                  <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3> This report is under construction.
                              </div>


                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Assets</th>
                                        <th>Liabilities</th>
                                        <th>Equity</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <tr>
                                    <td class="bolder" id="total_assets" data-title="Total Assets: "></td>
                                    <td id="total_liabilities" data-title="Total Liabilities: "></td>
                                    <td id="total_equity" data-title="Total Equity: "></td>
                                  </tr>
                                </tbody>
                                </table>

                              </div>
                              <div class="row">
                                <div class="col-6">
                                  <h2>Assets</h2>

                                  <h3>Accounts Receivable</h3>
                                  <?php
                                    $total_receivable = 0;
                                    $receivable_qry = "select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='debit' or `balance_status`='receiveable')  $all_status_where GROUP BY(number)";

                                    foreach ($db->query($receivable_qry) as $row_receivable)
                                    {
                                        $total_receivable = $total_receivable + $row_receivable['balance'];
                                      ?>
                                      <div class="row">
                                        <div class="col-6"><?=$row_receivable['name']?></div>
                                        <div class="col-6 text-right">
                                          <?php
                                            echo $row_receivable['balance'];
                                          ?>
                                        </div>
                                      </div>
                                      <?php
                                    }
                                  ?>
                                  <div class="row bolder">
                                    <div class="col-6">Total Receivable</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_receivable?></i></u></b></div>
                                  </div>

                                  <h3>Cash and Banks</h3>
                                  <?php
                                    $total_cash = 0;
                                    $cash_qry = "select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type`='cash' or `account_type`='bank') and (`balance_type`='dr' or `balance_type`='debit')  $all_status_where";

                                    foreach ($db->query($cash_qry) as $row_cash) {
                                      ?>
                                    <div class="row">
                                      <div class="col-6"><?=$row_cash['account_head']?></div>
                                      <div class="col-6 text-right">
                                        <?php
                                            $total_cash = $total_cash + $row_cash['balance'];
                                            echo $row_cash['balance'];
                                        ?>
                                      </div>
                                    </div>
                                    <?php
                                    }
                                  ?>
                                  <div class="row bolder">
                                    <div class="col-6">Total Cash</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_cash?></i></u></b></div>
                                  </div>

                                  <h3>Inventory</h3>
                                  <?php
                                    $total_inventory = 0;
                                    $inventory_qry = "select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]'  $all_status_where";

                                    foreach ($db->query($inventory_qry) as $row_inventory) {
                                      $this_stock_val=(floatval($row_inventory['available_stock'])*floatval($row_inventory['purchase_cost']));
                                      $total_inventory = ($total_inventory + $this_stock_val);

                                      if($this_stock_val>0){
                                      ?>
                                      <div class="row">
                                        <div class="col-6"><?=$row_inventory['name']?></div>
                                        <div class="col-6 text-right">
                                          <?php
                                            if($this_stock_val=='')
                                            {
                                              echo '0';
                                            }else{
                                              echo $this_stock_val;
                                            }
                                          ?>
                                        </div>
                                      </div>
                                      <?php
                                      }
                                    }
                                  ?>
                                  <div class="row bolder">
                                    <div class="col-6">Total Inventory Value</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_inventory?></i></u></b></div>
                                  </div>
                                  <?php
                                    $total_assets = $total_receivable+$total_cash+$total_inventory;
                                   ?>
                                  <div class="row">
                                    <div class="col-6"><h4>Total Assets</h4></div>
                                    <div class="col-6 text-right"><h4><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_assets?></i></u></h4></div>
                                  </div>

                                </div>
                                <div class="col-6">
                                  <h2>Liabilities</h2>


                                  <h3>Accounts Payable</h3>
                                  <?php
                                    $total_liabilities = 0;
                                    $total_payable = 0;

                                    $payable_qry = "select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='credit' or `balance_status`='payable')  $all_status_where GROUP BY(number)";

                                    foreach ($db->query($payable_qry) as $row_payable) {
                                        $total_payable = $total_payable + $row_payable['balance'];
                                      ?>
                                      <div class="row">
                                        <div class="col-6"><?=$row_payable['name']?></div>
                                        <div class="col-6 text-right">
                                          <?php
                                              echo $row_payable['balance'];
                                          ?>
                                        </div>
                                      </div>
                                      <?php
                                  }

                                  ?>
                                  <div class="row bolder">
                                    <div class="col-6">Total Payable</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_payable?></i></u></b></div>
                                  </div>

                                  <h3>Cash and Banks</h3>
                                  <?php
                                    $total_cash_payable = 0;
                                    $payable_cash_qry = "select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type`='cash' or `account_type`='bank') and (`balance_type`='cr' or `balance_type`='credit')  $all_status_where";

                                    foreach ($db->query($payable_cash_qry) as $row_cash_payable) {
                                      ?>
                                    <div class="row">
                                      <div class="col-6"><?=$row_cash_payable['account_head']?></div>
                                      <div class="col-6 text-right">
                                        <?php
                                            $total_cash_payable = $total_cash_payable + $row_cash_payable['balance'];
                                            echo $row_cash_payable['balance'];
                                        ?>
                                      </div>
                                    </div>
                                    <?php
                                    }
                                  ?>
                                  <div class="row bolder">
                                    <div class="col-6">Total Cash and Banks Payable</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_cash_payable?></i></u></b></div>
                                  </div>

                                  <?php
                                    $total_liabilities = $total_payable + $total_cash_payable;
                                  ?>



                                  <h2>Equity</h2>
                                  <?php
                                    $total_equity = 0;
                                    $equity_qry = "select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and `account_type`='Equity'  $all_status_where";

                                    foreach ($db->query($equity_qry) as $row_equity) {
                                      ?>
                                    <div class="row">
                                      <div class="col-6"><?=$row_equity['account_head']?></div>
                                      <div class="col-6 text-right">
                                        <?php
                                            $total_equity = $total_equity + $row_equity['balance'];
                                            echo $row_equity['balance'];
                                        ?>
                                      </div>
                                    </div>
                                    <?php
                                    }
                                  ?>
                                    <div class="row">
                                      <div class="col-6">Net Profit</div>
                                      <div class="col-6 text-right">
                                        <?php
                                        $profit_qry = "select sum(`profit`) as total_profit, sum(`expense`) as total_expense from `graph` where `owner_mobile`='$_SESSION[sess_bp_username]'  $all_status_where";

                                        foreach ($db->query($profit_qry) as $row_profit) {
                                          $row_net_profit = $row_profit['total_profit']-$row_profit['total_expense'];
                                          echo $row_net_profit;
                                          $total_equity = $total_equity + $row_net_profit;
                                        }
                                        ?>
                                      </div>
                                    </div>

                                  <div class="row bolder">
                                    <div class="col-6">Total Equity</div>
                                    <div class="col-6 text-right"><b><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_equity?></i></u></b></div>
                                  </div>

                                  <div class="row">
                                    <div class="col-6"><h4>Equity + Liabilities</h4></div>
                                    <div class="col-6 text-right"><h4><u><i><?=$_SESSION['sess_bp_currency']?> <?=$total_equity+$total_liabilities?></i></u></h4></div>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script type="text/javascript">
      $("#total_assets").html("<?=$total_assets?>");
      $("#total_liabilities").html("<?=$total_liabilities?>");
      $("#total_equity").html("<?=$total_equity?>");
    </script>
</body>
</html>
