<?php 
   $pageName = "Winkelwagen";
   require_once ('head.php');
   require_once ('header.php');
   $totalpriceProducts = 0;
      ?>
      <main class="container md:mx-auto px-0 sm:px-0 md:px-5 mt-5">

         <div class="flex flex-col md:flex-row w"><!-- container left -->
            <div class="w-full grid md:grid-cols-1 lg:grid-cols-2 md: gap-1 p-3">
               <div>
                  <label class="label">
                  <span class="label-text">Voornaam</span>
                  </label>
                  <input type="text" name="voornaam" placeholder="Voornaam" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">Achternaam</span>
                  </label>
                  <input type="text" name="achternaam" placeholder="Achternaam" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">E-mail</span>
                  </label>
                  <input type="text" name="email" placeholder="E-mail" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">Postcode</span>
                  </label>
                  <input type="text" name="postcode" placeholder="Postcode" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">Addres</span>
                  </label>
                  <input type="text" name="addres" placeholder="Addres" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">Telefoon</span>
                  </label>
                  <input type="text" name="telefoon" placeholder="Telefoon-Nummer" class="input w-full bg-gray-200" />
               </div>
               <div>
                  <label class="label">
                  <span class="label-text">Geboortedatum</span>
                  </label>
                  <input type="date" name="telefoon" class="input w-full bg-gray-200" />
               </div>

            </div>

            <div class="w-full flex justify-center md:justify-end" ><!-- container right -->
               <div class="w-fit h-fit bg-gray-200 rounded-2xl shadow-2xl mt-4">
                     <table class="table table-xs ">
                        <!-- head -->
                        <thead>
                           <tr><h1 class=" text-center">Bestel overzicht</h1> </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <?php
                           foreach ($_SESSION['cart'] as $product_id => $amount){
                              $products = getproductbyid($conn, $product_id);
                              foreach ($products as $product){
                              echo'   <tr class="text-2xl" >
                                 <td class="text-lg flex flex-row w-24"><img src="'.$product["img_path"].'" alt="'.$product["name"].'" class="w-24 "/></td>
                                 <td class="text-lg">'.$product["name"].'<br>€ '.Cart_TotalPriceProduct($conn, $product["id"]).'</td>
                                 <td>
                                    <form action="updateCart.php?productid='.$product["id"].'" method="POST">
                                       <input value="'.$amount.'" type="number" name="productAmount" min="1" class="input input-sm w-20"></input>
                                    </form>
                                 </td>
                                 <td>
                                 <form action="updateCart.php?productid='.$product["id"].'" method="POST">              
                                    <button type="submit" name="delFromCart" class="btn btn-primary btn-sm rounded-lg">
                                       verwijderen
                                       <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                 </form>   
                                 </td>
                                 </tr>';
                              }
                           }
                        ?>
                           <tr>
                              <td class="text-lg"><?php echo 'Artiekelen '. totalItemsInCart() ?></td>
                              <td class="text-lg"><?php echo 'Te Betalen    € '.Cart_TotalPrice($conn); ?></td>
                              <td></td>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
            </div>

         </div>
         <div class="flex justify-center mb-5">
               <button class="btn btn-lg w-1/3">BETALEN</button>
         </div>   
      </main>
      

<?php 
   require_once ('footer.php');
?>