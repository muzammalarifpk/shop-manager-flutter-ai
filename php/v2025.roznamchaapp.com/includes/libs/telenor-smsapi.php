<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Urls for authentication and sending quich message
$planetbeyondApiUrl="https://telenorcsms.com.pk:27677/corporate_sms2/api/auth.jsp?msisdn=#username#&password=#password#";
$planetbeyondApiSendSmsUrl="https://telenorcsms.com.pk:27677/corporate_sms2/api/sendsms.jsp?session_id=#session_id#&to=#to_number_csv#&text=#message_text#";
// Please provide correct username and password here of your account
/*
 Returns sessionId required to send quick message
*/
function getSessionId()
{
global $userName,$password,$planetbeyondApiUrl;
$url=str_replace("#username#",$userName,$planetbeyondApiUrl);
$url=str_replace("#password#",$password,$url);

$response = sendApiCall ($url);
 if($response && substr($response->response,0,5)!=="Error")
 {
return $response->data;
}
return -1;
}
/*
 Sends Quick message/
*/

function sendSmsMessage($messageText,$toNumbersCsv,$mask)
{
global $planetbeyondApiSendSmsUrl;
global $fromNumber;
$sessionKey = getSessionId();
$url=str_replace("#message_text#",urlencode($messageText),$planetbeyondApiSendSmsUrl);
$url=str_replace("#to_number_csv#",$toNumbersCsv,$url);
$url=str_replace("#from_number#",$fromNumber,$url);
$urlWithSessionKey=str_replace("#session_id#",$sessionKey,$url);
if($mask!=null)
{
$urlWithSessionKey = $urlWithSessionKey . "&mask=" . $mask;
}
$xml=sendApiCall($urlWithSessionKey);
return $xml->data;
}
/*
 Sends Http request to api
*/
function sendApiCall($url)
{


  $response = file_get_contents($url);
  $xml=simplexml_load_string($response) or die("Error: Cannot create object");
 if($xml)
 {
return $xml;
}
return "";
}

function sendtoPK($country_code,$mobile_number,$messageText,$mask,$db)
{

  if($country_code=='+92')
  {

    $smsnotification =  gnr($db,'users','number',$_SESSION['sess_bp_username'],'smsnotification');
    if($smsnotification=='on')
    {
      if($mobile_number[0] == '0')
      {
        $mobile_number = substr($mobile_number, 1);
      }

      $toNumbersCsv = '92'.$mobile_number;
      $toNumbersCsv = str_replace("+",'',$toNumbersCsv);
      $toNumbersCsv = str_replace("-",'',$toNumbersCsv);

      $sent=sendSmsMessage($messageText,$toNumbersCsv,$mask);
    }
  }


}

$userName="923484278377";
$password="Pc080400421Pc0804004212021";
$fromNumber = '923484278377';
$mask = urlencode('BASEPLAN PK');


/*
$messageText = 'https://baseplan.pk.';
$toNumbersCsv = '923229324678';

$sent=sendSmsMessage($messageText,$toNumbersCsv,$mask);

print_r($sent);
*/
?>
