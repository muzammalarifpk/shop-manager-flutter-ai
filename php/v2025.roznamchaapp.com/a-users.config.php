<?php


  $meta=array();

  $meta['info']['title']='Users List';
  $meta['info']['des']='List all users registered.';
  $meta['module']=array('users');
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
    'admin-steps'=>'js/admin-steps.js',
    'eChart'=>'../assets/plugins/echarts/echarts-all.js',
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
        dom: 'lfrtipB',
        'pageLength': 100,
          buttons: [
            'excel', 'pdf', 'print'
          ]
      });


      function delete_user(usernumber){
        reqid=usernumber;
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

              $.get( 'a-users-delete.php?reqid='+reqid, function( data ) {
                // the contents is now in the variable data
                alert(data);

                  if(data=='success')
                  {
                      swal({
                         title: 'Deleted!',
                         text: 'Record has been deleted successfully.',
                         timer: 2000,
                         type: 'success',
                         showConfirmButton: false
                     });
                     location.reload(true);
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
        return false;
      }


      function reset_user(usernumber){
        reqid=usernumber;
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Reset it!',
            cancelButtonText: 'No, cancel please!',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {

              $.get( 'a-users-reset.php?reqid='+reqid, function( data ) {
                // the contents is now in the variable data
                alert(data);

                  if(data=='success')
                  {
                      swal({
                         title: 'Deleted!',
                         text: 'Account has been reset successfully.',
                         timer: 2000,
                         type: 'success',
                         showConfirmButton: false
                     });
                     location.reload(true);
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
        return false;
      }


      //Warning Message
      $('.delbtnadf').on( 'click', function(e) {
          e.preventDefault();
          var reqid=$(this).attr('rel');
          alert(reqid);
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

                $.get( 'a-users-delete.php?reqid='+reqid, function( data ) {
                  // the contents is now in the variable data
                  alert(data);

                    if(data=='success')
                    {
                        swal({
                           title: 'Deleted!',
                           text: 'Record has been deleted successfully.',
                           timer: 2000,
                           type: 'success',
                           showConfirmButton: false
                       });
                       location.reload(true);
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
  $all_fields['fname']=array('name'=>'First Name','is_req'=>1,'type'=>'text');
  $all_fields['lname']=array('name'=>'Last Name','is_req'=>1,'type'=>'text');
  $all_fields['email']=array('name'=>'Email Address','is_req'=>1,'type'=>'email');
  $all_fields['phone']=array('name'=>'Phone','is_req'=>1,'type'=>'number');
  $all_fields['location']=array('name'=>'location','is_req'=>1,'type'=>'dropdown','attr'=>array($list_cities));
  $all_fields['dob']=array('name'=>'Date of Birth','is_req'=>0,'type'=>'date');
  $all_fields['privs']=array('name'=>'Access Type','is_req'=>1,'type'=>'manual','attr'=>$modules);
  $all_fields['username']=array('name'=>'Username','is_req'=>1,'type'=>'text','attr'=>array('unique'=>true));
  $all_fields['password']=array('name'=>'Password','is_req'=>1,'type'=>'password');
  $all_fields['status']=array('name'=>'Status','is_req'=>1,'type'=>'dropdown','attr'=>array($list_status));
  $all_fields['notes']=array('name'=>'Notes','is_req'=>0,'type'=>'textarea');

  $form_layout['basic'][]=array('fname'=>'col-md-6','lname'=>'col-md-6');
  $form_layout['basic'][]=array('email'=>'col-md-6','phone'=>'col-md-6');
  $form_layout['basic'][]=array('location'=>'col-md-6','dob'=>'col-md-6');
  $form_layout['access'][]=array('username'=>'col-md-6','password'=>'col-md-6');
  $form_layout['access'][]=array('privs'=>'col-md-12');
  $form_layout['access'][]=array('status'=>'col-md-6');
  $form_layout['access'][]=array('notes'=>'col-md-12');

  $table_heads=array('number','business_name','industry_type','phone','privs','status');

?>
