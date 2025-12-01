<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("va-jobs.config.php");

function update_job_costs($db,$job_id,$items_total_cost,$expense_total_cost,$total_input,$total_output)
{
  $update_qry="update `va-jobs` set `items_total_cost`=items_total_cost+:items_total_cost, `expense_total_cost`=expense_total_cost+:expense_total_cost, `total_input`=total_input+:total_input, `total_output`=total_output+:total_output where `id`=:job_id and `owner_mobile`=:owner_mobile";
  $stock=$db->prepare($update_qry);

  $stock->bindParam('items_total_cost',$items_total_cost);
  $stock->bindParam('expense_total_cost',$expense_total_cost);
  $stock->bindParam('total_input',$total_input);
  $stock->bindParam('total_output',$total_output);
  $stock->bindParam('job_id',$job_id);
  $stock->bindParam('owner_mobile',$_SESSION['sess_bp_username']);

  $stock->execute();

  if($stock)
  {
    return true;
  }else{
    return false;
  }

}


$insert_qry = "insert into `va-jobs_activites` set `owner_mobile` = :owner_mobile, `timestamp`=:timestamp,  `added_by`=:added_by,  `status`=:status,  `last_updated`=:last_updated, `job_id`=:job_id,  `activity_name`=:activity_name,  `notes`=:notes,  `date`=:date,  `total_expense`=:total_expense,   `total_input`=:total_input,   `total_item_output`=:total_item_output,   `input_cartitems`=:input_cartitems,   `expense_cartitems`=:expense_cartitems,   `output_cartitems`=:output_cartitems,   `total_item_input`=:total_item_input";

$stmt = $db->prepare($insert_qry);

$stmt->bindParam('owner_mobile', $_SESSION['sess_bp_username']);
$stmt->bindParam('timestamp', $time);
$stmt->bindParam('added_by', $_SESSION['sess_bp_emp']);
$stmt->bindParam('status', $_POST['status']);
$stmt->bindParam('last_updated', $time);

$stmt->bindParam('job_id', $_POST['job_id']);
$stmt->bindParam('activity_name', $_POST['activity_name']);
$stmt->bindParam('notes', $_POST['notes']);
$stmt->bindParam('date', $_POST['date']);
$stmt->bindParam('total_expense', $_POST['total_expense']);
$stmt->bindParam('total_input', $_POST['total_input']);
$stmt->bindParam('total_item_output', $_POST['total_item_output']);
$stmt->bindParam('input_cartitems', $_POST['input_cartitems']);
$stmt->bindParam('expense_cartitems', $_POST['expense_cartitems']);
$stmt->bindParam('output_cartitems', $_POST['output_cartitems']);
$stmt->bindParam('total_item_input', $_POST['total_item_input']);

$response['code'] = 100;
$response['msg'] = 'There was some issue processing request. Please contact technical support.';

try
{
  $stmt->execute();
  $job_id=$db->lastInsertId();
  $response['code'] = 200;
  $response['msg'] = $job_id;

  update_job_costs($db,$_POST['job_id'],$_POST['total_item_input'],$_POST['total_expense'],$_POST['total_input'],$_POST['total_item_output']);


  $expense_cartitems=json_decode($_POST['expense_cartitems'],true);
  $expense_account=$_SESSION['sess_account_keys']['expense'];
  if(is_array($expense_cartitems))
  {
    foreach ($expense_cartitems as $key => $value) {
      // code...
      $this_expense_amount=$value['this_expense_amount'];
      $this_expense_type=$value['this_expense_type'];
      $expense_payment_account=$value['expense_payment_account'];
      $this_expense_des=$value['this_expense_des'];

      if(substr($expense_payment_account, 0, 1) === '+')
      {
        $payment_account = 'c'.$expense_payment_account;
      }else{
        $payment_account = $expense_payment_account;
      }
      $credit_array   =array(array('account'=>$payment_account,'amount'=>$this_expense_amount));
      $debit_array    =array(array('account'=>$expense_account,'amount'=>$this_expense_amount));
      $entry_type     ="manafacturing";
      $entry_link     ='activity_id:'.$job_id;


      journal_entry($db,$credit_array,$debit_array,$entry_type,$entry_link);
    }
  }



  // input stock handling
  $input_cartitems=json_decode($_POST['input_cartitems'],true);

  if(is_array($input_cartitems))
  {
    foreach($input_cartitems as $key => $val)
    {
      $item_id=$val['item_id'];
      $item_qty=$val['item_qty'];
      $item_rate=$val['item_rate'];
      $item_total=$val['item_total'];
      $variants_json=json_decode(str_replace('&#34;','"',$val['variants_json']),true);

      $variants_array='';
      $variants_array=array();

      if(is_array($variants_json))
      {
          // this item has variants
          foreach ($variants_json as $key => $value) {
            $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['qty'],'qty_before'=>0);
            // code...

          }

      }

      if(count($variants_array)>0)
      {
        foreach ($variants_array as $key => $value) {
          // code...
          update_stock_variant_history($db,'activity_id:'.$job_id,$_REQUEST['date'],'activity_input',$value);
        }
      }

      $input_products_array[]=array('product_id'=>$item_id,'unit_price'=>$item_rate,'qty'=>$item_qty,'qty_before'=>0,'cost_per_unit'=>$item_rate,'unit_measure'=>'');

    }
    update_stock_history($db,$job_id,$_REQUEST['date'],'activity_input',$input_products_array);

  }

// output stock handling

  $output_cartitems=json_decode($_POST['output_cartitems'],true);
  if(is_array($output_cartitems))
  {
    foreach($output_cartitems as $key => $val)
    {
      $item_id=$val['item_id'];
      $item_qty=$val['item_qty'];
      $item_rate=$val['item_rate'];
      $item_total=$val['item_total'];
      $variants_json=json_decode(str_replace('&#34;','"',$val['variants_json']),true);

      $variants_array='';
      $variants_array=array();

      if(is_array($variants_json))
      {
          // this item has variants
          foreach ($variants_items as $key => $value) {
            $variants_array[]=array('variant_id'=>$value['variant_id'],'qty'=>$value['qty'],'qty_before'=>0);
            // code...

          }

      }

      if(count($variants_array)>0)
      {
        foreach ($variants_array as $key => $value) {
          // code...
          update_stock_variant_history($db,'activity_id:'.$job_id,$_REQUEST['date'],'activity_output',$value);
        }
      }

      $output_products_array[]=array('product_id'=>$item_id,'unit_price'=>$item_rate,'qty'=>$item_qty,'qty_before'=>0,'cost_per_unit'=>$item_rate,'unit_measure'=>'');

    }
    update_stock_history($db,$job_id,$_REQUEST['date'],'activity_output',$output_products_array);
  }


} catch (PDOException $e) {
  $err = "<ul><li>Error : ".$e->getMessage()."</li></ul>";
  $response['code'] = 300;
  $response['msg'] = $err;
}

print_r(json_encode($response));
?>
