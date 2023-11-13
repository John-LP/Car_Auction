<!-- L'utilisateur peut suivre les annonces sur lesquelles il a enchérit et celles qu'il a remporté -->
<?php
  session_start();
  if(!isset($_SESSION['email'])) {
    header("Location: ../views/encheres_acheteur");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../css/styles_card.css" rel="stylesheet" type="text/css" />
    <link href="./../css/styles_navbar.css" rel="stylesheet">
    <title>Document</title>
</head>
<?php
        require_once __DIR__ . "/navbar.php";
        ?>
<body>
    
</body>
</html>