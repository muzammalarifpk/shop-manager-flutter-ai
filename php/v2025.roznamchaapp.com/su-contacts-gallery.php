<?php
  require_once("su-contacts.config.php");
  $meta['info']['title']='Contact Image Gallery';
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<link href="../assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
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
                                <div class="col-12">
                                  <div data-action="su-contacts-gallery.process.php?id=<?=$_GET['id']?>" class="dropzone">
                                  </div>
                                </div>
                              </div>

                              <div class="table-responsive images_table" id="no-more-tables">
                                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th>Thumbnail</th>
                                        <th>Name</th>
                                        <th>Date Uploaded</th>
                                        <th class="hide">Status</th>
                                      </tr>
                                  </thead>
                                <tbody>

                                </tbody>
                              </table>
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

    <script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
    <script>

        function load_images()
        {
          $('.preloader').show();
          var formdata = '';
          var urlpost = 'su-contacts-gallery.loadfiles.php?id=<?=$_GET['id']?>';

              var jqxhr = $.post( urlpost, formdata)
                .done(function(msg) {
                  if(isValidJSONString(msg))
                  {
                    var response = jQuery.parseJSON( msg );
                    if(response.code == 200){

                      $('.images_table tbody').html('');
                      $.each(response.msg, function(i, item) {

                        if(item.filetype!=='video')
                        {
                          var img_path = item.file_path;
                        }else{
                          var img_path = 'img/video_placeholder.png';
                        }

                        $('.images_table tbody').prepend('<tr><td class="id"><img src="'+img_path+'" class="img img-thumbnail" style="max-width: 200px; max-height: 200px;" alt="'+item.file_name+'" /></td><td class="name">'+item.file_name+'</td><td class="uploaddate">'+item.uploaddate+'</td><td class="id"><a href="#" id="'+item.img_id+'" rel="'+item.img_id+'" class="btn btn-danger btn-sm delete_img">Delete</a></td></tr>');

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

        function delete_img(file_id)
        {
          $('.preloader').show();
          var formdata = '';
          var urlpost = 'su-contacts-gallery.delete.php?file_id='+file_id;

              var jqxhr = $.post( urlpost, formdata)
                .done(function(msg) {
                  if(isValidJSONString(msg))
                  {
                    var response = jQuery.parseJSON( msg );
                    if(response.code == 200){

                        swal({
                           title: 'Submited!',
                           text: 'Record has been added successfully.',
                           timer: 2000,
                           type: 'success',
                           showConfirmButton: false
                        });
                        load_images();

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

    $(document).on('click','.delete_img',function(e){
      e.preventDefault();
      var file_id = $(this).attr('rel');
      delete_img(file_id);
    });

    //Disabling autoDiscover
    Dropzone.autoDiscover = false;

    $(function() {
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone", {
            url: "su-contacts-gallery.process.php?id=<?=$_GET['id']?>",
            paramName: "file",
            maxFilesize: 11,
            maxFiles: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mov,.avi,.mp4",
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
                if (file.size > 10*1024*1024)
                {
                  this.removeFile(file);
                  alert('file too big');

                  return false;
                }
                if(!file.type.match('image.*') && !file.type.match('video.*'))
                {
                  this.removeFile(file);
                  alert('Not an image or video');
                  alert(file.type);
                  return false;
                }
            });
          },
        });
    });
    </script>
  </body>
</html>
