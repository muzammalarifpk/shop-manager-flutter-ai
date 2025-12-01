<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-expense.config.php");

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
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="name"> Expense Type Name: <span class="text-danger">*</span></label>
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
                                  </div>


                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Description</label>
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
