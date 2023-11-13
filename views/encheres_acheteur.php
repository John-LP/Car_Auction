<!-- Page affichant les annonces suivies par l'utilisateur -->
<?php
  // Démarre la session pour accéder aux variables de session
  session_start();

  // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
  if(!isset($_SESSION['email'])) {
    header("Location: ../views/login");
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
    <title>Annonces suivies</title>
</head>

<!-- Inclusion de la barre de navigation -->
<?php
    require_once __DIR__ . "/navbar.php";
?>

<body>
</body>
</html>
