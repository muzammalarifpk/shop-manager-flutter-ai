<?php
  require_once("r-ledgerview.config.php");

    if(substr($_GET['id'], 0, 2) == "c+")
    {
      $str = $_GET['id'];
      $contact_where_title="`owner_mobile`='$_SESSION[sess_bp_username]' and `number`='".substr($str,1)."' ";
      $account_title=gnrm($db,'contacts',$contact_where_title,'name');
      $contact=true;
      $meta['info']['title']='Ledger Account of '.$account_title;
    }else{
      $contact=false;
      $ledger_where_title="`owner_mobile`='$_SESSION[sess_bp_username]' and `id`='$_GET[id]' ";
      $meta['info']['title']='Ledger Account of '.gnrm($db,'chartofaccount',$ledger_where_title,'account_head');
    }

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
                              <div class="table-responsive m-t-40">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Items</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th>Date</th>
                                      <th>Description</th>
                                      <th>Items</th>
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

                                  $i=1;
                                    $select_qry="select * from `ledger` where `owner_mobile`='$_SESSION[sess_bp_username]' and `account_id`='$_GET[id]' and `amount`>'0' $all_status_where order by `id` asc";

                                    foreach ($db->query($select_qry) as $row) {
                                      $notes = '';
                                      $invoice_link = '';
                                      $details_table = '';

                                      $entry_link_parts = explode(':',$row['entry_link']);

                                      if(strpos($row['entry_link'], 'Purchase_id') !== false)
                                      {
                                          $details_table = 'purchase_invoices';
                                          $invoice_link = 'h-purchase-invoice.php?id='.$entry_link_parts[1];
                                      }elseif(strpos($row['entry_link'], 'purchase_return_id') !== false)
                                      {
                                        $details_table = 'purchase_invoices_returns';
                                          $invoice_link = 'h-purchase-return-invoice.php?id='.$entry_link_parts[1];
                                      }elseif(strpos($row['entry_link'], 'paymentid') !== false)
                                      {
                                        $details_table = '';
                                        if($entry_link_parts[1]>2915)
                                        {
                                          $invoice_link = 'h-payment-view.php?id='.$entry_link_parts[1];
                                        }else{
                                          $invoice_link = false;
                                        }
                                      }elseif(strpos($row['entry_link'], 'sale_id') !== false)
                                      {
                                        $details_table = 'sale_invoices';
                                        $invoice_link = 'h-sale-invoice.php?id='.$entry_link_parts[1];
                                      }elseif(strpos($row['entry_link'], 'sale_return_id') !== false)
                                      {
                                        $details_table = 'sale_invoices_returns';
                                        $invoice_link = 'h-sale-return-invoice.php?id='.$entry_link_parts[1];
                                      }else {
                                        $invoice_link = false;
                                      }
                                      if($row['amount_type']=='debit')
                                      {
                                        $row_sign = '+';
                                      }else {
                                        $row_sign='-';
                                      }

                                      if($contact==true)
                                      {

                                        $whatsapp_msg.= "$row[date] $row[entry_link] $row_sign$row[amount]
";

                                      }

                                   ?>
                                    <tr>
                                      <td><?=$row['date']?></td>
                                      <td><?=$row['description'].'<br />'.$row['entry_link']?> <br /><?=$notes?>
                                        <?php if(($invoice_link)){ ?>
                                        <a href="<?=$invoice_link?>" class="btn btn-sm btn-success">View Invoice</a>
                                      <?php } ?>
                                      </td>
                                      <td><?php
                                      if($details_table)
                                      {
                                        $this_cartitems = gnr($db,$details_table,'id',$entry_link_parts[1],'cartitems');
                                        $this_cartitems_array=json_decode($this_cartitems,true);

                                        if(is_array($this_cartitems_array))
                                        {
                                          foreach ($this_cartitems_array as $this_cartitem_key => $this_cartitem_value)
                                          {
                                            // code...
                                            echo '<p>'.$this_cartitem_value['row_qty'].' x '.gnr($db,'products','id',$this_cartitem_value['item_id'],'name').'</p>';
                                          }
                                        }
                                      }
                                      ?></td>
                                      <td><span class="green-text"><?php if($row['amount_type']=='debit'){ echo $row['amount'];}?></span></td>
                                      <td><span class="red-text"><?php if($row['amount_type']=='credit'){ echo $row['amount'];}?></span></td>
                                      <td><span class="<?php if($row['balance_type']=='debit'){echo "green-text";}else{ echo "red-text";}?>"><?=$row['balance']?></span></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                   ?>
                                </tbody>
                            </table>

                            <p>
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
                            <h2>Total Sale: <?=$total_sale?></h2>
                            <h2>Total Received: <?=$sales_received+$amount_received?></h2>

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
    <!-- Style switcher -->
    <!-- ============================================================== -->
</body>
</html>
