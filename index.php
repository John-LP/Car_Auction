<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./css/styles_navbar.css" rel="stylesheet">
  <link href="./css/styles_card.css" rel="stylesheet" type="text/css" />
  <title>Car Auction</title>
</head>
<body>
  <?php
    require __DIR__ . "/views/navbar.php";
    require __DIR__ . "/views/accueil.php";
  ?>
</body>
</html>