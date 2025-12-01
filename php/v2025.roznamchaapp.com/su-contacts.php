<?php
  require_once("su-contacts.config.php");
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
          });
    });

    $(document).on('click','.changebalancebtn',function(e){
      e.preventDefault();
      $("#updatebalance").toggle('show');

    });

    $(document).on('click','.edit_number_btn',function(e){
      e.preventDefault();
      $(".changenumberdiv").toggleClass('hide');

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
      $('.preloader').show();
        $.get( "<?=$meta['module'][1]?>-new.php", function( data ) {
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
               text: 'These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support. <ul><li>'+ jqXHR +'</li> <li>'+textStatus+'</li></ul>',
               timer: 2000,
               type: 'danger',
               showConfirmButton: false
            });

          });;


    });

  });

  function calc_new_balance()
  {
    var old_balance = parseFloat($("#old_balance").val());
    var old_balance_status = $('#old_balance_status').val();

    var newbalance = parseFloat($('#newbalance').val());
    var newbalance_status = $("#newbalance_status").val();

    alert("old_balance: "+old_balance);
    alert("newbalance: "+newbalance);

    var entry_amount = 0;
    var entry_type = 'debit';

    var contact_number = $("#updatebalance #contact_number").val();

    if(old_balance_status==newbalance_status)
    {
      if(old_balance>newbalance)
      {
        entry_amount = parseFloat(old_balance) - parseFloat(newbalance);

        if(old_balance_status=='debit')
        {
          entry_type = 'credit';
        }else{
          entry_type = 'debit';
        }
      }else{
        entry_amount = parseFloat(newbalance) - parseFloat(old_balance);
        entry_type = newbalance_status;
      }
    }else{
      entry_type = newbalance_status;
      entry_amount = parseFloat(old_balance) + parseFloat(newbalance);
    }

    alert("entry_amount: "+entry_amount);

    var formdata = { "number":contact_number, "entry_type":entry_type, "entry_amount":entry_amount };
    console.log(formdata);

    alert(formdata);

    $.post( "su-contacts-update_balance.process.php", formdata)
      .done(function( data ) {
        alert(data);
        if(data=='success')
        {
          swal({
             title: 'Success!',
             text: 'Contact has been updated successfully...',
             timer: 2000,
             type: 'success',
             showConfirmButton: false
          });
          setTimeout(function(){ window.location.reload(); }, 1500);

        }else{
          swal({
             title: 'Error!',
             text: 'Record not saved.',
             timer: 2000,
             type: 'danger',
             showConfirmButton: false
          });
          alert("Erorr while updating. Please contact support with screenshot. " + data);
        }
      });

  }

  function  change_number_request()
  {
    var old_number = $('#old_number').val();
    var new_mobile = $('#mobile').val();
    var new_country_code = $('#country_code').val();

    var new_number = new_country_code + '-'+new_mobile;

    var formdata = { "old_number":old_number, "new_number":new_number, "country_code": new_country_code, "mobile": new_mobile};

    $.post( "su-contacts-update_number.process.php", formdata)
      .done(function( data ) {
        alert(data);
        if(data=='success')
        {
          swal({
             title: 'Success!',
             text: 'Contact has been updated successfully...',
             timer: 2000,
             type: 'success',
             showConfirmButton: false
          });
          setTimeout(function(){ window.location.reload(); }, 1500);

        }else{
          swal({
             title: 'Error!',
             text: 'Record not saved.',
             timer: 2000,
             type: 'danger',
             showConfirmButton: false
          });
          alert("Erorr while updating. Please contact support with screenshot. " + data);
        }
      });

  }
  $(document).on("click",'#update_balance_submit',function(e) {
        calc_new_balance();
  });

  $(document).on("click",'#update_number_btn',function(e) {
        change_number_request();
  });



