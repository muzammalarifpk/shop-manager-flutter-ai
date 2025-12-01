<?php
  require_once("a-users.config.php");
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

        $(document).on('click','#send_comment',function(e)
        {
            e.preventDefault();

            var formdata= $('#products_form').serialize();
            $.post( "a-users-interaction.php", formdata)
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
//                    setTimeout(function(){ window.location.reload(); }, 2500);
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
//                  setTimeout(function(){ window.location.reload(); }, 5000);
                });

        });

    $(document).on('click','#editbtn',function(e)
    {
        e.preventDefault();

        var formdata= $('#products_form').serialize();
        $.post( "a-users-update.php", formdata)
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

    $(document).on('click','.edit_user_modal',function(e)
    {
      e.preventDefault();
      var userid = $(this).attr('data-userid');

        $.get( "a-users-get-history.php?userid="+userid, function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html('');
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
          $('.preloader').hide();
        }).fail(
          function (jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
            console.log(jqXHR);
            console.log('textStatus = ' + textStatus);
            console.log('errorThrown = ' + errorThrown);
            swal({
               title: 'Failed!',
               text: "These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support  "+ errorThrown +".",
               timer: 4500,
               type: 'error',
               showConfirmButton: false
            });

          });;

    });


    $(document).on('click','.buy_packages',function(e)
    {
      e.preventDefault();
      var userid = $(this).attr('data-userid');

        $.get( "a-users-get-packages.php?userid="+userid, function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html('');
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
          $('.preloader').hide();
        }).fail(
          function (jqXHR, textStatus, errorThrown) {
            console.log('jqXHR:');
            console.log(jqXHR);
            console.log('textStatus = ' + textStatus);
            console.log('errorThrown = ' + errorThrown);
            swal({
               title: 'Failed!',
               text: "These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support  "+ errorThrown +".",
               timer: 4500,
               type: 'error',
               showConfirmButton: false
            });

          });;

    });



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
              <div id="modaldiv"></div>
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
                                  <a href="?show_all_status=yes&refresh_stat=true" class="btn btn-md pull-right btn-info">Refresh stats</a>
                                  <!-- sample modal content -->
                                  <div id="modaldiv"></div>
                                  <!-- /.modal -->
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
                                              <label for="">some parts of mobile number</label>
                                              <input type="number" name="number" class="form-control" id="number" value="<?=$_GET['number']?>">
                                            </div>
                                          </div>

                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">Records limit</label>
                                              <input type="number" name="limit" class="form-control" id="limit" value="<?=$_GET['limit']?>">
                                            </div>
                                          </div>

                                          <?php
                                          if(isset($_GET['number']))
                                          { ?>
                                          <script type="text/javascript">
                                            $("#number").val("<?=$_GET['number']?>");
                                          </script>
                                          <?php
                                        } ?>

                                          <div class="col-md-3">
                                            <label for="">Business Type</label>
                                            <select name="business_type" class="form-control" id="business_type">
                                              <option value="*">All</option>
                                              <option value="Wholesaller">Wholesaller</option>
                                              <option value="Retailer">Retailer</option>
                                              <option value="Distributor">Distributor</option>
                                            </select>
                                          </div>
                                          <?php
                                          if(isset($_GET['business_type']))
                                          { ?>
                                          <script type="text/javascript">
                                            $("#business_type").val("<?=$_GET['business_type']?>");
                                          </script>
                                        <?php
                                          }
                                         ?>
                                          <div class="col-md-3">
                                            <label for="">Industry</label>
                                            <select name="industry_type" class="form-control" id="industry_type">
                                              <option value="*">All</option>
                                              <?php
                                                $select_industry_qry="select distinct(industry_type) from `users` order by `industry_type` ";
                                                foreach ($db->query($select_industry_qry) as $row) {
                                                  ?>
                                                    <option value="<?=$row['industry_type']?>"><?=$row['industry_type']?></option>
                                                  <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                          <?php
                                          if(isset($_GET['industry_type']))
                                          { ?>
                                          <script type="text/javascript">
                                            $("#industry_type").val("<?=$_GET['industry_type']?>");
                                          </script>

                                        <?php } ?>

                                          <div class="col-md-3">
                                            <label for="">Country Code</label>
                                            <select name="country_code" class="form-control" id="country_code">
                                              <option value="*">All</option>
                                              <?php
                                                $select_country_code_qry="select distinct(country_code) from `users` order by `country_code` ";
                                                foreach ($db->query($select_country_code_qry) as $row) {
                                                  ?>
                                                    <option value="<?=$row['country_code']?>"><?=$row['country_code']?></option>
                                                  <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                          <?php
                                          if(isset($_GET['country_code']))
                                          { ?>

                                          <script type="text/javascript">
                                            $("#country_code").val("<?=$_GET['country_code']?>");
                                          </script>
                                          <?php
                                          }
                                         ?>

                                         <div class="col-md-3">
                                           <label for="">Currency</label>
                                           <select name="currency" class="form-control" id="currency">
                                             <option value="*">All</option>
                                             <?php
                                               $select_currency_qry="select distinct(currency) from `users` order by `currency` ";
                                               foreach ($db->query($select_currency_qry) as $row) {
                                                 ?>
                                                   <option value="<?=$row['currency']?>"><?=$row['currency']?></option>
                                                 <?php
                                               }
                                             ?>
                                           </select>
                                         </div>

                                         <div class="col-md-3">
                                           <label for="">Membership</label>
                                           <select name="membership" class="form-control" id="membership">
                                             <option value="*">All</option>
                                             <?php
                                               $select_type_qry="select distinct(type) from `users` order by `type` ";
                                               foreach ($db->query($select_type_qry) as $row) {
                                                 ?>
                                                   <option value="<?=$row['type']?>"><?=$row['type']?></option>
                                                 <?php
                                               }
                                             ?>
                                           </select>
                                         </div>

                                          <?php
                                          if(isset($_GET['membership']))
                                          { ?>

                                          <script type="text/javascript">
                                            $("select#membership").val("<?=$_GET['membership']?>");
                                          </script>
                                          <?php
                                          }
                                         ?>
                                         <div class="col-md-3">
                                           <div class="form-group">
                                             <label for="">From Date</label>
                                             <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date']?>">
                                           </div>
                                         </div>

                                         <?php
                                         if(isset($_GET['from_date']))
                                         { ?>
                                         <script type="text/javascript">
                                           $("#from_date").val("<?=$_GET['from_date']?>");
                                         </script>
                                         <?php
                                       } ?>
                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">To Date</label>
                                              <input type="date" name="to_date" class="form-control" id="to_date" value="<?=$_GET['to_date']?>">
                                            </div>
                                          </div>
                                          <?php
                                          if(isset($_GET['to_date']))
                                          { ?>
                                            <script type="text/javascript">
                                            $("#to_date").val("<?=$_GET['to_date']?>");
                                          </script>
                                        <?php } ?>

                                          <div class="col-md-3">
                                            <label for="">Cohort</label>
                                            <select name="cohort" class="form-control" id="cohort">
                                              <option value="*">All</option>
                                              <?php
                                                $select_cohort_qry="select distinct(cohort) from `users` order by `cohort` ";
                                                foreach ($db->query($select_cohort_qry) as $row) {
                                                  ?>
                                                    <option value="<?=$row['cohort']?>"><?=$row['cohort']?></option>
                                                  <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                          <?php
                                          if(isset($_GET['cohort']))
                                          { ?>

                                          <script type="text/javascript">
                                            $("#cohort").val("<?=$_GET['cohort']?>");
                                          </script>

                                        <?php } ?>



                                        </div>
                                      </div>
                                      <div class="form-actions">
                                          <button type="submit" class="btn btn-info pull-right"> Submit</button>
                                      </div>
                                      <script>
                                      <?php
                                      if(isset($_GET['tag']))
                                      {
                                        ?>
                                      $('#tag').val('<?=$_GET['tag']?>');
                                      <?php
                                      }
                                      if(isset($_GET['sale_type']))
                                      {
                                        ?>
                                      $('#sale_type').val('<?=$_GET['sale_type']?>');
                                      <?php
                                      }
                                        if(isset($_GET['customer']))
                                        {
                                         ?>
                                        $('#customer').val('<?=$_GET['customer']?>');
                                        <?php
                                        }
                                         ?>
                                      </script>
                                    </form>
                                  </div>

                              </div>

                              <div class="row">

                                <?php
                                $users_head=['cohort','entries','type','business_type','industry_type','country_name','region_name','city'];
                                foreach ($users_head as $key => $value) {
                                  // code...

                                 ?>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"><?=$value?></h4>
                                            <div id="<?=$value?>_pie" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
                                </div>

                              <?php } ?>

                              </div>

                              <div class="table-responsive m-t-40"  id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Q_links</th>
                                        <th>Number</th>
                                        <th class="numeric">Signup Date</th>
                                        <th class="numeric">Cohort</th>
                                        <th class="numeric">Entries</th>
                                        <th class="numeric">Login Count</th>
                                        <th class="numeric">Active days</th>

                                        <th class="numeric">Type</th>
                                        <th class="numeric">Date</th>
                                        <th class="numeric">Coins</th>

                                        <th class="numeric">Currency</th>
                                        <th class="numeric">GMV</th>
<!--
                                        <th class="numeric">products</th>
                                        <th class="numeric">accounts</th>
                                        <th class="numeric">customers</th>

                                        <th class="numeric">suppliers</th>
                                        <th class="numeric">employees</th>
                                        <th class="numeric">employee_access</th>

                                        <th class="numeric">sales_invoices</th>
                                        <th class="numeric">sales_return</th>
                                        <th class="numeric">purchase_invoices</th>

                                        <th class="numeric">purchase_return</th>
                                        <th class="numeric">expense</th>
                                        <th class="numeric">payments</th>

                                        <th class="numeric">journal_entries</th>
-->
                                        <th class="numeric">Last Login</th>
                                        <th class="hide_it">Type</th>
                                        <th class="numeric">Industry</th>
                                        <th class="hide_it">Business Name</th>
                                        <th class="hide_it">Email</th>

                                        <th class="hide_it">continent_name</th>
                                        <th class="hide_it">country_name</th>
                                        <th class="hide_it">country_code_iso</th>
                                        <th class="hide_it">region_name</th>
                                        <th class="hide_it">city</th>

                                        <th class="hide_it">status</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php

                                  $where = '';


                                  if(isset($_GET['business_type']) )
                                  {
                                    if($_GET['business_type']=='*')
                                    {
                                      $where .= ' ';
                                    }elseif($_GET['business_type']=='Wholesaller')
                                    {
                                      $where .= " and `business_type`='Wholesaller' ";
                                    }elseif($_GET['Retailer']=='Retailer')
                                    {
                                      $where .= " and `business_type`='Retailer' ";
                                    }elseif($_GET['business_type']=='Distributor')
                                    {
                                      $where .= " and `business_type` = 'Distributor' ";
                                    }
                                  }

                                  if(isset($_GET['industry_type']) )
                                  {
                                    if($_GET['industry_type']=='*')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `industry_type`='".$_GET['industry_type']."' ";
                                    }
                                  }

                                  if(isset($_GET['cohort']) )
                                  {
                                    if($_GET['cohort']=='*')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `cohort`='".$_GET['cohort']."' ";
                                    }
                                  }

                                  if(isset($_GET['country_code']) )
                                  {
                                    if($_GET['country_code']=='*')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `country_code`='".$_GET['country_code']."' ";
                                    }
                                  }

                                  if(isset($_GET['currency']) )
                                  {
                                    if($_GET['currency']=='*')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `currency`='".$_GET['currency']."' ";
                                    }
                                  }

                                  if(isset($_GET['membership']) )
                                  {
                                    if($_GET['membership']=='*')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `type`='".$_GET['membership']."' ";
                                    }
                                  }

                                  if(isset($_GET['from_date'])  )
                                  {
                                    if($_GET['from_date']=='')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `timestamp` > '".strtotime($_GET['from_date'])."' ";
                                    }
                                  }

                                  if(isset($_GET['to_date']) )
                                  {
                                    if($_GET['to_date']=='')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `timestamp` < '".strtotime($_GET['to_date'])."' ";
                                    }
                                  }

                                  if(isset($_GET['number']) )
                                  {
                                    if($_GET['number']=='')
                                    {
                                      $where .= ' ';
                                    }else
                                    {
                                      $where .= " and `number` like '%".$_GET['number']."%' ";
                                    }
                                  }

                                  $limit = 'limit 100 ';
                                  if(isset($_GET['limit']) )
                                  {
                                    if($_GET['limit']=='')
                                    {
                                      $limit = 'limit 100 ';
                                    }else
                                    {
                                      $limit = " limit ".$_GET['limit'];
                                    }
                                  }

                                  if(isset($_SESSION['sess_bp_admin_privs']))
                                  {
                                    if($_SESSION['sess_bp_admin_privs']!=='*')
                                    {
                                      $where.=" and $_SESSION[sess_bp_admin_privs]";
                                    }
                                  }

                                  $i=1;

                                  $long_msg="Hello, ";

                                    $select_qry="select * from `users` where 1=1 $where $all_status_where order by `id` desc ".$limit;
                                    //  echo $select_qry;
