<?php
   function getproducts($conn)  {
      $products = array();
      $query = 'SELECT * FROM `product`';
      $stmt = $conn->query($query);
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $products[] = $row;
      }
      return $products; 
   }

   function getproductbyid($conn, $productid)  {
      $products = array();
      $query = 'SELECT * FROM `product` WHERE id = '.$productid.'';
      $stmt = $conn->query($query);
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $products[] = $row;
      }
      return $products;
   }

   function getCat($conn)  {
      $Categorys = array();
      $query = 'SELECT * FROM `product_categorie`';
      $stmt = $conn->query($query);
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $Categorys[] = $row;
      }
      return $Categorys; 
   }

   function totalItemsInCart(){
      $totalQuantity = 0;
      $_SESSION['totalOrderAmount'] = 0;
      foreach($_SESSION["cart"]as $product_id => $quantity ) {
         $totalQuantity += $quantity;
      }
      $_SESSION['totalOrderAmount'] = $totalQuantity;
      return $_SESSION['totalOrderAmount'];
   }

   function Cart_TotalPriceProduct($conn, $id){
      $totalpriceProduct = 0;
      $products = getproductbyid($conn, $id);
      foreach($products as $product){
         $totalpriceProduct = $product['price'] * $_SESSION['cart'][$id];
      }
      return $totalpriceProduct;
   }


   //get products [price] X amount
   function Cart_TotalPrice($conn){
      $totalpriceInCart = 0;
      $totalpriceProduct = 0;
      foreach ($_SESSION['cart'] as $product_id => $amount){
         $products = getproductbyid($conn, $product_id);
         foreach ($products as $product){
            $totalpriceProduct = $product["price"] * $amount;
            $totalpriceInCart += $totalpriceProduct;
         }
      }
      return $totalpriceInCart;
   }

   function setCart(){
      if (!isset($_SESSION['cart'])) {
         $_SESSION['cart'] = array();
      }
      return;
   }

   // product verwijderen = object verwijderen met javascript
   //en vervolgens product verwijderen met mysql query

   function CreateProduct($conn, $upload_dir, $maxfilesizeMB, $allowedFileType){
      $name = htmlspecialchars($_POST["name"]);
      $price = htmlspecialchars(str_replace(",",".",$_POST["price"]));
      $Category = htmlspecialchars($_POST["category"]);
      $Description = htmlspecialchars($_POST["description"]);
      $newNameRequired = true;
      $img_path = fileUpload($_FILES['file'], $upload_dir, $maxfilesizeMB, $allowedFileType, $newNameRequired);
      $query = "INSERT INTO `product` (`id`, `name`, `price`, `description`, `img_path`, `product_categorie_id`) VALUES (NULL, '$name', '$price', '$Description', '$img_path', '$Category')";
      $stmt = $conn->query($query);
   }

   function updateProduct($conn, $upload_dir, $maxfilesizeMB, $allowedFileType){
      $productid=$_GET['productid'];
      $name = htmlspecialchars($_POST["name"]);
      $price = htmlspecialchars(str_replace(",",".",$_POST["price"]));
      $Category = htmlspecialchars($_POST["category"]);
      $description = htmlspecialchars($_POST["description"]);
      $newNameRequired = false;
      $query = "SELECT img_path FROM `product`WHERE id IN ('$productid')";
      $stmt = $conn->query($query);
      $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
      $upload_dir = $fetch['img_path'];
      $img_path = fileUpload($_FILES['file'], $upload_dir, $maxfilesizeMB, $allowedFileType, $newNameRequired);
      $query = "UPDATE `product` SET `name` = '$name', `price` = '$price', `description` = '$description', `product_categorie_id` = '$Category' WHERE `product`.`id` = $productid";
      $stmt = $conn->query($query);
   }

   function deleteProduct($conn){
      $productid=$_GET['productid'];
      $product = getproductbyid($conn, $productid);
      unlink($product[0]["img_path"]);
      $query = "DELETE FROM `product` WHERE `product`.`id` = $productid";
      $stmt = $conn->query($query);
   }


   //functie voor het uploaden van een file
   function fileUpload($file, $upload_dir, $maxfilesize, $allowedFileType, $newNameRequired){
      print_r($_POST);
      $file = $_FILES['file'];
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $uniqueName = "";
      $fileExt = explode('.', $fileName);
      $fileActualExtension = strtolower(end($fileExt));
      if ( fileAllowed($fileActualExtension, $allowedFileType) == false){
         return;
      }
      if (fileError($file) == false)
         return;
      if (CorrectFilesize($file , $maxfilesize) == false)
         return;
      if ($newNameRequired == true){
         echo 'newname'. '<br>';
         $uniqueName = newFileName($fileActualExtension);
      }

      $fileDestination = $upload_dir.''.$uniqueName;
   
      echo $fileDestination . '<br>';
      upload($file, $fileDestination);
      return $fileDestination;
   }
   
   //kijkt of de file extension is toegelaten
   function fileAllowed($fileActualExtension, $allowedFileType){    
      if(!in_array($fileActualExtension, $allowedFileType)){
         return false;
         echo "this input only accepts images you tried to upload a file with the following extension: " .$fileActualExtension;
      }else
      return true;
   }
   
   //checkt voor file errors
   function fileError($Error){
      if (!$Error['error'] === 0){
         return false;
         echo 'error occured while ulpoading this file, try again!';
      }else
      return true;
   }
   
   //checkt of de file niet de groot is
   function CorrectFilesize($file, $maxfilesize){
      if ($file['size'] > ($maxfilesize * 1000000)){
         return false;
         echo 'File is too big, REALY a 1gb image?, impresive!';
      }else
      return true;
   }
   
   function newFileName($fileActualExtension){
      $fileNameNew = uniqid('', true).".".$fileActualExtension;
      return  $fileNameNew;
   }


   //doet de daadwerkelijke upload van de file
   function upload($file, $fileDestination){
         move_uploaded_file($file['tmp_name'], $fileDestination);
         echo 'file is uploaded';
   }


?>