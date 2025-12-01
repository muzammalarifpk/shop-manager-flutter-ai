<?php

$meta=array();
$meta['info']['title']='packages';
$meta['info']['des']='Manage weekly, monthly, yearly packages.';
$meta['module']=array('packages','apackages');
$meta['check']['admin']=true;
$meta['check']['permission']=false;

  require_once('includes/dbc.php');

  $meta['header']['css']=array(
    'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
    'Steps'=>'../assets/plugins/wizard/steps.css',
    'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
    'Custom CSS'=>'css/style.css',
    'theme'=>'css/colors/blue.css'
);
  $meta['header']['js']=array();
  $meta['footer']['css']=array();
  $meta['footer']['js']=array(
    'slimscrollbar scrollbar JavaScript'=>'js/jquery.slimscroll.js',
    'Wave Effects'=>'js/waves.js',
    'Menu sidebar'=>'js/sidebarmenu.js',
    'stickey kit'=>'../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
    'sparkline JavaScript'=>'../assets/plugins/sparkline/jquery.sparkline.min.js',
    'Custom JavaScript'=>'js/custom.min.js',
    'Steps_min'=>'../assets/plugins/wizard/jquery.steps.min.js',
    'Validate Form'=>'../assets/plugins/wizard/jquery.validate.min.js',
    'sweetalert'=>'../assets/plugins/sweetalert/sweetalert.min.js',
    'sweetalert_custom'=>'../assets/plugins/sweetalert/jquery.sweet-alert.custom.js',
    'apackages-steps'=>'js/apackages-steps.js',
    'DataTable'=>'../assets/plugins/datatables/jquery.dataTables.min.js',
    'Datatable buttons'=>'js/dataTables.buttons.min.js',
    'dataTables flash'=>'js/buttons.flash.min.js',
    'DataTable jszip'=>'js/jszip.min.js',
    'DataTable pdfmake'=>'js/pdfmake.min.js',
    'DataTable vfs_fonts'=>'js/vfs_fonts.js',
    'DataTable buttons html5'=>'js/buttons.html5.min.js',
    'DataTable buttons print'=>'js/buttons.print.min.js'
  );
  $meta['footer']['script']="    <script>
      var dtable = $('#example23').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      });




      //Warning Message
      $('.dangerbtn').click(function(e){
          e.preventDefault();
          var reqid=$(this).attr('rel');
          swal({
              title: 'Are you sure?',
              text: 'You will not be able to recover this!',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel please!',
              closeOnConfirm: false,
              closeOnCancel: false
          }, function(isConfirm){
              if (isConfirm) {

                $.get( 'apackages-delete.php?reqid='+reqid, function( data ) {
                  // the contents is now in the variable data

                    if(data=='success')
                    {
                        swal({
                           title: 'Deleted!',
                           text: 'Record has been deleted successfully.',
                           timer: 2000,
                           type: 'success',
                           showConfirmButton: false
                       });
                     }else{
                       swal({
                          title: 'Ops!',
                          text: 'There is some issue with.',
                          timer: 3000,
                          type: 'warning',
                          showConfirmButton: false
                      });
                     }

                });

              } else {
                  swal({
                     title: 'Cancelled',
                     text: 'Your record is save :)',
                     timer: 2000,
                     type: 'warning',
                     showConfirmButton: false
                 });
              }
          });
      });


      </script>
";


  $all_fields = array();
  $all_fields['name']=array('name'=>'package name','is_req'=>1,'type'=>'text');
  $all_fields['price']=array('name'=>'price in pkr','is_req'=>1,'type'=>'number');
  $all_fields['price_usd']=array('name'=>'price in USD','is_req'=>1,'type'=>'number');
  $all_fields['validity']=array('name'=>'validity in days','is_req'=>1,'type'=>'number');
  $all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown','attr'=>array($list_status));

  $all_fields['no_admins']=array('name'=>'number of admins','is_req'=>1,'type'=>'number');
  $all_fields['no_vendors']=array('name'=>'number of vendors','is_req'=>1,'type'=>'number');
  $all_fields['no_staff']=array('name'=>'number of staff','is_req'=>1,'type'=>'number');
  $all_fields['no_clients']=array('name'=>'number of clients','is_req'=>1,'type'=>'number');
  $all_fields['no_products']=array('name'=>'number of products','is_req'=>1,'type'=>'number');
  $all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

  $form_layout['basic'][]=array('name'=>'col-md-12');
  $form_layout['basic'][]=array('price_usd'=>'col-md-6','price'=>'col-md-6');
  $form_layout['basic'][]=array('validity'=>'col-md-6','status'=>'col-md-6');

  $form_layout['limits'][]=array('no_admins'=>'col-md-6','no_staff'=>'col-md-6');
  $form_layout['limits'][]=array('no_vendors'=>'col-md-6','no_clients'=>'col-md-6');
  $form_layout['limits'][]=array('no_products'=>'col-md-6');
  $form_layout['limits'][]=array('notes'=>'col-md-12');

  $table_heads=array('name','price','validity','status');

?>
