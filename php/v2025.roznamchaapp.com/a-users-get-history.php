<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("a-users.config.php");
if(!isset($_GET['userid']))
{
  echo 'userid not provided';
}else{
  $userid = $_GET['userid'];
  $select_qry="SELECT * FROM `users` WHERE id = '$userid'  ";

  $stmt = $db->prepare($select_qry);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" class="" id="products_form">
            <input type="hidden" name="id" value="<?=$_GET['userid']?>">
            <div class="modal-header">
                <h4 class="modal-title">Edit user <?php echo $row['business_name']; ?> (<?=$row['id']?>)</h4>
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
                                      <label for="name"> Business Name: <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" required="" id="name" name="name" aria-required="true" value="<?=$row['business_name']?>">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="status"> Status: <span class="text-danger">*</span> </label>
                                      <select class="custom-select form-control required " id="status" name="status" aria-required="true">
                                        <option value="Published">Published (Active)</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Suspended">Suspended</option>
                                        <option value="Delete">Delete</option>
                                      </select>
                                      <script type="text/javascript">
                                        $('#status').val('<?=ucfirst($row['status'])?>');
                                      </script>
                                    </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="type">Type: <span class="text-danger">*</span></label>
                                      <select class="custom-select form-control required " id="type" name="type" aria-required="true">
                                        <option value="prepaid">Prepaid</option>
                                        <option value="sponsor">Paid</option>
                                        <option value="promoter">Promoter</option>
                                      </select>
                                      <script type="text/javascript">
                                        $('#type').val('<?=strtolower($row['type'])?>');
                                      </script>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="date"> Date: <span class="text-danger">*</span></label>
                                      <input type="date" class="form-control" required="" id="date" name="date" aria-required="true" value="<?=$row['date']?>">
                                    </div>
                                  </div>
                              </div>


                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12">
                                <h2>History</h2>
                                <div class="comment-widgets m-b-20">

                                  <?php
                                  $select_comments="SELECT * FROM `user_interaction` WHERE `user_id` = '$userid'  ";
                                  $cmts = $db->prepare($select_comments);
                                  $cmts->execute();
                                  $row_cmts = $cmts->fetchall(PDO::FETCH_ASSOC);


                                  ?>

                                  <?php foreach ($row_cmts as $key => $value) {
                                    // code...
                                   ?>
                                  <div class="d-flex flex-row comment-row">
                                    <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
                                    <div class="comment-text w-100">
                                        <div class="comment-footer">
                                            <span class="date"><?php echo date('Y-M-d',$value['timestamp']); ?></span>
                                        </div>
                                        <p class="m-b-5 m-t-10"><?php echo $value['comment']; ?></p>
                                    </div>
                                  </div>
                                  <?php } ?>



                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-6" class="form-group">
                                <label for="amount">Amount in PKR</label>
                                <input type="text" class="form-control" name="amount" value="0" id="amount">
                              </div>
                              <div class="col-10">
                                <textarea name="comment" class="form-control" rows="8" cols="80"></textarea>
                              </div>
                              <div class="col-2">
                                <button type="button" class="btn btn-success waves-effect" id="send_comment">Submit</button>
                              </div>
                          </div>
                        </div>
                        <div id="msgholder" class="alert alert-danger d-none"></div>
                      </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success waves-effect" id="editbtn">Update</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<?php } ?>
