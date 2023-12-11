<?php
   require_once ('dbc.php');
   require_once ('functions.php');
   $upload_dir = "uploads/";
   $maxfilesizeMB = '50';
   $allowedFileType = array('jpg', 'jpeg', 'png', 'webp', 'svg');
   $msg=null;
   $productid=null;

   if(isset($_POST['createProduct'])) {
      CreateProduct($conn, $upload_dir, $maxfilesizeMB, $allowedFileType);
   }

   if(isset($_POST['updateProduct'])) {
      updateProduct($conn, $upload_dir, $maxfilesizeMB, $allowedFileType);
   }

   if(isset($_POST['deleteProduct'])) {
      deleteProduct($conn);
   }
   //header("location: admin_changes.php");
?>