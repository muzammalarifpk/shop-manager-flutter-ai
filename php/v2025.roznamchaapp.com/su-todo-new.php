<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-todo.config.php");

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" class="" id="new_form">
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
                              <h4 class="card-title">Basic Details</h4>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="job"> Job: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="job" name="job" aria-required="true">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="date"> Date: <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" required="" id="date" name="date" aria-required="true">
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
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="customer"> customer: <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="customer" id="customer">
                                          <option value="+0000">Walkin Customer</option>
                                          <optgroup label="Customers">

                                          <?php
                                          $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='customer' and (`status`='published' or `status`='Published')";

                                          $contacts_data['+0000']=array('balance'=>'0','status'=>'receiveable');

                                          foreach ($db->query($contacts_query) as $row)
                                          {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                            $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                           ?>
                                          <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                          <?php
                                            }

                                           ?>
                                         </optgroup>
                                         <optgroup label="Suppliers">
                                           <?php
                                           $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='supplier' and (`status`='published' or `status`='Published')";

                                           foreach ($db->query($contacts_query) as $row)
                                           {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                             $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                            ?>
                                           <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                           <?php
                                             }

                                            ?>
                                         </optgroup>
                                         <optgroup label="Employees">
                                           <?php
                                           $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='employee' and (`status`='published' or `status`='Published')";

                                           foreach ($db->query($contacts_query) as $row)
                                           {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                             $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                            ?>
                                           <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                           <?php
                                             }

                                            ?>
                                         </optgroup>
                                         <optgroup label="Agents">
                                           <?php
                                           $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='agents' and (`status`='published' or `status`='Published')";

                                           foreach ($db->query($contacts_query) as $row)
                                           {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                             $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                            ?>
                                           <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                           <?php
                                             }

                                            ?>
                                         </optgroup>
                                         <optgroup label="Other">
                                           <?php
                                           $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='other' and (`status`='published' or `status`='Published')";

                                           foreach ($db->query($contacts_query) as $row)
                                           {
//                                              $contact_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='c".$row['number']."' order by `id` desc";

//                                              $balance=gnrm($db,'ledger',$contact_where,'balance');
//                                              $balance_status=gnrm($db,'ledger',$contact_where,'balance_type');

                                             $contacts_data[$row['number']]=array('balance'=>$row['balance'],'status'=>$row['balance_status']);
                                            ?>
                                           <option value="<?=$row['number']?>"><?=$row['name']?> (<?=$row['number']?>)</option>
                                           <?php
                                             }

                                            ?>
                                         </optgroup>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="item_name"> item_name: <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="item_name" id="item_name">

                                          <?php
                                          $contacts_query="select * from `products` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`status`='published' or `status`='Published')";

                                          foreach ($db->query($contacts_query) as $row)
                                          {
                                           ?>
                                          <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                          <?php
                                            }

                                           ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="uom"> uom: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="uom" name="uom" aria-required="true">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="qty"> qty: <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" required="" id="qty" name="qty" aria-required="true">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="brand"> brand: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="brand" name="brand" aria-required="true">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="priority"> priority: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required="" id="priority" name="priority" aria-required="true">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Notes</label>
                                        <textarea class="form-control" name="notes" id="notes"></textarea>
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
              <button type="button" class="btn btn-success waves-effect btn-block" id="submitBtn">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
