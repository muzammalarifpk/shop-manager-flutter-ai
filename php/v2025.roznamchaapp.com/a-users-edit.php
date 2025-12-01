<?php

require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("a-users.config.php");

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit <?=ucwords($meta['info']['title']).' - '.$_GET['reqid']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">
                  <div class="col-12">
                      <div class="card wizard-content">
                          <div class="card-body">
                                  <?php

                                    $sql = 'SELECT ';
                                    foreach ($all_fields as $key => $value) {

                                      $sql.=$key;

                                        $sql.=', ';

                                    }

                                    $sql.= " `id` FROM `".$meta['module'][0]."` where `id`='".$_GET['reqid']."'";

                                    foreach ($db->query($sql) as $row)
                                    {

                                      $data[]=$row;
                                    }

                  //                $db->query($sql) as $row;

                    //                  echo '<pre>'.($row).'</pre>';

                                      create_form($form_layout,$all_fields,$data);

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
<script src="js/<?=$meta['module'][0]?>-steps.js"></script>
