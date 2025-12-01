<?php
require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");
require_once("su-products.config.php");
require_once('su-products-func.php');

// file name
$filename=$_FILES["file"]["name"];

$parts_filename=explode('.',$filename);
$ext=$parts_filename[1];


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

   $uploadOk = 1;
   if($ext != "csv" ) {
     $uploadOk = 0;
   }

   if ($uploadOk != 0) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.'importfile.csv')) {

        // Checking file exists or not
        $target_file = $target_dir . 'importfile.csv';
        $fileexists = 0;
        if (file_exists($target_file)) {
           $fileexists = 1;
        }
        if ($fileexists == 1 ) {

           // Reading file
           $file = fopen($target_file,"r");
           $i = 0;

           $importData_arr = array();

           while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
             $num = count($data);

             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $data[$c];
             }
             $i++;
           }
           fclose($file);

           $skip = 1;

           // insert import data
           foreach($importData_arr as $data){

              if($skip != 0){
                $product_row['name']=$data[0];
                $product_row['category']=$data[1];
                $product_row['measuring_unit']=$data[2];
                $product_row['available_stock']=$data[3];
                $product_row['min_stock_limit']=$data[4];
                $product_row['purchase_cost']=$data[5];
                $product_row['sale_price']=$data[6];
                $product_row['wholesale_price']=$data[7];
                $product_row['barcode']=$data[8];
                $product_row['tags']='bulk_import';
                $product_row['max_stock_limit']='';
                $product_row['product_description']='';
                $product_row['title']='';
                $product_row['youtube_link']='';
                $product_row['platforms'][]='';
                $product_row['platforms'][]='moqame.com';
                $product_row['notes']='';
                $product_row['status']='published';

//                print_r($product_row);
                process_insert_form($db,$product_row,$all_fields,$meta['module'][0]);
              }
              $skip ++;
           }
           $newtargetfile = $target_file;
           if (file_exists($newtargetfile)) {
              unlink($newtargetfile);
           }
         }

      }
   }
?>
