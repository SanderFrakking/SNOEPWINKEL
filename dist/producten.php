<!DOCTYPE html>
<html lang="en">
    <?Php
        $pageName = "Producten";
        require_once ('head.php');
        require_once ('header.php');
        require_once ('functions.php');
        $msg=$_GET['msg'];
        $products = getproducts($conn);
    ?>
    <body>
        <main>
            <div class="grid xs:grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7 m-5 sm:m-10">
                <?Php 
                foreach ($products as $product) {
                echo'<div class="card card-compact bg-gray-200 shadow-xl z-0  " id="categorie'.$product["product_categorie_id"].'">
                        <img src="'.$product["img_path"].'" alt="Shoes" class="rounded-xl" />
                        <div class="card-body">
                            <h2 class="card-title">'.$product["name"].'</h2>
                            <p>'.$product["description"].'</p>
                            <div class="card-actions">
                                <a href="detailpage.php?productid='.$product["id"].'" class="btn btn-primary">Meer informatie</a>
                            </div>
                        </div>
                </div>';
                }
                ?>
            </div>
        </main>

    </body>
</html>
<?Php
    require_once ('footer.php');
?>
