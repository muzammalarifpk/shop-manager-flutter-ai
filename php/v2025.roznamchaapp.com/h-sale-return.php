<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Sales Return History';
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
                                    <h3>Customize Payment History</h3>
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
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Contact Number</th>
                                        <th>Grand total</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
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

                                    $select_qry="select * from `sale_invoices_returns` where `owner_mobile`='$_SESSION[sess_bp_username]' $where $all_status_where order by `id` desc";
                                    foreach ($db->query($select_qry) as $row) {
                                   ?>
                                    <tr>
                                      <td data-title="ID: " class="bolder"><?=$row['id']?></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Contact: "><?=gnr($db,'contacts','number',$row['contact_number'],'name')?> <br /><?=$row['contact_number']?></td>
                                      <td data-title="Total: "><?=$row['grand_total']?></td>
                                      <td data-title="Paid: "><?=$row['amount_paid']?></td>
                                      <td data-title="Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                      <td data-title=""><a href="h-sale-return-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">View Invoice</a></td>
                                    </tr>
                                    <?php
                                    }
                                   ?>
                                </tbody>
                            </table>
                            </div>
                            <br>
                            <p>
                              <a href="h-sale-return.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                              <a href="h-sale-return.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                            </p>
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
</body>
</html>
