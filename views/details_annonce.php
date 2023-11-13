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
 require_once __DIR__ . "./../classes/class_serveur.php";
 require_once __DIR__ . "./../classes/class_enchere.php";

//Verifie que la variable 'Id_annonce' soit presente dans l'url et est envoyé avec la methode get quand l'utilisateur cliaue sur le lien
 if(isset($_GET['id_annonce'])) {
    $id_annonce = $_GET['id_annonce'];

    // Une requete SQL qui selectionnes toutes les colones de la table annonce, ainsi que quelques colonnes de la table "encheres" et "utilisateurs". 
    // Fait des jointures et la conditions where filtre les annonces pour obtenir l'identifiant specifique à celle-ci.
    $query = $dbh->prepare("SELECT annonces.*, encheres.montant, encheres.id_utilisateur, utilisateurs.nom, utilisateurs.prenom FROM annonces 
        LEFT JOIN encheres ON annonces.id_annonce=encheres.id_annonce 
        LEFT JOIN utilisateurs ON encheres.id_utilisateur=utilisateurs.id_utilisateur         
        WHERE annonces.id_annonce = :id_annonce");

    // lie la valeur à la variable dans la requête SQL. Cela aide à prévenir les attaques par injection SQL en assurant que la valeur de l'identifiant est traitée comme un entier.
    $query->bindValue(':id_annonce', $id_annonce, PDO::PARAM_INT);
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
        // En construction
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<input type='number' step='100' class='info inputEnchere' placeholder='Entrer votre enchère' name='enchere'></input>";
        echo "<p>ID de l'enchérisseur :" .  $_SESSION['id_utilisateur'] . "</p>";
        echo "<input type='hidden' name='id_annonce' value='" . $result['id_annonce'] . "'>";
        echo "<button class='info inputEnchere' type='submit' class='info'>Enchérir</button>";
        echo "</form>";
        // Fin de construction
        echo '<br><br>';
        echo '<a href="../">Retour</a>';
        echo '</div>';
        echo '<div class="visual">';
        echo "<img src='" . $result['image_path'] . "' alt />";
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
            // En construction
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<p>Votre ID : " .  $_SESSION['id_utilisateur'] . "</p>";
            echo "<input type='number' step='100' class='info inputEnchere' placeholder='Entrer votre enchère' name='enchere'></input>";
            echo "<input type='hidden' name='id_annonce' value='" . $result['id_annonce'] . "'>";
            echo "<button class='info inputEnchere' type='submit' class='info'>Enchérir</button>";
            echo "</form>";
            // Fin de construction
            echo '<br><br>';
            echo '<a href="../">Retour</a>';
            echo '</div>';
            echo '<div class="visual">';
            echo "<img src='" . $result['image_path'] . "' alt />";
            echo '</div>';
            echo '</section>';
            echo '</article>';
        }
    }
}
    ?>
    <script>
    function validateEnchere() {
        let enchereInput = document.getElementById('enchere');
        let prixDepart = <?php echo $result['prix_depart']; ?>; 
        let enchereActuelle = <?php echo $result['montant']; ?>;

        if (enchereInput.value <= prixDepart) {
            alert("Le montant de l'enchère doit être supérieur au prix de départ.");
            return false;
        }

        if (enchereActuelle !== null && enchereInput.value <= enchereActuelle) {
            alert("Le montant de l'enchère doit être supérieur à l'enchère actuelle.");
            return false;
        }

        return true;
    }
</script>
    </body>
</html>