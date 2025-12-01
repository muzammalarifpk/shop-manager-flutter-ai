<?php
require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-posaccess.config.php");

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


                              $select_qry="SELECT * FROM `pos_access` WHERE `owner_mobile` = '$_SESSION[sess_bp_username]' and `id`='$_GET[reqid]' ";

                              $stmt = $db->prepare($select_qry);
                              $stmt->execute();
                              $row = $stmt->fetchAll();

                              $privs = explode(',',$row[0]['privs']);
                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `number`='".$row[0]['number']."' order by `id` desc";

                             ?>

                            <form action="" class="" id="formdata">

                              <div class="row p-t-20">
                                <div class="col-md-4"><label for="">Employee</label></div>
                                <div class="col-md-8">
                                  <strong><?=gnrm($db,'contacts',$contact_where,'name')?></strong><br /> <?=$row[0]['number']?>
                                </div>
                              </div>

                              <div class="row p-t-20">
                                <div class="col-md-4"><label for="">Permissions</label></div>
                                <div class="col-md-8 demo-checkbox">

                                  <?php foreach ($list_privs as $key => $value) {
                                   ?>
                                   <input type="checkbox" name="privs[]" value="<?=$value?>" id="<?=$value?>" class="filled-in chk-col-light-blue" <?php if(in_array($value,$privs)){ echo 'checked="checked"';} ?> >
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
                                        <option value="<?=$key?>" <?php if($row[0]['status']==$key){ echo ' selected="selected" ';}?>><?=ucfirst($key)?></option>
                                      <?php
                                    }
                                   ?>
                                </select>
                                <script type="text/javascript">
                                  $("#status").val('<?=$row[0]['status']?>');
                                </script>

                              </div>
                              </div>

                              <div class="row p-t-20">
                                <div class="col-md-4"><label for="">Notes</label></div>
                                <div class="col-md-8"><textarea class="form-control" name="notes" id="notes"><?=$row[0]['notes']?></textarea></div>
                              </div>

                              <div class="row p-t-20">
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

<script type="text/javascript">
  $('#editbtn').click(function(e){
    e.preventDefault();

    var formdata= $('#editproductform').serialize();

    $.ajax({
        url: 'su-posaccess-edit.process.php',
        type: 'post',
        data: $("#formdata").serialize(),
        success: function( data, textStatus, jQxhr ){
          var local_obj = jQuery.parseJSON(data);
          if(local_obj.code==200) {
            swal({
               title: 'Submited!',
               text: 'Data Saved successfully.',
               timer: 2000,
               type: 'success',
               showConfirmButton: false
            });
            setTimeout(function(){
              window.location.reload();
            },2000);
          }else{
            $('#msgholder').html( local_obj.msg );
            $('#msgholder').removeClass('d-none');
            $('.preloader').hide();
          }
        },
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
            $('#msgholder').html( errorThrown );
            $('#msgholder').removeClass('d-none');
            $('.preloader').hide();
        }
    });

  });
</script>
