<!DOCTYPE html>
<html lang="en">
  <?Php
    $pageName = "Admin-Edit";
    require_once ('head.php');
    require_once ('header.php');
    $products = getproducts($conn);
    $Categorys = getCat($conn);
?>
  <body>
    <main class="flex justify-center">
      <div class="m-5 sm:m-10 grid gap-y-5">
        <!--product toevoegen NEW-->
        <form action="upload.php?msg=CreateProduct" method="POST" enctype="multipart/form-data" id="CreateProduct">
          <div class="bg-gray-200 rounded-2xl shadow-2xl grid flex-col-reverse sm:grid-rows-1 sm:grid-cols-3 lg:grid-cols-6 gap-3 p-3 h-fit">
            <div class="card w-full col-span-1">
              <figure><img src="https://placehold.co/400x400/png" alt="placeholder" class="" /></figure>
              <div class="card-body p-0 gap-0">
                <p class="text-center bg-primary text-sm">ID 30</p>
                <input type="file" name="file" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required class="file-input-bordered file-input-accent w-full file-input-sm file-input rounded-b-2xl rounded-t-none" />
              </div>
            </div>
            <div class="sm:col-span-1">
              <div class="form-control w-full">
                <label class="label">
                  <span class="label-text">Naam</span>
                </label>
                <input type="text" name="name" id="inputName" placeholder="Typ hier" required class="input input-bordered w-full max-w-xs input-sm" />
              </div>
              <div class="form-control w-full max-w-xs">
                <label class="label">
                  <span class="label-text">Prijs</span>
                </label>
                <input type="number" name="price" step="any" id="inputPrice" placeholder="Typ hier" required class="input input-bordered w-full max-w-xs input-sm" />
              </div>
                <label for="category" class="label-text">categorie</label> <br />
                <select name="category" type="submit" required class="input input-sm">
                  <option value="" disabled selected hidden>Selecteer Categorie</option>
                  <option value="1">chocolade</option>
                  <option value="2">zuur</option>
                  <option value="3">zoet</option>
                  <option value="4">drop</option>
                  <option value="5">sale!</option>
                </select>
            </div>
            <textarea name="description" required class="textarea textarea-bordered rounded-2xl resize-none col-span-1 md:col-span-1 lg:col-span-3 md:grid-rows-2" placeholder="Product omschrijving"></textarea>
            <div class="flex flex-col lg:justify-evenly sm:flex-row lg:flex-col col-span-1 sm:col-span-3 lg:col-span-1">
              <button type="Submit" name="createProduct" class="btn btn-primary lg:btn-block rounded-lg h-full w-full">
                <i class="fa-solid fa-plus fa-2xl"></i>
              </button>
            </div>
          </div>
        </form>
        
        
        <?Php
        foreach ($products as $product) {
          //zoeken in de array cat waar de zelfde waarde gevonden kan worden
        echo '<form action="upload.php?msg=ChangeProduct&productid='.$product["id"].'" method="POST" enctype="multipart/form-data" id="'.$product["id"].'">
          <div class="bg-gray-200 rounded-2xl shadow-2xl grid flex-col-reverse sm:grid-rows-1 sm:grid-cols-3 lg:grid-cols-6 gap-3 p-3 h-fit">
            <div class="card w-full col-span-1">
              <figure><img src="'.$product["img_path"].'" alt="'.$product["name"].'" /></figure>
              <div class="card-body p-0 gap-0">
                <p class="text-center bg-primary text-sm">'.$product["id"].'</p>
                <input type="file" name="file" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" class="file-input-bordered file-input-accent w-full file-input-sm file-input rounded-b-2xl rounded-t-none" />
              </div>
            </div>
            <div class="sm:col-span-1">
              <div class="form-control w-full">
                <label class="label">
                  <span class="label-text">Naam</span>
                </label>
                <input type="text" name="name" id="inputName" placeholder="Typ hier" value="'.$product["name"].'" required class="input input-bordered w-full max-w-xs input-sm"></input>
              </div>
              <div class="form-control w-full max-w-xs">
                <label class="label">
                  <span class="label-text">Prijs</span>
                </label>
                <input type="number" name="price" step="any" id="inputPrice" placeholder="Typ hier" value="'.$product["price"].'" required class="input input-bordered w-full max-w-xs input-sm"></input>
              </div>
                <label for="category" class="label-text">categorie</label> <br />
                <select name="category" type="submit" required class="input input-sm">
                  <option value="'.$Categorys[0]["product_categorie_id"].'" selected hidden>'.$Categorys[0]["product_categorie_naam"].'</option>';
                  foreach ($Categorys as $cat) {
                  echo  '<option value="'.$cat["product_categorie_id"].'">'.$cat["product_categorie_naam"].'</option>';
                  }
              echo'</select>
            </div>
            <textarea name="description" id="description" type="text" required class="textarea textarea-bordered rounded-2xl resize-none col-span-1 md:col-span-1 lg:col-span-3 md:grid-rows-2" placeholder="Product omschrijving">'.$product["description"].'</textarea>

            <div class="flex flex-col lg:justify-evenly sm:flex-row lg:flex-col col-span-1 sm:col-span-3 lg:col-span-1">
              <button disabled class="btn btn-primary btn-md lg:btn-block rounded-lg">
                wijzigen
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button type="submit" name="updateProduct" class="btn btn-primary btn-md lg:btn-block rounded-lg">
                Opslaan
                <i class="fa-solid fa-floppy-disk"></i>
              </button>
              <button type="submit" name="deleteProduct" class="btn btn-primary btn-md lg:btn-block rounded-lg">
                verwijderen
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
          </div>
        </form>';
        }
        ?>

        
      </div>
    </main>
  </body>

  <?Php
    require_once ('footer.php');
?>
</html>
