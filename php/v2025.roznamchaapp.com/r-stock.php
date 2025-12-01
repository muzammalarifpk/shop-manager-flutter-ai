<?php
  require_once("t-sale.config.php");
  $meta['module']=array('r-stock','r-stock');
  $meta['info']['title']='Stock Report';
  $meta['info']['des']='Stock Availablility and Value';
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

                              <?php
                                if(isset($_GET['tag']))
                                {
                                  ?>
                                  <div class="col-md-6">
                                      <h5>Tag: <a href="r-stock.php" class="btn btn-danger"><i class="fa fa-close"></i> <?=$_GET['tag']?></a></h5>
                                  </div>
                                  <div class="col-md-6">
                                    <a class="btn btn-info waves-effect waves-light" href="su-products.php?tag=<?=$_GET['tag']?>">Products</a>
                                    <a class="btn btn-info waves-effect waves-light" href="r-sales.php?tag=<?=$_GET['tag']?>">Sales Invoices</a>
                                    <a class="btn btn-info waves-effect waves-light" href="r-sold-items.php?tag=<?=$_GET['tag']?>">Sold Items</a>
                                  </div>
                                <?php
                                }

                                  if(isset($_GET['stock_status']))
                                  {
                                    $stock_status=$_GET['stock_status'];
                                  }else{
                                    $stock_status='*';
                                  }

                                  if(isset($_GET['stock_location']))
                                  {
                                    $stock_location=$_GET['stock_location'];
                                  }else{
                                    $stock_location='*';
                                  }
                                ?>
                                <div class="col-md-12">
                                  <form action="" method="get">
                                    <h4>Filter Stock</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Stock Status</label>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                            <a id="all" type="button" class="btn filter_stock btn-info btn-sm" href="r-stock.php?stock_location=<?=$stock_location?>">All</a>
                                            <a id="available_stock" type="button" class="btn filter_stock btn-secondary btn-sm" href="r-stock.php?stock_status=available_stock&stock_location=<?=$stock_location?>">Available Stock</a>
                                            <a id="low_stock" type="button" class="btn filter_stock btn-secondary btn-sm" href="r-stock.php?stock_status=low_stock&stock_location=<?=$stock_location?>">Low Stock</a>
                                            <a id="out_of_stock" type="button" class="btn filter_stock btn-secondary btn-sm" href="r-stock.php?stock_status=out_of_stock&stock_location=<?=$stock_location?>">Out of Stock</a>

                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="">Location</label>
                                        <select class="form-control" name="stock_location" id="stock_location">
                                          <option value="*">All</option>
                                          <option value="shop">Shop</option>

                                            <?php
                                            $locations_query="select * from `locations` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' order by `name` asc ";

                                            foreach ($db->query($locations_query) as $sl_row)
                                            {
                                              $locations_array['sl_'.$sl_row['id']]=$sl_row['name'];
                                              ?>
                                                <option value="sl_<?=$sl_row['id']?>"><?=$sl_row['name']?></option>
                                            <?php

                                            }
                                            ?>
                                          </select>

                                          <script type="text/javascript">
                                            $("#stock_location").val('<?=$stock_location?>');

                                            $('#stock_location').on('change',function(e){
//                                              alert('location filter changes.');
                                              var stock_status="<?=$stock_status?>";
                                              var location_id=$("#stock_location").val();
//                                              alert(location_id);
//                                              alert(stock_status);

                                              window.location.href='r-stock.php?stock_status='+stock_status+'&stock_location='+location_id;
                                            });
                                          </script>
                                    </div>
                                  </form>
                                </div>
                              </div>

                              <div class="table-responsive m-t-40" id="no-more-tables">
                                <table id="totals_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Item Count</th>
                                        <th>Total Quantity</th>
                                        <th>Stock value</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <tr>
                                    <td class="bolder" id="item_count" data-title="Item Count: "></td>
                                    <td class="bolder" id="total_available_stock" data-title="Total Quantity: "></td>
                                    <td class="bolder" id="total_value" data-title="Total Stock Value: "></td>
                                  </tr>
                                </tbody>
                                </table>
                                <?php
                                  if(substr($stock_location,0,3)=='sl_')
                                  {
//                                    echo '<h2>Filter for a location.</h2>';
                                  }else{
  //                                  echo substr($stock_location,0,3);
                                  }
                                ?>
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr class="cf">
                                        <th>Name</th>
                                        <th>Tags</th>
                                        <th>Available QTY</th>
                                        <th class="<?php if(substr($stock_location,0,3)=='sl_'){echo 'hide_later';}?>">Locations</th>
                                        <th>Min Stock Limit</th>
                                        <th>Purchase cost</th>
                                        <th>Stock value</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php
                                  $all_status_where = '';
                                  if(isset($_GET['tag']))
                                  {
                                    $all_status_where.="and `tags` like '%$_GET[tag]%'";
                                  }
                                  if(isset($_GET['stock_status']))
                                  {
                                    if($_GET['stock_status']=='available_stock')
                                    {
                                        $all_status_where.= " and CAST(`available_stock` AS DECIMAL) > 0 ";
                                    }elseif($_GET['stock_status']=='out_of_stock')
                                    {
                                      $all_status_where.= " and CAST(`available_stock` AS DECIMAL) <= 0 ";
                                    }else{
                                      $all_status_where.= " and CAST(`available_stock` AS DECIMAL) > 0 and CAST(`available_stock` AS DECIMAL) <= CAST(`min_stock_limit` AS DECIMAL) ";
                                    }
                                  }

//                                  print_r($locations_array);


                                    $select_qry="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' $all_status_where order by `id` desc";
