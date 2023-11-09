<?php
    require_once __DIR__."/../classes/class_annonce.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet"> 
</head>
<body>

    <div class="render_annonces">
        <?php
            $dbh = new PDO("mysql:dbname=car_auction;host=127.0.0.1", "root", "");
            if (isset($_GET['id'])) {
                $selectedID = $_GET['id'];
            $query = $dbh->prepare('SELECT annonces.*,utilisateurs.id_utilisateur from annonces LEFT JOIN utilisateurs ON utilisateurs.id_utilisateur=annonces.id_utilisateur;');
            $query->bindParam(':selectedID', $selectedID, PDO::PARAM_INT);
            } else {
                $query = $dbh->prepare('SELECT annonces.*,utilisateurs.id_utilisateur from annonces LEFT JOIN utilisateurs ON utilisateurs.id_utilisateur=annonces.id_utilisateur');
            }
            $query->execute();
            $results = $query->fetchAll();
            foreach($results as $key => $values) { 
            echo "<div class='renderclients'>";
            echo "<p> Marque: " . $values['marque'] . "</p>" ;
            echo "<p> Prix de départ: " . $values['prix_depart'] . "</p>" ;
            echo "<p> Date " . $values['date_fin'] . "</p>" ;
            echo "<a class='info' href='details_annonce.php?id_annonce=" . $values['id_annonce'] . "'>En savoir plus</a>";
            echo "</div>";
            }
        ?>
    </div>



</body>
</html>