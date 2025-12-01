<?php
  require_once("t-expense.config.php");
  $meta['info']['title']='Expense History';
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

                              <div class="row">
                                  <div class="col-md-12">
                                    <h3>Customize Expense History</h3>
                                    <form action="" class="" method="get">
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="">Type</label>
                                              <select class="form-control" name="expense_type" id="expense_type">
                                                <option value="*">-- All --</option>
                                                <?php
                                                foreach ($list_expense_types as $key => $row )
                                                {

                                                 ?>
                                                <option value="<?=$row?>"><?=$row?></option>
                                                <?php
                                                  }

                                                 ?>
                                                 <option value="Others">Others</option>
                                                 <?php
                                                 $select_expense="select * from `expense_type` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status` = 'Published' order by `name` asc";

                                                 $stmt = $db->prepare($select_expense);
                                                 $stmt->execute();

                                                 $count_rows = $stmt->rowCount();

                                                 if($count_rows>0)
                                                 {
                                                   foreach ($db->query($select_expense) as $expense_type) {
                                                     ?>
                                                     <option value="<?=$expense_type['name']?>"><?=$expense_type['name']?></option>
                                                     <?php
                                                   }
                                                 }

                                                  ?>
                                              </select>
                                              <?php if(isset($_GET['expense_type']))
                                              {
                                                ?>

                                              <script type="text/javascript">
                                                $('#expense_type').val("<?=$_GET['expense_type']?>");
                                              </script>
                                              <?php
                                            }
                                             ?>
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="">From Date</label>
                                              <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date'] ?? ''?>">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
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
                                      <th>Total Expense</th>

                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td data-title="Total Expense" id="total_expense"></td>
                                    </tr>
                                  </tbody>
                                </table>
                                                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Expense type</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Method</th>
                                        <th>Description</th>
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
                                  if(isset($_GET['expense_type']) && $_GET['expense_type']!='*')
                                  {
                                    $where.= " and `expense_type` = '$_GET[expense_type]' ";
                                  }


                                    $select_qry="select * from `expense` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' $where order by `id` desc";
                                    foreach ($db->query($select_qry) as $row) {
                                      $total_expense+=floatval($row['amount']);
                                   ?>
                                    <tr>
                                      <td class="bolder" data-title="ID: "><?=$row['id']?>
                                        <a rel="<?=$row['id']?>" href="" onclick='return delete_expense("<?=$row['id']?>");' class="delbtn text-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                                      </td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Type: "><?=$row['expense_type']?></td>
                                      <td data-title="Amount: "><?=$row['amount']?></td>
                                      <td data-title="Method: "><?=gnr($db,"chartofaccount",'id',$row['payment_method'],'account_head')?></td>
                                      <td data-title="Description: "><?=$row['description']?></td>
                                      <td class="d-none"><a href="h-expense-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">View Details</a></td>
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

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
