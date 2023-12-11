<?php
$totalitems = totalItemsInCart();

?>
<header>
<nav class="navbar bg-base-200">
  <div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-circle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
      </label>
      <ul tabindex="0" class="menu menu-lg dropdown-content z-[5] mt-3 p-2 shadow bg-base-100 rounded-box w-52 border-primary border-2">
        <li><a href="index.php?msg=">Homepage</a></li>
        <li><a href="producten.php?msg=producten">Producten</a></li>      
        <li><a href="winkelwagen.php">Winkelwagen</a></li>
        <li><a href="admin_changes.php?msg=producten">producten-admin</a></li> <!--als de gebruiker de beheerder is komt dit tevoorschijn doormiddel van een session variable-->
      </ul>
    </div>
  </div>
  <div class="navbar-center">
    <a class="btn btn-ghost normal-case text-xl"><img class="w-9" src="img/candyshop-logo.png" alt="Logo-THE CANDY SHOP">THE CANDY SHOP</a>
  </div>
  <div class="navbar-end">
  <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <span class="badge badge-sm indicator-item"><?php echo totalItemsInCart(); ?></span>
        </div>
      </label>
      <div tabindex="0" class="mt-3 card card-compact w-fit bg-gray-300 dropdown-content z-[5]  shadow-2xl border-primary border-2">
        <div class="card-body">
        
          <table class="table table-xs w-fit">
                        <thead>
                          <tr><h1 class=" text-center">Bestel overzicht</h1> </tr>
                        </thead>
                        <tbody>
          <?php
          foreach ($_SESSION['cart'] as $product_id => $amount){
            $products = getproductbyid($conn, $product_id);
            foreach ($products as $product){
            echo'   <tr class="" >
               <td class="text-xs flex flex-row w-24"><img src="'.$product["img_path"].'" alt="'.$product["name"].'" class="w-24   "/></td>
               <td class="text-xs">'.$product["name"].'<br>€ '.Cart_TotalPriceProduct($conn, $product["id"]).'</td>
               <td>'.$amount.'</td>
               <td>
               <form action="updateCart.php?productid='.$product["id"].'" method="POST">              
                  <button type="submit" name="delFromCart" class="btn btn-primary btn-sm rounded-lg text-xs ">
                     
                     <i class="fa-solid fa-trash-can"></i>
                  </button>
               </form>   
               </td>
               </tr>';
            }
          }
          
          ?>
          <tr>
                              <td class="text-md font-bold"><?php echo 'aantal: ('. totalItemsInCart() . ')';?></td>
                              <td class="text-md"><?php echo '€' .Cart_TotalPrice($conn); ?></td>
                           </tr>
                        </tbody>
                     </table>
          <div class="card-actions">
            <a href="winkelwagen.php" class="btn btn-primary btn-block btn-sm">View cart</a>
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-ghost btn-circle">
      <div class="indicator">
          <i class="fa-solid fa-user"></i>
        <span class="badge badge-xs badge-primary indicator-item"></span>
      </div>
    </button>
  </div>
</nav>
</header>

