<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Sales History by Customer';
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
                                    <h3>Customize Sales History</h3>
                                    <form action="" class="" method="get">
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-md-3">
                                            <lable for="contact_name">Contact Name</lable>
                                            <select class="form-control select2" name="contact_name" id="contact_name">
                                              <option value="*">All Contacts</option>
                                              <option value="+0000">Walkin Customer</option>

                                              <?php

                                              $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]'";

                                              $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable','name'=>'Walkin Customer');

                                              foreach ($db->query($contacts_query) as $row)
                                              {
  //                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

  //                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
  //                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                                $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status'],'name'=>$row['name']);
                                               ?>
                                              <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                              <?php
                                                }

                                               ?>
                                            </select>

                                            <?php
                                              $json_contacts=json_encode($contacts_data,true);
                                             ?>
                                             <script type="text/javascript">
                                             <?php
                                             if(isset($_GET['contact_name']))
                                             {
                                               ?>
                                               $('#contact_name').val('<?=$_GET['contact_name']?>');
                                               <?php } ?>

                                               var contacts_data=<?=$json_contacts?>;
                                             </script>
                                          </div>
                                          <div class="col-md-3">
                                            <lable for="product_id">Product</lable>
                                            <select class="form-control select2" name="product_id" id="product_id">
                                              <option value="*">All Products</option>

                                              <?php

                                              $products_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' ";

                                              $products_data=array();

                                              foreach ($db->query($products_query) as $p_row)
                                              {

                                                $products_data[$p_row['id']]=array('name'=>$p_row['name']);
                                               ?>
                                              <option value="<?=$p_row['id']?>"><?=$p_row['name']?></option>
                                              <?php
                                                }

                                               ?>
                                            </select>

                                             <script type="text/javascript">
                                             <?php
                                             if(isset($_GET['product_id']))
                                             {
                                               ?>
                                               $('#product_id').val('<?=$_GET['product_id']?>');
                                               <?php } ?>
                                             </script>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">From Date</label>
                                              <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date'] ?? ''?>">
                                            </div>
                                          </div>
                                          <div class="col-md-3">
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
                                  <?php
                                  $where = 'and 1 = 1 ';
                                  $_GET['c_num']='';
                                  if(isset($_GET['contact_name']) && $_GET['contact_name']!='' && $_GET['contact_name']!='*')
                                  {
                                    $_GET['c_num']=urldecode($_GET['contact_name']);
                                    $where.=" and si.contact_number='$_GET[contact_name]'";
                                  }
                                  if(isset($_GET['product_id']) && $_GET['product_id']!='' && $_GET['product_id']!='*')
                                  {
                                    $where.=" and sh.product_id='$_GET[product_id]'";
                                  }
                                  if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                  {

                                    $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                    $where.= " and sh.date <= '$_GET[to_date]' ";
                                  }
                                  if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                  {
                                    $where.= " and sh.date >= '$_GET[from_date]' ";
                                  }


                                  $select_qry="SELECT * FROM stock_history sh right JOIN sale_invoices si  on sh.invoice_id=si.id where  sh.owner_mobile = '$_SESSION[sess_bp_username]' and sh.in_out='sale' $where ";
//                                    echo $select_qry;
                                  $stmt = $db->prepare($select_qry);
                                  $stmt->execute();
                                  $count = 0;

                                  $rows = $stmt->fetchAll();
                                  //print_r($rows);
                                  $h_rows = Array();

                                    foreach($rows as $row)
                                    {
                                      $this_num = str_replace("+",'',$row['contact_number']);

                                      if(1==1)
                                      {
                                        $h_rows[]=$row;
                                        $count++;
                                      }else{
//                                        echo '<h2>'.$this_num.' '.htmlspecialchars($_GET['c_num']).'</h2><hr />';
                                      }
                                    }


                                    $total_qty=0;
                                    $total_profit=0;
                                    $total_sale=0;
                                    if($count>0)
                                    {
                                      echo '<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                          <th>Customer</th><th>Product</th><th>Date</th><th>Qty</th><th>Unit Price</th><th>Total Price</th><th>Unit</th><th>Profit</th>
                                        </tr></thead><tbody>';
                                      foreach($h_rows as $h_row)
                                      {
                                        if(array_key_exists($h_row['contact_number'],$contacts_data) && array_key_exists($h_row['product_id'],$products_data))
                                        {
                                          $total_qty+=floatval($h_row['qty']);
                                          $total_sale+=floatval($h_row['total_price']);
                                          $total_profit+=floatval($h_row['total_profit']);
                                          echo '<tr><td>'.$contacts_data[$h_row['contact_number']]['name'].' '.$h_row['contact_number'].'</td><td>'.$products_data[$h_row['product_id']]['name'].'</td><th>'.$h_row['date'].'</th><th>'.$h_row['qty'].'</th><th>'.$h_row['unit_price'].'</th><th>'.$h_row['total_price'].'</th><th>'.$h_row['measuring_unit'].'</th><th>'.$h_row['total_profit'].'</th></tr>';
                                        }
                                      }
                                      echo '</tbody></table>';
                                      ?>
                                        <table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                          <thead>
                                            <tr>
                                              <th>Total Qty</th>
                                              <th>Total Sale</th>
                                              <th>Total Profit</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><?=$total_qty?></td>
                                              <td><?=$total_sale?></td>
                                              <td><?=$total_profit?></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      <?php
                                    }else{
                                      echo '<h2>No Record Found.</h2>';
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script type="text/javascript" src="js/print.min.js"></script>
    <script type="text/javascript">
      $(document).on('click','.view_invoice_btn',function(e){
        e.preventDefault();
        var inv_id = $(this).attr('rel');
        view_invoice('sale_invoices',inv_id);

      });
      $(document).on('click','#print_printable',function(e){
        e.preventDefault();
        $('.preloader').show();
//          alert('sending print.');
        printJS('invoice_printable_area', 'html');
        $('.preloader').hide();
      });



              $(document).on('click','.delete_btn',function(e)
              {

                e.preventDefault();
                $('.preloader').show();

                var this_id = $(this).attr('rel');

                var formdata = {"invoiceid":this_id};
                $.post( "t-sale-delete.process.php", formdata)
                  .done(function( data ) {
                    if(isValidJSONString(data))
                    {
                      var response = jQuery.parseJSON( data );
                      if(response.code == 200){

                          swal({
                             title: 'Submited!',
                             text: 'Record has been Deleted successfully.',
                             timer: 2000,
                             type: 'success',
                             showConfirmButton: false
                          });
                          window.location.href='h-sale.php';


                      }else{
                          $("#msgholder").html(response.msg);
                          $("#msgholder").removeClass('d-none');
                          $('.preloader').hide();
                      }

                    }else{
                      $("#msgholder").html(data);
                      $("#msgholder").removeClass('d-none');
                      $('.preloader').hide();
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
                      setTimeout(function(){ window.location.reload(); }, 5000);
                    });
              });
    </script>
</body>
</html>
