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

            <input type="hidden" name="reqid" value="<?=$_GET['reqid']?>">
            <div class="modal-header">
                <h4 class="modal-title">Activities for Job: <?=$row[0]['name']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <!-- Validation wizard -->
              <div class="row" id="validation">

                <div class="col-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#summary" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Summary</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#details" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Details</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane p-20 active" id="summary" role="tabpanel" aria-expanded="false">
                                <div class="p-20">
                                  <h4>Total input Items Cost</h4>
                                  <p><?=$row[0]['items_total_cost']?></p>
                                  <h4>Total Expense Cost</h4>
                                  <p><?=$row[0]['expense_total_cost']?></p>
                                  <h4>Total input Cost</h4>
                                  <p><?=$row[0]['total_input']?></p>
                                  <h4>Total Output</h4>
                                  <p><?=$row[0]['total_output']?></p>
                                  <h4>Work in Progess</h4>
                                  <p><?=$row[0]['total_input']-$row[0]['total_output']?></p>
                                </div>
                              </div>
                              <div class="tab-pane" id="details" role="tabpanel" aria-expanded="false">
                                    <div class="p-20">
                                      <div class="row">

<?php
                                        $select_qry="select * from `va-jobs_activites` where `owner_mobile`='$_SESSION[sess_bp_username]' and `job_id`='$_GET[reqid]' order by id asc";

