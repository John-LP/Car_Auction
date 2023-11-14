<!-- Page affichant toutes les annonces avec leurs détails -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../css/styles_card.css" rel="stylesheet" type="text/css" />
    <link href="./../css/styles_navbar.css" rel="stylesheet">
</head>

<body>
    <h2>Enchères en cours</h2>
    <?php
    // Inclusion de la classe serveur pour la gestion de la base de données
    require_once __DIR__ . "./../classes/class_serveur.php";

    // Requête pour récupérer toutes les annonces avec les détails des utilisateurs associés
    $query = $dbh->prepare("SELECT annonces.*, utilisateurs.nom, utilisateurs.prenom FROM annonces 
                      INNER JOIN utilisateurs ON annonces.id_utilisateur = utilisateurs.id_utilisateur WHERE annonces.date_fin > NOW()");
    $query->execute();

    // Affichage des annonces récupérées
    while ($result = $query->fetch()) {
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<h3>Mise aux enchères par</n> " . $result['nom'] . ' ' . $result['prenom'] . "</h3>";
        echo '<br><br>';
        echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
        echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
        echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . " €" . "</p>";
        echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . " (exclu)" . "</p>";
        echo "<a class='info' href='./views/details_annonce.php?id_annonce=" . $result['id_annonce'] . "'>En savoir plus</a>";
        echo '</div>';
        echo '<div >';
        echo "<img class='visual' src='" . $result['image_path'] . "' alt />";
        echo '</div>';
        echo '</section>';
        echo '</article>';
    }
    ?>

    <h2>Enchères terminées</h2>
    <?php
    // Inclusion de la classe serveur pour la gestion de la base de données
    require_once __DIR__ . "./../classes/class_serveur.php";

    // Requête pour récupérer toutes les annonces avec les détails des utilisateurs associés
    $end_of_query = $dbh->prepare("SELECT annonces.*, utilisateurs.nom, utilisateurs.prenom FROM annonces 
                      INNER JOIN utilisateurs ON annonces.id_utilisateur = utilisateurs.id_utilisateur WHERE annonces.date_fin < NOW()");
    $end_of_query->execute();

    // Affichage des annonces récupérées
    while ($end_of_result = $end_of_query->fetch()) {
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<h3>Mise aux enchères par</n> " . $end_of_result['nom'] . ' ' . $end_of_result['prenom'] . "</h3>";
        echo '<br><br>';
        echo "<h3>" . $end_of_result['marque'] . " " . $end_of_result['modele'] . "</h3>";
        echo "<p><u>Année :</u>" . " " . $end_of_result['annee'] . "</p>";
        echo "<p><u>Prix de départ :</u> " . $end_of_result['prix_depart'] . " €" . "</p>";
        echo "<p><u>Échéance de l'enchère :</u> " . $end_of_result['date_fin'] . "</p>";
        echo "<a class='info' href='./views/details_annonce.php?id_annonce=" . $end_of_result['id_annonce'] . "'>En savoir plus</a>";
        echo '</div>';
        echo '<div >';
        echo "<img class='visual' src='" . $end_of_result['image_path'] . "' alt />";
        echo '</div>';
        echo '</section>';
        echo '</article>';
    }
    ?>

</body>

</html>
