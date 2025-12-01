<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import <?=ucwords($meta['info']['title'])?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">
                  <div class="col-12">
                      <div class="card wizard-content">
                          <div class="card-body">
                            <form class="" action="index.html" id="uploadform" method="post" enctype="multipart/form-data">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="csv">Select CSV File: <span class="text-danger">*</span></label>
                                    <input type='file' name='file' id='file' class='form-control' >

                                  </div>
                                </div>

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input type='button' class='btn btn-info' value='Upload' id='upload'>
                                    <a href="products-sample.csv" download="products-sample.csv" class="btn btn-inverse">
                                      Download Sample File
                                    </a>
                                  </div>
                                  </div>
                                </div>
                            </form>
                            <div id='preview'></div>
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

<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $('#upload').click(function(){
    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);
    alert('ready to Upload.');
    // AJAX request
    $.ajax({
      url: 'su-products-import.process.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        alert(response);
        alert('Process completed. Please check manually, if your all products imported successfully.');
        window.location.reload();
      }
    });
  });
});

</script>
