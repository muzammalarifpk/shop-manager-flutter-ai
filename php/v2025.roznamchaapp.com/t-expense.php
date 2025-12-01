<?php
  require_once("t-expense.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
  $_SESSION['sess_bp_token'] = get_random(32);
?>
<script>
</script>
<style>
.block12{width: 100% !important;}
.block11{width: 91.63% !important;}
.block10{width: 83.33% !important;}
.block9{width: 75% !important;}
.block8{width: 66.64% !important;}
.block7{width: 58.31% !important;}
.block6{width: 50% !important;}
.block5{width: 41.65% !important;}
.block4{width: 33.32% !important;}
.block3{width: 25% !important;}
.block2{width: 16.66% !important;}
.block1{width: 8.33% !important;}
.form-horizontal{width: 100%;}
.form-horizontal .row{ margin-top: 10px; margin-bottom: 10px;}
</style>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <?php
                          $module_count=count($meta['module']);
                          $counter=1;
                          foreach ($meta['module'] as $key => $value) {

                            ?>
                              <li class="breadcrumb-item
                              <?php

                                if($counter==$module_count)
                                {
                                  echo 'active';
                                }

                              ?>"><?=ucfirst($value)?></li>
                            <?php
                            $counter++;
                          }
                        ?>
                    </ol>
                </div>
                <div class="hide">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->



                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                            <div class="card-body">


<?php

  $all_fields=array('contact_name','invoice_date','sub_total','discount','grand_total','amount_paid','payment_method','remaining_balance','products_json','invoice_number');


 ?>

                                    <h2 class="hide">Add New sale</h2>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-6">
                                          <lable for="expense_type">Expense Type</lable>
                                          <select class="form-control select2" name="expense_type" id="expense_type">
                                            <?php
                                            foreach ($list_expense_types as $key => $row )
                                            {

                                             ?>
                                            <option value="<?=$row?>"><?=$row?></option>
                                            <?php
                                              }

                                             ?>
                                             <option value="Others">Others</option>
                                             <?php
                                             $select_expense="select * from `expense_type` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status` = 'Published' order by `name` asc";

                                             $stmt = $db->prepare($select_expense);
                                             $stmt->execute();

                                             $count_rows = $stmt->rowCount();

                                             if($count_rows>0)
                                             {
                                               foreach ($db->query($select_expense) as $expense_type) {
                                                 ?>
                                                 <option value="<?=$expense_type['name']?>"><?=$expense_type['name']?></option>
                                                 <?php
                                               }
                                             }

                                              ?>
                                          </select>
                                          <br />
                                          <a href="su-expense.php" class="btn btn-link">Add New Expense Type</a>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date">Date </label>

                                          <div class="input-group">
                                              <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                              <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                        </div>
                                      </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                          <label for="amount">Amount</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="number" required class="form-control" name="amount" id="amount" value="">
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="description">Description</label>
                                        </div>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" name="description" id="description" placeholder="paid x amount for ...">
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-6">
                                          <label for="payment_method">Payment Method</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="payment_method" id="payment_method">
                                              <?php
                                           try{
                                               $bank_qry="select * from `chartofaccount` where (`account_type`=:type1 or `account_type`=:type2) and  `owner_mobile`=:owner_mobile and `status`=:status";
                                               $banks=$db->prepare($bank_qry);

                                               $owner_mobile=$_SESSION['sess_bp_username'];
                                               $banks->execute(['type1'=>'Cash','type2'=>'Bank','owner_mobile'=>$owner_mobile,'status'=>'Published']);

                                               while($bank=$banks->fetch())
                                               {
                                                 ?>
                                                   <option value="<?=$bank['id']?>"><?=$bank['account_head']?></option>
                                                 <?php
                                               }
                                             }  catch (Exception $e) {
                                                   echo $e->getMessage();
                                               }


                                               ?>
                                            </select>
                                        </div>
                                      </div>
                                      <?php
                                      if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                                        if($_SERVER['HTTP_X_REQUESTED_WITH'] == "pk.baseplan.cloudinventorymanagerlearner") {
                                          // echo '<h2>use software from browser to .</h2>';
                                        }
                                      }else{
                                        ?>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <label class="hide" for="Attachment">Attachment</label>
                                            
                                          </div>
                                          <div class="col-sm-6">
                                            <div data-action="t-invoice-gallery.process.php?invoice_token=" class="dropzone"></div>
                                          </div>
                                        </div>

                                        <?php
                                      }

                                       ?>


                                      <div class="row">
                                        <div class="col-sm-6"><a href="#" id="resetbtn" class="btn btn-danger">Cancel</a></div>
                                        <div class="col-sm-6"><a href="#" id="submitbtn" class="btn btn-success pull-right">Save and Next</a></div>
                                      </div>
                                </form>
                              </div>
                            </div>

                          </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php require_once("includes/right.php"); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"><?=$footer_note?></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <?php
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script>


            $("#submitbtn").click(function(e){
              e.preventDefault();
              $('.preloader').show();
              $(this).attr('disabled',true);


                var expense_type = $("#expense_type").val();
                var date = $("#datepicker-autoclose").val();
                var amount = $("#amount").val();
                var description = $("#description").val();
                var payment_method = $("#payment_method").val();

                amount = parseFloat(amount);

                if(amount>0)
                {



                $.post( "t-expense-new.php", { expense_type: expense_type, date: date, amount: amount, description: description, payment_method: payment_method })
                  .done(function( data ) {
                    //alert(data);
                    if(data == 'success')
                    {
//                      alert('success');
                        swal({
                          title: 'Success!',
                          text: 'Expense Added successfully.',
                          timer: 2000,
                          type: 'success',
                          showConfirmButton: false
                        });
                        setTimeout(function() {
                          window.location.reload();
                        }, 3000);

                    }else{

                      alert('error'+data);
                    }
                  });


                return false;
              }else{
                alert("amount can not be zero.");
                $('.preloader').hide();

              }

            });

        </script>
        <script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
        <script type="text/javascript">
        //Disabling autoDiscover
        Dropzone.autoDiscover = false;

        $(function() {
            //Dropzone class
            var myDropzone = new Dropzone(".dropzone", {
                url: "t-invoice-gallery.process.php?type=expense_attachment",
                paramName: "file",
                maxFilesize: 3,
                maxFiles: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                init: function()
                {
                  this.on('error', function(file, response) {
                    //console.log(file);
                    //console.log(response);
                      $(file.previewElement).attr('style','border: 2px solid red');
        //                  var this_previewElement =$(file.previewElement).html(); //.find('.dz-error-message').text(message.Message);
        //                  console.log(this_previewElement);
                  });
                  this.on('success', function(file, resp){
                    if(isValidJSONString(resp))
                    {
                      var response = jQuery.parseJSON( resp );
                      if(response.code == 200){
                        $(file.previewElement).attr('style','border: 2px solid green');
        //                        load_images();
        //                        window.location.reload();
                      }else{
                        alert(response.msg);
                      }
                    }else{
                      alert('invalid response: '+resp);
                    }

                  });
                  this.on("complete", function(file)
                  {
        //                    load_images();
                    console.log(file);
                    console.log(status);
                    if (file.size > 3*1024*1024)
                    {
                      this.removeFile(file);
                      alert('file too big');
                      return false;
                    }
                    if(!file.type.match('image.*'))
                    {
                      this.removeFile(file);
                      alert('Not an image')
                      return false;
                    }
                });
              },
            });
        });
        </script>    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
