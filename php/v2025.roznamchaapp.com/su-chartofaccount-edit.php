<?php

require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-chartofaccount.config.php");

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


                              $select_qry="SELECT * FROM `chartofaccount` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `id`='$_GET[reqid]' ";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();
                              $row = $stmt->fetchAll();

                             ?>

                             <form action="" class="" id="editproductform">

                               <div class="row">
                                 <div class="col-md-6"><label for="">Account Head (Account Name)</label></div>
                                 <div class="col-md-6"><input type="text" value="<?=$row[0]['account_head']?>" class="form-control" name="account_head"></div>
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
                                 <div class="col-md-6"><label for="">Notes</label></div>
                                 <div class="col-md-6"><textarea class="form-control" name="notes" id="notes"><?=$row[0]['notes']?></textarea></div>
                               </div>

                               <div class="row">
                                 <div class="col-md-6"></div>
                                 <div class="col-md-6"><input type="submit" class="btn btn-success btn-md" id="editbtn" value="Update"></div>
                               </div>

                               <input type="hidden" name="id" value="<?=$_GET['reqid']?>">


                             </form>

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
<script>
$('#editbtn').click(function(e){
  e.preventDefault();

  var formdata= $('#editproductform').serialize();

  $.post( "su-chartofaccount-edit.process.php", formdata)
.done(function( data ) {
  if(data=='success')
  {
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
