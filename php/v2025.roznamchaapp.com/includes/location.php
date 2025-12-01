<?php

if(!isset($_SESSION['location']))
{
// set IP address and API access key
$ip = $_SERVER['REMOTE_ADDR'];
$ip_keys=['2952774e664b62089373947213576930','ad0a8cbefc01733f3e7e247497c8b4ed','f1afd13059a8e674dd30d9c0b0e998ac','fc40e27f5ccd45cd1bf8629dc9951638','bf057a29c2cd0c67f2daf4f017661a40','59661062707ea1f67dfdfcc49a3259c9','4c6836d96d768996d8ef7e48e39a03b8','59da40ef75c7b8dc34fb3f452a91baa0','c4b06c6f6c077135109c4f8a4d0ee783','dc6915a040b1f2fe175f110cf02e6ae8'];
$get_random_index=rand(0,9);
$ip_access_key = $ip_keys[$get_random_index];

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$ip_access_key.'&fields=continent_name,country_name,country_code,region_name,city,location,currency');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$ip_api_result = json_decode($json, true);

//print_r($ip_api_result);

// Output the "capital" object inside "location"
//  echo $api_result['location']['capital'];
  if(isset($ip_api_result['location']))
  {
    $ip_calling_code = $ip_api_result['location']['calling_code'];
    if($ip_calling_code=='92'){ $_SESSION['location']='Pakistan';$_SESSION['location_code']=$ip_calling_code;}
  }
}else{
  $ip_calling_code=$_SESSION['location_code'];
}?>
