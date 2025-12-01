<?php
  require_once("t-sale.config.php");
  $meta['info']['title'] = 'Most Sold Products';
  $meta['info']['des'] = '';
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
                    <h3 class="text-themecolor">Most Sold Items</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
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

                                <?php
                                  if(isset($_GET['tag']))
                                  {
                                    ?>
                                    <div class="col-md-6">
                                        <h5>Tag: <a href="r-sold-items.php" class="btn btn-danger"><i class="fa fa-close"></i> <?=$_GET['tag']?></a></h5>
                                    </div>
                                    <div class="col-md-6">
                                      <a class="btn btn-info waves-effect waves-light" href="su-products.php?tag=<?=$_GET['tag']?>">Products</a>
                                      <a class="btn btn-info waves-effect waves-light" href="r-sales.php?tag=<?=$_GET['tag']?>">Sales Invoices</a>
                                      <a class="btn btn-info waves-effect waves-light" href="r-stock.php?tag=<?=$_GET['tag']?>">Stock Report</a>
                                    </div>
                                  <?php
                                  }
                                  ?>


                              </div>


                        <div class="row">
                            <div class="col-md-12">
                              <h3>Filter Results</h3>
                              <form action="" class="" method="get">
                                <div class="form-body">
                                  <div class="row">
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
                              </form>
                            </div>

                        </div>
                              <?php
                                $where = '';


                                if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                {

                                  $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                  $where.= " and `date` <= '$_GET[to_date]' ";
                                }
                                if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                {
                                  $where.= " and `date` >= '$_GET[from_date]' ";
                                }

                              ?>


                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Total Sold Stock</th>
                                        <th>Total Sale</th>
                                        <th>Total Gross Profit</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td data-title="Total Stock sold: " id="total_sold_stock"></td>
                                      <td data-title="Total Sale: " id="total_sale"></td>
                                      <td class="bolder" data-title="Profit: " id="total_profit"></td>
                                    </tr>
                                  </tbody>
                                </table>


                              <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                    <tr class="cf">
                                      <th>Name</th>
                                      <th>Sold Qty</th>
                                      <th>Total Price</th>
                                      <th>Total Profit</th>
                                    </tr>
                                </thead>
                              <tbody>
                                <?php
                                  $total_sold_stock=0;
                                  $total_sale=0;
                                  $total_profit=0;

                                  $tags=array();
                                  if(isset($_GET['tag']) && $_GET['tag']!='')
                                  {
                                    $select_tag_products_qry="select id,name,tags from `products` where `owner_mobile`='$_SESSION[sess_bp_username]'  and `tags` like '%$_GET[tag]%'";
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
                                        $where.= "`product_id` = '".$tag."' or ";
                                      }

                                      $where = rtrim($where,'or ');
                                      $where.= ")";
                                    }else{
                                      $where .= " and  1 = 2 ";
                                    }
                                  }


                                  $select_qry="select sum(`qty`) as sold_qty,sum(`total_price`) as total_price, sum(`total_profit`) as total_profit, product_id, measuring_unit from `stock_history` where `owner_mobile`='$_SESSION[sess_bp_username]' and `in_out`='sale' $where group by `product_id` order by `id` desc";

//                                  echo $select_qry;

                                  foreach ($db->query($select_qry) as $row)
                                  {
                                   ?>
                                      <tr>
                                        <td class="bolder"><?=gnr($db,'products','id',$row['product_id'],'name')?></td>
                                        <td data-title="Qty: "><?=$row['sold_qty']?></td>
                                        <td data-title="Total Price: "><?=$row['total_price']?></td>
                                        <td data-title="Total Profit: "><?=$row['total_profit']?></td>
                                      </tr>
                                      <?php
                                    $total_sold_stock=$total_sold_stock+$row['sold_qty'];
                                    $total_sale=$total_sale+$row['total_price'];
                                    $total_profit=$total_profit+$row['total_profit'];
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
      $("#total_sold_stock").html("<?=$total_sold_stock?>");
      $("#total_sale").html("<?=$total_sale?>");
      $("#total_profit").html("<?=$total_profit?>");
    </script>
</body>
</html>
