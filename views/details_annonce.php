<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
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
    require_once __DIR__ . "./../classes/class_serveur.php";
    require_once __DIR__ . "./../classes/class_enchere.php";

    //Verifie que la variable 'Id_annonce' soit presente dans l'url et est envoyé avec la methode get quand l'utilisateur cliaue sur le lien
    if(isset($_GET['id_annonce'])) {
        $id_annonce = $_GET['id_annonce'];
        $date_actuelle = new DateTime();
        // Une requete SQL qui selectionnes toutes les colones de la table annonce, ainsi que quelques colonnes de la table "encheres" et "utilisateurs". 
        // Fait des jointures et la conditions where filtre les annonces pour obtenir l'identifiant specifique à celle-ci.
        $query = $dbh->prepare(
        "SELECT 
                annonces.*,
                encheres.id_enchere,
                encheres.montant,
                encheres.id_utilisateur,
                encheres.date_heure_enchere,
                utilisateurs.nom,
                utilisateurs.prenom
            FROM 
                annonces 
            LEFT JOIN 
                encheres ON annonces.id_annonce=encheres.id_annonce 
            LEFT JOIN
                utilisateurs ON encheres.id_utilisateur=utilisateurs.id_utilisateur
            WHERE
                annonces.id_annonce = :id_annonce
            ORDER BY
                encheres.montant DESC
            LIMIT 1 ");

        // lie la valeur à la variable dans la requête SQL. Cela aide à prévenir les attaques par injection SQL en assurant que la valeur de l'identifiant est traitée comme un entier.
        $query->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $query->execute();
        $hitorique_enchere = $queryEncheres = $dbh->prepare(
            "SELECT
                encheres.id_enchere,
                encheres.montant,
                encheres.date_heure_enchere,
                encheres.id_utilisateur,
                utilisateurs.prenom,
                utilisateurs.nom
            FROM
                encheres
            LEFT JOIN annonces ON encheres.id_annonce = annonces.id_annonce
            LEFT JOIN utilisateurs ON encheres.id_utilisateur = utilisateurs.id_utilisateur
            WHERE encheres.id_annonce = :id_annonce
            AND encheres.id_enchere != :current_enchere_id
            ORDER BY encheres.date_heure_enchere DESC");
    
        $result = $query->fetch();
            echo '<article>';
            echo '<section class="card">';
            echo '<div class="text-content">';
            echo "<h3>" . $result['marque'] . " " . $result['modele'] . "</h3>";
            echo "<p><u>Année :</u>" . " " . $result['annee'] . "</p>";
            echo "<p><u>Prix de départ :</u> " . $result['prix_depart'] . " €" . "</p>";
            // Si il y une enchère sur l'annonce elle s'affichera dans 'enchère actuelle' sinon 'Aucune' s'affichera
            if (new DateTime($result['date_fin']) > $date_actuelle) {
                if ($result['montant'] >= 1) {
                    echo "<p><u>Enchère actuelle :</u> " . $result['montant'] . " €" . " par " . $result['nom'] . " " . $result['prenom'] . "<br />" . "le" . " " . $result['date_heure_enchere'] . "</p>";
                    if ($result['montant'] >= 1) {
                        // Utilisez l'identifiant unique d'enchère pour filtrer les enchères précédentes
                        $hitorique_enchere;
                        $queryEncheres->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
                        $queryEncheres->bindValue(':current_enchere_id', $result['id_enchere'], PDO::PARAM_INT);
                        $queryEncheres->execute();
                        
                        echo "<p><u>Enchères précédentes :</u></p>";
                        while ($resultEnchere = $queryEncheres->fetch()) {
                            echo "<p>Enchérisseur : " . $resultEnchere['nom'] . " " . $resultEnchere['prenom'] . "<br>" . "Enchère : " . $resultEnchere['montant'] . " €" . " le " . $resultEnchere['date_heure_enchere'] . "</p>";
                        }
                    }
                } else {
                    echo "<p><u>Enchère actuelle :</u> Aucune</p>";
                }
            } else {
                if ($result['montant']) {
                echo "<p>" . $result['nom'] . " " . $result['prenom'] . " a remporté le bien" . "<br>" . "avec une enchère de " . $result['montant'] . " €" . "</p>";
                // Utilisez l'identifiant unique d'enchère pour filtrer les enchères précédentes
                $hitorique_enchere;
                $queryEncheres->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
                $queryEncheres->bindValue(':current_enchere_id', $result['id_enchere'], PDO::PARAM_INT);
                $queryEncheres->execute();
                echo "<p><u>Enchères précédentes :</u></p>";
                while ($resultEnchere = $queryEncheres->fetch()) {
                    echo "<p>Enchérisseur : " . $resultEnchere['nom'] . " " . $resultEnchere['prenom'] . "<br>" . "Enchère : " . $resultEnchere['montant'] . " €" . " le " . $resultEnchere['date_heure_enchere'] . "</p>";
                }
                } else {
                    echo "<p>Aucune offre n'a été faite pour cette annonce.</p>";
                }
            }
            echo "<p><u>Échéance de l'enchère :</u> " . $result['date_fin'] . " (exclu)"  . "</p>";
            echo "<p><u>Puissance :</u> " . $result['puissance'] . " Ch" . "</p>";
            echo "<p>" . $result['description'] . "</p>";
            echo '<br>';
            // Vérifier si la date de fin est supérieure à la date actuelle
            if (new DateTime($result['date_fin']) > $date_actuelle) {
            // En construction
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='number' step='100' class='info inputEnchere' placeholder='Entrez votre enchère' name='montant' required></input>";
            echo "<input type='hidden' name='id_annonce' value='" . $result['id_annonce'] . "'>";
            echo "<input type='hidden' name='date_heure_enchere' value='" . date('Y-m-d H:i:s') . "'>";
            echo "<button class='btn' type='submit'>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Enchérir
                </button>";
            echo "</form>";        
            // Fin de construction
            } else {
                echo '<p>L\'enchère est terminée depuis ' . $result['date_fin'] . '</p>';
            }
            
            echo '<br><br>';
            echo '<a href="../">Retour</a>';
            echo '</div>';
            echo '<div class="visual">';
            echo "<img src='" . $result['image_path'] . "' alt />";
            echo '</div>';
            echo '</section>';
            echo '</article>';
        } 
        ?>
    </body>
</html>