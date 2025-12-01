<?php

require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("c-profile.config.php");

function update_profile($db,$data)
{
  $update_qry="update `users` set `industry_type`=:industry_type , `currency`=:currency , `business_type`=:business_type , `business_name`=:business_name , `address`=:address , `city`=:city , `region_name`=:state , `country_name`=:country_name , `email`=:email , `negative`=:negative ,  `last_updated`=:last_updated , `gst`=:gst , `tax`=:tax, `print_header`=:print_header,  `print_urdu_invoice`=:print_urdu_invoice,  `smsnotification`=:smsnotification,  `barcode`=:barcode, `variants`=:variants , `secondary_units`=:secondary_units , `lend_inventory`=:lend_inventory , `salesman_commission`=:salesman_commission , `agent_commision`=:agent_commision , `print_header_note`=:print_header_note , `print_footer_note`=:print_footer_note , `print_default_template`=:print_default_template , `vat`=:vat  where `number`=:number ";
  $stmt=$db->prepare($update_qry);
  $time=time();

  $stmt->bindParam('industry_type',$data['industry_type']);
  $stmt->bindParam('currency',$data['currency']);
  $stmt->bindParam('gst',$data['gst']);
  $stmt->bindParam('vat',$data['vat']);
  $stmt->bindParam('variants',$data['variants']);
  $stmt->bindParam('tax',$data['tax']);
  $stmt->bindParam('print_header',$data['print_header']);
  $stmt->bindParam('print_urdu_invoice',$data['print_urdu_invoice']);
  $stmt->bindParam('smsnotification',$data['smsnotification']);
  $stmt->bindParam('barcode',$data['barcode']);
  $stmt->bindParam('secondary_units',$data['secondary_units']);
  $stmt->bindParam('lend_inventory',$data['lend_inventory']);
  $stmt->bindParam('business_type',$data['business_type']);
  $stmt->bindParam('business_name',$data['business_name']);
  $stmt->bindParam('print_header_note',$data['print_header_note']);
  $stmt->bindParam('print_footer_note',$data['print_footer_note']);
  $stmt->bindParam('print_default_template',$data['print_default_template']);
  $stmt->bindParam('address',$data['address']);
  $stmt->bindParam('email',$data['email']);
  $stmt->bindParam('negative',$data['negative']);
  $stmt->bindParam('salesman_commission',$data['salesman_commission']);
  $stmt->bindParam('agent_commision',$data['agent_commision']);
  $stmt->bindParam('country_name',$data['country_name']);
  $stmt->bindParam('state',$data['state']);
  $stmt->bindParam('city',$data['city']);
  $stmt->bindParam('last_updated',$time);
  $stmt->bindParam('number',$_SESSION['sess_bp_username']);

  try{
    $stmt->execute();
    $response['code']=200;
    $response['msg']='Profile Updated Successfully.';

    $_SESSION['sess_bp_name'] = $data['business_name'];
    $_SESSION['sess_bp_adr'] = $data['address'];
    $_SESSION['sess_bp_currency'] = $data['currency'];

    $_SESSION['sess_bp_gst'] = $data['gst'];
    $_SESSION['sess_bp_vat'] = $data['vat'];
    $_SESSION['sess_bp_tax'] = $data['tax'];
    $_SESSION['sess_bp_barcode'] = $data['barcode'];
    $_SESSION['sess_bp_salesman_commission'] = $data['salesman_commission'];
    $_SESSION['sess_bp_agent_commision'] = $data['agent_commision'];
    $_SESSION['sess_bp_variants'] = $data['variants'];
    $_SESSION['sess_bp_secondary_units'] = $data['secondary_units'];
    $_SESSION['sess_bp_lend_inventory'] = $data['lend_inventory'];

    $_SESSION['sess_bp_print_header'] = $data['print_header'];
    $_SESSION['sess_bp_print_urdu_invoice'] = $data['print_urdu_invoice'];
    $_SESSION['sess_bp_print_header_note'] = $data['print_header_note'];
    $_SESSION['sess_bp_print_footer_note'] = $data['print_footer_note'];
    $_SESSION['sess_bp_print_default_template'] = $data['print_default_template'];


  }
  catch(Exception $e)
  {
    $response['code']=300;
    $response['msg']=$e->getMessage();
  }

  return json_encode($response);
}


$data['industry_type']=$_POST['industry_type'];
$data['currency']=$_POST['currency'];
$data['gst']=$_POST['gst'];
$data['tax']=$_POST['tax'];
$data['print_header']=$_POST['print_header'];
$data['print_urdu_invoice']=$_POST['print_urdu_invoice'];
$data['smsnotification']=$_POST['smsnotification'];
$data['barcode']=$_POST['barcode'];
$data['variants']=$_POST['variants'];
$data['secondary_units']=$_POST['secondary_units'];
$data['vat']=$_POST['vat'];
$data['business_type']=$_POST['business_type'];
$data['business_name']=$_POST['business_name'];
$data['address']=$_POST['address'];
$data['email']=$_POST['email'];

$data['secondary_units']=$_POST['secondary_units'];
$data['lend_inventory']=$_POST['lend_inventory'];
$data['negative']=$_POST['negative'];
$data['salesman_commission']=$_POST['salesman_commission'];
$data['agent_commision']=$_POST['agent_commision'];
$data['country_name']=$_POST['country'];
$data['state']=$_POST['state'];
$data['city']=$_POST['city'];


$data['print_header_note']=$_POST['print_header_note'];
$data['print_footer_note']=$_POST['print_footer_note'];
$data['print_default_template']=$_POST['print_default_template'];

//print_r($data);
echo update_profile($db,$data);
?>