//                                    $ip_access_key = '2952774e664b62089373947213576930';
                                    foreach ($db->query($select_qry) as $row) {

                                      if(isset($users['cohort'][$row['cohort']]))
                                      {
                                        $users['cohort'][$row['cohort']]++;
                                      }else{
                                        $users['cohort'][$row['cohort']]=1;
                                      }

                                      if(isset($users['entries'][$row['entries']]))
                                      {
                                        $users['entries'][$row['entries']]++;
                                      }else{
                                        $users['entries'][$row['entries']]=1;
                                      }

                                      if(isset($users['type'][$row['type']]))
                                      {
                                        $users['type'][$row['type']]++;
                                      }else{
                                        $users['type'][$row['type']]=1;
                                      }

                                      if(isset($users['business_type'][$row['business_type']]))
                                      {
                                        $users['business_type'][$row['business_type']]++;
                                      }else{
                                        $users['business_type'][$row['business_type']]=1;
                                      }

                                      if(isset($users['industry_type'][$row['industry_type']]))
                                      {
                                        $users['industry_type'][$row['industry_type']]++;
                                      }else{
                                        $users['industry_type'][$row['industry_type']]=1;
                                      }

                                      if(isset($users['country_name'][$row['country_name']]))
                                      {
                                        $users['country_name'][$row['country_name']]++;
                                      }else{
                                        $users['country_name'][$row['country_name']]=1;
                                      }

                                      if(isset($users['region_name'][$row['region_name']]))
                                      {
                                        $users['region_name'][$row['region_name']]++;
                                      }else{
                                        $users['region_name'][$row['region_name']]=1;
                                      }

                                      if(isset($users['city'][$row['city']]))
                                      {
                                        $users['city'][$row['city']]++;
                                      }else{
                                        $users['city'][$row['city']]=1;
                                      }

                                    if(isset($_GET['refresh_stat']))
                                    {
/*
                                      // set IP address and API access key
                                      $ip = $row['ip'];

                                      // Initialize CURL:
                                      $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$ip_access_key.'');
                                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                      // Store the data:
                                      $json = curl_exec($ch);
                                      curl_close($ch);

                                      // Decode JSON response:
                                      $ip_api_result = json_decode($json, true);

                                      //print_r($api_result);

                                      // Output the "capital" object inside "location"
                                    //  echo $api_result['location']['capital'];

                                      $continent_name = $ip_api_result['continent_name'];
                                      $country_name = $ip_api_result['country_name'];
                                      $country_code_iso = $ip_api_result['country_code'];
                                      $region_name = $ip_api_result['region_name'];
                                      $city = $ip_api_result['city'];

*/
                                      $wheres = "`owner_mobile`='".$row['number']."'";

                                      $entries =cnrm($db,'journal',$wheres);
                                      $active_days =cnrm($db,'graph',$wheres);

                                      $where_customers = $wheres . " and `type`='customer' ";
                                      $where_supplier = $wheres . " and `type`='supplier' ";
                                      $where_employees = $wheres . " and `type`='employee' ";
                                      $where_gmv = $wheres . " and `account_head`='Capital' ";



                                      $products =cnrm($db,'products',$wheres);
                                      $accounts =cnrm($db,'chartofaccount',$wheres);

                                      $customers =cnrm($db,'contacts',$where_customers);
                                      $suppliers =cnrm($db,'contacts',$where_supplier);
                                      $employees =cnrm($db,'contacts',$where_employees);

                                      $employee_access =cnrm($db,'user_access',$wheres);
                                      $sales_invoices =cnrm($db,'sale_invoices',$wheres);
                                      $sales_return =cnrm($db,'sale_invoices_returns',$wheres);
                                      $purchase_invoices =cnrm($db,'purchase_invoices',$wheres);
                                      $purchase_return =cnrm($db,'purchase_invoices_returns',$wheres);
                                      $expense =cnrm($db,'expense',$wheres);
                                      $payments = cnrm($db,'payments',$wheres);
                                      $journal_entries = cnrm($db,'journal_entries',$wheres);



                                      $update_qry_user = "update `users` set `entries`='$entries', `active_days`='$active_days', `products`='$products', `accounts`='$accounts', `customers`='$customers', `suppliers`='$suppliers', `employees`='$employees', `employee_access`='$employee_access', `sales_invoices`='$sales_invoices', `sales_return`='$sales_return', `purchase_invoices`='$purchase_invoices',  `purchase_return`='$purchase_return',  `expense`='$expense', `payments`='$payments',  `journal_entries`='$journal_entries' where `id`='$row[id]' ";

                                      $stmt=$db->prepare($update_qry_user);
                                      $stmt->execute();

                                    }
                                    $gmv = gnrm($db,'chartofaccount',"`owner_mobile`='$row[number]' and `account_head`='Capital'",'balance');
                                    $whatsapp_link = 'https://wa.me/'.str_replace('-','',str_replace('+','',$row['number'])).'?text='.urlencode($long_msg);
                                      // owner_mobile
                                   ?>
                                    <tr>
                                      <td><?=$row['id']?></td>
                                      <td data-title="" class="bolder"><a href="" class="editmodalbtn" rel="<?=$row['id']?>"><?=$row['business_name']?></a>
                                      </td>
                                      <td data-title="" class="bolder">
                                        <a href="<?=$whatsapp_link?>" target="_blank" class="btn btn-sm btn-secondary">WA</a>
                                        <a id="userid_<?=$row['id']?>"  data-toggle="modal" href="#"  target="_blank" class="btn btn-sm btn-success buy_packages" data-userid="<?=$row['id']?>">P</a>
                                        <?php if($_SESSION['sess_bp_admin_privs']=='*'){ ?>

                                          <a id="userid_<?=$row['id']?>"  data-toggle="modal" href="#"  target="_blank" class="btn btn-sm btn-success edit_user_modal" data-userid="<?=$row['id']?>">H</a>
                                        <a href='https://app.fullstory.com/ui/QV62D/segments/everyone/people:search:((NOW%2FDAY-29DAY:NOW%2FDAY%2B1DAY):((UserEmail:==:"<?=urlencode($row['number'])?>")):():():():)/0' target="_blank" class="btn btn-sm btn-secondary">FS</a>
                                        <a href="dashboard.php?gfsoul_session_set=<?=urlencode($row['number'])?>" target="_blank" class="btn btn-sm btn-
                                          secondary">DB</a>

                                        <?php } ?>
                                      </td>
                                      <td data-title="cohort: "> <?=$row['number']?></td>
                                      <td data-title="Signup: "><?=date("Y-m-d",$row['timestamp'])?></td>
                                      <td data-title="cohort: "><a href="a-users.php?cohort=<?=$row['cohort']?>"><?=$row['cohort']?></a></td>
                                      <td data-title="entries: "><?=$row['entries']?></td>
                                      <td data-title="entries: "><?=$row['login_count']?></td>
                                      <td data-title="active_days: "><?=$row['active_days']?></td>

                                      <td data-title="Type: "><?=$row['type']?></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Coins: "><?=$row['coins']?></td>

                                      <td data-title="Currency: "><?=$row['currency']?></td>
                                      <td data-title="GMV: "><?=$gmv?></td>
<!--
                                      <td data-title="products: "><?=$row['products']?></td>
                                      <td data-title="accounts: "><?=$row['accounts']?></td>
                                      <td data-title="customers: "><?=$row['customers']?></td>

                                      <td data-title="suppliers: "><?=$row['suppliers']?></td>
                                      <td data-title="employees: "><?=$row['employees']?></td>
                                      <td data-title="employee_access: "><?=$row['employee_access']?></td>

                                      <td data-title="sales_invoices: "><?=$row['sales_invoices']?></td>
                                      <td data-title="sales_return: "><?=$row['sales_return']?></td>
                                      <td data-title="purchase_invoices: "><?=$row['purchase_invoices']?></td>

                                      <td data-title="purchase_return: "><?=$row['purchase_return']?></td>
                                      <td data-title="expense: "><?=$row['expense']?></td>
                                      <td data-title="payments: "><?=$row['payments']?></td>

                                      <td data-title="journal_entries: "><?=$row['journal_entries']?></td>
-->
                                      <td data-title="Last: "><?=date("Y-m-d",$row['last_updated'])?></td>
                                      <td data-title="Type: "><?=$row['business_type']?></td>
                                      <td data-title="Industry: "><?=$row['industry_type']?></td>
                                      <td data-title="Name: "><?=$row['business_name']?></td>
                                      <td data-title="Email: "><?=$row['email']?></td>


                                      <td data-title="continent_name: "><?=$row['continent_name']?></td>
                                      <td data-title="country_name: "><?=$row['country_name']?></td>
                                      <td data-title="country_code_iso: "><?=$row['country_code_iso']?></td>
                                      <td data-title="region_name: "><?=$row['region_name']?></td>
                                      <td data-title="city: "><?=$row['city']?></td>



                                      <td data-title="Status"><?=$row['status']?>

                                        <?php if($_SESSION['sess_bp_admin_privs']=='*'){ ?>

                                        <a rel="<?=$row['number']?>" href="a-users.php" onclick='return delete_user("<?=$row['number']?>");' class="delbtn text-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>

                                      <?php }?></td>
                                    </tr>
                                    <?php
                                    $i++;

                                    }

                                   ?>
                                </tbody>
                              </table>


                              <?php

                              ksort($users['cohort']);
                              ksort($users['entries']);
                              ksort($users['type']);
                              arsort($users['business_type']);
                              arsort($users['industry_type']);
                              arsort($users['country_name']);
                              arsort($users['region_name']);
                              arsort($users['city']);

                               ?>

                              </div>

                              <br>
                              <p>
                              <a href="a-users.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                              <a href="a-users.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                              </p>
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
          $(document).on('click','tr',function(){
            $(this).toggleClass('table-success');
          });

          $(document).ready(function(e){
            <?php
            foreach ($users as $key => $value) {
              // code...

             ?>

            // ==============================================================
            // doughnut chart option
            // ==============================================================
            var doughnutChart_<?=$key?> = echarts.init(document.getElementById('<?=$key?>_pie'));

            // specify chart configuration item and data

            option = {
                tooltip : {
                    trigger: '<?=$key?>',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient : 'vertical',
                    x : 'left',
                    data:[<?php foreach ($users[$key] as $key_in => $value_in) { echo "'".str_replace('"', '', str_replace("'", '', $key_in))."', "; } ?>]
                },
                toolbox: {
                    show : true,
                    feature : {
                        dataView : {show: true, readOnly: false},
                        magicType : {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'center',
                                    max: 1548
                                }
                            }
                        },
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                color: ["#3998f5","#fcff5d","#7dfc00","#0ec434","#228c68","#8ad8e8","#235b54","#29bdab","#201923","#37294f","#277da7","#3750db","#f22020","#991919","#ffcba5","#e68f66","#c56133","#96341c","#632819","#ffc413","#f47a22","#2f2aa0","#b732cc","#772b9d","#f07cab","#d30b94","#edeff3","#c3a5b4","#946aa2","#5d4c86"],
                calculable : true,
                series : [
                    {
                        name:'Source',
                        type:'pie',
                        radius : ['50%', '90%'],
                        itemStyle : {
                            normal : {
                                label : {
                                    show : false
                                },
                                labelLine : {
                                    show : false
                                }
                            },
                            emphasis : {
                                label : {
                                    show : true,
                                    position : 'center',
                                    textStyle : {
                                        fontSize : '30',
                                        fontWeight : 'bold'
                                    }
                                }
                            }
                        },
                        data:[
                          <?php foreach ($users[$key] as $key_in => $value_in) { echo "{value:".$value_in.", name:'".str_replace('"', '', str_replace("'", '', $key_in))."'},"; } ?>
                        ]
                    }
                ]
            };


            // use configuration item and data specified to show chart
            doughnutChart_<?=$key?>.setOption(option, true), $(function() {
                        function resize() {
                            setTimeout(function() {
                                doughnutChart_<?=$key?>.resize()
                            }, 100)
                        }
                        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
                    });
                    <?php } ?>

          });
        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
