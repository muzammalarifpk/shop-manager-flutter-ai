<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-posaccess.config.php");

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

                          <form action="" class="" id="formdata" method="post">

                            <div class="row p-t-20">
                              <div class="col-md-4"><label for="">Employee</label></div>
                              <div class="col-md-8"><select name="number" id="measuring_unit" class="form-control">
                                <?php
                                $employees_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='employee' and `status`='published'";
                                foreach ($db->query($employees_query) as $row) {
                                    // code...
                                    ?>
                                      <option value="<?=$row['number']?>" ><?=ucfirst($row['name'])?></option>
                                    <?php
                                  }
                                 ?>
                              </select>

                            </div>
                            </div>

                            <div class="row p-t-20">
                              <div class="col-md-4"><label for="">Permissions</label></div>
                              <div class="col-md-8 demo-checkbox">

                                <?php foreach ($list_privs as $key => $value) {
                                 ?>
                                 <input type="checkbox" name="privs[]" value="<?=$value?>" id="<?=$value?>" class="filled-in chk-col-light-blue">
                                  <label for="<?=$value?>"><?=ucfirst($value)?></label>
                                <?php } ?>
                              </div>
                            </div>

                            <div class="row p-t-20">
                              <div class="col-md-4"><label for="">Status</label></div>
                              <div class="col-md-8"><select name="status" id="status" class="form-control">
                                <?php
                                  foreach ($list_status as $key ) {
                                    // code...
                                    ?>
                                      <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                    <?php
                                  }
                                 ?>
                              </select>

                            </div>
                            </div>

                            <div class="row p-t-20">
                              <div class="col-md-4"><label for="">Password</label></div>
                              <div class="col-md-8"><input type="password" class="form-control" name="password" id="password"></div>
                            </div>

                            <div class="row p-t-20">
                              <div class="col-md-4"><label for="">Notes</label></div>
                              <div class="col-md-8"><textarea class="form-control" name="notes" id="notes"></textarea></div>
                            </div>

                            <div class="row p-t-20">
                              <div class="col-md-4"></div>
                              <div class="col-md-8"><input type="submit" class="btn btn-success btn-md" id="submitbtn" value="Submit"></div>
                            </div>

                          </form>

                          <div id="msgholder" class="alert alert-danger d-none  p-t-20"></div>
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
