<?php
  require_once("c-profile.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
//  require_once("includes/libs/table.cls.php");
?>
<link href="../assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="dashboard.php"><?=$string['g']['home']?></a></li>
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

  $select_qry="select * from `users` where `number`='$_SESSION[sess_bp_username]'";
  foreach ($db->query($select_qry) as $row) {

    $industry_type=$row['industry_type'];
    $business_type=$row['business_type'];
    $business_name=$row['business_name'];

    $address=$row['address'];
    $city=$row['city'];
    $state=$row['region_name'];
    $country=$row['country_name'];

    $email=$row['email'];
    $currency=$row['currency'];
    $gst=$row['gst'];
    $vat=$row['vat'];
    $tax=$row['tax'];
    $smsnotification=$row['smsnotification'];
    $barcode=$row['barcode'];
    $negative = $row['negative'];
    $variants=$row['variants'];
    $secondary_units=$row['secondary_units'];
    $lend_inventory=$row['lend_inventory'];
    $salesman_commission=$row['salesman_commission'];
    $agent_commision=$row['agent_commision'];

    $print_urdu_invoice = $row['print_urdu_invoice'];
    $print_header = $row['print_header'];
    $print_header_note=$row['print_header_note'];
    $print_footer_note=$row['print_footer_note'];
    $print_default_template=$row['print_default_template'];
  }

//  print_r($_SESSION);

 ?>

                <div class="row">
                    <div class="col-12">

                        <div class="card" style="background:#fff;">
                            <div class="card-body">
                              <h3>Basic Information</h3>
                                    <form class="form-horizontal" id="profile_form" action="" enctype="multipart/form-data" method="post">

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="business_name">Business Name</label>
                                              <input class="form-control" type="text" id="business_name" name="business_name" required="required" placeholder="Shop Name" value="<?=$business_name?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="address">Shop Address</label>
                                              <input class="form-control" type="text" id="address" name="address" required="required" placeholder="Shop Address" value="<?=$address?>"> </div>
                                      </div>

                                      <div class="form-group ">
                                        <div class="row">
                                          <div class="col-xs-12 col-sm-4">
                                              <label for="city">City</label>
                                              <input class="form-control" type="text" id="city" name="city" required="required" value="<?=$city?>"> </div>
                                          <div class="col-xs-12 col-sm-4">
                                              <label for="state">State/Province</label>
                                              <input class="form-control" type="text" id="state" name="state" required="required" value="<?=$state?>"> </div>
                                          <div class="col-xs-12 col-sm-4">
                                              <label for="country">Country</label>
                                              <input class="form-control" type="text" id="country" name="country" required="required" value="<?=$country?>"> </div>
                                        </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="email">Email Address</label>
                                              <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" value="<?=$email?>"> </div>
                                      </div>

                                      <div class="form-group col-xs-12">
                                              <label for="industry">Industry</label>
                                              <select class="select2 form-control custom-select" name="industry_type" id="industry_type" required="required" style="width: 100%; height:36px;">
                                                <option value="">-- Select --</option>
                                                <?php
                                                  foreach ($list_industries as $key => $value) {
                                                    // code...
                                                    ?>
                                                      <option value="<?=$value?>"><?=$value?></option>
                                                    <?php
                                                  }
                                                ?>
                                                <option value="Others - ">Others</option>
                                              </select>
                                              <script type="text/javascript">
                                                $('#industry_type').val('<?=$industry_type?>');
                                              </script>
                                      </div>

                                      <div class="form-group col-xs-12 ">
                                            <h5>Business type</h5>
                                            <input name="business_type" type="radio" class="with-gap" id="Wholesaller" value="Wholesaller" <?php if($business_type == 'Wholesaller'){?>checked <?php }?> >
                                            <label for="Wholesaller">Wholesaller</label>
                                            <input name="business_type" type="radio" class="with-gap" id="distributor" value="Distributor" <?php if($business_type == 'Distributor'){?>checked <?php }?> >
                                            <label for="distributor">Distributor</label>
                                            <input name="business_type" type="radio" class="with-gap" id="retailer" value="Retailer" <?php if($business_type == 'Retailer'){?>checked <?php }?> >
                                            <label for="retailer">Retailer</label>
                                            <input name="business_type" type="radio" class="with-gap" id="manufacturer" value="Manufacturer"  <?php if($business_type == 'Manufacturer'){?>checked <?php }?> >
                                            <label for="manufacturer">Manufacturer</label>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                            <label for="currency">Currency</label>
                                            <input class="form-control" type="text" id="currency" name="currency" required="required" placeholder="USD" value="<?=$currency?>">
                                          </div>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="card" style="background:#fff;">
                                      <div class="card-body">
                                        <h3>Configure Features</h3>

                                      <div class="form-group col-xs-12">
                                          <h4 for="variants">Variants</h4>
                                          <input name="variants" value="on" type="radio" id="variants_on" class="with-gap radio-col-cyan variants">
                                          <label for="variants_on">On</label>

                                          <input name="variants" value="off" type="radio" id="variants_off" class="with-gap radio-col-blue-grey variants">
                                          <label for="variants_off">off</label>

                                          <script type="text/javascript">
                                            $('#variants_<?=$variants?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="secondary_units">Secondary Units</h4>
                                          <input name="secondary_units" value="on" type="radio" id="secondary_units_on" class="with-gap radio-col-cyan secondary_units">
                                          <label for="secondary_units_on">On</label>

                                          <input name="secondary_units" value="off" type="radio" id="secondary_units_off" class="with-gap radio-col-blue-grey secondary_units">
                                          <label for="secondary_units_off">off</label>

                                          <script type="text/javascript">
                                            $('#secondary_units_<?=$secondary_units?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="salesman_commission">Salesman Commission</h4>
                                          <input name="salesman_commission" value="on" type="radio" id="salesman_commission_on" class="with-gap radio-col-cyan salesman_commission">
                                          <label for="salesman_commission_on">On</label>

                                          <input name="salesman_commission" value="off" type="radio" id="salesman_commission_off" class="with-gap radio-col-blue-grey salesman_commission">
                                          <label for="salesman_commission_off">off</label>

                                          <script type="text/javascript">
                                            $('#salesman_commission_<?=$salesman_commission?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="agent_commision">Agent Commision</h4>
                                          <input name="agent_commision" value="on" type="radio" id="agent_commision_on" class="with-gap radio-col-cyan agent_commision">
                                          <label for="agent_commision_on">On</label>

                                          <input name="agent_commision" value="off" type="radio" id="agent_commision_off" class="with-gap radio-col-blue-grey agent_commision">
                                          <label for="agent_commision_off">off</label>

                                          <script type="text/javascript">
                                            $('#agent_commision_<?=$agent_commision?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="negative">Negative Stock selling</h4>
                                          <input name="negative" value="on" type="radio" id="negative_on" class="with-gap radio-col-cyan negative">
                                          <label for="negative_on">On</label>

                                          <input name="negative" value="off" type="radio" id="negative_off" class="with-gap radio-col-blue-grey negative">
                                          <label for="negative_off">off</label>

                                          <script type="text/javascript">
                                            $('#negative_<?=$negative?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="barcode">Barcode / QR code</h4>
                                          <input name="barcode" value="on" type="radio" id="barcode_on" class="with-gap radio-col-cyan tax">
                                          <label for="barcode_on">On</label>

                                          <input name="barcode" value="off" type="radio" id="barcode_off" class="with-gap radio-col-blue-grey tax">
                                          <label for="barcode_off">off</label>

                                          <script type="text/javascript">
                                            $('#barcode_<?=$barcode?>').attr('checked','checked');
                                          </script>
                                      </div>

                                      <div class="form-group col-xs-12">
                                          <h4 for="tax">Tax option</h4>
                                          <input name="tax" value="on" type="radio" id="tax_on" class="with-gap radio-col-cyan tax">
                                          <label for="tax_on">On</label>

                                          <input name="tax" value="off" type="radio" id="tax_off" class="with-gap radio-col-blue-grey tax">
                                          <label for="tax_off">off</label>

                                          <script type="text/javascript">
                                            $('#tax_<?=$tax?>').attr('checked','checked');
                                          </script>
                                      </div>
                                      <div class="form-group col-xs-12">
                                          <h4 for="lend_inventory">Lend Inventory</h4>
                                          <input name="lend_inventory" value="on" type="radio" id="lend_inventory_on" class="with-gap radio-col-cyan lend_inventory">
                                          <label for="lend_inventory_on">On</label>

                                          <input name="lend_inventory" value="off" type="radio" id="lend_inventory_off" class="with-gap radio-col-blue-grey secondary_units">
                                          <label for="lend_inventory_off">off</label>

                                          <script type="text/javascript">
                                            $('#lend_inventory_<?=$lend_inventory?>').attr('checked','checked');
                                          </script>
                                      </div>


                                      <div class="form-group">
                                        <div class="row">

                                          <div class="col-md-6 col-xs-12">
                                            <label for="gst">GST (General Sales Tax)</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control" id="gst" name="gst" required value="<?=$gst?>" aria-describedby="basic-addon2">
                                                <span class="input-group-addon" id="basic-addon2">%</span>
                                            </div>
                                          </div>

                                          <div class="col-md-6 col-xs-12">
                                            <label for="vat">VAT (Value Added Tax)</label>

                                            <div class="input-group">
                                              <input type="text" class="form-control" id="vat" name="vat" required value="<?=$vat?>" aria-describedby="basic-addon3">
                                              <span class="input-group-addon" id="basic-addon3">%</span>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card" style="background:#fff;">
                                      <div class="card-body">
                                        <h3>Invoice Setting</h3>

                                        <div class="form-group m-b-10">
                                          <div class="row">
                                            <div class="col-sm-6">
                                              <label for="logoimg">Logo Image</label>
                                              <div data-action="su-products-gallery.process.php?product_id=16357" class="dropzone"></div>
                                            </div>

                                            <div class="col-sm-4">
                                              <?php if(file_exists($row['logo'] ?? ''))
                                              {
                                                echo '<img src="'.$row['logo'].'" class="img img-thumbnail rull-right" alt="Logo" style="max-height:200px;" />';
                                              } ?>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <label for="print_header_note">Print Header Note</label>
                                                <textarea name="print_header_note" id="print_header_note" rows="8" cols="80" class="form-control"><?=$print_header_note?></textarea>
                                              </div>
                                        </div>

                                        <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="print_footer_note">Print Footer Note</label>
                                              <textarea name="print_footer_note" id="print_footer_note" rows="8" cols="80" class="form-control"><?=$print_footer_note?></textarea>
                                          </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <label for="print_default_template">Print Default template</label>
                                                <select class="form-control" name="print_default_template" id="print_default_template" required="required">
                                                  <?php
                                                    foreach ($list_print_templates as $key => $value) {
                                                      // code...
                                                      ?>
                                                        <option value="<?=$value?>"><?=$value?></option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                                <script type="text/javascript">
                                                  $('#print_default_template').val('<?=$print_default_template?>');
                                                </script>
                                            </div>
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <h4 for="print_header">Print Header and Logo on Invoice</h4>
                                            <input name="print_header" value="on" type="radio" id="print_header_on" class="with-gap radio-col-cyan print_header">
                                            <label for="print_header_on">On</label>

                                            <input name="print_header" value="off" type="radio" id="print_header_off" class="with-gap radio-col-blue-grey print_header">
                                            <label for="print_header_off">off</label>

                                            <script type="text/javascript">
                                              $('#print_header_<?=$print_header?>').attr('checked','checked');
                                            </script>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <h4 for="print_urdu_invoice">Print urdu label on invoice</h4>
                                            <input name="print_urdu_invoice" value="on" type="radio" id="print_urdu_invoice_on" class="with-gap radio-col-cyan print_urdu_invoice">
                                            <label for="print_urdu_invoice_on">On</label>

                                            <input name="print_urdu_invoice" value="off" type="radio" id="print_urdu_invoice_off" class="with-gap radio-col-blue-grey print_urdu_invoice">
                                            <label for="print_urdu_invoice_off">off</label>

                                            <script type="text/javascript">
                                              $('#print_urdu_invoice_<?=$print_urdu_invoice?>').attr('checked','checked');
                                            </script>
                                        </div>


                                        <div class="form-group col-xs-12">
                                            <h4 for="smsnotification">Send SMS Notification</h4>
                                            <input name="smsnotification" value="on" type="radio" id="smsnotification_on" class="with-gap radio-col-cyan smsnotification">
                                            <label for="smsnotification_on">On</label>

                                            <input name="smsnotification" value="off" type="radio" id="smsnotification_off" class="with-gap radio-col-blue-grey smsnotification">
                                            <label for="smsnotification_off">off</label>

                                            <script type="text/javascript">
                                              $('#smsnotification_<?=$smsnotification?>').attr('checked','checked');
                                            </script>
                                        </div>


                                    </div>
                                  </div>

                                  <div class="card" style="background:#fff;">
                                      <div class="card-body">
                                        <h3>Account Information</h3>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="username">Username</label>
                                              <p><?=$row['number']?></p>
                                            </div>
                                      </div>

                                      <div class="form-group ">
                                          <div class="col-xs-12">
                                              <label for="account_type">Account Type</label>
                                              <p><?=$row['type']?></p>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            <h3 class="text-info"><i class="fa fa-check-circle"></i>Online Catelog</h3><p>Due to Covid-19 lockdown business around to world hit very hard. So, we have created online store for you. Add Images to Products that you want to show on your online catelog. Share your store link or share products with customers to increase sales.</p>

                                            <p><strong>Store Link: </strong><a class="pull-right" href="https://moqame.com/PK/<?=str_replace('+','',$row['number'])?>/">https://moqame.com/PK/<?=str_replace('+','',$row['number'])?>/</a></p>
                                            <br />
                                        </div>

                                      </div>

                                      <div class="row">
                                        <div class="col-sm-12"><a href="#" id="resetbtn" class="btn btn-danger pull-left">Cancel</a><a href="#" id="submitbtn" class="btn btn-success pull-right">Save and Next</a></div>
                                      </div>


                                </form>
                              </div>
                            </div>

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
        <script>
        $(".select2").select2();

        function isJSON(str) {
                    try {
                        return (JSON.parse(str) && !!str);
                    } catch (e) {
                        return false;
                    }
                }

          $(document).ready(function(e){
            $('#submitbtn').click(function(e){
              $('.preloader').show();
              e.preventDefault();
              var form_data = $("#profile_form").serialize();

              $.post(
                "c-profile.process.php",
                 form_data,
                  function(data) {
                  console.log(data);
                  if(isJSON(data)){

                    var response = JSON.parse(data);
                    if(response.code==200)
                    {
                      swal({
                         title: 'Submited!',
                         text: response.msg,
                         timer: 2000,
                         type: 'success',
                         showConfirmButton: false
                      });
                       setTimeout(function(){ window.location.href='dashboard.php'; }, 3000);

                    }else{
                      swal({
                         title: 'Error!',
                         text: response.msg,
                         timer: 2000,
                         type: 'danger',
                         showConfirmButton: false
                      });
                    }

                  }else{
                    swal({
                       title: 'Error!',
                       text: 'Some technical issue occur, please contact us at whatsapp +92-343-4123489',
                       timer: 2000,
                       type: 'danger',
                       showConfirmButton: false
                    });
                  }
              });

            });
          });
        </script>

            <script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
            <script>

            function isValidJSONString(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }

            function load_images()
            {
              $('.preloader').show();
              var formdata = '';
              var urlpost = 'c-profile-gallery.php';

                  var jqxhr = $.post( urlpost, formdata)
                    .done(function(msg) {
                      if(isValidJSONString(msg))
                      {
                        var response = jQuery.parseJSON( msg );
                        if(response.code == 200){

                          $('.images_table tbody').html('');
                          $.each(response.msg, function(i, item) {

                            $('.images_table tbody').prepend('<tr><td class="id"><img src="'+item.file_path+'" class="img img-thumbnail" style="max-width: 200px; max-height: 200px;" alt="'+item.file_name+'" /></td><td class="name">'+item.file_name+'</td><td class="uploaddate">'+item.uploaddate+'</td><td class="id"><a href="#" id="'+item.img_id+'" class="btn btn-danger btn-sm delete_img hide">Delete</a></td></tr>');

                          });
        /*
                            swal({
                               title: 'Submited!',
                               text: 'Record has been added successfully.',
                               timer: 2000,
                               type: 'success',
                               showConfirmButton: false
                            });
                            location.reload();

        */
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
          //            setTimeout(function(){ window.location.reload(); }, 3000);
                    });

                    $('.preloader').hide();

            }

            load_images();

            //Disabling autoDiscover
            Dropzone.autoDiscover = false;

            $(function() {
                //Dropzone class
                var myDropzone = new Dropzone(".dropzone", {
                    url: "c-profile-gallery.php",
                    paramName: "file",
                    maxFilesize: 3,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    init: function()
                    {
                      this.on('error', function(file, response) {
                        //console.log(file);
                        //console.log(response);
                          $(file.previewElement).attr('style','border: 2px solid red');
        //                  var this_previewElement =$(file.previewElement).html(); //.find('.dz-error-message').text(message.Message);
        //                  console.log(this_previewElement);
                      });
                      this.on('success', function(file, resp){
                        if(isValidJSONString(resp))
                        {
                          var response = jQuery.parseJSON( resp );
                          if(response.code == 200){
                            $(file.previewElement).attr('style','border: 2px solid green');
                            load_images();
                            window.location.reload();
                          }else{
                            alert(response.msg);
                          }
                        }else{
                          alert('invalid response: '+resp);
                        }

                      });
                      this.on("complete", function(file)
                      {
                        load_images();
                        console.log(file);
                        console.log(status);
                        if (file.size > 3*1024*1024)
                        {
                          this.removeFile(file);
                          alert('file too big');
                          return false;
                        }
                        if(!file.type.match('image.*'))
                        {
                          this.removeFile(file);
                          alert('Not an image')
                          return false;
                        }
                    });
                  },
                });
            });
            </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
