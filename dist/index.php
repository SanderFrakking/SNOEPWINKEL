<!DOCTYPE html>
<html lang="en">
  <?php
  $pageName = "Home";
  require_once ('head.php');
    require_once ('header.php');

  ?>
  <body>
    <img src="img/banner1.jpg" alt="" class=" w-full ">

    <main class="container md:mx-auto md:px-10 lg:px-20">

      <div class="flex flex-col md:flex-row">
        <div class="w-full">
            <h1 class="text-4xl">aanbieding (paar random producten)</h1>
        </div>

        <div class="w-full">
          <h1 class="text-4xl">bestseller (paar random producten)</h1>
        </div>
      </div>
    </main>
    <?php
    require_once ('footer.php');
    ?>
  </body>
</html>
