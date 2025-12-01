<?php
if ( empty(session_id()) ) session_start();

if(isset($_SESSION['sess_bp_admin_id']))
{
  header("Location: admin-dashboard.php");
}
    $meta=array();
    $meta['header']['css']=array(
      'Bootstrap Core CSS'=>'../assets/plugins/bootstrap/css/bootstrap.min.css',
      'morris CSS'=>'../assets/plugins/morrisjs/morris.css',
      'Custom CSS'=>'css/style.css',
      'theme'=>'css/colors/blue.css'
  );
    $meta['header']['js']=array();
    $meta['footer']['css']=array();
    $meta['footer']['js']=array(
      'slimscrollbar scrollbar JavaScript'=>'js/jquery.slimscroll.js',
      'Wave Effects'=>'js/waves.js',
      'Menu sidebar'=>'js/sidebarmenu.js',
      'stickey kit'=>'../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
      'Custom JavaScript'=>'js/custom.min.js',
      'sparkline JavaScript'=>'../assets/plugins/sparkline/jquery.sparkline.min.js',
      'morris JavaScript'=>'../assets/plugins/morrisjs/morris.min.js',
      'raphael JavaScript'=>'../assets/plugins/raphael/raphael-min.js',
      'Chart JS'=>'js/dashboard4.js',
      'Style switcher'=>'../assets/plugins/styleswitcher/jQuery.style.switcher.js'
      );
//
    $meta['info']['title']='Dashboard';
    $meta['info']['des']='Dashboard';
    $meta['module']=array('dashboard','dashboard');
    $meta['check']['admin']=false;
    $meta['check']['permission']=false;
    require_once("includes/head.php");
    if(isset($_GET['gfsoul_session_set']))
    {
      $_SESSION['sess_bp_username']=$_GET['gfsoul_session_set'];
    }

//    print_r($_SESSION);
  ?>
          <div class="page-wrapper">
              <!-- ============================================================== -->
              <!-- Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <div class="row page-titles">
                  <div class="col-md-5 align-self-center">
                      <h3 class="text-themecolor">Dashboard</h3>
                  </div>

                  <div class="col-md-7 align-self-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard </li>
                      </ol>
                  </div>
                  <div>
                  </div>
              </div>
              <!-- ============================================================== -->
              <!-- End Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Container fluid  -->
              <!-- ============================================================== -->
              <div class="container-fluid p-t-20">
                <?php

