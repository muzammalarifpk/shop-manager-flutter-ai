<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Accounts Receivable / Payable';
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
            <div class="container-fluid" id="no-more-tables">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


                                <div class="table-responsive m-t-40" >
                                  <h2>Receivable</h2>
                                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                        <tr class="cf">
                                          <th>Contact Name</th>
                                          <th>Type</th>
                                          <th>Current Balance</th>
                                          <th>Balance Status</th>
                                          <th>Due Date</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                    <?php

                                    $receivable = 0;

                                      $select_qry="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='receiveable' or `balance_status`='debit') and `balance`>0 $all_status_where order by `name` asc";
                                      foreach ($db->query($select_qry) as $row) {
                                        $receivable += floatval($row['balance']);
                                        $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";
                                //                                      echo $contact_where;
                                     ?>
                                      <tr>
                                        <td data-title="" class="bolder"><a href="" rel="<?=$row['id']?>" class="editmodalbtn"><?=$row['name']?><br /><?=$row['number']?></a></td>
                                        <td data-title="Type: ">
                                          <?=$row['type']?>
                                        </td>
                                        <td data-title="Balance: "><a href="r-ledgerview.php?id=c<?=urlencode($row['number'])?>">
                                          <?=$row['balance']?>
                                        </a></td>
                                        <td data-title="Balance Status: "><a href="r-ledgerview.php?id=c<?=urlencode($row['number'])?>">
                                           <?=$row['balance_status']?>
                                        </a></td>
                                        <td data-title="Due Date: ">
                                          <?=$row['duedate']?>
                                        </td>
                                      </tr>
                                      <?php
                                      $i++;
                                      }
                                     ?>
                                  </tbody>
                                </table>
                                </div>

                              </div>
                    </div>
                </div>




                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive m-t-40" >
                              <h2>Payable</h2>
                              <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                    <tr class="cf">
                                      <th>Contact Name</th>
                                      <th>Type</th>
                                      <th>Current Balance</th>
                                      <th>Balance Status</th>
                                      <th>Due Date</th>
                                    </tr>
                                </thead>
                              <tbody>
                                <?php

                                $payable= 0 ;

                                  $select_qry="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='payable' or `balance_status`='credit') and `balance`>0  $all_status_where order by `name` asc";
                                  foreach ($db->query($select_qry) as $row) {
                                    $payable += $row['balance'];

                                    $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";
                            //                                      echo $contact_where;
                                 ?>
                                  <tr>
                                    <td data-title="" class="bolder"><a href="" rel="<?=$row['id']?>" class="editmodalbtn"><?=$row['name']?><br /><?=$row['number']?></a></td>
                                    <td data-title="Type: ">
                                      <?=$row['type']?>
                                    </td>
                                    <td data-title="Balance: "><a href="r-ledgerview.php?id=c<?=urlencode($row['number'])?>">
                                      <?=$row['balance']?>
                                    </a></td>
                                    <td data-title="Balance Status: "><a href="r-ledgerview.php?id=c<?=urlencode($row['number'])?>">
                                       <?=$row['balance_status']?>
                                    </a></td>
                                    <td data-title="Due Date: ">
                                      <?=$row['duedate']?>
                                    </td>
                                  </tr>
                                  <?php
                                  $i++;
                                  }
                                 ?>
                              </tbody>
                            </table>
                            </div>

                          </div>
                </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr class="cf">
                          <th>Total Receivable</th>
                          <th>Total Payable</th>
                          <th>Net Balance</th>
                        </tr>
                    </thead>
                  <tbody>
                    <tr>
                      <td data-title="R/A: "><?=$receivable?></td>
                      <td data-title="P/A: "><?=$payable?></td>
                      <td><?php

                      if($receivable>$payable)
                      {
                        echo $receivable-$payable.' Receivable';
                      }else{
                        echo $payable-$receivable.' Payable';
                      }

                      ?></td>
                    </tr>
                  </tbody>
                </table>

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
