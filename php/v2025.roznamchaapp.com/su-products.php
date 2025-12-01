<?php
  require_once("su-products.config.php");
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
          });;

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
      $('.preloader').show();
        $.get( "<?=$meta['module'][1]?>-new.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
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
          });;

    });

    $("#importmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "<?=$meta['module'][1]?>-import.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
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
          });;

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

                        <div class="card mt-3">
                            <div class="card-body">
                              <div class="row">

                                <div class="col-md-12">
                                   <a id="newmodalbtn" href="#" class="btn btn-sm pull-right btn-info" data-toggle="modal">Add New<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div></a>
                                   <a id="importmodalbtn" href="#" class="btn btn-sm pull-right btn-primary" data-toggle="modal">Import</a>
                                   <!-- sample modal content -->
                                   <div id="modaldiv"></div>
                                   <!-- /.modal -->

                                </div>
                                <?php
                                  if(isset($_GET['tag']))
                                  {
                                    ?>
                                    <div class="col-md-6">
                                        <h5>Tag: <a href="su-products.php" class="btn btn-danger"><i class="fa fa-close"></i> <?=$_GET['tag']?></a></h5>
                                    </div>
                                    <div class="col-md-6">
                                      <a class="btn btn-info waves-effect waves-light" href="r-stock.php?tag=<?=$_GET['tag']?>">Stock Report</a>
                                      <a class="btn btn-info waves-effect waves-light" href="r-sales.php?tag=<?=$_GET['tag']?>">Sales Invoices</a>
                                      <a class="btn btn-info waves-effect waves-light" href="r-sold-items.php?tag=<?=$_GET['tag']?>">Sold Items</a>
                                    </div>
                                  <?php
                                  }
                                  $view_type = '';
                                  if(isset($_GET['ratelist']))
                                  {
                                    if($_GET['ratelist']=='purchase')
                                    {
                                      $view_type = 'purchase_ratelist';
                                    }elseif($_GET['ratelist']=='sale')
                                    {
                                      $view_type = 'sale_ratelist';
                                    }
                                  }
                                  ?>
                              </div>

                              <?php
                              $i=1;
                              if(isset($_GET['tag']))
                              {
                                $all_status_where.="and `tags` like '%$_GET[tag]%'";
                              }
                                $select_qry="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' $all_status_where order by `name` asc";

                                $stmt = $db->prepare($select_qry);
                                $stmt->execute();

                                $count_rows = $stmt->rowCount();

                                if($count_rows>0)
                                {

                               ?>

                              <div class="table-responsive m-t-10"  id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th>Name</th>
                                        <th>Barcode</th>
                                        <th class="">Tags</th>
                                        <?php if($_SESSION['sess_bp_variants']=='on') { ?><th class="">Variants</th><?php } ?>
                                        <?php  if($view_type=='') { ?>
                                        <th class="numeric">Available stock</th>
                                        <?php }
                                         if($view_type=='purchase_ratelist' || $view_type==''){ ?>
                                        <th class="numeric">purchase cost</th>
                                        <?php }
                                        if($view_type=='sale_ratelist' || $view_type==''){ ?>
                                        <th class="numeric">Sale Price</th>
                                        <?php } ?>
                                        <th class="hide_it">status</th>
                                      </tr>
                                  </thead>
                                <tbody>
                                  <?php

                                    foreach ($db->query($select_qry) as $row) {

                                   ?>
                                    <tr class="">
                                      <td data-title="" class="bolder"><a href="" class="editmodalbtn" rel="<?=$row['id']?>"><?=$row['name']?></a>
                                        <button class="expand_btn pull-right d-md-none d-lg-none"><i class="mdi mdi-menu-right"></i></button>
                                      </td>
                                      <td data-title="" class="bolder"><a href="" class="editmodalbtn" rel="<?=$row['id']?>"><?=$row['barcode']?></a>
                                      </td>
                                      <td data-title="Tags" class="mobile_collapse" ><?php // echo $row['tags'];
                                      $tags= explode(',',$row['tags']);

                                      foreach($tags as $tag)
                                      {
                                        if($tag)
                                        {
                                          echo '<a href="su-products.php?tag='.$tag.'" class="btn btn-sm btn-default">'.$tag.'</a>';
                                        }
                                      }
                                      ?></td>
                                      <?php if($_SESSION['sess_bp_variants']=='on') { ?>
                                        <td data-title="Variants" class="mobile_collapse"><?php
                                      $variants= explode(',',$row['variants']);

                                      foreach($variants as $variants)
                                      {
                                          echo '<a href="" class="btn btn-sm btn-default">'.$variants.'</a>';
                                      }
                                      ?></td>
                                      <?php } ?>
                                      <?php  if($view_type=='') { ?>
                                      <td data-title="Stock: "><?=$row['available_stock']?></td>
                                      <?php }
                                      if($view_type=='purchase_ratelist' || $view_type==''){ ?>
                                      <td data-title="<?=$_SESSION['sess_bp_currency']?>" class="mobile_collapse"><?=$row['purchase_cost']?></td>
                                      <?php }
                                      if($view_type=='sale_ratelist' || $view_type==''){ ?>
                                      <td data-title="<?=$_SESSION['sess_bp_currency']?>"><?=$row['sale_price']?></td>
                                      <?php } ?>
                                      <td data-title="" class="mobile_collapse"><?=$row['status']?> <a href="" class="pull-right editmodalbtn btn btn-sm btn-warning" rel="<?=$row['id']?>">Edit</a> <a href="su-products-gallery.php?product_id=<?=$row['id']?>" class="pull-right btn btn-sm btn-primary">Photos</a></td>

                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                   ?>
                                </tbody>
                            </table>




                          </div>

                          <br>
                          <p>
                            <a href="su-products.php?show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                            <a href="su-products.php" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
  <script type="text/javascript">
    function isValidJSONString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    function update_available_stock(){
      var total_available_stock = 0;

      $(".variants_qty_in").each(function(){
        var this_qty = $(this).val();
        total_available_stock = parseFloat(total_available_stock) + parseFloat(this_qty);
      });

      $('#available_stock').val(total_available_stock);

    }



    $(document).on("change",'#variants',function(){
          var array_variants = [];
          $("#row_variants .bootstrap-tagsinput span.tag").each(function(){

            var this_name=$(this).text();
            var this_id = this_name.split(" ").join("");

            array_variants.push(this_id);


            if(document.getElementById(this_id) !== null)
            {
            }else{

              $("#variants_data").append('<div class="row p-t-20" id="'+this_id+'"><div class="col-md-6"><label for="">'+this_name+'</label></div><div class="col-md-6"><input type="hidden" class="form-control" name="variants_fields[]" id="variants_fields_'+this_id+'" value="'+this_id+'"><input type="text" class="form-control variants_qty_in" name="variant_'+this_id+'" id="variant_'+this_id+'" value="0"></div></div>');

            }

          });


          $("#variants_data .row").each(function(){
            var this_row_id = $(this).attr('id');

            if(jQuery.inArray(this_row_id, array_variants) !== -1)
            {
            }else{
              $(this).remove();
            }

          });

          update_available_stock();
    });

    function add_secondary_unit(i){
      $(".secondary_unit_row:last").clone().appendTo(".secondary_unit_box");

      return false;
    }

    function change_unit(){
      var selected_unit = $('#measuring_unit').val();
      $('.primary_unit').html(selected_unit);
    }

    $(document).on('click','#add_secondary_unit_btn',function(e){
      e.preventDefault();
      var i=0;
      add_secondary_unit(i);
      i++;

    });

    $(document).on('change','#measuring_unit',function(e){
      change_unit();
    });

    $(document).on('click','.remove_secondary_unit',function(e){
      e.preventDefault();
      $(this)
        .closest( ".secondary_unit_row" )
        .remove();

      });

    $(document).on('change','.variants_qty_in',function(){
      update_available_stock();
    });

    function change_product_qty()
    {
      var change_stock_reason = $("#change_stock_reason").val();
      var effected_qty = parseFloat($('#effected_qty').val());
      var product_id = $("#product_id").val();
      var purchase_cost = parseFloat($('#purchase_cost').val());
      var available_stock = parseFloat($('#available_stock').val());
      var measuring_unit = parseFloat($('#measuring_unit').val());


      var formdata = { "change_stock_reason":change_stock_reason, "effected_qty":effected_qty, "product_id":product_id, "purchase_cost":purchase_cost, "available_stock":available_stock,"measuring_unit":measuring_unit };
      console.log(formdata);

      if(effected_qty=='')
      {
        alert('you must mention some Effected Quantity');
        return false;
      }else{

      $.post( "su-products-update-stock.process.php", formdata)
        .done(function( data ) {
//          alert(data);
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
               type: 'error',
               showConfirmButton: false
            });
            alert("Erorr while updating. Please contact support with screenshot. " + data);
          }
        });
      }
    }

    $(document).on('click','.changestockbtn',function(e){
      e.preventDefault();
      $("#changestockbox").toggle('show');

    });


    $(document).on('click','#change_stock_submit',function(e){
    //  alert('ready to change Quantity.');
      change_product_qty();
    });

    change_unit();


    $(document).on('click','#editbtn',function(e){
      e.preventDefault();
      var formdata= $('#products_form').serialize();

        $.post( "su-products-edit.process.php", formdata)
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
                setTimeout(function(){ window.location.reload(); }, 2500);
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
            });;
        });

    $(document).on('click','#submitBtn',function(e){
      e.preventDefault();
      var form_data = $("#products_form").serialize();
      var urlpost='su-products-new-process.php';


    //    alert(form_data);

      $.ajax({
                  type:'POST',
                  url:urlpost,
                  data:form_data,
                  success:function(msg){
    //                  alert(msg);
                      if(msg == 'success'){

                          swal({
                             title: 'Submited!',
                             text: 'Record has been added successfully.',
                             timer: 2000,
                             type: 'success',
                             showConfirmButton: false
                          });
                          location.reload();


                      }else{
                          $("#msgholder").html(msg);
                          $("#msgholder").removeClass('d-none');
                      }
                      $('.submitBtn').removeAttr("disabled");
                      $('.modal-body').css('opacity', '');
                  },error:function(jqXHR, textStatus, errorThrown){
                        $('#msgholder').html('<h4>Erorr while updating. Please check your internet connection.</h4><p>If your internet connection is working fine. Please contact technical support.</p>');
                  }
              });

    });

    </script>
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
    <script type="text/javascript">
      window.addEventListener('load', function () {
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserMultiFormatReader()
        console.log('ZXing code reader initialized')
        codeReader.getVideoInputDevices()
          .then((videoInputDevices) => {
            const sourceSelect = document.getElementById('sourceSelect')
            selectedDeviceId = videoInputDevices[0].deviceId
            if (videoInputDevices.length >= 1) {
              videoInputDevices.forEach((element) => {
                const sourceOption = document.createElement('option')
                sourceOption.text = element.label
                sourceOption.value = element.deviceId
                sourceSelect.appendChild(sourceOption)
              })

              sourceSelect.onchange = () => {
                selectedDeviceId = sourceSelect.value;
              };

              const sourceSelectPanel = document.getElementById('sourceSelectPanel')
              sourceSelectPanel.style.display = 'block'
            }

            document.getElementById('startButton').addEventListener('click', () => {
              codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                if (result) {
                  console.log(result);
                //  alert(result);
                  var this_barcode_item=$("div[data-barcode="+result+"]").trigger('click');
                  codeReader.reset();

                }
                if (err && !(err instanceof ZXing.NotFoundException)) {
                  console.error(err)
                  document.getElementById('result').textContent = err
                }
              })
              console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
            })

            document.getElementById('resetButton').addEventListener('click', () => {
              codeReader.reset()
              document.getElementById('result').textContent = '';
              console.log('Reset.')
            })

          })
          .catch((err) => {
            console.error(err)
          })
      });
    </script>

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