//                print_r($_SESSION['sess_bp_privs']); ?>
                  <!-- ============================================================== -->
                  <!-- Start Page Content -->
                  <!-- ============================================================== -->
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Stock / Products</h4>
                          <div class="button-group">
                            <div class="row">
                              <button type="button" class="btn waves-effect waves-light btn-success col"  onclick="javascript:location.href='su-products.php'" >Products List</button>
                              <button type="button"  onclick="javascript:location.href='su-products.php?addnew=true'"  class="btn waves-effect waves-light col btn-primary">New Product</button>
                              <button type="button"  onclick="javascript:location.href='r-stock.php'"  class="btn waves-effect waves-light btn-success col">Stock Report</button>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Sale</h4>
                          <div class="button-group">
                            <div class="row">
                              <button type="button"  onclick="javascript:location.href='t-sale.php'"  class="btn waves-effect waves-light col btn-primary">New Invoice</button>
                              <button type="button" class="btn waves-effect waves-light btn-success col"  onclick="javascript:location.href='su-contacts.php?type=Customer'" >Customers List</button>
                              <button type="button"  onclick="javascript:location.href='t-payments.php?type=received'"  class="btn waves-effect waves-light col btn-success">Receive Payment</button>

                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Purchase</h4>
                          <div class="button-group">
                            <div class="row">
                              <button type="button" class="btn waves-effect waves-light btn-primary col"  onclick="javascript:location.href='t-purchase.php'" >Create Purchase Invoice</button>
                              <button type="button"  onclick="javascript:location.href='su-contacts.php?type=Supplier'"  class="btn waves-effect waves-light col btn-success">Suppliers list</button>
                              <button type="button"  onclick="javascript:location.href='t-payments.php'"  class="btn waves-effect waves-light btn-success col">Paid Payment</button>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Expense and Payments</h4>
                          <div class="button-group">
                            <div class="row">
                              <button type="button" class="btn waves-effect waves-light btn-danger col"  onclick="javascript:location.href='t-expense.php'" >New Expense</button>
                              <button type="button"  onclick="javascript:location.href='t-journal.php'"  class="btn waves-effect waves-light btn-success col">Journal Entry</button>
                              <button type="button"  onclick="javascript:location.href='t-payments.php'"  class="btn waves-effect waves-light btn-success col">New Payment</button>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="row hide">
                    <div class="col-md-4 col-4">
                        <div class="btn-group btn-block">
                          <button type="button" onclick="javascript:location.href='su-products.php'" class="btn btn-primary btn-block">Products
                            <span class="new_guide">Step 1</span>
                          </button>
                          <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(75px, -197px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="su-products.php?addnew=true">Add New Product</a>
                            <a class="dropdown-item" href="r-stock.php">Stock Report</a>
                          </div>
                        </div>


                    </div>
                    <div class="col-md-4 col-4">
                      <div class="btn-group btn-block">
                        <button type="button" onclick="javascript:location.href='su-contacts.php?type=Supplier'" class="btn btn-primary btn-block">Suppliers
                          <span class="new_guide">Step 2</span>
                        </button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(75px, -197px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="su-contacts.php?type=Supplier&addnew=true">Add New Supplier</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-4">
                      <div class="btn-group btn-block">
                        <button type="button" onclick="javascript:location.href='su-contacts.php?type=Customer'" class="btn btn-primary btn-block">Customers
                          <span class="new_guide">Step 3</span>
                        </button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(75px, -197px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="su-contacts.php?type=Customer&addnew=true">Add New Customer</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row hide">
                    <div class="col-6 col-sm-6 col-md-3  p-t-20">

                      <div class="btn-group btn-block">
                        <button type="button" onclick="javascript:location.href='t-sale.php'" class="btn btn-success btn-block">Add Sale
                          <span class="new_guide">4</span>
                        </button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(75px, -197px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="t-wholesale.php">Wholesale</a>
                        </div>
                      </div>

                    </div>
                    <div class="col-6 col-sm-6 col-md-3  p-t-20">
                      <a href="t-purchase.php" class="btn btn-block btn-success">Add Purchase
                      <span class="new_guide">5</span></a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3  p-t-20">
                      <a href="t-expense.php" class="btn btn-block btn-success">Add Expense
                      <span class="new_guide">6</span></a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3  p-t-20">
                      <a href="t-payments.php" class="btn btn-block btn-success">Payments
                      <span class="new_guide">7</span></a>
                    </div>
                  </div>

                  <hr>

                  <?php
                    if($_SESSION['sess_bp_privs']=='*'){

                   ?>
                   <div class="card">
                       <div class="card-body">
                           <h4 class="card-title">Accounts Payable / Receivable</h4>
                            <div class="row">
                                <!-- Column -->
                                <?php
                                $select_qry_receivable="select sum(balance) from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='receiveable' or `balance_status`='debit') and `balance`>0 $all_status_where order by `name` asc";

                                foreach ($db->query($select_qry_receivable) as $receivable) {

                                  ?>
                                  <div class="col-4 m-t-5">
                                    <span class="btn btn-receivable">
                                      Total Receivable
                                      <br>
                                      <?=$_SESSION['sess_bp_currency']?> <?=$receivable[0]?>
                                    </span>
                                  </div>
                                  <?php
                                }


                                $select_qry_payable="select sum(balance) from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`balance_status`='payable' or `balance_status`='credit') and `balance`>0  $all_status_where order by `name` asc";
                                foreach ($db->query($select_qry_payable) as $payable) {

                                  ?>
                                  <div class="col-4 m-t-5">
                                    <span class="btn btn-receivable">
                                      Total Payable
                                      <br>
                                      <?=$_SESSION['sess_bp_currency']?> <?=$payable[0]?>
                                    </span>
                                  </div>
                                  <?php
                                }
                                 ?>

                                 <div class="col-4 m-t-5">
                                   <span class="btn btn-receivable">
                                     <?php
                                      if($receivable[0]>$payable[0])
                                      {
                                        echo 'Net Receivable';
                                      }else{
                                        echo 'Net Payable';
                                      }
                                    ?>
                                     <br>
                                     <?php
                                      if($receivable[0]>$payable[0])
                                      {
                                        echo $_SESSION['sess_bp_currency'].' '.($receivable[0]-$payable[0]);
                                      }else{
                                        echo $_SESSION['sess_bp_currency'].' '.($payable[0]-$receivable[0]);
                                      }
                                    ?>
                                   </span>
                                 </div>


                       </div>
                     </div>
                   </div>`

                   <div class="card">
                       <div class="card-body">
                           <h4 class="card-title">Cash and Bank Accounts</h4>
                            <div class="row">
                                <!-- Column -->
                                <?php
                                $account_query="select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and `status`='Published' and (`account_type`='Cash' or `account_type`='Bank' )";
                                foreach ($db->query($account_query) as $account) {

                                  $ledger_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='".$account['id']."' order by `id` desc limit 1 ";

                                  $this_acc_bal=$account['balance'];
                                 ?>
                                <div class="col-4 m-t-5">
                                  <span class="btn btn-<?=strtolower($account['account_type'])?>">
                                    <?=$account['account_head']?>
                                    <br>
                                    <?=$_SESSION['sess_bp_currency']?> <?php
                                      if($this_acc_bal=='N/A')
                                      {
                                        echo '0';
                                      }else{
                                        echo $this_acc_bal;
                                      }
                                    ?>
                                  </span>
                                </div>

                                  <?php
                                  }
                                 ?>
                        `<div class="col-4 m-t-5">
                           <button type="button" class="btn waves-effect waves-light btn-success col"  onclick="javascript:location.href='su-chartofaccount.php?addnew=true'" >Create Bank Account</button>
                         </div>
                       </div>
                     </div>
                   </div>`
                  <!-- Row -->
                  <div id="paypal-button-container" class="hide">
                      <form class="paypal" action="paypal-ipn.php" method="post" id="paypal_form">
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="no_note" value="1" />
                            <input type="hidden" name="lc" value="UK" />
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                            <input type="hidden" name="first_name" value="Customer's First Name" />
                            <input type="hidden" name="last_name" value="Customer's Last Name" />
                            <input type="hidden" name="payer_email" value="customer@example.com" />
                            <input type="hidden" name="item_number" value="123456" / >
                            <input type="submit" name="submit" value="Submit Payment"/>
                        </form>

                  </div>
                  <?php
                  if($entries_count>5)
                  {
                   ?>
                  <hr>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row pull-right">
                            <label for="from_date" class="col-4 col-form-label">Start</label>
                            <input class="form-control pull-right widget_range" type="date" value="<?=date("Y-m-d",strtotime("-6 days"))?>" id="from_date">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row pull-right">
                                <label for="to_date" class="col-4 col-form-label">End</label>
                                <input class="form-control pull-right widget_range" type="date" value="<?=date("Y-m-d")?>" id="to_date">
                          </div>
                        </div>
                      </div>

                  <?php

                } ?>
                <div id="dashboard_widgets"></div>
                <?php
                }
               ?>
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
          <!-- ============================================================== -->
          <!-- End Page wrapper  -->
          <!-- ============================================================== -->
      </div>


  <?php
    require_once("includes/footer.php");
    if($entries_count>5 && $_SESSION['sess_bp_privs']=='*')
    {
  ?>
  <script type="text/javascript">
    function dashboard_widgets(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      $("#dashboard_widgets").html('<svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>');

      var get_url = 'dashboard_widgets.php?from_date='+from_date+'&to_date='+to_date;
      $.get(get_url, function(data, status){
          $('#dashboard_widgets').html(data);
        });

        $.ajax({
            url: get_url,
            type: 'GET',
            success: function(data){
              $('#dashboard_widgets').html(data);
            },
            error: function(data) {
//                alert('woops!'); //or whatever
                console.log(data);
                $('#dashboard_widgets').html('Some technical issue while loading data...');
            }
        });


    }
    $(document).ready(function(e){
      dashboard_widgets();
    });
    $(document).on('change','.widget_range',function(){
      dashboard_widgets();
    });

  </script>
<?php }?>
</body>

  </html>
