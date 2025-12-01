<?php
require_once('dbc.php');

function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

  $limit = 10;
  if(isset($_GET['limit']))
  {
    $limit = $_GET['limit'];
  }
  $select_qry="SELECT *  FROM `users` where `country_code`= '+92' order by rand()  limit $limit";

  foreach ($db->query($select_qry) as $row) {
    $bnameParts = explode(' ',$row['business_name']);

    $bname = substr($bnameParts[0], 0, 11);
//    echo '<h2>'.$bname.'</h2>';
    $row_element=['number'=>$row['number'],'msg'=>'Salam '.$bname.',

     Dukan ka mukamal lain dain, naqad or udhar sale ka hisab, qabal-e-wasool raqoom ki tafseel or stock ka hysab rakhne k lia mukal software.

     Call: 0343-4123489'];
    $row_json = json_encode($row_element);

    if(isJson($row_json))
    {
      $response[]=$row_element;
    }else{
    //  echo $row['id'].' is not valid array. <br />';
    //  echo '<h2>'.$row['business_name'].' '.$bname.'</h2>';
    }
  }

//  print_r($response);
  header('Content-Type:Application/json');
  echo json_encode($response);
?>
