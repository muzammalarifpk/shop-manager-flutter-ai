<?php
  require_once("t-journal.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
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

                                    <h2 class="">Add New journal entry (Only use if you understand double entry accouting.)</h2>
                                    <form class="form-horizontal" id="invoice_form" action="" method="post">

                                      <div class="row">
                                        <div class="col-md-6">
                                          <lable for="debit_account">Debit Account</lable>

                                          <select class="form-control" name="debit_account" id="debit_account">
                                            <?php
                                            $accounts_qry="select `id`,`account_head`,`account_type` from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type` = 'Cash' or `account_type` = 'Equity' or `account_type`='bank')";

                                            foreach ($db->query($accounts_qry) as $account_row)
                                            {
                                              ?>
                                              <option value="<?=$account_row['id']?>"><?=$account_row['account_head']?> (<?=$account_row['account_type']?>)</option>
                                              <?php
                                            }

                                            ?>
                                            <option value="<?=$_SESSION['sess_account_keys']['expense']?>">Expense (expense)</option>
                                            <?php
                                            $contacts_qry="select `name`,`number` from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' order by `type`,`name`";

                                            foreach ($db->query($contacts_qry) as $contact_row)
                                            {

                                             ?>
                                            <option value="c<?=$contact_row['number']?>"><?=$contact_row['name']?> (<?=$contact_row['number']?>)</option>
                                            <?php
                                              }


                                             ?>
                                          </select>
                                        </div>

                                        <div class="col-md-6">
                                          <label for="date">Date </label>

                                          <div class="input-group">
                                              <input type="date" name="date" class="form-control" id="datepicker-autoclose" value="<?=date("Y-m-d")?>">
                                              <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                        </div>

                                        <div class="col-md-6">
                                          <lable for="credit_account">Credit Account</lable>

                                          <select class="form-control" name="credit_account" id="credit_account">
                                            <?php
                                            $accounts_qry="select `id`,`account_head`,`account_type` from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type` = 'Cash' or `account_type` = 'Equity' or `account_type`='bank')";

                                            foreach ($db->query($accounts_qry) as $account_row)
                                            {
                                              ?>
                                              <option value="<?=$account_row['id']?>"><?=$account_row['account_head']?> (<?=$account_row['account_type']?>)</option>
                                              <?php
                                            }

                                            ?>
                                              <option value="<?=$_SESSION['sess_account_keys']['expense']?>">Expense (expense)</option>
                                            <?php

                                            $contacts_qry="select `name`,`number` from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' order by `type`,`name`";

                                            foreach ($db->query($contacts_qry) as $contact_row)
                                            {

                                             ?>
                                            <option value="c<?=$contact_row['number']?>"><?=$contact_row['name']?> (<?=$contact_row['number']?>)</option>
                                            <?php
                                              }


                                             ?>
                                          </select>
                                        </div>

                                        <div class="col-sm-6">
                                          <label for="amount">Amount</label>
                                          <input type="text" required class="form-control" name="amount" id="amount" value="">
                                        </div>


                                        <div class="col-sm-12">
                                          <label for="description">Description</label>
                                          <input type="text" class="form-control" name="description" id="description" placeholder="Description ...">
                                        </div>
                                      </div>


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

                var debit_account = $("#debit_account").val();
                var credit_account = $("#credit_account").val();
                var date = $("#datepicker-autoclose").val();
                var amount = $("#amount").val();
                var description = $("#description").val();

                $.post( "t-journal-new.php", { debit_account: debit_account, credit_account:credit_account, date: date, amount: amount, description: description })
                  .done(function( data ) {
//                    alert(data);
                    if(data == 'success')
                    {
                      alert('success');
                      window.location.reload();
                    }else{
                      alert('error'+data);
                    }
                  });


                return false;

            });

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
