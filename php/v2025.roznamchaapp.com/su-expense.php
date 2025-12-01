<?php
  require_once("su-expense.config.php");
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
        $.get( "<?=$meta['module'][1]?>-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
          $('.preloader').hide();
        }).fail(
          function (jqXHR, textStatus, errorThrown) {
            alert("There has been an issue while loading: "+errorThrown+". Please report this issue to technical support.");
            setTimeout(function(){ window.location.reload(); }, 5000);
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
        }).fail(
          function (jqXHR, textStatus, errorThrown) {
            alert("There has been an issue while loading: "+errorThrown+". Please report this issue to technical support.");
            setTimeout(function(){ window.location.reload(); }, 3000);
          });

    });

    $("#importmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "<?=$meta['module'][1]?>-import.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        }).fail(
          function (jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
            console.log(jqXHR);
            console.log('textStatus = ' + textStatus);
            console.log('errorThrown = ' + errorThrown);
            swal({
               title: 'Failed!',
               text: 'These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support. <ul><li>'+ jqXHR +'</li> <li>'+textStatus+'</li></ul>',
               timer: 2000,
               type: 'danger',
               showConfirmButton: false
            });
            setTimeout(function(){ window.location.reload(); }, 5000);
          });;

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
                                  <?php

                                   ?>
                                   <a id="newmodalbtn" href="#" class="btn btn-sm pull-right btn-info" data-toggle="modal">Add New<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div></a>
                                   <a id="importmodalbtn" href="#" class="btn btn-sm pull-right btn-primary hide" data-toggle="modal">Import</a>
                                   <!-- sample modal content -->
                                   <div id="modaldiv"></div>
                                   <!-- /.modal -->

                                </div>
                              </div>
                              <?php
                              $i=1;
                                $select_qry="select * from `expense_type` where `owner_mobile`='$_SESSION[sess_bp_username]' $all_status_where order by `name` asc";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();

                              $count_rows = $stmt->rowCount();

                              if($count_rows>0)
                              {

                               ?>
                              <div class="table-responsive m-t-10"  id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th>Name</th>
                                        <th class="">Description</th>
                                        <th class="hide_it">status</th>
                                      </tr>
                                  </thead>
                                <tbody>
<?php                                    foreach ($db->query($select_qry) as $row) {

                                   ?>
                                    <tr class="">
                                      <td data-title="" class="bolder"><a href="" class="editmodalbtn" rel="<?=$row['id']?>"><?=$row['name']?></a> </td>
                                      <td data-title="Description: "><?=$row['description']?></td>
                                      <td data-title=""><?=$row['status']?> <a href="" class="pull-right editmodalbtn btn btn-sm btn-warning" rel="<?=$row['id']?>">Edit</a> </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                   ?>
                                </tbody>
                            </table>




                          </div>

                          <br>
                          <p>
                            <a href="su-expense.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                            <a href="su-expense.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                          </p>
                          <?php
                        } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
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
        ?>
    <!-- Style switcher -->
    <!-- ============================================================== -->
  <script type="text/javascript">
    function isValidJSONString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }




    $(document).on('click','#editbtn',function(e){
      e.preventDefault();
      $('.preloader').show();
      var form_data= $('#new_form').serialize();
      var urlpost = 'su-expense-edit.process.php';


          var jqxhr = $.post( urlpost, form_data)
            .done(function(msg) {
              if(isValidJSONString(msg))
              {
                var response = jQuery.parseJSON( msg );
                if(response.code == 200){

                    swal({
                       title: 'Submited!',
                       text: 'Record has been updated successfully.',
                       timer: 2000,
                       type: 'success',
                       showConfirmButton: false
                    });
                    location.reload();


                }else{
                    $("#msgholder").html(response.msg);
                    $("#msgholder").removeClass('d-none');
                    $('.preloader').hide();
                }

              }else{
                $("#msgholder").html(msg);
                $("#msgholder").removeClass('d-none');
                $('.preloader').hide();
              }

            })
            .fail(function (jqXHR, textStatus, errorThrown) {
            alert("There has been an issue while loading: "+errorThrown+". Please report this issue to technical support.");
            setTimeout(function(){ window.location.reload(); }, 3000);
          });
        });

    $(document).on('click','#submitBtn',function(e){
      e.preventDefault();
      $('.preloader').show();
      var form_data = $("#new_form").serialize();
      var urlpost='su-expense-new.process.php';


    //    alert(form_data);

    var jqxhr = $.post( urlpost, form_data)
      .done(function(msg) {
        if(isValidJSONString(msg))
        {
          var response = jQuery.parseJSON( msg );
          if(response.code == 200){

              swal({
                 title: 'Submited!',
                 text: 'Record has been added successfully.',
                 timer: 2000,
                 type: 'success',
                 showConfirmButton: false
              });
              location.reload();


          }else{
              $("#msgholder").html(response.msg);
              $("#msgholder").removeClass('d-none');
              $('.preloader').hide();
          }

        }else{
          $("#msgholder").html(msg);
          $("#msgholder").removeClass('d-none');
          $('.preloader').hide();
        }

      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        alert("There has been an issue while loading: "+errorThrown+". Please report this issue to technical support.");
        setTimeout(function(){ window.location.reload(); }, 3000);
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
