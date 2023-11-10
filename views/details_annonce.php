<!-- Affiche une annonce en détails -->
<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta property="og:type" content="website" />
        <meta content="summary_large_image" name="twitter:card" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link href="./../css/styles_card.css" rel="stylesheet" type="text/css" />
        <link href="./../css/styles_navbar.css" rel="stylesheet">
    </head>
    <body>
    <?php
    require_once __DIR__ . "/navbar.php";

    $dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");

    $query = $dbh->prepare("SELECT * FROM annonces");
    $query->execute();

    while ($result = $query->fetch()) {
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
        echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
        echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . "€" . "</p>";
        echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . "</p>";
        echo "<p><u>Puissance :</u> " . $result['puissance'] . " Ch" . "</p>";
        echo "<p>" . $result['description'] . "</p>";
        echo '<a href="http://localhost/exoPHP/car_auction/">Retour</a>';
        echo '</div>';
        echo '<div class="visual">';
        echo '<img src="https://4kwallpapers.com/images/walls/thumbs_3t/9840.jpg" alt />';
        echo '</div>';
        echo '</section>';
        echo '</article>';
    }
    ?>
    </body>
</html>