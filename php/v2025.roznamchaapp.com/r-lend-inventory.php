<?php
  require_once("t-sale.config.php");
  $meta['info']['title'] = 'Lended Inventory Report';
  $meta['info']['des'] = '';
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
                    <h3 class="text-themecolor">Most Sold Items</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
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

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="">Tag</label>
                                        <input type="text" name="tag" class="form-control" id="tag" value="<?php if(isset($_GET['tag'])){ echo $_GET['tag'];}?>">
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
                              <?php
                                $where = '';


                                if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                {

                                  $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                  $where.= " and `date` <= '$_GET[to_date]' ";
                                }
                                if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                {
                                  $where.= " and `date` >= '$_GET[from_date]' ";
                                }

                              ?>


                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Total Sold Stock</th>
                                        <th>Total Sale</th>
                                        <th>Total Gross Profit</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td data-title="Total Stock sold: " id="total_sold_stock"></td>
                                      <td data-title="Total Sale: " id="total_sale"></td>
                                      <td class="bolder" data-title="Profit: " id="total_profit"></td>
                                    </tr>
                                  </tbody>
                                </table>


                              <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                    <tr class="cf">
                                      <th>Item Name</th>
<?php
$lend_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and `lend_inventory`='on'  $all_status_where";
$lendable_items = [];
foreach ($db->query($lend_query) as $lend)
{
  $lendable_items[]=$lend['id'];
  $total_lendable[$lend['id']]=0;
  ?>
    <th><?=$lend['name']?></th>
  <?php
}
?>

                                    </tr>
                                </thead>
                              <tbody>
                                <?php
                                $lend_customers_query="select DISTINCT(contact_number) from `lend_inventory` where `owner_mobile`='$_SESSION[sess_bp_username]' $all_status_where";

                                foreach ($db->query($lend_customers_query) as $row_customer)
                                {
                                  // print_r($row_customer);
                                  ?>
                                    <tr>
                                      <td><?php echo gnrm($db,'contacts',"`number`='$row_customer[contact_number]' and `owner_mobile`='$_SESSION[sess_bp_username]'",'name'); ?></td>
                                      <?php

                                        foreach ($lendable_items as $key => $value) {
                                          $this_item_total=gnrms($db,'lend_inventory',"`owner_mobile`='$_SESSION[sess_bp_username]' and `item_id`='$value' and `contact_number`='$row_customer[contact_number]'",'grand_total_qty','id');

                                          $total_lendable[$value]+=$this_item_total;
                                          // code...
                                        ?>
                                          <td><?=$this_item_total?></td>
                                        <?php
                                        }

                                      ?>
                                    </tr>

                                  <?php
                                }
                             ?>
                             <tr>
                               <th>Total</th>
                               <?php
                               foreach ($lendable_items as $key => $value)
                               {
                                 ?>
                                  <td><?=$total_lendable[$value]?></td>
                                 <?php
                               }
                               ?>
                             </tr>
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
      $("#total_sold_stock").html("<?=$total_sold_stock?>");
      $("#total_sale").html("<?=$total_sale?>");
      $("#total_profit").html("<?=$total_profit?>");
    </script>
</body>
</html>
