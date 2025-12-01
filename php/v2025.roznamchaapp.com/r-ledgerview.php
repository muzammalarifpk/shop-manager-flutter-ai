<?php
require_once("r-ledgerview.config.php");

    $image='img/imageholders-.png';

    if(substr($_GET['id'], 0, 2) == "c+")
    {
      $str = $_GET['id'];
      $number_encoded = urlencode($_GET['id']);
      $contact_where_title="`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='".substr($str,1)."' ";
      $account_title=gnrm($db,'contacts',$contact_where_title,'name');
      $account_id=gnrm($db,'contacts',$contact_where_title,'id');
      $contact=true;
      $meta['info']['title']=$account_title.' Ledger';



      $select_images_qry = "select * from `gallery` where `owner_mobile`='$_SESSION[sess_bp_username]' and `type`='contacts' and `ref_id`='".$account_id."' and `status`='Published' order by `id` asc limit 1";

      $images_array=array();
      foreach ($db->query($select_images_qry) as $row) {
        $images_array[]=array('img_id'=>$row['id'],'file_path' => $row['file_path'], 'file_name'=>$row['file_name'], 'uploaddate'=>date("d-M-Y",$row['timestamp']),'filetype'=> $row['file_type']);
      }

      if(count($images_array)>0)
      {
        for ($i=0; $i < count($images_array); $i++) {
          // code...
          if(file_exists($images_array[$i]['file_path']))
          {
            ?>
            <?php
            $image=$images_array[$i]['file_path'];
            break;

        }
    }

    }


    }else{
      $contact=false;
      $ledger_where_title="`owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$_GET[id]' ";
      $meta['info']['title']='Ledger Account of '.gnrm($db,'chartofaccount',$ledger_where_title,'account_head');
    }

    $total_debit=0;
    $total_credit=0;

  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<script>

