<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("t-journal.config.php");


$old_number = $_POST['old_number'];
$new_number = $_POST['new_number'];
$new_country_code =$_POST['country_code'];
$new_mobile= $_POST['mobile'];
$owner_mobile= $_SESSION['sess_bp_username'];
$coa_number = "c".$new_number;
$old_coa_number = "c".$old_number;


 $update_contacts = "update `contacts` set `number`='$new_number', `mobile`='$new_mobile', `country_code`='$new_country_code' where `owner_mobile`='$owner_mobile' and `number`='$old_number' ";

 $update_payments = "update `payments` set `contact_number`='$new_number' where `owner_mobile`='$owner_mobile' and `contact_number`='$old_number' ";

 $update_purchase_invoices = "update `purchase_invoices` set `contact_number`='$new_number' where `owner_mobile`='$owner_mobile' and `contact_number`='$old_number' ";

 $update_purchase_invoices_returns = "update `purchase_invoices_returns` set `contact_number`='$new_number' where `owner_mobile`='$owner_mobile' and `contact_number`='$old_number' ";

 $update_sale_invoices = "update `sale_invoices` set `contact_number`='$new_number' where `owner_mobile`='$owner_mobile' and `contact_number`='$old_number' ";

 $update_sale_invoices_return = "update `sale_invoices_returns` set `contact_number`='$new_number' where `owner_mobile`='$owner_mobile' and `contact_number`='$old_number' ";

 $update_ledger = "update `ledger` set `account_id`='$coa_number' where `owner_mobile`='$owner_mobile' and `account_id`='$old_coa_number' ";

 $update_journal_credit = "update `journal` set `credit_json`= REPLACE(credit_json, '$old_coa_number','$coa_number') where `owner_mobile`='$owner_mobile' and `credit_json` like '%$old_coa_number%' ";

 $update_journal_debit = "update `journal` set `debit_json`= REPLACE(credit_json, '$old_coa_number','$coa_number') where `owner_mobile`='$owner_mobile' and `debit_json` like '%$old_coa_number%' ";

 $update_journal_entries_debit = "update `journal_entries` set `debit`='$coa_number' where `owner_mobile`='$owner_mobile' and `debit`='$old_coa_number' ";

 $update_journal_entries_credit = "update `journal_entries` set `credit`='$coa_number' where `owner_mobile`='$owner_mobile' and `credit`='$old_coa_number' ";




try{
  $contacts_stmt=$db->prepare($update_contacts);
  $contacts_stmt->execute();

  $payments_stmt=$db->prepare($update_payments);
  $payments_stmt->execute();

  $purchase_invoices_stmt=$db->prepare($update_purchase_invoices);
  $purchase_invoices_stmt->execute();

  $update_purchase_invoices_returns_stmt=$db->prepare($update_purchase_invoices_returns);
  $update_purchase_invoices_returns_stmt->execute();

  $update_sale_invoices_stmt=$db->prepare($update_sale_invoices);
  $update_sale_invoices_stmt->execute();

  $update_sale_invoices_return_stmt=$db->prepare($update_sale_invoices_return);
  $update_sale_invoices_return_stmt->execute();

  $update_ledger_stmt=$db->prepare($update_ledger);
  $update_ledger_stmt->execute();

  $update_journal_credit_stmt=$db->prepare($update_journal_credit);
  $update_journal_credit_stmt->execute();

  $update_journal_debit_stmt=$db->prepare($update_journal_debit);
  $update_journal_debit_stmt->execute();

  $update_journal_entries_debit_stmt=$db->prepare($update_journal_entries_debit);
  $update_journal_entries_debit_stmt->execute();

  $update_journal_entries_credit_stmt=$db->prepare($update_journal_entries_credit);
  $update_journal_entries_credit_stmt->execute();

echo   'success';
}catch(PDOException $e){
  $err = "<ul><li>Error : some technical issue occur.</li></ul>";
}


?>
