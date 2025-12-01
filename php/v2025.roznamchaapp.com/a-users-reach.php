<?php
  require_once("a-users.config.php");
  $meta['info']['title']='User Reach ' .( date("H:i:s M-D, Y"));
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");

  $app_db_name = 'muzauayu_shopmanager_offline';
  try {
    $app_db = new PDO('mysql:host='.$db_host.';dbname='.$app_db_name.';charset=utf8mb4', $db_user , $db_pass);
    $app_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $app_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
  }
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
        $.get( "admin-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "admin-new.php", function( data ) {
          // the contents is now in the variable data
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

                              <form class="" action="" method="get">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Message ID</label>
                                      <input type="number" class="form-control" name="msg_id" value="<?=$_GET['msg_id']?>">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Sort</label>
                                      <select class="form-control" name="sort">
                                        <option value="asc">ASC</option>
                                        <option value="desc">DESC</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <input type="submit" name="submit" class="btn btn-info pull-right" value="submit">
                                    </div>
                                  </div>
                                </div>
                              </form>

                              <?php
$long_msg=",

Eid and Ramadan Offer:

As we approach the blessed month of Ramadan and Eid-ul-Fitr, we at Roznamcha want to help your business thrive. That is why we are offering a special Eid and Ramadan deal for our fellow Muslim shop owners.

*Upgrade to Roznamcha now and enjoy a lifetime license for just $99,* exclusively for our Muslim brothers and sisters. With Roznamcha, you will have access to the ultimate app for retail and wholesale shops. Our app offers online and offline inventory management, POS, bookkeeping, and more on your mobile or laptop.

By streamlining your business operations with Roznamcha, you can track sales and inventory, and stay on top of your finances - all in one place. With our app, you will have the tools you need to make informed decisions and grow your business during the holy month of Ramadan and beyond.

Dont wait - this amazing offer ends on Eid-ul-Fitr. Get your lifetime license now and take your business to the next level with Roznamcha. For more details, contact us at +92-343-4123489.

May Allah (SWT) bless you with a successful business during this blessed month of Ramadan and always.

JazakAllah Khair.
";

$long_msg2="
";

$urdu_msg=",

Eid and Ramadan Offer:

As we approach the blessed month of Ramadan and Eid-ul-Fitr, we at Roznamcha want to help your business thrive. That is why we are offering a special Eid and Ramadan deal for our fellow Muslim shop owners.

*Upgrade to Roznamcha now and enjoy a lifetime license for just $99,* exclusively for our Muslim brothers and sisters. With Roznamcha, you will have access to the ultimate app for retail and wholesale shops. Our app offers online and offline inventory management, POS, bookkeeping, and more on your mobile or laptop.

By streamlining your business operations with Roznamcha, you can track sales and inventory, and stay on top of your finances - all in one place. With our app, you will have the tools you need to make informed decisions and grow your business during the holy month of Ramadan and beyond.

Dont wait - this amazing offer ends on Eid-ul-Fitr. Get your lifetime license now and take your business to the next level with Roznamcha. For more details, contact us at +92-343-4123489.

May Allah (SWT) bless you with a successful business during this blessed month of Ramadan and always.

JazakAllah Khair.


";
$urdu_msg2="
";
                              $cohorts_array=[];

                              $select_qry="SELECT *  FROM `users` where `reach_counter` < '$_GET[msg_id]' and `status`='Published' order by `entries` $_GET[sort] limit 1";
                              $select_count = $db->prepare($select_qry);
                              $select_count->execute();
                              $count_cloud = $select_count->rowCount();

                              if($count_cloud!==0)
                              {

                              ?>

                              <div class="table-responsive"  id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th>Link</th>
                                        <th>Number</th>
                                        <th>business name</th>
                                        <th>entries</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                              <?php

                                //  echo $select_qry;
                                foreach ($db->query($select_qry) as $row) {

                                  $country_code_iso = 'PK';

                                  if(!empty($row['country_code_iso']))
                                  {
                                    $country_code_iso=$row['country_code_iso'];
                                  }

                                  $store_link = 'https://play.google.com/store/apps/details?id=com.roznamchaapp.shopmanager

                                  ';

                                  //.'https://www.moqame.com/'.$country_code_iso.'/'.str_replace("+","",$row['number']).'/';

                                  if($row['country_code']=='+92')
                                  {
                                    $wa_msg =  $urdu_msg . $store_link . $urdu_msg2." ".$long_msg . $long_msg2;
                                  }else{
                                    $wa_msg= $long_msg . $store_link . $long_msg2;
                                  }

                                  $whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row['number'])).'?text='.urlencode("Assalam-o-Alaikum! *".trim($row['business_name'])."* ".$wa_msg);
                                  ?>
                                  <tr>
                                    <td><a href="<?=$whatsapp_link?>" id="<?=$row['id']?>" class="btn btn-success btn-sm whatsapp_link" data-db="cloud_app" target="_blank" >WhatsApp</a></td>
                                    <td><?=$row['number']?></td>
                                    <td><?=$row['business_name']?></td>
                                    <td><?=$row['entries']?></td>
                                    <td><?=date("d-M, Y",$row['timestamp'])?></td>
                                  </tr>
                                  <?php

                                }

                                   ?>
                                 </tbody>
                               </table>


                            </div>
                            <?php
                          }else{
                            ?>

                            <div class="table-responsive"  id="no-more-tables">
                              <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead class="cf">
                                    <tr>
                                      <th>Link</th>
                                      <th>Number</th>
                                      <th>Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                            <?php

                              $cohorts_array=[];

                              $select_qry="SELECT *  FROM `Users` where `reach_counter` < '$_GET[msg_id]'  order by `id` desc limit 1";
                              //  echo $select_qry;
                              foreach ($app_db->query($select_qry) as $row) {
                                $mobile_code = substr($row['mobile'],0,3);

                              if($mobile_code=='+92')
                              {
                                $wp_msg =  $urdu_msg;
                              }elseif($mobile_code=='+91')
                              {
                                $wp_msg =  $urdu_msg;
                              }else{
                                $wp_msg = $long_msg;
                              }


                                $whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row['mobile'])).'?text='.urlencode("Hello *".trim($row['business_name'])."* ".$wp_msg);
                                ?>
                                <tr>
                                  <td><a href="<?=$whatsapp_link?>" id="<?=$row['id']?>" class="btn btn-warning btn-sm whatsapp_link" data-db="offline_app" target="_blank" >WhatsApp</a></td>
                                  <td><?=$row['mobile']?></td>
                                  <td><?=$row['business_name']?></td>
                                </tr>
                                <?php

                              }

                                 ?>
                               </tbody>
                             </table>


                            </div>
                          <?php  } ?>
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
          $(document).on("click",'.whatsapp_link',function() {
            var this_user_id = $(this).attr('id');
            var app_name = $(this).attr('data-db');
            var msg_id = '<?=$_GET['msg_id']?>';

            var formdata = {"user_id":this_user_id,"app_db":app_name,"msg_id":msg_id};
            $.post( "a-users-reach.process.php", formdata)
              .done(function( data ) {
                console.log(data);

                  if(data=='success')
                  {
                    swal({
                      title: 'Success!',
                      text: 'Product has been updated successfully.',
                      timer: 2000,
                      type: 'success',
                      showConfirmButton: false
                    });
    //                setTimeout(function(){ window.location.reload(); }, 2500);
                  }else{
                    swal({
                      title: 'Error!',
                      text: 'Record not saved.',
                      timer: 4000,
                      type: 'error',
                      showConfirmButton: false
                    });
                    alert("Erorr while updating. Please contact support with screenshot. " + data);
                  }

              })
              .fail(
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
      //            setTimeout(function(){ window.location.reload(); }, 5000);
                });
          });
        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</body>
</html>