function loadtdata(newname, newphone, newemail, newprivs, newstatus, newid)
{
  dtable.row.add(newname, newphone, newemail, newprivs, newstatus, newid ).draw(false);

}
function check_access_level_radio(clas)
{
  var val = $('.'+clas).val();

  if(val=='*'){
    $(".access_level #super_admin").removeClass('d-none');
    $(".access_level #co_admin").addClass('d-none');
  }else if (val=='coadmin') {
    $(".access_level #super_admin").addClass('d-none');
    $(".access_level #co_admin").removeClass('d-none');

  }
}

  $(document).ready(function(e){

    $('.access_level_select').click(function(){
      check_access_level_radio('access_level_select');
    });

    $('.access_level_select').on('change', function() {


      console.log("Changed one!");
      if ($(this).prop('checked', true)) {
        $('#id1,#id2,#id3').not(this).prop('checked', false);
      }
    });

    $(".editmodalbtn").click(function(e){
      e.preventDefault();
      var reqid=$(this).attr('rel');
      //  alert(reqid);
        $.get( "<?=$meta['module'][1]?>-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "<?=$meta['module'][1]?>-new.php", function( data ) {
          // the contents is now in the variable data
          //alert(data);
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });

    $('#editmodal').on('change',function(){
      if($(this).hasClass('show')){
        alert('shown');
      }else{
        alert('hidden');
      }

    });
  });

</script>
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
                <div id="modaldiv"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <h3>Customize Report</h3>
                                    <form action="" class="" method="get">
                                      <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                      <div class="form-body">
                                        <div class="row">

                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">From Date</label>
                                              <input type="date" name="from_date" class="form-control" id="from_date" value="<?=$_GET['from_date'] ?? ''?>">
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <label for="">To Date</label>
                                              <input type="date" name="to_date" class="form-control" id="to_date" value="<?=$_GET['to_date'] ?? ''?>">
                                            </div>
                                          </div>


                                        </div>
                                      </div>
                                      <div class="form-actions">
                                          <button type="submit" class="btn btn-info pull-right"> Submit</button>
                                      </div>
                                    </form>
                                  </div>

                              </div>
                              <div class="row">
                                <div class="col-sm-12"><a href="" id="print_ledger" class="btn btn-sm btn-success">Print ledger</a></div>

                              </div>
                              <div class="table-responsive m-t-40" id="printable_ledger">
                                <div class="table-responsive m-t-40" id="no-more-tables">

                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>ID</th>
                                      <th>Date</th>
                                      <th>Description</th>
                                      <th>Debit</th>
                                      <th>Credit</th>
                                      <th>Balance</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                  <?php
                                  if($contact==true)
                                  {
                                    $whatsapp_msg= "Hello *".$account_title."*!
Here is your ledger
                                    ";

                                  }

                                  $where = '';
                                  if(isset($_GET['to_date']) && $_GET['to_date']!='')
                                  {

                                    $_GET['to_date']=date("Y-m-d",strtotime("+1 days $_GET[to_date]"));
                                    $where.= " and `date` <= '$_GET[to_date]' ";
                                  }
                                  if(isset($_GET['from_date']) && $_GET['from_date']!='')
                                  {
                                    $where.= " and `date` >= '$_GET[from_date]' ";
                                  }


                                  $i=1;
                                    $select_qry="select * from `ledger` where `owner_mobile`='$_SESSION[sess_bp_username]' and `account_id`='$_GET[id]' and `amount`>'0' $where $all_status_where order by `id` asc";

                                    $all_rows=[];

                                    foreach ($db->query($select_qry) as $row) {
                                      $notes = '';
                                      $invoice_link = '';

                                      if($row['amount_type']=='debit')
                                      {
                                        $row_debit_amount=$row['amount'];
                                        $row_credit_amount='';
                                      }else{
                                        $row_credit_amount=$row['amount'];
                                        $row_debit_amount='';
                                      }

                                      $entry_link_parts = explode(':',$row['entry_link']);
                                      $payment_method = '';


                                      if(strpos($row['entry_link'], 'Purchase_id') !== false)
                                      {
                                          $invoice_link = 'h-purchase-invoice.php?id='.$entry_link_parts[1];
                                          $payment_method=gnr($db,'purchase_invoices','id',$entry_link_parts[1],'payment_method');
                                          $row['date']=gnr($db,'purchase_invoices','id',$entry_link_parts[1],'date');
                                          $payment_method=gnr($db,'chartofaccount','id',$payment_method,'account_head');

                                      }elseif(strpos($row['entry_link'], 'purchase_return_id') !== false)
                                      {
                                          $invoice_link = 'h-purchase-return-invoice.php?id='.$entry_link_parts[1];
                                          $row['date']=gnr($db,'purchase_invoices_returns','id',$entry_link_parts[1],'date');

                                      }elseif(strpos($row['entry_link'], 'paymentid') !== false)
                                      {
                                        if($entry_link_parts[1]>2915)
                                        {
                                          $invoice_link = 'h-payment-view.php?id='.$entry_link_parts[1];
                                        }else{
                                          $invoice_link = false;
                                        }
                                        $row['date']=gnr($db,'payments','id',$entry_link_parts[1],'date');
                                      }elseif(strpos($row['entry_link'], 'sale_id') !== false)
                                      {
                                        $invoice_link = 'h-sale-invoice.php?id='.$entry_link_parts[1];

                                        $payment_method=gnr($db,'sale_invoices','id',$entry_link_parts[1],'payment_method');
                                        $row['date']=gnr($db,'sale_invoices','id',$entry_link_parts[1],'date');
                                        $payment_method=gnr($db,'chartofaccount','id',$payment_method,'account_head');


                                      }elseif(strpos($row['entry_link'], 'sale_return_id') !== false)
                                      {
                                        $invoice_link = 'h-sale-return-invoice.php?id='.$entry_link_parts[1];
                                        $row['date']=gnr($db,'sale_invoices_returns','id',$entry_link_parts[1],'date');
                                      }else {
                                        $invoice_link = false;
                                      }
                                      if($row['amount_type']=='debit')
                                      {
                                        $row_sign = '+';
                                      }else {
                                        $row_sign='-';
                                      }

                                      $all_rows[]=['date تاریخ'=>date("d-M-Y D",strtotime($row['date'])),'description تفصیل'=>$row['description'].' '.$entry_link_parts[1].'<br />'.$payment_method,'debit رقم وصول'=>$row_debit_amount,'credit مال کی رقم '=>$row_credit_amount,'balance  بقایا رقم'=>$row['balance']];



                                      if($contact==true)
                                      {

                                        $whatsapp_msg.= "$row[date] $row[entry_link] $row_sign$row[amount]
";

                                      }

                                      $tr_class='';
                                      if($row['status']=='deleted' || $row['status']=='delete')
                                      {
                                        $tr_class='table-danger';
                                      }
                                   ?>
                                    <tr class="<?=$tr_class?>">
                                      <td  data-title="ID: "><?=$row['id']?></td>
                                      <td data-title="Date: "><?=$row['date']?></td>
                                      <td data-title="Description: "><?=$row['description'].'<br />'.$row['entry_link']?> <br /><?=$notes?>
                                        <?php if(($invoice_link)){ ?>
                                        <a href="<?=$invoice_link?>" class="btn btn-sm btn-success">View Invoice</a>
                                      <?php } ?>
                                      </td>
                                      <td data-title="Debit: "><span class="green-text"><?php if($row['amount_type']=='debit'){ echo $row['amount'];}?></span></td>
                                      <td data-title="Credit: "><span class="red-text"><?php if($row['amount_type']=='credit'){ echo $row['amount'];}?></span></td>
                                      <td data-title="Balance: "><span class="<?php if($row['balance_type']=='debit'){echo "green-text";}else{ echo "red-text";}?>"><?=$row['balance']?></span></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    if($row['amount_type']=='debit')
                                    {
                                      $total_debit+=$row['amount'];
                                    }else{
                                      $total_credit+=$row['amount'];
                                    }
                                    }
                                   ?>
                                </tbody>
                            </table>

                            <p>
                              <?php

                              $all_rows_json = json_encode($all_rows);
                              ?>
                                <script type="text/javascript">
                                  var all_rows_json = <?=$all_rows_json?>;
                                </script>
                              <?php
                              if($contact==true)
                              {
                                $whatsapp_msg.= "

                                Your current balance is: *".$row['balance']."*

                                *".trim($_SESSION['sess_bp_name'])."*
                                Address: ".$_SESSION['sess_bp_adr']."
                                Call: ".$_SESSION['sess_bp_username']."

                                Software by www.baseplan.pk
                                Thank you, Visit again.";


                                $whatsapp_link = 'https://api.whatsapp.com/send?phone='.str_replace('-','',str_replace('+','',(str_replace("c","",$_GET['id'])))).'&text='.urlencode($whatsapp_msg);

                               ?>
                                <a href="<?=$whatsapp_link?>" target="_blank" id="share_ledger" class="btn btn-sm btn-success">Share Ledger <?=str_replace("c","",$_GET['id'])?></a>
                              <?php
                              }
                              ?>
                              <a href="r-ledgerview.php?id=<?=urlencode($_GET['id'])?>&show_all_status=yes" class="btn btn-sm pull-right btn-info">Show Deleted</a>
                              <a href="r-ledgerview.php?id=<?=urlencode($_GET['id'])?>" class="btn btn-sm pull-right btn-inverse">Hide Deleted</a>
                            </p>

                            <?php

                            $sales_qry="select sum(grand_total) as `total_sale`, sum(amount_paid) as `amount_paid` from `sale_invoices` where `owner_mobile`='$_SESSION[sess_bp_username]' and `contact_number`='".str_replace('c','',$_GET['id'])."' ";

                            foreach ($db->query($sales_qry) as $sales_data) {
                              $total_sale=$sales_data['total_sale'];
                              $sales_received=$sales_data['amount_paid'];

                            }

                            $payments_qry="select sum(amount) as `amount_received` from `payments` where `owner_mobile`='$_SESSION[sess_bp_username]' and `contact_number`='".str_replace('c','',$_GET['id'])."' and `payment_type`='Received' ";
                            foreach ($db->query($payments_qry) as $payments_data) {
                              $amount_received=$payments_data['amount_received'];

                            }



                            ?>
                            <table  id="example22" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Total Sale:</th>
                                  <th>Total Received:</th>
                                  <th>Total Debit:</th>
                                  <th>Total Credit:</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td data-title="Total Sale: "><?=$total_sale?></td>
                                  <td data-title="Total Received: "><?=$sales_received+$amount_received?></td>
                                  <td data-title="Total Debit: "><?=$total_debit?></td>
                                  <td data-title="Total Credit: "><?=$total_credit?></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="roaw">
                              <div class="col-md-3 col-12">
                                <h2>Total Sale:<br> <?=$total_sale?></h2>
                              </div>
                              <div class="col-md-3 col-12">
                                <h2>Total Received:<br> <?=$sales_received+$amount_received?></h2>
                              </div>
                              <div class="col-md-3 col-12">
                                <h2>Total Debit:<br> <?=$total_debit?></h2>
                              </div>
                              <div class="col-md-3 col-12">
                                <h2>Total Credit:<br> <?=$total_credit?></h2>
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="row">
                            <?php

                            if($contact==true)
                            {

                              ?>
                              <div class="col m-t-20">
                                <a class="btn btn-sm pull-right btn-primary" id="add_sale" href="t-sale.php?c=<?=$number_encoded?>" >Add Sale</a>
                              </div>
                              <div class="col m-t-20">
                              <a class="btn btn-sm pull-right btn-primary" id="sale_return" href="t-sale-returns.php?c=<?=$number_encoded?>" >Add Sale Return</a>
                              </div>
                              <div class="col m-t-20">
                                <a class="btn btn-sm pull-right btn-primary" id="add_purchase" href="t-purchase.php?c=<?=$number_encoded?>" >Add Purchase</a>
                              </div>
                              <div class="col m-t-20">
                                <a class="btn btn-sm pull-right btn-primary" id="purchase_return" href="t-purchase-returns.php?c=<?=$number_encoded?>" >Add Purchase Return</a>
                              </div>
                              <div class="col m-t-20">
                                <a class="btn btn-sm pull-right btn-primary" id="receivepayment" href="t-payments.php?type=received&c=<?=$number_encoded?>" >Receive Payment</a>
                              </div>
                              <div class="col m-t-20">
                                <a class="btn btn-sm pull-right btn-primary" id="paidpayment" href="t-payments.php?c=<?=$number_encoded?>" >Payment Paid</a>
                              </div>
                              <?php
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
        if($contact==true)
        {
            $update_data = ['balance'=>$row['balance'],'balance_status'=>$row['balance_type'],'owner_mobile'=>$_SESSION['sess_bp_username'],'this_number'=>substr($str,1)];
            $update_balance_sql = "UPDATE `contacts` SET `balance`=:balance, `balance_status`=:balance_status WHERE `owner_mobile`=:owner_mobile and `number`=:this_number ";
            $db->prepare($update_balance_sql)->execute($update_data);
//            print_r($update_data);
        }
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script type="text/javascript">
        $(document).on('click','#print_ledger',function(e){
          e.preventDefault();
      //    alert('printing ledger.');
           $('.preloader').show();
           console.log(all_rows_json);
    //      alert('sending print.');
             printJS({printable: all_rows_json,  properties: ['date تاریخ', 'description تفصیل', 'debit رقم وصول','credit مال کی رقم ','balance  بقایا رقم'], type: 'json', header: '<div class="row"><div style="float:left; margin-right:30px; border:1px solid #000;"><img src="<?=$image?>" width="110" alt="" /></div><div  style="float:left;"><h1><?=$meta['info']['title']?></h1><h2><?=substr($str,1)?></h2></div></div>'});
           $('.preloader').hide();
        });

        </script>
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
