<?php

require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-contacts.config.php");
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


                              $select_qry="SELECT * FROM `contacts` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `id`='$_GET[reqid]' ";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();
                              $row = $stmt->fetchAll();

                              $tags=$row[0]['tags'];
                              $tags=trim($tags,'-,');
                              $tags=rtrim($tags,',-');

                             ?>

                            <form action="" class="" id="editproductform">
                              <div class="row">
                                <div class="col-md-6"><label for="">Contact Name</label></div>
                                <div class="col-md-6"><input type="text" value="<?=$row[0]['name']?>" class="form-control" name="name"></div>
                              </div>

                              <div class="row">
                                <div class="col-md-6"><label for="">Type</label></div>
                                <div class="col-md-6"><select name="type" id="type" class="form-control">
                                  <?php
                                    foreach ($list_relationship_types as $key ) {
                                      // code...
                                      ?>
                                        <option value="<?=$key?>" <?php if(strtolower($row[0]['type'])==strtolower($key)){ echo ' selected="selected" ';}?>><?=ucfirst($key)?></option>
                                      <?php
                                    }
                                   ?>
                                </select>

                              </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6"><label for="">Number/ID</label></div>
                                <div class="col-md-6"><input type="text" readonly="readonly" id="old_number" value="<?=$row[0]['number']?>" class="form-control" name="number"> <a href="" class="btn btn-sm btn-warning edit_number_btn pull-right">Change</a></div>
                              </div>

                              <div class="row changenumberdiv hide">
                                <div class="col-md-6"><label for="">Number</label></div>
                                <div class="col-md-6">
                                  <div class="row">
                                      <div class="form-group col-md-4">
                                        <select class="form-control" id="country_code" name="country_code">
                                          <option value="">--</option>
                                          <?php
                                            for($i = 1; $i < 1000 ; $i++) {
                                              // code...
                                              ?>
                                                <option value="+<?=$i?>">+<?=$i?></option>
                                              <?php
                                            }
                                          ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-8 ">
                                            <input class="form-control" type="number" id="mobile" name="mobile" placeholder="">
                                    </div>
                                  </div>
                                  <script type="text/javascript">
                                    $(".changenumberdiv #country_code").val("<?=$row[0]['country_code']?>");
                                    $(".changenumberdiv #mobile").val(<?=$row[0]['mobile']?>);
                                  </script>
                                </div>
                                  <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-success pull-right waves-effect" id="update_number_btn">Update Number</button>
                                  </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Tags: </label> <br />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <input type="text" value="<?=$tags?>" class="form-control" name="tags" data-role="tagsinput" id="tags" >
                                  <br />
                                  <small>Comma separated. e.g Smartphone, Samsung, Android, 4G, white Color</small>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6"><label for="">Email Address</label></div>
                                <div class="col-md-6"><input type="text" value="<?=$row[0]['email']?>" class="form-control" name="email"></div>
                              </div>

                              <div class="row">
                                <div class="col-md-6"><label for="">City</label></div>
                                <div class="col-md-6"><input type="text" value="<?=$row[0]['city']?>" class="form-control" name="city"></div>
                              </div>

                              <div class="row">
                                <div class="col-md-6"><label for="">Due Date</label></div>
                                <div class="col-md-6"><input type="date" value="<?=$row[0]['duedate']?>" class="form-control" name="duedate"></div>
                              </div>


                              <div class="row">
                                <div class="col-md-6"><label for="">Status</label></div>
                                <div class="col-md-6"><select name="status" id="status" class="form-control">
                                  <?php
                                    foreach ($list_status as $key ) {
                                      // code...
                                      ?>
                                        <option value="<?=$key?>" <?php if($row[0]['status']==$key){ echo ' selected="selected" ';}?>><?=ucfirst($key)?></option>
                                      <?php
                                    }
                                   ?>
                                </select>

                              </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6"><label for="">Current Balance</label></div>
                                <div class="col-md-6"><?=$row[0]['balance'].' '.$row[0]['balance_status']?> <?php if($row[0]['balance_status']=='debit'){echo '(you will get)';}else{echo '(you will pay)'; } ?> <a href="#" class="btn btn-sm btn-warning pull-right changebalancebtn"
                                  rel="<?=$row[0]['id']?>" >Change</a></div>
                                  <input type="hidden" name="old_balance" id="old_balance" value="<?=floatval($row[0]['balance'])?>">
                                  <input type="hidden" name="old_balance_status" id="old_balance_status" value="<?=$row[0]['balance_status']?>">
                              </div>




                              <div class="row">
                                <div class="col-md-6"><label for="">Notes</label></div>
                                <div class="col-md-6"><textarea class="form-control" name="notes" id="notes"><?=$row[0]['notes']?></textarea></div>
                              </div>



                              <input type="hidden" name="id" value="<?=$_GET['reqid']?>">


                            </form>

                            <div id="updatebalance" class="hide">

                              <input type="hidden" value="<?=$row[0]['number']?>" placeholder="0" class="form-control" name="contact_number" id="contact_number">

                            <div class="row">
                              <div class="col-6">
                                <label for="">New Balance</label>
                              </div>
                              <div class="col-6">
                                <input type="number" value="" placeholder="0" class="form-control" name="newbalance" id="newbalance">
                              </div>
                            </div>

                              <div class="row">
                                <div class="col-6">
                                  <label for="">New Balance Status</label>
                                </div>
                                <div class="col-6">
                                  <select name="newbalance_status" id="newbalance_status" class="form-control">
                                    <option value="debit">Debit (Receivable)</option>
                                    <option value="credit">Credit (Payable)</option>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                  <button type="button" class="btn btn-success waves-effect" id="update_balance_submit">Update Balance</button>
                                </div>
                              </div>
                            </div>

                            <div id="msgholder" class="alert alert-danger d-none"></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" id="editbtn">Update</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('#editbtn').click(function(e){
    e.preventDefault();

    var formdata= $('#editproductform').serialize();

    $.post( "su-contacts-edit.process.php", formdata)
  .done(function( data ) {
    if(data=='success')
    {
      swal({
         title: 'Success!',
         text: 'Contact has been updated successfully...',
         timer: 2000,
         type: 'success',
         showConfirmButton: false
      });
      setTimeout(function(){ window.location.reload(); }, 2500);

    }else{
      swal({
         title: 'Error!',
         text: 'Record not saved.',
         timer: 2000,
         type: 'danger',
         showConfirmButton: false
      });
      alert("Erorr while updating. Please contact support with screenshot. " + data);
    }
  });
  });

</script>

<script src="js/steps-<?=$meta['module'][1]?>.js"></script>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
