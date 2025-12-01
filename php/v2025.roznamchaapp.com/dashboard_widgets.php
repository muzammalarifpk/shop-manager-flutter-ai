<?php
             require_once("includes/dbc.php");

               $from_date=$_GET['from_date']; // start date
               $from_date_=date("d-M, Y",strtotime($from_date)); // start date
               $to_date=$_GET['to_date']; // end date
               $to_date=date("Y-m-d",strtotime("+1 days $to_date"));
               $to_date_=date("d-M, Y",strtotime($to_date));
//               echo '<h2>From Date: '.$from_date.' To date: '.$_GET['to_date'].'<h2 />';
               $total['purchase']=0;
               $total['sale']=0;
               $total['cost_of_sale']=0;
               $total['gross_profit']=0;
               $total['expense']=0;
               $total['net_profit']=0;


               $weekly_data=[];

               $weekly_graph_qry="select * from `graph` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`date`>='$from_date' or `date`>= '$from_date_') and (`date`<='$to_date' || `date`<='$to_date_')";

               foreach ($db->query($weekly_graph_qry) as $day_row) {
                 $weekly_data[$day_row['date']]=$day_row;

                 $total['purchase']=$total['purchase']+floatval($day_row['total_purchase']);
                 $total['sale']=$total['sale']+floatval($day_row['total_sale']);
                 $total['cost_of_sale']=$total['cost_of_sale']+floatval($day_row['cost_of_sale']);
                 $total['gross_profit']=$total['gross_profit']+(floatval($day_row['total_sale'])-floatval($day_row['cost_of_sale']));
                 $total['expense']=$total['expense']+floatval($day_row['expense']);
                 $total['net_profit']=$total['net_profit']+((floatval($day_row['total_sale'])-floatval($day_row['cost_of_sale']))-floatval($day_row['expense']));

               }

                $sale_insight = "select * from `sale_invoices` where  `owner_mobile`='$_SESSION[sess_bp_username]' and `date`>='$from_date' and `date`<='$to_date'";
                $sale_return_insight = "select * from `sale_invoices_returns` where  `owner_mobile`='$_SESSION[sess_bp_username]' and `date`>='$from_date'  and `date`<='$to_date' ";

              //  echo $sale_insight;
              //  echo $sale_return_insight;
                  $sale_insight_totals=array();

                  $sale_insight_totals['cash']['sale']=0;
                  $sale_insight_totals['cash']['cost']=0;

                  $sale_insight_totals['credit']['sale']=0;
                  $sale_insight_totals['credit']['cost']=0;

                  $sale_insight_totals['partial']['sale']=0;
                  $sale_insight_totals['partial']['cost']=0;

                  $sale_insight_totals['total']['sale']=0;
                  $sale_insight_totals['total']['cost']=0;



                  foreach ($db->query($sale_insight) as $row_sale_insight)
                  {
                    $sale_insight_totals['total']['sale']+=floatval($row_sale_insight['grand_total']);
                    $sale_insight_totals['total']['cost']+=floatval($row_sale_insight['cost_of_sale']);

                    if(floatval($row_sale_insight['remaining_amount'])==0)
                    {
                      $sale_insight_totals['cash']['sale']+=floatval($row_sale_insight['grand_total']);
                      $sale_insight_totals['cash']['cost']+=floatval($row_sale_insight['cost_of_sale']);
                    }

                    elseif(floatval($row_sale_insight['amount_paid'])==0)
                    {
                      $sale_insight_totals['credit']['sale']+=floatval($row_sale_insight['grand_total']);
                      $sale_insight_totals['credit']['cost']+=floatval($row_sale_insight['cost_of_sale']);
                    }else{
                      $sale_insight_totals['partial']['sale']+=floatval($row_sale_insight['grand_total']);
                      $sale_insight_totals['partial']['cost']+=floatval($row_sale_insight['cost_of_sale']);
                    }
                  }


                foreach ($db->query($sale_return_insight) as $row_sale_return_insight)
                {

//                  print_r($row_sale_return_insight);
                  $sale_insight_totals['total']['sale']-=floatval($row_sale_return_insight['grand_total']);
                  $sale_insight_totals['total']['cost']-=floatval($row_sale_return_insight['cost_of_sale']);

                  if(floatval($row_sale_return_insight['remaining_amount'])==0)
                  {
                    $sale_insight_totals['cash']['sale']-=floatval($row_sale_return_insight['grand_total']);
                    $sale_insight_totals['cash']['cost']-=floatval($row_sale_return_insight['cost_of_sale']);
                  }

                  elseif(floatval($row_sale_return_insight['amount_paid'])==0)
                  {
                    $sale_insight_totals['credit']['sale']-=floatval($row_sale_return_insight['grand_total']);
                    $sale_insight_totals['credit']['cost']-=floatval($row_sale_return_insight['cost_of_sale']);
                  }else{
                    $sale_insight_totals['partial']['sale']-=floatval($row_sale_return_insight['grand_total']);
                    $sale_insight_totals['partial']['cost']-=floatval($row_sale_return_insight['cost_of_sale']);
                  }
                }

              $weekly_data_graph = [];
              $total['purchase']=0;
              $total['sale']=0;
              $total['cost_of_sale']=0;
              $total['gross_profit']=0;
              $total['expense']=0;
              $total['net_profit']=0;


              $this_date=$from_date;

              while($this_date!=$to_date)
              {
                $weekly_data_graph[$this_date]['purchase_invoices']=get_daily_data($db,'purchase_invoices','grand_total',$this_date)-get_daily_data($db,'purchase_invoices_returns','grand_total',$this_date);
                $weekly_data_graph[$this_date]['sale_invoices']=get_daily_data($db,'sale_invoices','grand_total',$this_date)-get_daily_data($db,'sale_invoices_returns','grand_total',$this_date);
                $weekly_data_graph[$this_date]['sale_invoices_cost']=get_daily_data($db,'sale_invoices','cost_of_sale',$this_date)-get_daily_data($db,'sale_invoices_returns','cost_of_sale',$this_date);
                $weekly_data_graph[$this_date]['gross_profit']=$weekly_data_graph[$this_date]['sale_invoices']-$weekly_data_graph[$this_date]['sale_invoices_cost'];
                $weekly_data_graph[$this_date]['expense']=get_daily_data($db,'expense','amount',$this_date);
//                echo '<h2>'.$weekly_data_graph[$this_date]['expense'].'</h2>';
                $weekly_data_graph[$this_date]['net_profit']=$weekly_data_graph[$this_date]['gross_profit']-$weekly_data_graph[$this_date]['expense'];

                $total['purchase']+=floatval($weekly_data_graph[$this_date]['purchase_invoices']);
                $total['sale']+=floatval($weekly_data_graph[$this_date]['sale_invoices']);
                $total['cost_of_sale']+=floatval($weekly_data_graph[$this_date]['sale_invoices_cost']);
                $total['gross_profit']+=floatval($weekly_data_graph[$this_date]['gross_profit']);
                $total['expense']+=floatval($weekly_data_graph[$this_date]['expense']);
                $total['net_profit']+=floatval($weekly_data_graph[$this_date]['net_profit']);

                $this_date=date('Y-m-d',strtotime('+1 day',strtotime($this_date)));
              }

              //print_r($weekly_data_graph);

              ?>

          <div class="row p-t-20">
            <div class="col-lg-8 col-md-7">

              <div class="card">
                  <div class="card-body">
                      <div class="d-flex flex-wrap">
                          <div>
                              <h4 class="card-title">Performance Chart</h4>
                          </div>
                          <div class="ml-auto hide">
                              <ul class="list-inline">
                                  <li>
                                    <h6 class="text-muted"><i class="fa fa-circle font-10 m-r-10"></i>Purchase</h6>
                                  </li>

                                  <li>
                                    <h6 class="text-muted"><i class="fa fa-circle font-10 m-r-10 "></i>Sale</h6>
                                  </li>

                                  <li>
                                    <h6 class="text-muted"><i class="fa fa-circle font-10 m-r-10"></i>Cost of Sale</h6>
                                  </li>

                                  <li>
                                    <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Gross Profit</h6>
                                  </li>

                                  <li>
                                    <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>Expense</h6>
                                  </li>

                                  <li>
                                    <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>Profit</h6>
                                  </li>

                              </ul>
                          </div>
                      </div>
                      <div id="weekly_graph" style="height: 405px;"></div>

                  </div>
              </div>

              <div class="row">

                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_green">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                    <span>Purchase <br><?=$_SESSION['sess_bp_currency']?> <?=$total['purchase']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_cyan">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                  <span>Sale <br><?=$_SESSION['sess_bp_currency']?> <?=$total['sale']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_indigo">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                  <span>Cost of sale <br><?=$_SESSION['sess_bp_currency']?> <?=$total['cost_of_sale']?></span>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_green">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                  <span>Gross Profit <br><?=$_SESSION['sess_bp_currency']?> <?=$total['gross_profit']?></span>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_red">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                  <span>Expense <br><?=$_SESSION['sess_bp_currency']?> <?=$total['expense']?></span>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-4 col-sm-4 col-md-4  p-t-20">
                    <div class="card">
                        <div class="card-body block_indigo">
                            <!-- Row -->
                            <div class="row">
                                <div class="col-12">
                                  <span>Net Profit <br><?=$_SESSION['sess_bp_currency']?> <?=$total['net_profit']?></span>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- Row -->

              <?php

                $to_date=$_GET['to_date'];
                $from_date=$_GET['from_date'];
                $to_date=date("Y-m-d",strtotime("+1 days $to_date"));


                $total['purchase']=0;
                $total['sale']=0;
                $total['cost_of_sale']=0;
                $total['gross_profit']=0;
                $total['expense']=0;
                $total['net_profit']=0;


                $weekly_graph_data=[];

                $weekly_graph_qry="select * from `graph` where  `owner_mobile`='$_SESSION[sess_bp_username]' and (`date`>='$from_date' or `date`>= '$from_date_') and (`date`<='$to_date' || `date`<='$to_date_')";
                foreach ($db->query($weekly_graph_qry) as $day_row) {
                  $current_date=date('Y-m-d',strtotime($day_row['date']));
                  $weekly_graph_data[$current_date]=$day_row;

                  $total['purchase']=$total['purchase']+floatval($day_row['total_purchase']);
                  $total['sale']=$total['sale']+floatval($day_row['total_sale']);
                  $total['cost_of_sale']=$total['cost_of_sale']+floatval($day_row['cost_of_sale']);
                  $total['gross_profit']=$total['gross_profit']+(floatval($day_row['total_sale'])-floatval($day_row['cost_of_sale']));
                  $total['expense']=$total['expense']+floatval($day_row['expense']);
                  $total['net_profit']=$total['net_profit']+((floatval($day_row['total_sale'])-floatval($day_row['cost_of_sale']))-floatval($day_row['expense']));

                }

               ?>


             <div class="row p-t-20">
               <div class="col-12">
                 <div class="card">
                   <div class="card-body" id="no-more-tables">
                     <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable">
                       <thead>
                         <tr class="cf">
                           <th>Sale Insight</th>
                           <th>Total Sale</th>
                           <th>Cost of Sale</th>
                           <th>Profit</th>
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <td data-title="" class="bolder">Cash Sale</td>
                           <td data-title="Total Sale: " id="insight_cash_total"><?=$sale_insight_totals['cash']['sale']?></td>
                           <td data-title="Cost of sale: " id="insight_cash_cost_of_sale"><?=$sale_insight_totals['cash']['cost']?></td>
                           <td data-title="Profit: " id="insight_cash_profit"><?=$sale_insight_totals['cash']['sale']-$sale_insight_totals['cash']['cost']?></td>
                         </tr>
                         <tr>
                           <td data-title="" class="bolder">Credit Sale</td>
                           <td data-title="Total Sale: " id="insight_credit_total"><?=$sale_insight_totals['credit']['sale']?></td>
                           <td data-title="Cost of sale: " id="insight_credit_cost_of_sale"><?=$sale_insight_totals['credit']['cost']?></td>
                           <td data-title="Profit: " id="insight_credit_profit"><?=$sale_insight_totals['credit']['sale']-$sale_insight_totals['credit']['cost']?></td>
                         </tr>
                         <tr>
                           <td data-title="" class="bolder">Partially Paid</td>
                           <td data-title="Total Sale: " id="insight_partial_total"><?=$sale_insight_totals['partial']['sale']?></td>
                           <td data-title="Cost of sale: " id="insight_partial_cost_of_sale"><?=$sale_insight_totals['partial']['cost']?></td>
                           <td data-title="Profit: " id="insight_partial_profit"><?=$sale_insight_totals['partial']['sale']-$sale_insight_totals['partial']['cost']?></td>
                         </tr>
                         <tr>
                           <th data-title="" class="bolder">Overall Sale</th>
                           <th data-title="Total Sale: " id="insight_total_sale"><?=$sale_insight_totals['total']['sale']?></th>
                           <th data-title="Cost of sale: " id="insight_cost_of_sale"><?=$sale_insight_totals['total']['cost']?></th>
                           <th data-title="Profit: " id="insight_profit"><?=$sale_insight_totals['total']['sale']-$sale_insight_totals['total']['cost']?></th>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
             </div>


              <div class="row p-t-20">
                <div class="col-12">

                  <div class="card">
                    <div class="card-body" id="no-more-tables">
                      <div>
                        <h4 class="card-title">Cash Flow (Last 7 Days)</h4>
                      </div>
                      <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable">
                        <thead>
                          <tr class="cf">
                            <th>Account head</th>
                            <th>Cash In</th>
                            <th>Cash Out</th>
                            <th>Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $account_query="select * from `chartofaccount` where `owner_mobile`='$_SESSION[sess_bp_username]' and (`account_type`='cash' or `account_type`='bank' ) and (`status`='Published' or `status`='published' )";
                            $i=0;
                            foreach ($db->query($account_query) as $account)
                            {
                              $i++;
                              $ledger_where=" `owner_mobile`='".$_SESSION['sess_bp_username']."' and `account_id`='".$account['id']."' ";


                              $flow_account_qry_credit="select sum(`amount`) as flow_amount from ledger where $ledger_where and `date`>='$from_date' and `date`<='$to_date' and `amount_type`='credit' ";

                              $flow_account_qry_debit="select sum(`amount`) as flow_amount from ledger where $ledger_where  and `date`>='$from_date' and `date`<='$to_date' and `amount_type`='debit' ";

                              $cashin=get_sum($db,$flow_account_qry_debit);
                              if($cashin=='')
                              {
                                $cashin=0;
                              }
                              $cashout=get_sum($db,$flow_account_qry_credit);
                              if($cashout=='')
                              {
                                $cashout=0;
                              }
                              $balance= $cashin-$cashout;
                            ?>
                            <tr>
                              <td data-title="" class="bolder"><a href="r-ledgerview.php?id=<?=$account['id']?>"><?=$account['account_head']?></a></td>
                              <td data-title="Cash In: "><?=$_SESSION['sess_bp_currency']?> <?php echo $cashin; ?></td>
                              <td data-title="Cash Out: "><?=$_SESSION['sess_bp_currency']?> <?php echo $cashout; ?></td>
                              <td data-title="Balance: "><?=$_SESSION['sess_bp_currency']?> <?php echo  $balance; ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Reports</h4>
                        <div class="row p-b-20">
                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-journal.php" class="btn btn-block btn-inverse">General Journal</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-daily-report.php" class="btn btn-block btn-inverse">Daily Report</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-stock.php" class="btn btn-block btn-inverse">Stock Report</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-sold-items.php" class="btn btn-block btn-inverse">Sold Items</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-profitnloss.php" class="btn btn-block btn-inverse">Profit and Loss</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-sales.php" class="btn btn-block btn-inverse">Sales Report</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-sales.php?sale_type=cash" class="btn btn-block btn-inverse">Cash Sales</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-sales.php?sale_type=credit" class="btn btn-block btn-inverse">Credit Sales</a>
                          </div>

                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-sales.php?sale_type=partial" class="btn btn-block btn-inverse">Partially Paid Sales</a>
                          </div>
                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-receivable.php" class="btn btn-block btn-inverse">Accounts Receivable</a>
                          </div>
                          <div class="col-6 col-sm-6 col-md-4  p-t-20">
                                <a href="r-receivable.php" class="btn btn-block btn-inverse">Accounts Payable</a>
                          </div>
                    </div>
                  </div>
                </div>

            </div>
              <div class="col-lg-4 col-md-5">

                  <!-- Column -->
                  <div class="card card-default">
                      <div class="card-header">
                          <div class="card-actions">
                              <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                              <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                              <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                          </div>
                          <h4 class="card-title m-b-0">Cash Sales Insight</h4>

                      </div>
                      <div class="card-body collapse show">
                      <div id="morris-donut-chart_cash" class="ecomm-donute" style="height: 317px;"></div>
                          <ul class="list-inline m-t-20 text-center">
                          <li >
                              <h6 class="text-muted"><i class="fa fa-circle text-info"></i> Total Sale</h65>
                              <h4 class="m-b-0"><?=$sale_insight_totals['cash']['sale']?></h4>
                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> Cost of sale</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['cash']['cost']?></h4>

                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-success"></i> Profit</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['cash']['sale']-$sale_insight_totals['cash']['cost']?></h4>

                          </li>
                      </ul>

                      </div>
                  </div>

                  <!-- Column -->
                  <div class="card card-default">
                      <div class="card-header">
                          <div class="card-actions">
                              <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                              <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                              <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                          </div>
                          <h4 class="card-title m-b-0">Credit Sales Insight</h4>
                      </div>
                      <div class="card-body collapse show">
                      <div id="morris-donut-chart_credit" class="ecomm-donute" style="height: 317px;"></div>
                          <ul class="list-inline m-t-20 text-center">
                          <li >
                              <h6 class="text-muted"><i class="fa fa-circle text-info"></i> Total Sale</h65>
                              <h4 class="m-b-0"><?=$sale_insight_totals['credit']['sale']?></h4>
                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> Cost of sale</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['credit']['cost']?></h4>

                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-success"></i> Profit</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['credit']['sale']-$sale_insight_totals['credit']['cost']?></h4>

                          </li>
                      </ul>

                      </div>
                  </div>

                  <!-- Column -->
                  <div class="card card-default">
                      <div class="card-header">
                          <div class="card-actions">
                              <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                              <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                              <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                          </div>
                          <h4 class="card-title m-b-0">Partially Paid Sales Insight</h4>
                      </div>
                      <div class="card-body collapse show">
                      <div id="morris-donut-chart_partial" class="ecomm-donute" style="height: 317px;"></div>
                          <ul class="list-inline m-t-20 text-center">
                          <li >
                              <h6 class="text-muted"><i class="fa fa-circle text-info"></i> Total Sale</h65>
                              <h4 class="m-b-0"><?=$sale_insight_totals['partial']['sale']?></h4>
                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> Cost of sale</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['partial']['cost']?></h4>

                          </li>
                          <li>
                              <h6 class="text-muted"><i class="fa fa-circle text-success"></i> Profit</h6>
                              <h4 class="m-b-0"><?=$sale_insight_totals['partial']['sale']-$sale_insight_totals['partial']['cost']?></h4>

                          </li>
                      </ul>

                      </div>
                  </div>
                  <!-- Column -->
              </div>
          </div>
          <?php if(isset($_SESSION['location']))
          { ?>
          <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
              <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Opportunity</h3> BasePlan (pvt) LTD is looking for Local partners <strong>Sales and Marketing</strong> in <strong><?=$_SESSION['location']?></strong>. If you are interested, You will have to send us your sales and marketing plan for our software and monthly marketing budget: <a href="https://wa.me/923434123489?text=<?=urlencode('Hello, I am using your cloud version and want to become your local marketing partner in '.$_SESSION['location'])?>">Click Here</a>.
          </div>
          <?php
          }
          ?>

          <!-- Row -->


          <!-- Row -->

          <!-- Row -->
          <!-- Row -->

          <!-- Row -->
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
<?php


?>

          <script type="text/javascript">

            $(document).ready(function(){

              Morris.Area({
                  element: 'weekly_graph',
                  data: [
                    <?php
                      $this_date=$from_date;

                      while($this_date!=$to_date)
                      {
                        if (!array_key_exists($this_date, $weekly_data_graph)) {
                            ?>
                            {
                                period: '<?=$this_date?>',
                                Purchase: 0,
                                Sale: 0,
                                Cost_of_Sale: 0,
                                Gross_Profit: 0,
                                Expense: 0,
                                Net_Profit: 0,
                            },
                            <?php
                          }else{
                          ?>
                          {
                              period: '<?=$this_date?>',
                              Purchase: <?=floatval($weekly_data_graph[$this_date]['purchase_invoices'])?>,
                              Sale: <?=floatval($weekly_data_graph[$this_date]['sale_invoices'])?>,
                              Cost_of_Sale: <?=floatval($weekly_data_graph[$this_date]['sale_invoices_cost'])?>,
                              Gross_Profit: <?=floatval($weekly_data_graph[$this_date]['gross_profit'])?>,
                              Expense: <?=floatval($weekly_data_graph[$this_date]['expense'])?>,
                              Net_Profit: <?=floatval($weekly_data_graph[$this_date]['net_profit'])?>,
                          },
                          <?php
                        }
                        $this_date=date('Y-m-d',strtotime('+1 day',strtotime($this_date)));
                    }
                    ?>
                  ],
                  xkey: 'period',
                  ykeys: ['Purchase', 'Sale','Cost_of_Sale','Gross_Profit','Expense','Net_Profit'],
                  labels: ['Purchase', 'Sale','Cost of Sale','Gross Profit','Expense','Net Profit'],
                  pointSize: 3,
                  fillOpacity: 0,
                  pointStrokeColors:['#009efb', '#7460ee','#f96262','#26c6da','#ffbc34','#4c5667'],
                  behaveLikeLine: true,
                  gridLineColor: '#e0e0e0',
                  lineWidth: 1,
                  smooth: true,
                  hideHover: 'auto',
                  lineColors: ['#009efb', '#7460ee','#f96262','#26c6da','#ffbc34','#4c5667'],
                  resize: true

              });
             // ==============================================================

             // Cash sales insight
             // ==============================================================
              Morris.Donut({
                  element: 'morris-donut-chart_cash',
                  data: [{
                      label: "Sale",
                      value: <?=$sale_insight_totals['cash']['sale']?>,

                  }, {
                      label: "Cost of Sale",
                      value: <?=$sale_insight_totals['cash']['cost']?>,
                  }, {
                      label: "Profit",
                      value: <?=$sale_insight_totals['cash']['sale']-$sale_insight_totals['cash']['cost']?>
                  }],
                  resize: true,
                  colors:[ '#1976d2', '#ef5350','#26c6da']
              });
              // ==============================================================


              // Credit sales insight
              // ==============================================================
               Morris.Donut({
                   element: 'morris-donut-chart_credit',
                   data: [{
                       label: "Sale",
                       value: <?=$sale_insight_totals['credit']['sale']?>,

                   }, {
                       label: "Cost of Sale",
                       value: <?=$sale_insight_totals['credit']['cost']?>,
                   }, {
                       label: "Profit",
                       value: <?=$sale_insight_totals['credit']['sale']-$sale_insight_totals['credit']['cost']?>
                   }],
                   resize: true,
                   colors:[ '#1976d2', '#ef5350','#26c6da']
               });
               // ==============================================================


               // Partial sales insight
               // ==============================================================
                Morris.Donut({
                    element: 'morris-donut-chart_partial',
                    data: [{
                        label: "Sale",
                        value: <?=$sale_insight_totals['partial']['sale']?>,

                    }, {
                        label: "Cost of Sale",
                        value: <?=$sale_insight_totals['partial']['cost']?>,
                    }, {
                        label: "Profit",
                        value: <?=$sale_insight_totals['partial']['sale']-$sale_insight_totals['partial']['cost']?>
                    }],
                    resize: true,
                    colors:[ '#1976d2', '#ef5350','#26c6da']
                });
                // ==============================================================

            });


          </script>
