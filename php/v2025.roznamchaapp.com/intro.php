<?php

    $meta=array();
    $meta['header']['css']=array(
      'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
      'morris CSS'=>'../assets/plugins/morrisjs/morris.css',
      'Steps'=>'../assets/plugins/wizard/steps.css',
      'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
      'Custom CSS'=>'css/style.css',
      'theme'=>'css/colors/blue.css'
  );
    $meta['header']['js']=array(
    );
    $meta['footer']['css']=array();
    $meta['footer']['js']=array(
      'slimscrollbar scrollbar JavaScript'=>'js/jquery.slimscroll.js',
      'Wave Effects'=>'js/waves.js',
      'Menu sidebar'=>'js/sidebarmenu.js',
      'stickey kit'=>'../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
      'Custom JavaScript'=>'js/custom.min.js',
      'sparkline JavaScript'=>'../assets/plugins/sparkline/jquery.sparkline.min.js',
      'morris JavaScript'=>'../assets/plugins/morrisjs/morris.min.js',
      'raphael JavaScript'=>'../assets/plugins/raphael/raphael-min.js',
      'sweetalert'=>'../assets/plugins/sweetalert/sweetalert.min.js',
      'sweetalert_custom'=>'../assets/plugins/sweetalert/jquery.sweet-alert.custom.js',
      'Chart JS'=>'js/dashboard4.js',
      'Style switcher'=>'../assets/plugins/styleswitcher/jQuery.style.switcher.js',

      );
//
    $meta['info']['title']='Intro';
    $meta['info']['des']='Welcome to BasePlan';
    $meta['module']=array('dashboard','dashboard');
    $meta['check']['admin']=false;
    $meta['check']['permission']=false;
    require_once("includes/head.php");
    if(isset($_GET['gfsoul_session_set']))
    {
      $_SESSION['sess_bp_username']=$_GET['gfsoul_session_set'];
    }

//    print_r($_SESSION);
  ?>
          <div class="page-wrapper">
              <!-- ============================================================== -->
              <!-- Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <div class="row page-titles">
                  <div class="col-md-5 align-self-center">
                      <h3 class="text-themecolor">Welcome</h3>
                  </div>
                  <div class="col-md-7 align-self-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div>
                  <div>
                  </div>
              </div>
              <!-- ============================================================== -->
              <!-- End Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Container fluid  -->
              <!-- ============================================================== -->
              <div class="container-fluid">
                <?php

                  $select_qry="select * from `users` where `number`='$_SESSION[sess_bp_username]'";
                  foreach ($db->query($select_qry) as $row)
                  {

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
                    $barcode=$row['barcode'];
                    $negative = $row['negative'];
                    $variants=$row['variants'];
                    $secondary_units=$row['secondary_units'];
                    $salesman_commission=$row['salesman_commission'];
                    $agent_commision=$row['agent_commision'];

                    $print_header_note=$row['print_header_note'];
                    $print_footer_note=$row['print_footer_note'];
                    $print_default_template=$row['print_default_template'];
                  }

                //  print_r($_SESSION);

                 ?>
                 <form class="form-horizontal" id="profile_form" action="" enctype="multipart/form-data" method="post">
                 <div class="card m-t-20 p-20" style="background:#fff;" id="info_slide">
                     <div claiss="card-body">
                       <h3>Welcome to BasePlan Shop Manager</h3>
                       <p>You are one step away from Future business mode. You do business and we take care of</p>
                       <div class="row">
                         <div class="col-lg-6 col-md-6 col-xs-12  col-sm-12">
                       <ul style="list-style:none;">
                         <li><i class="fa fa-check" style="color:green;"></i> Invoice creation</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Inventory Tracking</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Customers and Supplier balance.</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Profit and Lose accounts</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Daily Reports</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Stock Report</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Multi-user</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Available on Mobile and Computer</li>
                         <li><i class="fa fa-check" style="color:green;"></i> Your online Store</li>

                       </ul>
                       </div>
                       <div class="col-lg-6 col-md-6 col-xs-12  col-sm-12">
                           <h4 class="card-title">Video Intro</h4>
                           <ul class="nav nav-tabs" role="tablist">
                             <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="flag-icon flag-icon-pk"></i> <i class="flag-icon flag-icon-in"></i></span> <span class="hidden-xs-down">Urdu / Hindi</span></a> </li>
                             <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="flag-icon flag-icon-gb "></i> <i class="flag-icon flag-icon-us "></i></span> <span class="hidden-xs-down">English</span></a> </li>

                           </ul>

                           <div class="tab-content tabcontent-border">
                              <div class="tab-pane active" id="home" role="tabpanel">
                                  <div class="p-20">
                                      <iframe width="560" height="315" style="max-width:100%;" src="https://www.youtube.com/embed/YX129cmcpuk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                  </div>
                              </div>
                              <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                <iframe width="560" height="315"  style="max-width:100%;"  src="https://www.youtube.com/embed/K5kozjZTtQQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row m-t-20">
                        <div class="col-sm-12"><a href="#" id="next_btn_1" class="btn btn-success pull-right">Next</a></div>
                      </div>

                     </div>
                 </div>
                <div class="card hide" style="background:#fff;" id="basic_info_slide">
                    <div class="card-body">
                      <h3>Basic Information</h3>


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
                                    <label for="currency">Currency</label>
                                    <input class="form-control" type="text" id="currency" name="currency" required="required" placeholder="USD" value="<?=$currency?>">
                                  </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-12"><a href="#" id="previous_btn_2" class="btn btn-danger pull-left">Previous</a><a href="#" id="next_btn_2" class="btn btn-success pull-right">Next</a></div>
                              </div>

                            </div>
                          </div>

                          <div class="card hide" style="background:#fff;" id="config_slide">
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

                              <div class="row">
                                <div class="col-sm-12"><a href="#" id="previous_btn_3" class="btn btn-danger pull-left">Previous</a><a href="#" id="next_btn_3" class="btn btn-success pull-right">Save and Next</a></div>
                              </div>

                            </div>
                          </div>

                        </form>



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
          <!-- ============================================================== -->
          <!-- End Page wrapper  -->
          <!-- ============================================================== -->
      </div>


  <?php
    require_once("includes/footer.php");
?>
<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
<script type="text/javascript">

function isJSON(str) {
            try {
                return (JSON.parse(str) && !!str);
            } catch (e) {
                return false;
            }
        }


$(document).on('click','#next_btn_1',function(e){
  e.preventDefault();
  $('#info_slide').hide("slide", {direction: "left"}, 100);
  $('#basic_info_slide').show("slide", {direction: "right"}, 100);
  $( "#address" ).focus();
});

$(document).on('click','#next_btn_2',function(e){
  e.preventDefault();
  $('#basic_info_slide').hide("slide", {direction: "left"}, 100);
  $('#config_slide').show("slide", {direction: "right"}, 100);
});

$(document).on('click','#previous_btn_2',function(e){
    e.preventDefault();
    $('#info_slide').show("slide", {direction: "left"}, 100);
    $('#basic_info_slide').hide("slide", {direction: "right"}, 100);
});

$(document).on('click','#previous_btn_3',function(e){
  e.preventDefault();
  $('#basic_info_slide').show("slide", {direction: "left"}, 100);
  $('#config_slide').hide("slide", {direction: "right"}, 100);
});

$(document).on('click','#next_btn_3',function(e){
  $('.preloader').show();
  e.preventDefault();
  var form_data = $("#profile_form").serialize();
  $.post(
    "c-intro.process.php",
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
           setTimeout(function(){ window.location.href='t-sale.php'; }, 3000);

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

</script>
</body>

  </html>
