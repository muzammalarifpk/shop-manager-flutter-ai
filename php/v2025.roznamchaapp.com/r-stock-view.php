<?php
  require_once("t-sale.config.php");

  $product_qry="SELECT * FROM `products` WHERE owner_mobile = '$_SESSION[sess_bp_username]' and `id`='$_GET[id]' ";
  $product_stmt = $db->prepare($product_qry);
  $product_stmt->execute();
  $product_row = $product_stmt->fetchAll();
  $product_row=$product_row[0];
  $meta['info']['title']='Product - '.$product_row['name'];
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
                        <li class="breadcrumb-item"><a href="r-stock.php">Stock Report</a></li>
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
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?=$product_row['name']?></h4>
                                <small class="text-muted p-t-30 db">Description</small>
                                <h6><?=$product_row['description']?></h6>
                                <small class="text-muted p-t-30 db">Tax Type</small>
                                <h6><?=$product_row['tax']?></h6>
                                <small class="text-muted p-t-30 db">Measuring unit	</small>
                                <h6><?=$product_row['measuring_unit']?></h6>
                                <small class="text-muted p-t-30 db">Available Stock</small>
                                <h6><?=$product_row['available_stock']?></h6>
                                <small class="text-muted p-t-30 db">Stock Value</small>
                                <h6><?=$product_row['available_stock']*$product_row['purchase_cost']?></h6>
                                <small class="text-muted p-t-30 db">Minimum stock limit</small>
                                <h6><?=$product_row['min_stock_limit']?></h6>
                                <small class="text-muted p-t-30 db">Purchase cost</small>
                                <h6><?=$product_row['purchase_cost']?></h6>
                                <small class="text-muted p-t-30 db">Sale price</small>
                                <h6><?=$product_row['sale_price']?></h6>
                                <small class="text-muted p-t-30 db">Wholesale price</small>
                                <h6><?=$product_row['wholesale_price']?></h6>
                                <small class="text-muted p-t-30 db">Tags</small>
                                <h6><?=$product_row['tags']?></h6>
                                <small class="text-muted p-t-30 db">Variants</small>
                                <h6><?=$product_row['variants']?></h6>
                                <small class="text-muted p-t-30 db">Status</small>
                                <h6><?=$product_row['status']?></h6>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Timeline</a> </li>
                                <li class="nav-item hide"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                                <li class="nav-item hide"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">


                                  <div class="card-body">
                                    <?php
                                      $invoice_qry="select * from `stock_history` where `product_id`='$_GET[id]' and `owner_mobile`='$_SESSION[sess_bp_username]'";

                                      if ($res = $db->query($invoice_qry)) {

                                          /* Check the number of rows that match the SELECT statement */
                                          if ($res->fetchColumn() > 0) {
                                              ?>
                                              <div class="table-responsive m-t-40">
                                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                      <tr>
                                                        <th>Date</th>
                                                        <th>Contact</th>
                                                        <th>Type</th>
                                                        <th>Quantity</th>
                                                        <th>Qty After</th>
                                                        <th>Unit Price</th>
                                                        <th>Secondary Unit</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                      <th>Date</th>
                                                      <th>Contact</th>
                                                      <th>Type</th>
                                                      <th>Quantity</th>
                                                      <th>Qty After</th>
                                                      <th>Unit Price</th>
                                                      <th>Secondary Unit</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    $sec_sum=[];
                                                    $units=[];
                                                      foreach ($db->query($invoice_qry) as $row) {
                                                      ?>
                                                        <tr>
                                                        <td><?=$row['date']?>
                                                        </td>
                                                        <td><?php
                                                          $invoice_table = 'sale_invoices';

                                                          if($row['in_out']=='sale')
                                                          {
                                                            $invoice_table = 'sale_invoices';
                                                          }elseif ($row['in_out']=='purchase') {
                                                            $invoice_table = 'purchase_invoices';
                                                          }elseif ($row['in_out']=='purchase_return') {
                                                            $invoice_table = 'purchase_invoices_returns';
                                                          }elseif ($row['in_out']=='sale_return') {
                                                            $invoice_table = 'sale_invoices_returns';
                                                          }else{
                                                            $invoice_table = '';
                                                          }

                                                          // echo $invoice_table;
                                                          if($invoice_table!=='')
                                                          {


                                                            $contact_number = gnrm($db,$invoice_table,"`owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$row[invoice_id]'",'contact_number');
                                                            $contact_name=gnrm($db,'contacts',"`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='$contact_number'",'name');
                                                            echo $contact_name.' <br />('.$contact_number.')';


                                                            $secondary_json = gnrm($db,$invoice_table,"`owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$row[invoice_id]'",'secondary_json');

                                                            $secondary_array=json_decode($secondary_json,true);
                                                           // print_r($secondary_array);
                                                          }else{
                                                            echo 'N/A';
                                                            $secondary_json='';
                                                            $secondary_array=[];
                                                          }
                                                        ?></td>
                                                        <td><span class="<?php if($row['in_out']=='sale' || $row['in_out'] == 'purchase_return' || $row['in_out'] == 'activity_input'){ echo "red-text";}else{ echo "green-text"; } ?>"><?=$row['in_out']?></span></td>
                                                        <td><span class="<?php if($row['in_out']=='sale' || $row['in_out'] == 'purchase_return' || $row['in_out'] == 'activity_input'){ echo "red-text";}else{ echo "green-text"; } ?>"><?=$row['qty']?></span></td>
                                                        <td><span class="<?php if($row['qty_after']<0){ echo "red-text";}else{ echo "green-text"; } ?>"><?=$row['qty_after']?></span></td>
                                                        <td><span class=""><?=$row['unit_price']?></span></td>

                                                        <td><span class="<?php if($row['in_out']=='sale' || $row['in_out'] == 'purchase_return' || $row['in_out'] == 'activity_input'){ echo "red-text";}else{ echo "green-text"; } ?>"><?php

                                                        $secondary_array_count = is_array($secondary_array) ? count($secondary_array) : count(array($secondary_array));

                                                        print_r($secondary_array);

                                                        if(($secondary_array_count)>0)
                                                        {


                                                          foreach ($secondary_array as $key => $value)


                                                          {
                                                            // code...
                                                            if($value['item_id']==$_GET['id'])
                                                            {
//                                                              echo $value['secondary_html'];

                                                              if(isset($value['secondary_json']))
                                                              {
  //                                                              print_r($value['secondary_json']);

                                                                foreach ($value['secondary_json'] as $sec_key => $this_secondary_json) {
                                                                  // code...
//                                                                  print_r($this_secondary_json);

                                                                  if(isset($this_secondary_json['this_secondary_item_val']))
                                                                  {

                                                                    echo '<li>'.$this_secondary_json['this_secondary_item_val'].' '.$this_secondary_json['this_secondary_name'].'</li>';

                                                                    print_r($units);

                                                                    if(isset($units[$this_secondary_json['this_secondary_name']]))
                                                                    {
                                                                      if($row['in_out']=='sale' || $row['in_out'] == 'purchase_return' || $row['in_out'] == 'activity_input')
                                                                      {
                                                                        $units[$this_secondary_json['this_secondary_name']]=$units[$this_secondary_json['this_secondary_name']]-$this_secondary_json['this_secondary_item_val'];
                                                                      }else{
                                                                        $units[$this_secondary_json['this_secondary_name']]=$units[$this_secondary_json['this_secondary_name']]+$this_secondary_json['this_secondary_item_val'];

                                                                      }
                                                                    }
                                                                    else{
                                                                      if($row['in_out']=='sale' || $row['in_out'] == 'purchase_return' || $row['in_out'] == 'activity_input')
                                                                      {

                                                                      $units[$this_secondary_json['this_secondary_name']]=0-$this_secondary_json['this_secondary_item_val'];
                                                                    }else{
                                                                      $units[$this_secondary_json['this_secondary_name']]=$this_secondary_json['this_secondary_item_val'];

                                                                    }
                                                                    }
                                                                  }
                                                                }

//                                                                echo '<li>'.$value['secondary_json']['this_secondary_item_val'].' '.$value['secondary_json']['this_secondary_name'].'</li>';

                                                                /*
                                                                preg_match('/data-secondary_qty="(.+?)"/', $value['secondary_html'], $matches);
                                                                preg_match('/data-secondary_name="(.+?)"/', $value['secondary_html'], $units);



                                                                $sec_sum[$value['item_id']][]=['in_out'=>$row['in_out'],'qty'=>$matches[1]];

                                                                echo $matches[1].' '.$units[1];
                                                                */
                                                              }
                                                            }
                                                          }
                                                        }
                                                        ?> </span></td>

                                                      </tr>
                                                      <?php
                                                      }
                                                     ?>
                                                   </tbody>
                                                 </table>
                                               </div>

                                              <?php
                                            }
                                            else {
                                                /* No rows matched -- do something else */
                                                  print "No rows matched the query.";
                                              }
                                          }
                                      ?>

                                  </div>


                                  <?php

                                  $this_sec_qty=0;


