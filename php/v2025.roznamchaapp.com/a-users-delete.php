<?php

require_once('includes/dbc.php');

  $number='+'.trim($_GET['reqid']);
  $del_number = 't-'.$number;

      $sql_user = "update `users` set `status`=:newstatus, `last_updated`=:time, `number`=:del_number WHERE `number`=:reqid ";
      $sql_chartofaccount=                    "update `chartofaccount`            set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_contacts=                          "update `contacts`                  set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_expense=                           "update `expense`                   set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_graph=                             "update `graph`                     set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_inbox=                             "update `inbox`                     set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_journal=                           "update `journal`                   set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_journal_entries=                   "update `journal_entries`           set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_ledger=                            "update `ledger`                    set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_payments=                          "update `payments`                  set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_pos_access=                        "update `pos_access`                set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_products=                          "update `products`                  set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_product_variants=                  "update `product_variants`          set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_purchase_invoices=                 "update `purchase_invoices`         set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_purchase_invoices_returns=         "update `purchase_invoices_returns` set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_sale_invoices=                     "update `sale_invoices`             set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_sale_invoices_returns=             "update `sale_invoices_returns`     set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_stock_history=                     "update `stock_history`             set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_stock_variant_history=             "update `stock_variant_history`     set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";
      $sql_user_access=                       "update `user_access`               set `owner_mobile`=:del_number where `owner_mobile`=:owner_mobile ";


      $sth_user = $db->prepare($sql_user, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_chartofaccount =                     $db->prepare($sql_chartofaccount,             array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_contacts =                           $db->prepare($sql_contacts,                   array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_expense =                            $db->prepare($sql_expense,                    array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_graph =                              $db->prepare($sql_graph,                      array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_inbox =                              $db->prepare($sql_inbox,                      array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_journal =                            $db->prepare($sql_journal,                    array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_journal_entries =                    $db->prepare($sql_journal_entries,            array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_ledger =                             $db->prepare($sql_ledger,                     array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_payments =                           $db->prepare($sql_payments,                   array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_pos_access =                         $db->prepare($sql_pos_access,                 array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_products =                           $db->prepare($sql_products,                   array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_product_variants =                   $db->prepare($sql_product_variants,           array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_purchase_invoices =                  $db->prepare($sql_purchase_invoices,          array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_purchase_invoices_returns =          $db->prepare($sql_purchase_invoices_returns,  array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_sale_invoices =                      $db->prepare($sql_sale_invoices,              array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_sale_invoices_returns =              $db->prepare($sql_sale_invoices_returns,      array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_stock_history =                      $db->prepare($sql_stock_history,              array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_stock_variant_history =              $db->prepare($sql_stock_variant_history,      array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $sth_user_access =                        $db->prepare($sql_user_access,                array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  try{

    $sth_user->execute(array(':newstatus' => 'trashed', ':time' => time(),  ':del_number' => 't-'.$number, 'reqid'=>$number));

    $sth_chartofaccount->           execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_contacts->                 execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_expense->                  execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_graph->                    execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_inbox->                    execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_journal->                  execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_journal_entries->          execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_ledger->                   execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_payments->                 execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_pos_access->               execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_products->                 execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_product_variants->         execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_purchase_invoices->        execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_purchase_invoices_returns->execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_sale_invoices->            execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_sale_invoices_returns->    execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_stock_history->            execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_stock_variant_history->    execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));
    $sth_user_access->              execute(array(':del_number' => 't-'.$number, 'owner_mobile'=>$number));

    echo 'success';
  }catch(PDOException $e)
  {
    echo 'error';
    echo $e->getMessage();
  }

?>
