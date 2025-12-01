<?php
require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("va-jobs.config.php");

$select_qry="SELECT * FROM `va-jobs` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `id`='$_GET[reqid]' ";

$stmt = $db->prepare($select_qry);
$stmt->execute();
$row = $stmt->fetchAll();

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" class="" id="new_form">
            <input type="hidden" name="reqid" value="<?=$_GET['reqid']?>">
            <div class="modal-header">
                <h4 class="modal-title">Edit <?=ucwords($meta['info']['title'])?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">
                  <div class="col-12">
                      <div class="card wizard-content">
                          <div class="card-body">
                              <h4 class="card-title">Basic Details</h4>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="name"> Job Name: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="name" name="name" aria-required="true" value="<?=$row[0]['name']?>">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="number"> Job Number/ Batch ID: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="number" name="number" aria-required="true" value="<?=$row[0]['number']?>">
                                      </div>
                                    </div>

                                      <div class="col-md-6 hide">
                                        <div class="form-group">
                                          <label for="status"> Status: <span class="text-danger">*</span> </label>
                                          <select class="custom-select form-control required " id="status" name="status" aria-required="true">
                                            <option value="published">Published (Active)</option>
                                            <option value="draft">Draft</option>
                                            <option value="suspended">Suspended</option>
                                            <option value="delete">Delete</option>
                                          </select>
                                        </div>
                                      </div>
                                      <script type="text/javascript">
                                        $('#status').val("<?=$row[0]['status']?>");
                                      </script>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Start Date <span class="text-danger">*</span> </label><?=$row[0]['start_date']?>
                                        <input type="date" class="form-control" name="start_date" id="start_date" value="<?=$row[0]['start_date']?>">
                                        <small>Opening Stock, if not available mark it 0</small>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Tags: <?php $tags= substr($row[0]['tags'],2,-2);// echo $tags; ?></label> <br />

                                        <input type="text" data-role="tagsinput" class="form-control" id="tags" name="tags" value="<?=$tags?>" />
                                        <br />
                                        <small>Comma separated. e.g Smartphone, Samsung, Android, 4G, white Color</small>
                                      </div>
                                    </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control" name="description" id="description"><?=$row[0]['description']?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Private Notes</label>
                                        <textarea class="form-control" name="notes" id="notes"><?=$row[0]['notes']?></textarea>
                                      </div>
                                    </div>
                                  </div>


                                </div>
                              </div>


                              <div id="msgholder" class="alert alert-danger d-none"></div>

                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success waves-effect btn-block" id="editbtn">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
