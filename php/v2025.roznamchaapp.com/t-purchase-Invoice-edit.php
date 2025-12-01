<?php
  require_once("t-purchase-tax.config.php");
  $meta['info']['title']='Edit Invoice';
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<style>
.block12{width: 100% !important;}
.block11{width: 91.63% !important;}
.block10{width: 83.33% !important;}
.block9{width: 75% !important;}
.block8{width: 66.64% !important;}
.block7{width: 58.31% !important;}
.block6{width: 50% !important;}
.block5{width: 41.65% !important;}
.block4{width: 33.32% !important;}
.block3{width: 25% !important;}
.block2{width: 16.66% !important;}
.block1{width: 8.33% !important;}
.form-horizontal{width: 100%;}
.form-horizontal .row{ margin-top: 10px; margin-bottom: 10px;}
<?php
if($_SESSION['sess_bp_tax']!=='on')
{
  ?>
  .tax_td{ display: none;}
  <?php
}
?></style>
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
                <div  class="hide">
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
                <?php
                $select_invoice_data_qry="select * from `purchase_invoices` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`status`='published' || `status`='Published') and id='$_GET[id]' ";

                foreach ($db->query($select_invoice_data_qry) as $row_invoice)
                {
        //          print_r($row_invoice);
                }
                if(!isset($row_invoice))
                {
                  ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i>Opsss</h3>
                    <p>No invoice found against this ID.</p>
                  </div>
                  <?php
                }else{
                ?>

                <div class="row">


                  <div id="contact_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title">Add New Contact</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">

                                <div id="">
                                    <div class="row">
                                      <div class="card">
                                        <div class="card-body">
                                      <form action="" class="form-horizontal">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="country_code"> Country Code: <span class="text-danger">*</span> </label>
                                            <select class="custom-select form-control required " id="country_code" name="country_code" aria-required="true">
                                              <option value="">Select Country Code</option><option value="+1">+1</option>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="mobile"> Mobile Number: <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" required="" id="mobile" name="mobile" aria-required="true">
                                              </div>
                                        </div>

                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="number"> International Format: </label>
                                            <input type="number" class="form-control" readonly="" id="number" name="number">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <label for="name">Name</label>
                                          <input type="text" name="name" value="" class="form-control" >
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <label for="notes">Notes</label>
                                          <textarea name="name" rows="3" cols="80" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-success waves-effect waves-light">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div id="product_variants_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; position:inherit !important;">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <input type="hidden" class="product_id" name="" value="">
                                      <h4 class="modal-title">Select Variant for <span class="product_name"></span></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row  el-element-overlay"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" id="update_variants" class="btn btn-success waves-effect waves-light pull-right  submit_variants_btn">Submit</button>
                                  </div>
                              </div>
                          </div>
                        </div>


                        <div id="product_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Products to Bill</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                      <div class="row">
                                        <div class="col-sm-4">
                                          <label for="product_search_box">Search Products</label>
                                        </div>
                                        <div class="col-sm-4">
                                          <input type="text" id="product_search_box" class="form-control" name="" value="" placeholder="Search Product">
                                        </div>
                                      </div>

                                      <div id="" class="m-t-20">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="row el-element-overlay">

                                                <?php
                                                  $products_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='published' order by `name`";
                                                  foreach ($db->query($products_query) as $row) {
                                                    //print_r($row);

                                                    $variants_qry= "select `name`,`available_stock`,`id` from `product_variants` where `owner_mobile`='$_SESSION[sess_bp_username]' and `product_id`='$row[id]' and `status` = 'Published'";

                                                    $variants_count=0;
                                                    $variants_data_array=Array();
                                                    foreach ($db->query($variants_qry) as $row_variant)
                                                    {
                                                      $variants_count++;
                                                      $variants_data_array[]=$row_variant['name'].'--:--'.$row_variant['available_stock'].'--:--'.$row_variant['id'];
                                                    }


                                                ?>

                                                <div class="col-lg-3 col-md-6 add_item_to_cart" id="item_<?=$row['id']?>_<?=$row['name']?>_<?=$row['purchase_cost']?>_<?=$row['available_stock']?>_<?=$row['purchase_cost']?>_<?=$row['measuring_unit']?>"
                                                  rel="<?=strtolower_gfs($row['name'])?> <?=$row['tags']?>"
                                                  data-tax-type="<?=$row['tax']?>"
                                                  data-variants-json='<?php echo implode('--,--',$variants_data_array);?>'
                                                  data-variants="<?=$row['variants']?>"
                                                  data-unit="<?=$row['measuring_unit']?>"
                                                  data-variant_count="<?php echo $variants_count?>"
                                                  data-secondary_units_count="<?=$row['secondary_unit_count']?>"
                                                  data-secondary-units-json='<?=$row['secondary_units']?>'
                                                  data-tax-rate="<?php if(strtolower_gfs($row['tax'])==strtolower_gfs('Exempted')){echo 0;}elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard GST')){ echo $_SESSION['sess_bp_gst']; }elseif(strtolower_gfs($row['tax'])==strtolower_gfs('Standard VAT')){ echo $_SESSION['sess_bp_vat']; }else{ echo '0';}?>">
                                                  <div class="card">
                                                    <div class="el-card-item">
                                                      <div class="el-card-content">
                                                        <h3 class="box-title"><?=$row['name']?></h3>
                                                        <p><?=$_SESSION['sess_bp_currency']?> <?=$row['purchase_cost']?></p>
                                                        <p><small>Available Stock: <?=$row['available_stock']?></small></p>
                                                        <p><small><?=$row['tags']?></small></p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            <?php
                                            }
                                           ?>
                                          </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </div>




                  </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">
                              <?php
                                $all_fields=array('contact_name','invoice_date','sub_total','discount','grand_total','amount_paid','payment_method','remaining_balance','products_json','invoice_number');
                               ?>
                                    <h2 class="hide">Add New sale</h2>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-6">
                                          <lable for="contact_name">Customer Name</lable>
                                          <select class="form-control select2" name="contact_name" id="contact_name">
                                            <option value="+0000">Walkin Customer</option>
                                            <?php
                                            $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]'";

                                            $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');

                                            foreach ($db->query($contacts_query) as $row)
                                            {
    //                                          $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
  //                                            $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                              $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                             ?>
                                            <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                            <?php
                                              }

                                             ?>
                                          </select>
                                          <?php
                                            $json_contacts=json_encode_gfs($contacts_data,true);
                                           ?>
                                           <script type="text/javascript">
                                             var contacts_data=<?=$json_contacts?>;
                                           </script>
                                          <br />
                                          <a href="#" id="contact_modal_btn" data-toggle="modal" data-target="#contact_modal" class="hide btn btn-sm btn-primary">Add New Customer</a>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date">Date </label>

                                          <div class="input-group">
                                              <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                              <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-md-12 block12">
                                            <table class="table table-bordered full-color-table hover-table" id="produutsincart">
                                              <thead>
                                                <tr>
                                                  <th class="sr hide">#</th>
                                                  <th class="name">Product Name</th>
                                                  <th class="tax_td  <?php if($_SESSION['sess_bp_tax']!=='on'){ echo ' hide';} ?>">Tax</th>
                                                  <th class="unit_price" width="20%">Unit Price</th>
                                                  <th class="unit" width="20%">Unit</th>
                                                  <th class="qty" width="20%">Qty</th>
                                                  <th class="total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart_items">

                                            </tbody>
                                            </table>
                                            <a href="#" id="product_modal_btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#product_modal">Add Items to Bill</a>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="sub_total">Sub Total</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" readonly name="sub_total" id="sub_total" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="discount">Discount</label>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="input-group">
                                              <input type="number" class="form-control"  name="discount_percentage" id="discount_percentage" placeholder="Discount in Percentage" aria-describedby="discount_percentage_addon">
                                              <span class="input-group-addon" id="discount_percentage_addon">%</span>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <input type="number" class="form-control" name="discount" id="discount" value="0">
                                        </div>
                                      </div>

                                      <?php if($_SESSION['sess_bp_tax']!=='on')
                                       { ?>

                                       <div class="row">
                                         <div class="col-sm-6">
                                           <label for="tax">Tax</label>
                                         </div>
                                         <div class="col-sm-6">
                                           <input type="text" class="form-control" readonly name="tax" id="tax" value="0">
                                         </div>
                                       </div>
                                       <?php
                                         }
                                     ?>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="grand_total">Grand Total</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text"  class="form-control" readonly name="grand_total" id="grand_total" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="amount_paid">Amount Paid</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="number" class="form-control" name="amount_paid" id="amount_paid" value="0">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="payment_method">Payment Method</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="payment_method" id="payment_method">
                                              <?php
                                            try{
                                               $bank_qry="select * from `chartofaccount` where (`account_type`=:type1 or `account_type`=:type2) and  `owner_mobile`=:owner_mobile";
                                               $banks=$db->prepare($bank_qry);

                                               $owner_mobile=$_SESSION['sess_bp_username'];
                                               $banks->execute(['type1'=>'Cash','type2'=>'Bank','owner_mobile'=>$owner_mobile]);

                                               while($bank=$banks->fetch())
                                               {
                                                 ?>
                                                   <option value="<?=$bank['id']?>"><?=$bank['account_head']?></option>
                                                 <?php
                                               }
                                             }  catch (Exception $e) {
                                                   echo $e->getMessage();
                                               }


                                               ?>
                                            </select>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="remaining_balance">Remaining Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text"  class="form-control" readonly name="remaining_balance" id="remaining_balance" value="0">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="old_balance">Old Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <span id="old_balance_val"></span>
                                          <span id="old_balance_status"></span>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="new_balance">New Balance</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <span id="new_balance_val"></span>
                                          <span id="new_balance_status"></span>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="notes">Notes</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <textarea name="notes" class="form-control" rows="5" id="notes" placeholder="Some notes about this sale." ></textarea>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-12"><a href="#" id="resetbtn" class="btn btn-danger pull-left">Cancel</a> <a href="#" id="submitbtn" class="hide btn btn-success pull-right">Save and Next</a>  <a href="#" id="submit_edit" class="btn btn-success pull-right">Delete old and Save New</a></div>
                                      </div>


                                </form>
                              </div>
                            </div>

                          </div>
                        </div>
                      <?php } ?>
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
        <script type="text/javascript">
          $('#contact_name').val('<?=$row_invoice['contact_number']?>');
          $('#datepicker-autoclose').val('<?=$row_invoice['date']?>');
          $('#payment_method').val('<?=$row_invoice['payment_method']?>');
          $('#discount').val('<?=$row_invoice['discount']?>');
          $('#amount_paid').val('<?=$row_invoice['amount_paid']?>');

          var items_array = <?=$row_invoice['cartitems']?>;

          $.each( items_array, function( key, value ) {
            console.log(value);
            var product_name = $("[id*='item_"+value['item_id']+"'] h3.box-title").html();

            $('#cart_items').append('<tr rel="'+value['qty_before']+'_'+value['cost_per_unit']+'_'+value['unit_measure']+'" data-available_stock="'+value['qty_before']+'" id="item_'+value['item_id']+'"><td class="hide sr"></td><td class="name">'+product_name+'<ul class="variants_cart list-group"></ul><ul class="secondary_cart list-group"></ul></td><td class="tax_td"> <span class="tax_rate">0</span>%</td><td class="unit_price"><input type="number" name="item_unitprice[]" value="'+value['row_rate']+'" class="form-control item_rate" onchange="update_item_total('+value['item_id']+')"></td><td class="unit">'+value['unit_measure']+'</td><td class="qty"><input type="number" name="item_qty[]" value="'+value['row_qty']+'" class="form-control item_qty" onchange="update_item_total('+value['item_id']+')"></td><td class="total"><?=$_SESSION['sess_bp_currency']?> <span class="item_total"></span> <a href="#" rel="'+value['item_id']+'" class="btn btn-danger btn-sm removeitem pull-right"><i class="ti-trash"></i></a></td></tr>');
          });


        </script>
        <?php
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script type="text/javascript">
          var this_module = 'purchase';
          var post_url = 't-purchase-tax-new.php';
          var invoice_url = 'h-purchase-invoice.php?id=';
          var currency = '<?=$_SESSION['sess_bp_currency']?>';
        </script>
        <script type="text/javascript" src="js/invoice.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            update_cart_total(contacts_data);
          });

          function isValidJSONString(str)
          {
              try {
                  JSON.parse(str);
              } catch (e) {
                  return false;
              }
              return true;
          }


            $(document).on('click','#submit_edit',function(e)
            {

              e.preventDefault();
              $('.preloader').show();

              var formdata = {"invoiceid":'<?=$_GET['id']?>'};
              $.post( "t-purchase-delete.process.php", formdata)
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
                        $('#submitbtn').trigger('click');


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
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
