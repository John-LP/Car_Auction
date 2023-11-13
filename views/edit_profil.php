<!-- Page de modification du profil utilisateur -->
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
    // Inclusion de la barre de navigation
    require_once __DIR__ . "/navbar.php";
    ?>

    <?php
    // Vérifie la méthode de requête
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Traitement des données du formulaire POST (à compléter)
    } else {
        // Vérifie la présence d'un identifiant d'utilisateur dans les paramètres GET
        if (isset($_GET['id'])) {
            $id_utilisateur = $_GET['id'];

            // Inclusion de la classe serveur pour la gestion de la base de données
            require_once __DIR__ . "./../classes/class_serveur.php";

            // Requête pour récupérer les informations de l'utilisateur par son ID
            $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
            $query->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $query->execute();
            $utilisateur = $query->fetch();

            // Vérifie si l'utilisateur existe
            if ($utilisateur) {
                ?>
                <!-- Formulaire de modification des informations de l'utilisateur -->
                <form method="post" action="class_utilisateur.php">
                    <h2>Modifier mes infos</h2>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= $utilisateur['nom'] ?>" required>
                    <br>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= $utilisateur['prenom'] ?>" required>
                    <br>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?= $utilisateur['email'] ?>" required>
                    <br>

                    <input type="submit" value="Enregistrer les modifications">
                </form>
                <?php
            } else {
                echo "ID d'utilisateur non valide.";
            }
        } else {
            // Affiche les informations de l'utilisateur (à compléter)
            echo '<article>';
            echo '<section class="card">';
            echo '<div class="text-content">';
            echo "<p><u>Votre ID unique à utiliser pour créer une annonce :</u> " . $result['id_utilisateur'] . "</p>";
            echo '<br>';
            echo "<p><u>Nom :</u> " . $result['nom'] . "</p>";
            echo '<br>';
            echo "<p><u>Prénom :</u> " . $result['prenom'] . "</p>";
            echo '<br>';
            echo "<p><u>Email :</u> " . $result['email'] . "</p>";
            echo "<br>";
            echo "<a class='info' href='./profil.php" . $result['id_utilisateur'] . "'>Valider</a>";
            echo '<br><br>';
            echo '</section>';
            echo '</article>';
        }
    }
    ?>
</body>

</html>
