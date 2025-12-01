<?php
$Path_Info_ = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');

// echo $Path_Info;
// echo '<h2>path info</h2>';
// print_r(explode('/', ltrim($Path_Info, '/')));
// echo '<h2>GET</h2>';
// print_r($_GET);
// echo '<h2>Post</h2>';
// print_r($_POST);
//
// die();

$path_info=explode('/', ltrim($Path_Info_, '/'));
$count_path_info = count($path_info);

// print_r($path_info);
// echo '<h2>Count info path: '.$count_path_info.'</h2>';
//
// die();
require_once('includes/dbc.php');

  if($count_path_info==1)
  {
    require_once('worldmap.php');
    die();
  }elseif($count_path_info==2)
  {
    require_once('country.php');
    die();
  }else{
    // echo '<h2>REQUEST_URI</h2>';
    // print_r($_SERVER['REQUEST_URI']);

    if (strpos($_SERVER['REQUEST_URI'], 'get_contents.php') !== false) {
        // echo $_SERVER['REQUEST_URI'];
        // echo '<br />';
        // $url_strings = explode('/get_contents.php?',$_SERVER['REQUEST_URI']);

        require_once('get_contents.php');

        // print_r($url_strings);
    }else{
      require_once('store.php');
    }
    die();
  }

?>