/*
                                  foreach ($sec_sum as $sum_key => $sum_value) {

                                    // code...
//                                    print_r($sum_value);
                                    foreach ($sum_value as $row_key => $row_value) {
                                      // code...
                                      if($row_value['in_out']=='sale' || $row_value['in_out'] == 'purchase_return' || $row_value['in_out'] == 'activity_input')
                                      {
                                        $this_sec_qty=$this_sec_qty-$row_value['qty'];

                                      }else{
                                        $this_sec_qty=$this_sec_qty+$row_value['qty'];

                                      }
                                    }


                                  }
*/

                                  foreach ($units as $unit_key => $unit_value) {
                                    // code...
                                    echo "<h2>You should have ".$unit_key." ".$unit_value." in stock.</h2>";

                                  }

                                   ?>


                                    <div class="card-body hide">
                                        <div class="profiletimeline">
                                            <div class="sl-item">
                                                <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
                                                <div class="sl-right">
                                                    <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                        <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="../assets/images/big/img1.jpg" class="img-responsive radius"></div>
                                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="../assets/images/big/img2.jpg" class="img-responsive radius"></div>
                                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="../assets/images/big/img3.jpg" class="img-responsive radius"></div>
                                                            <div class="col-lg-3 col-md-6 m-b-20"><img src="../assets/images/big/img4.jpg" class="img-responsive radius"></div>
                                                        </div>
                                                        <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> </div>
                                                <div class="sl-right">
                                                    <div> <a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                        <div class="m-t-20 row">
                                                            <div class="col-md-3 col-xs-12"><img src="../assets/images/big/img1.jpg" alt="user" class="img-responsive radius"></div>
                                                            <div class="col-md-9 col-xs-12">
                                                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                                        </div>
                                                        <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> </div>
                                                <div class="sl-right">
                                                    <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                        <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                    </div>
                                                    <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> </div>
                                                <div class="sl-right">
                                                    <div><a href="#" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                        <blockquote class="m-t-10">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane hide" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">Johnathan Deo</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">(123) 456 7890</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">johnathan@admin.com</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">London</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                        <h4 class="font-medium m-t-30">Skill Set</h4>
                                        <hr>
                                        <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane hide" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <div class="row hide">
                    <div class="col-12">
                        <div class="card" style="background:#fff;">
                          <div class="card-body">
                            name, tax type, status, tags, Measuring Unit, variants, available stock, minimum stock limit, purchase cost, sale price, wholesale price, description, notes

                            <div class="row">
                              <div class="col-3">Name</div>
                            </div>
                          </div>
                        </div>
                        <div class="card" style="background:#fff;">
                            <div class="card-body">
                              <?php
                                $invoice_qry="select * from `stock_history` where `product_id`='$_GET[id]' and `owner_mobile`='$_SESSION[sess_bp_username]' limit 1";

                                if ($res = $db->query($invoice_qry)) {

                                    /* Check the number of rows that match the SELECT statement */
                                    if ($res->fetchColumn() > 0) {
                                        ?>
                                        <div class="table-responsive m-t-40">
                                          <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                              <thead>
                                                <tr>
                                                  <th>Type</th>
                                                  <th>Quantity</th>
                                                  <th>Unit Cost</th>
                                                  <th>Unit Price</th>
                                                  <th>Unit Profit</th>
                                                  <th>Total Cost</th>
                                                  <th>Total Price</th>
                                                  <th>Total Profit</th>
                                                </tr>
                                              </thead>
                                              <tfoot>
                                              <tr>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                                <th>Unit Cost</th>
                                                <th>Unit Price</th>
                                                <th>Unit Profit</th>
                                                <th>Total Cost</th>
                                                <th>Total Price</th>
                                                <th>Total Profit</th>
                                              </tr>
                                              </tfoot>
                                              <tbody>

                                              <?php
                                                foreach ($db->query($invoice_qry) as $row) {
                                                ?>
                                                  <tr>
                                                  <td><?=$row['in_out']?></td>
                                                  <td><?=$row['qty']?></td>
                                                  <td><?=$row['cost_per_unit']?></td>
                                                  <td><?=$row['unit_price']?></td>
                                                  <td><?=$row['profit_per_unit']?></td>
                                                  <td><?=$row['cost_per_unit']*$row['qty']?></td>
                                                  <td><?=$row['total_price']?></td>
                                                  <td><?=$row['total_profit']?></td>
                                                </tr>
                                                <?php
                                                }
                                               ?>
                                             </tbody>
                                           </table>
                                         </div>

                                        <?php
                                      }
                                      else {
                                          /* No rows matched -- do something else */
                                            print "No rows matched the query.";
                                        }
                                    }
                                ?>
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

        function PrintElem(elem) {
            Popup(jQuery(elem).html());
        }

        function Popup(data) {
            var mywindow = window.open('', 'my div', 'height=400,width=600');
            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write('<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" type="text/css" />');
            mywindow.document.write('<style type="text/css">.test { color:red; } </style></head><body>');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.print();
        }



        $("#printbtn").click(function(e){
          e.preventDefault();
          var data = $(".col-12").html();
          Popup(data);
          return false;
        });

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
