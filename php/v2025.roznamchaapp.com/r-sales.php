<?php
  require_once("t-sale.config.php");
  $meta['info']['title']='Sales Report';
  $meta['info']['des']='Cash and Credit Sales | Sales for Customer';
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
                                    <h3>Customize Sales Report</h3>
                                    <form action="" class="" method="get">
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-md-3">
                                            <label for="">Sale Type</label>
                                            <select name="sale_type" class="form-control" id="sale_type">
                                              <option value="*">All</option>
                                              <option value="cash">Cash (Paid in Full)</option>
                                              <option value="credit">Credit Sales (No amount paid)</option>
                                              <option value="partial">Partially Paid</option>
                                            </select>
                                          </div>

                                          <div class="col-md-3">
                                            <label for="">Customer</label>
                                            <select name="customer" class="form-control select2" id="customer">
                                              <option value="*">All</option>
                                              <option value="+0000">Walk in Customer</option>
                                              <?php
                                                $select_contacts_qry="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='customer' ";
                                                foreach ($db->query($select_contacts_qry) as $row) {
                                                  ?>
                                                    <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                                  <?php
                                                }
                                              ?>
                                            </select>
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

                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">Tag</label>
                                              <input type="text" name="tag" class="form-control" id="tag" value="<?php if(isset($_GET['tag'])){ echo $_GET['tag'];}?>">
                                            </div>
                                          </div>

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

                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Total Sale</th>
                                        <th>Total Amount Received</th>
                                        <th>Total Remaining Amount</th>
                                        <th>Total Cost of Sale</th>
                                        <th>Total Profit</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <tr>
                                    <td data-title="Sale: " id="total_sale"></td>
                                    <td data-title="Amount Received: " id="total_amount_received"></td>
                                    <td data-title="Remaining: " id="total_remaining"></td>
                                    <td data-title="Cost of sale: " id="total_cost_of_sale"></td>
                                    <td data-title="Profit: " id="total_profit"></td>
                                  </tr>
                                </tbody>
                              </table>


                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Contact Number</th>
                                        <th>Added By</th>
                                        <th>Grand total</th>
                                        <th>Amount Received</th>
                                        <th>Remaining Amount</th>
                                        <th>Payment Method</th>
                                        <th>Cost of Sale</th>
                                        <th>Profit</th>
                                        <th>Action</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                    $where = '';


                                    if(isset($_GET['sale_type']) )
                                    {
                                      if($_GET['sale_type']=='*')
                                      {
                                        $where .= ' ';
                                      }elseif($_GET['sale_type']=='cash')
                                      {
                                        $where .= " and `remaining_amount`='0' ";
                                      }elseif($_GET['sale_type']=='credit')
                                      {
                                        $where .= " and `amount_paid`='0' ";
                                      }elseif($_GET['sale_type']=='partial')
                                      {
                                        $where .= " and `remaining_amount` > '0' and `amount_paid` > '0' ";
                                      }
                                    }

                                    if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                    {

                                      $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                      $where.= " and `date` <= '$_GET[to_date]' ";
                                    }
                                    if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                    {
                                      $where.= " and `date` >= '$_GET[from_date]' ";
                                    }

                                    if(isset($_GET['customer']))
                                    {
                                      if($_GET['customer']=='*')
                                      {
                                        $where.= ' ';
                                      }else
                                      {
                                        $where.= " and `contact_number` = '$_GET[customer]' ";
                                      }
                                    }

                                    $tags=array();
                                    if(isset($_GET['tag']) && $_GET['tag']!='')
                                    {
                                      $select_tag_products_qry="select id,name,tags from `products` where (`status`='published' or `status`='Published') and `owner_mobile`='$_SESSION[sess_bp_username]'  and `tags` like '%$_GET[tag]%'";
                                      $res=$db->query($select_tag_products_qry);
                                      $count_tag_rows = $res->rowCount();
                                      if($count_tag_rows>0)
                                      {
                                        foreach ($db->query($select_tag_products_qry) as $row) {
                                          $tags[]=$row[0];
                                        }

                                        $where.=" and (";
                                        foreach($tags as $tag)
                                        {
                                          $where.= "`cartitems` like '%\"item_id\":\"".$tag."\"%' or ";
                                        }

                                        $where = rtrim($where,'or ');
                                        $where.= ")";
                                      }else{
                                        $where .= " and  1 = 2 ";
                                      }
                                    }
                                    $total['sale']=0;
                                    $total['amount_received']=0;
                                    $total['remaining_amount']=0;
                                    $total['cost_of_sale']=0;
                                    $total['profit']=0;

                                    $select_qry="select * from `sale_invoices` where `owner_mobile`='$_SESSION[sess_bp_username]' $where order by `id` desc";

                                    foreach ($db->query($select_qry) as $row) {
                                      if ($row['amount_paid']<0.001)
                                      {
                                        $row['amount_paid']=0;
                                      }
                                      $total['sale']=intval($total['sale'])+intval($row['grand_total']);
                                      $total['amount_received']=intval($total['amount_received'])+intval($row['amount_paid']);
                                      $total['remaining_amount']=intval($total['remaining_amount'])+intval($row['remaining_amount']);
                                      $total['cost_of_sale']=intval($total['cost_of_sale'])+intval($row['cost_of_sale']);
                                      $total['profit']=intval($total['profit'])+intval($row['grand_total'])-intval($row['cost_of_sale']);
                                   ?>
                                    <tr>
                                      <td class="bolder"><?=$row['id']?>
                                      <a href="h-sale-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">Invoice</a></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Contact: "><?php if($row['contact_number']=='+0000'){echo 'Walkin Customer';}else{ echo gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[contact_number]' ",'name'); }?> <br> (<?=$row['contact_number']?>)</td>
                                      <td data-title="Added By: "><?php if($row['added_by']=='+0000'){echo 'Walkin Customer';}else{ echo gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$row[added_by]' ",'name'); }?> <br> (<?=$row['added_by']?>)</td>
                                      <td data-title="Total: "><?=intval($row['grand_total'])?></td>
                                      <td data-title="Amount Received: "><?=intval($row['amount_paid'])?></td>
                                      <td data-title="Remaining: "><?=intval($row['remaining_amount'])?></td>
                                      <td data-title="Payment Method: "><?=gnr($db,'chartofaccount','id',$row['payment_method'],'account_head')?></td>
                                      <td data-title="Cost of sale: "><?=intval($row['cost_of_sale'])?></td>
                                      <td data-title="Profit: "><?=intval($row['grand_total']) - intval($row['cost_of_sale'])?></td>
                                      <td><a href="h-sale-invoice.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">Invoice</a></td>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script type="text/javascript">
      $(document).ready(function(e){
        $("#total_sale").html('<?=$total['sale']?>');
        $("#total_amount_received").html('<?=$total['amount_received']?>');
        $("#total_remaining").html('<?=$total['remaining_amount']?>');
        $("#total_cost_of_sale").html('<?=$total['cost_of_sale']?>');
        $("#total_profit").html('<?=$total['profit']?>');
      });
    </script>

</body>
</html>
