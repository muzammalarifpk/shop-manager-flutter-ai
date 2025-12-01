<?php

if( empty(session_id()))
{
  ini_set('session.gc_maxlifetime', 30*60); // expires in 30 minutes
session_start();


}
if(!isset($_SESSION['PHPSESSID']))
{
  $_SESSION['PHPSESSID']=session_id();
  // echo '<h1>PHPSESSID not found.</h1>';
}else{

  // echo '<h1>PHPSESSID found.</h1>';

}



  $time=time();

  $db_host='localhost';
  $db_user='usavxtbm_shopmanager_cloud_2025';
  $db_pass='W9r+atb^@*1m';
  $db_name='usavxtbm_shopmanager_cloud2';
  $db_name_off = 'usavxtbm_shopmanager_offline_2025';

  $list_cities=array('General','Niageria');
  $list_status = array('published','draft','suspended','delete');
  $list_privs = array('chartofaccount','products','contacts','posaccess','t-sale','t-purchase','t-expense','t-payments','t-sale-returns','t-purchase-returns','t-journal','r-journal','r-stock','r-sold-items','r-profitnloss','r-sales','h-sale','h-sale-return','h-purchase','h-purchase-return','h-expense','h-payments');
  $list_taxes=array('Exempted','Standard GST','Standard VAT','Zero Rated');
  $list_variants=array('Size','Color','Expiry Date');

  $list_industries=array('Animal Health','Appliance','Automobile','Chemicals','Clothes','Construction','Cosmetics','Electronics','Food','Garments','General Store','Grocery','Handicraft','Hardware','Health','Interior','IT','Jewellery','Medical','Mobiles','Paper','Petroleum','Shoes','Skin Care','Sports','Stationery','Textile','Tyres','Vegetable','Pesticides');
  $list_print_templates=array('A4','A5','Thermal_80mm');
  $list_measuring_units=array('Pcs','Bag','Box','Pack','Bundle','Suit','Bottle','Crates','Dozen','Gross','LBS','KG','Gram','Ltr','ml','Meter','cm','yard','inch','Feet','Cartoon','sq Meter','sq cm','sq yard','sq inch','sq Feet','Roll');
  $list_shipping_units=array('بورہ بڑا','بورہ چھوٹا','کاٹن بڑا','کاٹن چھوٹا','بنڈل','لفافے','شاپر');

  $list_country_code=array();
  for($i = 1; $i < 1000 ; $i++) {
    $list_country_code[]='+'.$i;
  }

  $list_relationship_types=array('Customer','Supplier','Employee','Agents','Other');
  $list_balance_types=array('Receiveable','Payable');
  $list_balance_drcr=array('Debit','Credit');
  $list_account_types_new=array('Cash','Bank');
  $list_account_types=array('Cash','Bank','Asset','Liability','Expense','Income','Equity','Cost of Sale');

  // Please don't change account_key values
  $list_default_accounts=array(
    array('account_key'=>'cashonhand','account_head'=>'Cash','account_type'=>'Cash'),
    array('account_key'=>'expense','account_head'=>'Expense','account_type'=>'Expense'),
    array('account_key'=>'rnp','account_head'=>'Accounts Receivable and Payable','account_type'=>'Assets'),
    array('account_key'=>'sales','account_head'=>'Sales','account_type'=>'Income'),
    array('account_key'=>'tax','account_head'=>'All Taxes','account_type'=>'Liabilities'),
    array('account_key'=>'purchases','account_head'=>'Purchases','account_type'=>'Cost of Sale'),
    array('account_key'=>'purchasediscount','account_head'=>'Purchase Discount','account_type'=>'Income'),
    array('account_key'=>'salediscount','account_head'=>'Sale Discount','account_type'=>'Expense'),
    array('account_key'=>'profitandlose','account_head'=>'Profit and Lose','account_type'=>'Income'),
    array('account_key'=>'capital','account_head'=>'Capital','account_type'=>'Equity'),
    array('account_key'=>'inventory','account_head'=>'Inventory','account_type'=>'Assets')
    );

  $list_expense_types=array('Rent','Travel','Salery','Utility Bills','Drinks/Food','Storage','Transport','Bad-Debt','Inventory-Damage');

  $list_date_range=array('Today','Yesterday','This Week','This Month','This Year','Last 7 Days','Last 14 Days','Last 28 Days','Last 30 Days','Last 90 Days','Last 180 Days','Last 365 Days','Custom');

  $signature=' | RoznamchaApp.com';
  if(isset($_SESSION['sess_bp_username']))
  {
    $signature=' | '.$_SESSION['sess_bp_name'];
  }
  $footer_note='Copyright 2017-'.date('Y').' Roznamcha App Pvt LTD';
  $modules=array('admin','setting');
  $free_trial_days = 9;
  $one_day_ms = 86400;
  $dev_mode=1;

  if($dev_mode==1)
  {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
  }

?>
