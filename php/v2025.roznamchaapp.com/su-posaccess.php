<?php
  require_once("su-posaccess.config.php");
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
                        <div class="card m-t-20">
                            <div class="card-body">
                              <div class="row">

                                <div class="col-md-12">
                                  <a id="newmodalbtn" href="#" class="btn btn-md pull-right btn-info" data-toggle="modal">Add New</a>
                                  <!-- sample modal content -->
                                  <div id="modaldiv"></div>
                                  <!-- /.modal -->
                                </div>
                              </div>
                              <?php
                              $posaccess_qry="select * from `pos_access` where `owner_mobile`='$_SESSION[sess_bp_username]' ";




                              $stmt = $db->prepare($posaccess_qry);
                              $stmt->execute();

                              $count_rows = $stmt->rowCount();

                              echo 'count: '.$count_rows;

                              if($count_rows>0)
                              {

                               ?>
                              <div class="table-responsive m-t-10" id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Contact Name</th>
                                        <th>Number</th>

                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                  foreach ($db->query($posaccess_qry) as $row) {
                                      // code...
                                      $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `number`='".$row['number']."' order by `id` desc";
                                      ?>
                                      <tr>
                                        <td> <span class="bolder"><a href="" rel="<?=$row['id']?>" class="editmodalbtn"><?=gnrm($db,'contacts',$contact_where,'name')?></a></span></td>
                                        <td><?=$row['number']?> <a href="" rel="<?=$row['id']?>" class="editmodalbtn btn btn-sm pull-right btn-warning">Edit</a></td>

                                      </tr>
                                      <?php
                                    }
                                   ?>
                                </tbody>
                            </table>
                        </div>


                              <br>
                              <p>
                                <a href="su-posaccess.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                                <a href="su-posaccess.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                              </p>
                              <?php
                            } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php //require_once("includes/right.php"); ?>
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
          $(document).on('click','#submitbtn',function(e){
            e.preventDefault();
            $('.preloader').show();
            $.ajax({
                url: 'su-posaccess-new-process.php',
                type: 'post',
                data: $("#formdata").serialize(),
                success: function( data, textStatus, jQxhr ){
                  var local_obj = jQuery.parseJSON(data);
                  if(local_obj.code==200) {
//                    alert("a4: "+local_obj.msg);
                    swal({
                       title: 'Submited!',
                       text: 'Data Saved successfully.',
                       timer: 2000,
                       type: 'success',
                       showConfirmButton: false
                    });
                    setTimeout(function(){
                      window.location.reload();
                    },2000);
                  }else{
                    $('#msgholder').html( local_obj.msg );
                    $('#msgholder').removeClass('d-none');
                    $('.preloader').hide();
                  }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                    $('#msgholder').html( errorThrown );
                    $('#msgholder').removeClass('d-none');
                    $('.preloader').hide();
                }
            });
          });

        </script>

      <?php
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
</body>
</html>
