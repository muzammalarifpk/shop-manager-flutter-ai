<?php

$meta=array();
$meta['info']['title']='New Sale';
$meta['info']['des']='Create new Sales invoices..';
$meta['module']=array('t-sale','t-sale_invoices');
$meta['check']['admin']=false;
$meta['check']['permission']=true;

  require_once('includes/dbc.php');

  $meta['header']['css']=array(
    'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
    'Steps'=>'../assets/plugins/wizard/steps.css',
    'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
    'Custom CSS'=>'css/style.css',
    'theme'=>'css/colors/blue.css',
    'dropzone'=>'../assets/plugins/dropzone-master/dist/dropzone.css',
    'select2'=>'../assets/plugins/select2/dist/css/select2.min.css',
    'tags input'=>'../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'

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
    'DataTable'=>'../assets/plugins/datatables/jquery.dataTables.min.js',
    'Datatable buttons'=>'js/dataTables.buttons.min.js',
    'dataTables flash'=>'js/buttons.flash.min.js',
    'DataTable jszip'=>'js/jszip.min.js',
    'DataTable pdfmake'=>'js/pdfmake.min.js',
    'DataTable vfs_fonts'=>'js/vfs_fonts.js',
    'DataTable buttons html5'=>'js/buttons.html5.min.js',
    'DataTable buttons print'=>'js/buttons.print.min.js',
    'select2'=>'../assets/plugins/select2/dist/js/select2.full.min.js',
    "Tags Input"=>"../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"
  );
  $meta['footer']['script']="<script>
      var dtable = $('#example20,#example21,#example22,#example23,#example24,#example25,#example26,#example27,#example28,#example29').DataTable({
          dom: 'Blfrtip',
          'processing': true,
          'pageLength': 50,
          buttons: [
              'csv', 'pdf', 'print'
          ],
    });

      $('a.toggle-vis').on( 'click', function (e) {
              e.preventDefault();

              // Get the column API object
              var column = dtable.column( $(this).attr('data-column') );

              // Toggle the visibility
              column.visible( ! column.visible() );
          } );


      $('.select2').select2();




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
                var delurl ='".$meta['module'][1]."-delete.php?reqid='+reqid;
                $.get( delurl, function( data ) {
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

      function update_number()
      {
        var c_code=$('#country_code').val();
        var mobile_number= $('#mobile').val();

        var your_number = c_code + '-' + mobile_number;

        $('#your_number').html(your_number);
        $('#number').val(your_number);
      }


      $('#country_code').change(function(e){
        update_number();
      });

      $( '#mobile' ).keyup(function() {
        update_number();
      });

      update_number();

      </script>
";


?>
