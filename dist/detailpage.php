<?Php
    $pageName = "Product-Details";
    require_once ('head.php');
    require_once ('header.php');

$product_id=$_GET['productid'];

$product_details = getproductbyid($conn, $product_id);
foreach ($product_details as $productDetail) {
echo  '<form action="updateCart.php?productid='.$productDetail["id"].'" method="POST" class="hero-content flex-col md:flex-row md:p-10" id="'.$productDetail["id"].'">
    <img src="'.$productDetail["img_path"].'" class="max-w-sm rounded-lg shadow-2xl" />
    <div>
      <h1 class="text-5xl font-bold">'.$productDetail["name"].'</h1>
      <h1 class="text-3xl font-bold">€ '.$productDetail["price"].'</h1>
      <p class="py-6">'.$productDetail["description"].'</p>
      <div class="flex">
        <button type="submit" name="addToCart" class="btn btn-primary rounded-r-none" id="buy">
          In winkelwagen
          <i class="fa-solid fa-cart-shopping"></i>
        </button>
        <input value="1" type="number" name="orderamount" min="1" class="w-14 bg-primary p-3 rounded-r-3xl"></input>
      </div>
    </div>
  </form>';
}


require_once ('footer.php');
?>
