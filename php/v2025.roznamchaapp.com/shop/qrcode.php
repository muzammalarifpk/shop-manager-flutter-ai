<?php
    //Include the necessary library for Ubuntu
    require_once('includes/phpqrcode/qrlib.php');
    //Set the data for QR
    $code = $_GET['code'];
    $logopath = 'https://www.moqame.com/img/moqame-logo.png';
    //check the class is exist or not
    if(class_exists('QRcode'))
    {
        //Generate QR
        QRcode::png($code,$logopath);
    }else{
        //Print error message
        echo 'class is not loaded properly';
    }




?>
