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

    $query = $dbh->prepare("SELECT annonces.*, encheres.montant, encheres.id_utilisateur, utilisateurs.nom, utilisateurs.prenom FROM annonces LEFT JOIN encheres ON annonces.id_annonce=encheres.id_annonce LEFT JOIN utilisateurs ON encheres.id_utilisateur=utilisateurs.id_utilisateur;");
    $query->execute();

    while ($result = $query->fetch()) {
        if($result['montant']>=1){
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
        echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
        echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . " €" . "</p>";
        echo "<p><u>Enchère actuelle :</u> " . $result['montant'] . " €" . " par " . $result['nom'] . " " . $result['prenom'] . " ID " . $result['id_utilisateur'] . "</p>";
        echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . "</p>";
        echo "<p><u>Puissance :</u> " . $result['puissance'] . " Ch" . "</p>";
        echo "<p>" . $result['description'] . "</p>";
        echo '<br>';
        echo "<div>";
        echo "<input type='number' class='info inputEnchere' placeholder='Entrer vôtre enchere' ></input>";
        echo "<a class='info'>Enchérir</a>";
        echo "</div>";
        echo '<br><br>';
        echo '<a href="http://localhost/exoBocal/car_auction/">Retour</a>';
        echo '</div>';
        echo '<div class="visual">';
        echo '<img src="https://4kwallpapers.com/images/walls/thumbs_3t/9840.jpg" alt />';
        echo '</div>';
        echo '</section>';
        echo '</article>';
        }
        else{
            echo '<article>';
            echo '<section class="card">';
            echo '<div class="text-content">';
            echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
            echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
            echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . " €" . "</p>";
            echo "<p><u>Enchère actuelle :</u>" . " Aucune " . "</p>";
            echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . "</p>";
            echo "<p><u>Puissance :</u> " . $result['puissance'] . " Ch" . "</p>";
            echo "<p>" . $result['description'] . "</p>";
            echo '<br>';
            echo "<div>";
            echo "<input type='number' class='info inputEnchere' placeholder='Entrer vôtre enchere' ></input>";
            echo "<a class='info'>Enchérir</a>";
            echo "</div>";
            echo '<br><br>';
            echo '<a href="http://localhost/exoBocal/car_auction/">Retour</a>';
            echo '</div>';
            echo '<div class="visual">';
            echo '<img src="https://4kwallpapers.com/images/walls/thumbs_3t/9840.jpg" alt />';
            echo '</div>';
            echo '</section>';
            echo '</article>';
        }
    }
    ?>
    </body>
</html>