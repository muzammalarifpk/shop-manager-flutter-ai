<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-chartofaccount.config.php");

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New <?=ucwords($meta['info']['title'])?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">
                  <div class="col-12">
                      <div class="card wizard-content">
                          <div class="card-body">
                                  <?php

                                      create_form($form_layout,$all_fields);

                                  ?>
                            <div id="msgholder" class="alert alert-danger d-none"></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="js/steps-<?=$meta['module'][1]?>.js"></script>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
function update_number()
{
  var c_code=$("#country_code").val();
  var mobile_number= $("#mobile").val();

  var your_number = c_code + '-' + mobile_number;

  $("#your_number").html(your_number);
  $("#number").val(your_number);
}

$('#country_code').change(function(e){
  update_number();
});

$( '#mobile' ).keyup(function() {
  update_number();
});


Dropzone.autoDiscover = false;
$("#dropzoneabc").dropzone({ url: "/file/post" });

$(document).ready(function(e){
  $('#status').val('published');
  $('#account_type').val('cash');
  $('#balance_type').val('debit');
});
</script>
