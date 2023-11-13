<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: http://localhost:8888/php/car_auction/views/login");
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
</head>
    <body>
        <?php
        require_once __DIR__ . "/navbar.php";
        require_once __DIR__ . "./../classes/class_serveur.php";

        $email = $_SESSION['email'];
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        while ($result = $query->fetch()) {
            echo '<article>';
            echo '<section class="card">';
            echo '<div class="text-content">';
            echo "<p><u>Votre ID unique à utiliser pour créer une annoce :</u> " . $result['id_utilisateur'] . "</p>";
            echo '<br>';
            echo "<p><u>Nom :</u> " . $result['nom'] . "</p>";
            echo '<br>';
            echo "<p><u>Prénom :</u> " . $result['prenom'] . "</p>";
            echo '<br>';
            echo "<p><u>Email :</u> " . $result['email'] . "</p>";
            echo "<br>";
            echo "<a class='info' href='./edit_profil.php'>Modifier</a>";
            echo '<br><br>';
            echo '</section>';
            echo '</article>';
        }
        ?>
    </body>
</html>