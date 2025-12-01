<?php
  require_once("su-chartofaccount.config.php");
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

    $(document).on('click','.editmodalbtn',function(e){
      e.preventDefault();
      $('.preloader').show();
      var reqid=$(this).attr('rel');
      //  alert(reqid);
        $.get( "<?=$meta['module'][1]?>-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
          $('.preloader').hide();
        });

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
      $('.preloader').show();
        $.get( "<?=$meta['module'][1]?>-new.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
          $('.preloader').hide();
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
                        <div class="card mt-3">
                            <div class="card-body">
                              <div class="row">

                                <div class="col-md-12">
                                  <a id="newmodalbtn" href="#" class="btn btn-sm pull-right btn-info" data-toggle="modal">Add New</a>
                                  <!-- sample modal content -->
                                  <div id="modaldiv"></div>
                                  <!-- /.modal -->
                                </div>
                              </div>
                                <?php
                                $select_qry="select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' order by `account_head` asc";
                                $stmt = $db->prepare($select_qry);
                                $stmt->execute();

                                $count_rows = $stmt->rowCount();

                                if($count_rows>0)
                                {
                                 ?>

                                <div class="table-responsive m-t-10" id="no-more-tables">
                                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                        <tr class="cf">
                                          <th>Account Head</th>
                                          <th>Account Type</th>
                                          <th>Balance</th>
                                          <th>Balance Type</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                    <?php
                                    $i=1;
                                      foreach ($db->query($select_qry) as $row) {

                                        $ledger_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='".$row['id']."' order by `id` desc limit 1 ";
                                     ?>
                                      <tr>
                                        <td data-title="" class="bolder"><a href="" rel="<?=$row['id']?>" class="editmodalbtn"><?=$row['account_head']?></a>
                                          <button class="expand_btn pull-right d-md-none d-lg-none"><i class="mdi mdi-menu-right"></i></button>
                                        </td>
                                        <td data-title="Account Type: " class="mobile_collapse" ><?=$row['account_type']?></td>
                                        <td data-title="Balance: "><a href="r-ledgerview.php?id=<?=$row['id']?>" class="<?php if($row['balance_type']=='debit'){ echo 'green-text';}else{ echo 'red-text';} ?>"><?=$row['balance']?></a></td>
                                        <td data-title="Balance type: " class="mobile_collapse" ><span class="<?php if($row['balance_type']=='debit'){ echo 'green-text';}else{ echo 'red-text';} ?>"><?=$row['balance_type']?> </span></td>
                                        <td  class="mobile_collapse" >

                                          <div class="btn-group">
                                              <button type="button" class="btn btn-success btn-sm"  onclick="location.href='r-ledgerview.php?id=<?=$row['id']?>';">Ledger</button>
                                              <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(75px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                  <a class="dropdown-item" href="r-ledgerview-detailed.php?id=<?=$row['id']?>">Detailed</a>
                                              </div>
                                          </div>


                                           <a href="" rel="<?=$row['id']?>" class="editmodalbtn btn btn-sm btn-warning pull-right">Edit</a></td>
                                      </tr>
                                      <?php
                                      $i++;
                                      }
                                     ?>
                                  </tbody>
                              </table>




                            </div>

                            <?php
                            }
                           ?>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php // require_once("includes/right.php"); ?>
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
          if(isset($_GET['addnew']))
          {
            if($_GET['addnew']=='true')
            {
              ?>
                <script type="text/javascript">
                  $(document).ready(function(){
                    $( "#newmodalbtn" ).trigger( "click" );
                  });
                </script>
              <?php
            }
          }
        ?>

    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
