<?php
  require_once("r-journal.config.php");
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

                                <div class="col-md-6">
                                  <h4 class="card-title"><?=ucwords($meta['info']['title'])?></h4>
                                  <h6 class="card-subtitle"><?=ucwords($meta['info']['des'])?></h6>
                                </div>
                                <div class="col-md-6">
                                  <?php

                                   ?>
                                  <a id="newmodalbtn" href="#" class=" hide btn btn-md pull-right btn-info" data-toggle="modal">Add New</a>
                                  <!-- sample modal content -->
                                  <div id="modaldiv"></div>
                                  <!-- /.modal -->

                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12">
                                  <form class="" action="" id="filter_form" method="get">
                                      <div class="row">
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
                                      <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for=""> </label>
                                            <input type="submit" class="btn btn-info" id="filter_btn" name="" value="Filter">
                                          </div>
                                        </div>

                                      </div>
                                  </form>
                                </div>
                              </div>


                              <div class="table-responsive m-t-40">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Description</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>Date</th>
                                      <th>Debit</th>
                                      <th>Credit</th>
                                      <th>Description</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                  <?php
                                  $i=1;
                                  $where ='';
                                  if(isset($_GET['to_date']))
                                  {
                                    $where.= " and `date_time` < '$_GET[to_date]' ";
                                  }
                                  if(isset($_GET['from_date']))
                                  {
                                    $where.= " and `date_time` > '$_GET[from_date]' ";
                                  }
                                    $select_qry="select * from `journal` where `owner_mobile`='$_SESSION[sess_bp_username]' $where  order by `id` asc";

                                    foreach ($db->query($select_qry) as $row) {

                                      $cr_row='';
                                      $dr_row='';
                                      $des='';

                                      $debit_array=json_decode($row['debit_json'],true);
                                      $credit_array=json_decode($row['credit_json'],true);

                                      if(is_array($debit_array) && is_array($credit_array))
                                      {
                                      foreach($debit_array as $key => $val)
                                      {
                                        if(isset($val['account']))
                                        {
                                          $des.=gnra($db,'chartofaccount','id',$val['account'],'account_head').' <br />';
                                          $dr_row.= $val['amount'].'<br />';
                                          $cr_row.='<br />';
                                        }
                                      }

                                      foreach($credit_array as $key => $val)
                                      {
                                        if(isset($val['account']))
                                        {
                                          $des.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.gnra($db,'chartofaccount','id',$val['account'],'account_head').' <br />';
                                          $dr_row.= '<br />';
                                          $cr_row.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['amount'].'<br />';
                                        }
                                      }

                                      $des.=$row['description'];

                                   ?>
                                    <tr>
                                      <td><?=date("Y-m-d",strtotime($row['date_time']))?></td>
                                      <td><?=$dr_row?></td>
                                      <td><?=$cr_row?></td>
                                      <td><?=$des?></td>

                                    </tr>
                                    <?php
                                    }
                                    $i++;
                                    }
                                   ?>
                                </tbody>
                            </table>




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
</body>
</html>
