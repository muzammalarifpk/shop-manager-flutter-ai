<?php

require_once("includes/libs/form.edit.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-contacts.config.php");


              $select_qry="SELECT * FROM stock_history sh right JOIN sale_invoices si  on sh.invoice_id=si.id where  sh.owner_mobile = '$_SESSION[sess_bp_username]' and sh.product_id='$_GET[item_id]' and sh.in_out='sale'  ";
//              echo $select_qry;
              $stmt = $db->prepare($select_qry);
              $stmt->execute();
              $count = 0;

              $rows = $stmt->fetchAll();
              //print_r($rows);
              $h_rows = Array();

                foreach($rows as $row)
                {
                  $this_num = str_replace("+",'',$row['contact_number']);

                  if($this_num==trim($_GET['c_num']))
                  {
                    $h_rows[]=$row;
                    $count++;
                  }else{
//                    echo '<h2>'.$this_num.' '.htmlspecialchars($_GET['c_num']).'</h2><hr />';
                  }
                }

                if($count>0)
                {
                  echo '<table class="display nowrap table table-hover table-striped table-bordered">
                    <tr>
                      <th>Customer</th><th>Date</th><th>Qty</th><th>Unit Price</th><th>Unit</th>
                    </tr>';
                  foreach($h_rows as $h_row)
                  {
                    echo '<tr><td>'.$h_row['contact_number'].'</td><th>'.$h_row['date'].'</th><th>'.$h_row['qty'].'</th><th>'.$h_row['unit_price'].'</th><th>'.$h_row['measuring_unit'].'</th></tr>';
                  }
                  echo '</table>';
                }else{
                  echo '<h2>No Record Found.</h2>';
                }


             ?>
