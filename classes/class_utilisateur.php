<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/styles_login.css">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    require_once __DIR__ . "/class_serveur.php";

    $query = $dbh->prepare("INSERT INTO utilisateurs (nom, prenom, email, mdp)
    VALUES (:nom, :prenom, :email, :mdp)");
    $query->bindValue(':nom', $nom);
    $query->bindValue(':prenom', $prenom);
    $query->bindValue(':email', $email);
    $query->bindValue(':mdp', $mdp);
    $query = $query->execute();

    if ($query) {
        $query = $dbh->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $query->execute([$nom]);
        $utilisateur = $query->fetch();

        echo "<p>Votre compte a bien été créé. <br>
                Vous allez être redirigé vers l'accueil.<br>
                Bonne visite.</p>";

    } else {
        echo "<p>Erreur lors de la création du compte.</p>";
    }

    echo '<script>
            setTimeout(function() {
                window.location.href = "../";
            }, 1000); // Redirection après 1 secondes (1000 millisecondes)
          </script>';

          
}
?>
</body>
</html>
