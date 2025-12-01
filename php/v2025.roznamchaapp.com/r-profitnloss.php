<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Profit and Loss Report';
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
                    <h3 class="text-themecolor">Profit and Loss Report</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Profit and Loss Report</li>
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
                                <h3>Filter Results</h3>
                                <form action="" class="" method="get">
                                  <div class="form-body">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="">From Date</label>
                                          <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date'] ?? ''?>">
                                        </div>
                                      </div>
                                      <div class="col-md-3">
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
                                  <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                        <tr class="cf">
                                          <th>Total Purchase</th>
                                          <th>Total Gross Sale</th>
                                          <th>Total Sale Discount</th>
                                          <th>Total Net Sale</th>
                                          <th>Total Cost of Sale</th>
                                          <th>Total Gross Profit</th>
                                          <th>Total Expense</th>
                                          <th>Total Net Profit</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                    <tr>
                                      <td id="total_purchase" data-title="total purchase: "></td>
                                      <td id="total_gross_sale" data-title="gross sale: "></td>
                                      <td id="total_sale_discount" data-title="sales discount: "></td>
                                      <td id="total_net_sale" data-title="net sale: "></td>
                                      <td id="total_cost_of_sale" data-title="cost of sale: "></td>
                                      <td id="total_gross_profit" data-title="gross profit: "></td>
                                      <td id="total_expense" data-title="expense: "></td>
                                      <td id="total_net_profit" data-title="net profit: "></td>
                                    </tr>
                                  </tbody>
                                </table>

                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Date</th>
                                        <th>Purchase</th>
                                        <th>Gross Sale</th>
                                        <th>Sales Discount</th>
                                        <th>Net Sale</th>
                                        <th>Cost of Sale</th>
                                        <th>Gross Profit</th>
                                        <th>Expenses</th>
                                        <th>Net Profit</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                    $where = '';


                                    if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                    {

                                      $_GET['to_date']=strtotime("+1 days $_GET[to_date]");

                                      $where.= " and `timestamp` <= '$_GET[to_date]' ";
                                    }
                                    if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                    {
                                      $_GET['from_date']=strtotime("$_GET[from_date]");
                                      $where.= " and `timestamp` >= '$_GET[from_date]' ";
                                    }

                                    $total['purchase']=0;
                                    $total['gross_sale']=0;
                                    $total['sale_discount']=0;
                                    $total['net_sale']=0;
                                    $total['cost_of_sale']=0;
                                    $total['gross_profit']=0;
                                    $total['expense']=0;
                                    $total['net_profit']=0;

                                    $select_qry="select * from `graph` where `owner_mobile`='$_SESSION[sess_bp_username]' $where order by `date` desc";
//                                    echo $select_qry;
                                    foreach ($db->query($select_qry) as $row) {
                                   ?>
                                    <tr>
                                      <td class="bolder"><?=date("Y-m-d",strtotime($row['date']))?></td>
                                      <td data-title="Purchase: "><?=floatval($row['total_purchase'])?></td>
                                      <td data-title="Gross Sale: "><?=floatval($row['total_sale'])+floatval($row['sale_discount'])?></td>
                                      <td data-title="Sales Discount: "><?=floatval($row['sale_discount'])?></td>
                                      <td data-title="Net Sale: "><?=floatval($row['total_sale'])?></td>
                                      <td data-title="Cost of sale: "><?=floatval($row['cost_of_sale'])?></td>
                                      <td data-title="Gross Profit: "><?=floatval($row['profit'])?></td>
                                      <td data-title="Expense: "><?=floatval($row['expense'])?></td>
                                      <td data-title="Net Profit: "><?=floatval($row['profit'])-floatval($row['expense'])?></td>
                                    </tr>
                                    <?php
                                    $total['purchase']=$total['purchase']+floatval($row['total_purchase']);
                                    $total['gross_sale']=$total['gross_sale']+floatval($row['total_sale'])+floatval($row['sale_discount']);
                                    $total['sale_discount']=$total['sale_discount']+floatval($row['sale_discount']);
                                    $total['net_sale']=$total['net_sale']+floatval($row['total_sale']);
                                    $total['cost_of_sale']=$total['cost_of_sale']+floatval($row['cost_of_sale']);
                                    $total['gross_profit']=$total['gross_profit']+floatval($row['profit']);
                                    $total['expense']=$total['expense']+floatval($row['expense']);
                                    $total['net_profit']=$total['net_profit']+floatval($row['profit'])-floatval($row['expense']);
                                    }
                                   ?>
                                </tbody>
                            </table>


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
      $("#total_purchase").html("<?=$total['purchase']?>");
      $("#total_gross_sale").html("<?=$total['gross_sale']?>");
      $("#total_sale_discount").html("<?=$total['sale_discount']?>");
      $("#total_net_sale").html("<?=$total['net_sale']?>");
      $("#total_cost_of_sale").html("<?=$total['cost_of_sale']?>");
      $("#total_gross_profit").html("<?=$total['gross_profit']?>");
      $("#total_expense").html("<?=$total['expense']?>");
      $("#total_net_profit").html("<?=$total['net_profit']?>");
    </script>

</body>
</html>
