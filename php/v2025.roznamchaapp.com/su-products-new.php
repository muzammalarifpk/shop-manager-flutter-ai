<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");

?>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" class="" id="products_form">
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
                                          <label for="name"> Item Name: <span class="text-danger">*</span></label>
                                          <input type="text" class="form-control" required="" id="name" name="name" aria-required="true">
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

                                      <div class="col-sm-6 <?php if($_SESSION['sess_bp_barcode']=='off'){ echo 'hide'; }?>">
                                        <div>
                                          <a class="btn btn-sm btn-success" id="startButton">Start barcode</a>
                                          <a class="btn btn-sm btn-danger" id="resetButton">Stop</a>
                                        </div>

                                        <div>
                                          <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                                        </div>

                                        <div class="hide--">
                                          <div id="sourceSelectPanel" style="display:none">
                                            <label for="sourceSelect">Change video source:</label>
                                            <select id="sourceSelect" style="max-width:400px">
                                            </select>
                                          </div>

                                          <label>Result:</label>
                                          <pre><code id="result"></code></pre>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="barcode">Item code/Barcode:</label>
                                          <input type="text" class="form-control" required="" id="barcode" name="barcode" aria-required="true">
                                        </div>
                                      </div>

                                  </div>

                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="category"> Category / Brand:</label>
                                          <input type="text" class="form-control" required="" id="category" name="category" aria-required="true">
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Tags: </label> <br />

                                          <input type="text" data-role="tagsinput" value="" class="form-control" id="tags" name="tags" />
                                          <br />
                                          <small>Comma separated. e.g Smartphone, Samsung, Android, 4G, white Color</small>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row hide">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Item Description</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Private Notes</label>
                                        <textarea class="form-control" name="notes" id="notes"></textarea>
                                      </div>
                                    </div>
                                  </div>


                                </div>
                              </div>
                              <div class="card">
                                <div class="card-body">

                                  <h4 class="card-title">Stock Details</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Measuring Unit <span class="text-danger">*</span> </label>
                                          <select name="measuring_unit" id="measuring_unit" class="form-control">
                                            <?php
                                              foreach ($list_measuring_units as $key )
                                              {
                                              ?>
                                                <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                              <?php
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Available stock <span class="text-danger">*</span> </label>
                                          <input type="number" class="form-control" name="available_stock" id="available_stock">
                                          <small>Opening Stock, if not available mark it 0</small>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row hide">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Minimum Stock Limit</label>
                                          <input type="number" class="form-control" name="min_stock_limit" id="min_stock_limit">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Reorder Stock Limit</label>
                                          <input type="number" class="form-control" name="max_stock_limit" id="max_stock_limit">
                                        </div>
                                      </div>
                                    </div>

                                    <?php
                                    if(isset($_SESSION['sess_bp_variants']))
                                    {
                                        if($_SESSION['sess_bp_variants']=='on')
                                        {
                                          ?>

                                          <div class="row p-t-20" id="row_variants">
                                            <div class="col-md-6"><label for="">Variants</label>
                                              <input type="text" data-role="tagsinput" value="" class="form-control" id="variants" name="variants" />
                                              <br />
                                              <small>e.g Red, Green, Blue, Small, Large, Small Gray, Small Gray</small>
                                            </div>
                                          </div>
                                          <div id="variants_data"></div>
                                          <?php
                                        }
                                      }

                                     ?>

                                   </div>
                                 </div>
                                 <div class="card">
                                   <div class="card-body">
                                     <h4 class="card-title">Price Details in <?=$_SESSION['sess_bp_currency']?></h4>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Purchase Cost <span class="text-danger">*</span> </label>
                                          <input type="number" class="form-control" name="purchase_cost" id="purchase_cost">
                                          <small>Per Unit</small>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Sale Price <span class="text-danger">*</span> </label>
                                          <input type="number" class="form-control" name="sale_price" id="sale_price">
                                          <small>This is your ask price which can be changed on every bill</small>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="">Wholesale Price</label>
                                          <input type="number" class="form-control" name="wholesale_price" id="wholesale_price">
                                          <small>Discounted sale price for bulk orders</small>
                                        </div>
                                      </div>

                                    </div>

                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">
                                      Sale on Platforms

                                      <?php
                                       // print_r($row);
                                      ?>
                                    </h4>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <input name="platforms[]" value="moqame" type="radio" id="platforms_moqame_on" class="with-gap radio-col-cyan platforms_moqame" checked >
                                          <label for="platforms_moqame_on">Sale on moqame.com</label>
                                          <input name="platforms[]" value="" type="radio" id="platforms_moqame_off" class="with-gap radio-col-cyan platforms_moqame" >
                                          <label for="platforms_moqame_off">Dont Sale on moqame.com</label>
                                        </div>
                                      </div>
                                      <div class="col-md-8">
                                        <div class="form-group">
                                          <label for="">Youtube Demo Video Link</label>
                                          <input type="text" class="form-control" name="youtube_link" id="youtube_link" >
                                          <small>(optional): Publish a demo video on youtube and paste link here</small>
                                        </div>
                                      </div>

                                      <div class="col-md-8">
                                        <div class="form-group">
                                          <label for="">Title</label>
                                          <input type="text" class="form-control" name="title" id="title" >
                                          <small>Product title for moqame.com</small>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Product Description</label>
                                          <textarea name="product_description" class="form-control" rows="8" cols="80"></textarea>
                                          <small>Product description for moqame.com</small>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Additional Features <small>(Configure <a href="c-profile.php" class="btn btn-link">Here</a>)</small></h4>

                                    <?php
                                    if(isset($_SESSION['sess_bp_tax']))
                                    {
                                      if($_SESSION['sess_bp_tax']=='on')
                                      {
                                     ?>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="">Tax Type</label>
                                            <select name="tax" id="tax" class="form-control">
                                            <?php
                                              foreach ($list_taxes as $key ) {
                                                // code...
                                                ?>
                                                  <option value="<?=$key?>"><?=$key?></option>
                                                <?php
                                              }
                                             ?>
                                            </select>
                                          </div>

                                        </div>
                                      </div>
                                    <?php

                                  }                                }

                              if(isset($_SESSION['sess_bp_secondary_units']))
                              {
                                if($_SESSION['sess_bp_secondary_units']=='on')
                                {
                                  ?>
                                  <h4>Secondary Units (Calculation)</h4>

                                  <div class="secondary_unit_box">
                                    <div class="row p-t-20 secondary_unit_row">
                                      <div class="col-4">
                                        <select name="secondary_unit[]" required id="secondary_unit[]" class="form-control">
                                          <?php
                                            foreach ($list_measuring_units as $key )
                                            {
                                              // code...
                                              ?>
                                              <option value="<?=$key?>"><?=ucfirst($key)?></option>
                                              <?php
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="col-2">=</div>
                                      <div class="col-3">
                                        <input type="text" class="form-control" name="primary_unit_qty[]" value="">
                                      </div>
                                      <div class="col-2"><span class="primary_unit"></span></div>
                                      <div class="col-1 text-danger">
                                        <a href="#" class="remove_secondary_unit"><i class="mdi mdi-close text-danger"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row p-t-20 text-center">
                                    <div class="col-12">
                                      <a href="#" id="add_secondary_unit_btn" class="btn btn-sm btn-inverse">Add More</a>
                                    </div>
                                  </div>

                                <?php
                                }
                              }
                            ?>

                            <div class="row">
                              <?php
                              if(isset($_SESSION['sess_bp_salesman_commission']))
                              {
                                  if($_SESSION['sess_bp_salesman_commission']=='on')
                                  {

                              ?>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Salesman Commision</label>
                                  <input type="number" class="form-control" name="salesman_commission" id="salesman_commission">
                                  <small>On every sale this amount will be added to salesman account. input fixed amount not in percentage.</small>
                                </div>
                              </div>
                            <?php
                                  }
                              }
                              if(isset($_SESSION['sess_bp_agent_commision']))
                              {
                                  if($_SESSION['sess_bp_agent_commision']=='on')
                                  {
                            ?>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Agent Commission</label>
                                  <input type="number" class="form-control" name="agent_commission" id="agent_commission">
                                  <small>On every sale this amount will be added to agent account. input fixed amount not in percentage.</small>

                              </div>
                            </div>
                            <?php
                                  }
                              }
                              if(isset($_SESSION['sess_bp_lend_inventory']))
                              {
                                  if($_SESSION['sess_bp_lend_inventory']=='on')
                                  {
                            ?>
                              <div class="col-md-6">
                                <div class="form-group col-xs-12">
                                    <h4 for="lend_inventory">Lendable Product</h4>
                                    <input name="lend_inventory" value="on" type="radio" id="lend_inventory_on" class="with-gap radio-col-cyan lend_inventory">
                                    <label for="lend_inventory_on">On</label>

                                    <input name="lend_inventory" value="off" type="radio" id="lend_inventory_off" class="with-gap radio-col-blue-grey secondary_units" checked>
                                    <label for="lend_inventory_off">off</label>

                                </div>

                              </div>
                            <?php
                          }else{
                            ?>
                              <input type="hidden" name="lend_inventory" value="off">
                            <?php
                          }
                              }else{
                                ?>
                                  <input type="hidden" name="lend_inventory" value="off">
                                <?php
                              }
                            ?>
                          <div id="msgholder" class="alert alert-danger d-none"></div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect pull-right" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success waves-effect btn-block" id="submitBtn">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