?>

                                        <div class="col-12">
                                              <div class="card">
                                                  <div class="card-body">
                                                      <!-- Nav tabs -->
                                                      <div class="vtabs">
                                                          <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                            <?php

                                                            $counter = 0;
                                                              foreach ($db->query($select_qry) as $row)
                                                              {
                                                                ?>
                                                                <li class="nav-item"> <a class="nav-link <?php if($counter == 0){echo 'active';} ?>" data-toggle="tab" href="#activity_<?=$row['id']?>" role="tab" aria-expanded="false">
                                                                  <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"><?=$row['activity_name']?> <?=$row['date']?></span> </a> </li>
                                                                <?php
                                                                $counter++;
                                                              }

                                                            ?>
                                                          </ul>
                                                          <!-- Tab panes -->
                                                          <div class="tab-content">
                                                            <?php

                                                            $counter = 0;
                                                              foreach ($db->query($select_qry) as $row)
                                                              {
                                                                $input_cartitems = json_decode($row['input_cartitems'],true);
                                                                $output_cartitems = json_decode($row['output_cartitems'],true);
                                                                $expense_cartitems = json_decode($row['expense_cartitems'],true);
                                                                ?>

                                                              <div class="tab-pane <?php if($counter == 0){echo 'active';} ?>" id="activity_<?=$row['id']?>" role="tabpanel" aria-expanded="false">
                                                                  <div class="p-20">
                                                                      <div class="row">
                                                                        <div class="col-md-12 block12">
                                                                          <h2>Raw Material (Input Items)</h2>
                                                                            <table class="table table-bordered full-color-table hover-table" id="input_cartitems">
                                                                              <thead>
                                                                              <tr>
                                                                                <th class="name">Product Name</th>
                                                                                <th class="unit">Measuring Unit</th>
                                                                                <th class="qty">Qty</th>
                                                                                <th class="cost">Unit Cost</th>
                                                                                <th class="total">Total</th>
                                                                              </tr>
                                                                            </thead>
                                                                            <tbody class="cart_items">
                                                                              <?php
                                                                              if(is_array($input_cartitems))
                                                                              {
//                                                                                print_r($input_cartitems);
                                                                                foreach ($input_cartitems as $key => $value) {
                                                                                  // code...
                                                                                  ?>
                                                                                  <tr>
                                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'name')?></td>
                                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'measuring_unit')?></td>
                                                                                    <td><?=$value['item_qty']?></td>
                                                                                    <td><?=$value['item_rate']?></td>
                                                                                    <td><?=$value['item_total']?></td>
                                                                                  </tr>
                                                                                  <?php
                                                                                }
                                                                              }
                                                                              ?>
                                                                            </tbody>
                                                                            </table>

                                                                        </div>
                                                                        </div>
                                                                        <div class="row">
                                                                          <div class="col-6">
                                                                            <h5>Raw Material Total cost</h5>
                                                                          </div>
                                                                          <div class="col-6">
                                                                            <input type="number" class="form-control" id="input_items_total" readonly name="input_items_total" value="<?=$row['total_item_input']?>">
                                                                          </div>
                                                                        </div>

                                                                      <div class="row">
                                                                        <div class="col-12">
                                                                          <table class="table table-bordered full-color-table hover-table" id="expense_cartitems">
                                                                            <thead>
                                                                            <tr>
                                                                              <th class="Type">Expense Type</th>
                                                                              <th class="Payment Method">Payment Method</th>
                                                                              <th class="Description">Description</th>
                                                                              <th class="Cost">Cost</th>
                                                                            </tr>
                                                                          </thead>
                                                                          <tbody class="cart_items">
                                                                            <?php
                                                                            if(is_array($expense_cartitems))
                                                                            {
//                                                                                print_r($expense_cartitems);
                                                                              foreach ($expense_cartitems as $key => $value) {
                                                                                // code...
                                                                                ?>
                                                                                <tr>
                                                                                  <td><?=$value['this_expense_type']?></td>
                                                                                  <td><?=gnr($db,'chartofaccount','id',$value['expense_payment_account'],'account_head')?></td>
                                                                                  <td><?=$value['this_expense_des']?></td>
                                                                                  <td><?=$value['this_expense_amount']?></td>
                                                                                </tr>
                                                                                <?php
                                                                              }
                                                                            }
                                                                            ?>
                                                                          </tbody>
                                                                          </table>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-6">
                                                                          <h5>Expense Total cost</h5>
                                                                        </div>
                                                                        <div class="col-6">
                                                                          <input type="number" class="form-control" readonly id="total_expense" name="expense_total" value="<?=$row['total_expense']?>">
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-6">
                                                                          <h3>Input Total Value (Raw Material + Expense)</h3>
                                                                        </div>
                                                                        <div class="col-6">
                                                                          <input type="number" class="form-control" readonly name="input_total" id="total_input" value="<?=$row['total_input']?>">
                                                                        </div>
                                                                      </div>


                                                                      <div class="row">
                                                                        <div class="col-md-12 block12">
                                                                          <h2>Finished Goods (Output Items)</h2>
                                                                            <table class="table table-bordered full-color-table hover-table" id="output_cartitems">
                                                                              <thead>
                                                                              <tr>
                                                                                <th class="sr hide">#</th>
                                                                                <th class="name">Product Name</th>
                                                                                <th class="unit">Measuring Unit</th>
                                                                                <th class="qty">Qty</th>
                                                                                <th class="cost">Unit Cost</th>
                                                                                <th class="total">Total</th>
                                                                                <th class="status"></th>
                                                                              </tr>
                                                                            </thead>
                                                                            <tbody class="cart_items">
                                                                              <?php
                                                                              if(is_array($output_cartitems))
                                                                              {
                                                                              //                                                                                print_r($input_cartitems);
                                                                                foreach ($output_cartitems as $key => $value) {
                                                                                  // code...
                                                                                  ?>
                                                                                  <tr>
                                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'name')?></td>
                                                                                    <td><?=gnr($db,'products','id',$value['item_id'],'measuring_unit')?></td>
                                                                                    <td><?=$value['item_qty']?></td>
                                                                                    <td><?=$value['item_rate']?></td>
                                                                                    <td><?=$value['item_total']?></td>
                                                                                  </tr>
                                                                                  <?php
                                                                                }
                                                                              }
                                                                              ?>
                                                                            </tbody>
                                                                            </table>
                                                                        </div>
                                                                      </div>
                                                                      <div class="row">
                                                                        <div class="col-6">
                                                                          <h3>Finished Items Total Value</h3>
                                                                        </div>
                                                                        <div class="col-6">
                                                                          <input type="number" class="form-control" readonly name="output_items_total" id="total_item_output" value="<?=$row['total_output']?>">
                                                                        </div>
                                                                      </div>

                                                                        <div class="row">
                                                                          <div class="col-sm-4">
                                                                            <label for="notes">Notes</label>
                                                                          </div>
                                                                          <div class="col-sm-8">
                                                                            <textarea name="notes" class="form-control" rows="5" id="notes" placeholder="Some notes about this sale." ><?=$row['notes']?></textarea>
                                                                          </div>
                                                                        </div>

                                                                  </div>
                                                              </div>
                                                                <?php
                                                                $counter++;
                                                                }

                                                                ?>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>



                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                  <div class="col-12">
                    <div id="msgholder" class="alert alert-danger d-none"></div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success waves-effect" id="editbtn">Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