//                                    echo $select_qry;
                                    $total_value=0;
                                    $total_available_stock=0;
                                    $item_count=0;
                                    foreach ($db->query($select_qry) as $row) {

                                      $stock_on_locations=json_decode((string)$row['stock_on_locations'],true);
                                      $stock_status = '';
                                      if($row['available_stock']<= 0)
                                      {
                                        $stock_status = 'table-danger'; // out of stock
                                      }elseif($row['available_stock']>$row['min_stock_limit'])
                                      {
                                        $stock_status = 'table-success'; // available_stock
                                      }elseif($row['available_stock']>0 && $row['available_stock'] <= $row['min_stock_limit'])
                                      {
                                        $stock_status = 'table-warning';
                                      }else{
                                        $stock_status = 'others';
                                      }

                                      $this_available_qty=0;
                                      if(substr($stock_location,0,3)=='sl_')
                                      {
                                        if(is_array($stock_on_locations))
                                        {
                                          $shop_qty = $row['available_stock'];
                                          foreach ($stock_on_locations as $key => $value) {
                                            // code...
                                            $location_id=floatval($key);
                                        //                                              echo "$key : $value - ";
                                            if($key!=='sl_')
                                            {
                                              if($key==$stock_location)
                                              {
                                                $this_available_qty= $value;
                                              }
                                        //                                              echo '<button type="button" class="btn waves-effect waves-light btn-secondary">'.$locations_array[$key].' -> '.$value.'</button>';
                                              $shop_qty = $shop_qty-$value;
                                            }
                                          }
  //                                          echo $shop_qty;
                                        }else{
  //                                        echo $row['available_stock'];
                                        }
                                      }elseif ($stock_location=='shop') {
                                        // code...
                                        if(is_array($stock_on_locations))
                                        {
                                          $shop_qty = $row['available_stock'];
                                          foreach ($stock_on_locations as $key => $value) {
                                            // code...
                                            $location_id=floatval($key);
  //                                              echo "$key : $value - ";
                                            if($key!=='sl_')
                                            {
  //                                              echo '<button type="button" class="btn waves-effect waves-light btn-secondary">'.$locations_array[$key].' -> '.$value.'</button>';
                                              $shop_qty = $shop_qty-$value;
                                            }
                                          }
                                          $this_available_qty= $shop_qty;
                                        }else{
                                          $this_available_qty= $row['available_stock'];
                                        }
                                      }else{
                                        $this_available_qty= $row['available_stock'];
                                      }

                                      {
                                   ?>
                                    <tr class="stock_row <?=$stock_status.$this_tr_class?>">
                                      <td class="bolder"><a href="r-stock-view.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                                      <td data-title="Tags" ><?php // echo $row['tags'];
                                      $tags= explode(',',$row['tags']);

                                      foreach($tags as $tag)
                                      {
                                        if($tag)
                                        {
                                          echo '<a href="r-stock.php?tag='.$tag.'" class="btn btn-sm btn-default">'.$tag.'</a>';
                                        }
                                      }
                                      ?></td>
                                      <td data-title="Available Qty: "><?php echo '<strong>'.$this_available_qty.'</strong>';
                                      ?>
                                      <br />
                                      <?php
/*
                                      if($row['secondary_unit_count']>0){
                                        $this_sec_units = json_decode($row['secondary_units'],true);
                                        foreach ($this_sec_units as $sec_key => $sec_value) {
                                          // code...
                                          echo round($sec_value['primary_unit_qty']*$this_available_qty).' '.$sec_value['secondary_unit'].'<br />';
                                        }
                                        foreach ($this_sec_units as $sec_key => $sec_value) {
                                          // code...
                                          echo ($sec_value['primary_unit_qty']*$this_available_qty).' '.$sec_value['secondary_unit'].'<br />';
                                        }
                                      }
*/
                                      ?></td>
                                      <td data-title="Locations Qty: " class="<?php if(substr($stock_location,0,3)=='sl_'){echo 'hide_later';}?>">
                                        <?php
                                          if(is_array($stock_on_locations))
                                          {
                                            $shop_qty = $row['available_stock'];
                                            foreach ($stock_on_locations as $key => $value) {
                                              // code...
                                              $location_id=floatval($key);
//                                              echo "$key : $value - ";
                                              if($key!=='sl_')
                                              {
                                                echo '<button type="button" class="btn waves-effect waves-light btn-secondary">'.$locations_array[$key].' -> '.$value.'</button>';
                                                $shop_qty = $shop_qty-$value;
                                              }
                                            }
                                            echo '<button type="button" class="btn waves-effect waves-light btn-secondary">Shop -> '.$shop_qty.'</button>';
                                          }
                                        ?>
                                      </td>
                                      <td data-title="Min Qty: "><?=$row['min_stock_limit']?></td>
                                      <td data-title="Purchase Cost: "><?=$row['purchase_cost']?></td>
                                      <td data-title="Stock Value: "><?=floatval($row['purchase_cost'])*floatval($this_available_qty)?></td>
                                    </tr>
                                    <?php

                                    $item_count++;
                                    $total_value=$total_value+(floatval($row['purchase_cost'])*floatval($this_available_qty));
                                    $total_available_stock=floatval($total_available_stock)+floatval($this_available_qty);
                                    }
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
      $("#item_count").html("<?=$item_count?>");
      $("#total_available_stock").html("<?=$total_available_stock?>");
      $("#total_value").html("<?=$total_value?>");

      <?php
      if(isset($_GET['stock_status']))
      {
        ?>
        $(".filter_stock").removeClass('btn-info');
        $(".filter_stock").addClass('btn-secondary');

        $("#<?=$_GET['stock_status']?>").removeClass('btn-secondary');
        $("#<?=$_GET['stock_status']?>").addClass('btn-info');
        <?php
      }
       ?>
    </script>
</body>
</html>
