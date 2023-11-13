<!-- Page de modification du profil -->
<?php
// Démarrage de la session pour accéder aux variables de session
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['email'])) {
    header("Location: ../views/login");
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
    // Inclusion de la barre de navigation
    require_once __DIR__ . "/navbar.php";

    // Inclusion de la classe de gestion du serveur
    require_once __DIR__ . "./../classes/class_serveur.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $id_utilisateur = $_POST['id_utilisateur'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        // Mise à jour des informations de l'utilisateur
        $query = $dbh->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp WHERE id_utilisateur = :id_utilisateur");
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':email', $email);
        $query->bindValue(':mdp', $mdp);
        $query->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $query->execute();

        // Redirection vers la page de profil après la mise à jour
        header("Location: ./profil.php");
        exit;
    } else {
        // Afficher le formulaire de modification du profil
        echo '<form method="post" action="./edit_profil.php">';
        echo '<article>';
        echo '<section class="card">';
        echo '<class="info inputEnchere">';
        echo '<h2>Modifier mes infos</h2><br><br><br>';

        // Récupérer à nouveau les informations de l'utilisateur pour afficher dans le formulaire
        $email = $_SESSION['email'];
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        $result = $query->fetch();

        // Champs du formulaire
        echo '<input type="hidden" name="id_utilisateur" value="' . $result['id_utilisateur'] . '">';
        echo '<label for="nom">Nom :</label><br><br>';
        echo '<input type="text" class="info inputEnchere id="nom" name="nom" value="' . $result['nom'] . '" required>';
        echo '<br><br>';

        echo '<label for="prenom">Prénom :</label><br><br>';
        echo '<input type="text" class="info inputEnchere id="prenom" name="prenom" value="' . $result['prenom'] . '" required>';
        echo '<br><br>';

        echo '<label for="email">Email :</label><br><br>';
        echo '<input type="email" class="info inputEnchere id="email" name="email" value="' . $result['email'] . '" required>';
        echo '<br><br>';

        echo '<label for="email">Mot de passe :</label><br><br>';
        echo '<input type="text" class="info inputEnchere id="mdp" name="mdp" value="' . $result['mdp'] . '" required>';
        echo '<br><br>';

        echo "<button class='login-button' type='submit'>Enregistrer</button>";
        echo '</section>';
        echo '</article>';
        echo '</form>';
    }
    ?>
</body>
</html>
