<?php 
require_once ('dbc.php');
require_once ('functions.php');
$websiteName = "THE CANDY SHOP";
session_start();
setCart();
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pageName." | ". $websiteName;?></title>
    <link rel="icon" type="image/x-icon" href="img/candyshop-logo.png">
    <script src="https://kit.fontawesome.com/60b7f63680.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="output.css" />
</head>