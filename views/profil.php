<!-- Page affichant le profil de l'utilisateur -->
<?php
  // Démarrage de la session pour accéder aux variables de session
  session_start();

  // Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
  if(!isset($_SESSION['email'])) {
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
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</head>

<body>
    <?php
    // Inclusion de la barre de navigation
    require_once __DIR__ . "/navbar.php";

    // Inclusion de la classe de gestion du serveur
    require_once __DIR__ . "./../classes/class_serveur.php";

    // Récupération de l'email de l'utilisateur depuis la session
    $email = $_SESSION['email'];

    // Préparation et exécution de la requête pour obtenir les informations de l'utilisateur
    $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $query->bindValue(':email', $email);
    $query->execute();

    // Affichage des informations de l'utilisateur
    while ($result = $query->fetch()) {
        echo '<article>';
        echo '<section class="card">';
        echo '<div class="text-content">';
        echo "<p><u>Nom :</u> " . $result['nom'] . "</p>";
        echo '<br>';
        echo "<p><u>Prénom :</u> " . $result['prenom'] . "</p>";
        echo '<br>';
        echo "<p><u>Email :</u> " . $result['email'] . "</p>";
        echo "<br>";
        echo "<p><u>Mot de passe :</u> <input class='mdp' type='password' id='password' value='" . $result['mdp'] . "' disabled></p>";
        echo "<br>";
        // Bouton pour afficher ou cacher le mot de passe
        echo "<a class='info' onclick='togglePassword()'>Afficher/Cacher Mot de passe</a><br>";
        // Lien pour la modification du profil
        echo "<a class='info' href='./edit_profil.php'>Modifier mes informations</a>";
        echo '<br><br>';
        echo '</section>';
        echo '</article>';
    }
    ?>
</body>
</html>
