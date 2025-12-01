<?php

$meta=array();
$meta['info']['title']='Value Addition Jobs';
$meta['info']['des']='Value Addition Jobs.';
$meta['module']=array('va','va-jobs');
$meta['check']['admin']=false;
$meta['check']['permission']=true;

  require_once('includes/dbc.php');

  $meta['header']['css']=array(
    'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
    'Steps'=>'../assets/plugins/wizard/steps.css',
    'Sweetalert'=>'../assets/plugins/sweetalert/sweetalert.css',
    'Custom CSS'=>'css/style.css',
    'theme'=>'css/colors/blue.css',
//    'dropzone'=>'../assets/plugins/dropzone-master/dist/dropzone.css',
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
        dom: 'lfrtipB',
        'pageLength': 25,
        buttons: [
                {
                    extend: 'csv',
                    text: 'Export to Excel',
                    exportOptions: {
                        modifier: {
                            search: 'none'
                        }
                    }
                }
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


      </script>
";


$all_fields = array();
$all_fields['name']=array('name'=>'Product Name','is_req'=>1,'type'=>'text');
$all_fields['category']=array('name'=>'Category','is_req'=>0,'type'=>'text');
$all_fields['sku']=array('name'=>'SKU','is_req'=>0,'type'=>'text');
$all_fields['barcode']=array('name'=>'barcode','is_req'=>0,'type'=>'text');
$all_fields['salesman_commission']=array('name'=>'salesman commission','is_req'=>0,'type'=>'text');
$all_fields['agent_commission']=array('name'=>'Agent Commission','is_req'=>0,'type'=>'text');
$all_fields['variants']=array('name'=>'Variants','is_req'=>0,'type'=>'dropdown');
$all_fields['description']=array('name'=>'Description','is_req'=>0,'type'=>'textarea');
$all_fields['measuring_unit']=array('name'=>'Measuring Unit','is_req'=>1,'type'=>'dropdown','attr'=>array($list_measuring_units));
$all_fields['tax']=array('name'=>'Tax Type','is_req'=>0,'type'=>'dropdown','attr'=>array($list_taxes));
$all_fields['available_stock']=array('name'=>'Available Stock','is_req'=>1,'type'=>'number');
$all_fields['min_stock_limit']=array('name'=>'Minimum Stock Limit','is_req'=>0,'type'=>'number');
$all_fields['max_stock_limit']=array('name'=>'Maximum Stock Limit','is_req'=>0,'type'=>'number');
$all_fields['purchase_cost']=array('name'=>'purchase cost','is_req'=>1,'type'=>'number');
$all_fields['sale_price']=array('name'=>'sale price','is_req'=>1,'type'=>'number');
$all_fields['wholesale_price']=array('name'=>'Wholesale price','is_req'=>1,'type'=>'number');
$all_fields['tags']=array('name'=>'Tags','is_req'=>0,'type'=>'tags');
$all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown','attr'=>array($list_status));
$all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

$form_layout['basic'][]=array('name'=>'col-md-8','tax'=>'col-md-4');
$form_layout['basic'][]=array('description'=>'col-md-12');
$form_layout['basic'][]=array('status'=>'col-md-6','tags'=>'col-md-6');
$form_layout['basic'][]=array('measuring_unit'=>'col-md-4','available_stock'=>'col-md-4','min_stock_limit'=>'col-md-4');
$form_layout['rates'][]=array('purchase_cost'=>'col-md-4','sale_price'=>'col-md-4','wholesale_price'=>'col-md-4');
$form_layout['rates'][]=array('notes'=>'col-md-12');

$table_heads=array('name','available_stock','purchase_cost','sale_price','wholesale_price','status');

?>