</script>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->


                <div id="import-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import <?=ucwords($meta['info']['title'])?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                              <!-- Validation wizard -->
                              <div class="row" id="validation">
                                  <div class="col-12">
                                      <div class="card wizard-content">
                                          <div class="card-body">
                                            <form class="" action="index.html" id="uploadform" method="post" enctype="multipart/form-data">
                                              <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="csv">Select CSV File: <span class="text-danger">*</span></label>
                                                    <input type='file' name='file' id='file' class='form-control' >

                                                  </div>
                                                </div>

                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <input type='button' class='btn btn-info' value='Upload' id='upload'>
                                                    <a href="contacts-sample.csv" download="Contacts-sample.csv" class="btn btn-inverse">
                                                      Download Sample File
                                                    </a>
                                                  </div>
                                                  </div>
                                                </div>
                                            </form>
                                            <div id='preview'></div>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modaldiv"></div>

                <a id="newmodalbtn" href="#" class="btn btn-sm pull-right btn-info" data-toggle="modal">Add New</a>
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                              <?php
                              $where = '';
                              if(isset($_GET['type']))
                              {
                                $where = " and `type`='".strtolower($_GET['type'])."' ";
                              }

                                $select_qry="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' $where $all_status_where order by `name` asc";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();

                              $count_rows = $stmt->rowCount();

                              if($count_rows>0)
                              {

                               ?>
                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Contact Name</th>
                                        <th>Current Balance</th>
                                        <th>Balance Status</th>
                                        <th>City</th>
                                        <th>Tag</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                    foreach ($db->query($select_qry) as $row) {

                                      //$contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";
//                                      echo $contact_where;

$sms_text = "Hello ".$row['name'].'! your current balance is: '.$row['balance'].'  '.$_SESSION['sess_bp_name'];
$whatsapp_msg= "Hello *".$row['name']."*!

Your current balance is: *".$row['balance']."*

*".trim($_SESSION['sess_bp_name'])."*
Address: ".$_SESSION['sess_bp_adr']."
Call: ".$_SESSION['sess_bp_username']."

Software by www.baseplan.pk
Thank you, Visit again.";

$whatsapp_link = 'https://api.whatsapp.com/send?phone='.str_replace('-','',str_replace('+','',$row['number'])).'&text='.urlencode($whatsapp_msg);

                                   ?>
                                    <tr>
                                      <td data-title=""> <span  class="bolder"><a href="" rel="<?=$row['id']?>" class="editmodalbtn"><?=$row['name']?></span><br /><?=$row['number']?></a>
                                        <button class="expand_btn pull-right d-md-none d-lg-none"><i class="mdi mdi-menu-right"></i></button>
                                      </td>
                                      <td><a href="r-ledgerview.php?id=c<?=urlencode($row['number'])?>" class="<?php if($row['balance_status']=='debit'){ echo 'green-text';}else{ echo 'red-text';} ?>"><?php if($row['balance'])
                                       { echo number_format($row['balance'],2); }else{ echo '0.00';} ?> </a>
                                      </td>
                                      <td>
                                         <span  class="<?php if($row['balance_status']=='debit'){ echo 'green-text';}else{ echo 'red-text';} ?>"><?=$row['balance_status']?></span>
                                      </td>
                                      <td data-title="City: " class="mobile_collapse">
                                        <?=$row['city']?>
                                      </td>
                                      <td data-title="Tag: " class="mobile_collapse">
                                        <?=$row['tags']?>
                                      </td>
                                      <td data-title="Due Date: " class="mobile_collapse">
                                        <?=$row['duedate']?>
                                      </td>
                                      <td data-title="" class="bolder mobile_collapse">
                                        <a href="" rel="<?=$row['id']?>" class="editmodalbtn btn btn-sm btn-warning">Edit</a>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm"  onclick="location.href='r-ledgerview.php?id=c<?=urlencode($row['number'])?>';">Ledger</button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(75px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="r-ledgerview-detailed.php?id=c<?=urlencode($row['number'])?>">Detailed</a>
                                            </div>
                                        </div>

                                        <a href="tel:<?=$row['number']?>" class="btn btn-sm btn-info">Call</a>
                                        <a href="sms:<?=$row['number']?>?body=<?=urlencode($sms_text)?>" class="btn btn-sm btn-primary">SMS</a>
                                        <a target="_blank" href="<?=$whatsapp_link?>" class="btn btn-sm btn-success">WhatsApp</a>
                                        <a href="su-contacts-gallery.php?id=<?=$row['id']?>" rel="<?=$row['id']?>" class="photos btn btn-sm btn-primary">Photos</a>

                                      </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                   ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-none d-lg-block d-xl-block">
                          Toggle column:
                            <a class="toggle-vis btn btn-link btn-sm" data-column="0">Contact Name</a> -
                            <a class="toggle-vis btn btn-link btn-sm" data-column="1">Current Balance</a> -
                            <a class="toggle-vis btn btn-link btn-sm" data-column="2">Balance Status</a> -
                            <a class="toggle-vis btn btn-link btn-sm" data-column="3">City</a> -
                            <a class="toggle-vis btn btn-link btn-sm" data-column="4">Due Date</a> -
                            <a class="toggle-vis btn btn-link btn-sm" data-column="5">Action</a>
                        </div>
                                <div class="advance_search hide">
                                  <h3>Advance Search</h3>
                                <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                        					<thead>
                        						<tr>
                        							<th>Target</th>
                        							<th>Search text</th>
                        							<th>Treat as regex</th>
                        							<th>Use smart search</th>
                        						</tr>
                        					</thead>
                        					<tbody>
                        						<tr id="filter_global">
                        							<td>Global search</td>
                        							<td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                        							<td align="center"><input type="checkbox" class="global_filter" id="global_regex"></td>
                        							<td align="center"><input type="checkbox" class="global_filter" id="global_smart" checked="checked"></td>
                        						</tr>
                        						<tr id="filter_col1" data-column="0">
                        							<td>Column - Contact Name</td>
                        							<td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col0_regex"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col0_smart" checked="checked"></td>
                        						</tr>
                        						<tr id="filter_col2" data-column="1">
                        							<td>Column - Current Balance</td>
                        							<td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col1_regex"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col1_smart" checked="checked"></td>
                        						</tr>
                        						<tr id="filter_col3" data-column="2">
                        							<td>Column - City</td>
                        							<td align="center"><input type="text" class="column_filter" id="col2_filter"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col2_regex"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col2_smart" checked="checked"></td>
                        						</tr>
                        						<tr id="filter_col4" data-column="3">
                        							<td>Column - Due Date</td>
                        							<td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col3_regex"></td>
                        							<td align="center"><input type="checkbox" class="column_filter" id="col3_smart" checked="checked"></td>
                        						</tr>
                        					</tbody>
                        				</table>
                              </div>
                             <br>
                              <p>
                                <a href="su-contacts.php?type=<?php if(isset($_GET['type'])) { echo $_GET['type']; } ?>&show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                                <a href="su-contacts.php?type=<?php if(isset($_GET['type'])) { echo $_GET['type'];} ?>" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                              </p>
                              <?php
                              }
                             ?>
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
            var switchStatus = false;
            $('#show_all_status').on('change', function() {
                var old_url = 'su-contacts.php?type=<?php if(isset($_GET['type'])){ echo $_GET['type']; }?>';

                if ($(this).is(':checked')) {
                    switchStatus = $(this).is(':checked');
                    var new_url = old_url+'&show_all_status=yes';
                }
                else {
                   switchStatus = $(this).is(':checked');
                   var new_url = old_url+'&show_all_status=no';
                }

                alert(new_url);
            });
        </script>

        <script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript">

        $(document).ready(function(){
          $('#upload').click(function(){
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            alert('ready to Upload.');
            // AJAX request
            $.ajax({
              url: 'su-contacts-import.process.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                alert(response);
                console.log(response);
                alert('Process completed. Please check manually, if your all products imported successfully.');
                window.location.reload();
              }
            });
          });

          $(document).on('click','#importmodalbtn',function(e){
            e.preventDefault();
            $('#import-modal').modal('show');
          });
        });

        </script>

    <!-- Style switcher -->
    <!-- ============================================================== -->
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
