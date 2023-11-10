
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
        $dbh = new PDO("mysql:dbname=car_auction;host=localhost;port=8889", "root", "root");

        $query = $dbh->prepare("SELECT * FROM utilisateurs");
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
            echo "<a class='info' href='http://localhost:8888/php/car_auction/views/edit_profil.php'>Modifier</a>";
            echo '<br><br>';
            echo '</section>';
            echo '</article>';
        }
        ?>
    </body>
</html>