<?php

$meta=array();
$meta['info']['title']='Contacts';
$meta['info']['des']='Manage Customers(Clients), Suppliers(Vendors) and Employees(Staff) accounts..';
$meta['module']=array('contacts','su-contacts');
$meta['check']['admin']=true;
$meta['check']['permission']=false;

  require_once('includes/dbc.php');

  $meta['header']['css']=array(
    'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
    'Steps'=>'../assets/plugins/wizard/steps.css',
    'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
    'Custom CSS'=>'css/style.css',
    'theme'=>'css/colors/blue.css',
    'dropzone'=>'../assets/plugins/dropzone-master/dist/dropzone.css',
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
    "Tags Input"=>"../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"
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


$all_fields = array();
$all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown','attr'=>array($list_status));
$all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

$all_fields['name']=array('name'=>'Contact Name','is_req'=>1,'type'=>'text');
$all_fields['country_code']=array('name'=>'Country Code','is_req'=>1,'type'=>'dropdown','attr'=>array($list_country_code));
$all_fields['mobile']=array('name'=>'Mobile Number','is_req'=>1,'type'=>'number');
$all_fields['number']=array('name'=>'International Format','is_req'=>0,'type'=>'text','attr'=>array('disabled'));
$all_fields['type']=array('name'=>'Relationship Type','is_req'=>1,'type'=>'dropdown','attr'=>array($list_relationship_types));
$all_fields['balance_status']=array('name'=>'Balance Status','is_req'=>0,'type'=>'dropdown','attr'=>array($list_balance_types));
$all_fields['balance']=array('name'=>'Current Balance','is_req'=>0,'type'=>'number');

$form_layout['basic'][]=array('name'=>'col-md-6','type'=>'col-md-6');
$form_layout['basic'][]=array('country_code'=>'col-md-4','mobile'=>'col-md-4','number'=>'col-md-4');
$form_layout['basic'][]=array('balance_status'=>'col-md-6','balance'=>'col-md-6');
$form_layout['basic'][]=array('status'=>'col-md-6');
$form_layout['basic'][]=array('notes'=>'col-md-12');

$table_heads=array('name','type','number','balance','balance_status','status');

?>
