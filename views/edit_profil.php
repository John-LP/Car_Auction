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
    ?>

    <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {

} else {
    if (isset($_GET['id'])) {
        $id_utilisateur = $_GET['id'];

        require_once __DIR__ . "./../classes/class_serveur.php";

        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
        $query->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $query->execute();
        $utilisateur = $query->fetch();

        if ($utilisateur) {
            ?>
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
            echo "<a class='info' href='./profil.php" . $result['id_utilisateur'] . "'>Valider</a>";
            echo '<br><br>';
            echo '</section>';
            echo '</article>';
        }
    }
    ?>
</body>
</html>
